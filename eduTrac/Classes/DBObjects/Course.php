<?php namespace eduTrac\Classes\DBObjects;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
use \eduTrac\Classes\Core\DB;
/**
 * Course DBObject Class
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

class Course {
    protected $_courseID;
    protected $_courseNumber;
    protected $_courseCode;
    protected $_subjectID;
    protected $_deptID;
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
            $this->_subjectID = $row["subjectID"];
            $this->_deptID = $row["deptID"];
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
    public function getCourseID(){
        return $this->_courseID;
    }

    /**
     * @return courseNumber - varchar(30)
     */
    public function getCourseNumber(){
        return $this->_courseNumber;
    }

    /**
     * @return courseCode - varchar(11)
     */
    public function getCourseCode(){
        return $this->_courseCode;
    }

    /**
     * @return subjCode - varchar(11)
     */
    public function getSubjectID(){
        return $this->_subjectID;
    }

    /**
     * @return deptCode - varchar(11)
     */
    public function getDeptID(){
        return $this->_deptID;
    }

    /**
     * @return courseDesc - text
     */
    public function getCourseDesc(){
        return $this->_courseDesc;
    }

    /**
     * @return minCredit - double(4,1)
     */
    public function getMinCredit(){
        return $this->_minCredit;
    }

    /**
     * @return maxCredit - double(4,1)
     */
    public function getMaxCredit(){
        return $this->_maxCredit;
    }

    /**
     * @return increCredit - double(4,1)
     */
    public function getIncreCredit(){
        return $this->_increCredit;
    }

    /**
     * @return courseLevelCode - int(11)
     */
    public function getCourseLevelCode(){
        return $this->_courseLevelCode;
    }

    /**
     * @return acadLevelCode - varchar(11)
     */
    public function getAcadLevelCode(){
        return $this->_acadLevelCode;
    }

    /**
     * @return courseShortTitle - varchar(80)
     */
    public function getCourseShortTitle(){
        return $this->_courseShortTitle;
    }

    /**
     * @return courseLongTitle - varchar(255)
     */
    public function getCourseLongTitle(){
        return $this->_courseLongTitle;
    }

    /**
     * @return preReq - text
     */
    public function getPreReq(){
        return $this->_preReq;
    }

    /**
     * @return allowAudit - enum('1','0')
     */
    public function getAllowAudit(){
        return $this->_allowAudit;
    }

    /**
     * @return allowWaitlist - enum('1','0')
     */
    public function getAllowWaitlist(){
        return $this->_allowWaitlist;
    }

    /**
     * @return minEnroll - int(3)
     */
    public function getMinEnroll(){
        return $this->_minEnroll;
    }

    /**
     * @return seatCap - int(3)
     */
    public function getSeatCap(){
        return $this->_seatCap;
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
     * @return approvedDate - date
     */
    public function getApprovedDate(){
        return $this->_approvedDate;
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
    
    public function __destruct() {
        DB::inst()->close();
    }

}