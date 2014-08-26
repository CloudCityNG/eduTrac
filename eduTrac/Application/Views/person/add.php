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
 * @since       3.0.0
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
	<li><?=_t( 'You are here' );?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
	<li class="divider"></li>
	<li><?=_t( 'Name & Address' );?></li>
</ul>

<h3><?=_t( 'Name & Address' );?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>person/runPerson/" id="validateSubmitForm" method="post" autocomplete="off">
		
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
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Username' );?></label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" id="uname" name="uname" required/>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Person Type' );?> <a href="#myModal" data-toggle="modal"><img src="<?=BASE_URL;?>static/common/theme/images/help.png" /></a></label>
                            <div class="col-md-8">
                                <?=person_type_select();?>
                            </div>
                        </div>
                        <!-- // Group END -->
					
						<!-- Group -->
						<div class="form-group">
							<label class="col-md-3 control-label"><?=_t( 'Prefix' );?></label>
							<div class="col-md-8">
								<select name="prefix" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true">
                                    <option value="">&nbsp;</option>
                                    <option value="Ms"><?=_t( 'Ms.' );?></option>
                                    <option value="Miss"><?=_t( 'Miss.' );?></option>
                                    <option value="Mrs"><?=_t( 'Mrs.' );?></option>
                                    <option value="Mr"><?=_t( 'Mr.' );?></option>
                                </select>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'First Name' );?></label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="fname" required/>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Last Name' );?></label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="lname" required/>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Middle Initial' );?></label>
                            <div class="col-md-2">
                                <input class="form-control" type="text" name="mname" />
                            </div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Address1' );?></label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="address1" required/>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Address2' );?></label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" name="address2" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'City' );?></label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="city" required />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'State' );?></label>
                            <div class="col-md-8">
                                <select name="state" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" required>
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('state','','code','code','name'); ?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Zip Code' );?></label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="zip" required/>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Country' );?></label>
                            <div class="col-md-8">
                                <select name="country" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" >
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('country','','iso2','iso2','short_name'); ?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="col-md-6">
					
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Phone' );?></label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" name="phone" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Preferred Email' );?></label>
                            <div class="col-md-6">
                                <input class="form-control" type="email" name="email" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Social Security #' );?></label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" name="ssn" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Veteran?' );?></label>
                            <div class="col-md-8">
                                <select name="veteran" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" required>
                                    <option value="1"><?=_t( 'Yes' );?></option>
                                    <option value="0"><?=_t( 'No' );?></option>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Ethnicity?' );?></label>
                            <div class="col-md-8">
                                <select name="ethnicity" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" >
                                    <option value="">&nbsp;</option>
                                    <option value="White, Non-Hispanic"><?=_t( 'White, Non-Hispanic' );?></option>
                                    <option value="Black, Non-Hispanic"><?=_t( 'Black, Non-Hispanic' );?></option>
                                    <option value="Hispanic"><?=_t( 'Hispanic' );?></option>
                                    <option value="Native American"><?=_t( 'Native American' );?></option>
                                    <option value="Native Alaskan"><?=_t( 'Native Alaskan' );?></option>
                                    <option value="Pacific Islander"><?=_t( 'Pacific Islander' );?></option>
                                    <option value="Asian"><?=_t( 'Asian' );?></option>
                                    <option value="Indian"><?=_t( 'Indian' );?></option>
                                    <option value="Middle Eastern"><?=_t( 'Middle Eastern' );?></option>
                                    <option value="African"><?=_t( 'African' );?></option>
                                    <option value="Mixed Race"><?=_t( 'Mixed Race' );?></option>
                                    <option value="Other"><?=_t( 'Other' );?></option>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Date of Birth' );?></label>
                            <div class="col-md-8">
                                <div class="input-group date col-md-8" id="datepicker6">
                                    <input class="form-control" name="dob" type="text" />
                                    <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                </div>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Gender' );?></label>
                            <div class="col-md-8">
                                <select name="gender" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true">
                                    <option value="">&nbsp;</option>
                                    <option value="M"><?=_t( 'Male' );?></option>
                                    <option value="F"><?=_t( 'Female' );?></option>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Emergency Contact' );?></label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="emergency_contact" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Emergency Contact Phone' );?></label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="emergency_contact_phone" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Approved Date' );?></label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" value="<?=date('D, M d, o',strtotime(date("Y-m-d")));?>" readonly/>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Approved By' );?></label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" value="<?=get_name($auth->getPersonField('personID'));?>" readonly/>
                            </div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
				</div>
				<!-- // Row END -->
			
				<hr class="separator" />
				
				<div class="modal fade" id="myModal">
					<div class="modal-dialog">
						<div class="modal-content">
							<!-- Modal heading -->
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h3 class="modal-title"><?=_t( 'Person Type' );?></h3>
							</div>
							<!-- // Modal heading END -->
		                    <div class="modal-body">
		                        <?=file_get_contents( APP_PATH . 'Info/person-type.txt' );?>
		                    </div>
		                    <div class="modal-footer">
		                        <a href="#" data-dismiss="modal" class="btn btn-primary"><?=_t( 'Cancel' );?></a>
		                    </div>
	                   	</div>
                  	</div>
                </div>
				
				<!-- Form actions -->
				<div class="form-actions">
				    <input type="hidden" name="approvedDate" value="<?=date("Y-m-d");?>" />
				    <input type="hidden" name="approvedBy" value="<?=$auth->getPersonField('personID');?>" />
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