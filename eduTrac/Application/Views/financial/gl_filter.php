<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * General Ledger Filter View
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
 * @since       1.1.5
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */
?>

<ul class="breadcrumb">
    <li><?php _e( _t( 'You are here' ) ); ?></li>
    <li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
    <li class="divider"></li>
    <li><?php _e( _t( 'Search General Ledger' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Search General Ledger' ) ); ?></h3>
<div class="innerLR">

    <!-- Form -->
    <form class="form-horizontal margin-none" action="<?=BASE_URL;?>financial/gl_summary/" id="validateSubmitForm" target="_blank" method="get" autocomplete="off">
        
        <!-- Widget -->
        <div class="widget widget-heading-simple widget-body-gray">
        
            <!-- Widget heading -->
            <div class="widget-head">
                <h4 class="heading"><?=_t( 'Select statement period' );?></h4>
            </div>
            <!-- // Widget heading END -->
            
            <div class="widget-body">
            
                <!-- Row -->
                <div class="row-fluid">
                    <!-- Column -->
                    <div class="span6">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'From' ) ); ?></label>
                            <div class="controls">
                                <div class="input-append date" id="datetimepicker6">
						    		<input id="from" name="from" type="text" value="<?=date('Y-m-d',strtotime("-3 Months"));?>" required />
				    				<span class="add-on"><i class="icon-th"></i></span>
								</div>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
                    
                    <!-- Column -->
                    <div class="span6">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'To' ) ); ?></label>
                            <div class="controls">
                                <div class="input-append date" id="datetimepicker7">
						    		<input id="to" name="to" type="text" value="<?=date('Y-m-d');?>" required />
				    				<span class="add-on"><i class="icon-th"></i></span>
								</div>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
                    
                </div>
                <!-- // Row END -->
                
                <hr class="separator" />
                
                <!-- Form actions -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Submit' ) ); ?></button>
                </div>
                <!-- // Form actions END -->
                
            </div>
        </div>
        <!-- // Widget END -->
        
    </form>
    <!-- // Form END -->
    
</div>  
        
        </div>
        <!-- // Content END -->