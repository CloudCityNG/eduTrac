<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Add Person View
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
?>

<script type="text/javascript">
$(document).ready(function() {
$('#uname').keyup(username_check);
});
    
function username_check(){  
var uname = $('#uname').val();
if(uname == "" || uname.length < 4){
$('#uname').css('border', '3px #CCC solid');
$('#tick').hide();
}else{

jQuery.ajax({
   type: "POST",
   url: "<?=BASE_URL;?>person/runUsernameCheck/",
   data: 'uname='+ uname,
   cache: false,
   success: function(response){
if(response == 1) {
    $('#uname').css('border', '3px #C33 solid'); 
    $('#tick').hide();
    $('#cross').fadeIn();
    }else{
    $('#uname').css('border', '3px #090 solid');
    $('#cross').hide();
    $('#tick').fadeIn();
         }

}
});
}
}
</script>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Name & Address' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Name & Address' ) ); ?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>person/runPerson/" id="validateSubmitForm" method="post" autocomplete="off">
		
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
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Username' ) ); ?></label>
                            <div class="controls">
                                <input type="text" id="uname" name="uname" class="span10" required />
                                <img id="tick" src="<?=BASE_URL;?>static/common/theme/images/tick.png" width="16" height="16"/>
                                <img id="cross" src="<?=BASE_URL;?>static/common/theme/images/cross.png" width="16" height="16"/>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Person Type' ) ); ?></label>
                            <div class="controls">
                                <?=person_type_select();?>
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
                                    <option value="Ms"><?php _e( _t( 'Ms.' ) ); ?></option>
                                    <option value="Miss"><?php _e( _t( 'Miss.' ) ); ?></option>
                                    <option value="Mrs"><?php _e( _t( 'Mrs.' ) ); ?></option>
                                    <option value="Mr"><?php _e( _t( 'Mr.' ) ); ?></option>
                                </select>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><font color="red">*</font> <?php _e( _t( 'First Name' ) ); ?></label>
							<div class="controls">
								<input type="text" name="fname" class="span10" required />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Last Name' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="lname" class="span10" required />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Middle Initial' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="mname" class="span2" />
                            </div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><font color="red">*</font> <?php _e( _t( 'Address1' ) ); ?></label>
							<div class="controls">
								<input type="text" name="address1" class="span10" required />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Address2' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="address2" class="span5" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'City' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="city" class="span5" required />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'State' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="state" class="span2" required /><br />(i.e. enter SC for South Carolina)
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Zip Code' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="zip" class="span5" required />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Country' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="country" class="span2" /><br />(i.e. enter US for United States)
                            </div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="span6">
					
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Phone' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="phone" class="span5" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Primary/Preferred Email' ) ); ?></label>
                            <div class="controls">
                                <input type="email" name="email" class="span5" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Social Security #' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="ssn" class="span5" required/>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Veteran?' ) ); ?></label>
                            <div class="controls">
                                <select name="veteran" style="width:25%" id="select2_11" required>
                                    <option value="1"><?php _e( _t( 'Yes' ) ); ?></option>
                                    <option value="0"><?php _e( _t( 'No' ) ); ?></option>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Ethnicity?' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="ethnicity" class="span6" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Date of Birth' ) ); ?></label>
                            <div class="controls">
                                <div class="input-append date" id="datetimepicker6">
                                    <input id="dob" name="dob" type="text" />
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
                                    <option value="M"><?php _e( _t( 'Male' ) ); ?></option>
                                    <option value="F"><?php _e( _t( 'Female' ) ); ?></option>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Emergency Contact' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="emergency_contact" class="span10" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Emergency Contact Phone' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="emergency_contact_phone" class="span10" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Approved Date' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="approvedDate" value="<?=date("Y-m-d");?>" readonly class="span10" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Approved By' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="approvedBy" value="<?=$auth->getPersonField('personID');?>" readonly class="span5" />
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
                        <p><?php _e( _t( 'After adding a new person, you will need to apply a role to that person in order for him or her to have access 
                        to any screen(s). If you do not have access to assign a person a role, make sure to contact your system administrator as soon as 
                        the new person is added' ) ); ?></p>
                    </div>
                    <div class="modal-footer">
                        <a href="#" data-dismiss="modal" class="btn btn-primary"><?php _e( _t( 'Cancel' ) ); ?></a>
                    </div>
                </div>
				
				<!-- Form actions -->
				<div class="form-actions">
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