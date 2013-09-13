<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * View Student View
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

$facID = str_replace('0','',$this->student[0]['advisorID']);
?>

<ul class="breadcrumb">
    <li><?php _e( _t( 'You are here') ); ?></li>
    <li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
    <li class="divider"></li>
    <li><a href="<?=BASE_URL;?>student/<?=bm();?>" class="glyphicons search"><i></i> <?php _e( _t( 'Search Student' ) ); ?></a></li>
    <li class="divider"></li>
    <li><?php _e( _t( 'View Student' ) ); ?></li>
</ul>

<h3><?=get_name(_h($this->student[0]['stuID']));?> <?php _e( _t( "ID: " ) ); ?><?=_h($this->student[0]['stuID']);?></h3>
<div class="innerLR">
    
    <!-- Form -->
    <form class="margin-none" action="<?=BASE_URL;?>student/runEditStudent/" id="validateSubmitForm" method="post" autocomplete="off">
        
        <!-- Widget -->
        <div class="widget widget-heading-simple widget-body-gray">
            
            <div class="widget-body">
                <!-- Row -->
                <div class="row-fluid">
                    
                    <!-- Column -->
                    <div class="span12">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="address"><?php _e( _t( 'Address' ) ); ?></label>
                            <div class="controls">
                                <input class="span3" type="text" readonly value="<?=_h($this->address[0]['address1']);?> <?=_h($this->address[0]['address2']);?>" />
                                <input class="span3" type="text" readonly value="<?=_h($this->address[0]['city']);?>" />
                                <input class="span3" type="text" readonly value="<?=_h($this->address[0]['state']);?>" />
                                <input class="span3" type="text" readonly value="<?=_h($this->address[0]['zip']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
                    
                    <?php if($this->prog != '') : foreach($this->prog as $k => $v) { ?>
                    <!-- Column -->
                    <div class="span3">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="acadProgCode"><?php _e( _t( 'Academic Program' ) ); ?></label>
                            <div class="controls">
                                <input class="span6" type="text" readonly value="<?=_h($v['acadProgCode']);?>" />
                                <a href="<?=BASE_URL;?>student/view_prog/<?=_h($v['stuProgID']);?>/<?=bm();?>"><img src="<?=BASE_URL;?>static/common/theme/images/cascade.png" /></a>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
                    
                    <!-- Column -->
                    <div class="span2">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="acadLevelCode"><?php _e( _t( 'Academic Level' ) ); ?></label>
                            <div class="controls">
                                <input class="span3 center" type="text" readonly value="<?=_h($v['progAcadLevel']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
                    
                    <!-- Column -->
                    <div class="span2">
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="currStatus"><?php _e( _t( 'Status' ) ); ?></label>
                            <div class="controls">                            
                                <input class="span2 center" type="text" readonly value="<?=_h($v['currStatus']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
                    
                    <!-- Column -->
                    <div class="span3">
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="statusDate"><?php _e( _t( 'Status Date' ) ); ?></label>
                            <div class="controls">
                                <input class="span4" type="text" readonly value="<?=_h($v['statusDate']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
                    
                    <!-- Column -->
                    <div class="span1">
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="statusDate"><?php _e( _t( 'Admit Status' ) ); ?></label>
                            <div class="controls">
                                <input class="span5 center" type="text" readonly value="" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
                    <?php } endif; ?>
                    
                    <!-- Column -->
                    <div class="span3">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Advisor' ) ); ?></label>
                            <div class="controls">
                                <select style="width:100%;" name="advisorID"<?=sio();?> id="select2_14" required>
                                    <option value="">&nbsp;</option>
                                    <?php facID_dropdown($facID); ?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
                    
                    <!-- Column -->
                    <div class="span3">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Academic Level' ) ); ?></label>
                            <div class="controls">
                                <?=acad_level_select($this->student[0]['acadLevelCode']);?>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
                    
                    <!-- Column -->
                    <div class="span3">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Catalog Year' ) ); ?></label>
                            <div class="controls">
                                <select style="width:100%;" name="catYearID" id="select2_13"<?=sio();?> required>
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('acad_year', '', 'acadYearID', 'acadYearCode', 'acadYearDesc',_h($this->student[0]['catYearID'])); ?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
                    
                    <!-- Column -->
                    <div class="span3">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <div class="controls">
                                <label class="control-label" for="antGradDate"><?php _e( _t( 'Anticipated Grad Date' ) ); ?></label>
                                <input class="span3 center" type="text" name="antGradDate"<?=sio();?> value="<?=_h($this->student[0]['antGradDate']);?>" required />
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
                    <input type="hidden" name="stuID" value="<?=_h($this->student[0]['stuID']);?>" />
                    <button type="submit"<?=sids();?> class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Save' ) ); ?></button>
                    <button type="button" class="btn btn-icon btn-primary glyphicons circle_minus" onclick="window.location='<?=BASE_URL;?>student/<?=bm();?>'"><i></i><?php _e( _t( 'Cancel' ) ); ?></button>
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