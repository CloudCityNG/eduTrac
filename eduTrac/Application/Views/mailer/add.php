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
 * @since       3.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */
?>

<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script type="text/javascript">
	tinymce.init({selector: "textarea"});
</script>

<ul class="breadcrumb">
	<li><?=_t( 'You are here' );?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>mailer/<?=bm();?>" class="glyphicons envelope"><i></i> <?=_t( 'Email Templates' );?></a></li>
	<li class="divider"></li>
	<li><?=_t( 'Add Email Template' );?></li>
</ul>

<h3><?=_t( 'Add Email Template' );?></h3>
<div class="innerLR">
	
	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>mailer/runTemplate/" id="validateSubmitForm" method="post">
		
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
					<div class="col-md-10">
					    
					    <!-- Group -->
						<div class="form-group">
							<div class="col-md-8"><a href="#myModal" data-toggle="modal" class="btn btn-primary"><?=_t( 'Placeholders' );?></a></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="col-md-3 control-label" for="email_key"><font color="red">*</font> <?=_t( 'Email Key' );?></label>
							<div class="col-md-8"><input class="form-control" id="email_key" name="email_key" type="text" required/></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="col-md-3 control-label" for="email_name"><font color="red">*</font> <?=_t( 'Email Name' );?></label>
							<div class="col-md-8"><input class="form-control" id="email_name" name="email_name" type="text" required/></div>
						</div>
						<!-- // Group END -->
					
						<!-- Group -->
						<div class="form-group row-fluid">
							<div class="form-group">
								<label class="col-md-3 control-label" for="email_value"><font color="red">*</font> <?=_t( 'Template' );?></label>
								<div class="col-md-8">
									<textarea id="id1" class="col-md-12 form-control" rows="20" name="email_value" required></textarea>
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
				    <input name="deptCode" type="hidden" value="<?=_h($this->deptID[0]['deptCode']);?>" />
					<button type="submit" name="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=_t( 'Submit' );?></button>
					<button type="button" class="btn btn-icon btn-primary glyphicons circle_minus" onclick="window.location='<?=BASE_URL;?>mailer/<?=bm();?>'"><i></i><?=_t( 'Cancel' );?></button>
				</div>
				<!-- // Form actions END -->
				
			</div>
		</div>
		<!-- // Widget END -->
		
	</form>
	<!-- // Form END -->
	<div class="separator bottom"></div>
	
	<div class="modal fade" id="myModal">
		
		<div class="modal-dialog">
			<div class="modal-content">
	
				<!-- Modal heading -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="modal-title"><?=_t( 'Placeholders' );?></h3>
				</div>
				<!-- // Modal heading END -->
				
				<!-- Modal body -->
				<div class="modal-body">
		            <?=file_get_contents( APP_PATH . 'Info/email-placeholders.txt' );?>
		        </div>
		        <div class="modal-footer">
		            <a href="#" data-dismiss="modal" class="btn btn-primary"><?=_t( 'Cancel' );?></a>
		        </div>
	       </div>
      </div>
    </div>
    
	<!-- // Widget END -->
	
</div>	
	
		
		</div>
		<!-- // Content END -->