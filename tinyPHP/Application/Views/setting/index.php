<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * System Settings View
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

use \tinyPHP\Classes\Libraries\Hooks;
?>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'System Settings' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'System Settings' ) ); ?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>setting/runSetting/" id="validateSubmitForm" method="post" autocomplete="off">
		
		<!-- Widget -->
		<div class="widget widget-heading-simple widget-body-gray">
		
			<!-- Widget heading -->
			<div class="widget-head">
				<h4 class="heading"><font color="red">*</font> <?php _e( _t( 'Indicates field is required' ) ); ?></h4>
			</div>
			<!-- // Widget heading END -->
			
			<div class="widget-body">
			
				<!-- Row -->
				<div class="row-fluid">
					<!-- Column -->
					<div class="span6">
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><font color="red">*</font> <?php _e( _t( 'Site Title' ) ); ?></label>
							<div class="controls">
								<input type="text" name="site_title" value="<?=_h(Hooks::get_option('site_title'));?>" class="span10" required />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><font color="red">*</font> <?php _e( _t( 'System Email' ) ); ?></label>
							<div class="controls">
								<input type="text" name="system_email" value="<?=_h(Hooks::get_option('system_email'));?>" class="span10" required />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><?php _e( _t( 'Enable SSL' ) ); ?></label>
							<div class="controls">
								<select style="width:25%" name="enable_ssl" id="select2_9">
                            		<option value="1"<?=selected( Hooks::get_option( 'enable_ssl' ), '1', false ); ?>><?php _e( _t( "Yes" ) ); ?></option>
                            		<option value="0"<?=selected( Hooks::get_option( 'enable_ssl' ), '0', false ); ?>><?php _e( _t( "No" ) ); ?></option>
                            	</select>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Hold File Location' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="hold_file_loc" value="<?=_h(Hooks::get_option('hold_file_loc'));?>" class="span10" /> 
                                <a href="#myModal" data-toggle="modal"><img src="<?=BASE_URL;?>static/common/theme/images/help.png" /></a>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Maintenance Mode' ) ); ?></label>
                            <div class="controls">
                                <select style="width:25%"  name="maintenance_mode" id="select2_10">
                                    <option value="1"<?=selected( Hooks::get_option( 'maintenance_mode' ), '1', false ); ?>><?php _e( _t( "Yes" ) );?></option>
                                    <option value="0"<?=selected( Hooks::get_option( 'maintenance_mode' ), '0', false ); ?>><?php _e( _t( "No" ) ); ?></option>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="span6">
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Enable Benchmark' ) ); ?></label>
                            <div class="controls">
                                <select style="width:25%"  name="enable_benchmark" id="select2_11">
                                    <option value="1"<?=selected( Hooks::get_option( 'enable_benchmark' ), '1', false ); ?>><?php _e( _t( "Yes" ) );?></option>
                                    <option value="0"<?=selected( Hooks::get_option( 'enable_benchmark' ), '0', false ); ?>><?php _e( _t( "No" ) ); ?></option>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Enable Cron Log' ) ); ?></label>
                            <div class="controls">
                                <select style="width:25%" name="enable_cron_log" id="select2_12">
                                    <option value="1"<?=selected( Hooks::get_option( 'enable_cron_log' ), '1', false ); ?>><?php _e( _t( "Yes" ) );?></option>
                                    <option value="0"<?=selected( Hooks::get_option( 'enable_cron_log' ), '0', false ); ?>><?php _e( _t( "No" ) ); ?></option>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><?php _e( _t( 'Cookie TTL' ) ); ?></label>
							<div class="controls">
								<input type="text" name="cookieexpire" value="<?=_h((int)Hooks::get_option('cookieexpire'));?>" class="input-small" />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><?php _e( _t( 'Cookie Path' ) ); ?></label>
							<div class="controls">
								<input type="text" name="cookiepath" value="<?=_h(Hooks::get_option('cookiepath'));?>" class="input-small" />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Current Term' ) ); ?></label>
                            <div class="controls">
                                <select style="width:25%"  name="current_term_code" id="select2_13">
                                    <option value="">&nbsp;</option>
                                    <?php term_dropdown(_h(Hooks::get_option('current_term_code'))); ?>
                                </select>
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
					<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Save' ) ); ?></button>
				</div>
				<!-- // Form actions END -->
				
			</div>
		</div>
		<!-- // Widget END -->
		
	</form>
	<!-- // Form END -->
	
	<div class="modal hide fade" id="myModal">
        <div class="modal-body">
            <?=file_get_contents( APP_PATH . 'Info/setting-hold.txt' );?>
        </div>
        <div class="modal-footer">
            <a href="#" data-dismiss="modal" class="btn btn-primary"><?php _e( _t( 'Cancel' ) ); ?></a>
        </div>
    </div>
	
</div>	
		
		</div>
		<!-- // Content END -->