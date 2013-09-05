<?php
/**
 *
 * eduTrac API Main File
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

/**
 * These are already defined, so please do not edit these. 
 * They are only here to suppress errors that may occur with 
 * including the main constants.php file.
 */
defined( 'DS' )                 or define( 'DS', '' );
defined( 'BASE_PATH' )          or define( 'BASE_PATH', '' );
defined( 'APP_FOLDER' )         or define( 'APP_FOLDER', '' );
defined( 'SYS_PATH' )           or define( 'SYS_PATH', '' );
defined( 'APP_PATH' )           or define( 'APP_PATH', '' );
defined( 'LOCALE_DIR' )         or define( 'LOCALE_DIR', '' );
defined( 'DROPINS' )            or define( 'DROPINS', '' );
defined( 'DEFAULT_LOCALE' )     or define( 'DEFAULT_LOCALE', '' );
defined( 'ENCODING' )           or define( 'ENCODING', '' );
defined( 'CURRENT_VERSION' )    or define( 'CURRENT_VERSION', '' );
defined( 'CURRENT_EG_VERSION' ) or define( 'CURRENT_EG_VERSION', '' );

include dirname( __FILE__ ) . '/includes/compatibility.php';
include dirname( __FILE__ ) . '/includes/functions.php';
include dirname( __FILE__ ) . '/includes/class.db-api.php';
include dirname( __FILE__ ) . '/config.php';

if (!isset($_GET['auth_token']) || ($_GET['auth_token'] != AUTH_TOKEN)) {
   die('Authentication is required to access the API.');
}

$query = $db_api->parse_query();
$db_api->set_db( $query['db'] );
$results = $db_api->query( $query );

$renderer = 'render_' . $query['format'];
$db_api->$renderer( $results, $query );
