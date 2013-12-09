<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Add Program View
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

use \eduTrac\Classes\Libraries\Hooks;
$auth = new \eduTrac\Classes\Libraries\Cookies;
?>

<ul class="breadcrumb">
    <li><?php _e( _t( 'You are here' ) ); ?></li>
    <li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
    <li class="divider"></li>
    <li><a href="<?=BASE_URL;?>program/<?=bm();?>" class="glyphicons search"><i></i> <?php _e( _t( 'Search Program' ) ); ?></a></li>
    <li class="divider"></li>
    <li><?php _e( _t( 'View Program' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Academic Program' ) ); ?> <?=_h($this->prog[0]['acadProgCode']);?></h3>
<div class="innerLR">

    <!-- Form -->
    <form class="form-horizontal margin-none" action="<?=BASE_URL;?>program/runEditProg/" id="validateSubmitForm" method="post" autocomplete="off">
        
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
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Program Code' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="acadProgCode"<?=apio();?> class="span10" value="<?=_h($this->prog[0]['acadProgCode']);?>" required />
                            </div>
                        </div>
                        <!-- // Group END -->
                    
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Title' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="acadProgTitle"<?=apio();?> class="span10" value="<?=_h($this->prog[0]['acadProgTitle']);?>" required />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Short Description' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="programDesc"<?=apio();?> class="span10" value="<?=_h($this->prog[0]['programDesc']);?>" required />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Status' ) ); ?></label>
                            <div class="controls">
                                <?=status_select(_h($this->prog[0]['currStatus']));?>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Status Date' ) ); ?></label>
                            <div class="controls">
                                <input id="statusDate" name="statusDate" type="text" readonly value="<?=date("D, M d, o",strtotime(_h($this->prog[0]['statusDate'])));?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Approval Person' ) ); ?></label>
                            <div class="controls">
                                <input type="text" readonly value="<?=_h($this->prog[0]['lname']).', '._h($this->prog[0]['fname']);?>" class="span10" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Approval Date' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="approvedDate" readonly value="<?=date("D, M d, o",strtotime(_h($this->prog[0]['approvedDate'])));?>" class="span10" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Dept/Div' ) ); ?></label>
                            <div class="controls">
                                <select style="width:100%;" name="deptID" id="select2_10"<?=apio();?>>
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('department','','deptID','deptCode','deptName',_h($this->prog[0]['deptID']));?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'School' ) ); ?></label>
                            <div class="controls">
                                <select style="width:100%;" name="schoolID" id="select2_11"<?=apio();?>>
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('school','','schoolID','schoolCode','schoolName',_h($this->prog[0]['schoolID']));?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Effective Catalog Year' ) ); ?></label>
                            <div class="controls">
                                <select style="width: 100%;" name="acadYearID" id="select2_12"<?=apio();?> required>
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('acad_year','','acadYearID','acadYearCode','acadYearDesc',_h($this->prog[0]['acadYearID']));?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
                    
                    <!-- Column -->
                    <div class="span6">
                    
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Effective Date' ) ); ?></label>
                            <div class="controls">
                                <div class="input-append date" id="datetimepicker6">
                                    <input id="startDate"<?=apio();?> name="startDate" type="text" value="<?=_h($this->prog[0]['startDate']);?>" required />
                                    <span class="add-on"><i class="icon-th"></i></span>
                                </div>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'End Date' ) ); ?></label>
                            <div class="controls">
                                <div class="input-append date" id="datetimepicker7">
                                    <input id="endDate"<?=apio();?> name="endDate" type="text" value="<?=_h($this->prog[0]['endDate']);?>" />
                                    <span class="add-on"><i class="icon-th"></i></span>
                                </div>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Degree' ) ); ?></label>
                            <div class="controls">
                                <select style="width:100%" name="degreeID" id="select2_13"<?=apio();?> required>
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('degree','','degreeID','degreeCode','degreeName',_h($this->prog[0]['degreeID']));?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'CCD' ) ); ?></label>
                            <div class="controls">
                                <select style="width: 100%;" name="ccdID" id="select2_14"<?=apio();?>>
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('ccd','','ccdID','ccdCode','ccdName',_h($this->prog[0]['ccdID']));?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Major' ) ); ?></label>
                            <div class="controls">
                                <select style="width: 100%;" name="majorID" id="select2_15"<?=apio();?>>
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('major','','majorID','majorCode','majorName',_h($this->prog[0]['majorID']));?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Minor' ) ); ?></label>
                            <div class="controls">
                                <select style="width: 100%;" name="minorID" id="select2_16"<?=apio();?>>
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('minor','','minorID','minorCode','minorName',_h($this->prog[0]['minorID']));?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Specialization' ) ); ?></label>
                            <div class="controls">
                                <select style="width: 100%;" name="specID" id="select2_17"<?=apio();?>>
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('specialization', '', 'specID', 'specCode', 'specName',_h($this->prog[0]['specID'])); ?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Academic Level' ) ); ?></label>
                            <div class="controls">
                                <?=acad_level_select(_h($this->prog[0]['acadLevelCode']),null,'required');?>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'CIP' ) ); ?></label>
                            <div class="controls">
                                <select style="width:100%;" name="cipID" id="select2_19"<?=apio();?>>
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('cip','','cipID','cipCode','cipName',_h($this->prog[0]['cipID']));?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Location' ) ); ?></label>
                            <div class="controls">
                                <select style="width:100%;" name="locationID" id="select2_20"<?=apio();?>>
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('location','','locationID','locationCode','locationName',_h($this->prog[0]['locationID']));?>
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
                    <input type="hidden" name="acadProgID" value="<?=_h($this->prog[0]['acadProgID']);?>" class="span10" />
                    <button type="submit"<?=apids();?> class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Save' ) ); ?></button>
                    <button type="button" class="btn btn-icon btn-primary glyphicons circle_minus" onclick="window.location='<?=BASE_URL;?>program/<?=bm();?>'"><i></i><?php _e( _t( 'Cancel' ) ); ?></button>
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