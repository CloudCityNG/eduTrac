<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * View Progress Report View
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
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>parents/portal/<?=bm();?>" class="glyphicons home"><i></i> <?php _e( _t( 'Home' ) ); ?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>parents/children/<?=bm();?>" class="glyphicons group"><i></i> <?php _e( _t( 'Children' ) ); ?></a></li>
    <li class="divider"></li>
	<li><?php _e( _t( 'View Progress Report' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'View Progress Report for ' ) ); ?><?=get_name(_h($this->viewProgress[0]['stuID']));?></h3>
<div class="innerLR">
		
		<!-- Widget -->
		<div class="widget widget-heading-simple widget-body-gray">
			
			<div class="widget-body">
			
				<!-- Row -->
				<div class="row-fluid">
					
					<!-- Column -->
					<div class="span6">
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><?php _e( _t( 'Grade' ) ); ?></label>
							<div class="controls"><input type="text" readonly class="span12" value="<?=_h($this->viewProgress[0]['grade']);?>" /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><?php _e( _t( 'Subject' ) ); ?></label>
							<div class="controls"><input type="text" readonly class="span12" value="<?=_h($this->viewProgress[0]['subject']);?>" /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Course Title' ) ); ?></label>
                            <div class="controls"><input type="text" readonly class="span12" value="<?=_h($this->viewProgress[0]['courseTitle']);?>" /></div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Date' ) ); ?></label>
                            <div class="controls"><input type="text" readonly class="span12" value="<?=_h($this->viewProgress[0]['date']);?>" /></div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
                    <div class="span6">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Semester' ) ); ?></label>
                            <div class="controls"><input type="text" readonly class="span12" value="<?=_h($this->viewProgress[0]['semester']);?>" /></div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Behavior' ) ); ?></label>
                            <div class="controls"><input type="text" readonly class="span12" value="<?=_h($this->viewProgress[0]['behavior']);?>" /></div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Assignments' ) ); ?></label>
                            <div class="controls"><input type="text" readonly class="span12" value="<?=_h($this->viewProgress[0]['assignments']);?>" /></div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
					
				</div>
				<!-- // Row END -->
				
				<!-- Row -->
                <div class="row-fluid">
                    
                    <!-- Column -->
                    <div class="span12">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="email_key"><?php _e( _t( 'Notes' ) ); ?></label>
                            <div class="controls"><textarea id="mustHaveId" class="wysihtml5 span12" readonly rows="5"><?=_h($this->viewProgress[0]['notes']);?></textarea></div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
                    
                </div>
                <!-- // Row END -->
			
				<hr class="separator" />
				
				<!-- Form actions -->
				<div class="form-actions">
					<button type="button" class="btn btn-icon btn-primary glyphicons circle_minus" onclick="window.location='<?=BASE_URL;?>parents/children/<?=bm();?>'"><i></i><?php _e( _t( 'Cancel' ) ); ?></button>
				</div>
				<!-- // Form actions END -->
				
			</div>
		</div>
		<!-- // Widget END -->
	<div class="separator bottom"></div>
    
	<!-- // Widget END -->
	
</div>	
	
		
		</div>
		<!-- // Content END -->