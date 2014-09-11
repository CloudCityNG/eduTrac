<?php namespace eduTrac\Classes\DBObjects;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
use \eduTrac\Classes\Core\DB;
/**
 * Credit Load DBObject Class
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

class CreditLoad {

    private $_credLoadID; //int(11) unsigned zerofill
	private $_credLoadCode; //varchar(6)
	private $_credLoadName; //varchar(80)
	private $_credLoadCreds; //double(4,1)
	private $_LastUpdate; //timestamp

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$bind = array( ":id" => $key_row );
        $q = DB::inst()->select( "credit_load","credLoadID = :id","credLoadID","*",$bind );
    	foreach($q as $row){
			$this->_credLoadID = $row["credLoadID"];
			$this->_credLoadCode = $row["credLoadCode"];
			$this->_credLoadName = $row["credLoadName"];
			$this->_credLoadCreds = $row["credLoadCreds"];
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
        $q = DB::inst()->query( "SELECT credLoadID FROM credit_load ORDER BY $column $order" );
			while($r = $q->fetch(\PDO::FETCH_ASSOC)){
				$keys[$i] = $row["credLoadID"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return credLoadID - int(11) unsigned zerofill
	 */
	public function getCredLoadID(){
		return $this->_credLoadID;
	}

	/**
	 * @return credLoadCode - varchar(6)
	 */
	public function getCredLoadCode(){
		return $this->_credLoadCode;
	}

	/**
	 * @return credLoadName - varchar(80)
	 */
	public function getCredLoadName(){
		return $this->_credLoadName;
	}

	/**
	 * @return credLoadCreds - double(4,1)
	 */
	public function getCredLoadCreds(){
		return $this->_credLoadCreds;
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