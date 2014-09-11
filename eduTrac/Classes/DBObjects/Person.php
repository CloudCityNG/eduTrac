<?php namespace eduTrac\Classes\DBObjects;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Person DBObject Class
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
class Person {

	private $_personID; //int(8) unsigned zerofill
	private $_uname; //varchar(80)
	private $_prefix; //varchar(6)
	private $_personType; //varchar(3)
	private $_fname; //varchar(150)
	private $_lname; //varchar(150)
	private $_mname; //varchar(2)
	private $_email; //varchar(150)
	private $_ssn; //int(9)
	private $_dob; //date
	private $_veteran; //enum('1','0')
	private $_ethnicity; //varchar(30)
	private $_gender; //enum('M','F')
	private $_emergency_contact; //varchar(150)
	private $_emergency_contact_phone; //varchar(50)
	private $_password; //varchar(255)
	private $_auth_token; //varchar(255)
	private $_approvedDate; //datetime
	private $_approvedBy; //int(8) unsigned zerofill
	private $_LastUpdate; //timestamp
	private $_connection;

    /**
     * New object to the class. Don�t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_person($uname,$prefix,$personType,$fname,$lname,$mname,$email,$ssn,$dob,$veteran,$ethnicity,$gender,$emergency_contact,$emergency_contact_phone,$password,$auth_token,$approvedDate,$approvedBy,$LastUpdate){
		$this->_uname = $uname;
		$this->_prefix = $prefix;
		$this->_personType = $personType;
		$this->_fname = $fname;
		$this->_lname = $lname;
		$this->_mname = $mname;
		$this->_email = $email;
		$this->_ssn = $ssn;
		$this->_dob = $dob;
		$this->_veteran = $veteran;
		$this->_ethnicity = $ethnicity;
		$this->_gender = $gender;
		$this->_emergency_contact = $emergency_contact;
		$this->_emergency_contact_phone = $emergency_contact_phone;
		$this->_password = $password;
		$this->_auth_token = $auth_token;
		$this->_approvedDate = $approvedDate;
		$this->_approvedBy = $approvedBy;
		$this->_LastUpdate = $LastUpdate;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
	    $bind = array( ":id" => $key_row );
		$q = DB::inst()->select( "person","personID = :id","personID","*",$bind );
		foreach($q as $row){
			$this->_personID = $row["personID"];
			$this->_uname = $row["uname"];
			$this->_prefix = $row["prefix"];
			$this->_personType = $row["personType"];
			$this->_fname = $row["fname"];
			$this->_lname = $row["lname"];
			$this->_mname = $row["mname"];
			$this->_email = $row["email"];
			$this->_ssn = $row["ssn"];
			$this->_dob = $row["dob"];
			$this->_veteran = $row["veteran"];
			$this->_ethnicity = $row["ethnicity"];
			$this->_gender = $row["gender"];
			$this->_emergency_contact = $row["emergency_contact"];
			$this->_emergency_contact_phone = $row["emergency_contact_phone"];
			$this->_password = $row["password"];
			$this->_auth_token = $row["auth_token"];
			$this->_approvedDate = $row["approvedDate"];
			$this->_approvedBy = $row["approvedBy"];
			$this->_LastUpdate = $row["LastUpdate"];
		}
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$q = DB::inst()->query( "SELECT personID FROM person ORDER BY $column $order" );
			while($row = $q->fetch(\PDO::FETCH_ASSOC)){
				$keys[$i] = $row["personID"];
				$i++;
			}
	return $keys;
	}
    
    public function nonStuList() {
        $q1 = DB::inst()->query( "SELECT * FROM student" );
        $r1 = $q1->fetch(\PDO::FETCH_ASSOC);
        $stuID = _h($r1['stuID']);
        $q2 = DB::inst()->select( "person","personID != '$stuID'","lname","personID" );
        foreach($q2 as $r2) {
            $array[] = $r2;
        }
        return $array;
    }
    
    public function isFacID() {
        $q = DB::inst()->query( "SELECT facID FROM faculty" );
        while($r = $q->fetch(\PDO::FETCH_ASSOC)) {
            return $r['facID'];
        }
    }
    
    public function isStaffID($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "staff","staffID = :id","","*",$bind );
        foreach($q as $r) {
            $array[] = $r;
        }
        return _h($r['staffID']);
    }
    
    public function getFacList() {
        $array = [];
        $q = DB::inst()->query( "SELECT 
                        a.staffID 
                    FROM 
                        staff a 
                    LEFT JOIN 
                        person b 
                    ON 
                        a.staffID = b.personID 
                    WHERE 
                        a.staffType = 'FAC' 
                    ORDER BY 
                        b.lname" 
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function isStuID($id) {
    	$array = [];
		$bind = [ ":id" => $id ];
        $q = DB::inst()->query( "SELECT stuID FROM student WHERE stuID = :id",$bind );
        if(count($q) > 0) {
        	return true;
        } else {
        	return false;
        }
    }

	/**
	 * @return personID - int(8) unsigned zerofill
	 */
	public function getPersonID(){
		return $this->_personID;
	}

	/**
	 * @return uname - varchar(80)
	 */
	public function getuname(){
		return $this->_uname;
	}

	/**
	 * @return prefix - varchar(6)
	 */
	public function getprefix(){
		return $this->_prefix;
	}

	/**
	 * @return personType - varchar(3)
	 */
	public function getPersonType(){
		return $this->_personType;
	}

	/**
	 * @return fname - varchar(150)
	 */
	public function getfname(){
		return $this->_fname;
	}

	/**
	 * @return lname - varchar(150)
	 */
	public function getlname(){
		return $this->_lname;
	}

	/**
	 * @return mname - varchar(2)
	 */
	public function getmname(){
		return $this->_mname;
	}

	/**
	 * @return email - varchar(150)
	 */
	public function getemail(){
		return $this->_email;
	}

	/**
	 * @return ssn - int(9)
	 */
	public function getssn(){
		return $this->_ssn;
	}

	/**
	 * @return dob - date
	 */
	public function getdob(){
		return $this->_dob;
	}

	/**
	 * @return veteran - enum('1','0')
	 */
	public function getveteran(){
		return $this->_veteran;
	}

	/**
	 * @return ethnicity - varchar(30)
	 */
	public function getethnicity(){
		return $this->_ethnicity;
	}

	/**
	 * @return gender - enum('M','F')
	 */
	public function getgender(){
		return $this->_gender;
	}

	/**
	 * @return emergency_contact - varchar(150)
	 */
	public function getemergency_contact(){
		return $this->_emergency_contact;
	}

	/**
	 * @return emergency_contact_phone - varchar(50)
	 */
	public function getemergency_contact_phone(){
		return $this->_emergency_contact_phone;
	}

	/**
	 * @return approvedDate - datetime
	 */
	public function getApprovedDate(){
		return $this->_approvedDate;
	}

	/**
	 * @return approvedBy - int(8) unsigned zerofill
	 */
	public function getApprovedBy(){
		return $this->_approvedBy;
	}

	/**
	 * @return LastUpdate - timestamp
	 */
	public function getLastUpdate(){
		return $this->_LastUpdate;
	}

}