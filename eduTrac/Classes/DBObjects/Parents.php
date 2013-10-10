<?php namespace eduTrac\Classes\DBObjects;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Parents DBObject Class
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
 * @since       1.0.2
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

use \eduTrac\Classes\Core\DB;
class Parents {

	private $_ID;
	private $_parentID;
	private $_status;
	private $_addDate;
	private $_addedBy;
	private $_LastUpdate;

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row) {
	    $bind = [ ":id" => $key_row ];
	    $q = DB::inst()->select( "parent","parentID = :id","","*",$bind );
		foreach($q as $row) {
			$this->_ID = $row["ID"];
			$this->_parentID = $row["parentID"];
			$this->_status = $row["status"];
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
		$result = DB::inst()->query("SELECT parentID from parent order by $column $order");
			while($row = $result->fetch(\PDO::FETCH_ASSOC)){
				$keys[$i] = $row["parentID"];
				$i++;
			}
	return $keys;
	}

	public function getID(){
		return $this->_ID;
	}

	public function getParentID(){
		return $this->_parentID;
	}

	public function getStatus(){
		return $this->_status;
	}

	public function getAddDate(){
		return $this->_addDate;
	}

	public function getAddedBy(){
		return $this->_addedBy;
	}

	/**
	 * @return LastUpdate - timestamp
	 */
	public function getLastUpdate(){
		return $this->LastUpdate;
	}
	
	public function __destruct() {
        DB::inst()->close();
    }

}