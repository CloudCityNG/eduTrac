<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Add Address View
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
	<li><a href="<?=BASE_URL;?>person/<?=bm();?>" class="glyphicons search"><i></i> <?php _e( _t( 'Search Person' ) ); ?></a></li>
    <li class="divider"></li>
    <li><a href="<?=BASE_URL;?>person/view/<?=_h($this->person[0]['personID']);?>/<?=bm();?>" class="glyphicons user"><i></i> <?=get_name(_h((int)$this->person[0]['personID']));?></a></li>
    <li class="divider"></li>
    <li><a href="<?=BASE_URL;?>person/addr_sum/<?=_h($this->person[0]['personID']);?>/<?=bm();?>" class="glyphicons vcard"><i></i> <?php _e( _t( 'Address Summary' ) ); ?></a></li>
    <li class="divider"></li>
	<li><?php _e( _t( 'Edit Address' ) ); ?></li>
</ul>

<h3><?=get_name(_h((int)$this->person[0]['personID']));?> <?php _e( _t( "ID: " ) ); ?><?=_h($this->person[0]['personID']);?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>person/runAddAddress/" id="validateSubmitForm" method="post" autocomplete="off">
		
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
							<label class="control-label"><?php _e( _t( 'First Name' ) ); ?></label>
							<div class="controls">
								<input type="text" disabled class="span10" value="<?=_h($this->person[0]['fname']);?>" />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Last Name' ) ); ?></label>
                            <div class="controls">
                                <input type="text" disabled class="span10" value="<?=_h($this->person[0]['lname']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Middle Initial' ) ); ?></label>
                            <div class="controls">
                                <input type="text" disabled class="span2" value="<?=_h($this->person[0]['mname']);?>" />
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
                                <select name="state" style="width:50%" id="select2_13" required>
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('state','','code','code','name'); ?>
                                </select>
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
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="span6">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Country' ) ); ?></label>
                            <div class="controls">
                                <select name="country" style="width:80%" id="select2_14">
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('country','','iso2','iso2','short_name'); ?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Address Type' ) ); ?></label>
                            <div class="controls">
                                <?=address_type_select();?>
                            </div>
                        </div>
                        <!-- // Group END -->
					
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Start Date' ) ); ?></label>
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
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Status' ) ); ?></label>
                            <div class="controls">
                               <?=address_status_select();?>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Add Date' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="addDate" disabled class="span5" value="<?=date("Y-m-d");?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Added By' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="addedBy" disabled class="span5" value="<?=_h($auth->getPersonField('personID'));?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
				</div>
				<!-- // Row END -->
			
				<hr class="separator" />
            
            <div class="widget-body">		
				<!-- Row -->
                <div class="row-fluid">
                    <!-- Column -->
                    <div class="span4">
                        
        				<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Phone' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="phone1" class="span8" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    
                    <!-- Column -->
                    <div class="span4">
                        
                        <!-- Group -->
                        <div class="control-group">
                            
                            <label class="control-label"><?php _e( _t( 'Extension' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="ext1" class="span8" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    
                    <!-- Column -->
                    <div class="span4">
                        
                        <!-- Group -->
                        <div class="control-group">
                            
                            <label class="control-label"><?php _e( _t( 'Type' ) ); ?></label>
                            <div class="controls">
                                <select name="phoneType1" style="width:66%" id="select2_11">
                                    <option value="">&nbsp;</option>
                                    <option value="BUS"><?php _e( _t( 'Business' ) ); ?></option>
                                    <option value="CEL"><?php _e( _t( 'Cellular' ) ); ?></option>
                                    <option value="H"><?php _e( _t( 'Home' ) ); ?></option>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                </div>
                <!-- Row End -->
                
                <!-- Row -->
                <div class="row-fluid">
                    <!-- Column -->
                    <div class="span4">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Phone' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="phone2" class="span8" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    
                    <!-- Column -->
                    <div class="span4">
                        
                        <!-- Group -->
                        <div class="control-group">
                            
                            <label class="control-label"><?php _e( _t( 'Extension' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="ext2" class="span8" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    
                    <!-- Column -->
                    <div class="span4">
                        
                        <!-- Group -->
                        <div class="control-group">
                            
                            <label class="control-label"><?php _e( _t( 'Type' ) ); ?></label>
                            <div class="controls">
                                <select name="phoneType2" style="width:66%" id="select2_12">
                                    <option value="">&nbsp;</option>
                                    <option value="BUS"><?php _e( _t( 'Business' ) ); ?></option>
                                    <option value="CEL"><?php _e( _t( 'Cellular' ) ); ?></option>
                                    <option value="H"><?php _e( _t( 'Home' ) ); ?></option>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                </div>
                <!-- Row End -->
            </div>
            
                <hr class="separator" />
                
            <div class="widget-body">       
                <!-- Row -->
                <div class="row-fluid">
                    <!-- Column -->
                    <div class="span12">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Primary Email' ) ); ?></label>
                            <div class="controls">
                                <input type="email" disabled class="span6" value="<?=_h($this->person[0]['email']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                </div>
                <!-- Row End -->
                
                <!-- Row -->
                <div class="row-fluid">
                    <!-- Column -->
                    <div class="span12">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Secondary Email' ) ); ?></label>
                            <div class="controls">
                                <input type="email" name="email2" class="span6" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                </div>
                <!-- Row End -->
            </div>
				
				<hr class="separator" />
				
				<!-- Form actions -->
				<div class="form-actions">
				    <input type="hidden" name="personID" value="<?=_h($this->person[0]['personID']);?>" />
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