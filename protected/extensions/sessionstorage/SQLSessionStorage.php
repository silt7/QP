<?php
/**
 * SQLSessionStorage class file
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
 * SQLSessionStorage is the class which implementation of session storage in
 * the SQL database.
 *
 * @category   Packages
 * @package    Ext.component
 * @subpackage Ext.component.session
 * @author     Evgeniy Marilev <marilev@jviba.com>
 * @copyright  2013 JVIBA
 * @license    http://www.gnu.org/licenses/lgpl.html LGPL
 * @link       http://jviba.com/packages/php/docs
 */
class SQLSessionStorage implements ISessionStorage
{
    /**
     * The ID of a {@link CDbConnection} application component
     * @var string
     */
    public $connectionID = 'db';
    
    /**
     * Table name used for storing sessions in SQL database
     * @var string
     */
    public $tableName = 'yii_session';
    
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
        $db = $this->getDbConnection();
        switch ($db->getDriverName()) {
            case 'mysql':
                $blob = 'LONGBLOB';
                break;
            case 'pgsql':
                $blob = 'BYTEA';
                break;
            default:
                $blob = 'BLOB';
        }
        $sql = "
        CREATE TABLE $this->tableName
        (
            id CHAR(32) PRIMARY KEY,
            user_id INT UNSIGNED NULL DEFAULT NULL,
            expire INTEGER,
            data {$blob},
            KEY `fk_session_user_idx` (`user_id`),
            KEY `fk_session_expire_idx` (`expire`)
        )";
        $db->createCommand($sql)->execute();
        return true;
    }
    
    /**
     * (non-PHPdoc)
     * @see ISessionStorage::getExistsWithId()
     */
    public function getExistsWithId($id)
    {
        $sql = "SELECT 1 FROM {$this->tableName} WHERE id=:id";
        return $this->getDbConnection()
                    ->createCommand($sql)
                    ->bindValue(':id', $id)
                    ->queryScalar() != false;
    }
    
    /**
     * (non-PHPdoc)
     * @see ISessionStorage::getExistsWithUserId()
     */
    public function getExistsWithUserId($userId)
    {
        $criteria = new CDbCriteria();
        $criteria->compare('user_id', $userId);
        $criteria->select = 'DISTINCT(user_id) as user_id';
        return $this->getDbConnection()
                    ->getCommandBuilder()
                    ->createFindCommand($this->tableName, $criteria)
                    ->queryAll();
    }
    
    /**
     * (non-PHPdoc)
     * @see ISessionStorage::read()
     */
    public function read($id)
    {
        return $this->getDbConnection()
                    ->createCommand()
                    ->select('data')
                    ->from($this->tableName)
                    ->where('id=:id', array(':id' => $id))
                    ->queryScalar();
    }
    
    /**
     * (non-PHPdoc)
     * @see ISessionStorage::insert()
     */
    public function insert($id, $attributes)
    {
        $attributes['id'] = $id;
        return (bool)$this->getDbConnection()
                          ->getCommandBuilder()
                          ->createInsertCommand($this->tableName, $attributes)
                          ->execute();
    }
    
    /**
     * (non-PHPdoc)
     * @see ISessionStorage::update()
     */
    public function update($id, $attributes)
    {
        $criteria = new CDbCriteria();
        $criteria->compare('id', $id);
        return (bool)$this->getDbConnection()
                          ->getCommandBuilder()
                          ->createUpdateCommand($this->tableName, $attributes, $criteria)
                          ->execute();
    }
    
    /**
     * (non-PHPdoc)
     * @see ISessionStorage::delete()
     */
    public function deleteById($id)
    {
        return $this->getDbConnection()
                    ->createCommand()
                    ->delete($this->tableName, 'id=:id', array(':id' => $id));
    }
    
    /**
     * (non-PHPdoc)
     * @see ISessionStorage::deleteExpired()
     */
    public function deleteExpired($expireTime)
    {
        $this->getDbConnection()
             ->createCommand()
             ->delete($this->tableName, 'expire<:expire', array(':expire' => $expireTime));
    }
    
    /**
     * Returns the active database connection instance used for storing sessions
     * 
     * @return CDbConnection the DB connection instance
     * @throws CException if {@link connectionID} does not point to a valid application component.
     */
    protected function getDbConnection()
    {
        if ($this->_db !== null) {
            return $this->_db;
        } elseif (($id = $this->connectionID) !== null) {
            if (($this->_db = Yii::app()->getComponent($id)) instanceof CDbConnection) {
                return $this->_db;
            } else {
                throw new CException('
                    SQLSessionStorage.connectionID "' . $id . '" is invalid.
                    Please make sure it refers to the ID of a CDbConnection application component.'
                );
            }
        }
    }
}