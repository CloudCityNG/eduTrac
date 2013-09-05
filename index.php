<?php
/**
 *
 * Site Root
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

    define('INST_RUNSCRIPT', pathinfo(__FILE__, PATHINFO_BASENAME));
    define('INST_BASEDIR',   str_replace(INST_RUNSCRIPT, '', __FILE__));
    define('INST_RUNFOLDER', 'installer/');
    define('INST_RUNINSTALL', 'installer.php');
    if (!file_exists('tinyPHP/Config/constants.php') && is_dir(INST_BASEDIR.INST_RUNFOLDER) && 
    is_readable(INST_BASEDIR.INST_RUNFOLDER.INST_RUNINSTALL))
    require(INST_BASEDIR.INST_RUNFOLDER.INST_RUNINSTALL);

defined( 'DS' )					or define( 'DS', DIRECTORY_SEPARATOR );
defined( 'BASE_PATH' )			or define( 'BASE_PATH', __DIR__ . DS );
defined( 'APP_FOLDER' )			or define( 'APP_FOLDER', 'Application' );
defined( 'SYS_PATH' )			or define( 'SYS_PATH', BASE_PATH . 'tinyPHP' . DS );
defined( 'APP_PATH' )			or define( 'APP_PATH', SYS_PATH . APP_FOLDER . DS );
defined( 'LOCALE_DIR' ) 		or define( 'LOCALE_DIR', SYS_PATH . 'Locale' );
defined( 'DROPINS' )            or define( 'DROPINS', APP_PATH.'DropIns/' );
defined( 'DEFAULT_LOCALE' )		or define( 'DEFAULT_LOCALE', '' );
defined( 'ENCODING' )			or define( 'ENCODING', 'UTF-8' );
defined( 'CURRENT_VERSION' )	or define( 'CURRENT_VERSION', '0.8' );
defined( 'CURRENT_EG_VERSION' )	or define( 'CURRENT_EG_VERSION', '1.0.0-ALPHA1' );
require( SYS_PATH . 'Config/constants.php');
require( SYS_PATH . 'application.php');
include( "init.php" );

foreach (glob(DROPINS .'*.php') as $file) { 
    if(file_exists($file))
        include($file);
}

$app = new \tinyPHP\Classes\Core\Bootstrap();