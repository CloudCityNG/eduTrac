<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Room View
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
	<li><a href="<?=BASE_URL;?>dashbaord/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>form/room/<?=bm();?>" class="glyphicons pin_flag"><i></i> <?php _e( _t( 'Room' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'View Room' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Viewing ' ) ); ?><?=_h($this->room[0]['roomNumber']);?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>form/runEditRoom/" id="validateSubmitForm" method="post" autocomplete="off">
		
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
                        <div class="control-group">
                            <label class="control-label" for="buildingCode"><font color="red">*</font> <?php _e( _t( 'Building' ) ); ?></label>
                            <div class="controls">
                                <select style="width:100%" name="buildingCode" id="select2_9" required>
                                    <option value="">&nbsp;</option>
                                    <?=table_dropdown('building', 'buildingCode', 'buildingName', _h($this->room[0]['buildingCode']) );?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
					
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="roomCode"><font color="red">*</font> <?php _e( _t( 'Room Code' ) ); ?></label>
							<div class="controls"><input class="span12" id="roomCode" name="roomCode" type="text" value="<?=_h($this->room[0]['roomCode']);?>" required /></div>
						</div>
						<!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
                    <div class="span6">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="roomNumber"><font color="red">*</font> <?php _e( _t( 'Room Number' ) ); ?></label>
                            <div class="controls"><input class="span12" id="roomNumber" name="roomNumber" type="text" value="<?=_h($this->room[0]['roomNumber']);?>" required /></div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="roomCap"><font color="red">*</font> <?php _e( _t( 'Seating Capacity' ) ); ?></label>
                            <div class="controls"><input class="span12" id="roomCap" name="roomCap" type="text" value="<?=_h($this->room[0]['roomCap']);?>" required /></div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
					
				</div>
				<!-- // Row END -->
			
				<hr class="separator" />
				
				<!-- Form actions -->
				<div class="form-actions">
					<input name="roomID" type="hidden" value="<?=_h($this->room[0]['roomID']);?>" />
					<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Save' ) ); ?></button>
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