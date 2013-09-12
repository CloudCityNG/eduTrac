<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Add Faculty View
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

$facID = new \eduTrac\Classes\DBObjects\Person;
$auth = new \eduTrac\Classes\Libraries\Cookies;
?>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>faculty/<?=bm();?>" class="glyphicons search"><i></i> <?php _e( _t( 'Search Faculty' ) ); ?></a></li>
    <li class="divider"></li>
	<li><?php _e( _t( 'View Faculty' ) ); ?></li>
</ul>

<h3><?=get_name(_h($this->faculty[0]['facID']));?> <?php _e( _t( "ID: " ) ); ?><?=_h($this->faculty[0]['facID']);?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>faculty/runEditFaculty/" id="validateSubmitForm" method="post" autocomplete="off">
		
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
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Building' ) ); ?></label>
                            <div class="controls">
                                <select style="width:100%;" name="buildingID" id="select2_11"<?=fio();?> required>
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('building','','buildingID','buildingCode','buildingName',_h($this->faculty[0]['buildingID'])); ?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Office' ) ); ?></label>
                            <div class="controls">
                                <select style="width:100%;" name="officeID" id="select2_12"<?=fio();?>>
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('room','','roomID','roomCode','roomNumber',_h($this->faculty[0]['officeID'])); ?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Office Phone' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="office_phone"<?=fio();?> class="span6" value="<?=_h($this->faculty[0]['office_phone']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="span6">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Department' ) ); ?></label>
                            <div class="controls">
                                <select style="width:100%;" name="deptID" id="select2_13"<?=fio();?> requied>
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('department','','deptID','deptCode','deptName',_h($this->faculty[0]['deptID'])); ?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Approved By' ) ); ?></label>
                            <div class="controls">
                                <input type="text" readonly value="<?=get_name(_h($this->faculty[0]['approvedBy']));?>" class="span6" required />
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
				    <input type="hidden" name="facID" value="<?=_h($this->faculty[0]['facID']);?>" />
					<button type="submit"<?=fids();?> class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Save' ) ); ?></button>
					<button type="button" class="btn btn-icon btn-primary glyphicons circle_minus" onclick="window.location='<?=BASE_URL;?>faculty/<?=bm();?>'"><i></i><?php _e( _t( 'Cancel' ) ); ?></button>
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