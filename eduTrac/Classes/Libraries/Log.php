<?php namespace eduTrac\Classes\Libraries;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
use \eduTrac\Classes\Core\DB;
/**
 * Event Logger Library
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

class Log {
    
    private $_auth;
    
    public function __construct() {
        $this->_auth = new \eduTrac\Classes\Libraries\Cookies;
    }
    
    /**
     * Writes a log to the log table in the database.
     * 
     * @since 1.0.0
     */
    public function writeLog($action,$process,$record,$uname) {
        $create = date("Y-m-d H:i:s", time());
        $current_date = strtotime($create);
        /* 10 days after creation date */
        $expire = date("Y-m-d H:i:s",$current_date+=864000);
        
        $bind = array( 
                       "action" => $action, "process" => $process, "record" => $record,
                       "uname" => $uname, "created_at" => $create, "expires_at" => $expire 
        );
        
        $q = DB::inst()->insert( "activity_log", $bind );
    }
    
    /**
     * Purges audit trail logs that are older than 30 days old.
     * 
     * @since 1.0.0
     */
    public function purgeLog() {
        $bind = [ ":today" => date('Y-m-d H:i:s', time()) ];
        DB::inst()->query( "DELETE FROM activity_log WHERE expires_at <= :today",$bind );
    }
    
    /**
     * Purges system error logs that are older than 30 days old.
     * 
     * @since 1.0.0
     */
    public function purgeErrLog() {
    	foreach (glob(BASE_PATH .'tmp/logs/*.txt') as $file) {
        $filelastmodified = filemtime($file);
	        if((time() - $filelastmodified) > 30*24*3600 && is_file($file)) {
                unlink($file);
	        }
		}
    }
    
    public function logError($type,$string,$file,$line) {
        $date = new \DateTime();
        $bind = array( "time" => $date->getTimestamp(),"type" => (int)$type,
                        "string" => $string,"file" => $file,"line" => (int)$line 
        );
        
        $q = DB::inst()->insert( "error", $bind );
    }
    
    public function error_constant_to_name($value) {
        $values = array( 
            E_ERROR     => 'E_ERROR',
            E_WARNING   => 'E_WARNING',
            E_PARSE     => 'E_PARSE',
            E_NOTICE    => 'E_NOTICE',
            E_CORE_ERROR    => 'E_CORE_ERROR',
            E_CORE_WARNING  => 'E_CORE_WARNING',
            E_COMPILE_ERROR => 'E_COMPILE_ERROR',
            E_COMPILE_WARNING   => 'E_COMPILE_WARNING',
            E_USER_ERROR        => 'E_USER_ERROR',
            E_USER_WARNING      => 'E_USER_WARNING',
            E_USER_NOTICE       => 'E_USER_NOTICE',
            E_STRICT            => 'E_STRICT',
            E_RECOVERABLE_ERROR => 'E_RECOVERABLE_ERROR',
            E_DEPRECATED        => 'E_DEPRECATED',
            E_USER_DEPRECATED   => 'E_USER_DEPRECATED',
            E_ALL               => 'E_ALL'
        );
        
        return $values[$value];
    }
    
    public function setLog($action,$process,$record,$uname) {
        return $this->writeLog($action, $process, $record, $uname);
    }
    
    public function setError($type,$string,$file,$line) {
        return $this->logError($type,$string,$file,$line);
    }
}