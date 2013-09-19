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
 * @since       1.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */
?>

<ul class="breadcrumb">
    <li><?php _e( _t( 'You are here') ); ?></li>
    <li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
    <li class="divider"></li>
    <li><a href="<?=BASE_URL;?>application/<?=bm();?>" class="glyphicons search"><i></i> <?php _e( _t( 'Search Application' ) ); ?></a></li>
    <li class="divider"></li>
    <li><?php _e( _t( 'Create Application' ) ); ?></li>
</ul>

<h3><?=get_name(_h($this->appl[0]['personID']));?> <?php _e( _t( "ID: " ) ); ?><?=_h($this->appl[0]['personID']);?></h3>
<div class="innerLR">
    
    <!-- Form -->
    <form class="margin-none" action="<?=BASE_URL;?>application/runEditApplication/" id="validateSubmitForm" method="post" autocomplete="off">
        
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
                    <div class="span12">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="address"><?php _e( _t( 'Address' ) ); ?></label>
                            <div class="controls">
                                <input class="span3" type="text" readonly value="<?=_h($this->applAddr[0]['address1']);?> <?=_h($this->applAddr[0]['address2']);?>" />
                                <input class="span3" type="text" readonly value="<?=_h($this->applAddr[0]['city']);?>" />
                                <input class="span3" type="text" readonly value="<?=_h($this->applAddr[0]['state']);?>" />
                                <input class="span3" type="text" readonly value="<?=_h($this->applAddr[0]['zip']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="address"><font color="red">*</font> <?php _e( _t( 'Academic Program' ) ); ?></label>
                            <div class="controls">
                                <select style="width:350px" name="acadProgID" id="select2_9" required>
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('acad_program','','acadProgID','acadProgCode','acadProgTitle',_h($this->appl[0]['acadProgID'])); ?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="startTerm"><font color="red">*</font> <?php _e( _t( 'Start Term' ) ); ?></label>
                            <div class="controls">
                                <select style="width:35%" name="startTerm" id="select2_10" required>
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('term','','termID','termCode','termName',_h($this->appl[0]['startTerm'])); ?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="admitStatus"><?php _e( _t( 'Admit Status' ) ); ?></label>
                            <div class="controls">
                                <?=admit_status_select(_h($this->appl[0]['admitStatus']));?>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="psat"><?php _e( _t( 'PSAT Verbal/Math' ) ); ?></label>
                            <div class="controls">
                                <input class="span3" type="text" name="PSAT_Verbal" value="<?=_h($this->appl[0]['PSAT_Verbal']);?>" />
                                <input class="span3" type="text" name="PSAT_Math" value="<?=_h($this->appl[0]['PSAT_Math']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="sat"><?php _e( _t( 'SAT Verbal/Math' ) ); ?></label>
                            <div class="controls">
                                <input class="span3" type="text" name="SAT_Verbal" value="<?=_h($this->appl[0]['SAT_Verbal']);?>" />
                                <input class="span3" type="text" name="SAT_Math" value="<?=_h($this->appl[0]['PSAT_Math']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="act"><?php _e( _t( 'ACT English/Math' ) ); ?></label>
                            <div class="controls">
                                <input class="span3" type="text" name="ACT_English" value="<?=_h($this->appl[0]['ACT_English']);?>" />
                                <input class="span3" type="text" name="ACT_Math" value="<?=_h($this->appl[0]['ACT_Math']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
                    
                    <!-- Column -->
                    <div class="span12">
                        
                        <!-- Group -->
                        <div class="control-group" style="float:left">
                        
                            <div class="controls">
                                <label class="control-label" for="address"><?php _e( _t( 'Insitution Attended' ) ); ?></label>
                                <table class="table table-bordered table-primary">
                                
                                    <thead>
                                        <tr>
                                            <th class="center"><?php _e( _t( 'Institution' ) ); ?></th>
                                            <th class="center"><?php _e( _t( 'Attended From Date' ) ); ?></th>
                                            <th class="center"><?php _e( _t( 'Attended To Date' ) ); ?></th>
                                            <th class="center"><?php _e( _t( 'GPA' ) ); ?></th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php $inst = 11; $time1 = 6; $time2 = 10; ?>
                                    <?php if($this->inst != '') : foreach($this->inst as $k => $v) { ?>
                                        <tr>
                                            <td class="center">
                                                <select style="width:350px" name="instID[]" id="select2_<?=$inst;?>">
                                                    <option value="">&nbsp;</option>
                                                    <?php table_dropdown('institution','','institutionID','ficeCode','instName',_h($v['instID'])); ?>
                                                </select>
                                            </td>
                                            <td class="center">
                                                <div class="input-append date" id="datetimepicker<?=$time1;?>">
                                                    <input id="startDate" name="fromDate[]" type="text" value="<?=_h($v['fromDate']);?>" />
                                                    <span class="add-on"><i class="icon-th"></i></span>
                                                </div>
                                            </td>
                                            <td class="center">
                                                <div class="input-append date" id="datetimepicker<?=$time2;?>">
                                                    <input id="startDate" name="toDate[]" type="text" value="<?=_h($v['toDate']);?>" />
                                                    <span class="add-on"><i class="icon-th"></i></span>
                                                </div>
                                            </td>
                                            <td class="center"><input class="span5" type="text" name="GPA[]" value="<?=_h($v['GPA']);?>" /></td>
                                            <td style="display:none;"><input type="hidden" name="instAttID[]" value="<?=_h($v['instAttID']);?>" /></td>
                                        </tr>
                                    <?php $inst++; $time1++; $time2++; } endif; ?>
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
                    
                </div>
                <!-- // Row End -->
                
                <hr class="separator" />
                
                <!-- Form actions -->
                <div class="form-actions">
                    <input type="hidden" name="personID" value="<?=_h($this->appl[0]['personID']);?>" />
                    <input type="hidden" name="applID" value="<?=_h($this->appl[0]['applID']);?>" />
                    <button type="submit"<?=sids();?> class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Save' ) ); ?></button>
                    <button type="button" class="btn btn-icon btn-primary glyphicons circle_minus" onclick="window.location='<?=BASE_URL;?>application/<?=bm();?>'"><i></i><?php _e( _t( 'Cancel' ) ); ?></button>
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