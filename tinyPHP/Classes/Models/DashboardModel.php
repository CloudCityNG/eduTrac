<?php namespace tinyPHP\Classes\Models;
/**
 *
 * Dashboard Model
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
use \tinyPHP\Classes\Libraries\Log;
use \tinyPHP\Classes\Libraries\Hooks;
use \tinyPHP\Classes\Libraries\Cookies;
class DashboardModel {
	
	private $_auth;
    private $_log;
	
	public function __construct() {
		$this->_auth = new Cookies;
        $this->_log = new Log;
	}
	
	public function search($data) {
		$acro = $data['screen'];
		$screen = explode(" ", $acro);
        $bind = array( ":code" => $screen[0] );
        $q = DB::inst()->select( "screen","code = :code LIMIT 1","","*",$bind );
        foreach($q as $r) {
            $array[] = $r;
        }
        
		if(!$r['relativeURL']) {
			redirect( BASE_URL . 'error/screen_error?code=' . $screen[0] );
		} else {
			redirect( BASE_URL . $r['relativeURL'] );
		}
	}
	
	/**
	 * Logs the user out and unsets cookie and database auth_token
	 *
	 * @since 1.0
	 * @return bool True if called
	 * 
	 */
	public function logout() {
	    session_start();
		$uname = $this->_auth->getPersonField('uname');
        $update = array( "auth_token" => 'NULL' );
        $bind = array( ":uname" => $uname );
        
        DB::inst()->update( "person", $update, "uname = :uname", $bind );
		
		setcookie("et_cookname", '', time()-Hooks::get_option('cookieexpire'), Hooks::get_option('cookiepath'), $this->_auth->cookieDomain());
      	setcookie("et_cookid", '', time()-Hooks::get_option('cookieexpire'), Hooks::get_option('cookiepath'), $this->_auth->cookieDomain());
        unset($_SESSION['id']);
		/* Purge log entries that are greater than 30 days old. */
		//$this->_log->purgeLog();
		/* Purges system error logs greater than 30 days old. */
		//Logs::purgeErrLog();
		redirect( BASE_URL );
	}
	
	public function __destruct() {
		DB::inst()->close();
	}
	
}