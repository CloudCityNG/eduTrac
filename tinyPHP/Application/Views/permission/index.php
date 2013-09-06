<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Manage Permissions View
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

use \tinyPHP\Classes\Libraries\ACL as ACL;
$perms = new ACL();

?>

<ul class="breadcrumb">
    <li><?php _e( _t( 'You are here') ); ?></li>
    <li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
    <li class="divider"></li>
    <li><?php _e( _t( 'Permissions' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Manage Permissions' ) ); ?></h3>
<div class="innerLR">

    <!-- Widget -->
    <div class="widget widget-heading-simple widget-body-gray">
        <div class="widget-body">
        
            <!-- Table -->
            <table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-white">
            
                <!-- Table heading -->
                <thead>
                    <tr>
                        <th class="center"><?php _e( _t( 'ID' ) ); ?></th>
                        <th class="center"><?php _e( _t( 'Key' ) ); ?></th>
                        <th class="center"><?php _e( _t( 'Name' ) ); ?></th>
                        <th class="center"><?php _e( _t( 'Edit' ) ); ?></th>
                    </tr>
                </thead>
                <!-- // Table heading END -->
                
                <!-- Table body -->
                <tbody>
                <?php 
                    $listPerms = $perms->getAllPerms('full');
                    if($listPerms != '') {
                        foreach ($listPerms as $k => $v) {
                            echo '<tr class="gradeX">';
                            echo '<td>'._h($v['ID']).'</td>';
                            echo '<td>'._h($v['Key']).'</td>';
                            echo '<td>'._h($v['Name']).'</td>';
                            echo '<td class="center"><a href="'.BASE_URL.'permission/view/?permID='._h($v['ID']).'" title="Edit Permission" class="btn btn-circle"><i class="icon-edit"></i></a></td>';
                            echo '</tr>';
                        }
                    }
                ?>
                    
                </tbody>
                <!-- // Table body END -->
                
            </table>
            <!-- // Table END -->
            
        </div>
    </div>
    <div class="separator bottom"></div>
    <!-- // Widget END -->
    
    <!-- Form actions -->
    <div class="form-actions">
        <button type="submit" name="NewPerm" class="btn btn-icon btn-primary glyphicons circle_ok" onclick="window.location='<?=BASE_URL;?>permission/add/<?=bm();?>'"><i></i><?php _e( _t( 'New Permision' ) ); ?></button>
    </div>
    <!-- // Form actions END -->
    
</div>  
    
        
        </div>
        <!-- // Content END -->