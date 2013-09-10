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
 * @since       1.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

use \eduTrac\Classes\Core\DB;
class FormModel {

	public function __construct() {}
	
	/* Begins semester methods */
	public function runSemester($data) {			
		$bind = array( 
		      "acadYearID" => $data['acadYearID'],"semCode" => $data['semCode'],
		      "semName" => $data['semName'],"semStartDate" => $data['semStartDate'],
		      "semEndDate" => $data['semEndDate'],"active" => $data['active'] 
        );
        
        $q = DB::inst()->insert( "semester", $bind );
		$ID = DB::inst()->lastInsertId('semesterID');
		redirect( BASE_URL . 'form/view_semester/' . $ID . '/' . bm() );
	}
	
    public function semesterList() {
        $q = DB::inst()->query( "SELECT 
                a.semesterID, a.semName, a.semStartDate, a.semEndDate, a.active, b.acadYearID, b.acadYearCode 
            FROM 
                semester a 
            LEFT JOIN 
                acad_year b 
            ON 
                a.acadYearID = b.acadYearID" 
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
                "acadYearID" => $data['acadYearID'],"semCode" => $data['semCode'],
                "semName" => $data['semName'],"semStartDate" => $data['semStartDate'],
                "semEndDate" => $data['semEndDate'],"active" => $data['active'] 
        );
        
        $bind = array( ":semesterID" => $data['semesterID'] );
		$q = DB::inst()->update( "semester", $update, "semesterID = :semesterID", $bind );	
		redirect( BASE_URL . 'form/view_semester/' . $data['semesterID'] . '/' . bm() );
	}
	
	public function semester($id) {
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
		      "semesterID" => $data['semesterID'],"termCode" => $data['termCode'],
		      "termName" => $data['termName'],"reportingTerm" => $data['reportingTerm'],
		      "termStartDate" => $data['termStartDate'],"termEndDate" => $data['termEndDate'],
		      "active" => $data['active'] 
        );
		
		$q = DB::inst()->insert( "term", $bind );
		$ID = DB::inst()->lastInsertId();
		redirect( BASE_URL . 'form/view_term/' . $ID . '/' . bm() );
	
	}
	
	public function termList() {
        $q = DB::inst()->query( "SELECT 
                a.termID, a.termName, a.termStartDate, a.termEndDate, a.active, b.semName 
            FROM 
                term a 
            LEFT JOIN 
                semester b 
            ON 
                a.semesterID = b.semesterID" 
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
              "semesterID" => $data['semesterID'],"termCode" => $data['termCode'],
              "termName" => $data['termName'],"reportingTerm" => $data['reportingTerm'],
              "termStartDate" => $data['termStartDate'],"termEndDate" => $data['termEndDate'],
              "active" => $data['active'] 
        );
        
	    $bind = array(":termID" => $data['termID']);
		$q = DB::inst()->update( "term", $update, "termID = :termID", $bind );	
		redirect( BASE_URL . 'form/view_term/' . $data['termID'] . '/' . bm() );
	}
	
	public function term($id) {
		$q = DB::inst()->query( "SELECT * FROM term WHERE termID = '$id'");
		return $q->fetchAll(\PDO::FETCH_ASSOC);
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
			"acadYearCode" => $data['acadYearCode'],"acadYearDesc" => $data['acadYearDesc']
			);
			
		$q = DB::inst()->insert( "acad_year", $bind );
		
		$ID = DB::inst()->lastInsertId();
			
		redirect( BASE_URL . 'form/view_acad_year/' . $ID . '/' . bm() );
	
	}
    
    public function acadYearList() {
        $q = DB::inst()->query( "SELECT * FROM acad_year ORDER BY acadYearID" );
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }
	
	public function runEditAcadYear($data) {
		$update = array( 
			"acadYearCode" => $data['acadYearCode'],"acadYearDesc" => $data['acadYearDesc']
			);
			
		$bind = array( ":acadYearID" => $data['acadYearID'] );
		
		$q = DB::inst()->update( "acad_year",$update,"acadYearID = :acadYearID",$bind );
				
		redirect( BASE_URL . 'form/view_acad_year/' . $data['acadYearID'] . '/' . bm() );
	}
	
	public function acadYear($id) {
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
			"deptCode" => $data['deptCode'],"deptType" => $data['deptType'],
			"deptName" => $data['deptName'],"deptDesc" => $data['deptDesc']
			);
			
		$q = DB::inst()->insert( "department", $bind );
		
		$ID = DB::inst()->lastInsertId();
			
		redirect( BASE_URL . 'form/view_department/' . $ID . '/' . bm() );
	
	}
    
    public function deptList() {
        $q = DB::inst()->query( "SELECT * FROM department ORDER BY deptID" );
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }
	
	public function runEditDept($data) {
		$update = array( 
            "deptCode" => $data['deptCode'],"deptType" => $data['deptType'],
            "deptName" => $data['deptName'],"deptDesc" => $data['deptDesc']
            );
			
		$bind = array( ":deptID" => $data['deptID'] );
		
		$q = DB::inst()->update( "department",$update,"deptID = :deptID",$bind );
				
		redirect( BASE_URL . 'form/view_department/' . $data['deptID'] . '/' . bm() );
	}
	
	public function dept($id) {
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
	
	/* Begin credit load */
	public function runCredLoad($data) {
		$bind = array( 
			"credLoadCode" => $data['credLoadCode'],"credLoadName" => $data['credLoadName'],
			"credLoadCreds" => $data['credLoadCreds']
			);
			
		$q = DB::inst()->insert( "credit_load", $bind );
		
		$ID = DB::inst()->lastInsertId();
			
		redirect( BASE_URL . 'form/credit_load/' . $ID  . '/' . bm() );
	
	}
    
    public function credLoadList() {
        $q = DB::inst()->query( "SELECT * FROM credit_load ORDER BY credLoadID" );
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }
	
	public function runEditCredLoad($data) {
		$update = array( 
            "credLoadCode" => $data['credLoadCode'],"credLoadName" => $data['credLoadName'],
            "credLoadCreds" => $data['credLoadCreds']
            );
			
		$bind = array( ":credLoadID" => $data['credLoadID'] );
		
		$q = DB::inst()->update( "credit_load",$update,"credLoadID = :credLoadID",$bind );
				
		redirect( BASE_URL . 'form/view_credit_load/' . $data['credLoadID'] . '/' . bm() );
	}
	
	public function cl($id) {
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "credit_load","credLoadID = :id","","*",$bind );
		foreach($q as $r) {
    	    $array[] = $r;   
		}
        return $array;
	}
	
	public function deleteCredLoad($id) {
        $bind = array( ":id" => $id );
		$q = DB::inst()->delete( "credit_load", "credLoadID = :id", $bind );
		
		if($q) {
			redirect( BASE_URL . 'success/delete_record/' );
		} else {
			redirect( BASE_URL . 'error/delete_record/');
		}
	}
	/* End credit load */
	
	/* Begin degrees */
	public function runDegree($data) {
		$bind = array( 
            "degreeCode" => $data['degreeCode'],"degreeName" => $data['degreeName'] 
            );
			
		$q = DB::inst()->insert( "degree", $bind );
		
		$ID = DB::inst()->lastInsertId();
			
		redirect( BASE_URL . 'form/view_degree/' . $ID . '/' . bm() );
	
	}
    
    public function degreeList() {
        $q = DB::inst()->query( "SELECT * FROM degree ORDER BY degreeID" );
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }
	
	public function runEditDegree($data) {
		$update = array( 
			"degreeCode" => $data['degreeCode'],"degreeName" => $data['degreeName'] 
			);
			
		$bind = array( ":degreeID" => $data['degreeID']  );
		
		$q = DB::inst()->update( "degree",$update,"degreeID = :degreeID",$bind );
				
		redirect( BASE_URL . 'form/view_degree/' . $data['degreeID'] . '/' . bm() );
	}
	
	public function degree($id) {
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
			"majorCode" => $data['majorCode'],"majorName" => $data['majorName']
			);
			
		$q = DB::inst()->insert( "major", $bind );
		
		$ID = DB::inst()->lastInsertId();
			
		redirect( BASE_URL . 'form/view_major/' . $ID . '/' . bm() );
	
	}
    
    public function majorList() {
        $q = DB::inst()->query( "SELECT * FROM major ORDER BY majorID" );
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }
	
	public function runEditMajor($data) {
		$update = array( 
			"majorCode" => $data['majorCode'],"majorName" => $data['majorName'] 
			);
			
		$bind = array( ":majorID" => $data['majorID'] );
		
		$q = DB::inst()->update( "major",$update,"majorID = :majorID",$bind );
				
		redirect( BASE_URL . 'form/view_major/' . $data['majorID'] . '/' . bm() );
	}
	
	public function major($id) {
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
			"minorCode" => $data['minorCode'],"minorName" => $data['minorName']
			);
			
		$q = DB::inst()->insert( "minor", $bind );
		
		$ID = DB::inst()->lastInsertId();
			
		redirect( BASE_URL . 'form/view_minor/' . $ID . '/' . bm() );
	
	}
    
    public function minorList() {
        $q = DB::inst()->query( "SELECT * FROM minor ORDER BY minorID" );
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }
	
	public function runEditMinor($data) {
		$update = array( 
            "minorCode" => $data['minorCode'],"minorName" => $data['minorName']
            );
			
		$bind = array( ":minorID" => $data['minorID'] );
		
		$q = DB::inst()->update( "minor",$update,"minorID = :minorID",$bind );
				
		redirect( BASE_URL . 'form/view_minor/' . $data['minorID'] . '/' . bm() );
	}
	
	public function minor($id) {
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
            "ccdCode" => $data['ccdCode'],"ccdName" => $data['ccdName'],
            "addDate" => $date
            );
            
        $q = DB::inst()->insert( "ccd", $bind );
        
        $ID = DB::inst()->lastInsertId();
            
        redirect( BASE_URL . 'form/view_ccd/' . $ID . '/' . bm() );
    
    }
    
    public function ccdList() {
        $q = DB::inst()->query( "SELECT * FROM ccd ORDER BY ccdID" );
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function runEditCCD($data) {
        $update = array( 
            "ccdCode" => $data['ccdCode'],"ccdName" => $data['ccdName']
            );
            
        $bind = array( ":ccdID" => $data['ccdID'] );
        
        $q = DB::inst()->update( "ccd",$update,"ccdID = :ccdID",$bind );
                
        redirect( BASE_URL . 'form/view_ccd/' . $data['ccdID'] . '/' . bm() );
    }
    
    public function ccd($id) {
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
            "cipCode" => $data['cipCode'],"cipName" => $data['cipName']
            );
            
        $q = DB::inst()->insert( "cip", $bind );
        
        $ID = DB::inst()->lastInsertId();
            
        redirect( BASE_URL . 'form/view_cip/' . $ID . '/' . bm() );
    
    }
    
    public function cipList() {
        $q = DB::inst()->query( "SELECT * FROM cip ORDER BY cipID" );
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function runEditCIP($data) {
        $update = array( 
            "cipCode" => $data['cipCode'],"cipName" => $data['cipName']
            );
            
        $bind = array( ":cipID" => $data['cipID'] );
        
        $q = DB::inst()->update( "cip",$update,"cipID = :cipID",$bind );
                
        redirect( BASE_URL . 'form/view_cip/' . $data['cipID'] . '/' . bm() );
    }
    
    public function cip($id) {
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
            "locationCode" => $data['locationCode'],"locationName" => $data['locationName']
            );
            
        $q = DB::inst()->insert( "location", $bind );
        
        $ID = DB::inst()->lastInsertId();
            
        redirect( BASE_URL . 'form/view_location/' . $ID . '/' . bm() );
    
    }
    
    public function locList() {
        $q = DB::inst()->query( "SELECT * FROM location ORDER BY locationID" );
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function runEditLocation($data) {
        $update = array( 
            "locationCode" => $data['locationCode'],"locationName" => $data['locationName']
            );
            
        $bind = array( ":locationID" => $data['locationID'] );
        
        $q = DB::inst()->update( "location",$update,"locationID = :locationID",$bind );
                
        redirect( BASE_URL . 'form/view_location/' . $data['locationID'] . '/' . bm() );
    }
    
    public function location($id) {
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
            "buildingCode" => $data['buildingCode'],"buildingName" => $data['buildingName']
            );
            
        $q = DB::inst()->insert( "building", $bind );
        
        $ID = DB::inst()->lastInsertId();
            
        redirect( BASE_URL . 'form/view_building/' . $ID . '/' . bm() );
    
    }
    
    public function buildList() {
        $q = DB::inst()->query( "SELECT * FROM building ORDER BY buildingID" );
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function runEditBuilding($data) {
        $update = array( 
            "buildingCode" => $data['buildingCode'],"buildingName" => $data['buildingName']
            );
            
        $bind = array( ":buildingID" => $data['buildingID'] );
        
        $q = DB::inst()->update( "building",$update,"buildingID = :buildingID",$bind );
                
        redirect( BASE_URL . 'form/view_building/' . $data['buildingID'] . '/' . bm() );
    }
    
    public function build($id) {
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
            "buildingID" => $data['buildingID'],"roomCode" => $data['roomCode'],
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
                a.buildingID = b.buildingID" 
        );
        
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function runEditRoom($data) {
        $update = array( 
            "buildingID" => $data['buildingID'],"roomCode" => $data['roomCode'],
            "roomNumber" => $data['roomNumber'],"roomCap" => $data['roomCap']
            );
            
        $bind = array( ":roomID" => $data['roomID'] );
        
        $q = DB::inst()->update( "room",$update,"roomID = :roomID",$bind );
                
        redirect( BASE_URL . 'form/view_room/' . $data['roomID'] . '/' . bm() );
    }
    
    public function room($id) {
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
            "specCode" => $data['specCode'],"specName" => $data['specName']
            );
            
        $q = DB::inst()->insert( "specialization", $bind );
        
        $ID = DB::inst()->lastInsertId();
            
        redirect( BASE_URL . 'form/view_specialization/' . $ID . '/' . bm() );
    
    }
    
    public function specList() {
        $q = DB::inst()->query( "SELECT * FROM specialization ORDER BY specID" );
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function runEditSpec($data) {
        $update = array( 
            "specCode" => $data['specCode'],"specName" => $data['specName']
            );
            
        $bind = array( ":specID" => $data['specID'] );
        
        $q = DB::inst()->update( "specialization",$update,"specID = :specID",$bind );
                
        redirect( BASE_URL . 'form/view_specialization/' . $data['specID'] . '/' . bm() );
    }
    
    public function specialization($id) {
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
            "acadLevelCode" => $data['acadLevelCode'],"classYear" => $data['classYear'],
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
            "acadLevelCode" => $data['acadLevelCode'],"classYear" => $data['classYear'],
            "minCredits" => $data['minCredits'],"maxCredits" => $data['maxCredits']
            );
            
        $bind = array( ":yearID" => $data['yearID'] );
        
        $q = DB::inst()->update( "class_year",$update,"yearID = :yearID",$bind );
                
        redirect( BASE_URL . 'form/view_class_year/' . $data['yearID'] . '/' . bm() );
    }
    
    public function year($id) {
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
            "subjCode" => $data['subjCode'],"subjName" => $data['subjName']
            );
            
        $q = DB::inst()->insert( "subject", $bind );
        
        $ID = DB::inst()->lastInsertId();
            
        redirect( BASE_URL . 'form/view_subject/' . $ID . '/' . bm() );
    
    }
    
    public function subjList() {
        $q = DB::inst()->query( "SELECT * FROM subject ORDER BY subjectID" );
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function runEditSubj($data) {
        $update = array( 
            "subjCode" => $data['subjCode'],"subjName" => $data['subjName']
            );
            
        $bind = array( ":subjectID" => $data['subjectID'] );
        
        $q = DB::inst()->update( "subject",$update,"subjectID = :subjectID",$bind );
                
        redirect( BASE_URL . 'form/view_subject/' . $data['subjectID'] . '/' . bm() );
    }
    
    public function subj($id) {
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
            "schoolCode" => $data['schoolCode'],"schoolName" => $data['schoolName'],
            "buildingID" => $data['buildingID']
            );
            
        $q = DB::inst()->insert( "school", $bind );
        
        $ID = DB::inst()->lastInsertId();
            
        redirect( BASE_URL . 'form/view_school/' . $ID . '/' . bm() );
    
    }
    
    public function schoolList() {
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
                        a.buildingID = b.buildingID 
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
            "schoolCode" => $data['schoolCode'],"schoolName" => $data['schoolName'],
            "buildingID" => $data['buildingID']
            );
            
        $bind = array( ":schoolID" => $data['schoolID'] );
        
        $q = DB::inst()->update( "school",$update,"schoolID = :schoolID",$bind );
                
        redirect( BASE_URL . 'form/view_school/' . $data['schoolID'] . '/' . bm() );
    }
    
    public function school($id) {
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
            "ficeCode" => $data['ficeCode'],"instName" => $data['instName'],
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
            "ficeCode" => $data['ficeCode'],"instName" => $data['instName'],
            "city" => $data['city'], "state" => $data['state']
            );
            
        $bind = array( ":institutionID" => $data['institutionID'] );
        
        $q = DB::inst()->update( "institution",$update,"institutionID = :institutionID",$bind );
                
        redirect( BASE_URL . 'form/view_institution/' . $data['institutionID'] . '/' . bm() );
    }
    
    public function inst($id) {
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
    
    public function __destruct() {
        DB::inst()->close();
    }

}