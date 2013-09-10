<?php namespace eduTrac\Classes\DBObjects;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
use \eduTrac\Classes\Core\DB;
/**
 * Subject DBObject Class
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

class Subject {

    private $_subjectID; //int(6) unsigned zerofill
	private $_subjCode; //varchar(11)
	private $_subjName; //varchar(180)
	private $_LastUpdate; //timestamp

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row) {
        $bind = array( ":id" => $key_row );
        $q = DB::inst()->select( "subject","subjectID = :id","subjectID","*",$bind );
		foreach($q as $row){
			$this->_subjectID = $row["subjectID"];
			$this->_subjCode = $row["subjCode"];
			$this->_subjName = $row["subjName"];
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
        $q = DB::inst()->query( "SELECT subjectID FROM subject ORDER BY $column $order" );
			while($row = $q->fetch(\PDO::FETCH_ASSOC)) {
				$keys[$i] = $row["subjectID"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return subjectID - int(6) unsigned zerofill
	 */
	public function getSubjectID(){
		return $this->_subjectID;
	}

	/**
	 * @return subjCode - varchar(11)
	 */
	public function getSubjCode(){
		return $this->_subjCode;
	}

	/**
	 * @return subjName - varchar(180)
	 */
	public function getSubjName(){
		return $this->_subjName;
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