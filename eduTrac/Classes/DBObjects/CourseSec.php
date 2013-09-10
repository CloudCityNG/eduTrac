<?php namespace eduTrac\Classes\DBObjects;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
use \eduTrac\Classes\Core\DB;
/**
 * Course Section DBObject Class
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

class CourseSec {

	protected $_courseSecID;
	protected $_sectionNumber;
	protected $_courseSecCode;
	protected $_buildingCode;
	protected $_roomCode;
	protected $_locationCode;
	protected $_courseLevelCode;
	protected $_acadLevelCode;
	protected $_deptCode;
	protected $_facID;
	protected $_termCode;
	protected $_courseID;
	protected $_preReqs;
	protected $_secShortTitle;
	protected $_termStartDate;
	protected $_termEndDate;
	protected $_dotw;
	protected $_minCredit;
	protected $_maxCredit;
	protected $_increCredit;
	protected $_ceu;
	protected $_creditHours;
	protected $_stuReg;
	protected $_secType;
	protected $_currStatus;
	protected $_statusDate;
	protected $_approvedDate;
	protected $_approvedBy;
	protected $_LastUpdate;

    public function __construct() {}
    
    public function sectCode($id) {
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "course_sec", "courseSecID = :id", "", "courseSecCode", $bind );
        foreach( $q as $r) {
            $array[] = $r['courseSecCode'];
        }
        return $array;
    }

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$bind = array( ":id" => $key_row );
        $q = DB::inst()->select( "course_sec", "courseSecID = :id", "", "*", $bind );
        foreach( $q as $row) {
			$this->_courseSecID = $row["courseSecID"];
			$this->_sectionNumber = $row["sectionNumber"];
			$this->_courseSecCode = $row["courseSecCode"];
			$this->_buildingCode = $row["buildingCode"];
			$this->_roomCode = $row["roomCode"];
			$this->_locationCode = $row["locationCode"];
			$this->_courseLevelCode = $row["courseLevelCode"];
			$this->_acadLevelCode = $row["acadLevelCode"];
			$this->_deptCode = $row["deptCode"];
			$this->_facID = $row["facID"];
			$this->_termCode = $row["termCode"];
			$this->_courseID = $row["courseID"];
			$this->_preReqs = $row["preReqs"];
			$this->_secShortTitle = $row["secShortTitle"];
			$this->_termStartDate = $row["termStartDate"];
			$this->_termEndDate = $row["termEndDate"];
			$this->_dotw = $row["dotw"];
			$this->_minCredit = $row["minCredit"];
			$this->_maxCredit = $row["maxCredit"];
			$this->_increCredit = $row["increCredit"];
			$this->_ceu = $row["ceu"];
			$this->_creditHours = $row["creditHours"];
			$this->_stuReg = $row["stuReg"];
			$this->_secType = $row["secType"];
			$this->_currStatus = $row["currStatus"];
			$this->_statusDate = $row["statusDate"];
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
        $q = DB::inst()->query("SELECT courseSecID FROM course_sec ORDER BY $column $order");
            foreach($q as $row) {
                $keys[$i] = $row["courseSecID"];
                $i++;
            }
    return $keys;
    }

	/**
	 * @return courseSecID - int(11) unsigned zerofill
	 */
	public function getcourseSecID(){
		return $this->_courseSecID;
	}

	/**
	 * @return sectionNumber - varchar(5)
	 */
	public function getsectionNumber(){
		return $this->_sectionNumber;
	}

	/**
	 * @return courseSecCode - varchar(50)
	 */
	public function getCourseSecCode(){
		return $this->_courseSecCode;
	}

	/**
	 * @return buildingCode - varchar(11)
	 */
	public function getbuildingCode(){
		return $this->_buildingCode;
	}

	/**
	 * @return roomCode - varchar(11)
	 */
	public function getroomCode(){
		return $this->_roomCode;
	}

	/**
	 * @return locationCode - varchar(6)
	 */
	public function getlocationCode(){
		return $this->_locationCode;
	}

	/**
	 * @return courseLevelCode - int(5)
	 */
	public function getcourseLevelCode(){
		return $this->_courseLevelCode;
	}

	/**
	 * @return acadLevelCode - varchar(4)
	 */
	public function getacadLevelCode(){
		return $this->_acadLevelCode;
	}

	/**
	 * @return deptCode - varchar(11)
	 */
	public function getdeptCode(){
		return $this->_deptCode;
	}

	/**
	 * @return facID - int(8)
	 */
	public function getfacID(){
		return $this->_facID;
	}

	/**
	 * @return termCode - varchar(11)
	 */
	public function getTermCode(){
		return $this->_termCode;
	}

	/**
	 * @return courseID - int(8) unsigned zerofill
	 */
	public function getcourseID(){
		return $this->_courseID;
	}

	/**
	 * @return preReqs - text
	 */
	public function getpreReqs(){
		return $this->_preReqs;
	}

	/**
	 * @return secShortTitle - varchar(180)
	 */
	public function getsecShortTitle(){
		return $this->_secShortTitle;
	}

	/**
	 * @return termStartDate - date
	 */
	public function gettermStartDate(){
		return $this->_termStartDate;
	}

	/**
	 * @return termEndDate - date
	 */
	public function gettermEndDate(){
		return $this->_termEndDate;
	}

	/**
	 * @return dotw - varchar(7)
	 */
	public function getdotw(){
		return $this->_dotw;
	}

	/**
	 * @return minCredit - double(4,1)
	 */
	public function getMinCredit(){
		return $this->_minCredit;
	}

	/**
	 * @return maxCredit - double(4,1)
	 */
	public function getmaxCredit(){
		return $this->_maxCredit;
	}

	/**
	 * @return increCredit - double(4,1)
	 */
	public function getincreCredit(){
		return $this->_increCredit;
	}

	/**
	 * @return ceu - double(4,1)
	 */
	public function getCEU(){
		return $this->_ceu;
	}

	/**
	 * @return creditHours - int(11)
	 */
	public function getcreditHours(){
		return $this->_creditHours;
	}

	/**
	 * @return stuReg - enum('1','0')
	 */
	public function getstuReg(){
		return $this->_stuReg;
	}

	/**
	 * @return secType - enum('Online','Hybrid','On-Campus')
	 */
	public function getsecType(){
		return $this->_secType;
	}

	/**
	 * @return currStatus - varchar(1)
	 */
	public function getcurrStatus(){
		return $this->_currStatus;
	}

	/**
	 * @return statusDate - date
	 */
	public function getstatusDate(){
		return $this->_statusDate;
	}

	/**
	 * @return approvedDate - date
	 */
	public function getapprovedDate(){
		return $this->_approvedDate;
	}

	/**
	 * @return approvedBy - int(8) unsigned zerofill
	 */
	public function getapprovedBy(){
		return $this->_approvedBy;
	}

	/**
	 * @return LastUpdate - timestamp
	 */
	public function getLastUpdate(){
		return $this->_LastUpdate;
	}
    
    public function __destruct() {
        DB::inst()->close();
    }

}