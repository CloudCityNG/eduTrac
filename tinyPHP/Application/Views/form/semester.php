<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Semester View
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
	<li><?php _e( _t( 'Semester' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Semester' ) ); ?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>form/runSemester/" id="validateSubmitForm" method="post" autocomplete="off">
		
		<!-- Widget -->
		<div class="widget widget-heading-simple widget-body-gray">
		
			<!-- Widget heading -->
			<div class="widget-head">
				<h4 class="heading"><font color="red">*</font> <?php _e( _t( 'Indicates field is required.' ) ); ?></h4>
			</div>
			<!-- // Widget heading END -->
			
			<div class="widget-body">
			
				<!-- Row -->
				<div class="row-fluid">
					
					<!-- Column -->
					<div class="span6">
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="acadYearID"><font color="red">*</font> <?php _e( _t( 'Acad Year' ) ); ?></label>
							<div class="controls">
								<select style="width:100%" name="acadYearCode" id="select2_10" required>
									<option value="">&nbsp;</option>
                            		<?php table_dropdown('acad_year', 'acadYearCode', 'acadYearDesc'); ?>
                            	</select>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="semCode"><font color="red">*</font> <?php _e( _t( 'Semester Code' ) ); ?></label>
                            <div class="controls"><input class="span12" id="semCode" name="semCode" type="text" required /></div>
                        </div>
                        <!-- // Group END -->
					
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="semName"><font color="red">*</font> <?php _e( _t( 'Semester' ) ); ?></label>
							<div class="controls"><input class="span12" id="semName" name="semName" type="text" required /></div>
						</div>
						<!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="span6">
					    
					    <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="semStartDate"><font color="red">*</font> <?php _e( _t( 'Start Date' ) ); ?></label>
                            <div class="controls">
                                <div class="input-append date" id="datetimepicker6">
                                    <input id="semStartDate" name="semStartDate" type="text" required />
                                    <span class="add-on"><i class="icon-th"></i></span>
                                </div>
                            </div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="semEndDate"><font color="red">*</font> <?php _e( _t( 'End Date' ) ); ?></label>
							<div class="controls">
								<div class="input-append date" id="datetimepicker8">
						    		<input id="semEndDate" name="semEndDate" type="text" required />
				    				<span class="add-on"><i class="icon-th"></i></span>
								</div>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="active"><font color="red">*</font> <?php _e( _t( 'Active' ) ); ?></label>
							<div class="controls">
								<select style="width:25%" name="active" id="select2_11" required>
									<option value="">&nbsp;</option>
                            		<option value="1"><?php _e( _t( 'Yes' ) ); ?></option>
                            		<option value="0"><?php _e( _t( 'No' ) ); ?></option>
                            	</select>
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
					<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Submit' ) ); ?></button>
				</div>
				<!-- // Form actions END -->
				
			</div>
			
		</div>
		<!-- // Widget END -->
		
	</form>
	<!-- // Form END -->
	
	<div class="separator bottom"></div>
	
	<!-- Widget -->
    <div class="widget widget-heading-simple widget-body-white">
        <div class="widget-body">
        
            <!-- Table -->
            <table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-primary">
            
                <!-- Table heading -->
                <thead>
                    <tr>
                        <th class="center"><?php _e( _t( 'Semester' ) ); ?></th>
                        <th class="center"><?php _e( _t( 'Start Date' ) ); ?></th>
                        <th class="center"><?php _e( _t( 'End Date' ) ); ?></th>
                        <th class="center"><?php _e( _t( 'Status' ) ); ?></th>
                        <th class="center"><?php _e( _t( 'Actions' ) ); ?></th>
                    </tr>
                </thead>
                <!-- // Table heading END -->
                
                <!-- Table body -->
                <tbody>
                <?php if($this->semesterList != '') : foreach($this->semesterList as $key => $value) { ?>
                <tr class="gradeX">
                    <td class="center"><?=_h($value['semName']);?></td>
                    <td class="center"><?=date('D, M d, o',strtotime(_h($value['semStartDate'])));?></td>
                    <td class="center"><?=date('D, M d, o',strtotime(_h($value['semEndDate'])));?></td>
                    <td class="center"><?php if($value['active'] == 1) {echo 'Active';}else{'Inactive';} ?></td>
                    <td class="center">
                        <a href="<?=BASE_URL;?>form/view_semester/<?=_h($value['semesterID']);?>/<?=bm();?>" title="View Semester" class="btn btn-circle"><i class="icon-eye-open"></i></a>
                    </td>
                </tr>
                <?php } endif; ?>
                    
                </tbody>
                <!-- // Table body END -->
                
            </table>
            <!-- // Table END -->
            
        </div>
    </div>
    <!-- // Widget END -->
	
</div>	
	
		
		</div>
		<!-- // Content END -->