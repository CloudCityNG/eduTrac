<?php namespace eduTrac\Classes\Libraries;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Utility library helper functions
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
 * @since       1.1.3
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

class Util
{
	
	/**
     * Return the file extension of the given filename.
     *
     * @param  string $filename
     * @return string
	 * @since   1.1.3
     */
    public static function get_file_ext($filename)
    {
        return pathinfo($filename, PATHINFO_EXTENSION);
    }
	
	/**
     * Transmit headers that force a browser to display the download file
     * dialog. Cross browser compatible. Only fires if headers have not
     * already been sent.
     *
     * @param   string  $filename  The name of the filename to display to
     *                             browsers
     * @param   string  $content   The content to output for the download.
     *                             If you don't specify this, just the
     *                             headers will be sent
     * @return  bool
     *
     * @link    http://www.php.net/manual/en/function.header.php#102175
     *
     * @access  public
     * @since   1.1.3
     */
    public static function force_download( $filename, $content = FALSE )
    {
        if ( ! headers_sent() ) {
            // Required for some browsers
            if ( ini_get( 'zlib.output_compression' ) ) {
                 ini_set( 'zlib.output_compression', 'Off' );
            }

            header( 'Pragma: public' );
            header( 'Expires: 0' );
            header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );

            // Required for certain browsers
            header( 'Cache-Control: private', FALSE );

            header( 'Content-Disposition: attachment; filename="' . basename( str_replace( '"', '', $filename ) ) . '";' );
            header( 'Content-Type: application/force-download' );
            header( 'Content-Transfer-Encoding: binary' );

            if ( $content ) {
               header( 'Content-Length: ' . strlen( $content ) );
            }

            ob_clean();
            flush();

            if ( $content ) {
                echo $content;
            }

            return TRUE;
        } else {
            return FALSE;
        }
    }
	
	/**
     * Truncate a string to a specified length without cutting a word off
     *
     * @param   string  $string  The string to truncate
     * @param   int     $length  The length to truncate the string to
     * @param   string  $append  Text to append to the string IF it gets
     *                           truncated, defaults to '...'
     * @return  string
     *
     * @access  public
     * @since   1.1.3
     */
    public static function safe_truncate( $string, $length, $append = '...' )
    {
        $ret        = substr( $string, 0, $length );
        $last_space = strrpos( $ret, ' ' );

        if ( $last_space !== FALSE && $string != $ret ) {
            $ret     = substr( $ret, 0, $last_space );
        }

        if ( $ret != $string ) {
            $ret .= $append;
        }

        return $ret;
    }
	
	/**
     * Accepts an array, and returns an array of values from that array as
     * specified by $field. For example, if the array is full of objects
     * and you call util::array_pluck( $array, 'name' ), the function will
     * return an array of values from $array[]->name
     *
     * @param   array   $array             An array
     * @param   string  $field             The field to get values from
     * @param   bool    $preserve_keys     Whether or not to preserve the
     *                                     array keys
     * @param   bool    $remove_nomatches  If the field doesn't appear to
     *                                     be set, remove it from the array
     * @return  array
     *
     * @link    http://codex.wordpress.org/Function_Reference/wp_list_pluck
     *
     * @access  public
     * @since   1.1.3
     */
    public static function array_pluck( array $array, $field, $preserve_keys = TRUE, $remove_nomatches = TRUE )
    {
        $new_list = array();

        foreach ( $array as $key => $value ) {
            if ( is_object( $value ) ) {
                if ( isset( $value->{$field} ) ) {
                    if ( $preserve_keys ) {
                        $new_list[$key] = $value->{$field};
                    } else {
                        $new_list[] = $value->{$field};
                    }
                } else if ( ! $remove_nomatches ) {
                    $new_list[$key] = $value;
                }
            } else {
                if ( isset( $value[$field] ) ) {
                    if ( $preserve_keys ) {
                        $new_list[$key] = $value[$field];
                    } else {
                        $new_list[] = $value[$field];
                    }
                } else if ( ! $remove_nomatches ) {
                    $new_list[$key] = $value;
                }
            }
        }

        return $new_list;
    }
	
	/**
	 * Generates a unique ID.
	 */
	public static function generate_unique_id($prefix, $bool = false)
	{
		return uniqid($prefix,$bool);
	}
	
	/**
	 * Encode email
	 */
	public static function encode_email($email, $linkText='Contact Us', $attrs ='class="emailencoder"' )
	{
		// remplazar aroba y puntos
		$email = str_replace('@', '&#64;', $email);
		$email = str_replace('.', '&#46;', $email);
		$email = str_split($email, 5);
	
		$linkText = str_replace('@', '&#64;', $linkText);
		$linkText = str_replace('.', '&#46;', $linkText);
		$linkText = str_split($linkText, 5);
		
		$part1 = '<a href="ma';
		$part2 = 'ilto&#58;';
		$part3 = '" '. $attrs .' >';
		$part4 = '</a>';
	
		$encoded = '<script type="text/javascript">';
		$encoded .= "document.write('$part1');";
		$encoded .= "document.write('$part2');";
		foreach($email as $e)
		{
				$encoded .= "document.write('$e');";
		}
		$encoded .= "document.write('$part3');";
		foreach($linkText as $l)
		{
				$encoded .= "document.write('$l');";
		}
		$encoded .= "document.write('$part4');";
		$encoded .= '</script>';
	
		return $encoded;
	}
	
	/**
	 * List directory contents
	 */
	public static function list_files($dir)
	{
		if(is_dir($dir))
	  	{
	  		if($handle = opendir($dir))
	  		{
	  			while(($file = readdir($handle)) !== false)
	  			{
	  				if($file != "." && $file != ".." && $file != "Thumbs.db")
	  				{
	  					echo '<a target="_blank" href="'.$dir.$file.'">'.$file.'</a><br>'."\n";
	  				}
	  			}
	  			closedir($handle);
	  		}
		}
	}
	
	/**
	 * Delete a directory including it's contents.
	 */
	public static function destroyDir($dir, $virtual = false)
	{
		$ds = DIRECTORY_SEPARATOR;
		$dir = $virtual ? realpath($dir) : $dir;
		$dir = substr($dir, -1) == $ds ? substr($dir, 0, -1) : $dir;
		if (is_dir($dir) && $handle = opendir($dir))
		{
			while ($file = readdir($handle))
			{
				if ($file == '.' || $file == '..')
				{
					continue;
				}
				elseif (is_dir($dir.$ds.$file))
				{
					self::destroyDir($dir.$ds.$file);
				}
				else
				{
					unlink($dir.$ds.$file);
				}
			}
			closedir($handle);
			rmdir($dir);
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/**
     * Zip files on the fly.
     *
     * @param	array 	$files
	 * @param	string	$destination
	 * @param	bool	$overwrite
     * @return string
	 * @since   1.1.3
     */
	public static function create_zip($files = array(),$destination = '',$overwrite = false) {
		//if the zip file already exists and overwrite is false, return false
		if(file_exists($destination) && !$overwrite) { return false; }
		//vars
		$valid_files = array();
		//if files were passed in...
		if(is_array($files)) {
			//cycle through each file
			foreach($files as $file) {
				//make sure the file exists
				if(file_exists($file)) {
					$valid_files[] = $file;
				}
			}
		}
		//if we have good files...
		if(count($valid_files)) {
			//create the archive
			$zip = new \ZipArchive();
			if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
				return false;
			}
			//add the files
			foreach($valid_files as $file) {
				$zip->addFile($file,$file);
			}
			//debug
			//error_log('The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status);
			
			//close the zip -- done!
			$zip->close();
			
			//check to make sure the file exists
			return file_exists($destination);
		}
		else
		{
			return false;
		}
	}
	
	/**
     * Unzip a zip file.
     *
     * @param	string	$file			Path to zip file
	 * @param	string	$destination	Destination directory for unzipped files
     * @return	string
	 * @since   1.1.3
     */
	public static function unzip_file($file, $destination){
		// create object
		$zip = new \ZipArchive() ;
		// open archive
		if ($zip->open($file) !== TRUE) {
			die ("Could not open archive");
		}
		// extract contents to destination directory
		$zip->extractTo($destination);
		// close archive
		$zip->close();
		echo 'Archive extracted to directory';
	}
	
	/**
     * Unzip a zip file.
     *
     * @param	string	$filename	Path to the image
	 * @param	string	$tmpname	Temp path to thumbnail
	 * @param	string	$xmax		Max width
	 * @param	string	$ymax		Max height
     * @return	string
	 * @since   1.1.3
     */
	public static function resize_image($filename, $tmpname, $xmax, $ymax)
	{
		$ext = explode(".", $filename);
		$ext = $ext[count($ext)-1];
	
		if($ext == "jpg" || $ext == "jpeg")
			$im = imagecreatefromjpeg($tmpname);
		elseif($ext == "png")
			$im = imagecreatefrompng($tmpname);
		elseif($ext == "gif")
			$im = imagecreatefromgif($tmpname);
		
		$x = imagesx($im);
		$y = imagesy($im);
		
		if($x <= $xmax && $y <= $ymax)
			return $im;
	
		if($x >= $y) {
			$newx = $xmax;
			$newy = $newx * $y / $x;
		}
		else {
			$newy = $ymax;
			$newx = $x / $y * $newy;
		}
		
		$im2 = imagecreatetruecolor($newx, $newy);
		imagecopyresized($im2, $im, 0, 0, 0, 0, floor($newx), floor($newy), $x, $y);
		return $im2; 
	}
	
	/**
	 * Special function for files including
	 *
	 * @param string                $file
	 * @param bool                        $once
	 * @param bool|Closure        $show_errors        If bool error will be processed, if Closure - only Closure will be called
	 *
	 * @return bool
	 */
	public static function _require ($file, $once = false, $show_errors = true)
	{
        if (file_exists($file)) {
                if ($once) {
                        return require_once $file;
                } else {
                        return require $file;
                }
        } elseif (is_bool($show_errors) && $show_errors) {
                $data = debug_backtrace()[0];
                trigger_error("File $file does not exists in $data[file] on line $data[line]", E_USER_ERROR);
        } elseif ($show_errors instanceof \Closure) {
                return (bool)$show_errors();
        }
        return false;
	}
	
	/**
	 * Special function for files including
	 *
	 * @param string                $file
	 * @param bool                        $once
	 * @param bool|Closure        $show_errors        If bool error will be processed, if Closure - only Closure will be called
	 *
	 * @return bool
	 */
	public static function _include ($file, $once = false, $show_errors = true)
	{
        if (file_exists($file)) {
                if ($once) {
                        return include_once $file;
                } else {
                        return include $file;
                }
        } elseif (is_bool($show_errors) && $show_errors) {
                        $data = debug_backtrace()[0];
                        trigger_error("File $file does not exists in $data[file] on line $data[line]", E_USER_WARNING);
        } elseif ($show_errors instanceof \Closure) {
                        return (bool)$show_errors();
        }
        return false;
	}
	
	/**
	 * Special function for files including
	 *
	 * @param string                $file
	 * @param bool|Closure        $show_errors        If bool error will be processed, if Closure - only Closure will be called
	 *
	 * @return bool
	 */
	public static function _require_once ($file, $show_errors = true)
	{
        return self::_require($file, true, $show_errors);
	}
	
	/**
	 * Special function for files including
	 *
	 * @param string                $file
	 * @param bool|Closure        $show_errors        If bool error will be processed, if Closure - only Closure will be called
	 *
	 * @return bool
	 */
	public static function _include_once ($file, $show_errors = true)
	{
        return self::_include($file, true, $show_errors);
	}
	
	public static function implode_array($separator, $data, $element)
	{
		if(!is_array($data)) {
			trigger_error("parameter 2 must be an array", E_USER_ERROR);
		}
		
		$newData = array();
		
		foreach($data as $key => $value) {
			if(!isset($value[$element])) {
				trigger_error("data[$key] has no element '$element'", E_USER_ERROR);
			}
			$newData[] = $value[$element];
		}
		
		return implode($separator, $newData);
	}
	
	/**
	 * Validate username.
	 *
	 * @param string $sUsername
	 * @param integer $iMin Default 4
	 * @param integer $iMax Default 40
	 * @return string (ok, empty, tooshort, toolong, badusername).
	 */
	public static function validate_username($sUsername, $iMin = 4, $iMax = 40) {
	    if(empty($sUsername)) return 'empty';
	    elseif(strlen($sUsername) < $iMin) return 'tooshort';
	    elseif(strlen($sUsername) > $iMax) return 'toolong';
	    elseif(preg_match('/[^\w]+$/', $sUsername)) return 'badusername';
	    else return 'ok';
	}
	
	/**
	 * Validate password.
	 *
	 * @param string $sPassword
	 * @param integer $iMin 6
	 * @param integer $iMax 92
	 * @return string (ok, empty, tooshort, toolong, nonumber, noupper).
	 */
	public static function validate_password($sPassword, $iMin = 6, $iMax = 92) {
	    if(empty($sPassword)) return 'empty';
	    else if(strlen($sPassword) < $iMin) return 'tooshort';
	    else if(strlen($sPassword) > $iMax) return 'toolong';
	    else if(!preg_match('/[0-9]{1,}/', $sPassword)) return 'nonumber';
	    else if(!preg_match('/[A-Z]{1,}/', $sPassword)) return 'noupper';
	    else return 'ok';
	}
	
	/**
	 * Validate email.
	 *
	 * @param string $sEmail
	 * @return string (ok, empty, bademail).
	 */
	public static function validate_email($sEmail) {
	    if($sEmail == '')
	    	return false;
	    if(filter_var($sEmail, FILTER_VALIDATE_EMAIL) == false)
	    	return false;
	    	else return true;
	}
	
	/**
	 * Validate name (first name and last name).
	 *
	 * @param string $sName
	 * @param integer $iMin Default 2
	 * @param integer $iMax Default 30
	 * @return boolean
	 */
	public static function validate_name($sName, $iMin = 2, $iMax = 30) {
	    if(is_string($sName) && strlen($sName) >= $iMin && strlen($sName) <= $iMax)
	        return true;
	    return false;
	}
	
	/**
	 * Check a string identical.
	 *
	 * @param string $sVal1
	 * @param string $sVal2
	 * @return boolean
	 */
	public static function validate_identical($sVal1, $sVal2) {
	    return ($sVal1 === $sVal2);
	}
	
	/**
	 * Get the client IP address.
	 *
	 * @return string
	 */
	public static function client_ip() {
	    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
	    {
	        $sIp = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    }
	    elseif (!empty($_SERVER['HTTP_CLIENT_IP']))
	    {
	        $sIp = $_SERVER['HTTP_CLIENT_IP'];
	    }
	    else
	    {
	        $sIp = $_SERVER['REMOTE_ADDR'];
	    }
	
	    return preg_match('/^[a-z0-9:.]{7,}$/', $sIp) ? $sIp : '0.0.0.0';
	}
	
	/**
	 * Formats date to be stored in MySQL database.
	 */
	public static function formatDate($date) {
		$date = strtotime($date);
		$date = date("Y-m-d", $date);
		 
		return $date;
	}
	
	/**
	 * Get age by birthdate.
	 */
	public static function getAge($birthdate = '0000-00-00') {
	    if ($birthdate == '0000-00-00') return 'Unknown';
	
	    $bits = explode('-', $birthdate);
	    $age = date('Y') - $bits[0] - 1;
	
	    $arr[1] = 'm';
	    $arr[2] = 'd';
	
	    for ($i = 1; $arr[$i]; $i++) {
	        $n = date($arr[$i]);
	        if ($n < $bits[$i])
	            break;
	        if ($n > $bits[$i]) {
	            ++$age;
	            break;
	        }
	    }
	    return $age;
	}
	
}