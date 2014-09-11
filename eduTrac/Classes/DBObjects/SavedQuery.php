<?php namespace eduTrac\Classes\DBObjects;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
use \eduTrac\Classes\Core\DB;
/**
 * Saved Query DBObject Class
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

class SavedQuery {

	private $_savedQueryID;
	private $_personID;
	private $_savedQueryName;
	private $_savedQuery;
	private $_purgeQuery; 
	private $_createdDate;
	private $_LastUpdate;

	public function __construct(){}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
	    $bind = array( ":id" => $key_row );
        $q = DB::inst()->select( "saved_query","savedQueryID = :id","","*",$bind );
		foreach($q as $row){
			$this->_savedQueryID = $row["savedQueryID"];
			$this->_personID = $row["personID"];
			$this->_savedQueryName = $row["savedQueryName"];
			$this->_savedQuery = $row["savedQuery"];
			$this->_purgeQuery = $row["purgeQuery"];
			$this->_createdDate = $row["createdDate"];
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
        $q = DB::inst()->query( "SELECT savedQueryID FROM saved_query ORDER BY $column $order" );
			foreach($q as $row){
				$keys[$i] = $row["savedQueryID"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return savedQueryID - int(11) unsigned zerofill
	 */
	public function getSavedQueryID(){
		return $this->_savedQueryID;
	}

	/**
	 * @return personID - int(8) unsigned zerofill
	 */
	public function getPersonID(){
		return $this->_personID;
	}

	/**
	 * @return savedQueryName - varchar(80)
	 */
	public function getSavedQueryName(){
		return $this->_savedQueryName;
	}

	/**
	 * @return savedQuery - text
	 */
	public function getSavedQuery(){
		return $this->_savedQuery;
	}

	/**
	 * @return purgeQuery - enum('0','1')
	 */
	public function getPurgeQuery(){
		return $this->_purgeQuery;
	}

	/**
	 * @return createdDate - date
	 */
	public function getCreatedDate(){
		return $this->_createdDate;
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