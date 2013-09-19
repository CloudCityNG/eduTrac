<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Add Institution View
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
    <li><a href="<?=BASE_URL;?>institution/<?=bm();?>" class="glyphicons search"><i></i> <?php _e( _t( 'Search Institution' ) ); ?></a></li>
    <li class="divider"></li>
	<li><?php _e( _t( 'Add Institution' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Add Institution' ) ); ?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>institution/runInstitution/" id="validateSubmitForm" method="post" autocomplete="off">
		
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
					<div class="span6">
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="ficeCode"><?php _e( _t( 'FICE Code' ) ); ?></label>
                            <div class="controls"><input class="span12" id="ficeCode" name="ficeCode" type="text" /></div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="instType"><font color="red">*</font> <?php _e( _t( 'Type' ) ); ?></label>
                            <div class="controls">
                                <select style="width:35%" name="instType" id="select2_9">
                                    <option value="">&nbsp;</option>
                                    <option value="HS"><?php _e( _t( 'High School' ) ); ?></option>
                                    <option value="COL"><?php _e( _t( 'College' ) ); ?></option>
                                    <option value="UNIV"><?php _e( _t( 'University' ) ); ?></option>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
					
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="instName"><font color="red">*</font> <?php _e( _t( 'Institution Name' ) ); ?></label>
							<div class="controls"><input class="span12" id="instName" name="instName" type="text" required /></div>
						</div>
						<!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="span6">
					    
					    <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="city"><?php _e( _t( 'City' ) ); ?></label>
                            <div class="controls"><input class="span12" id="city" name="city" type="text" /></div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="state"><?php _e( _t( 'State' ) ); ?></label>
                            <div class="controls"><input class="span12" id="state" name="state" type="text" /></div>
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
                    <button type="button" class="btn btn-icon btn-primary glyphicons circle_minus" onclick="window.location='<?=BASE_URL;?>institution/<?=bm();?>'"><i></i><?php _e( _t( 'Cancel' ) ); ?></button>
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