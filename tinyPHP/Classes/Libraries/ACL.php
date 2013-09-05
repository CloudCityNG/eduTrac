<?php namespace tinyPHP\Classes\Libraries;
/**
 *
 * Access Level Control Class
 *  
 * PHP 5
 *
 * eduTrac(tm) : Student Information System (http://www.7mediaws.org/)
 * Copyright (C) 2013 Joshua Parker
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
 * @since eduTrac(tm) v 1.0
 * @license GNU General Public License v3 (http://www.gnu.org/licenses/gpl-3.0.html)
 */

if ( ! defined('BASE_PATH' ) ) exit('No direct script access allowed');

class ACL {
	
	/**
     * Stores the permissions for the user
     *
     * @access public
     * @var array
     */		
	public $perms = array();
	
	/**
     * Stores the ID of the current user
     *
     * @access public
     * @var integer
     */
	public $personID = 0;
	
	/**
     * Stores the roles of the current user
     *
     * @access public
     * @var array
     */
	public $userRoles = array();
    
    private $_auth;
    
    private $_db;
	
	public function __construct($personID = '') {
	    session_start();
		$this->_auth = new \tinyPHP\Classes\Libraries\Cookies();
        $this->_db = new \tinyPHP\Classes\Core\DB;
		
		if ($personID != '') {  
            $this->personID = floatval($personID);  
        } else {  
            //$this->personID = floatval($this->_auth->getPersonField('personID'));
            $this->personID = floatval($_SESSION['id']); 
        }  
        $this->userRoles = $this->getUserRoles('ids');  
        $this->buildACL();
	}
	
    public function ACL($personID='')  {  
        $this->__construct($personID);  
    }
	
	public function buildACL() {
		//first, get the rules for the user's role
		if (count($this->userRoles) > 0) {
			$this->perms = array_merge($this->perms,$this->getRolePerms($this->userRoles));
		}
		//then, get the individual user permissions
		$this->perms = array_merge($this->perms,$this->getUserPerms($this->personID));
	}
	
	public function getPermKeyFromID($permID) {
		$strSQL = "SELECT `permKey` FROM `permission` WHERE `ID` = " . floatval($permID) . " LIMIT 1";
		$data = $this->_db->query($strSQL);
		$row = $data->fetch();
		return $row[0];
	}
	
	public function getPermNameFromID($permID) {
		$strSQL = "SELECT `permName` FROM `permission` WHERE `ID` = " . floatval($permID) . " LIMIT 1";
		$data = $this->_db->query($strSQL);
		$row = $data->fetch();
		return $row[0];
	}
	
	public function getRoleNameFromID($roleID) {
		$strSQL = "SELECT `roleName` FROM `role` WHERE `ID` = " . floatval($roleID) . " LIMIT 1";
		$data = $this->_db->query($strSQL);
		$row = $data->fetch();
		return $row[0];
	}
	
	public function getUserRoles() {
		$strSQL = "SELECT * FROM `person_roles` WHERE `personID` = " . floatval($this->personID) . " ORDER BY `addDate` ASC";
		$data = $this->_db->query($strSQL);
		$resp = array();
		while($row = $data->fetch())
		{
			$resp[] = $row['roleID'];
		}
		return $resp;
	}
	
	public function getAllRoles($format='ids') {
		$format = strtolower($format);
		$strSQL = "SELECT * FROM `role` ORDER BY `roleName` ASC";
		$data = $this->_db->query($strSQL);
		$resp = array();
		while($row = $data->fetch())
		{
			if ($format == 'full')
			{
				$resp[] = array("ID" => $row['ID'],"Name" => $row['roleName']);
			} else {
				$resp[] = $row['ID'];
			}
		}
		return $resp;
	}
	
	public function getAllPerms($format='ids') {		
		$format = strtolower($format);
		$strSQL = "SELECT * FROM `permission` ORDER BY `permName` ASC";
		$data = $this->_db->query($strSQL);
		$resp = array();
		while($row = $data->fetch()) {
			if ($format == 'full') {
				$resp[$row['permKey']] = array('ID' => $row['ID'], 'Name' => $row['permName'], 'Key' => $row['permKey']);
			} else {
				$resp[] = $row['ID'];
			}
		}
		return $resp;
	}

	public function getRolePerms($role) {
		if (is_array($role)) {
			$roleSQL = "SELECT * FROM `role_perms` WHERE `roleID` IN (" . implode(",",$role) . ") ORDER BY `ID` ASC";
		} else {
			$roleSQL = "SELECT * FROM `role_perms` WHERE `roleID` = " . floatval($role) . " ORDER BY `ID` ASC";
		}
		$data = $this->_db->query($roleSQL);
		$perms = array();
		while($row = $data->fetch()) {
			$pK = strtolower($this->getPermKeyFromID($row['permID']));
			if ($pK == '') { continue; }
			if ($row['value'] === '1') {
				$hP = true;
			} else {
				$hP = false;
			}
			$perms[$pK] = array('perm' => $pK,'inheritted' => true,'value' => $hP,'Name' => $this->getPermNameFromID($row['permID']),'ID' => $row['permID']);
		}
		return $perms;
	}
	
	public function getUserPerms($personID) {
		$strSQL = "SELECT * FROM `person_perms` WHERE `personID` = " . floatval($personID) . " ORDER BY `addDate` ASC";
		$data = $this->_db->query($strSQL);
		$perms = array();
		while($row = $data->fetch()) {
			$pK = strtolower($this->getPermKeyFromID($row['permID']));
			if ($pK == '') { continue; }
			if ($row['value'] == '1') {
				$hP = true;
			} else {
				$hP = false;
			}
			$perms[$pK] = array('perm' => $pK,'inheritted' => false,'value' => $hP,'Name' => $this->getPermNameFromID($row['permID']),'ID' => $row['permID']);
		}
		return $perms;
	}
	
	public function userHasRole($roleID) {
		foreach($this->userRoles as $k => $v) {
			if (floatval($v) === floatval($roleID)) {
				return true;
			}
		}
		return false;
	}
	
	public function hasPermission($permKey) {
		$permKey = strtolower($permKey);
		if (array_key_exists($permKey,$this->perms)) {
			if ($this->perms[$permKey]['value'] === '1' || $this->perms[$permKey]['value'] === true) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	public function getUsername($personID) {
		$strSQL = $this->_db->select( 'person', 'personID = "' . floatval($personID) . '"', null, 'uname LIMIT 1' );
		$row = $strSQL->fetch();
		return $row[0];
	}
	
	public function __destruct() {
		$this->_db->close();
	}
}