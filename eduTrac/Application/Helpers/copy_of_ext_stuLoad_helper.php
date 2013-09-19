<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Student Load Helper
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

use \eduTrac\Classes\Libraries\Hooks;
use \eduTrac\Classes\Core\DB;
 	
    function create_date_time_schedule_data($date, $room = '') {
      // Check Valid Date
      if (!check_valid_date($date)) $date = '1970-01-01';
      list ($year, $month, $day) = explode("-", $date);
      // query for the date time data for the 1st of the month, limit only 1
      $bind = array( ":roomCode" => $room );
      $q = DB::inst()->query( "SELECT 
                    a.timeSlotID,
                    a.schedule_date_time,
                    a.day_of_the_week_id,
                    b.roomCode 
                FROM 
                    room_time_slot a 
                LEFT JOIN 
                    room_schedule b 
                ON 
                    a.timeSlotID = b.room_datetime_slot_id 
                WHERE 
                    roomCode = :roomCode 
                AND 
                    schedule_date_time = '" . $year . "-" . $month . "-01 " . MIN_BOOKING_HOUR . ":00:00' 
                LIMIT 
                    0,1",
                $bind
      );
      if (!defined(BOOKING_TIME_INTERVAL)) { define(BOOKING_TIME_INTERVAL, 30); }
      // If there are no result(s) then we need to create the data for this month.
      if (!($q->rowCount() >= 1) || !$q) {
        // Define Valid Times (hh:mm format)
        $valid_times = get_times_in_range (sprintf("%02d", MIN_BOOKING_HOUR).':00', 
                    sprintf("%02d", MAX_BOOKING_HOUR).':00', BOOKING_TIME_INTERVAL, false);
        // Define Starting Weekday Value (0=Sunday, 1=Monday,...,6=Saturday)
        $dayoftheweekid = beginning_weekday_of_the_month($year, $month);
        for ($i = 1; $i <= 31; $i++) {  // For Each Day in the Month.
            if (check_valid_date($year.'-'.$month.'-'.$i)) {
                //echo "Loop ID: $i<br />";
                if ($dayoftheweekid == 7) { $dayoftheweekid = 0; }
                //echo "Day of the Week ID: $dayoftheweekid <br />";
                foreach ($valid_times as $valid_time) {
                    $q = DB::inst()->query( "INSERT INTO room_time_slot 
                            SET schedule_date_time = '" . $year . "-" . $month . "-" . sprintf("%02d",$i) . 
                            " " . $valid_time . "', day_of_the_week_id = " . $dayoftheweekid );
                }
                $dayoftheweekid++;
            } // end of if
        } // end of for loop
        // Order the table if modified.
        $result = DB::inst()->query( "ALTER TABLE room_time_slot ORDER BY schedule_date_time");
        // Optimize all of the main tables.
        $result = DB::inst()->query( "OPTIMIZE TABLE room_time_slot" );
        $result = DB::inst()->query( "OPTIMIZE TABLE room_schedule" );
        $result = DB::inst()->query( "OPTIMIZE TABLE room_event" );
      } // end of if
      return true;
    }
    
    // Check AVAILABILITY of the Schedule Data (Schedule Table)
    // $scheduled_date_time_data is an array containing the date and
    // time slots for the schedule.  SQL format: 'YYYY-MM-DD hh:mm:ss'
    // $location_field_name - location's SQL column/field name.
    function check_schedule_availability($scheduled_date_time_data, $room_field_code) {
      // Check to see if schedule dates and times are available.
      $query = "SELECT COUNT(*) FROM room_time_slot LEFT JOIN room_schedule ON timeSlotID = room_datetime_slot_id WHERE (";
      foreach ($scheduled_date_time_data as $sql_data) {
        // First check to see if the data for the month(s) have been created yet.
        // Do this only for each unique "YYYYMM" in the date time data array.
        list ($date, $time) = explode(" ", $sql_data);
        list ($year, $month, $day) = explode("-", $date);
        $yearmonth = $year.$month;
        if ($yearmonth != $previous_yearmonth) { $result = create_date_time_schedule_data($date); }
        $previous_yearmonth = $yearmonth;
        // then...resume building the query
        $query .= "schedule_date_time = '". $sql_data . "' OR ";
      }
      $query = substr($query,0,strlen($query)-4);
      $query .= ") AND roomCode != '" . $room_field_code . "'";
      //echo $query."<br /><br />";
      $result = DB::inst()->query($query);
      $db_row_values = $result->fetchAll(\PDO::FETCH_ASSOC);
      // Return the number of available date time schedule blocks
      $availability = $db_row_values[0];
      //echo 'Schedule Availability Count: '.$availability.'<br /><br />';
      return $availability;
    }

    // Find UN-AVAILABILITY of the Schedule Data (Schedule Table)
    // $scheduled_date_time_data is an array containing the dates and
    // times for the schedule data.  SQL Date Format: 'YYYY-MM-DD hh:mm:ss'
    function find_schedule_unavailability($scheduled_date_time_data, $sql_room_field_name) {
      // Find the schedule date and time slots that are "unavailable".
      $available = true;
      $query = "SELECT schedule_date_time,roomCode FROM room_time_slot LEFT JOIN room_schedule ON timeSlotID = room_datetime_slot_id WHERE (";
      foreach ($scheduled_date_time_data as $sql_data) {
        $query .= "schedule_date_time = '". $sql_data . "' OR ";
      }
      $query = substr($query,0,strlen($query)-4);
      $query .= ") AND roomCode = '" . $sql_room_field_name . "'";
      //echo $query."<br /><br />";
      $result = DB::inst()->query($query);
      while($db_row_values = $result->fetch(\PDO::FETCH_ASSOC)) {
        $schedule_date_time = $db_row_values['schedule_date_time'];
        $unavailable[] = $schedule_date_time;
      }
      // Return array of the unavailable - "schedule_date_time" field - date and time slots.
      // (SQL Date Format: 'YYYY-MM-DD hh:mm:ss')
      return $unavailable;
    }

    // Get the Event Data query object for the Month View
    // $date - YYYY-MM-DD
    // $location - Location ID
    function get_month_view_event_data($date, $room = '') {
      // Check Valid Date
      if (!check_valid_date($date)) $date = '1970-01-01';
      list ($year, $month, $day) = explode("-", $date);
      $date_month_end = add_delta_ymd(implode("-", array($year, $month, 0)), 0,1,0);
      $q = "SELECT 
                * 
            FROM 
                room_time_slot 
            LEFT JOIN 
                room_schedule 
            ON 
                timeSlotID = room_datetime_slot_id 
            WHERE 
                roomCode = '$room' 
            AND 
                schedule_date_time >= '".$year."-".$month."-01 00:00:01' 
            AND 
                schedule_date_time < '".$date_month_end." 00:00:00' 
            ORDER BY 
                schedule_date_time";
      //echo $query."<br /><br />";
      $result = DB::inst()->query($query);
      $db_num_rows = $result->rowCount();
      
      // Event Row Data Assoc. Array
      //    $event_row_data['date']['event_id'] = 'db_row_id|row_span|start_time|end_time';
      $event_row_data = array(array ());
      global $event_row_data;
      
      // Get the Display Times and Number of Rows
      $data_display_times = get_times_in_range(MIN_BOOKING_HOUR, MAX_BOOKING_HOUR, BOOKING_TIME_INTERVAL, true);
      $number_of_display_time_rows = count($data_display_times);
      
      // Get Month Information
      $number_of_days_in_the_month = number_of_days_in_month($year, $month);
      
      // Create an Assoc. Time array for index lookup.
      $display_time_lookup = array ();
      for ($i=0; $i<$number_of_display_time_rows; $i++) {
        $display_time_lookup[$data_display_times[$i]] = $i;
      }
      
      // $event_row_data array - build out the schedule date blocks
      for ($day=1; $day<=$number_of_days_in_the_month; $day++) {
        $for_date = $year."-".$month."-".sprintf("%02d", $day);
        $event_row_data[$for_date][0] = '';
      }
      
      if (!$result) { return false; } // no database events
      
      // Go thru the database $result data and fill out the $event_row_data array.
      $previous_event_id = 0;
      $row_span = 0;
      $row = 0;
      $event = array();
      //echo "<h1>TESTING</h1>";
      
      for ($row=0; $row<=$db_num_rows; $row++) {
        
        // define db variables
        $event = $result->fetchAll(\PDO::FETCH_ARRAY);
        $db_event_id = $event['event_id'];
        //echo "ID: $db_event_id<br />";
        list ($db_starting_date, $db_starting_time) = explode(" ", $event['schedule_date_time']);
        list ($db_hr, $db_min, $db_sec) = explode(":", $db_starting_time);
        $db_starting_time = sprintf("%02d", $db_hr).':'.sprintf("%02d", $db_min);
        
        if ($previous_event_id != $db_event_id || $previous_event_date != $db_starting_date || 
            $previous_event_id == 0) { // event_id has changed / or first event_id
            
            if ($previous_event_id != 0) { // if not first id, then define $event_row_data array
                
                // place the event data into $event_row_data: 'db_row_id|row_span|start_time|end_time'
                $event_row_data[$event_start_date][$previous_event_id] = $event_start_db_row_id."|".$row_span."|".$event_start_time."|".
                                $data_display_times[($display_time_lookup[$event_start_time]+$row_span)];
                // echo values for testing
                //echo "Define Event -> " . $event_start_date ."/" . $previous_event_id . " => " . $event_row_data[$event_start_date][$previous_event_id] . "<br />";
                // initialize the row_span for the new event
                $row_span = 1;
            }
            // Mark the event starting time and db row id to be used to data_seeking
            //echo "<strong>Mark Start:</strong> ".$db_starting_date.", ".$row.", ".$db_event_id."<br />";
            $event_start_time = $db_starting_time; // mark the starting time
            $event_start_date = $db_starting_date; // mark the starting date
            $event_start_db_row_id = $row; // mark the starting db row
            $row_span = 1;
            
        } else { // same event_id
            //echo "<strong>Same Event ID:</strong> ".$db_starting_time.", ".$row.", ".$db_event_id."<br />";
            $row_span++;
        }
        $previous_event_id = $db_event_id;
        $previous_event_date = $db_starting_date;
        
      } // end of while
      
      // return the resulting data object
      return $result;
    }

    // Get the Event Data query object for the Week View
    // $date - YYYY-MM-DD
    // $location - Location ID
    function get_week_view_event_data($date, $room = '') {
      // Get the event data for the selected week, month, year and location.
      
      // Use several of the already created arrays from week_widget.php as global variables.
      global $wdays_ind;
      global $wdays;
      global $week_day_start;
      global $week_dates;
      // Check Valid Date
      if (!check_valid_date($date)) $date = '1970-01-01';
      list ($year, $month, $day) = explode("-", $date);
      $q = "SELECT 
                * 
            FROM 
                room_time_slot 
            LEFT JOIN 
                room_schedule 
            ON 
                timeSlotID = room_datetime_slot_id 
            WHERE 
                roomCode = '$room' 
            AND 
                schedule_date_time >= '".$week_dates[0]." 00:00:00' 
            AND 
                schedule_date_time <= '".$week_dates[6]." 23:59:59' 
            ORDER BY 
                schedule_date_time";
      //echo $query."<br /><br />";
      $result = DB::inst()->query($query);
      $db_num_rows = $result->rowCount();
      
      // Event Row Data Assoc. Array
      //    $event_row_data['display_time']['date'] = 'db_row_id|row_span|start_time|end_time';
      $event_row_data = array();
      global $event_row_data;
      
      // Get the Display Times and Number of Rows
      $data_display_times = get_times_in_range(MIN_BOOKING_HOUR, MAX_BOOKING_HOUR, BOOKING_TIME_INTERVAL, true);
      $number_of_display_time_rows = count($data_display_times);
      
      // Create an Assoc. Date array for index lookup.
      $display_time_lookup = array ();
      for ($i=0; $i<$number_of_display_time_rows; $i++) {
        $display_time_lookup[$data_display_times[$i]] = $i;
      }
      
      // $event_row_data array - build out the schedule time blocks
      foreach ($week_dates as $week_date) {
        foreach ($data_display_times as $display_time) {
            $event_row_data[$display_time][$week_date] = '';
        }
        reset($data_display_times);
      }
      reset($week_dates);
      
      if (!$result) {
        //echo "No Database Events / Results<br />";
        return false;
      }
      // Go thru the database $result data and fill out the $event_row_data array.
      $previous_event_id = 0;
      $row_span = 0;
      $row = 0;
      $event = array();
      //echo "<h1>TESTING</h1>";
      
      for ($row=0; $row<=$db_num_rows; $row++) {
        
        // define db variables
        $event = $result->fetchAll(\PDO::FETCH_ARRAY);
        $db_event_id = $event['event_id'];
        //echo "ID: $db_event_id<br />";
        list ($db_starting_date, $db_starting_time) = explode(" ", $event['schedule_date_time']);
        list ($db_hr, $db_min, $db_sec) = explode(":", $db_starting_time);
        $db_starting_time = sprintf("%02d", $db_hr).':'.sprintf("%02d", $db_min);
        
        if ($previous_event_id != $db_event_id || $previous_event_date != $db_starting_date || 
            $previous_event_id == 0) { // event_id has changed / or first event_id
            
            if ($previous_event_id != 0) { // if not first id, then define $event_row_data array
                
                // place the event data into $event_row_data: 'db_row_id|row_span|start_time|end_time'
                $event_row_data[$event_start_time][$event_start_date] = $event_start_db_row_id."|".$row_span."|".$event_start_time."|".
                                $data_display_times[($display_time_lookup[$event_start_time]+$row_span)];
                // echo values for testing
                //echo "Define Event -> " . $event_row_data[$event_start_time][$event_start_date] . "<br />";
                // initialize the row_span for the new event
                $row_span = 1;
            }
            // Mark the event starting time and db row id to be used to data_seeking
            //echo "<strong>Mark Start:</strong> ".$db_starting_date." ".$db_starting_time.", ".$row.", ".$db_event_id."<br />";
            $event_start_time = $db_starting_time; // mark the starting time
            $event_start_date = $db_starting_date; // mark the starting date
            $event_start_db_row_id = $row; // mark the starting db row
            $row_span = 1;
            
        } else { // same event_id
            // Set the 'row_span' for the spanning cells of the event to zero ('row_span' = 0)
            $event_row_data[$db_starting_time][$db_starting_date] = 0;
            //echo "<strong>Same Event ID:</strong> ".$db_starting_time.", ".$row.", ".$db_event_id."<br />";
            $row_span++;
        }
        $previous_event_id = $db_event_id;
        $previous_event_date = $db_starting_date;
        
      } // end of while
      
      // return the resulting data object
      return $result;
    }

    // Get the Event Data query object for the Day View
    // $date - YYYY-MM-DD
    // $location - Location ID
    function get_day_view_event_data($date, $room = '') {
      // Check Valid Date
      if (!check_valid_date($date)) $date = '1970-01-01';
      list ($year, $month, $day) = explode("-", $date);
      $q = "SELECT 
                * 
            FROM 
                room_time_slot 
            LEFT JOIN 
                room_schedule 
            ON 
                timeSlotID = room_datetime_slot_id 
            WHERE 
                roomCode = '$room' 
            AND 
                schedule_date_time >= '".$date." 00:00:00' 
            AND 
                schedule_date_time <= '".$date." 23:59:59' 
            ORDER BY 
                schedule_date_time";
      //echo $query."<br /><br />";
      $result = DB::inst()->query($query);
      $db_num_rows = $result->rowCount();
      
      // Event Row Data Assoc. Array
      //    $event_row_data['display_time'] = 'db_row_id|row_span|start_time|end_time';
      $event_row_data = array();
      global $event_row_data;
      
      // Get the Display Times and Number of Rows
      $data_display_times = get_times_in_range(MIN_BOOKING_HOUR, MAX_BOOKING_HOUR, BOOKING_TIME_INTERVAL, true);
      $number_of_display_time_rows = count($data_display_times);
      
      // Create an Assoc. Date array for index lookup.
      $display_time_lookup = array ();
      for ($i=0; $i<$number_of_display_time_rows; $i++) {
        $display_time_lookup[$data_display_times[$i]] = $i;
      }
      
      // $event_row_data array - build out the schedule time blocks
      foreach ($data_display_times as $display_time) {
        $event_row_data[$display_time] = '';
      }
      reset($data_display_times);
      
      if (!$result) {
        //echo "No Database Events / Results<br />";
        return false;
      }
      // Go thru the database $result data and fill out the $event_row_data array.
      $previous_event_id = 0;
      $row_span = 0;
      $row = 0;
      $event = array();
      //echo "<h1>TESTING</h1>";
      
      for ($row=0; $row<=$db_num_rows; $row++) {
        
        // define db variables
        $event = $result->fetchAll(\PDO::FETCH_ARRAY);
        $db_event_id = $event['event_id'];
        //echo "ID: $db_event_id<br />";
        list ($db_starting_date, $db_starting_time) = explode(" ", $event['schedule_date_time']);
        list ($db_hr, $db_min, $db_sec) = explode(":", $db_starting_time);
        $db_starting_time = sprintf("%02d", $db_hr).':'.sprintf("%02d", $db_min);
        
        if ($previous_event_id != $db_event_id || $previous_event_id == 0) { // event_id has changed / or first event_id
            
            if ($previous_event_id != 0) { // if not first id, then define $event_row_data array
                
                // place the event data into $event_row_data: 'db_row_id|row_span|start_time|end_time'
                $event_row_data[$event_start_time] = $event_start_db_row_id."|".$row_span."|".$event_start_time."|".
                                $data_display_times[($display_time_lookup[$event_start_time]+$row_span)];
                // echo values for testing
                //echo "Define Event -> " . $event_row_data[$event_start_time] . "<br />";
                // initialize the row_span for the new event
                $row_span = 1;
            }
            // Mark the event starting time and db row id to be used to data_seeking
            //echo "<strong>Mark Start:</strong> ".$db_starting_time.", ".$row.", ".$db_event_id."<br />";
            $event_start_time = $db_starting_time; // mark the starting time
            $event_start_db_row_id = $row; // mark the starting db row
            $row_span = 1;
            
        } else { // same event_id
            // Set the 'row_span' for the spanning cells of the event to zero ('row_span' = 0)
            $event_row_data[$db_starting_time] = 0;
            //echo "<strong>Same Event ID:</strong> ".$db_starting_time.", ".$row.", ".$db_event_id."<br />";
            $row_span++;
        }
        $previous_event_id = $db_event_id;
        
      } // end of while
      
      // return the resulting data object
      return $result;
    }

    // Get the event details from the database.
    function get_event_details($eventID) {
      // Get the requested event bases on event_id
      $result = DB::inst()->query("SELECT * FROM room_event WHERE 
                            eventID = '" . $eventID . "'");
      if (!$result) { return false; }
      $event = $result->fetchAll(\PDO::FETCH_ARRAY);
      // return the event data
      return $event;
    }

    // Get the Event Dates and Time Ranges from the database.
    // $event_id - Event ID#
    // returns $dates_and_time_ranges, format: 'start_date start_time-end_time'
    function get_event_dates_and_time_ranges($room = '') {
        
      $result = DB::inst()->query( "SELECT 
                    schedule_date_time,
                    roomID 
                FROM 
                    room_time_slot 
                LEFT JOIN 
                    room_schedule 
                ON 
                    timeSlotID = room_datetime_slot_id 
                WHERE 
                    roomCode = '$room' 
                ORDER BY 
                    schedule_date_time 
                ASC 
                LIMIT 
                    1" );
                    
      $row = $result->fetchAll(\PDO::FETCH_ARRAY);
      $min_schedule_date_time = $row['schedule_date_time'];
      list ($min_schedule_date, $min_schedule_time) = explode(" ", $row['schedule_date_time']);
      
      $result = DB::inst()->query( "SELECT 
                    schedule_date_time,
                    roomID 
                FROM 
                    room_time_slot 
                LEFT JOIN 
                    room_schedule 
                ON 
                    timeSlotID = room_datetime_slot_id 
                WHERE 
                    roomCode = '$room' 
                ORDER BY 
                    schedule_date_time 
                DESC 
                LIMIT 
                    1" );
      $row = $result->fetchAll(\PDO::FETCH_ARRAY);
      $max_schedule_date_time = $row['schedule_date_time'];
      list ($max_schedule_date, $max_schedule_time) = explode(" ", $row['schedule_date_time']);
      
      $result = "SELECT 
                    schedule_date_time,
                    roomID 
                FROM 
                    room_time_slot 
                LEFT JOIN 
                    room_schedule 
                ON 
                    timeSlotID = room_datetime_slot_id 
                WHERE 
                    (schedule_date_time > '" . $min_schedule_date . " ".MIN_BOOKING_HOUR.":00:00' 
                AND 
                    schedule_date_time < '" . $max_schedule_date . " ".MAX_BOOKING_HOUR.":00:00') 
                OR 
                    schedule_date_time = '" . $min_schedule_date . " ".MIN_BOOKING_HOUR.":00:00' 
                OR 
                    schedule_date_time = '" . $max_schedule_date . " ".MAX_BOOKING_HOUR.":00:00' 
                ORDER BY 
                    schedule_date_time 
                ASC";
                
      $result = DB::inst()->query($query);
      if (!$result) { return false; } // no database dates and times
      $db_num_rows = $result->rowCount();
      
      // Event Dates and Time Ranges Array
      //    $dates_and_time_ranges[] = 'start_date start_time-end_time';
      $dates_and_time_ranges = array();
      
      // Go thru the database $result data and fill out the $dates_and_time_ranges array.
      $previous_event_id = 0;
      $row_span = 0;
      $row = 0;
      $event = array();
      
      for ($row=0; $row<=$db_num_rows; $row++) {
        
        // define db variables
        $event = $result->fetchAll(\PDO::FETCH_ARRAY);
        $db_event_id = $event[$location_db_name[$location]];
        //echo "ID: $db_event_id<br />";
        list ($db_date, $db_time) = explode(" ", $event['schedule_date_time']);
        list ($db_hr, $db_min, $db_sec) = explode(":", $db_starting_time);
        if ($row > 0 && empty($db_time)) $db_time = MAX_BOOKING_HOUR.":00";
        
        if ($event_id == $db_event_id && $db_event_id != $previous_event_id ) {
            // Start of Event Range
            $event_start_time = $db_time; // mark the starting time
            $event_start_date = $db_date; // mark the starting date
            
        } else if ( $event_id == $previous_event_id && 
            ($db_event_id != $event_id || $db_date != $previous_event_date) ) {
            // End of Event Range
            // place the event data into $event_row_data: 'start_date start_time-end_time'
            $new_event_range = $event_start_date." ".$event_start_time."-".
                            "".$db_time;
            $dates_and_time_ranges[] = $new_event_range;
            // echo values for testing
            //echo "Define Event -> " . $event_start_date ."/" . $previous_event_id . " => " . $new_event_range . "<br />";
        }
        $previous_event_id = $db_event_id;
        $previous_event_date = $db_date;
        $previous_event_time = $db_time;
        
      } // end for loop
      
      // return the resulting dates_and_time_ranges string
      // format: 'start_date start_time-end_time'
      return $dates_and_time_ranges;
    }

    function add_event($scheduled_date_time_data, 
                    $subject, $location, $starting_date_time, $ending_date_time, 
                    $recur_interval, $recur_freq, $recur_until_date, $description) {
      // Add new event to the database
      
      // Check for repeat event; 'double click'
      // This might be removed in the future due to a future JavaScript function.
      $result = wrap_db_query("SELECT eventID FROM " . BOOKING_USER_TABLE . ", " . BOOKING_EVENT_TABLE . " 
                            WHERE " . BOOKING_USER_TABLE . ".username='" . mysql_real_escape_string($username) . "' AND
                            " . BOOKING_USER_TABLE . ".user_id = " . BOOKING_EVENT_TABLE . ".user_id AND 
                            " . BOOKING_EVENT_TABLE . ".subject = '" . mysql_real_escape_string($subject) . "' AND 
                            " . BOOKING_EVENT_TABLE . ".location = '" . mysql_real_escape_string($location) . "' AND 
                            " . BOOKING_EVENT_TABLE . ".starting_date_time = '" . mysql_real_escape_string($starting_date_time) . "' AND 
                            " . BOOKING_EVENT_TABLE . ".ending_date_time = '" . mysql_real_escape_string($ending_date_time) . "' AND 
                            " . BOOKING_EVENT_TABLE . ".recur_interval = '" . mysql_real_escape_string($recur_interval) . "' AND 
                            " . BOOKING_EVENT_TABLE . ".recur_freq = " . mysql_real_escape_string($recur_freq) . " AND 
                            " . BOOKING_EVENT_TABLE . ".recur_until_date = '" . mysql_real_escape_string($recur_until_date) . "' AND 
                            " . BOOKING_EVENT_TABLE . ".description = '" . mysql_real_escape_string($description) . "'");
      
      //echo "Duplicate Rows: " . wrap_db_num_rows($result) . "<br />";
      if ($result && ($result->rowCount() > 0)) {
            return false;
      }
      // get user_id based on current $username
      $user_id = get_user_id($username);
      if (empty($user_id)) {
         return false;
      }
      
      // insert the new event
      $result = wrap_db_query("INSERT INTO " . BOOKING_EVENT_TABLE . " SET 
                            user_id = " . mysql_real_escape_string($user_id) . ", 
                            subject = '" . mysql_real_escape_string($subject) . "', 
                            location = '" . mysql_real_escape_string($location) . "', 
                            starting_date_time = '" . mysql_real_escape_string($starting_date_time) . "', 
                            ending_date_time = '" . mysql_real_escape_string($ending_date_time) . "', 
                            recur_interval = '" . mysql_real_escape_string($recur_interval) . "', 
                            recur_freq = " . mysql_real_escape_string($recur_freq) . ", 
                            recur_until_date = '" . mysql_real_escape_string($recur_until_date) . "', 
                            description = '" . mysql_real_escape_string($description) . "', 
                            date_time_added = NOW(), 
                            last_mod_by_id = '', 
                            last_mod_date_time = '0000-00-00 00:00:00'");
      if (!$result) {
            return false;
      }
      // Get the event_id (auto) for the event just added to the event table.
      $event_id = wrap_db_insert_id();
      
      // Insert the event_id into the schedule table at the appropriate date-time slots.
      $add_date_time_error = false;
      foreach ($scheduled_date_time_data as $date_time) {
            $result = wrap_db_query( "UPDATE " . DATE_TIME_SCHEDULE_TABLE . " 
                            SET " . $location_db_name[$location] . " = " . mysql_real_escape_string($event_id) . " 
                            WHERE schedule_date_time = '" . mysql_real_escape_string($date_time) . "' AND 
                            " . $location_db_name[$location] . " = 0");
            //echo "location: $location, event_id: $event_id <br />";
            if (!$result) { $add_date_time_error = true; }
      }
      if ($add_date_time_error == true) {
            // Delete Event Info Function needs to be added here!
            echo "ERROR! A date and time slot could not be filled properly!<br />";
            return false;
      }
      
      return $event_id;
    }




// Define Current & Selected Date Constants

// Today's Date Data

  $tmp_todays_dates = date("Y-m-d|j M Y|l F j, Y");
  list($tmp_today, $tmp_shortstr, $tmp_longstr) = explode("|", $tmp_todays_dates);
  define('TODAYS_DATE', $tmp_today);       // YYYY-MM-DD
  list($tmp_year, $tmp_month, $tmp_day) = explode("-", $tmp_today);
  define('TODAYS_DATE_YEAR', $tmp_year);    // 4 Digit
  define('TODAYS_DATE_MONTH', $tmp_month); // 2 Digit
  define('TODAYS_DATE_DAY', $tmp_day);    // 2 Digit
  define('TODAYS_DATE_SHORTSTR', $tmp_shortstr);  // 21 Mar 2003
  define('TODAYS_DATE_LONGSTR', $tmp_longstr);    // Saturday, January 25, 2003

// Selected Date Data

  @list($sel_year, $sel_month, $sel_day) = explode("-", $_REQUEST['date']);
  if (!checkdate($sel_month+0, $sel_day+0, $sel_year+0)) {
        $_REQUEST['date'] = TODAYS_DATE;
        list($sel_year, $sel_month, $sel_day) = explode("-", $_REQUEST['date']);
  }
  if (strlen($sel_year) == 2 && $sel_year <= 69) { $sel_year += 2000; }
  define('SELECTED_DATE_YEAR', sprintf("%04d", $sel_year));
  define('SELECTED_DATE_MONTH', sprintf("%02d", $sel_month));
  define('SELECTED_DATE_DAY', sprintf("%02d", $sel_day));
  define('SELECTED_DATE', SELECTED_DATE_YEAR . '-' . SELECTED_DATE_MONTH . '-' . SELECTED_DATE_DAY);
  $_REQUEST['date'] = SELECTED_DATE;
  $tmp_todays_dates = date("j M Y|l F j, Y", mktime(1, 0, 0, SELECTED_DATE_MONTH, SELECTED_DATE_DAY, SELECTED_DATE_YEAR));
  list($tmp_shortstr, $tmp_longstr) = explode("|", $tmp_todays_dates);
  define('SELECTED_DATE_SHORTSTR', $tmp_shortstr);  // 21 Mar 2003
  define('SELECTED_DATE_LONGSTR', $tmp_longstr);    // Saturday, January 25, 2003

// Selected Date Data - Previous/Next Day, Month, & Year Data

  define('PREVIOUS_DAY_DATE', add_delta_ymd(SELECTED_DATE, 0, 0, -1));
  define('NEXT_DAY_DATE', add_delta_ymd(SELECTED_DATE, 0, 0, 1));
  define('PREVIOUS_MONTH_DATE', add_delta_ymd(SELECTED_DATE, 0, -1, 0));
  define('NEXT_MONTH_DATE', add_delta_ymd(SELECTED_DATE, 0, 1, 0));
  define('PREVIOUS_YEAR_DATE', add_delta_ymd(SELECTED_DATE, -1, 0, 0));
  define('NEXT_YEAR_DATE', add_delta_ymd(SELECTED_DATE, 1, 0, 0));

// Create the schedule table data for the selected month date (year and month).
  //include_once("booking_db_fns.php");
  $res = create_date_time_schedule_data(SELECTED_DATE, $_REQUEST['roomCode']);