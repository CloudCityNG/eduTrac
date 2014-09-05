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
 * @since       3.0.0
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
		if(isset($_COOKIE['ET_COOKNAME'])) {
			return $_COOKIE['ET_COOKNAME'];
		}
	}
	
	/**
	 * Cookie ID
	 *
	 * @since 1.0.0
	 * @return bool Returns true if set
	 * 
	 */ 
	public function getCookieID() {
		if(isset($_COOKIE['ET_COOKID'])) {
			return $_COOKIE['ET_COOKID'];
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
            return _h($r[$field]);
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
		$vars = [];
		parse_str($this->getCookieName(), $vars);
		
		if(!isset($vars['data'])) {
			return NULL;
		}
        
        $bind = array( ":data" => $vars['data'] );
		
        $sql = DB::inst()->select( "person","uname = :data","","*",$bind );
        foreach( $sql as $r ) {
            $array[] = $r;
        }
		
		if(count($sql) > 0) {
    		if(_h($r['uname']) == $vars['data']) {
    			return true;
    		}
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
	
	/**
     * Retrieve requested field from person table 
	 * based on user's id.
     *
     * @since 3.0.2
     * @return mixed
     * 
     */
	public function getUserValue($id,$field) {
        $bind = [ ":id" => $id ];
        $q = DB::inst()->select( "person","personID = :id","",$field,$bind );
        foreach($q as $r) {
            return $r[$field];
        }
    }
	
	/**
     * Set the cookie
     *
     * @since 3.0.2
     * @return mixed
     * 
     */ 
    public function _setcookie($name,$value,$expire=COOKIE_EXPIRE,$path=COOKIE_PATH,$domain='',$secure=false,$httponly=false) {
        setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);
    }
    
    /**
     * Hash Hmac
     * 
     * @since 3.0.2
     * @return mixed
	 * 
     */
    public function hashHmac($uname) {
        $cookie = sprintf("data=%s&auth=%s", urlencode($uname), urlencode(et_hash_cookie($uname.\eduTrac\Classes\Libraries\ID::pass(12))));
        $mac = hash_hmac("sha512", $cookie, rand(22,999999*1000000));
        $auth = $cookie . '&digest=' . urlencode($mac);
        return $auth;
    }
	
	/**
     * Switch to a different user
     *
     * @since 3.0.2
     * @return mixed
     * 
     */ 
    public function _switchUserTo($id) {        
        if(isset($_COOKIE['ET_REMEMBER']) && $_COOKIE['ET_REMEMBER'] == 'rememberme') {
            $this->_setcookie("SWITCH_USERBACK", $this->getPersonField('personID'));
            $this->_setcookie("SWITCH_USERNAME", $this->getPersonField('uname'));
        } else {
            $this->_setcookie("SWITCH_USERBACK", $this->getPersonField('personID'), time()+86400);
            $this->_setcookie("SWITCH_USERNAME", $this->getPersonField('uname'), time()+86400);
        }
        
        $auth = $this->hashHmac($this->getUserValue($id,'uname'));
        
        /**
         * Delete the old cookies.
         */
        $this->_setcookie("ET_COOKNAME", '', time()-COOKIE_EXPIRE);
        $this->_setcookie("ET_COOKID", '', time()-COOKIE_EXPIRE);
        
        if(isset($_COOKIE['ET_REMEMBER']) && $_COOKIE['ET_REMEMBER'] == 'rememberme') {
            $this->_setcookie("ET_COOKNAME", $auth);
            $this->_setcookie("ET_COOKID", et_hash_cookie($id));
        } else {
            $this->_setcookie("ET_COOKNAME", $auth, time()+86400);
            $this->_setcookie("ET_COOKID", et_hash_cookie($id), time()+86400);
        }
    }
	
     /**
     * Switch back to the original user
     *
     * @since 3.0.2
     * @return mixed
     * 
     */ 
    public function _switchUserBack($id) {        
        if(isset($_COOKIE['ET_REMEMBER']) && $_COOKIE['ET_REMEMBER'] == 'rememberme') {
            $this->_setcookie("ET_COOKNAME", '', time()-COOKIE_EXPIRE);
            $this->_setcookie("ET_COOKID", '', time()-COOKIE_EXPIRE);
            $this->_setcookie("SWITCH_USERBACK", '', time()-COOKIE_EXPIRE);
            $this->_setcookie("SWITCH_USERNAME", '', time()-COOKIE_EXPIRE);
        } else {
            $this->_setcookie("ET_COOKNAME", '', time()-86400);
            $this->_setcookie("ET_COOKID", '', time()-86400);
            $this->_setcookie("SWITCH_USERBACK", '', time()-86400);
            $this->_setcookie("SWITCH_USERNAME", '', time()-86400);
        }
        
        $auth = $this->hashHmac($this->getUserValue($id,'uname'));
        
        if(isset($_COOKIE['ET_REMEMBER']) && $_COOKIE['ET_REMEMBER'] == 'rememberme') {
            $this->_setcookie("ET_COOKNAME", $auth);
            $this->_setcookie("ET_COOKID", et_hash_cookie($id));
        } else {
            $this->_setcookie("ET_COOKNAME", $auth, time()+86400);
            $this->_setcookie("ET_COOKID", et_hash_cookie($id), time()+86400);
        }
    }

}