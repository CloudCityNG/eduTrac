<?php namespace eduTrac\Classes\Libraries;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Random ID Generator
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

class ID {
	
	public static function num($length) {
	    $characters = "0123456789876543210123456789012345678987654321"; 
    	$randomString = "";
    		for ($i = 0; $i < $length; $i++) {
      			$randomString .= $characters[mt_rand(0, strlen($characters)-1)];
    		}
    	return $randomString;
	}

}