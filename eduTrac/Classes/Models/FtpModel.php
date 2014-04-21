<?php namespace eduTrac\Classes\Models;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * FTP Model
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
 * @since       4.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

use \eduTrac\Classes\Libraries\elFinder\elFinderConnector;
use \eduTrac\Classes\Libraries\elFinder\elFinder;
use \eduTrac\Classes\Libraries\elFinder\elFinderVolumeDriver;
use \eduTrac\Classes\Libraries\elFinder\elFinderVolumeLocalFileSystem;
class FtpModel {

	public function __construct() {}
	
	public function connector() {
		$opts = array(
			// 'debug' => true,
			'roots' => array(
				array(
					'driver'        => 'LocalFileSystem', 
					'path'          => BASE_PATH . 'eduTrac/Application/FTP/Files/',
					'URL'           => BASE_URL . 'eduTrac/Application/FTP/Files/',
					'alias'			=> 'Files',
					'mimeDetect' 	=> 'internal',
					'mimefile'      => BASE_PATH . 'eduTrac/Classes/Libraries/elFinder/mime.types',
				    'uploadDeny'    => array('application/x-php'),
				    'uploadOrder'   => array('deny', 'allow'),
					'accessControl' => 'access'
				),
				array (
				    'driver' 		=> 'LocalFileSystem',
				    'path' 			=> BASE_PATH . 'eduTrac/Application/FTP/Media/',
				    'URL'           => BASE_URL . 'eduTrac/Application/FTP/Media/',
				    'alias' 		=> 'Media',
				    'mimeDetect' 	=> 'internal',
				    'mimefile'      => BASE_PATH . 'eduTrac/Classes/Libraries/elFinder/mime.types',
				    'uploadDeny'    => array('application/x-php'),
				    'uploadOrder'   => array('deny', 'allow'),
				    'accessControl' => 'access'  
				)
			)
		);
		
		// run elFinder
		$connector = new elFinderConnector(new elFinder($opts));
		$connector->run();
	}

}