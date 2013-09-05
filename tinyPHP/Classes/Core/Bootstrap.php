<?php namespace tinyPHP\Classes\Core;
/**
 *
 * Bootstrap
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

if ( ! defined('BASE_PATH')) exit('No direct script access allowed');

class Bootstrap {

	public function __construct() {

		$url = isset($_GET['url']) ? $_GET['url'] : null;
		$url = rtrim($url, '/');
		$url = filter_var($url, FILTER_SANITIZE_URL);
		$url = explode('/', $url);
		
		if (empty($url[0])) {
			$controller = new \tinyPHP\Classes\Controllers\Index();
			$controller->index();
			return false;
		}

		$file = SYS_PATH . 'Classes' . DS . 'Controllers' . DS . ucfirst($url[0]) . '.php';
		if (file_exists($file)) {
			require $file;
		} else {
			$this->error();
		}
		
		$loadController = "\\tinyPHP\\Classes\\Controllers\\".$url[0];
		$name = $url[0];
		$controller = new $loadController;
		$controller->loadModel($name);
		
		$length = count($url);
        
        // Make sure the method we are calling exists
        if ($length > 1) {
            if (!method_exists($controller, $url[1])) {
                $this->error();
            }
        }
        
        // Determine what to load
        switch ($length) {
            case 5:
                $controller->{$url[1]}($url[2], $url[3], $url[4]);
                break;
            
            case 4:
                $controller->{$url[1]}($url[2], $url[3]);
                break;
            
            case 3:
                $controller->{$url[1]}($url[2]);
                break;
            
            case 2:
                $controller->{$url[1]}();
                break;
            
            default:
                $controller->index();
                break;
        }	
	}
	
	public function error() {
		$controller = new \tinyPHP\Classes\Controllers\Error();
		$controller->index();
		return false;
	}

}