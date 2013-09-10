<?php if ( ! defined('BASE_PATH')) exit('No direct script access allowed');
/**
 *
 * Constants
 *  
 * PHP 5
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
 * @since eduTrac(tm) v 1.0
 * @license GNU General Public License v3 (http://www.gnu.org/licenses/gpl-3.0.html)
 */

    use \eduTrac\Classes\Libraries\Hooks;
    
    function acad_select_function($levelKey = NULL) {
        $select = 
            '<select style="width:100%;" name="acadLevelKey" id="select2_18" required>
                <option value="">&nbsp;</option>
                <option value="GR"'.selected( $levelKey, 'GR', false ).'>Graduate</option>
                <option value="Non"'.selected( $levelKey, 'UG', false ).'>Non Degree</option>
            </select>';
        return $select;
    }
    //Hooks::add_filter('acad_level','acad_select_function',10,1);