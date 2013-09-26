<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * View Staff View
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
?>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>staff/<?=bm();?>" class="glyphicons search"><i></i> <?php _e( _t( 'Search Staff' ) ); ?></a></li>
    <li class="divider"></li>
	<li><?php _e( _t( 'View Staff' ) ); ?></li>
</ul>

<h3><?=get_name(_h($this->staff[0]['staffID']));?> <?php _e( _t( "ID: " ) ); ?><?=_h($this->staff[0]['staffID']);?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>staff/runEditStaff/" id="validateSubmitForm" method="post" autocomplete="off">
		
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
					<div class="span12">
					    
					    <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="address"><?php _e( _t( 'Address' ) ); ?></label>
                            <div class="controls">
                                <input class="span3" type="text" readonly value="<?=_h($this->staffAddr[0]['address1']);?> <?=_h($this->staffAddr[0]['address2']);?>" />
                                <input class="span3" type="text" readonly value="<?=_h($this->staffAddr[0]['city']);?>" />
                                <input class="span3" type="text" readonly value="<?=_h($this->staffAddr[0]['state']);?>" />
                                <input class="span3" type="text" readonly value="<?=_h($this->staffAddr[0]['zip']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- End Column -->
                </div>
                <!-- End Row -->
                
                <hr class="separator" />
			
				<!-- Row -->
				<div class="row-fluid">
					<!-- Column -->
					<div class="span6">
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Building' ) ); ?></label>
                            <div class="controls">
                                <select style="width:100%;" name="buildingID"<?=staio();?> id="select2_11" required>
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('building','','buildingID','buildingCode','buildingName',_h($this->staff[0]['buildingID'])); ?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Office' ) ); ?></label>
                            <div class="controls">
                                <select style="width:100%;" name="officeID"<?=staio();?> id="select2_12">
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('room','','roomID','roomCode','roomNumber',_h($this->staff[0]['officeID'])); ?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Office Phone' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="office_phone"<?=staio();?> class="span6" value="<?=_h($this->staff[0]['office_phone']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'School' ) ); ?></label>
                            <div class="controls">
                                <select style="width:100%;" name="schoolID" id="select2_15">
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('school','','schoolID','schoolCode','schoolName',_h($this->staff[0]['schoolID'])); ?>
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
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Department' ) ); ?></label>
                            <div class="controls">
                                <select style="width:100%;" name="deptID"<?=staio();?> id="select2_14" requied>
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('department','','deptID','deptCode','deptName',_h($this->staff[0]['deptID'])); ?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Status' ) ); ?></label>
                            <div class="controls">
                                <select style="width:100%;" name="status" id="select2_13" required>
                                    <option value="">&nbsp;</option>
                                    <option value="A"<?=selected('A',_h($this->staff[0]['status']),false);?>><?php _e( _t( 'A Active' ) ); ?></option>
                                    <option value="I"<?=selected('I',_h($this->staff[0]['status']),false);?>><?php _e( _t( 'I Inactive' ) ); ?></option>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
					    
					    <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Email' ) ); ?></label>
                            <div class="controls">
                                <input type="text" readonly class="span6" value="<?=_h($this->staffAddr[0]['email1']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Approved By' ) ); ?></label>
                            <div class="controls">
                                <input type="text" readonly value="<?=get_name(_h($this->staff[0]['approvedBy']));?>" class="span6" required />
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
				    <input type="hidden" name="staffID" value="<?=_h($this->staff[0]['staffID']);?>" />
					<button type="submit"<?=staids();?> class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Save' ) ); ?></button>
					<button type="button" class="btn btn-icon btn-primary glyphicons circle_minus" onclick="window.location='<?=BASE_URL;?>staff/<?=bm();?>'"><i></i><?php _e( _t( 'Cancel' ) ); ?></button>
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