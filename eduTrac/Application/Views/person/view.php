<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * View Person View
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

$user = new \eduTrac\Classes\DBObjects\Student;
$user->Load_from_key($this->person[0]['personID']);
?>

<ul class="breadcrumb">
	<li><?=_t( 'You are here' );?></li>
	<li><a href="<?=BASE_URL;?>dashboard<?=bm();?>/" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>person/<?=bm();?>" class="glyphicons search"><i></i> <?=_t( 'Search Person' );?></a></li>
    <li class="divider"></li>
	<li><?=_t( 'View Person' );?></li>
</ul>

<h3><?=_t( 'Person:' );?> <?=_h($this->person[0]['lname']);?>, <?=_h($this->person[0]['fname']);?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>person/runEditPerson/" id="validateSubmitForm" method="post" autocomplete="off">
		
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
                            <label class="col-md-3 control-label"><?=_t( 'Username' );?></label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" value="<?=_h($this->person[0]['uname']);?>" readonly />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Person Type' );?> <a href="#myModal" data-toggle="modal"><img src="<?=BASE_URL;?>static/common/theme/images/help.png" /></a></label>
                            <div class="col-md-8">
                                <?=person_type_select(_h($this->person[0]['personType']));?>
                            </div>
                        </div>
                        <!-- // Group END -->
					
						<!-- Group -->
						<div class="form-group">
							<label class="col-md-3 control-label"><?=_t( 'Prefix' );?></label>
							<div class="col-md-8">
								<select name="prefix" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true"<?=pio();?>>
                                    <option value="">&nbsp;</option>
                                    <option value="Ms"<?php if($this->person[0]['prefix'] == 'Ms') { echo ' selected="selected"'; }?>><?=_t( 'Ms.' );?></option>
                                    <option value="Miss"<?php if($this->person[0]['prefix'] == 'Miss') { echo ' selected="selected"'; }?>><?=_t( 'Miss.' );?></option>
                                    <option value="Mrs"<?php if($this->person[0]['prefix'] == 'Mrs') { echo ' selected="selected"'; }?>><?=_t( 'Mrs.' );?></option>
                                    <option value="Mr"<?php if($this->person[0]['prefix'] == 'Mr') { echo ' selected="selected"'; }?>><?=_t( 'Mr.' );?></option>
                                </select>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'First Name' );?></label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="fname"<?=pio();?> value="<?=_h($this->person[0]['fname']);?>" required />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Last Name' );?></label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="lname"<?=pio();?> value="<?=_h($this->person[0]['lname']);?>" required />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Middle Initial' );?></label>
                            <div class="col-md-2">
                                <input class="form-control" type="text" name="mname"<?=pio();?> value="<?=_h($this->person[0]['mname']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="col-md-3 control-label"><?=_t( 'Address1' );?> <a href="<?=BASE_URL;?>person/addr_sum/<?=_h($this->person[0]['personID']);?>/<?=bm();?>"><img src="<?=BASE_URL;?>static/common/theme/images/cascade.png" /></a></label>
							<div class="col-md-8">
								<input class="form-control" type="text" disabled value="<?=_h($this->addr[0]['address1']);?>" required />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Address2' );?></label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" disabled value="<?=_h($this->addr[0]['address2']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'City' );?></label>
                            <div class="col-md-5">
                                <input class="form-control" type="text" disabled value="<?=_h($this->addr[0]['city']);?>" required />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'State' );?></label>
                            <div class="col-md-2">
                                <input class="form-control" type="text" disabled value="<?=_h($this->addr[0]['state']);?>" required />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Zip Code' );?></label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" disabled value="<?=_h($this->addr[0]['zip']);?>" required />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Country' );?></label>
                            <div class="col-md-2">
                                <input class="form-control" type="text" disabled value="<?=_h($this->addr[0]['country']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="col-md-6">
						
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Phone' );?></label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" disabled value="<?=_h($this->addr[0]['phone1']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Preferred Email' );?></label>
                            <div class="col-md-6">
                                <input class="form-control" type="email" name="email"<?=pio();?> value="<?=_h($this->addr[0]['email']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Social Security #' );?></label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" name="ssn"<?=pio();?> value="<?=(_h((int)$this->person[0]['ssn']) > 0 ? _h((int)$this->person[0]['ssn']) : '');?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Veteran?' );?></label>
                            <div class="col-md-8">
                                <select name="veteran" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true"<?=pio();?> required>
                                    <option value="1"<?php if($this->person[0]['veteran'] == 1) { echo ' selected="selected"'; }?>><?=_t( 'Yes' );?></option>
                                    <option value="0"<?php if($this->person[0]['veteran'] == 0) { echo ' selected="selected"'; }?>><?=_t( 'No' );?></option>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Ethnicity?' );?></label>
                            <div class="col-md-8">
                                <select name="ethnicity"<?=pio();?> class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true">
                                    <option value="">&nbsp;</option>
                                    <option value="White, Non-Hispanic"<?=selected('White, Non-Hispanic',_h($this->person[0]['ethnicity']),false);?>><?=_t( 'White, Non-Hispanic' );?></option>
                                    <option value="Black, Non-Hispanic"<?=selected('Black, Non-Hispanic',_h($this->person[0]['ethnicity']),false);?>><?=_t( 'Black, Non-Hispanic' );?></option>
                                    <option value="Hispanic"<?=selected('Hispanic',_h($this->person[0]['ethnicity']),false);?>><?=_t( 'Hispanic' );?></option>
                                    <option value="Native American"<?=selected('Native American',_h($this->person[0]['ethnicity']),false);?>><?=_t( 'Native American' );?></option>
                                    <option value="Native Alaskan"<?=selected('Native Alaskan',_h($this->person[0]['ethnicity']),false);?>><?=_t( 'Native Alaskan' );?></option>
                                    <option value="Pacific Islander"<?=selected('Pacific Islander',_h($this->person[0]['ethnicity']),false);?>><?=_t( 'Pacific Islander' );?></option>
                                    <option value="Asian"<?=selected('Asian',_h($this->person[0]['ethnicity']),false);?>><?=_t( 'Asian' );?></option>
                                    <option value="Indian"<?=selected('Indian',_h($this->person[0]['ethnicity']),false);?>><?=_t( 'Indian' );?></option>
                                    <option value="Middle Eastern"<?=selected('Middle Eastern',_h($this->person[0]['ethnicity']),false);?>><?=_t( 'Middle Eastern' );?></option>
                                    <option value="African"<?=selected('African',_h($this->person[0]['ethnicity']),false);?>><?=_t( 'African' );?></option>
                                    <option value="Mixed Race"<?=selected('Mixed Race',_h($this->person[0]['ethnicity']),false);?>><?=_t( 'Mixed Race' );?></option>
                                    <option value="Other"<?=selected('Other',_h($this->person[0]['ethnicity']),false);?>><?=_t( 'Other' );?></option>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Date of Birth' );?></label>
                            <div class="col-md-8">
                                <div class="input-group date col-md-8" id="datepicker6">
                                    <input class="form-control" name="dob"<?=pio();?> type="text" value="<?=(_h($this->person[0]['dob']) > '0000-00-00' ? _h($this->person[0]['dob']) : '');?>" />
                                    <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                </div>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Gender' );?></label>
                            <div class="col-md-8">
                                <select name="gender" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true"<?=pio();?>>
                                    <option value="">&nbsp;</option>
                                    <option value="M"<?php if($this->person[0]['gender'] == 'M') { echo ' selected="selected"'; }?>><?=_t( 'Male' );?></option>
                                    <option value="F"<?php if($this->person[0]['gender'] == 'F') { echo ' selected="selected"'; }?>><?=_t( 'Female' );?></option>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Emergency Contact' );?></label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="emergency_contact"<?=pio();?> value="<?=_h($this->person[0]['emergency_contact']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Emergency Contact Phone' );?></label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="emergency_contact_phone"<?=pio();?> value="<?=_h($this->person[0]['emergency_contact_phone']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Approved Date' );?></label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" readonly value="<?=date('D, M d, o',strtotime(_h($this->person[0]['approvedDate'])));?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Approved By' );?></label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" readonly value="<?=get_name(_h($this->person[0]['approvedBy']));?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Last Update' );?></label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" readonly value="<?=date('D, M d, o @ h:i A',strtotime(_h($this->person[0]['LastUpdate'])));?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
				</div>
				<!-- // Row END -->
			
				<hr class="separator" />
				
				<div class="modal fade" id="myModal">
					<div class="modal-dialog">
						<div class="modal-content">
							<!-- Modal heading -->
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h3 class="modal-title"><?=_t( 'Person Type' );?></h3>
							</div>
							<!-- // Modal heading END -->
		                    <div class="modal-body">
		                        <?=file_get_contents( APP_PATH . 'Info/person-type.txt' );?>
		                    </div>
		                    <div class="modal-footer">
		                        <a href="#" data-dismiss="modal" class="btn btn-primary"><?=_t( 'Cancel' );?></a>
		                    </div>
	                   	</div>
                  	</div>
                </div>
				
				<!-- Form actions -->
				<div class="form-actions">
				    <input type="hidden" name="personID" value="<?=_h($this->person[0]['personID']);?>" />
					<button type="submit"<?=pids();?> class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=_t( 'Save' );?></button>
					<button type="button"<?=ae('reset_password');?> class="btn btn-icon btn-primary glyphicons refresh" onclick="window.location='<?=BASE_URL;?>person/resetPassword/<?=_h($this->person[0]['personID']);?>'"><i></i><?=_t( 'Reset Password' );?></button>
                    <button type="button" class="btn btn-icon btn-primary glyphicons circle_minus" onclick="window.location='<?=BASE_URL;?>person/<?=bm();?>'"><i></i><?=_t( 'Cancel' );?></button>
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