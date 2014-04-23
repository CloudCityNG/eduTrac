<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Edit Student Load Rule View
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
 * @since       4.0.7
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */
?>

<ul class="breadcrumb">
	<li><?=_t( 'You are here');?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>form/student_load_rule/<?=bm();?>" class="glyphicons cargo"><i></i> <?=_t( 'Student Load Rules' );?></a></li>
	<li class="divider"></li>
	<li><?=_t( 'Edit Student Load Rule' );?></li>
</ul>

<h3><?=_t( 'Edit Student Load Rule' );?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>form/runEditStuLoadRule/" id="validateSubmitForm" method="post" autocomplete="off">
		
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
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Status' );?></label>
                            <div class="col-md-8">
                                <select name="status" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" required>
                                    <option value="">&nbsp;</option>
                                    <option value="F"<?=selected('F',_h($this->sl[0]['status']),false);?>><?=_t( 'Full Time' );?></option>
                                    <option value="Q"<?=selected('Q',_h($this->sl[0]['status']),false);?>><?=_t( '3/4 Time' );?></option>
                                    <option value="H"<?=selected('H',_h($this->sl[0]['status']),false);?>><?=_t( 'Half Time' );?></option>
                                    <option value="L"<?=selected('L',_h($this->sl[0]['status']),false);?>><?=_t( 'Less Than Half Time' );?></option>
                                </select>
                            </div>
                        </div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Minimum Credits' );?></label>
							<div class="col-md-8"><input class="form-control" name="min_cred" type="text" value="<?=_h($this->sl[0]['min_cred']);?>" required /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Maximum Credits' );?></label>
							<div class="col-md-8"><input class="form-control" name="max_cred" type="text" value="<?=_h($this->sl[0]['max_cred']);?>" required /></div>
						</div>
						<!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<div class="col-md-6">
						
						<!-- Group -->
						<div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Term(s)' );?> <a href="#modal1" data-toggle="modal"><img src="<?=BASE_URL;?>static/common/theme/images/help.png" /></a></label>
							<div class="col-md-8"><input class="form-control" name="term" type="text" value="<?=_h($this->sl[0]['term']);?>" required /></div>
						</div>
						<!-- // Group END -->
						
                        <!-- Group -->
						<div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Academic Level(s)' );?> <a href="#modal2" data-toggle="modal"><img src="<?=BASE_URL;?>static/common/theme/images/help.png" /></a></label>
							<div class="col-md-8"><input type="text" name="acadLevelCode" class="form-control" value="<?=_h($this->sl[0]['acadLevelCode']);?>" required/></div>
						</div>
						<!-- // Group END -->
						
                        <!-- Group -->
						<div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Active' );?></label>
                            <div class="col-md-8">
                                <select name="active" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" required>
                                    <option value="">&nbsp;</option>
                                    <option value="1"<?=selected('1',_h($this->sl[0]['active']),false);?>><?=_t( 'Yes' );?></option>
                                    <option value="0"<?=selected('0',_h($this->sl[0]['active']),false);?>><?=_t( 'No' );?></option>
                                </select>
                            </div>
                        </div>
						<!-- // Group END -->
						
                    </div>
					
				</div>
				<!-- // Row END -->
			
				<hr class="separator" />
				
				<!-- Form actions -->
				<div class="form-actions">
					<input type="hidden" name="slrID" value="<?=_h($this->sl[0]['slrID']);?>" />
					<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=_t( 'Save' );?></button>
				</div>
				<!-- // Form actions END -->
				
			</div>
		</div>
		<!-- // Widget END -->
		
	</form>
	<!-- // Form END -->
    
    <div id="modal1" class="modal fade">
    	<div class="modal-dialog">
			<div class="modal-content">
		        <div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		            <h4 class="modal-title"><?=_t( 'Term(s)' );?></h4>
		        </div>
		        <div class="modal-body">
		            <p><?=_t( 'In this field, you will only enter your term designation without the two digit year separated by a backslash "\" (i.e. FA\FAM1\SP).' );?></p>
		        </div>
	       	</div>
       	</div>
    </div>
    
    <div id="modal2" class="modal fade">
    	<div class="modal-dialog">
			<div class="modal-content">
		        <div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		            <h4 class="modal-title"><?=_t( 'Academic Level(s)' );?></h4>
		        </div>
		        <div class="modal-body">
		            <p><?=_t( 'Enter the academic level or levels that should be applied to this rule separated by a backslash "\" (i.e. CE\UG\GR)' );?></p>
		        </div>
	       	</div>
        </div>
    </div>
	
</div>	
	
		
		</div>
		<!-- // Content END -->