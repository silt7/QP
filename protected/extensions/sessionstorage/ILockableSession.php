<?php
/**
 * ILockableSession interface
 *
 * PHP version 5
 *
 * @category   Packages
 * @package    Module.userStatus
 * @subpackage Module.userStatus.interface
 * @author     Dmitry Cherepovsky <cherep@jviba.com>
 * @license    http://www.gnu.org/licenses/lgpl.html LGPL
 * @link       http://jviba.com/display/PhpDoc
 */

/**
 * ILockableSession provides interface for custom session classes which should
 * be able to lock and unlock sessions to prevent dirty write from different
 * requests to the same session
 *
 * PHP version 5
 *
 * @category   Packages
 * @package    Module.userStatus
 * @subpackage Module.userStatus.interface
 * @author     Dmitry Cherepovsky <cherep@jviba.com>
 * @license    http://www.gnu.org/licenses/lgpl.html LGPL
 * @link       http://jviba.com/display/PhpDoc
 */
interface ILockableSession
{
    /**
     * Unlocks any other requests for session write
     *
     * @param string $id session ID
     *
     * @return boolean whether lock is removed
     */
    public function unlockSessionWrite($id = null);

    /**
     * Locks any other requests for session write
     *
     * @param string $id session ID
     *
     * @return boolean whether lock is created
     */
    public function lockSessionWrite($force = false, $duration = 3, $id = null);

    /**
     * Returns whether session with given ID locked for writes
     *
     * @param string $id session ID
     *
     * @return boolean whether session locked
     */
    public function getIsLocked($id = null);
}