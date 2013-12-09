<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Batch Fees View
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
 * @since       1.1.1
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */
?>

<script type='text/javascript'>
$(document).ready(function(){ 
    $("input[name='population']").change(function() {
        var student = $(this).val();
        $(".student").hide();      
        $("#"+student).show(function(){
            $(this).html($(this).html());
            });
    });
});
</script>

<ul class="breadcrumb">
    <li><?php _e( _t( 'You are here' ) ); ?></li>
    <li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
    <li class="divider"></li>
    <li><?php _e( _t( 'Batch Fees' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Batch Fees' ) ); ?></h3>
<div class="innerLR">

    <!-- Form -->
    <form class="form-horizontal margin-none" action="<?=BASE_URL;?>financial/runBatch/" id="validateSubmitForm" method="post" autocomplete="off">
        
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
                        <div class="control-group" id="hiddenDiv">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Population' ) ); ?></label>
                            <div class="controls">
                                <div class="widget-body uniformjs">
                                    <label class="radio">
                                        <input type="radio" class="radio" name="population"<?=saio();?> value="prog" /> <?php _e( _t( 'Program' ) ); ?>
                                    </label><br/>
                                    <label class="radio">
                                        <input type="radio" class="radio" name="population"<?=saio();?> value="major" /> <?php _e( _t( 'Major' ) ); ?>
                                    </label><br/>
                                    <label class="radio">
                                        <input type="radio" class="radio" name="population"<?=saio();?> value="level" /> <?php _e( _t( 'Academic Level' ) ); ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group student" style="display:none;" id="prog">
                            <label class="control-label"><?php _e( _t( 'Academic Program' ) ); ?></label>
                            <div class="controls">
                                <select style="width:50%" name="stu_program"<?=saio();?> id="select2_9">
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('acad_program','currStatus = "A"','acadProgID','acadProgCode','acadProgTitle'); ?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group student" style="display:none;" id="major">
                            <label class="control-label"><?php _e( _t( 'Major' ) ); ?></label>
                            <div class="controls">
                                <select style="width:50%" name="major"<?=saio();?> id="select2_10">
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('major','','majorID','majorCode','majorName'); ?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group student" style="display:none;" id="level">
                            <label class="control-label"><?php _e( _t( 'Academic Level' ) ); ?></label>
                            <div class="controls">
                                <?=acad_level_select();?>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
                    
                    <!-- Column -->
                    <div class="span6">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Term' ) ); ?></label>
                            <div class="controls">
                                <select style="width:50%" name="termID"<?=saio();?> id="select2_12" required>
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('term','active = "1"','termID','termCode','termName'); ?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
                    
                </div>
                <!-- // Row END -->
                
                <hr class="separator" />
                
                <!-- Row -->
                <div class="row-fluid">
                    <!-- Column -->
                    <div class="span6">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Fees' ) ); ?></label>
                            <div class="controls">
                                <select style="width:100%" multiple id="pre-selected-options"<?=saio();?> class="multiselect" name="feeID[]" required>
                                    <?php table_dropdown('billing_table','status = "A"','ID','amount','name'); ?>
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
                    <button type="submit"<?=saids();?> class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Submit' ) ); ?></button>
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