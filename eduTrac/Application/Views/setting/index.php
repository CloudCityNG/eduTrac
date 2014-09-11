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
 * @since       3.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

use \eduTrac\Classes\Libraries\Hooks;
?>

<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script type="text/javascript">
	tinymce.init({selector: "textarea"});
</script>

<ul class="breadcrumb">
	<li><?=_t( 'You are here' );?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
	<li class="divider"></li>
	<li><?=_t( 'System Settings' );?></li>
</ul>

<h3><?=_t( 'System Settings' );?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>setting/runSetting/" id="validateSubmitForm" method="post" autocomplete="off">
		
		<!-- Widget -->
		<div class="widget widget-heading-simple widget-body-gray">
		
			<!-- Widget heading -->
			<div class="widget-head">
				<h4 class="heading"><font color="red">*</font> <?=_t( 'Indicates field is required' );?></h4>
			</div>
			<!-- // Widget heading END -->
			
			<div class="widget-body">
			
				<!-- Row -->
				<div class="row">
					<!-- Column -->
					<div class="col-md-6">
						
						<!-- Group -->
						<div class="form-group">
							<label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Site Title' );?></label>
							<div class="col-md-8">
								<input type="text" name="site_title" value="<?=_h(Hooks::{'get_option'}('site_title'));?>" class="form-control" required />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'System Email' );?></label>
							<div class="col-md-8">
								<input type="text" name="system_email" value="<?=_h(Hooks::{'get_option'}('system_email'));?>" class="form-control" required />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="col-md-3 control-label"><?=_t( 'Enable SSL' );?></label>
							<div class="col-md-8">
								<select name="enable_ssl" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" disabled="disabled">
                            		<option value="">&nbsp;</option>
                            		<option value="1"<?=selected( _h(Hooks::{'get_option'}( 'enable_ssl' )), '1', false ); ?>><?=_t( "Yes" );?></option>
                            		<option value="0"<?=selected( _h(Hooks::{'get_option'}( 'enable_ssl' )), '0', false ); ?>><?=_t( "No" );?></option>
                            	</select>
							</div>
						</div>
						<!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Maintenance Mode' );?></label>
                            <div class="col-md-8">
                                <select name="maintenance_mode" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" disabled="disabled">
                                    <option value="">&nbsp;</option>
                                    <option value="1"<?=selected( _h(Hooks::{'get_option'}( 'maintenance_mode' )), '1', false ); ?>><?=_t( "Yes" );?></option>
                                    <option value="0"<?=selected( _h(Hooks::{'get_option'}( 'maintenance_mode' )), '0', false ); ?>><?=_t( "No" );?></option>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Enable Benchmark' );?></label>
                            <div class="col-md-8">
                                <select name="enable_benchmark" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true">
                                    <option value="">&nbsp;</option>
                                    <option value="1"<?=selected( _h(Hooks::{'get_option'}( 'enable_benchmark' )), '1', false ); ?>><?=_t( "Yes" );?></option>
                                    <option value="0"<?=selected( _h(Hooks::{'get_option'}( 'enable_benchmark' )), '0', false ); ?>><?=_t( "No" );?></option>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Enable Cron Jobs' );?> <a href="#myModalECJ" data-toggle="modal"><img src="<?=BASE_URL;?>static/common/theme/images/help.png" /></a></label>
                            <div class="col-md-8">
                                <select name="enable_cron_jobs" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true">
                                    <option value="">&nbsp;</option>
                                    <option value="1"<?=selected( _h(Hooks::{'get_option'}( 'enable_cron_jobs' )), '1', false ); ?>><?=_t( "Yes" );?></option>
                                    <option value="0"<?=selected( _h(Hooks::{'get_option'}( 'enable_cron_jobs' )), '0', false ); ?>><?=_t( "No" );?></option>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Enable Cron Log' );?></label>
                            <div class="col-md-8">
                                <select name="enable_cron_log" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true">
                                    <option value="">&nbsp;</option>
                                    <option value="1"<?=selected( _h(Hooks::{'get_option'}( 'enable_cron_log' )), '1', false ); ?>><?=_t( "Yes" );?></option>
                                    <option value="0"<?=selected( _h(Hooks::{'get_option'}( 'enable_cron_log' )), '0', false ); ?>><?=_t( "No" );?></option>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="col-md-3 control-label"><?=_t( 'Cookie TTL' );?></label>
							<div class="col-md-8">
								<input type="text" name="cookieexpire" value="<?=_h((int)Hooks::{'get_option'}('cookieexpire'));?>" class="form-control" />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="col-md-3 control-label"><?=_t( 'Cookie Path' );?></label>
							<div class="col-md-8">
								<input type="text" name="cookiepath" value="<?=_h(Hooks::{'get_option'}('cookiepath'));?>" class="form-control" />
							</div>
						</div>
						<!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="col-md-6">
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Curl' );?></label>
                            <div class="col-md-8">
                                <select name="curl" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true">
                                    <option value="">&nbsp;</option>
                                    <option value="1"<?=selected( _h(Hooks::{'get_option'}( 'curl' )), '1', false ); ?>><?=_t( "On" );?></option>
                                    <option value="0"<?=selected( _h(Hooks::{'get_option'}( 'curl' )), '0', false ); ?>><?=_t( "Off" );?></option>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
    					<div class="form-group">
							<label class="col-md-3 control-label"><?=_t( 'Auth Token' );?> <a href="#token" data-toggle="modal"><img src="<?=BASE_URL;?>static/common/theme/images/help.png" /></a></label>
							<div class="col-md-8">
								<input type="text" name="auth_token" value="<?=_h(Hooks::{'get_option'}('auth_token'));?>" class="form-control" />
							</div>
						</div>
						<!-- // Group END -->
                        
                        <!-- Group -->
    					<div class="form-group">
							<label class="col-md-3 control-label"><?=_t( 'Help Desk' );?></label>
							<div class="col-md-8">
								<input type="text" name="help_desk" value="<?=_h(Hooks::{'get_option'}('help_desk'));?>" class="form-control" />
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
				<div class="form-group row">
					<label class="col-md-3 control-label"><?=_t( 'Reset Password Text' );?></label>
					<div class="col-md-8">
						<textarea id="mustHaveId" class="col-md-8 form-control" name="reset_password_text" rows="20"><?=_h(Hooks::{'get_option'}('reset_password_text'));?></textarea>
					</div>
				</div>
				<!-- // Group END -->
				
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
	
	<div class="modal fade" id="myModal">
		<div class="modal-dialog">
			<div class="modal-content">
	
				<!-- Modal heading -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="modal-title"><?=_t( 'Hold File Location' );?></h3>
				</div>
				<!-- // Modal heading END -->
		        <div class="modal-body">
		            <?=file_get_contents( APP_PATH . 'Info/setting-hold.txt' );?>
		        </div>
		        <div class="modal-footer">
		            <a href="#" data-dismiss="modal" class="btn btn-primary"><?=_t( 'Cancel' );?></a>
		        </div>
	       	</div>
      	</div>
    </div>
    
    <div class="modal fade" id="myModalECJ">
    	<div class="modal-dialog">
			<div class="modal-content">
	
				<!-- Modal heading -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="modal-title"><?=_t( 'Enable Cron Jobs' );?></h3>
				</div>
				<!-- // Modal heading END -->
		        <div class="modal-body">
		            <p><?=_t("This option should be set to 'No' until you have configured each");?> <a href="<?=BASE_URL;?>cron/"><?=_t('cron job');?></a>. <?=_t("If this is set to 'Yes' before that, your error logs will be huge.");?></p>
		        </div>
		        <div class="modal-footer">
		            <a href="#" data-dismiss="modal" class="btn btn-primary"><?=_t( 'Cancel' );?></a>
		        </div>
	        </div>
      	</div>
    </div>
    
    <div class="modal fade" id="token">
    	<div class="modal-dialog">
			<div class="modal-content">
	
				<!-- Modal heading -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="modal-title"><?=_t( 'Auth Token' );?></h3>
				</div>
				<!-- // Modal heading END -->
		        <div class="modal-body">
		            <p><?=_t("If you plan to do development work using the RESTful API feature, then you will need an auth token.");?> <a href="http://community.7mediaws.org/projects/edutrac/wiki/RESTful_API"><?=_t('Click here');?></a> <?=_t("to generate an auth token for your account.");?></p>
		        </div>
		        <div class="modal-footer">
		            <a href="#" data-dismiss="modal" class="btn btn-primary"><?=_t( 'Cancel' );?></a>
		        </div>
	        </div>
      	</div>
    </div>
	
</div>	
		
		</div>
		<!-- // Content END -->