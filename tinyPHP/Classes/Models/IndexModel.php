<?php namespace tinyPHP\Classes\Models;
/**
 *
 * User Model
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
 * @license GNU General Public License v3 (http://www.gnu.org/licenses/gpl-3.0.html)
 * @since eduTrac(tm) v 1.0.0
 * @package Model
 */

if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');

use \tinyPHP\Classes\Core\DB;
use \tinyPHP\Classes\Libraries\Hooks;
use \tinyPHP\Classes\Libraries\Logs;
use \tinyPHP\Classes\Libraries\Cookies;
class IndexModel {
	
	private $_salt;
	private $_enc;
	private $_auth;
	private $_val;
	private $_email;
	
	public function __construct() {
		$this->_auth = new Cookies;
		$this->_val = new \tinyPHP\Classes\Core\Val();
		$this->_email = new \tinyPHP\Classes\Libraries\Email();
		
		$this->_enc = rand(22,999999*1000000);
		$this->_salt = substr(hash('sha512',$this->_enc),0,22);
	}
	
	public function runLogin($data) {
	    session_start();		
		$uname = $data['uname'];
		$pass = $data['password'];
        $bind = array( ":uname" => $uname );
		
		$cookie = sprintf("data=%s&auth=%s", urlencode($uname), urlencode(et_hash_cookie($uname.$pass)));
		$mac = hash_hmac("sha512", $cookie, $this->_enc);
		$auth = $cookie . '&digest=' . urlencode($mac);
        
        $update = array( "auth_token" => $auth );
        DB::inst()->update( "person", $update, "uname = :uname", $bind );
		
        $q = DB::inst()->select( "person","uname = :uname","","personID,auth_token,password",$bind );
        foreach($q as $r) {
            $array[] = $r;
        }
		
		if(et_check_password( $pass, $r['password'], $r['personID'] )) {
			if($data['rememberme']) {				
				/* Now we can set our login cookies. */
				setcookie("et_cookname", $r['auth_token'], time()+Hooks::get_option('cookieexpire'), Hooks::get_option('cookiepath'), $this->_auth->cookieDomain());
      			setcookie("et_cookid", et_hash_cookie($r['personID']), time()+Hooks::get_option('cookieexpire'), Hooks::get_option('cookiepath'), $this->_auth->cookieDomain());
                $_SESSION['id'] = $r['personID'];
   			} else {				
   				/* Now we can set our login cookies. */
   				setcookie("et_cookname", $r['auth_token'], time()+86400, "/", $this->_auth->cookieDomain());
      			setcookie("et_cookid", et_hash_cookie($r['personID']), time()+86400, "/", $this->_auth->cookieDomain());
      			$_SESSION['id'] = $r['personID'];
   			}
			redirect( BASE_URL . 'dashboard/' );
		} else {
			redirect( BASE_URL );
			}
		
	}
    
    public function __destruct() {
        DB::inst()->close();
    }
	
}