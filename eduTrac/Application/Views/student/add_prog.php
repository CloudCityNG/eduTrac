<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Add Student Program
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

<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('#select2_10').live('change', function(event) {
        $.ajax({
            type    : 'POST',
            url     : '<?=BASE_URL;?>student/runProgLookup/',
            dataType: 'json',
            data    : $('#validateSubmitForm').serialize(),
            cache: false,
            success: function( data ) {
                   for(var id in data) {        
                          $(id).val( data[id] );
                   }
            }
        });
    });
});
</script>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>student/<?=bm();?>" class="glyphicons search"><i></i> <?php _e( _t( 'Search Student' ) ); ?></a></li>
    <li class="divider"></li>
    <li><a href="<?=BASE_URL;?>student/view/<?=_h($this->student[0]['stuID']);?>/<?=bm();?>" class="glyphicons user"><i></i> <?=get_name(_h($this->student[0]['stuID']));?></a></li>
    <li class="divider"></li>
	<li><?php _e( _t( 'Add Student Program' ) ); ?></li>
</ul>

<h3><?=get_name(_h($this->student[0]['stuID']));?> <?php _e( _t( "ID: " ) ); ?><?=_h($this->student[0]['stuID']);?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>student/runStuProg/" id="validateSubmitForm" method="post" autocomplete="off">
		
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
							<label class="control-label"><?php _e( _t( 'Program' ) ); ?></label>
							<div class="controls">
								<select style="width:100%;" name="progID" id="select2_10">
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('acad_program','','acadProgID','acadProgCode','acadProgTitle');?>
                                </select>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'School' ) ); ?></label>
                            <div class="controls">
                                <input type="text" readonly id="schoolName" class="span12" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Status' ) ); ?></label>
                            <div class="controls">
                                <?=stu_prog_status_select();?>
                            </div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="span6">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Start Date' ) ); ?></label>
                            <div class="controls">
                                <div class="input-append date" id="datetimepicker6">
                                    <input id="startDate" name="startDate" type="text" required/>
                                    <span class="add-on"><i class="icon-th"></i></span>
                                </div>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'End Date' ) ); ?></label>
                            <div class="controls">
                                <div class="input-append date" id="datetimepicker7">
                                    <input id="endDate" name="endDate" type="text" />
                                    <span class="add-on"><i class="icon-th"></i></span>
                                </div>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Approved By' ) ); ?></label>
                            <div class="controls">
                                <input type="text" readonly name="approvedBy" class="span6" value="<?=_h($this->student[0]['stuID']);?>" required />
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
				    <input type="hidden" name="stuID" value="<?=_h($this->student[0]['stuID']);?>" />
					<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Save' ) ); ?></button>
					<button type="button" class="btn btn-icon btn-primary glyphicons circle_minus" onclick="window.location='<?=BASE_URL;?>student/view/<?=$this->student[0]['stuID'];?>/<?=bm();?>'"><i></i><?php _e( _t( 'Cancel' ) ); ?></button>
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