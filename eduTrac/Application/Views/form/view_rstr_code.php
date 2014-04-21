<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Edit Restriction Code View
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
 * @since       4.0.6
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */
use \eduTrac\Classes\Libraries\Hooks;
?>

<ul class="breadcrumb">
	<li><?=_t( 'You are here');?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>form/rstr_code/<?=bm();?>" class="glyphicons ban"><i></i> <?=_t( 'Restriction Codes' );?></a></li>
	<li class="divider"></li>
	<li><?=_t( 'Edit Restriction Code' );?></li>
</ul>

<h3><?=_t( 'Edit Restriction Code' );?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>form/runRSTRCode/" id="validateSubmitForm" method="post" autocomplete="off">
		
		<!-- Widget -->
		<div class="widget widget-heading-simple widget-body-gray">
		
			<!-- Widget heading -->
			<div class="widget-head">
				<h4 class="heading"><?=_t( 'Indicates field is required' );?></h4>
			</div>
			<!-- // Widget heading END -->
			
			<div class="widget-body">
			
				<!-- Row -->
				<div class="row">
					
					<!-- Column -->
					<div class="col-md-6">
					
						<!-- Group -->
						<div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Code' );?></label>
							<div class="col-md-8"><input class="form-control" name="rstrCode" type="text" value="<?=_h($this->rstr[0]['rstrCode']);?>" required /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Description' );?></label>
							<div class="col-md-8"><input class="form-control" name="description" type="text" value="<?=_h($this->rstr[0]['description']);?>" required /></div>
						</div>
						<!-- // Group END -->
						
						<div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Department' );?></label>
                            <div class="col-md-8">
                                <select name="deptCode" class="selectpicker col-md-12 form-control" data-style="btn-info" data-size="10" data-live-search="true" required>
                                    <option value="">&nbsp;</option>
                                    <?=table_dropdown('department', 'deptCode <> "NULL"', 'deptCode', 'deptCode', 'deptName',_h($this->rstr[0]['deptCode']));?>
                                </select>
                            </div>
                        </div>
						
					</div>
					<!-- // Column END -->
					
				</div>
				<!-- // Row END -->
			
				<hr class="separator" />
				
				<!-- Form actions -->
				<div class="form-actions">
					<input type="hidden" name="update" value="1" />
                    <input type="hidden" name="rstrCodeID" value="<?=$this->rstr[0]['rstrCodeID'];?>" />
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