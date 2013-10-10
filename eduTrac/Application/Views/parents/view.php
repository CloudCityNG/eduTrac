<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * View Parent View
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
 * @since       1.0.2
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */
?>

<ul class="breadcrumb">
    <li><?php _e( _t( 'You are here') ); ?></li>
    <li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
    <li class="divider"></li>
    <li><a href="<?=BASE_URL;?>parents/<?=bm();?>" class="glyphicons search"><i></i> <?php _e( _t( 'Search Parent' ) ); ?></a></li>
    <li class="divider"></li>
    <li><?php _e( _t( 'View Parent' ) ); ?></li>
</ul>

<h3><?=get_name(_h($this->Parent[0]['parentID']));?> <?php _e( _t( "ID: " ) ); ?><?=_h($this->Parent[0]['parentID']);?></h3>
<div class="innerLR">
    
    <!-- Form -->
    <form class="margin-none" action="<?=BASE_URL;?>parents/runEditParent/" id="validateSubmitForm" method="post" autocomplete="off">
        
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
                    
                    <!-- Column -->
                    <div class="span3">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="address"><?php _e( _t( 'Email' ) ); ?></label>
                            <div class="controls">
                                <input type="text" readonly value="<?=_h($this->address[0]['email1']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
                    
                    <!-- Column -->
                    <div class="span3">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="address"><?php _e( _t( 'Phone' ) ); ?></label>
                            <div class="controls">
                                <input type="text" readonly value="<?=_h($this->address[0]['phone1']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
                    
                    <!-- Column -->
                    <div class="span3">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="address"><?php _e( _t( 'Status' ) ); ?></label>
                            <div class="controls">
                                <select name="status"<?=paio();?> style="width:30%" id="select2_9">
                                    <option value="">&nbsp;</option>
                                    <option value="A"<?=selected('A',_h($this->Parent['0']['status'],false));?>><?php _e( _t( 'Active' ) ); ?></option>
                                    <option value="I"<?=selected('I',_h($this->Parent['0']['status'],false));?>><?php _e( _t( 'Inactive' ) ); ?></option>
                                </select>
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
                    <input type="hidden" name="parentID" value="<?=_h($this->Parent[0]['parentID']);?>" />
                    <button type="submit"<?=paids();?> class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Save' ) ); ?></button>
                    <button type="button" class="btn btn-icon btn-primary glyphicons circle_minus" onclick="window.location='<?=BASE_URL;?>parents/<?=bm();?>'"><i></i><?php _e( _t( 'Cancel' ) ); ?></button>
                </div>
                <!-- // Form actions END -->
                
                <!-- Table -->
                <table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-white">
                
                    <!-- Table heading -->
                    <thead>
                        <tr>
                            <th class="center"><?php _e( _t( 'Child\'s ID' ) ); ?></th>
                            <th class="center"><?php _e( _t( 'Last Name' ) ); ?></th>
                            <th class="center"><?php _e( _t( 'First Name' ) ); ?></th>
                            <th<?=ae('create_par_record');?> class="center"><?php _e( _t( 'Actions' ) ); ?></th>
                        </tr>
                    </thead>
                    <!-- // Table heading END -->
                    
                    <!-- Table body -->
                    <tbody>
                    <?php if($this->children != '') : foreach($this->children as $k => $v) { ?>
                    <tr class="gradeX">
                        <td class="center"><?=_h($v['stuID']);?></td>
                        <td class="center"><?=_h($v['lname']);?></td>
                        <td class="center"><?=_h($v['fname']);?></td>
                        <td<?=ae('create_par_record');?> class="center">
                            <a href="<?=BASE_URL;?>parents/deleteConnection/<?=_h($v['ID']);?>" title="Delete Connection" class="btn btn-danger"><i class="icon-trash"></i></a>
                        </td>
                    </tr>
                    <?php } endif; ?>
                    </tbody>
                    <!-- // Table body END -->
                    
                </table>
                <!-- // Table END -->

            </div>
        </div>
        <!-- // Widget END -->
        
    </form>
    <!-- // Form END -->
    
</div>   
        
        </div>
        <!-- // Content END -->