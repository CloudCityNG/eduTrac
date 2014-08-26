<?php namespace eduTrac\Classes\Controllers;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Room Reservation Controller
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

class Reservation extends \eduTrac\Classes\Core\Controller {
    
    public function __construct() {
        parent::__construct();
		/**
		 * If user is logged in and the lockscreen cookie is set, 
		 * redirect user to the lock screen until he/she enters 
		 * his/her password to gain access.
		 */
		if(isset($_COOKIE['SCREENLOCK'])) {
			redirect( BASE_URL . 'lock/' );
		}
    }
    
    public function index() {
        $this->view->staticTitle = array(_t('Reservation Settings'));
        $this->view->render('reservation/index');
    }
    
    public function category() {
        $this->view->staticTitle = array(_t('Reservation Categories'));
        $this->view->js = array( 
                                'plugins/datable/jquery.dataTables.min.js',
                                'plugins/datable/dataTables.bootstrap.js',
                                'plugins/datable/extras/TableTools/media/js/TableTools.min.js',
                                'js/custom.js'
                                );
        $this->view->catList = $this->model->catList();
        $this->view->render('reservation/category');
    }
    
    public function runSetting() {
        $options = array( 'hour_display','limit_query_size','week_start','startTime','endTime','bullets_display',
                          'enable_reserve_email','reserve_from_email','reserve_reply_email');
        $this->model->runSetting($options);
    }
    
    public function runCategory() {
        $data = array();
        $data['catName'] = isPostSet('catName');
        $data['fgcolor'] = isPostSet('fgcolor');
        $data['bgcolor'] = isPostSet('bgcolor');
        $this->model->runCategory($data);
    }
    
}