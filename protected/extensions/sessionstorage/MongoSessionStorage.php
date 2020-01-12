<?php
/**
 * MongoSessionStorage class file
 *
 * PHP version 5
 *
 * @category   Packages
 * @package    Ext.component
 * @subpackage Ext.component.session
 * @author     Evgeniy Marilev <marilev@jviba.com>
 * @copyright  2013 JVIBA
 * @license    http://www.gnu.org/licenses/lgpl.html LGPL
 * @link       http://jviba.com/packages/php/docs
 */
/**
 * MongoSessionStorage is the class which implementation of session storage in
 * the mongoDB.
 *
 * @category   Packages
 * @package    Ext.component
 * @subpackage Ext.component.session
 * @author     Evgeniy Marilev <marilev@jviba.com>
 * @copyright  2013 JVIBA
 * @license    http://www.gnu.org/licenses/lgpl.html LGPL
 * @link       http://jviba.com/packages/php/docs
 */
class MongoSessionStorage implements ISessionStorage
{
    /**
     * The ID of a {@link CDbConnection} application component
     * @var string
     */
    public $connectionID = 'db';
    
    /**
     * Collection name used for storing sessions in mongodb
     * @var string
     */
    public $collectionName = 'yii_session';
    
    /**
     * Which indexes should be used
     * @var array|false
     */
    public $useIndexes = array(
        'session_id', 'user_id', 'expire',
    );
    
    /**
     * The DB connection instance
     * @var CDbConnection
     */
    private $_db;
    
    /**
     * (non-PHPdoc)
     * @see ISessionStorage::create()
     */
    public function create()
    {
        if (!empty($this->useIndexes)) {
            $collection = $this->getDbCollection();
            foreach ($this->useIndexes as $index) {
                $collection->ensureIndex($index);
            }
        }
        return true;
    }
    
    /**
     * (non-PHPdoc)
     * @see ISessionStorage::getExistsWithId()
     */
    public function getExistsWithId($id)
    {
        return $this->getDbCollection()
                    ->findOne(array('session_id' => $id), array('session_id' => true)) != null;
    }
    
    /**
     * (non-PHPdoc)
     * @see ISessionStorage::getExistsWithUserId()
     */
    public function getExistsWithUserId($userId)
    {
        if (empty($userId)) {
            return array();
        }
        if (is_array($userId)) {
            $criteria = array('user_id' => array('$in' => $userId));
        } else {
            $criteria = array('user_id' => array('$eq' => $userId));
        }
        $users = $this->getDbCollection()->find($criteria, array('user_id' => true));
        $ret = array();
        foreach ($users as $user) {
            $ret[] = $user['user_id'];
        }
        unset($users);
        return array_unique($ret);
    }
    
    /**
     * (non-PHPdoc)
     * @see ISessionStorage::read()
     */
    public function read($id)
    {
        $ret = $this->getDbCollection()
                    ->findOne(array('session_id' => $id), array('data' => true));
        return isset($ret['data']) ? $ret['data'] : false;
    }
    
    /**
     * (non-PHPdoc)
     * @see ISessionStorage::insert()
     */
    public function insert($id, $attributes)
    {
        $attributes['session_id'] = $id;
        $this->getDbCollection()->insert($attributes);
        return true;
    }
    
    /**
     * (non-PHPdoc)
     * @see ISessionStorage::update()
     */
    public function update($id, $attributes)
    {
        if (isset($attributes['id'])) {
            $attributes['session_id'] = $attributes['id'];
            unset($attributes['id']);
        }
        $this->getDbCollection()->update(
            array('session_id' => $id),
            array('$set' => $attributes)
        );
        return true;
    }
    
    /**
     * (non-PHPdoc)
     * @see ISessionStorage::delete()
     */
    public function deleteById($id)
    {
        $this->getDbCollection()->remove(array('session_id' => $id));
        return true;
    }
    
    /**
     * (non-PHPdoc)
     * @see ISessionStorage::deleteExpired()
     */
    public function deleteExpired($expireTime)
    {
        $collection = $this->getDbCollection();
        $collection->remove(array('expire' => array('$lt' => $expireTime)));
    }
    
    /**
     * Returns the active database collection instance used for storing sessions
     * 
     * @return MongoCollection the mongoDb collection instance
     * @throws CException if {@link connectionID} does not point to a valid application component.
     */
    protected function getDbCollection()
    {
        if ($this->_collection !== null) {
            return $this->_collection;
        } elseif (($id = $this->connectionID) !== null) {
            if (($db = Yii::app()->getComponent($id)) instanceof EMongoDB) {
                return $this->_collection = $db->getDbInstance()->selectCollection($this->collectionName);
            } else {
                throw new CException('
                    MongoSessionStorage.connectionID "' . $id . '" is invalid.
                    Please make sure it refers to the ID of a EMongoDB application component.'
                );
            }
        }
    }
}