<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Add Student View
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

$person = new \eduTrac\Classes\DBObjects\Person;
$auth = new \eduTrac\Classes\Libraries\Cookies;
$antGradDate = "05/".date("y",strtotime("+4 years"));
?>

<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('#select2_11').live('change', function(event) {
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
	<li><?php _e( _t( 'Add Student' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Add Student' ) ); ?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>student/runStudent/" id="validateSubmitForm" method="post" autocomplete="off">
		
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
                            <label class="control-label"><?php _e( _t( 'Student Name' ) ); ?></label>
                            <div class="controls">
                                <input type="text" class="span12" readonly value="<?=get_name(_h($this->student[0]['personID']));?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
					
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><font color="red">*</font> <?php _e( _t( 'Program' ) ); ?></label>
							<div class="controls">
								<select style="width:100%;" name="progID" id="select2_11" required>
									<option value="">&nbsp;</option>
                            		<?php table_dropdown('acad_program', '', 'acadProgID', 'acadProgCode', 'acadProgTitle', _h($this->student[0]['acadProgID'])); ?>
                            	</select>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Program Title' ) ); ?></label>
                            <div class="controls">
                                <input type="text" id="acadProgTitle" readonly class="span6" value="<?=_h($this->student[0]['acadProgTitle']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Major' ) ); ?></label>
                            <div class="controls">
                                <input type="text" id="majorName" readonly class="span6" value="<?=_h($this->student[0]['majorName']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Location' ) ); ?></label>
                            <div class="controls">
                                <input type="text" id="locationName" readonly class="span6" value="<?=_h($this->student[0]['locationName']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'School' ) ); ?></label>
                            <div class="controls">
                                <input type="text" id="schoolName" readonly class="span6" value="<?=_h($this->student[0]['schoolName']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Prog Start Date' ) ); ?></label>
                            <div class="controls">
                                <div class="input-append date" id="datetimepicker6">
                                    <input id="startDate" name="startDate" type="text" required />
                                    <span class="add-on"><i class="icon-th"></i></span>
                                </div>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="span6">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Academic Level' ) ); ?></label>
                            <div class="controls">
                                <?=acad_level_select(_h($this->student[0]['acadLevelCode']));?>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Catalog Year' ) ); ?></label>
                            <div class="controls">
                                <select style="width:100%;" name="catYearID" id="select2_13" required>
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('acad_year', '', 'acadYearID', 'acadYearCode', 'acadYearDesc'); ?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Advisor' ) ); ?></label>
                            <div class="controls">
                                <select style="width:100%;" name="advisorID" id="select2_14" required>
                                    <option value="">&nbsp;</option>
                                    <?php facID_dropdown(); ?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Status' ) ); ?></label>
                            <div class="controls">
                                <select style="width:100%;" name="status"<?=sio();?> id="select2_15" required>
                                    <option value="">&nbsp;</option>
                                    <option value="A"><?php _e( _t( 'A Active' ) ); ?></option>
                                    <option value="H"><?php _e( _t( 'H Hiatus' ) ); ?></option>
                                    <option value="L"><?php _e( _t( 'L Leave of Absence' ) ); ?></option>
                                    <option value="W"><?php _e( _t( 'W Withdrawn' ) ); ?></option>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Grad Date' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="antGradDate" class="span2 center" id="antGradDate" value="<?=$antGradDate;?>" readonly required />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Approved By' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="approvedBy" readonly value="<?=$auth->getPersonField('personID');?>" class="span4" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Add Date' ) ); ?></label>
                            <div class="controls">
                                <input id="addDate" name="addDate" type="text" readonly value="<?=date("Y-m-d");?>" />
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
				    <input name="stuID" type="hidden" value="<?=_h($this->student[0]['personID']);?>" />
					<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Save' ) ); ?></button>
                    <button type="button" class="btn btn-icon btn-primary glyphicons circle_minus" onclick="window.location='<?=BASE_URL;?>student/'"><i></i><?php _e( _t( 'Cancel' ) ); ?></button>
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