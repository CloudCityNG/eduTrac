<?php namespace tinyPHP\Classes\DBObjects;
/**
 *
 * NSLC Setup
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

if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');

use \tinyPHP\Classes\Core\DB;
class NslcSetup {

	private $_ID;
	private $_branch;
	private $_reportingTerm;
	private $_termStartDate;
	private $_termEndDate;

	public function __construct(){
		
	}
    
    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row) {
	    $bind = array( ":id" => $key_row );
        $q = DB::inst()->select( "nslc_setup","ID = :id","","*",$bind );
		foreach($q as $row) {
			$this->_ID = $row["ID"];
			$this->_branch = $row["branch"];
			$this->_reportingTerm = $row["reportingTerm"];
			$this->_termStartDate = $row["termStartDate"];
			$this->_termEndDate = $row["termEndDate"];
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
        $q = DB::inst()->query( "SELECT ID FROM nslc_setup ORDER BY $column $order" );
			foreach($q as $row){
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
	 * @return branch - varchar(2)
	 */
	public function getBranch(){
		return $this->_branch;
	}

	/**
	 * @return reportingTerm - varchar(8)
	 */
	public function getReportingTerm(){
		return $this->_reportingTerm;
	}

	/**
	 * @return termStartDate - date
	 */
	public function getTermStartDate(){
		return $this->_termStartDate;
	}

	/**
	 * @return termEndDate - date
	 */
	public function getTermEndDate(){
		return $this->_termEndDate;
	}

}