<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * View Institution View
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
	<li><?=_t( 'You are here');?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
	<li class="divider"></li>
    <li><a href="<?=BASE_URL;?>institution/<?=bm();?>" class="glyphicons search"><i></i> <?=_t( 'Search Institution' );?></a></li>
    <li class="divider"></li>
	<li><?=_t( 'View Institution' );?></li>
</ul>

<h3><?=_t( 'View Institution' );?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>institution/runEditInstitution/" id="validateSubmitForm" method="post" autocomplete="off">
		
		<!-- Widget -->
		<div class="widget widget-heading-simple widget-body-gray">
		
			<!-- Widget heading -->
			<div class="widget-head">
				<h4 class="heading"><font color="red">*</font> <?=_t( 'Indicates field is required.' );?></h4>
			</div>
			<!-- // Widget heading END -->
			
			<div class="widget-body">
			
				<!-- Row -->
				<div class="row">
					
					<!-- Column -->
					<div class="col-md-6">
						
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'FICE/CEEB Code' );?></label>
                            <div class="col-md-8"><input class="form-control" name="fice_ceeb"<?=gio();?> type="text" value="<?=_h($this->inst[0]['fice_ceeb']);?>" required/></div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Type' );?></label>
                            <div class="col-md-8">
                                <select name="instType"<?=gio();?> class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true">
                                    <option value="">&nbsp;</option>
                                    <option value="HS"<?=selected('HS',_h($this->inst[0]['instType']),false);?>><?=_t( 'HS High School' );?></option>
                                    <option value="COL"<?=selected('COL',_h($this->inst[0]['instType']),false);?>><?=_t( 'COL College' );?></option>
                                    <option value="UNIV"<?=selected('UNIV',_h($this->inst[0]['instType']),false);?>><?=_t( 'UNIV University' );?></option>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
					
						<!-- Group -->
						<div class="form-group">
							<label class="col-md-3 control-label" for="instName"><font color="red">*</font> <?=_t( 'Institution Name' );?></label>
							<div class="col-md-8"><input class="form-control" id="instName" name="instName"<?=gio();?> type="text" value="<?=_h($this->inst[0]['instName']);?>" required /></div>
						</div>
						<!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="col-md-6">
					    
					    <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="city"><?=_t( 'City' );?></label>
                            <div class="col-md-8"><input class="form-control" id="city" name="city"<?=gio();?> type="text" value="<?=_h($this->inst[0]['city']);?>" /></div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="state"><?=_t( 'State' );?></label>
                            <div class="col-md-8"><input class="form-control" id="state" name="state"<?=gio();?> type="text" value="<?=_h($this->inst[0]['state']);?>" /></div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Country' );?></label>
                            <div class="col-md-8">
                            	<select name="country"<?=gio();?> class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" >
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('country','','iso2','iso2','short_name',_h($this->inst[0]['country'])); ?>
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
                    <input name="institutionID" type="hidden" value="<?=_h($this->inst[0]['institutionID']);?>" />
					<button type="submit"<?=gids();?> class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=_t( 'Submit' );?></button>
                    <button type="button" class="btn btn-icon btn-primary glyphicons circle_minus" onclick="window.location='<?=BASE_URL;?>institution/<?=bm();?>'"><i></i><?=_t( 'Cancel' );?></button>
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