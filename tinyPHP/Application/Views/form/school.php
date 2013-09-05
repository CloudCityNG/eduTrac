<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * School View
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
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>form/runSchool/" id="validateSubmitForm" method="post" autocomplete="off">
		
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
					<div class="span12">
					    
					    <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="schoolName"><font color="red">*</font> <?php _e( _t( 'School Name' ) ); ?></label>
                            <div class="controls"><input class="span12" id="schoolName" name="schoolName" type="text" required /></div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="schoolCode"><font color="red">*</font> <?php _e( _t( 'School Code' ) ); ?></label>
                            <div class="controls"><input class="span12" id="schoolCode" name="schoolCode" type="text" required /></div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="buildingCode"><?php _e( _t( 'Building' ) ); ?></label>
							<div class="controls">
								<select style="width:100%" name="buildingCode" id="select2_10">
									<option value="">&nbsp;</option>
                            		<?php table_dropdown('building', 'buildingCode', 'buildingName'); ?>
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
                        <th class="center"><?php _e( _t( 'School Code' ) ); ?></th>
                        <th class="center"><?php _e( _t( 'School Name' ) ); ?></th>
                        <th class="center"><?php _e( _t( 'Building' ) ); ?></th>
                        <th class="center"><?php _e( _t( 'Actions' ) ); ?></th>
                    </tr>
                </thead>
                <!-- // Table heading END -->
                
                <!-- Table body -->
                <tbody>
                <?php if($this->schoolList != '') : foreach($this->schoolList as $key => $value) { ?>
                <tr class="gradeX">
                    <td class="center"><?=_h($value['schoolCode']);?></td>
                    <td class="center"><?=_h($value['schoolName']);?></td>
                    <td class="center"><?=_h($value['buildingCode']);?></td>
                    <td class="center">
                        <a href="<?=BASE_URL;?>form/view_school/<?=_h($value['schoolID']);?>/<?=bm();?>" title="View School" class="btn btn-circle"><i class="icon-eye-open"></i></a>
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