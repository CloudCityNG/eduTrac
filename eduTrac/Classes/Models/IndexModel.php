<?php namespace eduTrac\Classes\Models;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * User Model
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

use \eduTrac\Classes\Core\DB;
use \eduTrac\Classes\Libraries\Hooks;
use \eduTrac\Classes\Libraries\Logs;
use \eduTrac\Classes\Libraries\Cookies;
class IndexModel {
	
	private $_salt;
	private $_enc;
	private $_auth;
	private $_val;
	private $_email;
	
	public function __construct() {
		$this->_auth = new Cookies;
		$this->_val = new \eduTrac\Classes\Core\Val();
		$this->_email = new \eduTrac\Classes\Libraries\Email();
		
		$this->_enc = rand(22,999999*1000000);
		$this->_salt = substr(hash('sha512',$this->_enc),0,22);
	}
	
	public function runLogin($data) {
        $array = [];
		$uname = $data['uname'];
		$pass = $data['password'];
        $bind = array( ":uname" => $uname );
		
		$cookie = sprintf("data=%s&auth=%s", urlencode($uname), urlencode(et_hash_cookie($uname.$pass)));
		$mac = hash_hmac("sha512", $cookie, $this->_enc);
		$auth = $cookie . '&digest=' . urlencode($mac);
		
        $q = DB::inst()->query( "SELECT 
                        a.personID,
                        a.password 
                    FROM 
                        person a 
                    LEFT JOIN 
                        faculty b 
                    ON 
                        a.personID = b.facID 
                    LEFT JOIN 
                        staff c 
                    ON 
                        a.personID = c.staffID 
                    LEFT JOIN 
                        student d 
                    ON 
                        a.personID = d.stuID 
                    WHERE 
                        (a.uname = :uname 
                    AND 
                        (b.status = 'A' 
                    OR 
                        c.status = 'A' 
                    OR 
                        d.status = 'A'))",
                    $bind 
        );
        foreach($q as $r) {
            $array[] = $r;
        }
		
		if(et_check_password( $pass, $r['password'], $r['personID'] )) {
			if($data['rememberme']) {				
				/* Now we can set our login cookies. */
				setcookie("et_cookname", $auth, time()+Hooks::get_option('cookieexpire'), Hooks::get_option('cookiepath'), $this->_auth->cookieDomain());
      			setcookie("et_cookid", et_hash_cookie($r['personID']), time()+Hooks::get_option('cookieexpire'), Hooks::get_option('cookiepath'), $this->_auth->cookieDomain());
   			} else {				
   				/* Now we can set our login cookies. */
   				setcookie("et_cookname", $auth, time()+86400, "/", $this->_auth->cookieDomain());
      			setcookie("et_cookid", et_hash_cookie($r['personID']), time()+86400, "/", $this->_auth->cookieDomain());
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