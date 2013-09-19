<?php namespace eduTrac\Classes\DBObjects;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
use \eduTrac\Classes\Core\DB;
/**
 * Student Program DBObject Class
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

class StuProgram {

	private $_stuProgID; //int(11) unsigned zerofill
	private $_stuID; //int(8) unsigned zerofill
	private $_progCode; //varchar(15)
	private $_currStatus; //varchar(1)
	private $_statusDate; //date
	private $_startDate; //date
	private $_endDate; //date
	private $_approvedBy; //int(8) unsigned zerofill
	private $_LastUpdate; //timestamp

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
	    $bind = array( ":id" => $key_row );
        $q = DB::inst()->select( "stu_program","stuProgID = :id","stuProgID","*",$bind );
		foreach($q as $row) {
			$this->_stuProgID = $row["stuProgID"];
			$this->_stuID = $row["stuID"];
			$this->_progID = $row["progID"];
			$this->_currStatus = $row["currStatus"];
			$this->_statusDate = $row["statusDate"];
			$this->_startDate = $row["startDate"];
			$this->_endDate = $row["endDate"];
			$this->_approvedBy = $row["approvedBy"];
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
		$q = DB::inst()->query("SELECT stuProgID FROM stu_program ORDER BY $column $order");
			while($row = $q->fetch(\PDO::FETCH_ASSOC)){
				$keys[$i] = $row["stuProgID"];
				$i++;
			}
	return $keys;
	}
    
    public function getAcadLevelCode($id) {
        $bind = array( ":id" => $id);
        $q = DB::inst()->query( "SELECT 
                        b.acadLevelCode 
                    FROM 
                        stu_program a 
                    LEFT JOIN 
                        acad_program b 
                    ON 
                        a.progID = b.acadProgID 
                    WHERE 
                        a.stuID = :id 
                    AND 
                        a.currStatus = 'A'",
                    $bind
        );
		foreach($q as $r) {
			$acadLevel = $r['acadLevelCode'];
		}
        return $acadLevel;
	}

	/**
	 * @return stuProgID - int(11) unsigned zerofill
	 */
	public function getStuProgID(){
		return $this->_stuProgID;
	}

	/**
	 * @return stuID - int(8) unsigned zerofill
	 */
	public function getStuID(){
		return $this->_stuID;
	}

	/**
	 * @return progCode - varchar(15)
	 */
	public function getProgID(){
		return $this->_progID;
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
	 * @return approvedBy - int(8) unsigned zerofill
	 */
	public function getApprovedBy(){
		return $this->_approvedBy;
	}

	/**
	 * @return LastUpdate - timestamp
	 */
	public function getLastUpdate(){
		return $this->_LastUpdate;
	}

}