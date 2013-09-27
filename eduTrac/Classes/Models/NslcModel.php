<?php namespace eduTrac\Classes\Models;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * NSLC Model
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
use \eduTrac\Classes\Libraries\Hooks;
class NslcModel {
    
    private $_auth;
    private $_nslc;
    
    public function __construct() {
        $this->_auth = new \eduTrac\Classes\Libraries\Cookies;
        $this->_nslc = new \eduTrac\Classes\DBObjects\NslcSetup;
        $this->_nslc->Load_from_key(1);
    }
    
    public function setup() {
        $array = [];
        $q = DB::inst()->query( "SELECT * FROM nslc_setup" );
        if($q->rowCount() > 0) {
            while($r = $q->fetch(\PDO::FETCH_ASSOC)) {
                $array[] = $r;
            }
            return $array;
        }
    }
    
    public function runPurge() {
        $q = DB::inst()->query( "TRUNCATE nslc_hold_file" );
        if($q) {
            redirect( BASE_URL . 'success/nslc_purge/' );
        } else {
            redirect( BASE_URL . 'error/nslc_purge/' );
        }
    }
    
    public function runSetup($data) {
        $update = array( 
            "branch" => $data['branch'],"reportingTerm" => $data['reportingTerm'],
            "termStartDate" => $data['termStartDate'], "termEndDate" => $data['termEndDate'],
            "termCode" => $data['termCode']
            );
            
        $bind = array( ":ID" => $data['ID'] );
        
        $q = DB::inst()->update( "nslc_setup",$update,"ID = :ID",$bind );
                
        redirect( BASE_URL . 'nslc/setup/' . bm() );
    }
	
	public function runTermLookup($data) {
        $bind = array(":code" => $data['termCode']);
        $q = DB::inst()->select( "term","termCode = :code AND active = '1'","termID","termStartDate,termEndDate",$bind );
        foreach($q as $k => $v) {
            $json = array( 'input#termStartDate' => $v['termStartDate'], 'input#termEndDate' => $v['termEndDate'] );
        }
        echo json_encode($json);
    }
	
	public function runExtraction($data) {
	    $list = $data['savedQueryID'];
        $q1 = DB::inst()->query( "SELECT savedQuery FROM saved_query WHERE savedQueryID = '$list' LIMIT 1" );
        $r1 = $q1->fetch();
        
        $q2 = DB::inst()->query( $r1['savedQuery'] );
        foreach($q2 as $k => $v) {
            $bind = array( 
                    'stuID' => $v['personID'], 'fname' => $v['fname'], 'lname' => $v['lname'],
                    'address1' => $v['address1'], 'city' => $v['city'], 'state' => $v['state'],
                    'zip' => $v['zip'], 'country' => $v['country'], 'ssn' => $v['ssn'] 
            );
            $q3 = DB::inst()->insert( "nslc_hold_file", $bind );
        }
        if($q3) {
            redirect( BASE_URL  . 'nslc/verification/' );
        } else {
            redirect( BASE_URL . 'error/nslc_extraction/');
        }
	}
    
    public function nslc() {
        $array = [];
        $q = DB::inst()->query( "SELECT 
                    a.stuID,
                    a.LastUpdate,
                    b.stuLoad 
                FROM 
                    stu_term a 
                LEFT JOIN 
                    stu_term_load b 
                ON 
                    a.termID = b.termID 
                LEFT JOIN 
                    nslc_hold_file c 
                ON 
                    a.stuID = c.stuID" 
        );
        while($r = $q->fetch(\PDO::FETCH_ASSOC)) {
            $array[] = $r;
        }
        return $r;
    }
    
    public function writeToFile() {
        $q4 = DB::inst()->query( "SELECT * FROM nslc_hold_file" );
        
        if(!file_exists(Hooks::get_option('hold_file_loc'))) {
            mkdir(Hooks::get_option('hold_file_loc'), 0755);
        }
        
        $nslcFile = Hooks::get_option('hold_file_loc') . $this->_nslc->getBranch() . ".CLR";
        $fh = fopen($nslcFile, 'w') or die("can't open file");
        
        fwrite($fh, str_pad("SSN", 15," ",STR_PAD_RIGHT));
        fwrite($fh, str_pad("Last Name", 12," ",STR_PAD_RIGHT));
        fwrite($fh, str_pad("First Name", 12," ",STR_PAD_RIGHT));
        fwrite($fh, str_pad("Address", 30," ",STR_PAD_RIGHT));
        fwrite($fh, str_pad("City", 12," ",STR_PAD_RIGHT));
        fwrite($fh, str_pad("State", 10," ",STR_PAD_RIGHT));
        fwrite($fh, str_pad("Zip", 10," ",STR_PAD_RIGHT));
        fwrite($fh, str_pad("Country", 10," ",STR_PAD_RIGHT) . "\n" . "\n");
        
        foreach($q4 as $k => $v) {
            fwrite($fh, str_pad('D1'.$v['ssn'], 15," ",STR_PAD_RIGHT));
            fwrite($fh, str_pad($v['lname'], 12," ",STR_PAD_RIGHT));
            fwrite($fh, str_pad($v['fname'], 12," ",STR_PAD_RIGHT));
            fwrite($fh, str_pad($v['address1'], 30," ",STR_PAD_RIGHT));
            fwrite($fh, str_pad($v['city'], 12," ",STR_PAD_RIGHT));
            fwrite($fh, str_pad($v['state'], 10," ",STR_PAD_RIGHT));
            fwrite($fh, str_pad($v['zip'], 10," ",STR_PAD_RIGHT));
            fwrite($fh, str_pad($v['country'], 10," ",STR_PAD_RIGHT) . "\n");
        }
        fclose($fh);
    }
    
    public function correct($id) {
        $array = [];
        $bind = array( ":stuID" => $id );
        $q = DB::inst()->select( "nslc_hold_file","stuID = :stuID","","*",$bind );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function search() {
        $array = [];
        $id = isPostSet('nslc');
        $bind = array( ":id" => "%$id%" );
        $q = DB::inst()->select( "nslc_hold_file","stuID LIKE :id","","*",$bind );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function __destruct() {
        DB::inst()->close();
    }

}