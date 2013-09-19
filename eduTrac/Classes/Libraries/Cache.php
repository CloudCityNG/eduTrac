<?php namespace eduTrac\Classes\Libraries;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * MegaCache Class
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

class Cache {
    
	/**
	 * The path to the cache file folder
	 *
     * @access private
     * @since 1.0.0
	 * @var string
	 */
	private $_cachepath = 'cache/';
	
	/**
	 * The key name of the cache file
	 *
     * @access private
     * @since 1.0.0
	 * @var string
	 */
	private $_cachename = 'default';
	
	/**
	 * The cache file extension
	 *
     * @access private
     * @since 1.0.0
	 * @var string
	 */
	private $_extension = '.cache';
	
	/**
	 * Time to live for cache file
	 *
     * @access private
     * @since 1.0.0
	 * @var int
	 */
	private $_setTTL = '3600';
	
	/**
	 * Full location of cache file
	 *
     * @access private
     * @since 1.0.0
	 * @var string
	 */
	private $_cachefile;
	
	/**
	 * Execution Time
	 *
     * @access private
     * @since 1.0.0
	 * @var float
	 */
	private $_starttime;
	
	/**
	 * Logs errors that may occur
	 *
     * @access private
     * @since 1.0.0
	 * @var float
	 */
	private $_log;
	
	public function __construct($expire='', $path='', $name='') {
		$this->_setTTL = $expire;
		$this->_cachepath = $path;
		$this->_cachename = $name;
		
		if(!is_dir($this->_cachepath) || !is_writeable($this->_cachepath)) mkdir($this->_cachepath, 0755);
		
		$this->_cachefile = $this->_cachepath . $this->_cachename . $this->_extension;
		
		$mtime = microtime();
   		$mtime = explode(" ",$mtime);
   		$mtime = $mtime[1] + $mtime[0];
   		$this->_starttime = $mtime;
	}
	
	/**
	 * Sets objects that should be cached.
	 * 
     * @access public
     * @since 1.0.0
	 * @param string (required) $key Prefix of the cache file
	 * @param mixed (required) $data The object that should be cached
	 * @return mixed
	 */
	public function set($key, $data) {
		$values = serialize($data);
		$cachefile = $this->_cachepath . $key . $this->_extension;
		$cache = fopen($cachefile, 'w');
		if($cache) {
			fwrite($cache, $values);
			fclose($cache);
		} else {
			return $this->addLog( 'Unable to write key: ' . $key . ' file: ' . $cachefile );
		}
	}
	
	/**
	 * Cached data by its Prefix
	 * 
     * @access public
     * @since 1.0.0
	 * @param string (required) $key Returns cached objects by its key.
	 * @return mixed
	 */
	public function get($key) {
		$cachefile = $this->_cachepath . $key . $this->_extension;
		$file = fopen($cachefile, 'r');
		if (filemtime($cachefile) < (time() - $this->_setTTL)) {  
            $this->clearCache($key);  
            return false;  
        }  
		if($file) {
			$data = fread($file, filesize($cachefile));
		    fclose($file);
		    return unserialize($data);
		}
	}
	
	/**
	 * Begins the section where caching begins
	 * 
     * @access public
     * @since 1.0.0
	 * @return mixed
	 */
	public function setCache() {
		if(!$this->isCacheValid($this->_cachefile)) {
			ob_start();
			return $this->addLog( 'Could not find valid cachefile: ' . $this->_cachefile );
    	} else {
    		return true;
    	}
	}
	
	/**
	 * Ends the section where caching stops and returns 
	 * the cached file.
	 * 
     * @access public
     * @since 1.0.0
	 * @return mixed
	 */
	public function getCache() {
		if(!$this->isCacheValid($this->_cachefile)) {
			$output = ob_get_contents();
			ob_end_clean();
			$this->writeCache($output, $this->_cachefile);
		} else {
			$output = $this->readCache($this->_cachefile);
		}
		return $output;
	}
	
	/**
	 * Reads a cache file if it exists and prints it out 
	 * to the screen.
	 * 
     * @access public
     * @since 1.0.0
	 * @param string (required) $filename Full path to the requested cache file
	 * @return mixed
	 */
	public function readCache($filename) {
		if ( file_exists($filename) ) {
			$cache = fopen($filename, 'r');
			$output = fread($cache, filesize($filename));
			fclose($cache);
			return unserialize($output) . "\n" . $this->pageLoad();
		} else {
			return $this->addLog( 'Could not find filename: ' . $filename );
		}
	}
	
	/**
	 * Writes cache data to be read
	 * 
     * @access public
     * @since 1.0.0
	 * @param string (required) $data Data that should be cached
	 * @param string (required) $filename Name of the cache file
	 * @return mixed
	 */
	public function writeCache($data, $filename) {
		$fp = fopen($filename, 'w');
		if($fp) {
			$values = serialize($data);
	    	fwrite($fp, $values);
	    	fclose($fp);
		} else {
			return $this->addLog( 'Could not read filename: ' . $filename . ' data: ' . $data );
		}
	}
	
	/**
	 * Checks if a cache file is valid
	 * 
     * @access public
     * @since 1.0.0
	 * @param string (required) $filename Name of the cache file
	 * @return mixed
	 */
	public function isCacheValid($filename) {
		if(file_exists($filename) && (filemtime($filename) > (time() - $this->_setTTL))){
			return true;
		}else{
			return $this->addLog( 'Could not find filename: ' . $filename );	
		}
	}
	
	/**
	 * Execution time of the cached page
	 * 
     * @access public
     * @since 1.0.0
	 * @return mixed
	 */
	public function pageLoad() {
		$mtime = microtime();
   		$mtime = explode(" ",$mtime);
   		$mtime = $mtime[1] + $mtime[0];
   		$endtime = $mtime;
   		$totaltime = ($endtime - $this->_starttime);
   		return "<!-- This cache file was built for ( " . $_SERVER['SERVER_NAME'] . " ) in " . $totaltime . " seconds, on " . gmdate("M d, Y") . " @ " . gmdate("H:i:s A") . " UTC. -->"; 
	}
	
	/**
	 * Clears the cache base on cache file name/key
	 * 
     * @access public
     * @since 1.0.0
	 * @param string (required) $filename Key name of cache
	 * @return mixed
	 */
	public function clearCache($filename) {
		$cachelog = $this->_cachepath . $filename . $this->_extension;
		if(file_exists($cachelog)) {
			unlink($cachelog);
		}
	}
	
	/**
	 * Clears all cache files
	 * 
     * @access public
     * @since 1.0.0
	 * @return mixed
	 */
	public function purge() {
		foreach(glob($this->_cachepath . '*.cache') as $file) {
			unlink($file);
		}
	}
	
	/**
	 * Prints a log if error occurs
	 * 
     * @access public
     * @since 1.0.0
	 * @param mixed (required) $value Message that should be returned
	 * @return mixed
	 */
	public function addLog($value) {
        $this->_log = [];
		array_push($this->_log, round((microtime(true) - $this->_starttime),5).'s - '. $value);
	}
}