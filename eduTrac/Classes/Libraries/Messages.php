<?php namespace eduTrac\Classes\Libraries;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Messages Library
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

class Messages {
	
	private $_cookie;
	
	public function __construct() {
		$this->_cookie = new \eduTrac\Classes\Libraries\Cookies;
	}
	
	public function init($name,$value) {
		/** Set the session values */
		$this->_cookie->_setcookie($name, $value);
	}
	
	public function flashMessage() {
		// get the message (they are arrays, to make multiple positive/negative messages possible)
		$success_message[] = $_COOKIE['success_message'];
		$error_message[] = $_COOKIE['error_message'];
		
		// echo out positive messages
		if (isset($_COOKIE['success_message'])) {
		    foreach ($success_message as $message) {
		    	$this->_cookie->_setcookie('success_message', '', time()-COOKIE_EXPIRE);
		        return '<section class="panel success-panel"><div class="alerts alerts-success center">'.$message.'</div></section>';
		    }
		}
		
		// echo out negative messages
		if (isset($_COOKIE['error_message'])) {
		    foreach ($error_message as $message) {
		    	$this->_cookie->_setcookie('error_message', '', time()-COOKIE_EXPIRE);
		        return '<section class="panel error-panel"><div class="alerts alerts-error center">'.$message.'</div></section>';
		    }
		}
	}
	
	public function notice($num) {
		$msg[1] = _t('The new record was created and saved in the database.');
		$msg[2] = _t('The system was unabled to create the new record. Please try again. If the problem persists, contact your system administrator.');
		$msg[3] = _t('The record was updated successfully');
		$msg[4] = _t('There was an error with updating the requested record. Please try again. If the problem persists, contact your system administrator.');
		$msg[5] = _t('The record was deleted successfully.');
		$msg[6] = _t('There was an error with deleting the record. Please try again.');
		$msg[7] = _t('There was an issue with your login credentials. Please try again.');
		//$msg[8] = _t('Registration was unsuccessful. Please try again.');
		$msg[9] = _t('Your application was successfully submitted.');
		$msg[10] = _t('There was an error with creating your application. Please try again.');
		$msg[11] = _t('Your course registration was successful.');
		$msg[12] = _t('There was an error with the course registration. Please try again. If the problem persists, contact your system administrator.');
		$msg[13] = _t('Unable to establish a database connection. Make sure the database name is correct and that it exists.');
		$msg[14] = _t('Your ticket was created and submitted to the helpdesk.');
		$msg[15] = _t('The system was unable to create your ticket. Please try again.');
		$msg[16] = _t('Your reply to this ticket was submitted successfully.');
		$msg[17] = _t('The system was unable to submit your reply. Please try again.');
		$msg[18] = _t('Your room/event request was successfully sent to the room scheduler.');
		$msg[19] = _t('The system was unable to submit your room/event request. Please try again.');
		$msg[20] = _t('The room/event was successfully booked.');
		$msg[21] = _t('The system was unable to book the room/event. Please try again.');
		$msg[22] = _t('Your change of address request has been sent.');
		$msg[23] = _t('The system was unable to send your change of address request. Please try again.');
		$msg[24] = _t('Your application was successfully created and submitted to admissions.');
		$msg[25] = _t('Registration was unsuccessful. Please try again.');
		return $msg[$num];
	}

}