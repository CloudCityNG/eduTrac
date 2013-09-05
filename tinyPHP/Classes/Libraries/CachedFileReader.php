<?php namespace tinyPHP\Classes\Libraries;
/**
 *
 * CachedFileReader
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

// Preloads entire file in memory first, then creates a StringReader
// over it (it assumes knowledge of StringReader internals)

if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');

class CachedFileReader extends StringReader {
  function CachedFileReader($filename) {
    if (file_exists($filename)) {

      $length=filesize($filename);
      $fd = fopen($filename,'rb');

      if (!$fd) {
        $this->error = 3; // Cannot read file, probably permissions
        return false;
      }
      $this->_str = fread($fd, $length);
      fclose($fd);

    } else {
      $this->error = 2; // File doesn't exist
      return false;
    }
  }
}