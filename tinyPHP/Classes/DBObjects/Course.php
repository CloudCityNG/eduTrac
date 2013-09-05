<?php namespace tinyPHP\Classes\DBObjects;
/**
 *
 * Course Class
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
class Course {
    protected $_courseID;
    protected $_courseNumber;
    protected $_courseCode;
    protected $_subjCode;
    protected $_deptCode;
    protected $_courseDesc;
    protected $_minCredit;
    protected $_maxCredit;
    protected $_increCredit;
    protected $_courseLevelCode;
    protected $_acadLevelCode;
    protected $_courseShortTitle;
    protected $_courseLongTitle;
    protected $_preReq;
    protected $_allowAudit;
    protected $_allowWaitlist;
    protected $_minEnroll;
    protected $_seatCap;
    protected $_startDate;
    protected $_endDate;
    protected $_currStatus;
    protected $_statusDate;
    protected $_approvedDate;
    protected $_approvedBy;
    protected $_LastUpdate;
    
    public function __construct() {}
    
    public function crseList($id) {
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "course", "courseID != :id", "", "courseCode", $bind );
        foreach( $q as $r) {
            $array[] = $r['courseCode'];
        }
        return $array;
    }
    
    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
    public function Load_from_key($key_row) {
        $bind = array( ":id" => $key_row );
        $q = DB::inst()->select( "course", "courseID = :id", "", "*", $bind );
        foreach( $q as $row) {
            $this->_courseID = $row["courseID"];
            $this->_courseNumber = $row["courseNumber"];
            $this->_courseCode = $row["courseCode"];
            $this->_subjCode = $row["subjCode"];
            $this->_deptCode = $row["deptCode"];
            $this->_courseDesc = $row["courseDesc"];
            $this->_minCredit = $row["minCredit"];
            $this->_maxCredit = $row["maxCredit"];
            $this->_increCredit = $row["increCredit"];
            $this->_courseLevelCode = $row["courseLevelCode"];
            $this->_acadLevelCode = $row["acadLevelCode"];
            $this->_courseShortTitle = $row["courseShortTitle"];
            $this->_courseLongTitle = $row["courseLongTitle"];
            $this->_preReq = $row["preReq"];
            $this->_allowAudit = $row["allowAudit"];
            $this->_allowWaitlist = $row["allowWaitlist"];
            $this->_minEnroll = $row["minEnroll"];
            $this->_seatCap = $row["seatCap"];
            $this->_startDate = $row["startDate"];
            $this->_endDate = $row["endDate"];
            $this->_currStatus = $row["currStatus"];
            $this->_statusDate = $row["statusDate"];
            $this->_approvedDate = $row["approvedDate"];
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
        $q = DB::inst()->query("SELECT courseID from course order by $column $order");
            foreach($q as $row) {
                $keys[$i] = $row["courseID"];
                $i++;
            }
    return $keys;
    }
    
    /**
     * @return courseID - int(8) unsigned zerofill
     */
    public function getcourseID(){
        return $this->_courseID;
    }

    /**
     * @return courseNumber - varchar(30)
     */
    public function getcourseNumber(){
        return $this->_courseNumber;
    }

    /**
     * @return courseCode - varchar(11)
     */
    public function getcourseCode(){
        return $this->_courseCode;
    }

    /**
     * @return subjCode - varchar(11)
     */
    public function getsubjCode(){
        return $this->_subjCode;
    }

    /**
     * @return deptCode - varchar(11)
     */
    public function getdeptCode(){
        return $this->_deptCode;
    }

    /**
     * @return courseDesc - text
     */
    public function getcourseDesc(){
        return $this->_courseDesc;
    }

    /**
     * @return minCredit - double(4,1)
     */
    public function getminCredit(){
        return $this->_minCredit;
    }

    /**
     * @return maxCredit - double(4,1)
     */
    public function getmaxCredit(){
        return $this->_maxCredit;
    }

    /**
     * @return increCredit - double(4,1)
     */
    public function getincreCredit(){
        return $this->_increCredit;
    }

    /**
     * @return courseLevelCode - int(11)
     */
    public function getcourseLevelCode(){
        return $this->_courseLevelCode;
    }

    /**
     * @return acadLevelCode - varchar(11)
     */
    public function getacadLevelCode(){
        return $this->_acadLevelCode;
    }

    /**
     * @return courseShortTitle - varchar(80)
     */
    public function getcourseShortTitle(){
        return $this->_courseShortTitle;
    }

    /**
     * @return courseLongTitle - varchar(255)
     */
    public function getcourseLongTitle(){
        return $this->_courseLongTitle;
    }

    /**
     * @return preReq - text
     */
    public function getpreReq(){
        return $this->_preReq;
    }

    /**
     * @return allowAudit - enum('1','0')
     */
    public function getallowAudit(){
        return $this->_allowAudit;
    }

    /**
     * @return allowWaitlist - enum('1','0')
     */
    public function getallowWaitlist(){
        return $this->_allowWaitlist;
    }

    /**
     * @return minEnroll - int(3)
     */
    public function getminEnroll(){
        return $this->_minEnroll;
    }

    /**
     * @return seatCap - int(3)
     */
    public function getseatCap(){
        return $this->_seatCap;
    }

    /**
     * @return startDate - date
     */
    public function getstartDate(){
        return $this->_startDate;
    }

    /**
     * @return endDate - date
     */
    public function getendDate(){
        return $this->_endDate;
    }

    /**
     * @return currStatus - varchar(1)
     */
    public function getcurrStatus(){
        return $this->_currStatus;
    }

    /**
     * @return statusDate - date
     */
    public function getstatusDate(){
        return $this->_statusDate;
    }

    /**
     * @return approvedDate - date
     */
    public function getapprovedDate(){
        return $this->_approvedDate;
    }

    /**
     * @return approvedBy - int(8) unsigned zerofill
     */
    public function getapprovedBy(){
        return $this->_approvedBy;
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