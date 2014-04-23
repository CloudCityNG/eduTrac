<?php namespace eduTrac\Classes\Models;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Dashboard Model
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

use \eduTrac\Classes\Core\DB;
use \eduTrac\Classes\Libraries\Hooks;
class DashboardModel {
	
	private $_auth;
    private $_log;
	
	public function __construct() {
		$this->_auth = new \eduTrac\Classes\Libraries\Cookies;
        $this->_log = new \eduTrac\Classes\Libraries\Log;
	}
	
	public function search($data) {
        $array = [];
		$acro = $data['screen'];
		$screen = explode(" ", $acro);
        $bind = array( ":code" => $screen[0] );
        $q = DB::inst()->select( "screen","code = :code LIMIT 1","","*",$bind );
        foreach($q as $r) {
            $array[] = $r;
        }
        
		if(!$r['relativeURL']) {
			redirect( BASE_URL . 'error/screen_error?code=' . _h($screen[0]) );
		} else {
			redirect( BASE_URL . $r['relativeURL'] );
		}
	}
	
	public function PROG() {
		$array = [];
		$q = DB::inst()->query( "SELECT 
						COUNT(a.stuProgID) as ProgCount,
						b.acadProgCode 
					FROM 
						stu_program a 
					LEFT JOIN 
						acad_program b 
					ON 
						a.acadProgCode = b.acadProgCode 
					WHERE 
						a.currStatus <> 'G' 
					GROUP BY 
						a.acadProgCode 
					DESC 
					LIMIT 
						10"
		);
		foreach($q as $r) {
			$array[] = $r;
		}
		return $array;
	}
	
	public function stuDept() {
		$array = [];
		$q = DB::inst()->query( "SELECT 
						SUM(a.gender='M') AS Male,
						SUM(a.gender='F') AS Female,
						d.deptCode 
					FROM 
						person a 
					LEFT JOIN 
						stu_program b 
					ON 
						a.personID = b.stuID 
					LEFT JOIN 
						acad_program c 
					ON 
						b.acadProgCode = c.acadProgCode 
					LEFT JOIN 
						department d 
					ON 
						c.deptCode = d.deptCode 
					WHERE 
						b.startDate = (SELECT MAX(startDate) FROM stu_program WHERE stuID = b.stuID) 
					AND 
						b.currStatus = 'A' 
					AND 
						d.deptTypeCode = 'ACAD' 
					GROUP BY 
						d.deptCode 
					DESC 
					LIMIT 
						10"
		);
		foreach($q as $r) {
			$array[] = $r;
		}
		return $array;
	}
	
	/**
	 * Logs the user out and unsets cookie and database auth_token
	 *
	 * @since 1.0
	 * @return bool True if called
	 * 
	 */
	public function logout() {
		$uname = $this->_auth->getPersonField('uname');
        $update = array( "auth_token" => 'NULL' );
        $bind = array( ":uname" => $uname );
        
        DB::inst()->update( "person", $update, "uname = :uname", $bind );
		
		$this->_auth->_setcookie("ET_COOKNAME", '', time()-COOKIE_EXPIRE);
      	$this->_auth->_setcookie("ET_COOKID", '', time()-COOKIE_EXPIRE);
		$this->_auth->_setcookie("ET_REMEMBER", '', time()-COOKIE_EXPIRE);
		/* Purge log entries that are greater than 30 days old. */
		//$this->_log->purgeLog();
		/* Purges system error logs greater than 30 days old. */
		//Logs::purgeErrLog();
		redirect( BASE_URL );
	}
    
    public function getEvents() {
        $events = [];
        $q = DB::inst()->query( "SELECT 
                        a.*,
                        b.roomCode,
                        c.buildingCode 
                    FROM 
                        event_meta a 
                    LEFT JOIN 
                        room b 
                    ON 
                        a.roomID = b.roomID 
                    LEFT JOIN 
                        building c 
                    ON 
                        b.buildingID = c.buildingID" 
        );
        while($r = $q->fetch(\PDO::FETCH_ASSOC)) {
            $eventArray['eMID'] = $r['eventMetaID'];
            $eventArray['eID'] = $r['eventID'];
            $eventArray['buildingCode'] = $r['buildingCode'];
            $eventArray['roomCode'] = $r['roomCode'];
            $eventArray['title'] = $r['title'];
            $eventArray['description'] = $r['description'];
            $eventArray['start'] = $r['start'];
            $eventArray['end'] = $r['end'];
            $events[] = $eventArray;
        }
        echo json_encode($events);
    }
    
    public function runEvent($data) {
        $title = $data['title'];
        $text = $data['description'];
        $pID = $this->_auth->getPersonField('personID');
        $roomID = $data['roomID'];
        $sDate = $data['startDate'];
        $weekday = date('N',strtotime($sDate));
        $sTime = $data['startTime'];
        $eTime = $data['endTime'];
        $start = $sDate . " " . $sTime;
        $end = $sDate . " " . $eTime;
        $repeats = $data['repeats'];
        $repeatFreq = $data['repeatFreq'];
                
        if(empty($repeats)) {
            $repeat = 0;
            $freq = 0;
            $bind1 = [ 
                    "title" => $title,"description" => $text,
                    "roomID" => $roomID,"personID" => $pID,
                    "weekday" => $weekday,"startDate" => $sDate,
                    "startTime" => $sTime,"endTime" => $eTime,
                    "repeats" => $repeat,"repeatFreq" => $freq 
            ];
            
            $q = DB::inst()->insert( 'event', $bind1 );
            $ID = DB::inst()->lastInsertId('eventID');
            
            $bind2 = [ 
                    "eventID" => $ID,"title" => $title,"description" => $text,
                    "roomID" => $roomID,"personID" => $pID,
                    "start" => $start,"end" => $end
            ];
            
            $q = DB::inst()->insert( 'event_meta', $bind2 );
        } else {
            $until = (14/$repeatFreq);
            if ($repeatFreq == 1){
                $weekday = 0;
            }
            
            $bind3 = [ 
                    "title" => $title,"description" => $text,
                    "roomID" => $roomID,"personID" => $pID,
                    "weekday" => $weekday,"startDate" => $sDate,
                    "startTime" => $sTime,"endTime" => $eTime,
                    "repeats" => $repeats,"repeatFreq" => $repeatFreq 
            ];
            $q = DB::inst()->insert( 'event', $bind3 );
            $ID = DB::inst()->lastInsertId('eventID');
            
            for($x = 0; $x < $until; $x++) {
                $bind4 = [ 
                    "eventID" => $ID,"title" => $title,"description" => $text,
                    "roomID" => $roomID,"personID" => $pID,
                    "start" => $start,"end" => $end
                ];
            $q = DB::inst()->insert( 'event_meta', $bind4 );
            $sDate = strtotime($start . '+' . $repeatFreq . 'DAYS');
            $eDate = strtotime($end . '+' . $repeatFreq . 'DAYS');
            $start = date("Y-m-d H:i", $sDate);
            $end = date("Y-m-d H:i", $eDate);
            }
        }
    }
	
	public function __destruct() {
		DB::inst()->close();
	}
	
}