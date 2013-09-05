<?php if ( ! defined('BASE_PATH')) exit('No direct script access allowed');
/**
 *
 * Constants
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

// Initial Installation Info!
$system = array();
$system['title'] = '{product}';
$system['company'] = '{company}';
$system['version'] = '{version}';
$system['installed'] = '{datenow}';

/* Set this to false in a production environment */
defined( 'DEVELOPMENT_ENVIRONMENT' )    or define( 'DEVELOPMENT_ENVIRONMENT', FALSE );

defined( 'DSN_PREFIX' )                 or define( 'DSN_PREFIX', 'mysql' );
defined( 'DB_HOST' )                    or define( 'DB_HOST', '{hostname}' );
defined( 'DB_NAME' )                    or define( 'DB_NAME', '{database}' );
defined( 'DB_USER' )                    or define( 'DB_USER', '{username}' );
defined( 'DB_PASS' )                    or define( 'DB_PASS', '{password}' );
defined( 'TP' )                         or define( 'TP' , 'et_' ); // defines the table prefix

/* Always provide a TRAILING SLASH (/) AFTER A PATH */
defined( 'BASE_URL' )                   or define( 'BASE_URL', '{siteurl}' );
defined( 'SITE_TITLE' )                 or define( 'SITE_TITLE', '{sitetitle}' );
defined( 'PLUGINS_DIR' )                or define( 'PLUGINS_DIR', APP_PATH.'Plugins/' );
defined( 'AUTH_TOKEN' )                 or define( 'AUTH_TOKEN', '' );
define ('MAX_WORKERS',      15);
define ('MAX_IDLE',         180);
define ('SLEEP_INTERVAL',   10);
define ('FS_LOG',           BASE_PATH . 'tmp' . DS . 'logs' . DS . 'cron.' . date('m-d-Y') . '.log');
define ('FS_KILL',          BASE_PATH . 'tmp' . DS . 'logs' . DS . 'kill/daemon');