<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Add Application View
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
    <li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
    <li class="divider"></li>
    <li><a href="<?=BASE_URL;?>application/<?=bm();?>" class="glyphicons search"><i></i> <?=_t( 'Search Application' );?></a></li>
    <li class="divider"></li>
    <li><?=_t( 'View Application' );?></li>
</ul>

<h3><?=_t( 'View Application' );?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>application/runEditApplication/" id="validateSubmitForm" method="post" autocomplete="off">
		
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
                            <label class="col-md-3 control-label"><?=_t( 'Person ID' );?></label>
                            <div class="col-md-8">
                            	<input class="form-control" readonly type="text" value="<?=_h($this->appl[0]['personID']);?>" />
                        	</div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'First/Mid/Last Name' );?></label>
                            <div class="col-md-3">
                            	<input class="form-control" readonly type="text" value="<?=_h($this->appl[0]['fname']);?>" />
                        	</div>
                        	<div class="col-md-2">
                            	<input class="form-control" readonly type="text" value="<?=_h($this->appl[0]['mname']);?>" />
                        	</div>
                        	<div class="col-md-3">
                            	<input class="form-control" readonly type="text" value="<?=_h($this->appl[0]['lname']);?>" />
                        	</div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Permanent Address' );?></label>
                            <div class="col-md-8">
                            	<input class="form-control" readonly type="text" value="<?=_h($this->applAddr[0]['address1']);?> <?=_h($this->applAddr[0]['address2']);?>" />
                            	<input class="form-control" readonly type="text" value="<?=_h($this->applAddr[0]['city']);?> <?=_h($this->applAddr[0]['state']);?> <?=_h($this->applAddr[0]['zip']);?>" />
                        	</div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'DOB' );?></label>
                            <div class="col-md-8">
                            	<?php if(_h($this->appl[0]['dob']) > '0000-00-00') : ?>
                            	<input class="form-control" readonly type="text" value="<?=date('D, M d, o',strtotime(_h($this->appl[0]['dob'])));?>" />
                            	<?php else : ?>
                            	<input class="form-control" readonly type="text" />
                        		<?php endif; ?>
                        	</div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="col-md-6">
						
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Age' );?></label>
                            <div class="col-md-8">
                            	<?php if(_h($this->appl[0]['dob']) > '0000-00-00') : ?>
                            	<input class="form-control" readonly type="text" value="<?=\eduTrac\Classes\Libraries\Util::getAge(_h($this->appl[0]['dob']));?>" />
                            	<?php else : ?>
                            	<input class="form-control" readonly type="text" />
                        		<?php endif; ?>
                        	</div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Gender' );?></label>
                            <div class="col-md-8">
                            	<input class="form-control" readonly type="text" value="<?php if(_h($this->appl[0]['gender']) == 'M') : echo 'Male'; elseif(_h($this->appl[0]['gender']) == 'F') : echo 'Female'; endif; ?>" />
                        	</div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Phone Number' );?></label>
                            <div class="col-md-8">
                            	<input class="form-control" readonly type="text" value="<?=_h($this->applAddr[0]['phone1']);?>" />
                        	</div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Email Address' );?></label>
                            <div class="col-md-8">
                            	<input class="form-control" readonly type="text" value="<?=_h($this->appl[0]['email']);?>" />
                        	</div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
				</div>
				<!-- // Row END -->
			
				<div class="separator bottom"></div>
				
				<!-- Row -->
				<div class="row">
					
					<!-- Column -->
					<div class="col-md-6">
						
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Application Date' );?></label>
                            <div class="col-md-8">
                            	<div class="input-group date" id="datepicker6">
                            		<?php if(_h($this->appl[0]['applDate']) > '0000-00-00') : ?>
                                    <input class="form-control" name="applDate" type="text" value="<?=_h($this->appl[0]['applDate']);?>" />
                                    <?php else : ?>
                                	<input class="form-control" name="applDate" type="text" />
                                	<?php endif; ?>
                                    <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                </div>
                        	</div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Academic Program' );?></label>
                            <div class="col-md-8">
                                <select name="acadProgCode" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true">
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('acad_program','currStatus = "A"','acadProgCode','acadProgCode','acadProgTitle',_h($this->appl[0]['acadProgCode'])); ?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Start Term' );?></label>
                            <div class="col-md-8">
                                <select name="startTerm" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" required/>
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('term','termCode <> "NULL"','termCode','termCode','termName',_h($this->appl[0]['startTerm'])); ?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Admit Status' );?></label>
                            <div class="col-md-8">
                                <?=admit_status_select(_h($this->appl[0]['admitStatus']));?>
                            </div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="col-md-6">
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'PSAT Verbal/Math' );?></label>
                            <div class="col-md-4">
                                <input class="form-control" type="text" name="PSAT_Verbal" value="<?=_h($this->appl[0]['PSAT_Verbal']);?>" />
                            </div>
                            <div class="col-md-4">
                                <input class="form-control" type="text" name="PSAT_Math" value="<?=_h($this->appl[0]['PSAT_Math']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'SAT Verbal/Math' );?></label>
                            <div class="col-md-4">
                                <input class="form-control" type="text" name="SAT_Verbal" value="<?=_h($this->appl[0]['SAT_Verbal']);?>" />
                            </div>
                            <div class="col-md-4">
                                <input class="form-control" type="text" name="SAT_Math" value="<?=_h($this->appl[0]['SAT_Math']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'ACT English/Math' );?></label>
                            <div class="col-md-4">
                                <input class="form-control" type="text" name="ACT_English" value="<?=_h($this->appl[0]['ACT_English']);?>" />
                            </div>
                            <div class="col-md-4">
                                <input class="form-control" type="text" name="ACT_Math" value="<?=_h($this->appl[0]['ACT_Math']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
				</div>
				<!-- // Row END -->
				
				<?php if(_h($this->inst[0]['fice_ceeb']) != '') : ?>
				<div class="separator bottom"></div>
        
            <!-- Table -->
            <table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-primary">
            
                <!-- Table heading -->
                <thead>
                    <tr>
                        <th class="text-center"><?=_t( 'Institution' );?></th>
                        <th class="text-center"><?=_t( 'From Date' );?></th>
                        <th class="text-center"><?=_t( 'To Date' );?></th>
                        <th class="text-center"><?=_t( 'Major' );?></th>
                        <th class="text-center"><?=_t( 'GPA' );?></th>
                        <th class="text-center"><?=_t( 'Degree' );?></th>
                        <th class="text-center"><?=_t( 'Grad Date' );?></th>
                        <th class="text-center"><?=_t( 'Action' );?></th>
                    </tr>
                </thead>
                <!-- // Table heading END -->
                
                <!-- Table body -->
                <tbody>
                <?php if($this->inst != '') : foreach($this->inst as $key => $value) { ?>
                <tr class="gradeX">
                    <td style="width:300px;">
                    	<!-- Group -->
                        <div class="form-group">
                            <div class="col-md-12">
                            	<select name="fice_ceeb[]" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true">
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('institution','','fice_ceeb','fice_ceeb','instName',_h($value['fice_ceeb'])); ?>
                                </select>
                        	</div>
                        </div>
                        <!-- // Group END -->
                    </td>
                    <td class="text-center" style="width:180px;">
                    	<!-- Group -->
                        <div class="form-group">
                            <div class="col-md-12">
                            	<div class="input-group date" id="datepicker6">
                                    <input class="form-control" name="fromDate[]" type="text" value="<?=_h($value['fromDate']);?>" />
                                    <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                </div>
                        	</div>
                        </div>
                        <!-- // Group END -->
                    </td>
                    <td class="text-center" style="width:180px;">
                    	<!-- Group -->
                        <div class="form-group">
                            <div class="col-md-12">
                            	<div class="input-group date" id="datepicker7">
                                    <input class="form-control" name="toDate[]" type="text" value="<?=_h($value['toDate']);?>" />
                                    <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                </div>
                        	</div>
                        </div>
                        <!-- // Group END -->
                    </td>
                    <td class="text-center">
                    	<!-- Group -->
                        <div class="form-group">
                            <div class="col-md-12">
                            	<input class="form-control" type="text" name="major[]" value="<?=_h($value['major']);?>" />
                        	</div>
                        </div>
                        <!-- // Group END -->
                    </td>
                    <td class="text-center">
                    	<!-- Group -->
                        <div class="form-group">
                            <div class="col-md-12">
                            	<input class="form-control" type="text" name="GPA[]" value="<?=_h($value['GPA']);?>" />
                        	</div>
                        </div>
                        <!-- // Group END -->
                    </td>
                    <td class="text-center">
                    	<!-- Group -->
                        <div class="form-group">
                            <div class="col-md-12">
                            	<input class="form-control" type="text" name="degree_awarded[]" value="<?=_h($value['degree_awarded']);?>" />
                        	</div>
                        </div>
                        <!-- // Group END -->
                    </td>
                    <td class="text-center">
                    	<!-- Group -->
                        <div class="form-group">
                            <div class="col-md-12" style="width:180px;">
                            	<div class="input-group date" id="datepicker8">
                            		<?php if(_h($value['degree_conferred_date']) > '0000-00-00') : ?>
                                    <input class="form-control" name="degree_conferred_date[]" type="text" value="<?=_h($value['degree_conferred_date']);?>" />
                                    <?php else : ?>
                                	<input class="form-control" name="degree_conferred_date[]" type="text" />
                                	<?php endif; ?>
                                    <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                </div>
                        	</div>
                        </div>
                        <!-- // Group END -->
                    </td>
                    <td class="text-center">
                    	<a href="<?=BASE_URL;?>application/deleteInstAttend/<?=_h($value['instAttID']);?>/" title="Delete Institution Attended" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                    </td>
                    <td style="display:none;">
                    	<input type="hidden" name="instAttID[]" value="<?=_h($value['instAttID']);?>" />
                    </td>
                </tr>
                <?php } endif; ?>
                    
                </tbody>
                <!-- // Table body END -->
                
            </table>
            <!-- // Table END -->
			<?php endif; ?>
			
			<div class="separator bottom"></div>
			
			<!-- Form actions -->
			<div class="form-actions">
				<input type="hidden" name="personID" value="<?=_h($this->appl[0]['personID']);?>" />
                <input type="hidden" name="applID" value="<?=_h($this->appl[0]['applID']);?>" />
				<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=_t( 'Submit' );?></button>
                <button type="button" class="btn btn-icon btn-primary glyphicons circle_minus" onclick="window.location='<?=BASE_URL;?>application/<?=bm();?>'"><i></i><?=_t( 'Cancel' );?></button>
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