<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * NSLC Correction View
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

<ul class="breadcrumb">
	<li><?=_t( 'You are here' );?></li>
	<li><a href="<?=BASE_URL?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
	<li class="divider"></li>
	<li><?=_t( 'NSLC Hold File Record' );?></li>
</ul>

<h3><?=get_name(_h($this->correct[0]['stuID']));?> <?=_t( "ID: " );?><?=_h($this->correct[0]['stuID']);?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="#" id="validateSubmitForm" method="post" autocomplete="off">
		
		<!-- Widget -->
		<div class="widget widget-heading-simple widget-body-gray">
		
			<!-- Widget heading -->
			<div class="widget-head">
				<h4 class="heading"><font color="red">*</font> <?=_t( 'Indicates field is required' );?></h4>
			</div>
			<!-- // Widget heading END -->
			
			<div class="widget-body">
			
				<!-- Row -->
				<div class="row-fluid">
					<!-- Column -->
					<div class="span6">
					
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><font color="red">*</font> <?=_t( 'Address' );?></label>
							<div class="controls">
							    <input type="text" name="address1" value="<?=_h($this->correct[0]['address1']);?>" class="span12" required />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?=_t( 'City' );?></label>
                            <div class="controls">
                                <input type="text" name="city" value="<?=_h($this->correct[0]['city']);?>" class="span12" required />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?=_t( 'State' );?></label>
                            <div class="controls">
                                <input type="text" name="zip" value="<?=_h($this->correct[0]['zip']);?>" class="span12" required />
                            </div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="span6">
					    
					    <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?=_t( 'Country' );?></label>
                            <div class="controls">
                                <input type="text" name="country" value="<?=_h($this->correct[0]['country']);?>" class="span12" required />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?=_t( 'SSN' );?></label>
                            <div class="controls">
                                <input type="text" name="ssn" value="<?=_h($this->correct[0]['ssn']);?>" class="span12" required />
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