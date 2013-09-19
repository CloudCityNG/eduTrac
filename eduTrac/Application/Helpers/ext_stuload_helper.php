<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Student Load Helper
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

use \eduTrac\Classes\Core\DB;

    function FT() {
        $q = DB::inst()->query( "SELECT * FROM credit_load WHERE credLoadCode = 'FT'" );
        while($r = $q->fetch(\PDO::FETCH_ASSOC)) {
            return $r['credLoadCreds'];
        }
    }
    
    function HT() {
        $q = DB::inst()->query( "SELECT * FROM credit_load WHERE credLoadCode = 'HT'" );
        while($r = $q->fetch(\PDO::FETCH_ASSOC)) {
            return $r['credLoadCreds'];
        }
    }
    
    function LT() {
        $q = DB::inst()->query( "SELECT * FROM credit_load WHERE credLoadCode = 'LT'" );
        while($r = $q->fetch(\PDO::FETCH_ASSOC)) {
            return $r['credLoadCreds'];
        }
    }
 	
    function fullTime($creds) {
        $q = DB::inst()->query( "SELECT * FROM credit_load WHERE credLoadCode = 'FT'" );
        while($r = $q->fetch(\PDO::FETCH_ASSOC)) {
            if($creds >= $r['credLoadCreds']) {
                return true;
            }
        }
    }
    
    function halfTime($creds) {
        $q = DB::inst()->query( "SELECT * FROM credit_load WHERE credLoadCode = 'HT'" );
        while($r = $q->fetch(\PDO::FETCH_ASSOC)) {
            if($creds >= $r['credLoadCreds'] && $creds < FT()) {
                return true;
            }
        }
    }
    
    function lessThanHalfTime($creds) {
        $q = DB::inst()->query( "SELECT * FROM credit_load WHERE credLoadCode = 'LT'" );
        while($r = $q->fetch(\PDO::FETCH_ASSOC)) {
            if($creds >= $r['credLoadCreds'] && $creds < HT()) {
                return true;
            }
        }
    }
    
    function getStuLoad($creds) {
        if(fullTime($creds) == true) {
            return 'FT';
        } elseif(halfTime($creds) == true) {
            return 'HT';
        } elseif(lessThanHalfTime($creds) == true) {
            return 'LT';
        } else {
            return 'LT';
        }
    }