<?php namespace eduTrac\Classes\Models;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Room Reservation Model
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
 * @license     GNU General Public License v3 (http://www.gnu.org/licenses/gpl-3.0.html)
 * @link        http://www.7mediaws.org/
 * @since       1.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

use \eduTrac\Classes\Core\DB;
use \eduTrac\Classes\Libraries\Hooks;
use \eduTrac\Classes\Libraries\Log;
class ReservationModel {
    
    private $_log;
    
    public function __construct() {
        $this->_log = new Log;
    }
    
	public function index() {}
    
    public function catList() {
        $q = DB::inst()->select( "reservation_category" );
        foreach($q as $k => $v) {
            $array[] = $v;
        }
        return $array;
    }
    
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
        $this->_log->setLog('Update','Settings','Room Reservation Settings');
        redirect( BASE_URL . 'reservation/' . bm() );
    }
    
    public function runCategory($data) {
        $bind = array( "catName" => $data['catName'],"fgcolor" => $data['fgcolor'],
                        "bgcolor" => $data['bgcolor']
        );
        
        $q = DB::inst()->insert( "reservation_category", $bind );
        if(!$q) {
            redirect( BASE_URL . 'error/save_data/' );
        } else {
            redirect( BASE_URL . 'reservation/view_category/' . $ID . '/'. bm() );
        }
    }
    
    public function __destruct() {
        DB::inst()->close();
    }
    
}