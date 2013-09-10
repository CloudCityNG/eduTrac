<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Fire Cron View
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

$cron = new \eduTrac\Classes\Libraries\Cron;
$cron->schedule();
if ( isset($_GET['image']) ) {
    header("Content-Type: image/gif");
    header("Content-Length: 49");
    echo pack('H*', '47494638396101000100910000000000ffffffffffff00000021f90405140002002c00000000010001000002025401003b');
}