<?php namespace tinyPHP\Classes\Libraries;
/**
 *
 * Cookies Class
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

if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');

use \tinyPHP\Classes\Core\DB;
use \tinyPHP\Classes\Libraries\Hooks;

class Cookies {
	
	public function __construct() {}
	
	/**
	 * Cookie Name
	 *
	 * @since 1.0
	 * @return bool Returns true if set
	 * 
	 */ 
	public function getCookieName() {
		if(isset($_COOKIE['et_cookname'])) {
			return $_COOKIE['et_cookname'];
		}
	}
	
	/**
	 * Cookie ID
	 *
	 * @since 1.0
	 * @return bool Returns true if set
	 * 
	 */ 
	public function getCookieID() {
		if(isset($_COOKIE['et_cookid'])) {
			return $_COOKIE['et_cookid'];
		}
	}
	
	/**
	 * Retrieve user data
	 *
	 * @since 1.0
	 * @param string (required) $field User data to print from database.
	 * @return mixed
	 * 
	 */ 
	public function getPersonField($field) {
		$vars = array();
		parse_str($this->getCookieName(), $vars);
		
		if(!isset($vars['data'])) {
			return NULL;
		}
		
		$sql = DB::inst()->query( "SELECT * FROM person WHERE uname = '".$vars['data']."'" );
		$r = $sql->fetch(\PDO::FETCH_ASSOC);
		if($sql->rowCount() > 0) {
			return $r[$field];
		}
	}
	
	/**
	 * Verify Auth Token
	 *
	 * @since 1.1
	 * @return bool Returns true if an auth_token in the database matches the user's cookie.
	 * 
	 */
	public function verifyAuth() {
		$vars = array();
		parse_str($this->getCookieName(), $vars);
		
		if(!isset($vars['data'])) {
			return NULL;
		}
		
		$sql = DB::inst()->query( "SELECT * FROM person WHERE uname = '".$vars['data']."'" );
		$r = $sql->fetch(\PDO::FETCH_ASSOC);
		
		if($r['auth_token'] == $this->getCookieName()) {
			return true;
		}
	}
	
	/**
	 * Checkes if user is logged in.
	 *
	 * @since 1.0
	 * @return mixed Returns true if cookie hashes exist.
	 * 
	 */ 
	public function isUserLoggedIn() {
		if($this->verifyAuth() && $this->getCookieID()) {
			return true;
		} else {
			return false;
		}
		Hooks::add_action('init','isUserLoggedIn');
	}
	
	/**
	 * Returns cookie domain
	 *
	 * @since 1.0
	 * @return mixed
	 * 
	 */ 
	public function cookieDomain() {
		/* Use to set cookie session for domain. */
        $cookiedomain = $_SERVER['SERVER_NAME']; 
        $cookiedomain = str_replace('www.', '', $cookiedomain);
		return Hooks::apply_filter('cookie_domain', $cookiedomain);
	}

}