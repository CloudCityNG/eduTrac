<?php namespace tinyPHP\Classes\Models;
/**
 *
 * System Settings Model
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

if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');

use \tinyPHP\Classes\Core\DB;
use \tinyPHP\Classes\Libraries\Hooks;
use \tinyPHP\Classes\Libraries\Cookies;
use \tinyPHP\Classes\Libraries\Log;
class SettingModel {
        
    private $_auth;
    
    private $_log;
    
    public function __construct() {
        $this->_auth = new Cookies;
        $this->_log = new Log;
    }
	
	public function index() {}
    
    public function runSetting($options) {
        foreach ( $options as $option_name ) {
            if ( ! isset($_POST[$option_name]) )
                continue;
            $value = $_POST[$option_name];
            Hooks::update_option( $option_name, $value );
        }
        // Update more options here
        Hooks::do_action( 'update_options' );
        /* Write to logs */
        $this->_log->setLog('Update','Settings','System Settings');
        redirect( BASE_URL . 'setting/' . bm() );
    }
    
    public function __destruct() {
        DB::inst()->close();
    }

}