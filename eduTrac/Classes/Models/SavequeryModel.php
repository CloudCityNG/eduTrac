<?php namespace eduTrac\Classes\Models;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Save Query Model
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
class SavequeryModel {
    
    private $_auth;
    private $_log;
    private $_uname;
    
    public function __construct() {
        $this->_auth = new \eduTrac\Classes\Libraries\Cookies;
        $this->_log = new \eduTrac\Classes\Libraries\Log;
        $this->_uname = $this->_auth->getPersonField('uname');
    }
	
	public function index() {}
	
	public function save($data) {
	    $date = date('Y-m-d');   		
		$bind = array( 
            "personID" => $data['personID'], "savedQueryName" => $data['savedQueryName'],
            "savedQuery" => $data['savedQuery'],"createdDate" => $date,"purgeQuery" => $data['purgeQuery']
		);
					
		$q = DB::inst()->insert( "saved_query", $bind );
		
		if(!$q) {
			redirect( BASE_URL . 'error/save_query' );
		} else {
		    $this->_log->setLog('New Record','Saved Query',$data['savedQueryName'],$this->_uname);
			redirect( BASE_URL . 'savequery/' . bm() );
		}
	}
    
    public function edit($data) {
        $update = [ 
            "savedQueryName" => $data['savedQueryName'],"savedQuery" => $data['savedQuery'],
            "purgeQuery" => $data['purgeQuery']
        ];
            
        $bind = [ ":savedQueryID" => $data['savedQueryID'],":personID" => $data['personID'] ];
        
        $q = DB::inst()->update( "saved_query",$update,"savedQueryID = :savedQueryID AND personID = :personID",$bind );
        
        $this->_log->setLog('Update Record','Saved Query',$data['savedQueryName'],$this->_uname);   
        redirect( BASE_URL . 'savequery/view/' . $data['savedQueryID'] . '/' . bm() );
    }
    
    public function queryList() {
        $array = [];
        $bind = array(":user" => $this->_auth->getPersonField('personID'));
        $q = DB::inst()->select( "saved_query","personID = :user","savedQueryID","*",$bind );
        foreach($q as $k => $v) {
            $array[] = $v;
        }
        return $array;
    }
    
    public function query($id) {
        $array = [];
        $bind = array( ":id" => $id, ":user" => $this->_auth->getPersonField('personID') );
        $q = DB::inst()->query( "SELECT * FROM saved_query WHERE savedQueryID = :id AND personID = :user LIMIT 1", $bind );
        foreach($q as $k => $v) {
            $array[] = $v;
        }
        return $array;
    }
    
    public function delete($id) {
        $bind = array( ":savedQueryID" => $id, ":user" => $this->_auth->getPersonField('personID') );
        $q = DB::inst()->query( "DELETE FROM saved_query WHERE savedQueryID = :savedQueryID AND personID = :user", $bind );
        
        if($q) {
            redirect( BASE_URL . 'savequery/' . bm() );
        } else {
            redirect( BASE_URL . 'error/delete_record/');
        }
    }
    
    public function __destruct() {
        DB::inst()->close();
    }

}