<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * View Person View
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

$user = new \tinyPHP\Classes\DBObjects\Student;
$user->Load_from_key($this->person[0]['personID']);
?>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?=BASE_URL;?>dashboard<?=bm();?>/" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>person/<?=bm();?>" class="glyphicons search"><i></i> <?php _e( _t( 'Search Person' ) ); ?></a></li>
    <li class="divider"></li>
	<li><?php _e( _t( 'View Person' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Person:' ) ); ?> <?=_h($this->person[0]['lname']);?>, <?=_h($this->person[0]['fname']);?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>person/runEditPerson/" id="validateSubmitForm" method="post" autocomplete="off">
		
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
                            <label class="control-label"><?php _e( _t( 'Username' ) ); ?></label>
                            <div class="controls">
                                <input type="text" class="span10" value="<?=_h($this->person[0]['uname']);?>" disabled />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Person Type' ) ); ?></label>
                            <div class="controls">
                                <?=person_type_select(_h($this->person[0]['personType']));?>
                                <a href="#myModal" data-toggle="modal"><img src="<?=BASE_URL;?>static/common/theme/images/help.png" /></a>
                            </div>
                        </div>
                        <!-- // Group END -->
					
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><?php _e( _t( 'Prefix' ) ); ?></label>
							<div class="controls">
								<select name="prefix" style="width:25%" id="select2_10">
                                    <option value="">&nbsp;</option>
                                    <option value="Ms"<?php if($this->person[0]['prefix'] == 'Ms') { echo ' selected="selected"'; }?>><?php _e( _t( 'Ms.' ) ); ?></option>
                                    <option value="Miss"<?php if($this->person[0]['prefix'] == 'Miss') { echo ' selected="selected"'; }?>><?php _e( _t( 'Miss.' ) ); ?></option>
                                    <option value="Mrs"<?php if($this->person[0]['prefix'] == 'Mrs') { echo ' selected="selected"'; }?>><?php _e( _t( 'Mrs.' ) ); ?></option>
                                    <option value="Mr"<?php if($this->person[0]['prefix'] == 'Mr') { echo ' selected="selected"'; }?>><?php _e( _t( 'Mr.' ) ); ?></option>
                                </select>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><font color="red">*</font> <?php _e( _t( 'First Name' ) ); ?></label>
							<div class="controls">
								<input type="text" name="fname" class="span10" value="<?=_h($this->person[0]['fname']);?>" required />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Last Name' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="lname" class="span10" value="<?=_h($this->person[0]['lname']);?>" required />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Middle Initial' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="mname" class="span2" value="<?=_h($this->person[0]['mname']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><?php _e( _t( 'Address1' ) ); ?></label>
							<div class="controls">
								<input type="text" disabled class="span10" value="<?=_h($this->addr[0]['address1']);?>" required />
								<a href="<?=BASE_URL;?>person/addr_sum/<?=_h($this->person[0]['personID']);?>/<?=bm();?>"><img src="<?=BASE_URL;?>static/common/theme/images/cascade.png" /></a>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Address2' ) ); ?></label>
                            <div class="controls">
                                <input type="text" disabled class="span5" value="<?=_h($this->addr[0]['address2']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'City' ) ); ?></label>
                            <div class="controls">
                                <input type="text" disabled class="span5" value="<?=_h($this->addr[0]['city']);?>" required />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'State' ) ); ?></label>
                            <div class="controls">
                                <input type="text" disabled class="span2" value="<?=_h($this->addr[0]['state']);?>" required />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Zip Code' ) ); ?></label>
                            <div class="controls">
                                <input type="text" disabled class="span5" value="<?=_h($this->addr[0]['zip']);?>" required />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Country' ) ); ?></label>
                            <div class="controls">
                                <input type="text" disabled class="span2" value="<?=_h($this->addr[0]['country']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Phone' ) ); ?></label>
                            <div class="controls">
                                <input type="text" disabled class="span5" value="<?=_h($this->addr[0]['phone1']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="span6">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Primary/Preferred Email' ) ); ?></label>
                            <div class="controls">
                                <input type="email" name="email" class="span5" value="<?=_h($this->addr[0]['email']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Social Security #' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="ssn" class="span5" value="<?=_h((int)$this->person[0]['ssn']);?>" required/>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Veteran?' ) ); ?></label>
                            <div class="controls">
                                <select name="veteran" style="width:25%" id="select2_11" required>
                                    <option value="1"<?php if($this->person[0]['veteran'] == 1) { echo ' selected="selected"'; }?>><?php _e( _t( 'Yes' ) ); ?></option>
                                    <option value="0"<?php if($this->person[0]['veteran'] == 0) { echo ' selected="selected"'; }?>><?php _e( _t( 'No' ) ); ?></option>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Ethnicity?' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="ethnicity" class="span6" value="<?=_h($this->person[0]['ethnicity']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Date of Birth' ) ); ?></label>
                            <div class="controls">
                                <div class="input-append date" id="datetimepicker6">
                                    <input id="dob" name="dob" type="text" value="<?=_h($this->person[0]['dob']);?>" />
                                    <span class="add-on"><i class="icon-th"></i></span>
                                </div>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Gender' ) ); ?></label>
                            <div class="controls">
                                <select name="gender" style="width:25%" id="select2_12">
                                    <option value="">&nbsp;</option>
                                    <option value="M"<?php if($this->person[0]['gender'] == 'M') { echo ' selected="selected"'; }?>><?php _e( _t( 'Male' ) ); ?></option>
                                    <option value="F"<?php if($this->person[0]['gender'] == 'F') { echo ' selected="selected"'; }?>><?php _e( _t( 'Female' ) ); ?></option>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Emergency Contact' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="emergency_contact" class="span10" value="<?=_h($this->person[0]['emergency_contact']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Emergency Contact Phone' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="emergency_contact_phone" class="span10" value="<?=_h($this->person[0]['emergency_contact_phone']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Approved Date' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="approvedDate" disabled class="span5" value="<?=date('D, M d, o',strtotime(_h($this->person[0]['approvedDate'])));?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Approved By' ) ); ?></label>
                            <div class="controls">
                                <input type="text" disabled class="span5" value="<?=get_name(_h($this->person[0]['approvedBy']));?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
				</div>
				<!-- // Row END -->
			
				<hr class="separator" />
				
				<div class="modal hide fade" id="myModal">
                    <div class="modal-body">
                        <?=file_get_contents( APP_PATH . 'Info/person-type.txt' );?>
                    </div>
                    <div class="modal-footer">
                        <a href="#" data-dismiss="modal" class="btn btn-primary"><?php _e( _t( 'Cancel' ) ); ?></a>
                    </div>
                </div>
				
				<!-- Form actions -->
				<div class="form-actions">
				    <input type="hidden" name="personID" value="<?=_h($this->person[0]['personID']);?>" />
					<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Save' ) ); ?></button>
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