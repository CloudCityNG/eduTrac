<?php namespace eduTrac\Classes\Libraries;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
use \eduTrac\Classes\Core\DB;
use \eduTrac\Classes\Libraries\Hooks;
/**
 * Cron Class
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

class Cron {
    
    public $script;
    
    public $output;
    
    public $executionTime;
    
    public function run($id) {
        $q = DB::inst()->query("UPDATE cronjob SET currently_running = '1' WHERE id = '$id'");
        register_shutdown_function(array($this, 'Clear'), $id); // registered incase execution times out before Stopped called
        return $q;
    }
    
    public function stop($id) {
        $q = DB::inst()->query("UPDATE cronjob SET currently_running = '0' WHERE id = '$id'");
        if(Hooks::get_option('enable_cron_log') == 1) {
            $now = time();
            $this->output = substr(htmlentities($this->output), 0, 1200);// truncate output to defined length     
            $sql = DB::inst()->query( "INSERT INTO cronlog (`date_added`,`script`, `output`, `execution_time`)
                    VALUES ('$now', '$this->script','$this->output','$this->executionTime')" );
        }
    }
    
    public function fireScript($script, $id, $buffer_output = 1) {
        if($buffer_output) ob_start();
        $this->script = $script;
        if ($this->run($id) ) {
          $start_time = microtime(true);
          $fire_type = (function_exists('curl_exec') ) ? " PHP CURL " : " PHP fsockopen ";
          //                 "://" satisfies both cases http:// and https://
          if (strstr($script,"://") ) {
              $this->fireRemoteScript($script);
          } else {
             include($script);
             $fire_type = " PHP include ";
          }
          if($buffer_output) {
              $this->output = ob_get_contents();
          } else {
              $this->output = "";
          }
          $this->executionTime = number_format( (microtime(true) - $start_time), 5 )." seconds via".$fire_type;
          $this->stop($id);
         }
         if($buffer_output) ob_end_clean();
    }
    
    public function fireRemoteScript($url) {
        $url_parsed = parse_url($url);
        $scheme = $url_parsed["scheme"];
        $host = $url_parsed["host"];
        $port = isset($url_parsed["port"]) ? $url_parsed["port"] : 80;
        $path = isset($url_parsed["path"]) ? $url_parsed["path"] : "/";
        $query = isset($url_parsed["query"]) ? $url_parsed["query"] : "";
        $user = isset($url_parsed["user"]) ? $url_parsed["user"] : "";
        $pass = isset($url_parsed["pass"]) ? $url_parsed["pass"] : "";
        $useragent = "Cron";
        $referer=$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
        $buffer="";
        if (function_exists('curl_exec')) {
           $ch = curl_init($scheme."://".$host.$path);
           curl_setopt($ch, CURLOPT_PORT, $port);
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
           curl_setopt($ch, CURLOPT_HEADER, 0);
           curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
           curl_setopt($ch, CURLOPT_FAILONERROR,1); // true to fail silently
           curl_setopt($ch, CURLOPT_AUTOREFERER,1);
           curl_setopt($ch, CURLOPT_POSTFIELDS,$query);
           curl_setopt($ch, CURLOPT_REFERER,$referer);
           curl_setopt($ch, CURLOPT_USERAGENT,$useragent);
           curl_setopt($ch, CURLOPT_USERPWD,$user.":".$pass);
           $buffer = curl_exec($ch);
           curl_close($ch);
        } elseif ( $fp = fsockopen($host, $port, $errno, $errstr, 30) ) {
           $header = "POST $path HTTP/1.0\r\nHost: $host\r\nReferer: $referer\r\n"
         ."Content-Type: application/x-www-form-urlencoded\r\n"
         ."User-Agent: $useragent\r\n"
         ."Content-Length: ". strlen($query)."\r\n";
           if($user!= "") $header.= "Authorization: Basic ".base64_encode("$user:$pass")."\r\n";
           $header.= "Connection: close\r\n\r\n";
           fputs($fp, $header);
           fputs($fp, $query);
           if ($fp) while (!feof($fp)) $buffer.= fgets($fp, 8192);
           fclose($fp);
          }
        return $buffer;
    }
    
    public function schedule() {
        $timeWindow =  time() + 3600;
        $q = DB::inst()->query( "select * from cronjob WHERE fire_time <= '$timeWindow'" );
        $r = $q->fetch(\PDO::FETCH_OBJ);
        $scripts_to_run = array();
        if ($q->rowCount()) {
        $i = 0;
        while ($i < $q->rowCount()) {
          $id = $r ? $r->id : $i;
          $scriptpath = $r ? $r->scriptpath : $i;
          $time_interval = $r ? $r->time_interval : $i;
          $fire_time = $r ? $r->fire_time : $i;
          $time_last_fired = $r ? $r->time_last_fired : $i;
          $run_only_once = $r ? $r->run_only_once : $i;
          $fire_time_new = $fire_time + $time_interval;
          $scripts_to_run[$i]["script"]="$scriptpath";
          $scripts_to_run[$i]["id"]=$id;
          DB::inst()->query("UPDATE cronjob
                            SET
                             fire_time = '$fire_time_new',
                             time_last_fired = '$fire_time'
                            WHERE id = '$id'");
          if($run_only_once) DB::inst()->query("DELETE from cronjob WHERE id = '$id' ");
          $i++;
         }
        }
        // run the scheduled scripts
        $log_date="";
        $log_output="";
        for ($i = 0; $i < count($scripts_to_run); $i++) $this->fireScript($scripts_to_run[$i]['script'],$scripts_to_run[$i]['id']);
    }
    
    public function Clear($id) {
        //If things go wrong, or script timeout CLEAR script so will run next time
        $q = DB::inst()->query("UPDATE cronjob SET currently_running = '0' WHERE id = '$id' ");
    }
    
    public function time_unit($time_interval) {
         $unit = array(0, 'type');
         //check if its minutes
         if ($time_interval <= (59 * 60)) {
          $unit[0]=$time_interval/60;
          $unit[1]="<font color=\"#000000\">minute(s)</font>";
         }
         //check if its hours
         if ( ($time_interval > (59 * 60)) AND ($time_interval<= (23 * 3600)) ) {
          $unit[0]=$time_interval/3600;
          $unit[1]="<font color=\"#ff0000\">hour(s)</font>";
         }
          // check if its days
         if ( ($time_interval > (23 * 3600)) AND ($time_interval <= (6 * 86400)) ) {
          $unit[0]=$time_interval/86400;
          $unit[1]="<font color=\"#FF8000\">day(s)</font>";
         }
         if ($time_interval >(6 * 86400)) {
          $unit[0]=$time_interval/604800;
          $unit[1]="<font color=\"#C00000\">week(s)</font>";
         }
         $thedomain = $_SERVER['HTTP_HOST'];
         return $unit;
    }
    
}