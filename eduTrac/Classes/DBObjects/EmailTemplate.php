<?php namespace eduTrac\Classes\DBObjects;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Email Template DBObject Class
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

use \eduTrac\Classes\Core\DB;
class EmailTemplate {

	private $_etID; //int(11)
	private $_personID; //int(8) unsigned zerofill
	private $_email_key; //varchar(60)
	private $_email_name; //varchar(80)
	private $_email_value; //longtext
	private $_LastUpdate; //timestamp

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row) {
	    $bind = [ ":id" => $key_row ];
	    $q = DB::inst()->select( "email_template","etID = :id","","*",$bind );
		foreach($q as $row) {
			$this->_email_id = $row["etID"];
			$this->_personID = $row["personID"];
			$this->_email_key = $row["email_key"];
			$this->_email_name = $row["email_name"];
			$this->_email_value = $row["email_value"];
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
		$result = DB::inst()->query("SELECT etID from email_template order by $column $order");
			while($row = $result->fetch(\PDO::FETCH_ASSOC)){
				$keys[$i] = $row["etID"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return email_id - int(11)
	 */
	public function getetID(){
		return $this->_etID;
	}

	/**
	 * @return personID - int(8) unsigned zerofill
	 */
	public function getPersonID(){
		return $this->_personID;
	}

	/**
	 * @return email_key - varchar(60)
	 */
	public function getEmailKey(){
		return $this->_email_key;
	}

	/**
	 * @return email_name - varchar(80)
	 */
	public function getEmailName(){
		return $this->_email_name;
	}

	/**
	 * @return email_value - longtext
	 */
	public function getEmailValue(){
		return $this->_email_value;
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