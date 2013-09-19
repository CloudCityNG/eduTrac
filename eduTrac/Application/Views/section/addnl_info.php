<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Additional Course Section View
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
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?=BASE_URL?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>section/<?=bm();?>" class="glyphicons search"><i></i> <?php _e( _t( 'Search Section' ) ); ?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>section/view/<?=_h($this->addnl[0]['courseSecID']);?>/<?=bm();?>" class="glyphicons adjust_alt"><i></i> <?=_h($this->addnl[0]['courseSecCode']);?></a></li>
    <li class="divider"></li>
	<li><?php _e( _t( 'View Section' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Additional Section Info:' ) ); ?> <?=_h($this->addnl[0]['courseSecCode']);?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>section/runAddnl/" id="validateSubmitForm" method="post" autocomplete="off">
		
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
							<label class="control-label"><font color="red">*</font> <?php _e( _t( 'Instructor' ) ); ?></label>
							<div class="controls">
							    <select style="width:50%;" name="facID" id="select2_10"<?=csio();?> required>
							        <option value="">&nbsp;</option>
                            	   <?php facID_dropdown($this->addnl[0]['facID']); ?>
                            	</select>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><font color="red">*</font> <?php _e( _t( 'Section Type' ) ); ?></label>
							<div class="controls">
								<select style="width:35%;" name="secType" id="select2_11"<?=csio();?> required>
									<option value="">&nbsp;</option>
	                        		<option value="ONL"<?=selected(_h($this->addnl[0]['secType']),'ONL',false);?>><?php _e( _t( 'ONL Online' ) ); ?></option>
	                        		<option value="HB"<?=selected(_h($this->addnl[0]['secType']),'HB',false);?>><?php _e( _t( 'HB Hybrid' ) ); ?></option>
	                        		<option value="ONC"<?=selected(_h($this->addnl[0]['secType']),'ONC',false);?>><?php _e( _t( 'ONC On-Campus' ) ); ?></option>
	                        	</select>
	                       </div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Instructor Method' ) ); ?></label>
                            <div class="controls">
                                <?=instructor_method($this->addnl[0]['instructorMethod']);?>
                           </div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="span6">
					    
					    <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Contact Hours' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="contactHours"<?=csio();?> value="<?=_h($this->addnl[0]['contactHours']);?>" class="span10" required />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Instructor Load' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="instructorLoad"<?=csio();?> value="<?=_h($this->addnl[0]['instructorLoad']);?>" class="span10" required />
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
					<input type="hidden" name="courseSecID" value="<?=_h($this->addnl[0]['courseSecID']);?>" class="span10" />
					<button type="submit"<?=csids();?> class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Save' ) ); ?></button>
                    <button type="button" class="btn btn-icon btn-primary glyphicons circle_minus" onclick="window.location='<?=BASE_URL;?>section/view/<?=_h($this->addnl[0]['courseSecID']);?>/<?=bm();?>'"><i></i><?php _e( _t( 'Cancel' ) ); ?></button>
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