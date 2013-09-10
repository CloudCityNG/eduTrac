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
 * @since       1.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

class Reservation extends \eduTrac\Classes\Core\Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $this->view->staticTitle = array('Reservation Settings');
        $this->view->css = array( 
                                'theme/scripts/plugins/forms/select2/select2.css',
                                'theme/scripts/plugins/forms/multiselect/css/multi-select.css',
                                'theme/scripts/plugins/forms/bootstrap-timepicker/css/bootstrap-timepicker.min.css'
                                );
        $this->view->js = array( 
                                'theme/scripts/plugins/forms/select2/select2.js',
                                'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
                                'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
                                'theme/scripts/plugins/forms/bootstrap-timepicker/js/bootstrap-timepicker.min.js',
                                'theme/scripts/demo/form_elements.js'
                                );
        $this->view->render('reservation/index');
    }
    
    public function category() {
        $this->view->staticTitle = array('Reservation Categories');
        $this->view->css = array( 
                                'theme/scripts/plugins/forms/select2/select2.css',
                                'theme/scripts/plugins/forms/multiselect/css/multi-select.css',
                                'theme/scripts/plugins/forms/bootstrap-timepicker/css/bootstrap-timepicker.min.css',
                                'theme/scripts/plugins/tables/DataTables/media/css/DT_bootstrap.css',
    							'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/css/TableTools.css',
								'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/css/ColVis.css',
                                );
        $this->view->js = array( 
                                'theme/scripts/plugins/tables/DataTables/media/js/jquery.dataTables.min.js',
    							'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/js/TableTools.min.js',
								'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/js/ColVis.min.js',
								'theme/scripts/plugins/tables/DataTables/media/js/DT_bootstrap.js',
								'theme/scripts/demo/tables.js',
                                'theme/scripts/plugins/forms/select2/select2.js',
                                'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
                                'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
                                'theme/scripts/plugins/forms/bootstrap-timepicker/js/bootstrap-timepicker.min.js',
                                'theme/scripts/plugins/forms/jscolor/jscolor.js',
                                'theme/scripts/demo/form_elements.js'
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