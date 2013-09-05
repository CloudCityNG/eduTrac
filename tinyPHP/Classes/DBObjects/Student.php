<?php namespace tinyPHP\Classes\DBObjects;
/**
 *
 * Student Class
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
 * @since eduTrac(tm) v 1.0
 * @license GNU General Public License v3 (http://www.gnu.org/licenses/gpl-3.0.html)
 */

use \tinyPHP\Classes\Core\DB;

class Student {

	private $_ID; //int(11) unsigned zerofill
	private $_stuID; //int(8) unsigned zerofill
	private $_schoolID; //int(11)
	private $_progID; //int(11)
	private $_advisorID; //int(8) unsigned zerofill
	private $_catYear; //int(11)
	private $_year; //int(11)
	private $_addDate; //datetime
	private $_addedBy; //int(8)
	private $_LastUpdate; //timestamp
	private $_connection;

	public function __construct() {}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
	    $bind = array( ":id" => $key_row );
        $q = DB::inst()->select( "student","stuID = :id","stuID","*",$bind );
		foreach($q as $row){
			$this->_ID = $row["ID"];
			$this->_stuID = $row["stuID"];
			$this->_schoolID = $row["schoolID"];
			$this->_progID = $row["progID"];
			$this->_advisorID = $row["advisorID"];
			$this->_catYear = $row["catYear"];
			$this->_year = $row["year"];
			$this->_addDate = $row["addDate"];
			$this->_addedBy = $row["addedBy"];
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
        $q = DB::inst()->query( "SELECT ID FROM student ORDER BY $column $order" );
			while($r = $q->fetch(\PDO::FETCH_ASSOC)){
				$keys[$i] = $row["ID"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return ID - int(11) unsigned zerofill
	 */
	public function getID(){
		return $this->_ID;
	}

	/**
	 * @return stuID - int(8) unsigned zerofill
	 */
	public function getStuID(){
		return $this->_stuID;
	}

	/**
	 * @return schoolID - int(11)
	 */
	public function getSchoolID(){
		return $this->_schoolID;
	}

	/**
	 * @return progID - int(11)
	 */
	public function getProgID(){
		return $this->_progID;
	}

	/**
	 * @return advisorID - int(8) unsigned zerofill
	 */
	public function getAdvisorID(){
		return $this->_advisorID;
	}

	/**
	 * @return catYear - int(11)
	 */
	public function getCatYear(){
		return $this->_catYear;
	}

	/**
	 * @return year - int(11)
	 */
	public function getYear(){
		return $this->_year;
	}

	/**
	 * @return addDate - datetime
	 */
	public function getAddDate(){
		return $this->_addDate;
	}

	/**
	 * @return addedBy - int(8)
	 */
	public function getAddedBy(){
		return $this->_addedBy;
	}

	/**
	 * @return LastUpdate - timestamp
	 */
	public function getLastUpdate(){
		return $this->_LastUpdate;
	}

}