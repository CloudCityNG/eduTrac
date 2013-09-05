<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Credit Load View
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
	<li><?php _e( _t( 'You are here') ); ?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>form/creditload/<?=bm();?>" class="glyphicons pin_flag"><i></i> <?php _e( _t( 'Credit Load' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Credit Load' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Credit Load' ) ); ?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>form/runCredLoad/" id="validateSubmitForm" method="post" autocomplete="off">
		
		<!-- Widget -->
		<div class="widget widget-heading-simple widget-body-gray">
		
			<!-- Widget heading -->
			<div class="widget-head">
				<h4 class="heading"><?php _e( _t( 'Indicates field is required' ) ); ?></h4>
			</div>
			<!-- // Widget heading END -->
			
			<div class="widget-body">
			
				<!-- Row -->
				<div class="row-fluid">
					
					<!-- Column -->
					<div class="span6">
					
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="credLoadCode"><font color="red">*</font> <?php _e( _t( 'Cred Load Code' ) ); ?></label>
							<div class="controls"><input class="span12" id="credLoadCode" name="credLoadCode" type="text" required /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="credLoadName"><font color="red">*</font> <?php _e( _t( 'Cred Load Name' ) ); ?></label>
							<div class="controls"><input class="span12" id="credLoadName" name="credLoadName" type="text" required /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="credLoadCreds"><font color="red">*</font> <?php _e( _t( 'Cred Load Credits' ) ); ?></label>
							<div class="controls"><input class="span12" id="credLoadCreds" name="credLoadCreds" type="text" required /></div>
						</div>
						<!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
				</div>
				<!-- // Row END -->
			
				<hr class="separator" />
				
				<!-- Form actions -->
				<div class="form-actions">
					<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Save' ) ); ?></button>
				</div>
				<!-- // Form actions END -->
				
			</div>
		</div>
		<!-- // Widget END -->
		
	</form>
	<!-- // Form END -->
	
	<div class="separator bottom"></div>
	
	<!-- Widget -->
    <div class="widget widget-heading-simple widget-body-gray">
        <div class="widget-body">
        
            <!-- Table -->
            <table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-primary">
            
                <!-- Table heading -->
                <thead>
                    <tr>
                        <th class="center"><?php _e( _t( 'Credit Load Code' ) ); ?></th>
                        <th class="center"><?php _e( _t( 'Credit Load Name' ) ); ?></th>
                        <th class="center"><?php _e( _t( 'Credit Load Credits' ) ); ?></th>
                        <th class="center"><?php _e( _t( 'Actions' ) ); ?></th>
                    </tr>
                </thead>
                <!-- // Table heading END -->
                
                <!-- Table body -->
                <tbody>
                <?php if($this->credLoadList != '') : foreach($this->credLoadList as $key => $value) { ?>
                <tr class="gradeX">
                    <td class="center"><?=_h($value['credLoadCode']);?></td>
                    <td class="center"><?=_h($value['credLoadName']);?></td>
                    <td class="center"><?=_h($value['credLoadCreds']);?></td>
                    <td class="center">
                        <a href="<?=BASE_URL; ?>form/view_credit_load/<?=_h($value['credLoadID']); ?>/<?=bm();?>" title="View Credit Load" class="btn btn-circle"><i class="icon-eye-open"></i></a>
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
	
</div>	
	
		
		</div>
		<!-- // Content END -->