<?php namespace eduTrac\Classes\DBObjects;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
use \eduTrac\Classes\Core\DB;
/**
 * NSLC Setup DBObject Class
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

class Application {

	private $_applID;
	private $_personID;
	private $_acadProgID;
	private $_startTerm;
	private $_PSAT_Verbal;
    private $_PSAT_Math;
    private $_SAT_Verbal;
    private $_SAT_Math;
    private $_ACT_English;
    private $_ACT_Math;
    private $_addDate;
    private $_addedBy;
    private $_LastUpdate;

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
        $q = DB::inst()->select( "application","applID = :id","","*",$bind );
		foreach($q as $row) {
			$this->_applID = $row["applID"];
			$this->_personID = $row["personID"];
			$this->_acadProgID = $row["acadProgID"];
			$this->_startTerm = $row["startTerm"];
			$this->_PSAT_Verbal = $row["PSAT_Verbal"];
            $this->_PSAT_Math = $row["PSAT_Math"];
            $this->_SAT_Verbal = $row["SAT_Verbal"];
            $this->_SAT_Math = $row["SAT_Math"];
            $this->_ACT_English = $row["ACT_English"];
            $this->_ACT_Math = $row["ACT_Math"];
            $this->_addDate= $row["addDate"];
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
        $q = DB::inst()->query( "SELECT applID FROM application ORDER BY $column $order" );
			foreach($q as $row){
				$keys[$i] = $row["applID"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return ID - int(11) unsigned zerofill
	 */
	public function getApplID(){
		return $this->_applID;
	}

	/**
	 * @return branch - varchar(2)
	 */
	public function getPersonID(){
		return $this->_personID;
	}

	/**
	 * @return reportingTerm - varchar(8)
	 */
	public function getAcadProgID(){
		return $this->_acadProgID;
	}

	/**
	 * @return startTerm - integer
	 */
	public function getStartTerm(){
		return $this->_startTerm;
	}

	/**
	 * @return PSAT_Verbal - string
	 */
	public function getPSAT_Verbal(){
		return $this->_PSAT_Verbal;
	}
    
    /**
     * @return PSAT_Math - string
	 */
	public function getPSAT_Math(){
		return $this->_PSAT_Math;
	}
    
    /**
     * @return SAT_Verbal - string
	 */
	public function getSAT_Verbal(){
		return $this->_SAT_Verbal;
	}
    
    /**
     * @return SAT_Math - string
	 */
	public function getSAT_Math(){
		return $this->_SAT_Math;
	}
    
    /**
     * @return ACT_English - string
     */
	public function getACT_English(){
		return $this->_ACT_English;
	}
    
    /**
     * @return ACT_Math - string
	 */
	public function getACT_Math(){
		return $this->_ACT_Math;
	}
    
    /**
     * @return addDate - date
     */
	public function getAddDate(){
		return $this->_addDate;
	}
    
    /**
     * @return addedBy - integer
     */
    public function getAddedBy(){
		return $this->_addedBy;
	}
    
    /**
     * @return addedBy - timestamp
     */
    public function getLastUpdate(){
    	return $this->_LastUpdate;
	}
    
    public function __destruct() {
        DB::inst()->close();
    }

}