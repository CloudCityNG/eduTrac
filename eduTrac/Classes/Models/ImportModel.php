<?php namespace eduTrac\Classes\Models;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Importer Model
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

use \eduTrac\Classes\Core\DB;
use \eduTrac\Classes\Libraries\Log;
class ImportModel {
	
	private $_csv;
	
	public function __construct() {
        $this->_log = new Log;
	}
    
    public function runQuickImport($data) {
        if($data['type'] == 'text/csv' && $data['size'] > 0) {
            $this->_csv = new \eduTrac\Classes\Libraries\CSVimporter($data['name'],$data['temp']);
            if($this->_csv->queryInto($data['table'])) {
                redirect( BASE_URL . 'success/save_data/' );
            } else {
                redirect( BASE_URL . 'error/save_data/' );
            }
        } else {
            redirect( BASE_URL . 'error/import/' );
        }
    }
	
	public function __destruct() {
		DB::inst()->close();
	}
	
}