<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * NSLC Downloader View
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

use \eduTrac\Classes\Libraries\Hooks;

$download_path = HOLD_FILE_LOC;
$file = $_GET['f'];

$args = array(
		'download_path'		=>	$download_path,
		'file'				=>	$file,		
		'extension_check'	=>	FALSE,
		'referrer_check'	=>	TRUE,
		'referrer'			=>	BASE_URL,
		);
		
$dl = new \eduTrac\Classes\Libraries\Downloader($args);

/*
|-----------------
| Pre Download Hook
|------------------
*/

$download_hook = $dl->get_download_hook();

/*
|-----------------
| Download
|------------------
*/

if( $download_hook['download'] == TRUE ) {

	/* You can write your logic before proceeding to download */
	
	/* Let's download file */
	$dl->get_download();

}