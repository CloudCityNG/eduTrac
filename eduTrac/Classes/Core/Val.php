<?php namespace eduTrac\Classes\Core;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Form Validator
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

class Val {
	
	public function __construct() {}
	
	public function minlength($data, $arg) {
		if (strlen($data) < $arg) {
			return "Your string can only be $arg long";
		}
	}
	
	public function maxlength($data, $arg) {
		if (strlen($data) > $arg) {
			return "Your string can only be $arg long";
		}
	}
	
	public function digit($data) {
		if (ctype_digit($data) == false) {
			return "Your string must be a digit";
		}
	}
	
	public function is_valid_username($username) {
		if (preg_match('/^[a-z\d_]{5,20}$/i', $username)) {
			return true;
		} else {
			return false;
		}
	}
	
	public function is_valid_email($email) {
        // First, we check that there's one @ symbol, and that the lengths are right
        if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $email)) {
            // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
            return false;
        }
        // Split it into sections to make life easier
        $email_array = explode("@", $email);
        $local_array = explode(".", $email_array[0]);
        for ($i = 0; $i < sizeof($local_array); $i++) {
            if (!preg_match("/^(([A-Za-z0-9!#$%&'*+\/=?^_`{|}~-][A-Za-z0-9!#$%&'*+\/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/", $local_array[$i])) {
                return false;
            }
        }
        if (!preg_match("/^\[?[0-9\.]+\]?$/", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
            $domain_array = explode(".", $email_array[1]);
            if (sizeof($domain_array) < 2) {
                return false; // Not enough parts to domain
            }
            for ($i = 0; $i < sizeof($domain_array); $i++) {
                if (!preg_match("/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/", $domain_array[$i])) {
                    return false;
                }
            }
        }

        return true;
    }
	
	public function is_valid_password($x,$y) {
		if(empty($x) || empty($y) ) { return false; }
			if (strlen($x) < 4 || strlen($y) < 4) { return false; }

		if (strcmp($x,$y) != 0) {
 			return false;
		} 
			return true;
	}
	
	public function generate_user_password($length = 10) {
  		$password = "";
  		$possible = "0123456789bcdfghjkmnpqrstvwxyz"; //no vowels
  
  			$i = 0; 
    
  				while ($i < $length) { 
    				$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
    				if (!strstr($password, $char)) { 
      					$password .= $char;
      				$i++;
    			}

  		}

  		return $password;
	}
	
	public function __call($name, $arguments) {
		throw new \Exception("$name does not exist inside of: " . __CLASS__);
	}
	
}