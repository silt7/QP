<?php
/**
 * ISessionStorage interface file
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
 * ISessionStorage is the interface which describes functionality of any session storage.
 *
 * @category   Packages
 * @package    Ext.component
 * @subpackage Ext.component.session
 * @author     Evgeniy Marilev <marilev@jviba.com>
 * @copyright  2013 JVIBA
 * @license    http://www.gnu.org/licenses/lgpl.html LGPL
 * @link       http://jviba.com/packages/php/docs
 */
interface ISessionStorage
{
    /**
     * Creates session storage
     * 
     * @return boolean whether storage creted successfully or exists
     */
    public function create();
    
    /**
     * Returns whether session with given ID exists in storage
     *
     * @param string $id session ID
     *
     * @return boolean whether session exists
     */
    public function getExistsWithId($id);
    
    /**
     * Returns whether sessions for given user IDs list are exist in storage
     *
     * @param integer|array $userId user ID or user ID array
     * 
     * @return array session existing list for given user IDs
     */
    public function getExistsWithUserId($userId);
    
    /**
     * Reads session data from the storage
     * 
     * @param string $id session ID
     * 
     * @return array session record
     */
    public function read($id);
    
    /**
     * Insert new session attributes into the storage
     * 
     * @param string  $id         session ID
     * @param array   $attributes session attributes. Includes: data, expire, user_id.
     * 
     * @return boolean whether session data successfully writed
     */
    public function insert($id, $attributes);
    
    /**
     * Updates existing session attributes in the storage.
     * Can be used in two scenarios:
     *  full update of data, expire and user_id. $attributes given are: data, expire, user_id.
     *  session ID update. $attributes contain only the new session ID
     *
     * @param string  $id         session ID
     * @param array   $attributes session attributes. Includes: data, expire, user_id.
     *
     * @return boolean whether session data successfully writed
     */
    public function update($id, $attributes);
    
    /**
     * Deletes session with given ID from storage
     * 
     * @param string $id session ID
     * 
     * @return boolean whether session successfully removed
     */
    public function deleteById($id);
    
    /**
     * Deletes sessions which was expired on the given timestamp
     *
     * @param integer $expireTime expire timestamp
     *
     * @return void
     */
    public function deleteExpired($expireTime);
}