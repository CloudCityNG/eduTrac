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
 * @since       3.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

use \eduTrac\Classes\Libraries\Hooks;
$auth = new \eduTrac\Classes\Libraries\Cookies;
?>

<ul class="breadcrumb">
    <li><?=_t( 'You are here' );?></li>
    <li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
    <li class="divider"></li>
    <li><a href="<?=BASE_URL;?>program/<?=bm();?>" class="glyphicons search"><i></i> <?=_t( 'Search Program' );?></a></li>
    <li class="divider"></li>
    <li><?=_t( 'View Program' );?></li>
</ul>

<h3><?=_h($this->prog[0]['acadProgCode']);?></h3>
<div class="innerLR">

    <!-- Form -->
    <form class="form-horizontal margin-none" action="<?=BASE_URL;?>program/runEditProg/" id="validateSubmitForm" method="post" autocomplete="off">
        
        <!-- Widget -->
        <div class="widget widget-heading-simple widget-body-gray">
        
            <!-- Widget heading -->
            <div class="widget-head">
                <h4 class="heading"><font color="red">*</font> <?=_t( 'Indicates field is required' );?></h4>
            </div>
            <!-- // Widget heading END -->
            
            <div class="widget-body">
            
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-md-6">
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Program Code' );?></label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="acadProgCode"<?=apio();?> value="<?=_h($this->prog[0]['acadProgCode']);?>" required />
                            </div>
                        </div>
                        <!-- // Group END -->
                    
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Title' );?></label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="acadProgTitle"<?=apio();?> value="<?=_h($this->prog[0]['acadProgTitle']);?>" required />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Short Description' );?></label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="programDesc"<?=apio();?> value="<?=_h($this->prog[0]['programDesc']);?>" required />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Status' );?></label>
                            <div class="col-md-8">
                                <?=status_select(_h($this->prog[0]['currStatus']));?>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Status Date' );?></label>
                            <div class="col-md-8">
                                <input class="form-control" name="statusDate" type="text" readonly value="<?=date("D, M d, o",strtotime(_h($this->prog[0]['statusDate'])));?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Approval Person' );?></label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" readonly value="<?=_h($this->prog[0]['lname']).', '._h($this->prog[0]['fname']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Approval Date' );?></label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="approvedDate" readonly value="<?=date("D, M d, o",strtotime(_h($this->prog[0]['approvedDate'])));?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Department' );?></label>
                            <div class="col-md-8">
                                <select name="deptCode" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true"<?=apio();?>>
                                    <option value="NULL">&nbsp;</option>
                                    <?php table_dropdown('department','deptCode <> "NULL"','deptCode','deptCode','deptName',_h($this->prog[0]['deptCode']));?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'School' );?></label>
                            <div class="col-md-8">
                                <select name="schoolCode" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true"<?=apio();?>>
                                    <option value="NULL">&nbsp;</option>
                                    <?php table_dropdown('school','schoolCode <> "NULL"','schoolCode','schoolCode','schoolName',_h($this->prog[0]['schoolCode']));?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Effective Catalog Year' );?></label>
                            <div class="col-md-8">
                                <select name="acadYearCode" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true"<?=apio();?> required>
                                    <option value="NULL">&nbsp;</option>
                                    <?php table_dropdown('acad_year','acadYearCode <> "NULL"','acadYearCode','acadYearCode','acadYearDesc',_h($this->prog[0]['acadYearCode']));?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
                    
                    <!-- Column -->
                    <div class="col-md-6">
                    
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Effective Date' );?></label>
                            <div class="col-md-8">
                                <div class="input-group date col-md-8" id="datepicker6">
                                    <input class="form-control"<?=apio();?> name="startDate" type="text" value="<?=_h($this->prog[0]['startDate']);?>" required />
                                    <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                </div>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'End Date' );?></label>
                            <div class="col-md-8">
                                <div class="input-group date col-md-8" id="datepicker7">
                                    <input class="form-control"<?=apio();?> name="endDate" type="text" value="<?=_h($this->prog[0]['endDate']);?>" />
                                    <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                </div>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Degree' );?></label>
                            <div class="col-md-8">
                                <select name="degreeCode" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true"<?=apio();?> required>
                                    <option value="NULL">&nbsp;</option>
                                    <?php table_dropdown('degree','degreeCode <> "NULL"','degreeCode','degreeCode','degreeName',_h($this->prog[0]['degreeCode']));?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'CCD' );?></label>
                            <div class="col-md-8">
                                <select name="ccdCode" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true"<?=apio();?>>
                                    <option value="NULL">&nbsp;</option>
                                    <?php table_dropdown('ccd','ccdCode <> "NULL"','ccdCode','ccdCode','ccdName',_h($this->prog[0]['ccdCode']));?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Major' );?></label>
                            <div class="col-md-8">
                                <select name="majorCode" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true"<?=apio();?>>
                                    <option value="NULL">&nbsp;</option>
                                    <?php table_dropdown('major','majorCode <> "NULL"','majorCode','majorCode','majorName',_h($this->prog[0]['majorCode']));?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Minor' );?></label>
                            <div class="col-md-8">
                                <select name="minorCode" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true"<?=apio();?>>
                                    <option value="NULL">&nbsp;</option>
                                    <?php table_dropdown('minor','minorCode <> "NULL"','minorCode','minorCode','minorName',_h($this->prog[0]['minorCode']));?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Specialization' );?></label>
                            <div class="col-md-8">
                                <select name="specCode" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true"<?=apio();?>>
                                    <option value="NULL">&nbsp;</option>
                                    <?php table_dropdown('specialization', 'specCode <> "NULL"', 'specCode', 'specCode', 'specName',_h($this->prog[0]['specCode'])); ?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Academic Level' );?></label>
                            <div class="col-md-8">
                                <?=acad_level_select(_h($this->prog[0]['acadLevelCode']),null,'required');?>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'CIP' );?></label>
                            <div class="col-md-8">
                                <select name="cipCode" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true"<?=apio();?>>
                                    <option value="NULL">&nbsp;</option>
                                    <?php table_dropdown('cip','cipCode <> "NULL"','cipCode','cipCode','cipName',_h($this->prog[0]['cipCode']));?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Location' );?></label>
                            <div class="col-md-8">
                                <select name="locationCode" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true"<?=apio();?>>
                                    <option value="NULL">&nbsp;</option>
                                    <?php table_dropdown('location','locationCode <> "NULL"','locationCode','locationCode','locationName',_h($this->prog[0]['locationCode']));?>
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
                    <input type="hidden" name="acadProgID" value="<?=_h($this->prog[0]['acadProgID']);?>" />
                    <button type="submit"<?=apids();?> class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=_t( 'Save' );?></button>
                    <button type="button" class="btn btn-icon btn-primary glyphicons circle_minus" onclick="window.location='<?=BASE_URL;?>program/<?=bm();?>'"><i></i><?=_t( 'Cancel' );?></button>
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