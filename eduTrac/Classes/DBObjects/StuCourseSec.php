<?php namespace eduTrac\Classes\DBObjects;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
use \eduTrac\Classes\Core\DB;
/**
 * Student Course Section DBObject Class
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

class StuCourseSec {

    private $_id; //int(11) unsigned zerofill
	private $_stuID; //int(8) unsigned zerofill
	private $_courseSecID; //int(11) unsigned zerofill
	private $_termID; //int(11) unsigned zerofill
	private $_courseCredits; //double(4,1)
	private $_ceu; //double(4,1)
	private $_grade; //varchar(2)
	private $_status; //enum('A','N','D','W','C')
	private $_statusDate; //date
	private $_statusTime; //varchar(10)
	private $_addedBy; //int(8) unsigned zerofill
	private $_LastUpdate; //timestamp
    private $_auth;
    
    public function __construct() {
        $this->_auth = new \eduTrac\Classes\Libraries\Cookies;
    }

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row) {
		$bind = [ ":id" => $key_row ];
        $q = DB::inst()->select( "stu_course_sec","courseSecID = :id","","*",$bind );
		foreach($q as $row) {
			$this->_id = $row["id"];
			$this->_stuID = $row["stuID"];
			$this->_courseSecID = $row["courseSecID"];
			$this->_termID = $row["termID"];
			$this->_courseCredits = $row["courseCredits"];
			$this->_ceu = $row["ceu"];
			$this->_grade = $row["grade"];
			$this->_status = $row["status"];
			$this->_statusDate = $row["statusDate"];
			$this->_statusTime = $row["statusTime"];
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
        $q = DB::inst()->query( "SELECT id FROM stu_course_sec ORDER BY $column $order" );
			while($row = $q->fetch(\PDO::FETCH_ASSOC)) {
				$keys[$i] = $row["id"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return id - int(11) unsigned zerofill
	 */
	public function getID(){
		return $this->_id;
	}

	/**
	 * @return stuID - int(8) unsigned zerofill
	 */
	public function getStuID(){
		return $this->_stuID;
	}

	/**
	 * @return courseSecID - int(11) unsigned zerofill
	 */
	public function getCourseSecID(){
		return $this->_courseSecID;
	}

	/**
	 * @return termID - int(11) unsigned zerofill
	 */
	public function getTermID(){
		return $this->_termID;
	}

	/**
	 * @return courseCredits - double(4,1)
	 */
	public function getCourseCredits(){
		return $this->_courseCredits;
	}

	/**
	 * @return ceu - double(4,1)
	 */
	public function getCEU(){
		return $this->_ceu;
	}

	/**
	 * @return grade - varchar(2)
	 */
	public function getGrade(){
		return $this->_grade;
	}

	/**
	 * @return status - enum('A','N','D','W','C')
	 */
	public function getStatus(){
		return $this->_status;
	}

	/**
	 * @return statusDate - date
	 */
	public function getStatusDate(){
		return $this->_statusDate;
	}

	/**
	 * @return statusTime - varchar(10)
	 */
	public function getStatusTime(){
		return $this->_statusTime;
	}

	/**
	 * @return addedBy - int(8) unsigned zerofill
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

    /**
     * Close mysql connection
     */
	public function __destruct() {
        DB::inst()->close();
    }

}