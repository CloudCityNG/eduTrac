<?php namespace eduTrac\Classes\Models;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Profile Model
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

use \eduTrac\Classes\Core\DB;
use \eduTrac\Classes\Libraries\Util;
class ProfileModel {
    
    private $_auth;
    
    public function __construct() {
        $this->_auth = new \eduTrac\Classes\Libraries\Cookies;
    }
	
	public function index() {}
    
    public function runProfile($data) {
        $update1 = [ 
                "fname" => $data['fname'],"lname" => $data['lname'],
                "mname" => Util::_trim($data['mname']),"email" => Util::_trim($data['email']),
                "ssn" => Util::_trim($data['ssn']),"dob" => $data['dob']
                ];
                
        $bind = [ ":personID" => $this->_auth->getPersonField('personID') ];
        
        $q = DB::inst()->update("person",$update1,"personID = :personID",$bind);
        
        if(!empty($data['password'])) {
            $update2 = ["password" => et_hash_password($data['password'])];
            DB::inst()->update("person",$update2,"personID = :personID",$bind);
        }
        redirect( BASE_URL . 'profile/' );
    }
    
    public function __destruct() {
        DB::inst()->close();
    }

}