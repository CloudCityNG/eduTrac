<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Room Reservation Settings View
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

use \eduTrac\Classes\Libraries\Hooks;
?>

<ul class="breadcrumb">
	<li><?=_t( 'You are here' );?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
	<li class="divider"></li>
	<li><?=_t( 'Room Reservation Settings' );?></li>
</ul>

<h3><?=_t( 'Room Reservation Settings' );?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>reservation/runSetting/" id="validateSubmitForm" method="post" autocomplete="off">
		
		<!-- Widget -->
		<div class="widget widget-heading-simple widget-body-gray">
		
			<!-- Widget heading -->
			<div class="widget-head">
				<h4 class="heading"><font color="red">*</font> <?=_t( 'Indicates field is required' );?></h4>
			</div>
			<!-- // Widget heading END -->
			
			<div class="widget-body">
			
				<!-- Row -->
				<div class="row-fluid">
					<!-- Column -->
					<div class="span6">
						
						<!-- Group -->
    					<div class="control-group">
							<label class="control-label"><font color="red">*</font> <?=_t( 'Hour Display' );?></label>
							<div class="controls">
								<select style="width:25%" name="hour_display" id="select2_9" required>
                            		<option value="12"<?=selected( Hooks::get_option( 'hour_display' ), '12', false ); ?>><?=_t( "12 Hour Display" );?></option>
                            		<option value="24"<?=selected( Hooks::get_option( 'hour_display' ), '24', false ); ?>><?=_t( "24 Hour Display" );?></option>
                            	</select>
                                <a href="#myModalHD" data-toggle="modal"><img src="<?=BASE_URL;?>static/common/theme/images/help.png" /></a>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><font color="red">*</font> <?=_t( 'Query Size' );?></label>
							<div class="controls">
								<input type="text" name="limit_query_size" value="<?=_h(Hooks::get_option('limit_query_size'));?>" class="span4" required />
                                <a href="#myModalQS" data-toggle="modal"><img src="<?=BASE_URL;?>static/common/theme/images/help.png" /></a>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><font color="red">*</font> <?=_t( 'Week Start' );?></label>
							<div class="controls">
								<select style="width:25%" name="week_start" id="select2_10" required>
                            		<option value="1"<?=selected( Hooks::get_option( 'week_start' ), '1', false ); ?>><?=_t( "Monday" );?></option>
                            		<option value="0"<?=selected( Hooks::get_option( 'week_start' ), '0', false ); ?>><?=_t( "Sunday" );?></option>
                            	</select>
                                <a href="#myModalWS" data-toggle="modal"><img src="<?=BASE_URL;?>static/common/theme/images/help.png" /></a>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?=_t( 'Start Time' );?></label>
                            <div class="controls">
                                <div class="input-append bootstrap-timepicker">
    						        <input id="timepicker1" type="text" name="startTime" class="input-small" value="<?=_h(Hooks::get_option('startTime'));?>" required/><span class="add-on"><i class="icon-time"></i></span>
						        </div>
                                <a href="#myModalST" data-toggle="modal"><img src="<?=BASE_URL;?>static/common/theme/images/help.png" /></a>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?=_t( 'End Time' );?></label>
                            <div class="controls">
                                <div class="input-append bootstrap-timepicker">
        					        <input id="timepicker2" type="text" name="endTime" class="input-small" value="<?=_h(Hooks::get_option('endTime'));?>" required/><span class="add-on"><i class="icon-time"></i></span>
						        </div>
                                <a href="#myModalET" data-toggle="modal"><img src="<?=BASE_URL;?>static/common/theme/images/help.png" /></a>
                            </div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="span6">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?=_t( 'Bullets' );?></label>
                            <div class="controls">
                                <select style="width:25%"  name="bullets_display" id="select2_11" required>
                                    <option value="1"<?=selected( Hooks::get_option( 'bullets_display' ), '1', false ); ?>><?=_t( "Yes" );?></option>
                                    <option value="0"<?=selected( Hooks::get_option( 'bullets_display' ), '0', false ); ?>><?=_t( "No" );?></option>
                                </select>
                                <a href="#myModalBULL" data-toggle="modal"><img src="<?=BASE_URL;?>static/common/theme/images/help.png" /></a>
                            </div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?=_t( 'Enable Email' );?></label>
                            <div class="controls">
                                <select style="width:25%"  name="enable_reserve_email" id="select2_12" required>
                                    <option value="1"<?=selected( Hooks::get_option( 'enable_reserve_email' ), '1', false ); ?>><?=_t( "Yes" );?></option>
                                    <option value="0"<?=selected( Hooks::get_option( 'enable_reserve_email' ), '0', false ); ?>><?=_t( "No" );?></option>
                                </select>
                                <a href="#myModalEE" data-toggle="modal"><img src="<?=BASE_URL;?>static/common/theme/images/help.png" /></a>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?=_t( 'Email From' );?></label>
                            <div class="controls">
                                <input type="email" name="reserve_from_email" value="<?=_h(Hooks::get_option('reserve_from_email'));?>" class="span4" required /> 
                                <a href="#myModalFE" data-toggle="modal"><img src="<?=BASE_URL;?>static/common/theme/images/help.png" /></a>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?=_t( 'Reply To Email' );?></label>
                            <div class="controls">
                                <input type="email" name="reserve_reply_email" value="<?=_h(Hooks::get_option('reserve_reply_email'));?>" class="span4" /> 
                                <a href="#myModalRE" data-toggle="modal"><img src="<?=BASE_URL;?>static/common/theme/images/help.png" /></a>
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
					<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=_t( 'Save' );?></button>
				</div>
				<!-- // Form actions END -->
				
			</div>
		</div>
		<!-- // Widget END -->
		
	</form>
	<!-- // Form END -->
	
	<div class="modal hide fade" id="myModalHD">
        <div class="modal-body">
            <?=file_get_contents( APP_PATH . 'Info/reserve-hour.txt' );?>
        </div>
        <div class="modal-footer">
            <a href="#" data-dismiss="modal" class="btn btn-primary"><?=_t( 'Cancel' );?></a>
        </div>
    </div>
    
    <div class="modal hide fade" id="myModalQS">
        <div class="modal-body">
            <?=file_get_contents( APP_PATH . 'Info/reserve-query.txt' );?>
        </div>
        <div class="modal-footer">
            <a href="#" data-dismiss="modal" class="btn btn-primary"><?=_t( 'Cancel' );?></a>
        </div>
    </div>
    
    <div class="modal hide fade" id="myModalWS">
        <div class="modal-body">
            <?=file_get_contents( APP_PATH . 'Info/reserve-week.txt' );?>
        </div>
        <div class="modal-footer">
            <a href="#" data-dismiss="modal" class="btn btn-primary"><?=_t( 'Cancel' );?></a>
        </div>
    </div>
    
    <div class="modal hide fade" id="myModalST">
        <div class="modal-body">
            <?=file_get_contents( APP_PATH . 'Info/reserve-stime.txt' );?>
        </div>
        <div class="modal-footer">
            <a href="#" data-dismiss="modal" class="btn btn-primary"><?=_t( 'Cancel' );?></a>
        </div>
    </div>
    
    <div class="modal hide fade" id="myModalET">
        <div class="modal-body">
            <?=file_get_contents( APP_PATH . 'Info/reserve-etime.txt' );?>
        </div>
        <div class="modal-footer">
            <a href="#" data-dismiss="modal" class="btn btn-primary"><?=_t( 'Cancel' );?></a>
        </div>
    </div>
    
    <div class="modal hide fade" id="myModalBULL">
        <div class="modal-body">
            <?=file_get_contents( APP_PATH . 'Info/reserve-bullet.txt' );?>
        </div>
        <div class="modal-footer">
            <a href="#" data-dismiss="modal" class="btn btn-primary"><?=_t( 'Cancel' );?></a>
        </div>
    </div>
    
    <div class="modal hide fade" id="myModalEE">
        <div class="modal-body">
            <?=file_get_contents( APP_PATH . 'Info/reserve-email.txt' );?>
        </div>
        <div class="modal-footer">
            <a href="#" data-dismiss="modal" class="btn btn-primary"><?=_t( 'Cancel' );?></a>
        </div>
    </div>
    
    <div class="modal hide fade" id="myModalFE">
        <div class="modal-body">
            <?=file_get_contents( APP_PATH . 'Info/reserve-femail.txt' );?>
        </div>
        <div class="modal-footer">
            <a href="#" data-dismiss="modal" class="btn btn-primary"><?=_t( 'Cancel' );?></a>
        </div>
    </div>
    
    <div class="modal hide fade" id="myModalRE">
        <div class="modal-body">
            <?=file_get_contents( APP_PATH . 'Info/reserve-remail.txt' );?>
        </div>
        <div class="modal-footer">
            <a href="#" data-dismiss="modal" class="btn btn-primary"><?=_t( 'Cancel' );?></a>
        </div>
    </div>
	
</div>	
		
		</div>
		<!-- // Content END -->