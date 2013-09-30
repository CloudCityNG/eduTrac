<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * View Mailer View
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
?>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>mailer/<?=bm();?>" class="glyphicons e-mail"><i></i> <?php _e( _t( 'Email Templates' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'View Email Template' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'View Email Template' ) ); ?></h3>
<div class="innerLR">
	
	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>mailer/runEditTemplate/" id="validateSubmitForm" method="post">
		
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
					<div class="span10">
					
					    <!-- Group -->
						<div class="control-group">
							<div class="controls"><a href="#myModal" data-toggle="modal" class="btn btn-primary"><?php _e( _t( 'Placeholders' ) ); ?></a></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="email_key"><font color="red">*</font> <?php _e( _t( 'Email Key' ) ); ?></label>
							<div class="controls"><input class="span12" id="email_key" name="email_key" type="text" value="<?=_h($this->emailTemp[0]['email_key']);?>" required/></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="email_name"><font color="red">*</font> <?php _e( _t( 'Email Name' ) ); ?></label>
							<div class="controls"><input class="span12" id="email_name" name="email_name" type="text" value="<?=_h($this->emailTemp[0]['email_name']);?>" required/></div>
						</div>
						<!-- // Group END -->
					
						<!-- Group -->
						<div class="control-group row-fluid">
							<div class="control-group">
								<label class="control-label" for="email_value"><font color="red">*</font> <?php _e( _t( 'Template' ) ); ?></label>
								<div class="controls">
									<textarea id="id1" class="wysihtml5 span12" rows="20" name="email_value" required><?=_h($this->emailTemp[0]['email_value']);?></textarea>
								</div>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="semester"><?php _e( _t( 'Last Update' ) ); ?></label>
							<div class="controls"><input class="span12" type="text" disabled value="<?=date('D, M d, o @ h:i A',strtotime(_h($this->emailTemp[0]['LastUpdate'])));?>" /></div>
						</div>
						<!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
				</div>
				<!-- // Row END -->
			
				<hr class="separator" />
				
				<!-- Form actions -->
				<div class="form-actions">
					<input name="etID" type="hidden" value="<?=_h($this->emailTemp[0]['etID']);?>" />
					<input name="deptID" type="hidden" value="<?=_h($this->emailTemp[0]['deptID']);?>" />
					<button type="submit" name="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Submit' ) ); ?></button>
					<button type="button" class="btn btn-icon btn-primary glyphicons circle_minus" onclick="window.location='<?=BASE_URL;?>mailer/<?=bm();?>'"><i></i><?php _e( _t( 'Cancel' ) ); ?></button>
				</div>
				<!-- // Form actions END -->
				
			</div>
		</div>
		<!-- // Widget END -->
		
	</form>
	<!-- // Form END -->
	<div class="separator bottom"></div>
	
	<div class="modal hide fade" id="myModal">
        <div class="modal-body">
            <?=file_get_contents( APP_PATH . 'Info/email-placeholders.txt' );?>
        </div>
        <div class="modal-footer">
            <a href="#" data-dismiss="modal" class="btn btn-primary"><?php _e( _t( 'Cancel' ) ); ?></a>
        </div>
    </div>
    
	<!-- // Widget END -->
	
</div>	
	
		
		</div>
		<!-- // Content END -->