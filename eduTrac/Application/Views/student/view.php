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
 * @since       3.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */
?>

<ul class="breadcrumb">
    <li><?=_t( 'You are here');?></li>
    <li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
    <li class="divider"></li>
    <li><a href="<?=BASE_URL;?>student/<?=bm();?>" class="glyphicons search"><i></i> <?=_t( 'Search Student' );?></a></li>
    <li class="divider"></li>
    <li><?=get_name(_h($this->prog[0]['stuID']));?></li>
</ul>

<h3><?=get_name(_h($this->prog[0]['stuID']));?>: <?=_h($this->prog[0]['stuID']);?></h3>
<div class="innerLR">
        
        <!-- Widget -->
        <div class="widget widget-heading-simple widget-body-gray">
            
            <div class="widget-body">
                <!-- Row -->
                <div class="row">
                    
                    <!-- Column -->
                    <div class="col-md-12">
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="address"><?=_t( 'Address' );?></label>
                            <div class="col-md-12">
                                <input class="form-control" type="text" readonly value="<?=_h($this->address[0]['address1']);?> <?=_h($this->address[0]['address2']);?>" />
                                <input class="form-control" type="text" readonly value="<?=_h($this->address[0]['city']);?> <?=_h($this->address[0]['state']);?> <?=_h($this->address[0]['zip']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
                    
               </div>
                    
                    <div class="separator bottom"></div>
                    
                    <?php if($this->prog != '') : foreach($this->prog as $k => $v) { ?>
                	<!-- Row -->
                	<div class="row">
                    <!-- Column -->
                    <div class="col-md-3">
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="control-label"><?=_t( 'Academic Program' );?> <a href="<?=BASE_URL;?>student/view_prog/<?=_h($v['stuProgID']);?>/<?=bm();?>"><img src="<?=BASE_URL;?>static/common/theme/images/cascade.png" /></a></label>
                            <input class="form-control" type="text" readonly value="<?=_h($v['acadProgCode']);?>" />
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
                    
                    <!-- Column -->
                    <div class="col-md-2">
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="control-label"><?=_t( 'Academic Level' );?></label>
                            <input class="form-control" type="text" readonly value="<?=_h($v['progAcadLevel']);?>" />
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
                    
                    <!-- Column -->
                    <div class="col-md-2">
                        <!-- Group -->
                        <div class="form-group">
                            <label class="control-label"><?=_t( 'Status' );?></label>                        
                            <input class="form-control" type="text" readonly value="<?=_h($v['currStatus']);?>" />
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
                    
                    <!-- Column -->
                    <div class="col-md-3">
                        <!-- Group -->
                        <div class="form-group">
                            <label class="control-label" for="statusDate"><?=_t( 'Status Date' );?></label>
                            <input class="form-control" type="text" readonly value="<?=_h($v['statusDate']);?>" />
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
                    
                    <!-- Column -->
                    <div class="col-md-2">
                        <!-- Group -->
                        <div class="form-group">
                            <label class="control-label" for="statusDate"><?=_t( 'Admit Status' );?></label>
                            <input class="form-control" type="text" readonly value="<?=_h($this->admit[0]['admitStatus']);?>" />
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
                   	</div>
                    <?php } endif; ?>
                
                
                <!-- Form actions -->
                <div class="form-actions">
                    <button type="button" class="btn btn-icon btn-primary glyphicons circle_minus" onclick="window.location='<?=BASE_URL;?>student/<?=bm();?>'"><i></i><?=_t( 'Cancel' );?></button>
                </div>
                <!-- // Form actions END -->

            </div>
        </div>
        <!-- // Widget END -->
    
</div>   
        
        </div>
        <!-- // Content END -->