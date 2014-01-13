<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * eduTrac Installer Helper
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
 * @since       1.1.4
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */
	
	function validate_php(&$results) {
		if(version_compare(PHP_VERSION, '5.4') == -1) {
		  $results[] = new \eduTrac\Classes\Libraries\InstallValidator( _t( 'Minimum PHP version required in order to run eduTrac is PHP 5.4. Your PHP version: ' ) . PHP_VERSION, STATUS_ERROR);
		  return false;
		} else {
		  $results[] = new \eduTrac\Classes\Libraries\InstallValidator( _t( 'Your PHP version is ' ) . PHP_VERSION, STATUS_OK);
		  return true;
		}
	}
	
	function validate_memory_limit(&$results) {
		$memory_limit = php_config_value_to_bytes(ini_get('memory_limit'));
		
		$formatted_memory_limit = $memory_limit === -1 ? 'unlimited' : format_file_size($memory_limit);
		
		if($memory_limit === -1 || $memory_limit >= 33554432) {
		  $results[] = new \eduTrac\Classes\Libraries\InstallValidator( _t( 'Your memory limit is: ' ) . $formatted_memory_limit, STATUS_OK);
		  return true;
		} else {
		  $results[] = new \eduTrac\Classes\Libraries\InstallValidator( _t( 'Your memory is too low to complete the installation. Minimal value is 64MB, and you have it set to ' ) . $formatted_memory_limit, STATUS_ERROR);
		  return false;
		}
	}
	
	function validate_extensions(&$results) {
		$ok = true;
		
		$required_extensions = array('mysql', 'pdo_mysql', 'gettext', 'curl');
		
		foreach($required_extensions as $required_extension) {
		  if(extension_loaded($required_extension)) {
		    $results[] = new \eduTrac\Classes\Libraries\InstallValidator("Required extension '$required_extension' found", STATUS_OK);
		  } else {
		    $results[] = new \eduTrac\Classes\Libraries\InstallValidator("Extension '$required_extension' is required in order to run activeCollab", STATUS_ERROR);
		    $ok = false;
		  } // if
		} // foreach
		
		$recommended_extensions = array(
		  'memcache' => 'Memcache module provides handy procedural and object oriented interface to memcached, highly effective caching daemon, which was especially designed to decrease database load in dynamic web applications.',
		);
		
		foreach($recommended_extensions as $recommended_extension => $recommended_extension_desc) {
		  if(extension_loaded($recommended_extension)) {
		    $results[] = new \eduTrac\Classes\Libraries\InstallValidator("Recommended extension '$recommended_extension' found", STATUS_OK);
		  } else {
		    $results[] = new \eduTrac\Classes\Libraries\InstallValidator("Extension '$recommended_extension' was not found. <span class=\"details\">$recommended_extension_desc</span>", STATUS_WARNING);
		  }
		}
		    
		    return $ok;
	}

	function php_config_value_to_bytes($val) {
	    $val = trim($val);
	    $last = strtolower($val{strlen($val)-1});
	    switch($last) {
	      // The 'G' modifier is available since PHP 5.1.0
	      case 'g':
	        $val *= 1024;
	      case 'm':
	        $val *= 1024;
	      case 'k':
	        $val *= 1024;
	    } // if
	
	    return (integer) $val;
	}
	
	function format_file_size($value) {
	    $data = array(
	      'TB' => 1099511627776,
	      'GB' => 1073741824,
	      'MB' => 1048576,
	      'kb' => 1024,
	    );
	
	    // commented because of integer overflow on 32bit sistems
	    // http://php.net/manual/en/language.types.integer.php#language.types.integer.overflow
	    // $value = (integer) $value;
	    foreach($data as $unit => $bytes) {
	      $in_unit = $value / $bytes;
	      if($in_unit > 0.9) {
	        return trim(trim(number_format($in_unit, 2), '0'), '.') . $unit;
	      } // if
	    } // foreach
	
	    return $value . 'b';
	}