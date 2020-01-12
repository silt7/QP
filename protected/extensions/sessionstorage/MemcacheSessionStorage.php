<?php
/**
 * MemcacheSessionStorage class file
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
 * MemcacheSessionStorage is the class which implementation of session storage in
 * the memcache.
 *
 * @category   Packages
 * @package    Ext.component
 * @subpackage Ext.component.session
 * @author     Evgeniy Marilev <marilev@jviba.com>
 * @copyright  2013 JVIBA
 * @license    http://www.gnu.org/licenses/lgpl.html LGPL
 * @link       http://jviba.com/packages/php/docs
 */
class MemcacheSessionStorage implements ISessionStorage
{
    /**
     * The ID of a {@link CMemCache} application component
     * @var string
     */
    public $componentID = 'cache';
    
    /**
     * Memcache keys prefix name used for storing sessions
     * @var string
     */
    public $keyPrefix = 'yii_session';
    
    /**
     * The memcache component instance
     * @var CMemCache
     */
    private $_cache;
    
    /**
     * (non-PHPdoc)
     * @see ISessionStorage::create()
     */
    public function create()
    {
        return true;
    }
    
    /**
     * Resolves session key used for storing session data
     * 
     * @param string $id session ID
     * 
     * @return string session key
     */
    protected function resolveSessionKey($id)
    {
        return $this->keyPrefix . $id;
    }
    
    /**
     * (non-PHPdoc)
     * @see ISessionStorage::getExistsWithId()
     */
    public function getExistsWithId($id)
    {
        return $this->getCache()->get($this->resolveSessionKey($id));
    }
    
    /**
     * (non-PHPdoc)
     * @see ISessionStorage::getExistsWithUserId()
     */
    public function getExistsWithUserId($userId)
    {
        throw new Exception('Not implemented yet.');
    }
    
    /**
     * (non-PHPdoc)
     * @see ISessionStorage::read()
     */
    public function read($id)
    {
        if ($row = $this->getCache()->get($this->resolveSessionKey($id))) {
            return isset($row['data']) ? $row['data'] : false;
        }
        return false;
    }
    
    /**
     * (non-PHPdoc)
     * @see ISessionStorage::insert()
     */
    public function insert($id, $attributes)
    {
        return $this->getCache()->add(
            $this->resolveSessionKey($id), $attributes, $attributes['expire'] - time()
        );
    }
    
    /**
     * (non-PHPdoc)
     * @see ISessionStorage::update()
     */
    public function update($id, $attributes)
    {
        $expire = $attributes['expire'] - time();
        if (isset($attributes['id'])) {
            if ($data = $this->read($id)) {
                $this->deleteById($id);
                $newId = $attributes['id'];
                unset($attributes['id']);
                return $this->insert($this->resolveSessionKey($newId), $attributes, $expire);
            }
            return false;
        } else {
            return $this->getCache()->set($this->resolveSessionKey($id), $attributes, $expire);
        }
    }
    
    /**
     * (non-PHPdoc)
     * @see ISessionStorage::delete()
     */
    public function deleteById($id)
    {
        return $this->getCache()->delete($this->resolveSessionKey($id));
    }
    
    /**
     * (non-PHPdoc)
     * @see ISessionStorage::deleteExpired()
     */
    public function deleteExpired($expireTime)
    {
        //memcache deletes all sessions itself
    }
    
    /**
     * Returns the actual cache component instance used for storing sessions
     * 
     * @return CMemCache the memcache instance
     * @throws CException if {@link componentID} does not point to a valid application component.
     */
    protected function getCache()
    {
        if ($this->_cache !== null) {
            return $this->_cache;
        } elseif (($id = $this->componentID) !== null) {
            if (($cache = Yii::app()->getComponent($id)) instanceof CMemCache) {
                return $this->_cache = $cache;
            } else {
                throw new CException('
                    MemcacheSessionStorage.componentID "' . $id . '" is invalid.
                    Please make sure it refers to the ID of a CMemCache application component.'
                );
            }
        }
    }
}