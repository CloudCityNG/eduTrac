<?php namespace eduTrac\Classes\Libraries;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * FileReader Class
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

 
/*
   Copyright (c) 2003, 2005, 2006, 2009 Danilo Segan <danilo@kvota.net>.

   This file is part of PHP-gettext.

   PHP-gettext is free software; you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation; either version 2 of the License, or
   (at your option) any later version.

   PHP-gettext is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with PHP-gettext; if not, write to the Free Software
   Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

*/

class FileReader {
  public $_pos;
  public $_fd;
  public $_length;

  function FileReader($filename) {
    if (file_exists($filename)) {

      $this->_length=filesize($filename);
      $this->_pos = 0;
      $this->_fd = fopen($filename,'rb');
      if (!$this->_fd) {
        $this->error = 3; // Cannot read file, probably permissions
        return false;
      }
    } else {
      $this->error = 2; // File doesn't exist
      return false;
    }
  }

  function read($bytes) {
    if ($bytes) {
      fseek($this->_fd, $this->_pos);

      // PHP 5.1.1 does not read more than 8192 bytes in one fread()
      // the discussions at PHP Bugs suggest it's the intended behaviour
      $data = '';
      while ($bytes > 0) {
        $chunk  = fread($this->_fd, $bytes);
        $data  .= $chunk;
        $bytes -= strlen($chunk);
      }
      $this->_pos = ftell($this->_fd);

      return $data;
    } else return '';
  }

  function seekto($pos) {
    fseek($this->_fd, $pos);
    $this->_pos = ftell($this->_fd);
    return $this->_pos;
  }

  function currentpos() {
    return $this->_pos;
  }

  function length() {
    return $this->_length;
  }

  function close() {
    fclose($this->_fd);
  }

}