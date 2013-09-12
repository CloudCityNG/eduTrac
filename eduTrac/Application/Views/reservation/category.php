<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Category View
 *  
 * PHP 5.4+
 *
 * eduTrac(tm) : Student Information System (http://www.7mediaws.org/)
 * Copyright (C) 2013 7 Media Web Solutions, LLC
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
 * @license     GNU General Public License v3 (http://www.gnu.org/licenses/gpl-3.0.html)
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
	<li><?php _e( _t( 'Reservation Categories' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Reservation Categories' ) ); ?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>reservation/runCategory/" id="validateSubmitForm" method="post" autocomplete="off">
		
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
					<div class="span4">
					
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="catName"><font color="red">*</font> <?php _e( _t( 'Category Name' ) ); ?></label>
							<div class="controls"><input class="span8" id="catName" name="catName" type="text" required /></div>
						</div>
						<!-- // Group END -->
						
					</div>
					<!-- // Column END -->
                    
                    <!-- Column -->
    				<div class="span4">
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="fgcolor"><?php _e( _t( 'Text Color' ) ); ?></label>
							<div class="controls"><input class="span4 color {hash:true}" id="fgcolor" name="fgcolor" type="text" /></div>
						</div>
						<!-- // Group END -->
						
					</div>
					<!-- // Column END -->
                    
                    <!-- Column -->
    				<div class="span4">
                        
                        <!-- Group -->
    					<div class="control-group">
							<label class="control-label" for="bgcolor"><?php _e( _t( 'Background Color' ) ); ?></label>
							<div class="controls"><input class="span4 color {hash:true}" id="bgcolor" name="bgcolor" type="text" /></div>
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
                        <th class="center"><?php _e( _t( 'Category' ) ); ?></th>
                        <th class="center"><?php _e( _t( 'Text Color' ) ); ?></th>
                        <th class="center"><?php _e( _t( 'Background Color' ) ); ?></th>
                    </tr>
                </thead>
                <!-- // Table heading END -->
                
                <!-- Table body -->
                <tbody>
                <?php if($this->catList != '') : foreach($this->catList as $key => $value) { ?>
                <tr class="gradeX">
                    <td class="center"><?=_h($value['catName']);?></td>
                    <td class="center"><?=_h($value['fgcolor']);?></td>
                    <td class="center"><?=_h($value['bgcolor']);?></td>
                    <td class="center">
                        <a href="<?=BASE_URL;?>reservation/view_category<?=_h($value['id']);?>/<?=bm();?>" title="View Category" class="btn btn-circle"><i class="icon-eye-open"></i></a>
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