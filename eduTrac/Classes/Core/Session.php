<?php namespace eduTrac\Classes\Core;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Session Management
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

if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');

class Session {
    
    public function __construct() {}
	
	public static function init()
	{
		if(session_id() == '')
		{
            session_start();
        }
	}
    
	/**
     * sets a specific value to a specific key of the session
     * @param mixed $key
     * @param mixed $value
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    
	/**
     * gets/returns the value of a specific key of the session
     * @param mixed $key Usually a string, right ?
     * @return mixed
     */
    public static function get($key)
    {
        if (isset($_SESSION[$key]))
        {
            return $_SESSION[$key];
        }
    }
	
	/**
	 * Sets error message array().
	 */
	public static function error()
	{
		if (self::get('error_message'))
		{
		    foreach (self::get('error_message') as $error)
		    {
		        return '<div class="errormsg">'.$error.'</div>';
		    }
		}
	}
    
	/**
     * Deletes the sessions
     */
    public static function destroy()
    {
        session_unset();
        session_destroy();
    }
    
}