<?php namespace eduTrac\Classes\Models;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Institution Model
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
class InstitutionModel {
    
    private $_log;
    private $_auth;
    private $_uname;
	
	public function __construct() {
	    $this->_log = new \eduTrac\Classes\Libraries\Log;
        $this->_auth = new \eduTrac\Classes\Libraries\Cookies;
        $this->_uname = $this->_auth->getPersonField('uname');
	}
    
    public function search() {
        $array = [];
        $inst = isPostSet('inst');
        $bind = [ ":inst" => "%$inst%" ];
        $q = DB::inst()->query( "SELECT * 
                FROM 
                    institution 
                WHERE 
                    instName LIKE :inst",
                $bind 
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function inst($id) {
        $array = [];
        $bind = [ ":id" => $id ];
        $q = DB::inst()->select( "institution","institutionID = :id","","*",$bind );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function runInstitution($data) {
        $bind = [
                "ficeCode" => $data['ficeCode'],"instType" => $data['instType'],
                "instName" => $data['instName'],"city" => $data['city'],
                "state" => $data['state']
                ];
                
        $q = DB::inst()->insert( 'institution', $bind );
        $ID = DB::inst()->lastInsertId('institutionID');
        
        if(!$q) {
            redirect( BASE_URL . 'error/save_data' );
        } else {
            $this->_log->setLog('New Record','Institution',$data['instName'],$this->_uname);
            redirect( BASE_URL . 'institution/view/' . $ID . '/' . bm() );
        }
    }
    
    public function runEditInstitution($data) {
        $update = [
                    "ficeCode" => $data['ficeCode'],"instType" => $data['instType'],
                    "instName" => $data['instName'],"city" => $data['city'],
                    "state" => $data['state']
                  ];
                
        $bind = [ ":id" => $data['institutionID'] ];
                
        $q = DB::inst()->update( 'institution',$update,"institutionID = :id",$bind );
        
        if(!$q) {
            redirect( BASE_URL . 'error/save_data' );
        } else {
            $this->_log->setLog('Update Record','Institution',$data['instName'],$this->_uname);
            redirect( BASE_URL . 'institution/view/' . $data['institutionID'] . '/' . bm() );
        }
    }
    
    public function __destruct() {
        DB::inst()->close();
    }

}