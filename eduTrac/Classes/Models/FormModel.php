<?php namespace eduTrac\Classes\Models;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Form Model
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
class FormModel {

	public function __construct() {}
	
	/* Begins semester methods */
	public function runSemester($data) {			
		$bind = array( 
		      "acadYearCode" => Util::_trim($data['acadYearCode']),"semCode" => Util::_trim($data['semCode']),
		      "semName" => $data['semName'],"semStartDate" => $data['semStartDate'],
		      "semEndDate" => $data['semEndDate'],"active" => $data['active'] 
        );
        
        $q = DB::inst()->insert( "semester", $bind );
		$ID = DB::inst()->lastInsertId('semesterID');
		redirect( BASE_URL . 'form/view_semester/' . $ID . '/' . bm() );
	}
	
    public function semesterList() {
        $array = [];
        $q = DB::inst()->query( "SELECT 
                a.semesterID, a.semName, a.semStartDate, a.semEndDate, a.active, b.acadYearCode 
            FROM 
                semester a 
            LEFT JOIN 
                acad_year b 
            ON 
                a.acadYearCode = b.acadYearCode 
            WHERE 
            	a.semCode <> 'NULL'" 
            );
                
        if($q->rowCount() > 0) {
            while($r = $q->fetch(\PDO::FETCH_ASSOC)) {
                $array[] = $r;
            }
            return $array;
        }
    }
    
	public function runEditSemester($data) {
		$update = array( 
                "acadYearCode" => Util::_trim($data['acadYearCode']),"semCode" => Util::_trim($data['semCode']),
                "semName" => $data['semName'],"semStartDate" => $data['semStartDate'],
                "semEndDate" => $data['semEndDate'],"active" => $data['active'] 
        );
        
        $bind = array( ":semesterID" => $data['semesterID'] );
		$q = DB::inst()->update( "semester", $update, "semesterID = :semesterID", $bind );	
		redirect( BASE_URL . 'form/view_semester/' . $data['semesterID'] . '/' . bm() );
	}
	
	public function semester($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "semester","semesterID = :id","semesterID","*",$bind );
        foreach($q as $r){
            $array[] = $r;
        }
        return $array;
	}
	
	public function deleteSemester($id) {
	    $bind = array( ":semesterID" => $id );
		DB::inst()->delete( "semester", "semesterID = :semesterID", $bind );
		redirect( BASE_URL . 'semester/' . bm() );
	}
	/* Ends semester methods */
	
	/* Begins Term methods */
	public function runTerm($data) {			
		$bind = array( 
		      "semCode" => Util::_trim($data['semCode']),"termCode" => Util::_trim($data['termCode']),
		      "termName" => $data['termName'],"reportingTerm" => Util::_trim($data['reportingTerm']),
		      "termStartDate" => $data['termStartDate'],"termEndDate" => $data['termEndDate'],
		      "dropAddEndDate" => $data['dropAddEndDate'],"active" => $data['active'] 
        );
		
		$q = DB::inst()->insert( "term", $bind );
		$ID = DB::inst()->lastInsertId();
		redirect( BASE_URL . 'form/view_term/' . $ID . '/' . bm() );
	
	}
	
	public function termList() {
        $array = [];
        $q = DB::inst()->query( "SELECT 
                a.termID, a.termName, a.termStartDate, a.termEndDate, a.active, b.semName 
            FROM 
                term a 
            LEFT JOIN 
                semester b 
            ON 
                a.semCode = b.semCode 
            WHERE 
            	a.termCode <> 'NULL'" 
            );
                
        if($q->rowCount() > 0) {
            while($r = $q->fetch(\PDO::FETCH_ASSOC)) {
                $array[] = $r;
            }
            return $array;
        }
    }
	
	public function runEditTerm($data) {
		$update = array( 
              "semCode" => Util::_trim($data['semCode']),"termCode" => Util::_trim($data['termCode']),
              "termName" => $data['termName'],"reportingTerm" => Util::_trim($data['reportingTerm']),
              "termStartDate" => $data['termStartDate'],"termEndDate" => $data['termEndDate'],
              "dropAddEndDate" => $data['dropAddEndDate'],"active" => $data['active'] 
        );
        
	    $bind = array(":termID" => $data['termID']);
		$q = DB::inst()->update( "term", $update, "termID = :termID", $bind );	
		redirect( BASE_URL . 'form/view_term/' . $data['termID'] . '/' . bm() );
	}
	
	public function term($id) {
	    $array = [];
	    $bind = [ ":id" => $id ];
	    $q = DB::inst()->select("term","termID = :id","","*",$bind);
		foreach($q as $r) {
		    $array[] = $r;
		}
        return $array;
	}
	
	public function deleteTerm($id) {
	    $bind = array( "termID" => $id );
		DB::inst()->delete( "term", "termID = :termID", $bind );
		redirect( BASE_URL . 'term/' . bm() );
	}
	/* Ends term methods */
	
	/* Begin academic year */
	public function runAcadYear($data) {
		$bind = array( 
			"acadYearCode" => Util::_trim($data['acadYearCode']),"acadYearDesc" => $data['acadYearDesc']
			);
			
		$q = DB::inst()->insert( "acad_year", $bind );
		
		$ID = DB::inst()->lastInsertId();
			
		redirect( BASE_URL . 'form/view_acad_year/' . $ID . '/' . bm() );
	
	}
    
    public function acadYearList() {
        $q = DB::inst()->query( "SELECT * FROM acad_year WHERE acadYearCode <> 'NULL' ORDER BY acadYearID" );
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }
	
	public function runEditAcadYear($data) {
		$update = array( 
			"acadYearCode" => Util::_trim($data['acadYearCode']),"acadYearDesc" => $data['acadYearDesc']
			);
			
		$bind = array( ":acadYearID" => $data['acadYearID'] );
		
		$q = DB::inst()->update( "acad_year",$update,"acadYearID = :acadYearID",$bind );
				
		redirect( BASE_URL . 'form/view_acad_year/' . $data['acadYearID'] . '/' . bm() );
	}
	
	public function acadYear($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "acad_year","acadYearID = :id","","*",$bind );
		foreach($q as $r) {
            $array[] = $r;
		}
        return $array;
	}
	
	public function deleteAcadYear($id) {
        $bind = array( ":id" => $id );
		$q = DB::inst()->delete( "acad_year", "acadYearID = :id", $bind );
		
		if($q) {
			redirect( BASE_URL . 'success/delete_record/' );
		} else {
			redirect( BASE_URL . 'error/delete_record/');
		}
	}
	/* End academic year */
	
	/* Begin department */
	public function runDept($data) {
		$bind = array( 
			"deptCode" => Util::_trim($data['deptCode']),"deptTypeCode" => Util::_trim($data['deptTypeCode']),
			"deptName" => $data['deptName'],"deptDesc" => $data['deptDesc']
			);
			
		$q = DB::inst()->insert( "department", $bind );
		
		$ID = DB::inst()->lastInsertId();
			
		redirect( BASE_URL . 'form/view_department/' . $ID . '/' . bm() );
	
	}
    
    public function deptList() {
        $q = DB::inst()->query( "SELECT * FROM department WHERE deptCode <> 'NULL' ORDER BY deptID" );
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }
	
	public function runEditDept($data) {
		$update = array( 
            "deptCode" => Util::_trim($data['deptCode']),"deptTypeCode" => Util::_trim($data['deptTypeCode']),
            "deptName" => $data['deptName'],"deptDesc" => $data['deptDesc']
            );
			
		$bind = array( ":deptID" => $data['deptID'] );
		
		$q = DB::inst()->update( "department",$update,"deptID = :deptID",$bind );
				
		redirect( BASE_URL . 'form/view_department/' . $data['deptID'] . '/' . bm() );
	}
	
	public function dept($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "department","deptID = :id","","*",$bind );
		foreach($q as $r) {
    	    $array[] = $r;   
		}
        return $array;
	}
	
	public function deleteDept($id) {
        $bind = array( ":id" => $id );
		$q = DB::inst()->delete( "department", "deptID = :id", $bind );
		
		if($q) {
			redirect( BASE_URL . 'success/delete_record/' );
		} else {
			redirect( BASE_URL . 'error/delete_record/');
		}
	}
	/* End department */
	
	/* Begin student load rule */
	public function runStuLoadRule($data) {
		$bind = array( 
			"status" => $data['status'],"min_cred" => $data['min_cred'],
			"max_cred" => $data['max_cred'],"term" => Util::_trim($data['term']),
			"acadLevelCode" => Util::_trim($data['acadLevelCode']),"active" => $data['active']
			);
			
		$q = DB::inst()->insert( "student_load_rule", $bind );
		
		$ID = DB::inst()->lastInsertId();
			
		redirect( BASE_URL . 'form/student_load_rule/' . $ID  . '/' . bm() );
	
	}
    
    public function credLoadList() {
        $array = [];
        $q = DB::inst()->query( "SELECT 
                    CASE 
                        active 
                    WHEN 
                        '1' 
                    THEN 
                        'Yes' 
                    ELSE 
                        'No' 
                    END AS 
                        'State',
                        slrID,
                        status,
                        min_cred,
                        max_cred,
                        term,
                        acadLevelCode 
                    FROM 
                        student_load_rule 
                    ORDER BY 
                        min_cred" 
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
	
	public function runEditStuLoadRule($data) {
		$update = array( 
            "status" => $data['status'],"min_cred" => $data['min_cred'],
            "max_cred" => $data['max_cred'],"term" => Util::_trim($data['term']),
            "acadLevelCode" => Util::_trim($data['acadLevelCode']),"active" => $data['active']
            );
			
		$bind = array( ":id" => $data['slrID'] );
		
		$q = DB::inst()->update( "student_load_rule",$update,"slrID = :id",$bind );
				
		redirect( BASE_URL . 'form/view_student_load_rule/' . $data['slrID'] . '/' . bm() );
	}
	
	public function sl($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "student_load_rule","slrID = :id","","*",$bind );
		foreach($q as $r) {
    	    $array[] = $r;   
		}
        return $array;
	}
	
	public function deleteStuLoadRule($id) {
        $bind = array( ":id" => $id );
		$q = DB::inst()->delete( "student_load_rule", "slrID = :id", $bind );
		
		if($q) {
			redirect( BASE_URL . 'success/delete_record/' );
		} else {
			redirect( BASE_URL . 'error/delete_record/');
		}
	}
	/* End student load rule */
	
	/* Begin degrees */
	public function runDegree($data) {
		$bind = array( 
            "degreeCode" => Util::_trim($data['degreeCode']),"degreeName" => $data['degreeName'] 
            );
			
		$q = DB::inst()->insert( "degree", $bind );
		
		$ID = DB::inst()->lastInsertId();
			
		redirect( BASE_URL . 'form/view_degree/' . $ID . '/' . bm() );
	
	}
    
    public function degreeList() {
        $q = DB::inst()->query( "SELECT * FROM degree WHERE degreeCode <> 'NULL' ORDER BY degreeID" );
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }
	
	public function runEditDegree($data) {
		$update = array( 
			"degreeCode" => Util::_trim($data['degreeCode']),"degreeName" => $data['degreeName'] 
			);
			
		$bind = array( ":degreeID" => $data['degreeID']  );
		
		$q = DB::inst()->update( "degree",$update,"degreeID = :degreeID",$bind );
				
		redirect( BASE_URL . 'form/view_degree/' . $data['degreeID'] . '/' . bm() );
	}
	
	public function degree($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "degree","degreeID = :id","","*",$bind );
		foreach($q as $r) {
    	    $array[] = $r;   
		}
        return $array;
	}
	
	public function deleteDegree($id) {
        $bind = array( ":id" => $id );
		$q = DB::inst()->delete( "degree", "degreeID = :id", $bind );
		
		if($q) {
			redirect( BASE_URL . 'success/delete_record/' );
		} else {
			redirect( BASE_URL . 'error/delete_record/');
		}
	}
	/* End degrees */
	
	/* Begin majors */
	public function runMajor($data) {
		$bind = array( 
			"majorCode" => Util::_trim($data['majorCode']),"majorName" => $data['majorName']
			);
			
		$q = DB::inst()->insert( "major", $bind );
		
		$ID = DB::inst()->lastInsertId();
			
		redirect( BASE_URL . 'form/view_major/' . $ID . '/' . bm() );
	
	}
    
    public function majorList() {
        $q = DB::inst()->query( "SELECT * FROM major WHERE majorCode <> 'NULL' ORDER BY majorID" );
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }
	
	public function runEditMajor($data) {
		$update = array( 
			"majorCode" => Util::_trim($data['majorCode']),"majorName" => $data['majorName'] 
			);
			
		$bind = array( ":majorID" => $data['majorID'] );
		
		$q = DB::inst()->update( "major",$update,"majorID = :majorID",$bind );
				
		redirect( BASE_URL . 'form/view_major/' . $data['majorID'] . '/' . bm() );
	}
	
	public function major($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "major","majorID = :id","","*",$bind );
		foreach($q as $r) {
    	    $array[] = $r;   
		}
        return $array;
	}
	
	public function deleteMajor($id) {
        $bind = array( ":id" => $id );
		$q = DB::inst()->delete( "major", "majorID = :id", $bind );
		
		if($q) {
			redirect( BASE_URL . 'success/delete_record/' );
		} else {
			redirect( BASE_URL . 'error/delete_record/');
		}
	}
	/* End majors */
	
	/* Begin minors */
	public function runMinor($data) {
		$bind = array( 
			"minorCode" => Util::_trim($data['minorCode']),"minorName" => $data['minorName']
			);
			
		$q = DB::inst()->insert( "minor", $bind );
		
		$ID = DB::inst()->lastInsertId();
			
		redirect( BASE_URL . 'form/view_minor/' . $ID . '/' . bm() );
	
	}
    
    public function minorList() {
        $q = DB::inst()->query( "SELECT * FROM minor WHERE minorCode <> 'NULL' ORDER BY minorID" );
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }
	
	public function runEditMinor($data) {
		$update = array( 
            "minorCode" => Util::_trim($data['minorCode']),"minorName" => $data['minorName']
            );
			
		$bind = array( ":minorID" => $data['minorID'] );
		
		$q = DB::inst()->update( "minor",$update,"minorID = :minorID",$bind );
				
		redirect( BASE_URL . 'form/view_minor/' . $data['minorID'] . '/' . bm() );
	}
	
	public function minor($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "minor","minorID = :id","","*",$bind );
		foreach($q as $r) {
    	    $array[] = $r;   
		}
        return $array;
	}
	
	public function deleteMinor($id) {
        $bind = array( ":id" => $id );
		$q = DB::inst()->delete( "minor", "minorID = :id", $bind );
		
		if($q) {
			redirect( BASE_URL . 'success/delete_record/' );
		} else {
			redirect( BASE_URL . 'error/delete_record/');
		}
	}
	/* End minors */
	
	/* Begin CCD */
    public function runCCD($data) {
        $date = date("Y-m-d");
        $bind = array( 
            "ccdCode" => Util::_trim($data['ccdCode']),"ccdName" => $data['ccdName'],
            "addDate" => $date
            );
            
        $q = DB::inst()->insert( "ccd", $bind );
        
        $ID = DB::inst()->lastInsertId();
            
        redirect( BASE_URL . 'form/view_ccd/' . $ID . '/' . bm() );
    
    }
    
    public function ccdList() {
        $q = DB::inst()->query( "SELECT * FROM ccd WHERE ccdCode <> 'NULL' ORDER BY ccdID" );
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function runEditCCD($data) {
        $update = array( 
            "ccdCode" => Util::_trim($data['ccdCode']),"ccdName" => $data['ccdName']
            );
            
        $bind = array( ":ccdID" => $data['ccdID'] );
        
        $q = DB::inst()->update( "ccd",$update,"ccdID = :ccdID",$bind );
                
        redirect( BASE_URL . 'form/view_ccd/' . $data['ccdID'] . '/' . bm() );
    }
    
    public function ccd($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "ccd","ccdID = :id","","*",$bind );
    	foreach($q as $r) {
    	    $array[] = $r;   
		}
        return $array;
    }
    
    public function deleteCCD($id) {
        $bind = array( ":id" => $id );
        $q = DB::inst()->delete( "ccd", "ccdID = :id", $bind );
        
        if($q) {
            redirect( BASE_URL . 'success/delete_record/' );
        } else {
            redirect( BASE_URL . 'error/delete_record/');
        }
    }
    /* End CCD */
    
    /* Begin CIP */
    public function runCIP($data) {
        $bind = array( 
            "cipCode" => Util::_trim($data['cipCode']),"cipName" => $data['cipName']
            );
            
        $q = DB::inst()->insert( "cip", $bind );
        
        $ID = DB::inst()->lastInsertId();
            
        redirect( BASE_URL . 'form/view_cip/' . $ID . '/' . bm() );
    
    }
    
    public function cipList() {
        $q = DB::inst()->query( "SELECT * FROM cip WHERE cipCode <> 'NULL' ORDER BY cipID" );
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function runEditCIP($data) {
        $update = array( 
            "cipCode" => Util::_trim($data['cipCode']),"cipName" => $data['cipName']
            );
            
        $bind = array( ":cipID" => $data['cipID'] );
        
        $q = DB::inst()->update( "cip",$update,"cipID = :cipID",$bind );
                
        redirect( BASE_URL . 'form/view_cip/' . $data['cipID'] . '/' . bm() );
    }
    
    public function cip($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "cip","cipID = :id","","*",$bind );
        foreach($q as $r) {
    	    $array[] = $r;   
		}
        return $array;
    }
    
    public function deleteCIP($id) {
        $bind = array( ":cipID" => $id );
        $q = DB::inst()->delete( "cip", "cipID = :cipID", $bind );
        
        if($q) {
            redirect( BASE_URL . 'success/delete_record/' );
        } else {
            redirect( BASE_URL . 'error/delete_record/');
        }
    }
    /* End CIP */
    
    /* Begin Location */
    public function runLocation($data) {
        $bind = array( 
            "locationCode" => Util::_trim($data['locationCode']),"locationName" => $data['locationName']
            );
            
        $q = DB::inst()->insert( "location", $bind );
        
        $ID = DB::inst()->lastInsertId();
            
        redirect( BASE_URL . 'form/view_location/' . $ID . '/' . bm() );
    
    }
    
    public function locList() {
        $q = DB::inst()->query( "SELECT * FROM location WHERE locationCode <> 'NULL' ORDER BY locationID" );
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function runEditLocation($data) {
        $update = array( 
            "locationCode" => Util::_trim($data['locationCode']),"locationName" => $data['locationName']
            );
            
        $bind = array( ":locationID" => $data['locationID'] );
        
        $q = DB::inst()->update( "location",$update,"locationID = :locationID",$bind );
                
        redirect( BASE_URL . 'form/view_location/' . $data['locationID'] . '/' . bm() );
    }
    
    public function location($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "location","locationID = :id","","*",$bind );
        foreach($q as $r) {
    	    $array[] = $r;   
		}
        return $array;
    }
    
    public function deleteLocation($id) {
        $bind = array( ":locationID" => $id );
        $q = DB::inst()->delete( "location", "locationID = :locationID", $bind );
        
        if($q) {
            redirect( BASE_URL . 'success/delete_record/' );
        } else {
            redirect( BASE_URL . 'error/delete_record/');
        }
    }
    /* End Location */
    
    /* Begin Building */
    public function runBuilding($data) {
        $bind = array( 
            "buildingCode" => Util::_trim($data['buildingCode']),"buildingName" => $data['buildingName'],
            "locationCode" => Util::_trim($data['locationCode'])
            );
            
        $q = DB::inst()->insert( "building", $bind );
        
        $ID = DB::inst()->lastInsertId();
            
        redirect( BASE_URL . 'form/view_building/' . $ID . '/' . bm() );
    
    }
    
    public function buildList() {
        $q = DB::inst()->query( "SELECT * FROM building WHERE buildingCode <> 'NULL' ORDER BY buildingID" );
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function runEditBuilding($data) {
        $update = array( 
            "buildingCode" => Util::_trim($data['buildingCode']),"buildingName" => $data['buildingName'],
            "locationCode" => Util::_trim($data['locationCode'])
            );
            
        $bind = array( ":buildingID" => $data['buildingID'] );
        
        $q = DB::inst()->update( "building",$update,"buildingID = :buildingID",$bind );
                
        redirect( BASE_URL . 'form/view_building/' . $data['buildingID'] . '/' . bm() );
    }
    
    public function build($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "building","buildingID = :id","","*",$bind );
        foreach($q as $r) {
    	    $array[] = $r;   
		}
        return $array;
    }
    
    public function deleteBuilding($id) {
        $bind = array( ":buildingID" => $id );
        $q = DB::inst()->delete( "building", "buildingID = :buildingID", $bind );
        
        if($q) {
            redirect( BASE_URL . 'success/delete_record/' );
        } else {
            redirect( BASE_URL . 'error/delete_record/');
        }
    }
    /* End Building */
    
    /* Begin Room */
    public function runRoom($data) {
        $bind = array( 
            "buildingCode" => Util::_trim($data['buildingCode']),"roomCode" => Util::_trim($data['roomCode']),
            "roomNumber" => $data['roomNumber'],"roomCap" => $data['roomCap']
            );
            
        $q = DB::inst()->insert( "room", $bind );
        
        $ID = DB::inst()->lastInsertId();
            
        redirect( BASE_URL . 'form/view_room/' . $ID . '/' . bm() );
    
    }
    
    public function RoomList() {
        $q = DB::inst()->query( "SELECT 
                a.roomID,
                a.roomCode,
                a.roomNumber,
                a.roomCap,
                b.buildingName 
            FROM 
                room a 
            LEFT JOIN 
                building b 
            ON 
                a.buildingCode = b.buildingCode 
            WHERE 
            	a.roomCode <> 'NULL'" 
        );
        
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function runEditRoom($data) {
        $update = array( 
            "buildingCode" => Util::_trim($data['buildingCode']),"roomCode" => Util::_trim($data['roomCode']),
            "roomNumber" => $data['roomNumber'],"roomCap" => $data['roomCap']
            );
            
        $bind = array( ":roomID" => $data['roomID'] );
        
        $q = DB::inst()->update( "room",$update,"roomID = :roomID",$bind );
                
        redirect( BASE_URL . 'form/view_room/' . $data['roomID'] . '/' . bm() );
    }
    
    public function room($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "room","roomID = :id","","*",$bind );
        foreach($q as $r) {
    	    $array[] = $r;   
		}
        return $array;
    }
    
    public function deleteRoom($id) {
        $bind = array( ":roomID" => $id );
        $q = DB::inst()->delete( "room", "roomID = :roomID", $bind );
        
        if($q) {
            redirect( BASE_URL . 'success/delete_record/' );
        } else {
            redirect( BASE_URL . 'error/delete_record/');
        }
    }
    /* End Room */
    
    /* Begin Specialization */
    public function runSpec($data) {
        $bind = array( 
            "specCode" => Util::_trim($data['specCode']),"specName" => $data['specName']
            );
            
        $q = DB::inst()->insert( "specialization", $bind );
        
        $ID = DB::inst()->lastInsertId();
            
        redirect( BASE_URL . 'form/view_specialization/' . $ID . '/' . bm() );
    
    }
    
    public function specList() {
        $q = DB::inst()->query( "SELECT * FROM specialization WHERE specCode <> 'NULL' ORDER BY specID" );
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function runEditSpec($data) {
        $update = array( 
            "specCode" => Util::_trim($data['specCode']),"specName" => $data['specName']
            );
            
        $bind = array( ":specID" => $data['specID'] );
        
        $q = DB::inst()->update( "specialization",$update,"specID = :specID",$bind );
                
        redirect( BASE_URL . 'form/view_specialization/' . $data['specID'] . '/' . bm() );
    }
    
    public function specialization($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "specialization","specID = :id","","*",$bind );
        foreach($q as $r) {
    	    $array[] = $r;   
		}
        return $array;
    }
    
    public function deleteSpec($id) {
        $bind = array( ":specID" => $id );
        $q = DB::inst()->delete( "specialization", "specID = :specID", $bind );
        
        if($q) {
            redirect( BASE_URL . 'success/delete_record/' );
        } else {
            redirect( BASE_URL . 'error/delete_record/');
        }
    }
    /* End Specialization */
    
    /* Begin Class Status */
    public function runClassYear($data) {
        $bind = array( 
            "acadLevelCode" => Util::_trim($data['acadLevelCode']),"classYear" => Util::_trim($data['classYear']),
            "minCredits" => $data['minCredits'],"maxCredits" => $data['maxCredits']
            );
            
        $q = DB::inst()->insert( "class_year", $bind );
        
        $ID = DB::inst()->lastInsertId('yearID');
            
        redirect( BASE_URL . 'form/view_class_year/' . $ID . '/' . bm() );
    
    }
    
    public function yearList() {
        $q = DB::inst()->query( "SELECT * FROM class_year ORDER BY yearID" );
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function runEditClassYear($data) {
        $update = array( 
            "acadLevelCode" => Util::_trim($data['acadLevelCode']),"classYear" => Util::_trim($data['classYear']),
            "minCredits" => $data['minCredits'],"maxCredits" => $data['maxCredits']
            );
            
        $bind = array( ":yearID" => $data['yearID'] );
        
        $q = DB::inst()->update( "class_year",$update,"yearID = :yearID",$bind );
                
        redirect( BASE_URL . 'form/view_class_year/' . $data['yearID'] . '/' . bm() );
    }
    
    public function year($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "class_year","yearID = :id","","*",$bind );
        foreach($q as $r) {
    	    $array[] = $r;   
		}
        return $array;
    }
    
    public function deleteClassYear($id) {
        $bind = array( ":yearID" => $id );
        $q = DB::inst()->delete( "class_year", "yearID = :yearID", $bind );
        
        if($q) {
            redirect( BASE_URL . 'success/delete_record/' );
        } else {
            redirect( BASE_URL . 'error/delete_record/');
        }
    }
    /* End Class Status */
    
    /* Begin Subject */
    public function runSubj($data) {
        $bind = array( 
            "subjectCode" => Util::_trim($data['subjectCode']),"subjectName" => $data['subjectName']
            );
            
        $q = DB::inst()->insert( "subject", $bind );
        
        $ID = DB::inst()->lastInsertId();
            
        redirect( BASE_URL . 'form/view_subject/' . $ID . '/' . bm() );
    
    }
    
    public function subjList() {
        $q = DB::inst()->query( "SELECT * FROM subject WHERE subjectCode <> 'NULL' ORDER BY subjectID" );
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function runEditSubj($data) {
        $update = array( 
            "subjectCode" => Util::_trim($data['subjectCode']),"subjectName" => $data['subjectName']
            );
            
        $bind = array( ":subjectID" => $data['subjectID'] );
        
        $q = DB::inst()->update( "subject",$update,"subjectID = :subjectID",$bind );
                
        redirect( BASE_URL . 'form/view_subject/' . $data['subjectID'] . '/' . bm() );
    }
    
    public function subj($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "subject","subjectID = :id","","*",$bind );
        foreach($q as $r) {
    	    $array[] = $r;   
		}
        return $array;
    }
    
    public function deleteSubj($id) {
        $bind = array( ":subjectID" => $id );
        $q = DB::inst()->delete( "subject", "subjectID = :subjectID", $bind );
        
        if($q) {
            redirect( BASE_URL . 'success/delete_record/' );
        } else {
            redirect( BASE_URL . 'error/delete_record/');
        }
    }
    /* End Subject */
    
    /* Begin School */
    public function runSchool($data) {
        $bind = array( 
            "schoolCode" => Util::_trim($data['schoolCode']),
            "schoolName" => $data['schoolName'],"buildingCode" => Util::_trim($data['buildingCode'])
            );
            
        $q = DB::inst()->insert( "school", $bind );
        
        $ID = DB::inst()->lastInsertId();
            
        redirect( BASE_URL . 'form/view_school/' . $ID . '/' . bm() );
    
    }
    
    public function schoolList() {
        $array = [];
        //$q = DB::inst()->query( "SELECT * FROM school ORDER BY schoolID" );
        $q = DB::inst()->query( "SELECT 
                        a.schoolID,
                        a.schoolCode,
                        a.schoolName,
                        b.buildingName 
                    FROM 
                        school a 
                    LEFT JOIN 
                        building b 
                    ON 
                        a.buildingCode = b.buildingCode 
                    WHERE 
                    	a.schoolCode <> 'NULL' 
                    ORDER BY 
                        schoolID" 
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function runEditSchool($data) {
        $update = array( 
            "schoolCode" => Util::_trim($data['schoolCode']),
            "schoolName" => $data['schoolName'],"buildingCode" => Util::_trim($data['buildingCode'])
            );
            
        $bind = array( ":schoolID" => $data['schoolID'] );
        
        $q = DB::inst()->update( "school",$update,"schoolID = :schoolID",$bind );
                
        redirect( BASE_URL . 'form/view_school/' . $data['schoolID'] . '/' . bm() );
    }
    
    public function school($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "school","schoolID = :id","","*",$bind );
        foreach($q as $r) {
    	    $array[] = $r;   
		}
        return $array;
    }
    
    public function deleteSchool($id) {
        $bind = array( ":schoolID" => $id );
        $q = DB::inst()->delete( "school", "schoolID = :schoolID", $bind );
        
        if($q) {
            redirect( BASE_URL . 'success/delete_record/' );
        } else {
            redirect( BASE_URL . 'error/delete_record/');
        }
    }
    /* End School */
    
    /* Begin Institution */
    public function runInst($data) {
        $bind = array( 
            "ficeCode" => Util::_trim($data['ficeCode']),"instName" => $data['instName'],
            "city" => $data['city'], "state" => $data['state']
            );
            
        $q = DB::inst()->insert( "institution", $bind );
        
        $ID = DB::inst()->lastInsertId();
            
        redirect( BASE_URL . 'form/view_institution/' . $ID . '/' . bm() );
    
    }
    
    public function instList() {
        $q = DB::inst()->query( "SELECT * FROM institution ORDER BY institutionID" );
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function runEditInst($data) {
        $update = array( 
            "ficeCode" => Util::_trim($data['ficeCode']),"instName" => $data['instName'],
            "city" => $data['city'], "state" => $data['state']
            );
            
        $bind = array( ":institutionID" => $data['institutionID'] );
        
        $q = DB::inst()->update( "institution",$update,"institutionID = :institutionID",$bind );
                
        redirect( BASE_URL . 'form/view_institution/' . $data['institutionID'] . '/' . bm() );
    }
    
    public function inst($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "institution","institutionID = :id","","*",$bind );
        foreach($q as $r) {
    	    $array[] = $r;   
		}
        return $array;
    }
    
    public function deleteInst($id) {
        $bind = array( ":institutionID" => $id );
        $q = DB::inst()->delete( "institution", "institutionID = :institutionID", $bind );
        
        if($q) {
            redirect( BASE_URL . 'success/delete_record/' );
        } else {
            redirect( BASE_URL . 'error/delete_record/');
        }
    }
    /* End Institution */
    
    /* Begin Grade Scale */
    public function runGradeScale($data) {
    	if(!empty($data['update']) && $data['update'] == 1) {
    		$update = array( 
            "grade" => $data['grade'],"percent" => $data['percent'],
            "points" => $data['points'], "status" => $data['status'],
            "description" => $data['description'],"count_in_gpa" => $data['count_in_gpa']
            );
            
	        $bind = array( ":id" => $data['ID'] );
	        
	        $q = DB::inst()->update( "grade_scale",$update,"ID = :id",$bind );
	        redirect( BASE_URL . 'form/view_grade_scale/' . $data['ID'] . '/' . bm() );
		} else {
	        $bind = array( 
	            "grade" => $data['grade'],"percent" => $data['percent'],
	            "points" => $data['points'], "status" => $data['status'],
	            "description" => $data['description'],"count_in_gpa" => $data['count_in_gpa']
	            );
	            
	        $q = DB::inst()->insert( "grade_scale", $bind );
	        $ID = DB::inst()->lastInsertId();
	        redirect( BASE_URL . 'form/view_grade_scale/' . $ID . '/' . bm() );
		}
    
    }
    
    public function gradeScale() {
    	$array = [];
		$q = DB::inst()->query( "SELECT 
					CASE 
						status 
					WHEN '1' THEN 'Active' 
					ELSE 'Inactive' 
					END AS 'Status',
						ID,
						grade,
						percent,
						points 
					FROM 
						grade_scale 
					ORDER BY 
						grade" 
		);
        foreach($q as $r) {
        	$array[] = $r;
        }
        return $array;
    }
    
    public function scale($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "grade_scale","ID = :id","","*",$bind );
        foreach($q as $r) {
    	    $array[] = $r;   
		}
        return $array;
    }
    
    public function deleteGradeScale($id) {
        $bind = array( ":id" => $id );
        $q = DB::inst()->delete( "grade_scale", "ID = :id", $bind );
        
        if($q) {
            redirect( BASE_URL . 'success/delete_record/' );
        } else {
            redirect( BASE_URL . 'error/delete_record/');
        }
    }
    /* End Grade Scale */
    
    /* Begin Restriction Code */
    public function runRSTRCode($data) {
        if(!empty($data['update']) && $data['update'] == 1) {
            $update = array( 
            "rtrCode" => Util::_trim($data['rstrCode']),"description" => $data['description'],
            "deptCode" => Util::_trim($data['deptCode'])
            );
            
            $bind = array( ":id" => $data['rstrCodeID'] );
            
            $q = DB::inst()->update( "restriction_code",$update,"rstrCodeID = :id",$bind );
            redirect( BASE_URL . 'form/view_rstr_code/' . $data['rstrCodeID'] . '/' . bm() );
        } else {
            $bind = array( 
                "rstrCode" => Util::_trim($data['rstrCode']),"description" => $data['description'],
                "deptCode" => Util::_trim($data['deptCode'])
                );
                
            $q = DB::inst()->insert( "restriction_code", $bind );
            $ID = DB::inst()->lastInsertId();
            redirect( BASE_URL . 'form/view_rstr_code/' . $ID . '/' . bm() );
        }
    
    }
    
    public function rstrCodeList() {
        $array = [];
        $q = DB::inst()->query( "SELECT 
                    a.*,
                    b.deptName 
                FROM 
                    restriction_code a 
                LEFT JOIN 
                    department b 
                ON 
                    a.deptCode = b.deptCode" 
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function rstr($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "restriction_code","rstrCodeID = :id","","*",$bind );
        foreach($q as $r) {
            $array[] = $r;   
        }
        return $array;
    }
    /* End Restriction Code */
    
    public function __destruct() {
        DB::inst()->close();
    }

}