<?php namespace eduTrac\Classes\Models;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Permission Model
 *  
 * PHP 5.4+
 *
 * eduTrac(tm) : Student Information System (http://www.7mediaws.org/)
 * @copyright (c) 2013 7 Media Web Solutions, LLC
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 3
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 * 
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License, version 3
 * @link        http://www.7mediaws.org/
 * @since       3.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

use \eduTrac\Classes\Core\DB;
use \eduTrac\Classes\Libraries\Hooks;
use \eduTrac\Classes\Libraries\Util;
class PermissionModel {
    
    private $_auth;
    private $_log;
	
	public function __construct() {
	    $this->_auth = new \eduTrac\Classes\Libraries\Cookies;
		$this->_log = new \eduTrac\Classes\Libraries\Log;
	}
	
	public function runRolePerm($data) {
        $personID = $data['personID'];      
        
        if (isset($_POST['action'])) {
            switch($_POST['action']) {
                case 'saveRoles':
                    foreach ($_POST as $k => $v) {
                        if (substr($k,0,5) == "role_") {
                            $roleID = str_replace("role_","",$k);
                            if ($v == '0' || $v == 'x') {
                                $strSQL = sprintf("DELETE FROM `person_roles` WHERE `personID` = %u AND `roleID` = %u",$personID,$roleID);
                            } else {
                                $strSQL = sprintf("REPLACE INTO `person_roles` SET `personID` = %u, `roleID` = %u, `addDate` = '%s'",$personID,$roleID,date ("Y-m-d H:i:s"));
                            }
                            /* Write to logs */
                            //Log::writeLog('Modified','Roles',$personID,$this->_auth->getPersonField('uname'));
                            DB::inst()->query($strSQL);
                        }
                    }
                    
                break;
                case 'savePerms':
                    foreach ($_POST as $k => $v) {
                        if (substr($k,0,5) == "perm_") {
                            $permID = str_replace("perm_","",$k);
                            if ($v == 'x') {
                                $strSQL = sprintf("DELETE FROM `person_perms` WHERE `personID` = %u AND `permID` = %u",$personID,$permID);
                            } else {
                                $strSQL = sprintf("REPLACE INTO `person_perms` SET `personID` = %u, `permID` = %u, `value` = %u, `addDate` = '%s'",$personID,$permID,$v,date ("Y-m-d H:i:s"));
                            }
                            /* Write to logs */
                            //Log::writeLog('Modified','Permissions',$personID,$this->_auth->getPersonField('uname'));
                            DB::inst()->query($strSQL);
                        }
                    }
                break;
            }
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function editSaveDeletePerm($data) {
        $permID = $data['permID'];
        $permName = $data['permName'];
        $permKey = Util::_trim($data['permKey']);
        
        if (isset($data['savePerm'])) {
            $strSQL = sprintf("REPLACE INTO `permission` SET `ID` = %u, `permName` = '%s', `permKey` = '%s'",$permID,$permName,$permKey);
            DB::inst()->query($strSQL);
        } elseif (isset($data['delPerm'])) {
            $strSQL = sprintf("DELETE FROM `permission` WHERE `ID` = %u LIMIT 1",$permID);
            DB::inst()->query($strSQL);
        }
        /* Write to logs */
        //Log::writeLog('Modified','Permissions',$permName,$this->_auth->getPersonField('uname'));
        redirect(BASE_URL . 'permission/');
    }
	
	public function __destruct() {
		DB::inst()->close();
	}
	
}