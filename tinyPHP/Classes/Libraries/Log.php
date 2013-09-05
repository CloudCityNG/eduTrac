<?php namespace tinyPHP\Classes\Libraries;
/**
 *
 * Event Logger Library
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
use \tinyPHP\Classes\Libraries\Cookies;
class Log {
    
    private $_auth;
	
    public function __construct() {
        $this->_auth = new Cookies;
    }
	
	/**
	 * Writes a log to the log table in the database.
	 * 
	 * @since 1.0
	 */
	public function writeLog($action,$process,$record) {
	    $create = date("Y-m-d");
        $current_date = strtotime($create);
        $uname = $this->_auth->getPersonField('uname');
        /* 30 days after creation date */
        $expire = date("Y-m-d",$current_date+=2592000);
        
	    $bind = array( 
	                   "action" => $action, "process" => $process, "record" => $record,
	                   "uname" => $uname, "created_at" => $create, "expires_at" => $expire 
        );
        
        $q = DB::inst()->insert( "activity_log", $bind );
	}
	
	/**
	 * Purges audit trail logs that are older than 30 days old.
	 * 
	 * @since 1.0
	 */
	public function purgeLog() {
	    $date = date('Y-m-d h:i:s', time());
		$q = DB::inst()->query( "SELECT * FROM activity_log" );
		$r = $q->fetch(\PDO::FETCH_ASSOC);
		
		DB::inst()->query( "DELETE FROM activity_log WHERE '".$r['expires_at']."' <= '".$date."'" );
	}
	
	/**
	 * Purges system error logs that are older than 30 days old.
	 * 
	 * @since 1.0
	 */
	public function purgeErrLog() {
		if($handle = opendir(BASE_PATH . 'tmp/logs/')) {
			while(false !== ($file = readdir($handle))) {
				$filelastmodified = filemtime($file);
				if((time() - $filelastmodified) > 30*24*3600 && is_file($file)) {
					if(preg_match('/\.txt$/i', $file)) {
						unlink($file);
					}
				}
			}
		}
		closedir($handle);
	}
    
    public function logError($type,$string,$file,$line) {
        $date = new \DateTime();
        $bind = array( "time" => $date->getTimestamp(),"type" => (int)$type,
                        "string" => $string,"file" => $file,"line" => (int)$line 
        );
        
        $q = DB::inst()->insert( TP."error", $bind );
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
    
    public function setLog($action,$process,$record) {
        return $this->writeLog($action, $process, $record);
    }
    
    public function setError($type,$string,$file,$line) {
        return $this->logError($type,$string,$file,$line);
    }
}