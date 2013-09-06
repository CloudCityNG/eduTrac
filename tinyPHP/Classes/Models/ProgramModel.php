<?php namespace tinyPHP\Classes\Models;
/**
 *
 * Program Model
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
 * @license GNU General Public License v3 (http://www.gnu.org/licenses/gpl-3.0.html)
 * @since eduTrac(tm) v 1.0.0
 * @package Model
 */

if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');

use \tinyPHP\Classes\Core\DB;
use \tinyPHP\Classes\Libraries\Log;
use \tinyPHP\Classes\Libraries\Hooks;
use \tinyPHP\Classes\Libraries\Cookies;
class ProgramModel {
	
	private $_auth;
    private $_log;
	
	public function __construct() {
		$this->_auth = new Cookies;
        $this->_log = new Log;
	}
	
	public function search() {
        $post = isPostSet('prog');
        $bind = array( ":post" => "%$post%" );
        $q = DB::inst()->query( "SELECT acadProgID,acadProgCode,acadProgTitle,currStatus,startDate,endDate 
            FROM acad_program WHERE acadProgCode LIKE :post", $bind
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
                    "approvedDate" => $data['approvedDate'],"deptCode" => $data['deptCode'],"schoolCode" => $data['schoolCode'],
                    "acadYearCode" => $data['acadYearCode'],"startDate" => $data['startDate'],"endDate" => "NULL",
                    "degreeCode" => $data['degreeCode'],"ccdCode" => $data['ccdCode'],"majorCode" => $data['majorCode'],
                    "minorCode" => $data['minorCode'],"specCode" => $data['specCode'],"acadLevelCode" => $data['acadLevelCode'],
                    "cipCode" => $data['cipCode'],"locationCode" => $data['locationCode']
        );
               
        $q = DB::inst()->insert( "acad_program", $bind );
           
        $ID = DB::inst()->lastInsertId('acadProgID');
        
        if(!$q) {
            redirect( BASE_URL . 'error/save_data/' );
        } else {
            redirect( BASE_URL . 'program/view/' . $ID . bm() );
        }
    }
    
    public function prog($id) {
        $bind = array( ":id" => $id );
        $q = DB::inst()->query( "SELECT 
                a.acadProgID,a.acadProgCode,a.acadProgTitle,a.programDesc,a.currStatus,
                a.statusDate,a.approvedDate,a.deptCode,a.schoolCode,a.acadYearCode,
                a.startDate,a.endDate,a.degreeCode,a.ccdCode,a.majorCode,a.minorCode,a.specCode,
                a.acadLevelCode,a.cipCode,a.locationCode,b.fname,b.lname,
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
                a.deptCode = c.deptCode 
            LEFT JOIN 
                school d 
            ON 
                a.schoolCode = d.schoolCode 
            LEFT JOIN 
                acad_year e 
            ON 
                a.acadYearCode = e.acadYearCode 
            LEFT JOIN 
                degree f 
            ON 
                a.degreeCode = f.degreeCode 
            LEFT JOIN 
                ccd g 
            ON 
                a.ccdCode = g.ccdCode 
            LEFT JOIN 
                major h 
            ON 
                a.majorCode = h.majorCode 
            LEFT JOIN 
                minor i 
            ON 
                a.minorCode = i.minorCode 
            LEFT JOIN 
                specialization j 
            ON 
                a.specCode = j.specCode 
            LEFT JOIN 
                cip k 
            ON 
                a.cipCode = k.cipCode 
            LEFT JOIN 
                location l 
            ON 
                a.locationCode = l.locationCode 
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
        $bind = array( ":acadProgID" => $data['acadProgID'] );
        $sql = DB::inst()->select( "acad_program","acadProgID = :acadProgID","","currStatus",$bind );
        foreach($sql as $r) {
            $array[] = $r;
        }
        
        $statusDate = date("Y-m-d");
        
        $update1 = array( 
                    "acadProgCode" => $data['acadProgCode'],"acadProgTitle" => $data['acadProgTitle'],"programDesc" => $data['programDesc'],
                    "currStatus" => $data['currStatus'],"deptCode" => $data['deptCode'],"schoolCode" => $data['schoolCode'],
                    "acadYearCode" => $data['acadYearCode'],"startDate" => $data['startDate'],"endDate" => $data['endDate'],
                    "degreeCode" => $data['degreeCode'],"ccdCode" => $data['ccdCode'],"majorCode" => $data['majorCode'],
                    "minorCode" => $data['minorCode'],"specCode" => $data['specCode'],"acadLevelCode" => $data['acadLevelCode'],
                    "cipCode" => $data['cipCode'],"locationCode" => $data['locationCode']
        );
        
        $q = DB::inst()->update( "acad_program", $update1, "acadProgID = :acadProgID", $bind );
        
        $update2 = array( "statusDate" => $statusDate );
        if($r['currStatus'] != $data['currStatus']) {
            DB::inst()->update( "acad_program", $update2, "acadProgID = :acadProgID", $bind );
        }
        $this->_log->writeLog("Update","Academic Program",$data['acadProgTitle']);
        redirect( BASE_URL . 'program/view/' . $data['acadProgID'] . bm() );
    }
    
    public function __destruct() {
        DB::inst()->close();
    }
	
}