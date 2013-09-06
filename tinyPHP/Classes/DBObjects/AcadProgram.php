<?php namespace tinyPHP\Classes\DBObjects;
/**
 *
 * Academic Program DB Object
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
 * @package DBObject
 */

use \tinyPHP\Classes\Core\DB;
class AcadProgram {

    private $_acadProgID; //int(11) unsigned zerofill
	private $_acadProgCode; //varchar(15)
	private $_acadProgTitle; //varchar(180)
	private $_programDesc; //varchar(80)
	private $_currStatus; //varchar(1)
	private $_statusDate; //date
	private $_approvedBy; //int(8) unsigned zerofill
	private $_approvedDate; //date
	private $_deptCode; //varchar(11)
	private $_schoolCode; //varchar(11)
	private $_acadYearCode; //text
	private $_startDate; //date
	private $_endDate; //date
	private $_degreeCode; //varchar(11)
	private $_ccdCode; //text
	private $_majorCode; //text
	private $_minorCode; //text
	private $_specCode; //text
	private $_acadLevelCode; //varchar(11)
	private $_cipCode; //varchar(11)
	private $_locationCode; //varchar(11)
	private $_LastUpdate; //timestamp

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row) {
        $bind = array( ":id" => $key_row );
        $q = DB::inst()->select( "acad_program","acadProgID = :id","","*",$bind );
		foreach($q as $row) {
			$this->acadProgID = $row["acadProgID"];
			$this->acadProgCode = $row["acadProgCode"];
			$this->acadProgTitle = $row["acadProgTitle"];
			$this->programDesc = $row["programDesc"];
			$this->currStatus = $row["currStatus"];
			$this->statusDate = $row["statusDate"];
			$this->approvedBy = $row["approvedBy"];
			$this->approvedDate = $row["approvedDate"];
			$this->deptCode = $row["deptCode"];
			$this->schoolCode = $row["schoolCode"];
			$this->acadYearCode = $row["acadYearCode"];
			$this->startDate = $row["startDate"];
			$this->endDate = $row["endDate"];
			$this->degreeCode = $row["degreeCode"];
			$this->ccdCode = $row["ccdCode"];
			$this->majorCode = $row["majorCode"];
			$this->minorCode = $row["minorCode"];
			$this->specCode = $row["specCode"];
			$this->acadLevelCode = $row["acadLevelCode"];
			$this->cipCode = $row["cipCode"];
			$this->locationCode = $row["locationCode"];
			$this->LastUpdate = $row["LastUpdate"];
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
        $result = DB::inst()->query("SELECT acadProgID FROM acad_program ORDER BY $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["acadProgID"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return acadProgID - int(11) unsigned zerofill
	 */
	public function getAcadProgID(){
		return $this->_acadProgID;
	}

	/**
	 * @return acadProgCode - varchar(15)
	 */
	public function getAcadProgCode(){
		return $this->_acadProgCode;
	}

	/**
	 * @return acadProgTitle - varchar(180)
	 */
	public function getAcadProgTitle(){
		return $this->_acadProgTitle;
	}

	/**
	 * @return programDesc - varchar(80)
	 */
	public function getProgramDesc(){
		return $this->_programDesc;
	}

	/**
	 * @return currStatus - varchar(1)
	 */
	public function getCurrStatus(){
		return $this->_currStatus;
	}

	/**
	 * @return statusDate - date
	 */
	public function getStatusDate(){
		return $this->_statusDate;
	}

	/**
	 * @return approvedBy - int(8) unsigned zerofill
	 */
	public function getApprovedBy(){
		return $this->_approvedBy;
	}

	/**
	 * @return approvedDate - date
	 */
	public function getApprovedDate(){
		return $this->_approvedDate;
	}

	/**
	 * @return deptCode - varchar(11)
	 */
	public function getDeptCode(){
		return $this->_deptCode;
	}

	/**
	 * @return schoolCode - varchar(11)
	 */
	public function getSchoolCode(){
		return $this->_schoolCode;
	}

	/**
	 * @return acadYearCode - text
	 */
	public function getAcadYearCode(){
		return $this->_acadYearCode;
	}

	/**
	 * @return startDate - date
	 */
	public function getStartDate(){
		return $this->_startDate;
	}

	/**
	 * @return endDate - date
	 */
	public function getEndDate(){
		return $this->_endDate;
	}

	/**
	 * @return degreeCode - varchar(11)
	 */
	public function getDegreeCode(){
		return $this->_degreeCode;
	}

	/**
	 * @return ccdCode - text
	 */
	public function getCCDCode(){
		return $this->_ccdCode;
	}

	/**
	 * @return majorCode - text
	 */
	public function getMajorCode(){
		return $this->_majorCode;
	}

	/**
	 * @return minorCode - text
	 */
	public function getMinorCode(){
		return $this->_minorCode;
	}

	/**
	 * @return specCode - text
	 */
	public function getSpecCode(){
		return $this->_specCode;
	}

	/**
	 * @return acadLevelCode - varchar(11)
	 */
	public function getAcadLevelCode(){
		return $this->_acadLevelCode;
	}

	/**
	 * @return cipCode - varchar(11)
	 */
	public function getCIPCode(){
		return $this->_cipCode;
	}

	/**
	 * @return locationCode - varchar(11)
	 */
	public function getLocationCode(){
		return $this->_locationCode;
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