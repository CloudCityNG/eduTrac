<?php if ( ! defined('BASE_PATH')) exit('No direct script access allowed');
/**
 * AutoLoad
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

if(file_exists(SYS_PATH . 'Config/.installer.lock')) {
    require(SYS_PATH . 'Config/constants.php');
}

/**
 * Autoloader for classes.
 */
require( SYS_PATH . DS . 'Classes' . DS . 'Autoloader.php');
$loader = new \eduTrac\Classes\Autoloader('eduTrac\Classes',BASE_PATH);
$loader->register();

/**
 * Helper configuration to load default and custom
 * helper functions.
 */
\eduTrac\Classes\Libraries\Util::_require( SYS_PATH . 'Config/helper.php' );

/** 
 * Errors are written to a log file as 
 * well as the database.
 */
error_reporting(E_ALL & ~E_NOTICE );
ini_set('display_errors','Off');
ini_set('log_errors', 'On');
ini_set('error_log', BASE_PATH . 'tmp' . DS . 'logs' . DS . 'error.' . date('m-d-Y') . '.txt');
set_error_handler('logError',E_ALL & ~E_NOTICE);


/** Internationalization settings */
$locale = (isset($_GET['lang']))? $_GET['lang'] : DEFAULT_LOCALE;
putenv('LC_MESSAGES='.$locale);

/* gettext setup */
T_setlocale(LC_MESSAGES, $locale);

/** Set the text domain as 'eduTrac' */
$domain = 'eduTrac';
T_bindtextdomain($domain, LOCALE_DIR);

/** bind_textdomain_codeset is supported only in PHP 4.2.0+ */
T_bind_textdomain_codeset($domain, ENCODING);
T_textdomain($domain);