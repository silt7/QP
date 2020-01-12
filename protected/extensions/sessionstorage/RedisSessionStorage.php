<?php
/**
 * RedisSessionStorage
 * 
 * PHP version 5
 *
 * @category   Packages
 * @package    Ext.component
 * @subpackage Ext.component.session
 * @author     Dmitriy Cherepovskiy <cherep@jviba.com>
 * @copyright  2013 JVIBA
 * @license    http://www.gnu.org/licenses/lgpl.html LGPL
 * @link       http://jviba.com/packages/php/docs
 */

/**
 * RedisSessionStorage is the Redis-based backend for client session storage mechanism.
 * It can be used in conjunction with the UserStatus module, but resulting quality
 * isn't guaranteed.
 *
 * @category   Packages
 * @package    Ext.component
 * @subpackage Ext.component.session
 * @author     Dmitriy Cherepovskiy <cherep@jviba.com>
 * @copyright  2013 JVIBA
 * @license    http://www.gnu.org/licenses/lgpl.html LGPL
 * @link       http://jviba.com/packages/php/docs
 */
class RedisSessionStorage implements ISessionStorage
{
    const USERS_SET_KEY = 'UsersSet';
    const SESSIONS_EXPIRE_ORDERED_SET_KEY = 'SessionsExpireSet';

    /**
     * Whether the situation with multiple sessions per user gets detected and logged
     * in DB
     * @var boolean
     */
    public $isMultipleSessionsPerUserDetectionOn = false;

    /**
     * Name of the redis component
     * @var string
     */
    public $componentId = 'redis';

    /**
     * Redis connection cache
     * @var ARedisConnection
     */
    private $_connection;

    /**
     * Returns session data key
     *
     * @param string $sessId ID of the session
     *
     * @return string Resulting key
     */
    protected function getDataKey($sessId)
    {
        return 's#' . $sessId;
    }

    /**
     * Returns user data key
     *
     * @param string $userId ID of the user
     *
     * @return string Resulting key
     */
    protected function getUserKey($userId)
    {
        return 'u#' . $userId;
    }

    /**
     * Returns key of the session expire ordered set
     *
     * @return string Resulting key
     */
    protected function getExpireKey()
    {
        return 'e';
    }

    /**
     * Gets the redis connection to use for this session handler
     *
     * @return ARedisConnection
     */
    public function getConnection()
    {
        if ($this->_connection === null) {
            $this->_connection = Yii::app()->getComponent($this->componentId);
            if (! $this->_connection) {
                throw new CException(get_class($this)." expects a 'redis' application component");
            }
        }
        return $this->_connection;
    }

    /**
     * Creates session storage
     *
     * @return boolean whether storage creted successfully or exists
     */
    public function create()
    {
        return Yii::app()->hasComponent($this->componentId);
    }

    /**
     * Returns whether session with given ID exists in storage
     *
     * @param string $id session ID
     *
     * @return boolean whether session exists
     */
    public function getExistsWithId($id)
    {
        return $this->getConnection()->getClient()->exists($this->getDataKey($id));
    }

    /**
     * Returns whether sessions for given user IDs list are exist in storage
     *
     * @param integer|array $userId user ID or user ID array
     *
     * @return array session existing list for given user IDs
     */
    public function getExistsWithUserId($userId)
    {
        if (! $this->isMultipleSessionsPerUserDetectionOn) {
            throw new CException('Multiple sessions per user detection is off!');
        }
        return (bool) $this->getConnection()->getClient()->sCard($this->getUserKey(), $userId);
    }

    /**
     * Reads session data from the storage
     *
     * @param string $id session ID
     *
     * @return array session record
     */
    public function read($id)
    {
        return unserialize($this->getConnection()->getClient()->get($this->getDataKey($id)));
    }

    /**
     * Insert new session attributes into the storage in case of manual expiration handling
     *
     * @param string $id         session ID
     * @param array  $attributes session attributes. Includes: data, expire, user_id.
     *
     * @return boolean whether session data successfully writed
     */
    protected function insertWithManualExpire($id, $attributes)
    {
        $client = $this->getConnection()->getClient();
        $redisDataKey = $this->getDataKey($id);
        $session = array(
            'user_id' => $attributes['user_id'],
            'data' => isset($attributes['data']) ? $attributes['data'] : array(),
        );
        $sessionData = serialize($session);
        $results = $client->multi()
            ->sAdd($this->getUserKey($attributes['user_id']), $id)
            ->zAdd($this->getExpireKey(), $attributes['expire'], $id)
            ->set($redisDataKey, $sessionData)
            ->exec();
        return $resuls[0] && $results[1] && $results[2];
    }

    /**
     * Insert new session attributes into the storage in case of automatic expiration handling
     *
     * @param string $id         session ID
     * @param array  $attributes session attributes. Includes: data, expire, user_id.
     *
     * @return boolean whether session data successfully writed
     */
    protected function insertWithAutomaticExpire($id, $attributes)
    {
        $client = $this->getConnection()->getClient();
        $redisDataKey = $this->getDataKey($id);
        $sessionData = isset($attributes['data']) ? serialize($attributes['data']) : array();
        if (isset($attributes['expire'])) {
            $ttl = max($attributes['expire'] - time(), 1);
            return $client->setex($redisDataKey, $ttl, $sessionData);
        }
        return $client->set($redisDataKey, $sessionData);
    }

    /**
     * Insert new session attributes into the storage
     *
     * @param string $id         session ID
     * @param array  $attributes session attributes. Includes: data, expire, user_id.
     *
     * @return boolean whether session data successfully writed
     */
    public function insert($id, $attributes)
    {
        return $this->isMultipleSessionsPerUserDetectionOn
            ? $this->insertWithManualExpire($id, $attributes)
            : $this->insertWithAutomaticExpire($id, $attributes);
    }

    /**
     * Updates existing session attributes in the storage in the case of manual
     * expiration handling.
     *
     * @param string $id         session ID
     * @param array  $attributes session attributes. Includes: data, expire, user_id.
     *
     * @return boolean whether session data successfully writed
     * @see RedisSessionStorage::update()
     */
    protected function updateWithManualExpire($id, $attributes)
    {
        $client = $this->getConnection()->getClient();
        if (isset($attributes['id'])) { //session ID update
            $oldSessionId = $id;
            $newSessionId = $attributes['id'];
            if (isset($attributes['user_id'])) {
                $userSessionSetKey = $this->getUserKey($attributes['user_id']);
            } else {
                $session = unserialize($client->get($this->getDataKey($oldSessionId)));
                $userSessionSetKey = isset($session['user_id']) && $session['user_id'];
            }
            $expiresKey = $this->getExpireKey();
            $client->multi()
                ->zRem($expiresKey, $oldSessionId);
            if ($userSessionSetKey) {
                $client->sRem($userSessionSetKey, $oldSessionId)
                    ->sAdd($userSessionSetKey, $newSessionId);
            }
            if (isset($attributes['expire']) && $attributes['expire']) {
                $client->zAdd($expiresKey, $attributes['expire'], $newSessionId);
            }
            $results = $client->exec();
            foreach ($results as $result) {
                if (! $result) {
                    return false;
                }
            }
            return true;
        }
        if (isset($attributes['expire']) && ! isset($attributes['data'])) { //session TTL update
            $expiresKey = $this->getExpireKey();
            $results = $client->multi()
                ->zRem($expiresKey, $id)
                ->zAdd($expiresKey, $attributes['expire'], $id)
                ->exec();
            return $results[0] && (bool) $results[1];
        }
        return $this->insert($id, $attributes); //session general update
    }

    /**
     * Updates existing session attributes in the storage in the case of automatic
     * expiration handling.
     *
     * @param string $id         session ID
     * @param array  $attributes session attributes. Includes: data, expire, user_id.
     *
     * @return boolean whether session data successfully writed
     * @see RedisSessionStorage::update()
     */
    protected function updateWithAutomaticExpire($id, $attributes)
    {
        $client = $this->getConnection()->getClient();
        $key = $this->getDataKey($id);
        if (isset($attributes['id'])) { //session ID update
            return $client->rename($key, $this->getDataKey($attributes['id']));
        }
        if (isset($attributes['expire']) && ! isset($attributes['data'])) { //session TTL update
            return $client->expire($key, $attributes['expire']);
        }
        return $this->insert($id, $attributes); //session general update
    }

    /**
     * Updates existing session attributes in the storage.
     * 
     * Can be used in two scenarios:
     *  full update of data, expire and user_id. $attributes given are: data, expire, user_id.
     *  session ID update. $attributes contain only the new session ID
     *
     * @param string $id         session ID
     * @param array  $attributes session attributes. Includes: data, expire, user_id.
     *
     * @return boolean whether session data successfully writed
     */
    public function update($id, $attributes)
    {
        return $this->isMultipleSessionsPerUserDetectionOn
            ? $this->updateWithManualExpire($id, $attributes)
            : $this->updateWithAutomaticExpire($id, $attributes);
    }

    /**
     * Deletes session with given ID from storage
     *
     * @param string $id session ID
     *
     * @return boolean whether session successfully removed
     */
    public function deleteById($id)
    {
        $client = $this->getConnection()->getClient();
        if ($this->isMultipleSessionsPerUserDetectionOn) {
            $results = $client->multi()
                ->sRem($this->getUserKey($attributes['user_id']), $id)
                ->zRem($this->getExpireKey(), $id)
                ->del($this->getDataKey($id))
                ->exec();
            return $resuls[0] && $results[1] && (bool) $results[2];
        } else {
            return $client->del($this->getDataKey($id));
        }
    }

    /**
     * Deletes sessions which was expired on the given timestamp
     *
     * @param integer $expireTime expire timestamp
     *
     * @return void
     */
    public function deleteExpired($expireTime)
    {
        if ($this->isMultipleSessionsPerUserDetectionOn) {
            $client = $this->getConnection()->getClient();
            $idsToDelete = $client->zRangeByScore($this->getExpireKey(), '-inf', $expireTime);
            foreach ($idsToDelete as $id) {
                $this->deleteById($id);
            }
        }
    }
}