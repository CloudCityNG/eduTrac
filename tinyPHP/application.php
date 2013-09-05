<?php if ( ! defined('BASE_PATH')) exit('No direct script access allowed');
/**
 *
 * AutoLoad
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
 * Autoloader for classes.
 */
require( SYS_PATH . DS . 'Classes' . DS . 'Autoloader.php');
$loader = new \tinyPHP\Classes\Autoloader('tinyPHP\Classes',BASE_PATH);
$loader->register();

/**
 * Helper configuration to load default and custom
 * helper functions.
 */
require( SYS_PATH . 'Config/helper.php' );

/** 
 * Checks if the environment is set to development. If so,
 * then error will be displayed in the browser. If not, then
 * they will be written to the database.
 */
if (DEVELOPMENT_ENVIRONMENT == TRUE) {
	error_reporting(E_ALL);
	ini_set('display_errors','On');
} else {
	error_reporting(E_ALL);
	ini_set('display_errors','Off');
	ini_set('log_errors', 'On');
	ini_set('error_log', BASE_PATH . 'tmp' . DS . 'logs' . DS . 'error.' . date('m-d-Y') . '.txt');
    set_error_handler('logError',E_ALL);
}


/** Internationalization settings */
$locale = (isset($_GET['lang']))? $_GET['lang'] : DEFAULT_LOCALE;

/* gettext setup */
T_setlocale(LC_MESSAGES, $locale);

/** Set the text domain as 'tinyPHP' */
$domain = 'tinyPHP';
bindtextdomain($domain, LOCALE_DIR);

/** bind_textdomain_codeset is supported only in PHP 4.2.0+ */
if (function_exists('bind_textdomain_codeset')) 
  bind_textdomain_codeset($domain, ENCODING);
textdomain($domain);