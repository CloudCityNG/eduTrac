<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * View Term View
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
	<li><?php _e( _t( 'You are here') ); ?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
    <li><a href="<?=BASE_URL;?>form/term/<?=bm();?>" class="glyphicons pin_flag"><i></i> <?php _e( _t( 'Term' ) ); ?></a></li>
    <li class="divider"></li>
	<li><?php _e( _t( 'View Term' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'View Term' ) ); ?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>form/runEditTerm/" id="validateSubmitForm" method="post" autocomplete="off">
		
		<!-- Widget -->
		<div class="widget widget-heading-simple widget-body-gray">
		
			<!-- Widget heading -->
			<div class="widget-head">
				<h4 class="heading"><?php _e( _t( 'Indicates field is required' ) ); ?></h4>
			</div>
			<!-- // Widget heading END -->
			
			<div class="widget-body">
			
				<!-- Row -->
				<div class="row-fluid">
					
					<!-- Column -->
					<div class="span6">
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="semCode"><font color="red">*</font> <?php _e( _t( 'Semester' ) ); ?></label>
							<div class="controls">
								<select style="width:100%" name="semesterID" id="select2_10"<?=gio();?> required>
									<option value="">&nbsp;</option>
                            		<?php table_dropdown("semester", "", "semesterID", "semCode", "semName", _h($this->term[0]['semesterID'])); ?>
                            	</select>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="termCode"><?php _e( _t( 'Term Code' ) ); ?></label>
                            <div class="controls"><input class="span12"<?=gio();?> name="termCode" type="text" value="<?=_h($this->term[0]['termCode']);?>" /></div>
                        </div>
                        <!-- // Group END -->
					
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="termName"><font color="red">*</font> <?php _e( _t( 'Term' ) ); ?></label>
							<div class="controls"><input class="span12" id="termName"<?=gio();?> name="termName" type="text" value="<?=_h($this->term[0]['termName']);?>" required /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="reportingTerm"><font color="red">*</font> <?php _e( _t( 'Reporting Term' ) ); ?></label>
                            <div class="controls"><input class="span12" id="reportingTerm"<?=gio();?> name="reportingTerm" type="text" value="<?=_h($this->term[0]['reportingTerm']);?>" required /></div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="span6">
					    
					    <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="termStartDate"><font color="red">*</font> <?php _e( _t( 'Start Date' ) ); ?></label>
                            <div class="controls">
                                <div class="input-append date" id="datetimepicker6">
                                    <input id="termStartDate"<?=gio();?> name="termStartDate" type="text" value="<?=_h($this->term[0]['termStartDate']);?>" />
                                    <span class="add-on"><i class="icon-th"></i></span>
                                </div>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="termEndDate"><font color="red">*</font> <?php _e( _t( 'End Date' ) ); ?></label>
							<div class="controls">
								<div class="input-append date" id="datetimepicker7">
						    		<input id="termEndDate"<?=gio();?> name="termEndDate" type="text" value="<?=_h($this->term[0]['termEndDate']);?>" />
				    				<span class="add-on"><i class="icon-th"></i></span>
								</div>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="term"><font color="red">*</font> <?php _e( _t( 'Active' ) ); ?></label>
							<div class="controls">
								<select style="width:25%;" name="active" id="select2_11"<?=gio();?> required>
									<option value="">&nbsp;</option>
                            		<option value="1"<?php if($this->term[0]['active'] == '1') { echo 'selected="selected"'; } ?>><?php _e( _t( 'Yes' ) ); ?></option>
                            		<option value="0"<?php if($this->term[0]['active'] == '0') { echo 'selected="selected"'; } ?>><?php _e( _t( 'No' ) ); ?></option>
                            	</select>
							</div>
						</div>
						<!-- // Group END -->
					</div>
					
				</div>
				<!-- // Row END -->
			
				<hr class="separator" />
				
				<!-- Form actions -->
				<div class="form-actions">
					<input name="termID"<?=gids();?> type="hidden" value="<?=_h($this->term[0]['termID']);?>" />
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