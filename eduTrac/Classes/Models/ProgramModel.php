<?php namespace eduTrac\Classes\Models;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Program Model
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
use \eduTrac\Classes\Libraries\Log;
use \eduTrac\Classes\Libraries\Hooks;
use \eduTrac\Classes\Libraries\Cookies;
class ProgramModel {
	
	private $_auth;
    private $_log;
	
	public function __construct() {
		$this->_auth = new Cookies;
        $this->_log = new Log;
	}
	
	public function search() {
        $array = [];
        $post = isPostSet('prog');
        $bind = array( ":post" => "%$post%" );
        $q = DB::inst()->query( "SELECT 
                    CASE currStatus 
                    WHEN 'A' THEN 'Active' 
                    WHEN 'I' THEN 'Inactive' 
                    WHEN 'P' THEN 'Pending' 
                    ELSE 'Obsolete' 
                    END AS 'Status', 
                    acadProgID,
                    acadProgCode,
                    acadProgTitle,
                    startDate,
                    endDate 
                FROM 
                    acad_program 
                WHERE 
                    acadProgCode LIKE :post",
                $bind 
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function runProg($data) {
        $bind = array( 
                    "acadProgCode" => $data['acadProgCode'],"acadProgTitle" => $data['acadProgTitle'],"programDesc" => $data['programDesc'],
                    "currStatus" => $data['currStatus'],"statusDate" => $data['statusDate'],"approvedBy" => $data['approvedBy'],
                    "approvedDate" => $data['approvedDate'],"deptID" => $data['deptID'],"schoolID" => $data['schoolID'],
                    "acadYearID" => $data['acadYearID'],"startDate" => $data['startDate'],"endDate" => "NULL",
                    "degreeID" => $data['degreeID'],"ccdID" => $data['ccdID'],"majorID" => $data['majorID'],
                    "minorID" => $data['minorID'],"specID" => $data['specID'],"acadLevelCode" => $data['acadLevelCode'],
                    "cipID" => $data['cipID'],"locationID" => $data['locationID']
        );
               
        $q = DB::inst()->insert( "acad_program", $bind );
           
        $ID = DB::inst()->lastInsertId('acadProgID');
        
        if(!$q) {
            redirect( BASE_URL . 'error/save_data/' );
        } else {
            $this->_log->setLog('New Record','Academic Program',$data['acadProgTitle']);
            redirect( BASE_URL . 'program/view/' . $ID . bm() );
        }
    }
    
    public function prog($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->query( "SELECT 
                a.acadProgID,a.acadProgCode,a.acadProgTitle,a.programDesc,a.currStatus,
                a.statusDate,a.approvedDate,a.deptID,a.schoolID,a.acadYearID,
                a.startDate,a.endDate,a.degreeID,a.ccdID,a.majorID,a.minorID,a.specID,
                a.acadLevelCode,a.cipID,a.locationID,b.fname,b.lname,
                c.deptName,d.schoolName,e.acadYearDesc,f.degreeName,g.ccdName,
                h.majorName,i.minorName,j.specName,k.cipName,l.locationName 
            FROM 
               acad_program a 
            LEFT JOIN 
                person b
            ON 
                a.approvedBy = b.personID 
            LEFT JOIN 
                department c 
            ON 
                a.deptID = c.deptID 
            LEFT JOIN 
                school d 
            ON 
                a.schoolID = d.schoolID 
            LEFT JOIN 
                acad_year e 
            ON 
                a.acadYearID = e.acadYearID 
            LEFT JOIN 
                degree f 
            ON 
                a.degreeID = f.degreeID 
            LEFT JOIN 
                ccd g 
            ON 
                a.ccdID = g.ccdID 
            LEFT JOIN 
                major h 
            ON 
                a.majorID = h.majorID 
            LEFT JOIN 
                minor i 
            ON 
                a.minorID = i.minorID 
            LEFT JOIN 
                specialization j 
            ON 
                a.specID = j.specID 
            LEFT JOIN 
                cip k 
            ON 
                a.cipID = k.cipID 
            LEFT JOIN 
                location l 
            ON 
                a.locationID = l.locationID 
            WHERE 
                a.acadProgID = :id",
            $bind
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function runEditProg($data) {
        $array = [];
        $bind = array( ":acadProgID" => $data['acadProgID'] );
        $sql = DB::inst()->select( "acad_program","acadProgID = :acadProgID","","currStatus",$bind );
        foreach($sql as $r) {
            $array[] = $r;
        }
        
        $statusDate = date("Y-m-d");
        
        $update1 = array( 
                    "acadProgCode" => $data['acadProgCode'],"acadProgTitle" => $data['acadProgTitle'],"programDesc" => $data['programDesc'],
                    "currStatus" => $data['currStatus'],"deptID" => $data['deptID'],"schoolID" => $data['schoolID'],
                    "acadYearID" => $data['acadYearID'],"startDate" => $data['startDate'],"endDate" => $data['endDate'],
                    "degreeID" => $data['degreeID'],"ccdID" => $data['ccdID'],"majorID" => $data['majorID'],
                    "minorID" => $data['minorID'],"specID" => $data['specID'],"acadLevelCode" => $data['acadLevelCode'],
                    "cipID" => $data['cipID'],"locationID" => $data['locationID']
        );
        
        $q = DB::inst()->update( "acad_program", $update1, "acadProgID = :acadProgID", $bind );
        
        $update2 = array( "statusDate" => $statusDate );
        if($r['currStatus'] != $data['currStatus']) {
            DB::inst()->update( "acad_program", $update2, "acadProgID = :acadProgID", $bind );
        }
        $this->_log->setLog('Update Record','Academic Program',$data['acadProgTitle']);
        redirect( BASE_URL . 'program/view/' . $data['acadProgID'] . bm() );
    }
    
    public function __destruct() {
        DB::inst()->close();
    }
	
}