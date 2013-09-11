<?php namespace eduTrac\Classes\Libraries;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
use \eduTrac\Classes\Core\DB;
use \eduTrac\Classes\Libraries\Hooks;
/**
 * Cookies Class
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
 * @since       1.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

class Cookies {
	
	public function __construct() {}
	
	/**
	 * Cookie Name
	 *
	 * @since 1.0.0
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
	 * @since 1.0.o
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
	 * @since 1.0.0
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
        
        $bind = array( ":data" => $vars['data'] );
		
        $sql = DB::inst()->select( "person","uname = :data","","*",$bind );
        foreach($sql as $r) {
            return $r[$field];
        }
	}
	
	/**
	 * Verify Person's Username
	 *
	 * @since 1.0.0
	 * @return bool Returns true if the person's username exists in the database.
	 * 
	 */
	public function verifyPerson() {
		$vars = array();
		parse_str($this->getCookieName(), $vars);
		
		if(!isset($vars['data'])) {
			return NULL;
		}
        
        $bind = array( ":data" => $vars['data'] );
		
        $sql = DB::inst()->select( "person","uname = :data","","*",$bind );
        foreach( $sql as $r ) {
            $array[] = $r;
        }
		
		if($r['uname'] == $vars['data']) {
			return true;
		}
	}
	
	/**
	 * Checks if user is logged in.
	 *
	 * @since 1.0.0
	 * @return mixed Returns true if cookie hashes exist.
	 * 
	 */ 
	public function isUserLoggedIn() {
		if($this->verifyPerson() && $this->getCookieID()) {
			return true;
		} else {
			return false;
		}
		Hooks::add_action('init','isUserLoggedIn');
	}
	
	/**
	 * Returns cookie domain
	 *
	 * @since 1.0.0
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