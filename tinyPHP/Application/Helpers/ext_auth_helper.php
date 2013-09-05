<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * eGrades Auth Helper
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

use \tinyPHP\Classes\Libraries\Hooks;
use \tinyPHP\Classes\Core\DB;
 	
 	function is_admin() {
 		$auth = new \tinyPHP\Classes\Libraries\Cookies();
 		if($auth->getPersonField('type') == 'admin') {
 			return true;
 		} else {
 			return false;
 		}
		Hooks::add_action('init','is_admin');
 	}
	
	function is_faculty() {
 		$auth = new \tinyPHP\Classes\Libraries\Cookies();
 		if($auth->getPersonField('type') == 'teacher' || $auth->getPersonField('type') == 'substitute') {
 			return true;
 		} else {
 			return false;
 		}
		Hooks::add_action('init','is_faculty');
 	}
	
	function is_parent() {
 		$auth = new \tinyPHP\Classes\Libraries\Cookies();
 		if($auth->getPersonField('type') == 'parent') {
 			return true;
 		} else {
 			return false;
 		}
		Hooks::add_action('init','is_parent');
 	}
	
	function is_student() {
 		$auth = new \tinyPHP\Classes\Libraries\Cookies();
 		if($auth->getPersonField('type') == 'student') {
 			return true;
 		} else {
 			return false;
 		}
		Hooks::add_action('init','is_student');
 	}
	
	function login_admin() {
		$auth = new \tinyPHP\Classes\Libraries\Cookies();
		
		if(!is_admin()) { redirect(BASE_URL . 'admin/'); }
		if(!$auth->isUserLoggedIn()) { redirect(BASE_URL . 'admin/'); }
	}