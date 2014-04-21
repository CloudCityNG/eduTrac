<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * User Profile View
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

$auth = new \eduTrac\Classes\Libraries\Cookies;
?>

<ul class="breadcrumb">
	<li><?=_t( 'You are here' );?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
	<li class="divider"></li>
	<li><?=_t( 'User Profile' );?></li>
</ul>

<h3><?=get_name(_h($auth->getPersonField('personID')));?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>profile/runProfile/" id="validateSubmitForm" method="post" autocomplete="off">
		
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
							<label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'First Name' );?></label>
							<div class="col-md-8">
								<input class="form-control" type="text"<?=rep('restrict_edit_profile');?> name="fname" value="<?=_h($auth->getPersonField('fname'));?>" required/>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Last Name' );?></label>
							<div class="col-md-8">
								<input class="form-control" type="text"<?=rep('restrict_edit_profile');?> name="lname" value="<?=_h($auth->getPersonField('lname'));?>" required/>
							</div>
						</div>
						<!-- // Group END -->
                        
                        <!-- Group -->
    					<div class="form-group">
							<label class="col-md-3 control-label"><?=_t( 'Middle Initial' );?></label>
							<div class="col-md-8">
								<input class="form-control" type="text"<?=rep('restrict_edit_profile');?> name="mname" value="<?=_h($auth->getPersonField('mname'));?>" />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
            			<div class="form-group">
							<label class="col-md-3 control-label"><?=_t( 'Reset Password' );?></label>
							<div class="col-md-8">
								<input class="form-control" type="password" name="password" />
							</div>
						</div>
						<!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="col-md-6">
                        
                        <!-- Group -->
            			<div class="form-group">
							<label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Email' );?></label>
							<div class="col-md-8">
								<input class="form-control" type="email"<?=rep('restrict_edit_profile');?> name="email" value="<?=_h($auth->getPersonField('email'));?>" required/>
							</div>
						</div>
						<!-- // Group END -->
                        
                        <!-- Group -->
        				<div class="form-group">
							<label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'SSN' );?></label>
							<div class="col-md-8">
								<input class="form-control" type="text"<?=rep('restrict_edit_profile');?> name="ssn" value="<?=_h($auth->getPersonField('ssn'));?>" required/>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Date of Birth' );?></label>
                            <div class="col-md-8">
    							<div class="input-group date col-md-8" id="datepicker6">
                                    <input class="form-control" name="dob" type="text"<?=rep('restrict_edit_profile');?> value="<?=_h($auth->getPersonField('dob'));?>" required/>
                                    <span class="input-group-addon"<?=ae('restrict_edit_profile');?>><i class="fa fa-th"></i></span>
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
					<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=_t( 'Submit' );?></button>
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