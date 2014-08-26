<?php
/**
 * Main Site's root
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

defined( 'DS' )					or define( 'DS', DIRECTORY_SEPARATOR );
defined( 'BASE_PATH' )			or define( 'BASE_PATH', __DIR__ . DS );
defined( 'APP_FOLDER' )			or define( 'APP_FOLDER', 'Application' );
defined( 'SYS_PATH' )			or define( 'SYS_PATH', BASE_PATH . 'eduTrac' . DS );
defined( 'APP_PATH' )			or define( 'APP_PATH', SYS_PATH . APP_FOLDER . DS );
defined( 'HOLD_FILE_LOC' )		or define( 'HOLD_FILE_LOC', APP_PATH . '_HOLD_' . DS );
defined( 'LOCALE_DIR' ) 		or define( 'LOCALE_DIR', SYS_PATH . 'Locale' );
defined( 'PLUGINS_DIR' )		or define( 'PLUGINS_DIR', APP_PATH . 'Plugins' . DS );
defined( 'DROPINS_DIR' )        or define( 'DROPINS_DIR', APP_PATH . 'DropIns' . DS );
defined( 'ENCODING' )			or define( 'ENCODING', 'UTF-8' );
defined( 'CURRENT_VERSION' )	or define( 'CURRENT_VERSION', '4.2.3' );
require( SYS_PATH . 'application.php' );
$cookieDomain = new \eduTrac\Classes\Libraries\Cookies;
defined( 'COOKIE_EXPIRE' )      or define( 'COOKIE_EXPIRE', time()+\eduTrac\Classes\Libraries\Hooks::get_option('cookieexpire') );
defined( 'COOKIE_PATH' )        or define( 'COOKIE_PATH', \eduTrac\Classes\Libraries\Hooks::get_option('cookiepath') );
defined( 'COOKIE_DOMAIN' )      or define( 'COOKIE_DOMAIN', $cookieDomain->cookieDomain() );
defined( 'DEFAULT_LOCALE' )     or define( 'DEFAULT_LOCALE', '' );
benchmark_init();

foreach (glob(DROPINS_DIR . '*.php') as $file) { 
    if(file_exists($file))
        \eduTrac\Classes\Libraries\Util::_include($file);
}

$app = new \eduTrac\Classes\Core\Bootstrap();