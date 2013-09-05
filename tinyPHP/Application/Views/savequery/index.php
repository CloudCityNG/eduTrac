<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Saved Query List View
 *  
 * PHP 5
 *
 * eduTrac(tm) : Student Information System (http://www.7mediaws.org/)
 * Copyright (C) 2013 Joshua Parker
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
 * @since eduTrac(tm) v 1.0
 * @license GNU General Public License v3 (http://www.gnu.org/licenses/gpl-3.0.html)
 */
?>

<ul class="breadcrumb">
	<li><? _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <? _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><? _e( _t( 'Saved Query' ) ); ?></li>
</ul>

<h3><? _e( _t( 'Saved Query' ) ); ?></h3>
<div class="innerLR">
	
	<!-- Widget -->
    <div class="widget widget-heading-simple widget-body-gray">
        <div class="widget-body">
        
            <!-- Table -->
            <table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-primary">
            
                <!-- Table heading -->
                <thead>
                    <tr>
                        <th class="center"><?php _e( _t( 'Saved Query Name' ) ); ?></th>
                        <th class="center"><?php _e( _t( 'Creation Date' ) ); ?></th>
                        <th class="center"><?php _e( _t( 'Actions' ) ); ?></th>
                    </tr>
                </thead>
                <!-- // Table heading END -->
                
                <!-- Table body -->
                <tbody>
                <?php if($this->queryList != '') : foreach($this->queryList as $key => $value) { ?>
                <tr class="gradeX">
                    <td class="center"><?=_h($value['savedQueryName']);?></td>
                    <td class="center"><?=date('D, M d, o',strtotime(_h($value['createdDate'])));?></td>
                    <td class="center">
                        <a href="<?=BASE_URL;?>savequery/view/<?=_h($value['savedQueryID']);?>/<?=bm();?>" title="View Saved Query" class="btn btn-circle"><i class="icon-eye-open"></i></a>
                        <a href="#myModal<?=_h($value['savedQueryID']);?>" data-toggle="modal" class="btn btn-danger"><i class="icon-trash"></i></a>
                        <div class="modal hide fade" id="myModal<?=_h($value['savedQueryID']);?>">
                            <div class="modal-body">
                                <p><?="Are you sure you want to delete the saved query: " . _h($value['savedQueryName']);?>?</p>
                            </div>
                            <div class="modal-footer">
                                <a href="<?=BASE_URL;?>savequery/delete/<?=_h($value['savedQueryID']);?>" class="btn btn-default"><?php _e( _t( 'Delete' ) ); ?></a>
                                <a href="#" data-dismiss="modal" class="btn btn-primary"><?php _e( _t( 'Cancel' ) ); ?></a>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php } endif; ?>
                    
                </tbody>
                <!-- // Table body END -->
                
            </table>
            <!-- // Table END -->
            
        </div>
    </div>
    <div class="separator bottom"></div>
    <!-- // Widget END -->
    
</div>  
    
        
        </div>
        <!-- // Content END -->