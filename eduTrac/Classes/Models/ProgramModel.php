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
 * @since       3.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

use \eduTrac\Classes\Core\DB;
use \eduTrac\Classes\Libraries\Log;
use \eduTrac\Classes\Libraries\Hooks;
use \eduTrac\Classes\Libraries\Cookies;
use \eduTrac\Classes\Libraries\Util;
class ProgramModel {
	
	private $_auth;
    private $_log;
    private $_uname;
	
	public function __construct() {
		$this->_auth = new Cookies;
        $this->_log = new Log;
        $this->_uname = $this->_auth->getPersonField('uname');
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
        $prog = array( 
                    "acadProgCode" => Util::_trim($data['acadProgCode']),"acadProgTitle" => $data['acadProgTitle'],"programDesc" => $data['programDesc'],
                    "currStatus" => $data['currStatus'],"statusDate" => $data['statusDate'],"approvedBy" => $data['approvedBy'],
                    "approvedDate" => $data['approvedDate'],"deptCode" => Util::_trim($data['deptCode']),"schoolCode" => Util::_trim($data['schoolCode']),
                    "acadYearCode" => Util::_trim($data['acadYearCode']),"startDate" => $data['startDate'],"endDate" => "NULL",
                    "degreeCode" => Util::_trim($data['degreeCode']),"ccdCode" => Util::_trim($data['ccdCode']),"majorCode" => Util::_trim($data['majorCode']),
                    "minorCode" => $data['minorCode'],"specCode" => $data['specCode'],"acadLevelCode" => $data['acadLevelCode'],
                    "cipCode" => Util::_trim($data['cipCode']),"locationCode" => Util::_trim($data['locationCode'])
        );
               
        $q = DB::inst()->insert( "acad_program", $prog );
           
        $ID = DB::inst()->lastInsertId('acadProgID');
        
        if(!$q) {
            redirect( BASE_URL . 'error/save_data/' );
        } else {
        	Hooks::do_action( 'create_acad_program', $prog );
            $this->_log->setLog('New Record','Academic Program',$data['acadProgTitle'],$this->_uname);
            redirect( BASE_URL . 'program/view/' . $ID . '/' . bm() );
        }
    }
    
    public function prog($id) {
        $array = [];
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
        $array = [];
        $bind = array( ":acadProgID" => $data['acadProgID'] );
        $sql = DB::inst()->select( "acad_program","acadProgID = :acadProgID","","currStatus",$bind );
        foreach($sql as $r) {
            $array[] = $r;
        }
        
        $statusDate = date("Y-m-d");
        
        $prog = array( 
                    "acadProgCode" => Util::_trim($data['acadProgCode']),"acadProgTitle" => $data['acadProgTitle'],"programDesc" => $data['programDesc'],
                    "currStatus" => $data['currStatus'],"deptCode" => Util::_trim($data['deptCode']),"schoolCode" => Util::_trim($data['schoolCode']),
                    "acadYearCode" => Util::_trim($data['acadYearCode']),"startDate" => $data['startDate'],"endDate" => $data['endDate'],
                    "degreeCode" => Util::_trim($data['degreeCode']),"ccdCode" => Util::_trim($data['ccdCode']),"majorCode" => Util::_trim($data['majorCode']),
                    "minorCode" => Util::_trim($data['minorCode']),"specCode" => Util::_trim($data['specCode']),"acadLevelCode" => Util::_trim($data['acadLevelCode']),
                    "cipCode" => Util::_trim($data['cipCode']),"locationCode" => Util::_trim($data['locationCode'])
        );
        
        $q = DB::inst()->update( "acad_program", $prog, "acadProgID = :acadProgID", $bind );
        
        $update2 = array( "statusDate" => $statusDate );
        if($r['currStatus'] != $data['currStatus']) {
            DB::inst()->update( "acad_program", $update2, "acadProgID = :acadProgID", $bind );
        }
		Hooks::do_action( 'edit_acad_program', $prog );
        $this->_log->setLog('Update Record','Academic Program',$data['acadProgTitle'],$this->_uname);
        redirect( BASE_URL . 'program/view/' . $data['acadProgID'] . '/' . bm() );
    }
    
    public function __destruct() {
        DB::inst()->close();
    }
	
}