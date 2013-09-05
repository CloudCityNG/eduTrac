<?php namespace tinyPHP\Classes\Libraries;
/**
 *
 * StreamReader Class
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

if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');

class StringReader {
  public $_pos;
  public $_str;

  function StringReader($str='') {
    $this->_str = $str;
    $this->_pos = 0;
  }

  function read($bytes) {
    $data = substr($this->_str, $this->_pos, $bytes);
    $this->_pos += $bytes;
    if (strlen($this->_str)<$this->_pos)
      $this->_pos = strlen($this->_str);

    return $data;
  }

  function seekto($pos) {
    $this->_pos = $pos;
    if (strlen($this->_str)<$this->_pos)
      $this->_pos = strlen($this->_str);
    return $this->_pos;
  }

  function currentpos() {
    return $this->_pos;
  }

  function length() {
    return strlen($this->_str);
  }

}