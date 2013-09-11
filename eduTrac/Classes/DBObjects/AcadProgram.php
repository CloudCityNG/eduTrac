<?php namespace eduTrac\Classes\DBObjects;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
use \eduTrac\Classes\Core\DB;
/**
 * Academic Program DBObject Class
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

class AcadProgram {

    private $_acadProgID; //int(11) unsigned zerofill
	private $_acadProgCode; //varchar(15)
	private $_acadProgTitle; //varchar(180)
	private $_programDesc; //varchar(80)
	private $_currStatus; //varchar(1)
	private $_statusDate; //date
	private $_approvedBy; //int(8) unsigned zerofill
	private $_approvedDate; //date
	private $_deptID; //varchar(11)
	private $_schoolID; //varchar(11)
	private $_acadYearID; //text
	private $_startDate; //date
	private $_endDate; //date
	private $_degreeID; //varchar(11)
	private $_ccdID; //text
	private $_majorID; //text
	private $_minorID; //text
	private $_specID; //text
	private $_acadLevelCode; //varchar(11)
	private $_cipID; //varchar(11)
	private $_locationID; //varchar(11)
	private $_LastUpdate; //timestamp

    /**
     * Load one row into var_class. To use the vars use for example echo $class->getVar_name; 
     *
     * @access public
     * @since 1.0.0
     * @param int $key_row The primary key of the academic program.
     * @return mixed one row or an array
     */
	public function Load_from_key($key_row) {
        $bind = array( ":id" => $key_row );
        $q = DB::inst()->select( "acad_program","acadProgID = :id","","*",$bind );
		foreach($q as $row) {
			$this->_acadProgID = $row["acadProgID"];
			$this->_acadProgCode = $row["acadProgCode"];
			$this->_acadProgTitle = $row["acadProgTitle"];
			$this->_programDesc = $row["programDesc"];
			$this->_currStatus = $row["currStatus"];
			$this->_statusDate = $row["statusDate"];
			$this->_approvedBy = $row["approvedBy"];
			$this->_approvedDate = $row["approvedDate"];
			$this->_deptID = $row["deptID"];
			$this->_schoolID = $row["schoolID"];
			$this->_acadYearID = $row["acadYearID"];
			$this->_startDate = $row["startDate"];
			$this->_endDate = $row["endDate"];
			$this->_degreeID = $row["degreeID"];
			$this->_ccdID = $row["ccdID"];
			$this->_majorID = $row["majorID"];
			$this->_minorID = $row["minorID"];
			$this->_specID = $row["specID"];
			$this->_acadLevelCode = $row["acadLevelCode"];
			$this->_cipID = $row["cipID"];
			$this->_locationID = $row["locationID"];
			$this->_LastUpdate = $row["LastUpdate"];
		}
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @access public
     * @since 1.0.0
     * @param string $column
     * @param string $order
     * @return mixed ordered list
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
        $result = DB::inst()->query("SELECT acadProgID FROM acad_program ORDER BY $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["acadProgID"];
				$i++;
			}
	return $keys;
	}

	/**
     * Returns the academic program's id
     * 
     * @since 1.0.0
	 * @return int acadProgID - int(11) unsigned zerofill
	 */
	public function getAcadProgID(){
		return $this->_acadProgID;
	}

	/**
     * Returns the academic program's code.
     * 
     * @since 1.0.0
	 * @return string acadProgCode - varchar(15)
	 */
	public function getAcadProgCode(){
		return $this->_acadProgCode;
	}

	/**
     * Returns the academic program's title.
     * 
     * @since 1.0.0
	 * @return string acadProgTitle - varchar(180)
	 */
	public function getAcadProgTitle(){
		return $this->_acadProgTitle;
	}

	/**
     * Returns the academic program's description.
     * 
     * @since 1.0.0
	 * @return string programDesc - varchar(80)
	 */
	public function getProgramDesc(){
		return $this->_programDesc;
	}

	/**
     * Returns the academic program's current status.
     * 
     * @since 1.0.0
	 * @return string currStatus - varchar(1)
	 */
	public function getCurrStatus(){
		return $this->_currStatus;
	}

	/**
     * Returns the academic program's status date. 
     * This is also the date of when the academic program 
     * was added but will change when the status of the 
     * program is updated
     * 
     * @since 1.0.0
	 * @return mixed statusDate - date
	 */
	public function getStatusDate(){
		return $this->_statusDate;
	}

	/**
     * Returns the academic program's creator.
     * 
     * @since 1.0.0
	 * @return int approvedBy - int(8) unsigned zerofill
	 */
	public function getApprovedBy(){
		return $this->_approvedBy;
	}

	/**
     * Returns the academic program's approval date. 
     * This is also the date the program was added/created 
     * but will not change.
     * 
     * @since 1.0.0
	 * @return approvedDate - date
	 */
	public function getApprovedDate(){
		return $this->_approvedDate;
	}

	/**
     * Returns the department id associated with 
     * the paricular academic program.
     * 
     * @since 1.0.0
	 * @return int deptID - int(11)
	 */
	public function getDeptID(){
		return $this->_deptID;
	}

	/**
     * Returns the school id associated with 
     * the paricular academic program.
     * 
     * @since 1.0.0
	 * @return int schoolID - int (11)
	 */
	public function getSchoolID(){
		return $this->_schoolID;
	}

	/**
     * Returns the academic year id associated with 
     * the paricular academic program.
     * 
     * @since 1.0.0
	 * @return int acadYearID - int(11)
	 */
	public function getAcadYearID(){
		return $this->_acadYearID;
	}

	/**
     * Returns the effective date of a  
     * paricular academic program.
     * 
     * @since 1.0.0
	 * @return mixed startDate - date
	 */
	public function getStartDate(){
		return $this->_startDate;
	}

	/**
     * Returns the end date of the program.  
     * After this date, the program should no 
     * longer be offered.
     * 
     * @since 1.0.0
	 * @return mixed endDate - date
	 */
	public function getEndDate(){
		return $this->_endDate;
	}

	/**
     * Returns the degree id associated with 
     * the paricular academic program.
     * 
     * @since 1.0.0
	 * @return int degreeID - int(11)
	 */
	public function getDegreeID(){
		return $this->_degreeID;
	}

	/**
     * Returns the CCD id associated with 
     * the paricular academic program.
     * 
     * @since 1.0.0
	 * @return int ccdID - int(11)
	 */
	public function getCCDID(){
		return $this->_ccdID;
	}

	/**
     * Returns the major id associated with 
     * the paricular academic program.
     * 
     * @since 1.0.0
	 * @return int majorID - int(11)
	 */
	public function getMajorID(){
		return $this->_majorID;
	}

	/**
     * Returns the minor id associated with 
     * the paricular academic program.
     * 
     * @since 1.0.0
	 * @return int minorID - int(11)
	 */
	public function getMinorCode(){
		return $this->_minorID;
	}

	/**
     * Returns the specialization id associated with 
     * the paricular academic program.
     * 
     * @since 1.0.0
	 * @return int specID - int(11)
	 */
	public function getSpecID(){
		return $this->_specID;
	}

	/**
     * Returns the acdemic level code associated with 
     * the paricular academic program.
     * 
     * @since 1.0.0
	 * @return string acadLevelCode - varchar(11)
	 */
	public function getAcadLevelCode(){
		return $this->_acadLevelCode;
	}

	/**
     * Returns the CIP id associated with 
     * the paricular academic program.
     * 
     * @since 1.0.0
	 * @return int cipID - int(11)
	 */
	public function getCIPID(){
		return $this->_cipID;
	}

	/**
     * Returns the location id associated with 
     * the paricular academic program.
     * 
     * @since 1.0.0
	 * @return int locationID - int(11)
	 */
	public function getLocationID(){
		return $this->_locationID;
	}

	/**
     * Returns the date of when the academic program  
     * was last updated.
     * 
     * @since 1.0.0
	 * @return mixed LastUpdate - timestamp
	 */
	public function getLastUpdate(){
		return $this->_LastUpdate;
	}
    
    public function __destruct() {
        DB::inst()->close();
    }

}