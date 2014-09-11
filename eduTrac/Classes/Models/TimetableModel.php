<?php namespace eduTrac\Classes\Models;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Timetable Model
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
 * @since       4.0.9
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

use \eduTrac\Classes\Core\DB;
use \eduTrac\Classes\Libraries\Hooks;
class TimetableModel {
	
	private $_auth;
    private $_log;
	
	public function __construct() {
		$this->_auth = new \eduTrac\Classes\Libraries\Cookies;
        $this->_log = new \eduTrac\Classes\Libraries\Log;
	}
    
    public function getEvents() {
        $events = [];
        $q = DB::inst()->query( "SELECT 
                        a.*,
                        b.roomCode,
                        c.buildingCode,
                        e.bgcolor 
                    FROM 
                        event_meta a 
                    LEFT JOIN 
                        room b 
                    ON 
                        a.roomCode = b.roomCode 
                    LEFT JOIN 
                        building c 
                    ON 
                        b.buildingCode = c.buildingCode 
                    LEFT JOIN 
                    	event d 
                	ON 
                		a.eventID = d.eventID 
            		LEFT JOIN 
            			event_category e 
        			ON 
        				d.eventType = e.cat_name" 
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
            $eventArray['color'] = $r['bgcolor'];
            $events[] = $eventArray;
        }
        echo json_encode($events);
    }
	
	public function __destruct() {
		DB::inst()->close();
	}
	
}