<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * View School View
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

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here') ); ?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>form/school/<?=bm();?>" class="glyphicons pin_flag"><i></i> <?php _e( _t( 'School' ) ); ?></a></li>
    <li class="divider"></li>
	<li><?php _e( _t( 'View School' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'View School' ) ); ?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>form/runEditSchool/" id="validateSubmitForm" method="post" autocomplete="off">
		
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
                            <label class="control-label" for="schoolCode"><font color="red">*</font> <?php _e( _t( 'School Code' ) ); ?></label>
                            <div class="controls"><input class="span12" id="schoolCode"<?=gio();?> name="schoolCode" type="text" value="<?=$this->school[0]['schoolCode'];?>" required /></div>
                        </div>
                        <!-- // Group END -->
					    
					    <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="schoolName"><font color="red">*</font> <?php _e( _t( 'School Name' ) ); ?></label>
                            <div class="controls"><input class="span12" id="schoolName"<?=gio();?> name="schoolName" type="text" value="<?=$this->school[0]['schoolName'];?>" required /></div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="buildingCode"><?php _e( _t( 'Building' ) ); ?></label>
							<div class="controls">
								<select style="width:100%" name="buildingID" id="select2_10"<?=gio();?>>
									<option value="">&nbsp;</option>
                            		<?php table_dropdown('building', '', 'buildingID', 'buildingCode', 'buildingName',$this->school[0]['buildingID']); ?>
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
				    <input name="schoolID" type="hidden" value="<?=$this->school[0]['schoolID'];?>" />
					<button type="submit"<?=gids();?> class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Submit' ) ); ?></button>
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