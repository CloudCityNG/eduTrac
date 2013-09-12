<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Address Summary View
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
    <li><a href="<?=BASE_URL;?>person/<?=bm();?>" class="glyphicons search"><i></i> <?php _e( _t( 'Search Person' ) ); ?></a></li>
    <li class="divider"></li>
    <li><a href="<?=BASE_URL;?>person/view/<?=_h($this->person[0]['personID']);?>/<?=bm();?>" class="glyphicons user"><i></i> <?=get_name(_h($this->person[0]['personID']));?></a></li>
    <li class="divider"></li>
    <li><?php _e( _t( 'Address Summary' ) ); ?></li>
</ul>

<h3><?=get_name(_h((int)$this->person[0]['personID']));?> <?php _e( _t( "ID: " ) ); ?><?=_h($this->person[0]['personID']);?></h3>
<div class="innerLR">
        
        <!-- Widget -->
        <div class="widget widget-heading-simple widget-body-gray">
            
            <div class="widget-body">
                <?php if($this->addrSum !='') : foreach($this->addrSum as $k => $v) { ?>
                <!-- Row -->
                <div class="row-fluid">
                    
                    <!-- Column -->
                    <div class="span6">
                    
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="address"><?php _e( _t( 'Address' ) ); ?></label>
                            <div class="controls">
                                <input class="span8" type="text" disabled value="<?=_h($v['address1']);?> <?=_h($v['address2']);?>" />
                                <a href="<?=BASE_URL;?>person/edit_addr/<?=_h($v['addressID']);?>/<?=bm();?>"><img src="<?=BASE_URL;?>static/common/theme/images/cascade.png" /></a>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <div class="controls">
                                <input class="span3" type="text" disabled value="<?=_h($v['city']);?>" />
                                <input class="span3" type="text" disabled value="<?=_h($v['state']);?>" />
                                <input class="span3" type="text" disabled value="<?=_h($v['zip']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
                    
                    <!-- Column -->
                    <div class="span6">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="status"><?php _e( _t( 'Status' ) ); ?></label>
                            <div class="controls">
                                <input class="span5" type="text" disabled value="<?=translate_addr_status(_h($v['addressStatus']));?>" />
                            </div>
                            
                            <label class="control-label" for="type"><?php _e( _t( 'Type' ) ); ?></label>
                            <div class="controls">
                                <input class="span5" type="text" disabled value="<?=translate_addr_type(_h($v['addressType']));?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
                    
                </div>
                <!-- // Row END -->
                <hr class="separator" />
                <?php } endif; ?>
                
                <!-- Form actions -->
                <div class="form-actions">
                    <form action="<?=BASE_URL;?>person/addr_form/<?=_h($this->person[0]['personID']);?>/<?=bm();?>">
                        <button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Add' ) ); ?></button>
                    </form>
                </div>
                <!-- // Form actions END -->

            </div>
        </div>
        <!-- // Widget END -->
    
</div>   
        
        </div>
        <!-- // Content END -->