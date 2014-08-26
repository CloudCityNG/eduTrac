<?php namespace eduTrac\Classes\Models;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Role Model
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
use \eduTrac\Classes\Libraries\Logs;
use \eduTrac\Classes\Libraries\Hooks;
use \eduTrac\Classes\Libraries\Cookies;
class RoleModel {
	
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
                            //Logs::writeLog('Modified','Roles',$personID,$this->_auth->getPersonField('uname'));
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
                            //Logs::writeLog('Modified','Permissions',$personID,$this->_auth->getPersonField('uname'));
                            DB::inst()->query($strSQL);
                        }
                    }
                break;
            }
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function editSaveRole($data) {
        $roleid = $data['roleID'];
        $roleName = $data['roleName'];
        
        if (isset($data['action'])) {
            $strSQL = DB::inst()->query( sprintf("REPLACE INTO `role` SET `ID` = %u, `roleName` = '%s'",$roleid,$roleName ) ) or die(DB::inst()->is_error());
            if ($strSQL->rowCount() > 1)
            {
                $roleID = $roleid;
            } else {
                $roleID = DB::inst()->lastInsertId();
            }
            foreach ($_POST as $k => $v)
            {
                if (substr($k,0,5) == "perm_")
                {
                    $permID = str_replace("perm_","",$k);
                    if ($v == 'X')
                    {
                        $strSQL = sprintf("DELETE FROM `role_perms` WHERE `roleID` = %u AND `permID` = %u",$roleID,$permID);
                        DB::inst()->query($strSQL);
                        continue;
                    }
                    $strSQL = sprintf("REPLACE INTO `role_perms` SET `roleID` = %u, `permID` = %u, `value` = %u, `addDate` = '%s'",$roleID,$permID,$v,date ("Y-m-d H:i:s"));
                    DB::inst()->query($strSQL);
                }
            }
        }
        /* Write to logs */
        //Logs::writeLog('Modified','Role',$roleName,$this->_auth->getPersonField('uname'));
        redirect(BASE_URL . 'role/');
    }
	
	public function runRole($data) {
        $roleID = $data['roleID'];
        $roleName = $data['roleName'];
		$rolePerm = Hooks::maybe_serialize($data['permission']);
		
        $strSQL = DB::inst()->query( sprintf("REPLACE INTO `role` SET `ID` = %u, `roleName` = '%s', `permission` = '%s'",$roleID,$roleName,$rolePerm ) );
        /* Write to logs */
        //Logs::writeLog('Modified','Role',$roleName,$this->_auth->getPersonField('uname'));
        redirect(BASE_URL . 'role/');
    }
    
    public function deleteRole($data) {
        $id = $data['roleID'];
        
        if (isset($data['delRole'])) :
            
            $strSQL = sprintf("DELETE FROM `role` WHERE `ID` = '%u' LIMIT 1",$id);
            DB::inst()->query($strSQL);
            $strSQL = sprintf("DELETE FROM `person_roles` WHERE `roleID` = '%u'",$id);
            DB::inst()->query($strSQL);
            $strSQL = sprintf("DELETE FROM `role_perms` WHERE `roleID` = '%u'",$id);
            DB::inst()->query($strSQL);
        endif;
        /* Write to logs */
        //Logs::writeLog('Delete','Role',$id,$this->_auth->getPersonField('uname'));
    }
	
	public function __destruct() {
		DB::inst()->close();
	}
	
}