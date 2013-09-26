<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Add Staff View
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

$auth = new \eduTrac\Classes\Libraries\Cookies;
?>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>staff/<?=bm();?>" class="glyphicons search"><i></i> <?php _e( _t( 'Search Staff' ) ); ?></a></li>
    <li class="divider"></li>
	<li><?php _e( _t( 'Add Staff' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Add Staff' ) ); ?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>staff/runStaff/" id="validateSubmitForm" method="post" autocomplete="off">
		
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
							<label class="control-label"><font color="red">*</font> <?php _e( _t( 'Staff' ) ); ?></label>
							<div class="controls">
								<input type="text" readonly class="span6" value="<?=get_name(_h($this->person[0]['personID']));?>" />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Building' ) ); ?></label>
                            <div class="controls">
                                <select style="width:100%;" name="buildingID" id="select2_11" required>
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('building','','buildingID','buildingCode','buildingName'); ?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Office' ) ); ?></label>
                            <div class="controls">
                                <select style="width:100%;" name="officeID" id="select2_12">
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('room','','roomID','roomCode','roomNumber'); ?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Office Phone' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="office_phone" class="span6" />
                            </div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="span6">
					
					    <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'School' ) ); ?></label>
                            <div class="controls">
                                <select style="width:100%;" name="schoolID" id="select2_15">
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('school','','schoolID','schoolCode','schoolName'); ?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
					    
					    <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Department' ) ); ?></label>
                            <div class="controls">
                                <select style="width:100%;" name="deptID" id="select2_14" required>
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('department','','deptID','deptCode','deptName'); ?>
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
                                    <option value="A"><?php _e( _t( 'A Active' ) ); ?></option>
                                    <option value="I"><?php _e( _t( 'I Inactive' ) ); ?></option>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Approved By' ) ); ?></label>
                            <div class="controls">
                                <input type="text" readonly name="approvedBy" value="<?=_h($auth->getPersonField('personID'));?>" class="span6" required />
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
				    <input type="hidden" name="staffID" value="<?=_h($this->person[0]['personID']);?>" />
				    <input type="hidden" name="addDate" value="<?=date("Y-m-d");?>" />
					<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Save' ) ); ?></button>
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