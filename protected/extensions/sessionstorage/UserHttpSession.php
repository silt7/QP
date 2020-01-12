<?php
/**
 * UserHttpSession class
 *
 * PHP version 5
 *
 * @category   Packages
 * @package    Module.userStatus
 * @subpackage Module.userStatus.component
 * @author     Evgeniy Marilev <marilev@jviba.com>
 * @license    http://www.gnu.org/licenses/lgpl.html LGPL
 * @link       http://jviba.com/display/PhpDoc
 */
/**
 * UserHttpSession is the session component class required
 * for determining actual user's login status
 *
 * @category   Packages
 * @package    Module.userStatus
 * @subpackage Module.userStatus.component
 * @author     Evgeniy Marilev <marilev@jviba.com>
 * @license    http://www.gnu.org/licenses/lgpl.html LGPL
 * @link       https://jviba.com/display/PhpDoc
 */
class UserHttpSession extends CHttpSession implements ILockableSession
{
    /**
     * Connection ID for user status table
     * @var string
     */
    public $accountsConnectionId = 'db';

    /**
     * Lock files directory path
     * @var string
     */
    public $lockFilesBasePath;

    /**
     * Locking session additional dependency expression
     * @var string
     */
    public $lockDependency = 'Yii::app()->getComponent("request")->getIsAjaxRequest()';

    /**
     * Session storage configuration
     * @var array|ISessionStorage
     */
    public $storage = array(
        'class' => 'SQLSessionStorage',
    );

    /**
     * Whether the session storage should be automatically created if not exists. Defaults to true.
     * @var boolean
     * @see storage
    */
    public $autoCreateStorage = true;

    /**
     * Accounts db connection
     * @var CDbConnection
     */
    private $_accountsDb;

    /**
     * Lock session write for some time interval specified (in seconds)
     * @var integer
     */
    private $_lockOnWrite;

    /**
     * Lock file compiled path
     * @var string
     */
    private $_lockFilePath;

    /**
     * Session storage instance cache
     * @var ISessionStorage
     */
    private $_sessionStorage;

    /**
     * Returns a value indicating whether to use custom session storage.
     * This method overrides the parent implementation and always returns true.
     *
     * @return boolean whether to use custom storage.
     */
    public function getUseCustomStorage()
    {
        return true;
    }

    /**
     * Returns session storage instance
     *
     * @return ISessionStorage storage instance
     */
    protected function getSessionStorage()
    {
        if (!isset($this->_sessionStorage)) {
            $this->_sessionStorage = Yii::createComponent($this->storage);
        }
        return $this->_sessionStorage;
    }

    /**
     * Returns accounts database connection instance
     *
     * @return CDbConnection the accounts DB connection instance
     */
    protected function getAccountsDbConnection()
    {
        if ($this->_accountsDb === null) {
            $this->_accountsDb = Yii::app()->getComponent($this->accountsConnectionId);
        }
        return $this->_accountsDb;
    }

    /**
     * Session open handler.
     * Do not call this method directly.
     *
     * @param string $savePath    session save path
     * @param string $sessionName session name
     *
     * @return boolean whether session is opened successfully
     */
    public function openSession($savePath, $sessionName)
    {
        if ($this->autoCreateStorage) {
            try {
                $this->getSessionStorage()->create();
            } catch(Exception $e) {
                Yii::log('Session storage already created.', CLogger::LEVEL_ERROR);
            }
        }
        return true;
    }

    /**
     * Updates the current session id with a newly generated one.
     * Please refer to {@link http://php.net/session_regenerate_id} for more details.
     * @param boolean $deleteOldSession Whether to delete the old associated session file or not.
     * @since 1.1.8
     */
    public function regenerateID($deleteOldSession = false)
    {
        $oldID = session_id();

        // if no session is started, there is nothing to regenerate
        if (empty($oldID)) {
            return;
        }

        parent::regenerateID(false);
        $newID = session_id();
        $storage = $this->getSessionStorage();

        if (($row = $storage->read($oldID)) !== false) {
            if ($deleteOldSession) {
                $storage->update($oldID, array('id' => $newID));
            } else {
                unset($row['id']);
                $storage->insert($newID, $row);
            }
        } else {
            // shouldn't reach here normally
            $storage->insert($newID, array('expire' => time() + $this->getTimeout()));
        }
    }

    /**
     * Fixed strange bug in user http session
     *
     * @return string session data
     * @see CDbHttpSession::readSession()
     */
    public function readSession($id)
    {
        $data = $this->getSessionStorage()->read($id);
        if (YII_DEBUG) {
            Yii::trace('Session data was served: "' . $data. '"');
        }
        return $data === false ? '' : $data;
    }

    /**
     * Session write handler.
     *
     * @param string $id   session ID
     * @param string $data session data
     *
     * @return boolean whether session write is successful
     */
    public function writeSession($id, $data)
    {
        if ($this->getIsLocked($id)) {
            if (YII_DEBUG) {
                Yii::trace(
                'Session "' . $id . '" doesn\'t writed because it\'s locked for writing data: ' . CVarDumper::dumpAsString($data)
                );
            }
            return true;
        }
        if ($this->_lockOnWrite) {
            if ($this->lockSessionWrite(true, $this->_lockOnWrite, $id)) {
                if (YII_DEBUG) {
                    Yii::trace(
                    'Session "' . $id . '" was locked for writing. Latest data: ' . CVarDumper::dumpAsString($data)
                    );
                }
            }
        }
        $userId = Yii::app()->user->id;
        try {
            $expire = time() + $this->getTimeout();
            $storage = $this->getSessionStorage();
            if (YII_DEBUG) {
                Yii::trace('Session data to be written: "' . $data. '"');
            }
            $attributes = array('data' => $data, 'expire' => $expire, 'user_id' => $userId);
            if ($storage->getExistsWithId($id)) {
                $storage->update($id, $attributes);
            } else {
                $storage->insert($id, $attributes);
            }
            if ($userId) {
                $this->updateLastVisitTime($userId);
            }
        } catch(Exception $e) {
            if (YII_DEBUG) {
                echo $e->getMessage();
            }
            return false;
        }
        return true;
    }

    /**
     * Session destroy handler.
     * Do not call this method directly.
     *
     * @param string $id session ID
     *
     * @return boolean whether session is destroyed successfully
     */
    public function destroySession($id)
    {
        return $this->getSessionStorage()->deleteById($id);
    }

    /**
     * Session GC (garbage collection) handler.
     * Do not call this method directly.
     *
     * @param integer $maxLifetime the number of seconds after which data will be seen as 'garbage' and cleaned up.
     *
     * @return boolean whether session is GCed successfully
     */
    public function gcSession($maxLifetime)
    {
        return $this->getSessionStorage()->deleteExpired(time());
    }

    /**
     * Gets path to session for write lock file
     *
     * @param string $id session ID
     *
     * @return string path to the file
     */
    private function _getLockFile($id)
    {
        if (!isset($this->_lockFilePath)) {
            $path = isset($this->lockFilesBasePath)
            ? $this->lockFilesBasePath
            : Yii::app()->getRuntimePath();
            $this->_lockFilePath = $path . '/' . get_class($this) . '_' . $id . '.lock';
        }
        return $this->_lockFilePath;
    }

    /**
     * Locks any other requests for session write
     *
     * @param string $id session ID
     *
     * @return boolean whether lock is created
     */
    public function lockSessionWrite($force = false, $duration = 3, $id = null)
    {
        $id = $id === null ? $this->getSessionID() : $id;
        if ($force) {
            if ($lock = fopen($this->_getLockFile($id), 'w')) {
                fprintf($lock, time() + $duration);
                fclose($lock);
                $this->_lockOnWrite = null;
                return true;
            }
            return false;
        } else {
            $this->unlockSessionWrite($id);
            $this->_lockOnWrite = $duration;
            return true;
        }
    }

    /**
     * Unlocks any other requests for session write
     *
     * @param string $id session ID
     *
     * @return boolean whether lock is removed
     */
    public function unlockSessionWrite($id = null)
    {
        $id = $id === null ? $this->getSessionID() : $id;
        return @unlink($this->_getLockFile($id));
    }

    /**
     * Returns whether session with given ID locked for writes
     *
     * @param string $id session ID
     *
     * @return boolean whether session locked
     */
    public function getIsLocked($id = null)
    {
        $id = $id === null ? $this->getSessionID() : $id;
        $path = $this->_getLockFile($id);
        if (file_exists($path) && ($expire = @file_get_contents($path))) {
            if (time() <= $expire && $this->evaluateLockDependency()) {
                return true;
            } else {
                $this->unlockSessionWrite($id);
                return false;
            }
        }
        return false;
    }

    /**
     * Evaluates locking session additional dependency
     * 
     * @return boolean whether session should be locked on write
     */
    protected function evaluateLockDependency()
    {
        return (bool)$this->evaluateExpression(
            $this->lockDependency, array('session' => $this)
        );
    }

    /**
     * Returns whether any session exists for given $userId
     *
     * @param integer|array $userId user ID or user ID array
     *
     * @return array session existing list for given user IDs
     */
    public function getSessionsExists($userId)
    {
        return $this->getSessionStorage()->getExistsWithUserId($userId);
    }

    /**
     * Updates last visit time for selected user. New value should be replaced
     * by current time value.
     *
     * @param integer $userId selected user
     *
     * @return void
     */
    protected function updateLastVisitTime($userId)
    {
        if (empty($userId)) {
            return;
        }
        $sql = 'UPDATE user_status SET last_visit_time = NOW() WHERE user_id = :userId';
        $this->getAccountsDbConnection()
        ->createCommand($sql)
        ->bindValue(':userId', $userId)
        ->execute();
    }
}