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
 * @since       3.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */
?>

<ul class="breadcrumb">
    <li><?=_t( 'You are here');?></li>
    <li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
    <li class="divider"></li>
    <li><a href="<?=BASE_URL;?>person/<?=bm();?>" class="glyphicons search"><i></i> <?=_t( 'Search Person' );?></a></li>
    <li class="divider"></li>
    <li><a href="<?=BASE_URL;?>person/view/<?=_h($this->person[0]['personID']);?>/<?=bm();?>" class="glyphicons user"><i></i> <?=get_name(_h($this->person[0]['personID']));?></a></li>
    <li class="divider"></li>
    <li><?=_t( 'Address Summary' );?></li>
</ul>

<h3><?=get_name(_h((int)$this->person[0]['personID']));?> <?=_t( "ID: " );?><?=_h($this->person[0]['personID']);?></h3>
<div class="innerLR">
        
        <!-- Widget -->
        <div class="widget widget-heading-simple widget-body-gray">
            
            <div class="widget-body">
                <?php if($this->addrSum !='') : foreach($this->addrSum as $k => $v) { ?>
                <!-- Row -->
                <div class="row">
                    
                    <!-- Column -->
                    <div class="col-md-6">
                    
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="address"><?=_t( 'Address' );?> <a href="<?=BASE_URL;?>person/view_addr/<?=_h($v['addressID']);?>/<?=bm();?>"><img src="<?=BASE_URL;?>static/common/theme/images/cascade.png" /></a></label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" disabled value="<?=_h($v['address1']);?> <?=_h($v['address2']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                        	<label class="col-md-3 control-label">&nbsp;</label>
                            <div class="col-md-3">
                                <input class="form-control" type="text" disabled value="<?=_h($v['city']);?>" />
                            </div>
                            <div class="col-md-3">
                                <input class="form-control" type="text" disabled value="<?=_h($v['state']);?>" />
                            </div>
                            <div class="col-md-3">
                                <input class="form-control" type="text" disabled value="<?=_h($v['zip']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
                    
                    <!-- Column -->
                    <div class="col-md-6">
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="status"><?=_t( 'Status' );?></label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" disabled value="<?=translate_addr_status(_h($v['addressStatus']));?>" />
                            </div>
                            
                            <label class="col-md-3 control-label" for="type"><?=_t( 'Type' );?></label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" disabled value="<?=translate_addr_type(_h($v['addressType']));?>" />
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
                        <button type="submit"<?=aids();?> class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=_t( 'Add' );?></button>
                        <button type="button" class="btn btn-icon btn-primary glyphicons circle_minus" onclick="window.location='<?=BASE_URL;?>person/view/<?=_h($this->person[0]['personID']);?>/<?=bm();?>'"><i></i><?=_t( 'Cancel' );?></button>
                    </form>
                </div>
                <!-- // Form actions END -->

            </div>
        </div>
        <!-- // Widget END -->
    
</div>   
        
        </div>
        <!-- // Content END -->