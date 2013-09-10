<?php namespace eduTrac\Classes\Core;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Extension Helpers
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

class Extension {
	
	/**
	 * List of paths to load helpers from
	 *
	 * @var array
	 */
	protected $helper_paths =	array();
	
	/**
	 * List of loaded helpers
	 *
	 * @var array
	 */
	protected $helpers = array();
	
	public function __construct() {}
	
	/**
	 * Load Helper
	 *
	 * This function loads the specified helper file.
	 *
	 * @param mixed
	 * @return void
	*/
	public function helper($helpers = array()) {
		foreach ($this->prep_filename($helpers, '_helper') as $helper) {
			if(isset($this->helpers[$helper])) {
				continue;
			}
	
			$ext_helper = APP_PATH . 'Helpers/ext_'.$helper.'.php';
			$base_helper = SYS_PATH . 'Helpers/'.$helper.'.php';
	
			// Is this a helper extension request?
			if (file_exists($ext_helper)) {
			
				if ( !file_exists($ext_helper)) {
					echo 'Unable to load the requested file: ' . APP_PATH . 'Helpers/ext_'.$helper.'.php';
				}
		
				include_once($ext_helper);
			
				$this->helpers[$helper] = TRUE;
					continue;
			} else
			// Is this a base helper request?
			if (file_exists($base_helper)) {
				if ( !file_exists($base_helper)) {
					echo 'Unable to load the requested file: ' . SYS_PATH . 'Helpers/'.$helper.'.php';
				}
				
				include_once($base_helper);
			
				$this->helpers[$helper] = TRUE;
					continue;
			} 
				
	
			// Try to load the helper
			foreach ($this->helper_paths as $path) {
				if (file_exists($path.'Helpers/'.$helper.'.php')) {
				include_once($path.'Helpers/'.$helper.'.php');
				
				$this->helpers[$helper] = TRUE;
				break;
				}
			}
	
			// unable to load the helper
			if ( !isset($this->helpers[$helper])) {
			echo 'Unable to load the requested file: ' . SYS_PATH . 'Helpers/'.$helper.'.php';
			}
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	* Load Helpers
	*
	* This is simply an alias to the above function in case the
	* user has written the plural form of this function.
	*
	* @param array
	* @return void
	*/
	public function helpers($helpers = array()) {
		$this->helper($helpers);
	}
	
	/**
	 * Prep filename
	 *
	 * This function preps the name of various items to make loading them more reliable.
	 *
	 * @param mixed
	 * @param string
	 * @return array
	 */
	protected function prep_filename($filename, $extension) {
		if ( ! is_array($filename)) {
			return array(strtolower(str_replace(array($extension, '.php'), '', $filename).$extension));
		} else {
			foreach ($filename as $key => $val) {
			$filename[$key] = strtolower(str_replace(array($extension, '.php'), '', $val).$extension);
		}
		
		return $filename;
		}
	}
	
}