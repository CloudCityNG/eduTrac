<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * View Section View
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

$sec = new \eduTrac\Classes\DBObjects\Course;
$sec->Load_from_key($this->sec[0]['courseID']);
$list = '"'.implode('","', _h($sec->getpreReq())).'"';
?>

<script type="text/javascript">
$(function() {
    $("#select2_course").select2({tags:[<?=$list;?>]});
});
</script>

<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('#select2_10').live('change', function(event) {
        $.ajax({
            type    : 'POST',
            url     : '<?=BASE_URL;?>section/runTermLookup/',
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
	<li><a href="<?=BASE_URL;?>section/<?=bm();?>" class="glyphicons search"><i></i> <?php _e( _t( 'Search Section' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'View Section' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Section' ) ); ?> <?=_h($this->sec[0]['courseSecCode']);?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>section/runEditSection/" id="validateSubmitForm" method="post" autocomplete="off">
		
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
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Section' ) ); ?></label>
                            <div class="controls">
                                <input type="text" readonly class="span3" value="<?=_h($this->sec[0]['sectionNumber']);?>" required/>
                            </div>
                        </div>
                        <!-- // Group END -->
					
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><font color="red">*</font> <?php _e( _t( 'Term' ) ); ?></label>
							<div class="controls">
								<select style="width:100%;" name="termID" id="select2_10"<?=csio();?> required>
									<option value="">&nbsp;</option>
                            		<?php table_dropdown('term', '', 'termID', 'termCode', 'termName',_h($this->sec[0]['termID'])); ?>
                            	</select>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Section Start/End' ) ); ?></label>
                            <div class="controls">
                                <div class="input-append date" id="datetimepicker6">
                                    <input id="startDate"<?=csio();?> name="startDate" type="text" value="<?=_h($this->sec[0]['startDate']);?>" required />
                                    <span class="add-on"><i class="icon-th"></i></span>
                                </div>
                                
                                <div class="input-append date" id="datetimepicker7">
                                    <input id="endDate"<?=csio();?> name="endDate" type="text" value="<?=_h($this->sec[0]['endDate']);?>" required />
                                    <span class="add-on"><i class="icon-th"></i></span>
                                </div>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Department' ) ); ?></label>
                            <div class="controls">
                                <select style="width:100%;" name="deptID" id="select2_11"<?=csio();?> required>
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('department', '', 'deptID', 'deptCode', 'deptName', _h($this->sec[0]['deptID'])); ?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Credits' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="minCredit"<?=csio();?> class="span4" value="<?=_h($this->sec[0]['minCredit']);?>" required/>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'CEU\'s' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="ceu" readonly class="span4" value="<?=_h($this->sec[0]['ceu']);?>" required/>
                            </div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Course Level' ) ); ?></label>
                            <div class="controls">
                                <?=course_level_select(_h($this->sec[0]['courseLevelCode']));?>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Academic Level' ) ); ?></label>
                            <div class="controls">
                                <?=acad_level_select(_h($this->sec[0]['acadLevelCode']));?>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Short Title' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="secShortTitle" readonly class="span10" value="<?=_h($this->sec[0]['secShortTitle']);?>" required/>
                            </div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="span6">
					    
					    <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Location' ) ); ?></label>
                            <div class="controls">
                                <select style="width:100%;" name="locationID" id="select2_12"<?=csio();?> required>
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('location', '', 'locationID', 'locationCode', 'locationName', _h($this->sec[0]['locationID'])); ?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Status' ) ); ?></label>
                            <div class="controls">
                                <?=course_sec_status_select(_h($this->sec[0]['currStatus']));?>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Status Date' ) ); ?></label>
                            <div class="controls">
                                <input id="statusDate" name="statusDate" type="text" readonly value="<?=_h($this->sec[0]['statusDate']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Prerequisites' ) ); ?></label>
                            <div class="controls">
                                <input type="text" id="select2_course" disabled value="<?=_h($sec->getpreReq());?>" class="span10" />
                            </div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Approval Person' ) ); ?></label>
                            <div class="controls">
                                <input id="approvedBy" type="text" readonly value="<?=get_name(_h($this->sec[0]['approvedBy']));?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><?php _e( _t( 'Approval Date' ) ); ?></label>
							<div class="controls">
								<input type="text" name="approvedDate" readonly value="<?=_h($this->sec[0]['approvedDate']);?>" class="span10" />
							</div>
						</div>
						<!-- // Group END -->
						
					</div>
					<!-- // Column END -->
				</div>
				<!-- // Row END -->
			
				<hr class="separator" />
				
				<div class="separator line bottom"></div>
				
				<!-- Column -->
                    <div class="span4">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Additional Info' ) ); ?></label>
                            <div class="controls">
                                <input type="text" disabled value="X" class="span1 center" />
                                <a href="<?=BASE_URL;?>section/addnl_info/<?=_h($this->sec[0]['courseSecID']);?>/<?=bm();?>">
                                    <img src="<?=BASE_URL;?>static/common/theme/images/cascade.png" />
                                </a>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                <!-- // Column End -->
                
                <!-- Column -->
                    <div class="span4">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Offering Info' ) ); ?></label>
                            <div class="controls">
                                <input type="text" disabled value="" class="span1 center" />
                                <!-- <a href="<?=BASE_URL;?>section/soff_info/<?=_h($this->sec[0]['courseSecID']);?>/<?=bm();?>">
                                    <img src="<?=BASE_URL;?>static/common/theme/images/cascade.png" />
                                </a> -->
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                <!-- // Column End -->
                
                <!-- Column -->
                    <div class="span4">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Billing Info' ) ); ?></label>
                            <div class="controls">
                                <input type="text" disabled value="X" class="span1 center" />
                                <a href="#">
                                    <img src="<?=BASE_URL;?>static/common/theme/images/cascade.png" />
                                </a>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                <!-- // Column End -->
                
                <hr class="separator" />
                
                <div class="separator line bottom"></div>
				
				<!-- Form actions -->
				<div class="form-actions">
				    <input type="hidden" name="courseSecID" value="<?=_h($this->sec[0]['courseSecID']);?>" />
					<button type="submit"<?=csids();?> class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Save' ) ); ?></button>
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