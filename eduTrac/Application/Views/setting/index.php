<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * System Settings View
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

use \eduTrac\Classes\Libraries\Hooks;
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
								<input type="text" name="site_title" value="<?=_h(Hooks::{'get_option'}('site_title'));?>" class="span10" required />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><font color="red">*</font> <?php _e( _t( 'System Email' ) ); ?></label>
							<div class="controls">
								<input type="text" name="system_email" value="<?=_h(Hooks::{'get_option'}('system_email'));?>" class="span10" required />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><?php _e( _t( 'Enable SSL' ) ); ?></label>
							<div class="controls">
								<select style="width:25%" name="enable_ssl" id="select2_9" disabled="disabled">
                            		<option value="1"<?=selected( _h(Hooks::{'get_option'}( 'enable_ssl' )), '1', false ); ?>><?php _e( _t( "Yes" ) ); ?></option>
                            		<option value="0"<?=selected( _h(Hooks::{'get_option'}( 'enable_ssl' )), '0', false ); ?>><?php _e( _t( "No" ) ); ?></option>
                            	</select>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Hold File Location' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="hold_file_loc" value="<?=_h(Hooks::{'get_option'}('hold_file_loc'));?>" class="span10" /> 
                                <a href="#myModal" data-toggle="modal"><img src="<?=BASE_URL;?>static/common/theme/images/help.png" /></a>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Maintenance Mode' ) ); ?></label>
                            <div class="controls">
                                <select style="width:25%"  name="maintenance_mode" id="select2_10" disabled="disabled">
                                    <option value="1"<?=selected( _h(Hooks::{'get_option'}( 'maintenance_mode' )), '1', false ); ?>><?php _e( _t( "Yes" ) );?></option>
                                    <option value="0"<?=selected( _h(Hooks::{'get_option'}( 'maintenance_mode' )), '0', false ); ?>><?php _e( _t( "No" ) ); ?></option>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Enable Benchmark' ) ); ?></label>
                            <div class="controls">
                                <select style="width:25%"  name="enable_benchmark" id="select2_11">
                                    <option value="1"<?=selected( _h(Hooks::{'get_option'}( 'enable_benchmark' )), '1', false ); ?>><?php _e( _t( "Yes" ) );?></option>
                                    <option value="0"<?=selected( _h(Hooks::{'get_option'}( 'enable_benchmark' )), '0', false ); ?>><?php _e( _t( "No" ) ); ?></option>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Enable Cron Jobs' ) ); ?></label>
                            <div class="controls">
                                <select style="width:25%" name="enable_cron_jobs" id="select2_12">
                                    <option value="1"<?=selected( _h(Hooks::{'get_option'}( 'enable_cron_jobs' )), '1', false ); ?>><?php _e( _t( "Yes" ) );?></option>
                                    <option value="0"<?=selected( _h(Hooks::{'get_option'}( 'enable_cron_jobs' )), '0', false ); ?>><?php _e( _t( "No" ) ); ?></option>
                                </select>
                                <a href="#myModalECJ" data-toggle="modal"><img src="<?=BASE_URL;?>static/common/theme/images/help.png" /></a>
                            </div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="span6">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Enable Cron Log' ) ); ?></label>
                            <div class="controls">
                                <select style="width:25%" name="enable_cron_log" id="select2_13">
                                    <option value="1"<?=selected( _h(Hooks::{'get_option'}( 'enable_cron_log' )), '1', false ); ?>><?php _e( _t( "Yes" ) );?></option>
                                    <option value="0"<?=selected( _h(Hooks::{'get_option'}( 'enable_cron_log' )), '0', false ); ?>><?php _e( _t( "No" ) ); ?></option>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><?php _e( _t( 'Cookie TTL' ) ); ?></label>
							<div class="controls">
								<input type="text" name="cookieexpire" value="<?=_h((int)Hooks::{'get_option'}('cookieexpire'));?>" class="input-small" />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><?php _e( _t( 'Cookie Path' ) ); ?></label>
							<div class="controls">
								<input type="text" name="cookiepath" value="<?=_h(Hooks::{'get_option'}('cookiepath'));?>" class="input-small" />
							</div>
						</div>
						<!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Open Registration' ) ); ?></label>
                            <div class="controls">
                                <select style="width:25%"  name="open_registration" id="select2_14">
                                    <option value="1"<?=selected( _h(Hooks::{'get_option'}( 'open_registration' )), '1', false ); ?>><?php _e( _t( "Yes" ) );?></option>
                                    <option value="0"<?=selected( _h(Hooks::{'get_option'}( 'open_registration' )), '0', false ); ?>><?php _e( _t( "No" ) ); ?></option>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Current Term' ) ); ?></label>
                            <div class="controls">
                                <select style="width:100%"  name="current_term_id" id="select2_15">
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('term','','termID','termCode','termName',_h(Hooks::{'get_option'}('current_term_id'))); ?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
    					<div class="control-group">
							<label class="control-label"><?php _e( _t( 'Help Desk' ) ); ?></label>
							<div class="controls">
								<input type="text" name="help_desk" value="<?=_h(Hooks::{'get_option'}('help_desk'));?>" class="span12" />
							</div>
						</div>
						<!-- // Group END -->
						
					</div>
					<!-- // Column END -->
				</div>
				<!-- // Row END -->
			
				<hr class="separator" />
				
				<div class="separator line bottom"></div>
								
				<!-- Group -->
				<div class="control-group row-fluid">
					<label class="control-label"><?php _e( _t( 'Reset Password Text' ) ); ?></label>
					<div class="controls">
						<textarea id="mustHaveId" class="wysihtml5 span12" name="reset_password_text" rows="20"><?=_h(Hooks::{'get_option'}('reset_password_text'));?></textarea>
					</div>
				</div>
				<!-- // Group END -->
				
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
    
    <div class="modal hide fade" id="myModalECJ">
        <div class="modal-body">
            <p><?=_t('This option should be set to "No" until you have configured each');?> <a href="<?=BASE_URL;?>cron/"><?=_t('cron job');?></a>. <?=_t('If this is set to "Yes" before that, your error logs will be huge.');?></p>
        </div>
        <div class="modal-footer">
            <a href="#" data-dismiss="modal" class="btn btn-primary"><?php _e( _t( 'Cancel' ) ); ?></a>
        </div>
    </div>
	
</div>	
		
		</div>
		<!-- // Content END -->