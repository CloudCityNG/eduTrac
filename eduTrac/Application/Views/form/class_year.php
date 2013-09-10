<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Class Year View
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
use \eduTrac\Classes\Libraries\Hooks;
?>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here') ); ?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Class Year' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Class Year' ) ); ?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL; ?>form/runClassYear/" id="validateSubmitForm" method="post" autocomplete="off">
		
		<!-- Widget -->
		<div class="widget widget-heading-simple widget-body-gray">
		
			<!-- Widget heading -->
			<div class="widget-head">
				<h4 class="heading"><font color="red">*</font> <?php _e( _t( 'Indicates field is required.' ) ); ?></h4>
			</div>
			<!-- // Widget heading END -->
			
			<div class="widget-body">
			
				<!-- Row -->
				<div class="row-fluid">
					
					<!-- Column -->
					<div class="span6">
					    
					    <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="acadLevelCode"><font color="red">*</font> <?php _e( _t( 'Academic Level' ) ); ?></label>
                            <div class="controls">
                                <?=acad_level_select();?>
                            </div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="classYear"><font color="red">*</font> <?php _e( _t( 'Class Year' ) ); ?></label>
                            <div class="controls">
                                <?=class_year();?>
                            </div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
                    <div class="span6">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="minCredits"><font color="red">*</font> <?php _e( _t( 'Minimum Credits' ) ); ?></label>
                            <div class="controls"><input class="span12" id="minCredits" name="minCredits" type="text" required /></div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="maxCredits"><font color="red">*</font> <?php _e( _t( 'Maximum Credits' ) ); ?></label>
                            <div class="controls"><input class="span12" id="maxCredits" name="maxCredits" type="text" required /></div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
					
				</div>
				<!-- // Row END -->
			
				<hr class="separator" />
				
				<!-- Form actions -->
				<div class="form-actions">
					<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Submit' ) ); ?></button>
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
                        <th class="center"><?php _e( _t( 'Class Year' ) ); ?></th>
                        <th class="center"><?php _e( _t( 'Minimum Credits' ) ); ?></th>
                        <th class="center"><?php _e( _t( 'Maximum Credits' ) ); ?></th>
                        <th class="center"><?php _e( _t( 'Actions' ) ); ?></th>
                    </tr>
                </thead>
                <!-- // Table heading END -->
                
                <!-- Table body -->
                <tbody>
                <?php if($this->yearList != '') : foreach($this->yearList as $key => $value) { ?>
                <tr class="gradeX">
                    <td class="center"><?=translate_class_year(_h($value['classYear']));?></td>
                    <td class="center"><?=_h($value['minCredits']);?></td>
                    <td class="center"><?=_h($value['maxCredits']);?></td>
                    <td class="center">
                        <a href="<?=BASE_URL;?>form/view_class_year/<?=_h($value['yearID']);?>/<?=bm();?>" title="View Class Year" class="btn btn-circle"><i class="icon-edit"></i></a>
                        <?php Hooks::do_action('search_class_year_action'); ?>
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