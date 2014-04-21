<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Add Section View
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

if($this->crse != '') : foreach($this->crse as $k => $v) {
    $crse = new \eduTrac\Classes\DBObjects\Course;
    $crse->Load_from_key($v['courseID']);
?>

<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('#term').live('change', function(event) {
        $.ajax({
            type    : 'POST',
            url     : '<?=BASE_URL;?>section/runSecTermLookup/',
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
$(function(){
    $('#sectionNumber').keyup(function() {
        $('#section').text($(this).val());
    });
});
</script>

<ul class="breadcrumb">
	<li><?=_t( 'You are here' );?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>section/<?=bm();?>" class="glyphicons search"><i></i> <?=_t( 'Search Section' );?></a></li>
	<li class="divider"></li>
	<li><?=_t( 'Create Section' );?></li>
</ul>

<h3><?=$v['courseCode'];?>-<sec id="section"></sec></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>section/runSection/" id="validateSubmitForm" method="post" autocomplete="off">
		
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
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Section' );?></label>
                            <div class="col-md-8">
                                <input type="text" name="sectionNumber" id="sectionNumber" class="form-control" required/>
                            </div>
                        </div>
                        <!-- // Group END -->
					
						<!-- Group -->
						<div class="form-group">
							<label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Term' );?></label>
							<div class="col-md-8">
								<select name="termCode" id="term" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" required>
									<option value="">&nbsp;</option>
                            		<?php table_dropdown('term', 'termCode <> "NULL"', 'termCode', 'termCode', 'termName'); ?>
                            	</select>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Section Start/End' );?></label>
                            <div class="col-md-8">
                                <div class="input-group date col-md-6" id="datepicker6">
                                    <input class="form-control"<?=csio();?> id="startDate" name="startDate" type="text" required />
                                    <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                </div>
                                
                                <div class="input-group date col-md-6" id="datepicker7">
                                    <input class="form-control"<?=csio();?> id="endDate" name="endDate" type="text" required />
                                    <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                </div>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Department' );?></label>
                            <div class="col-md-8">
                                <select name="deptCode" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" required>
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('department', 'deptTypeCode = "acad" AND deptCode <> "NULL"', 'deptCode', 'deptCode', 'deptName', _h($crse->getDeptCode())); ?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Credits' );?></label>
                            <div class="col-md-8">
                                <input type="text" name="minCredit" readonly="readonly" class="form-control" value="<?=_h($crse->getMinCredit());?>" required/>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'CEU\'s' );?></label>
                            <div class="col-md-8">
                                <input type="text" name="ceu" readonly="readonly" class="form-control" />
                            </div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Course Level' );?></label>
                            <div class="col-md-8">
                                <?=course_level_select(_h($crse->getCourseLevelCode()));?>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Academic Level' );?></label>
                            <div class="col-md-8">
                                <?=acad_level_select(_h($crse->getAcadLevelCode()),null,'required');?>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Short Title' );?></label>
                            <div class="col-md-8">
                                <input type="text" name="secShortTitle" readonly="readonly" class="form-control" value="<?=_h($crse->getCourseShortTitle());?>" maxlength="25" required/>
                            </div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="col-md-6">
					    
					    <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Location' );?></label>
                            <div class="col-md-8">
                                <select name="locationCode" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" required>
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('location', 'locationCode <> "NULL"', 'locationCode', 'locationCode', 'locationName'); ?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Status' );?></label>
                            <div class="col-md-8">
                                <?=course_sec_status_select();?>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Status Date' );?></label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" readonly="readonly" value="<?=date("Y-m-d");?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Approval Person' );?></label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" readonly value="<?=get_name($auth->getPersonField('personID'));?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="col-md-3 control-label"><?=_t( 'Approval Date' );?></label>
							<div class="col-md-8">
								<input type="text" readonly="readonly" value="<?=date('Y-m-d');?>" class="form-control" />
							</div>
						</div>
						<!-- // Group END -->
						
					</div>
					<!-- // Column END -->
				</div>
				<!-- // Row END -->
			
				<hr class="separator" />
				
				<div class="separator line bottom"></div>
				
				<!-- Form actions -->
				<div class="form-actions">
				    <input type="hidden" name="courseID" value="<?=_h($v['courseID']);?>" />
				    <input type="hidden" name="courseCode" value="<?=_h($v['courseCode']);?>" />
				    <input type="hidden" name="statusDate" value="<?=date("Y-m-d");?>" />
				    <input type="hidden" name="approvedBy" value="<?=$auth->getPersonField('personID');?>" />
				    <input type="hidden" name="approvedDate" value="<?=date('Y-m-d');?>" />
					<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=_t( 'Save' );?></button>
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
<?php
} endif;