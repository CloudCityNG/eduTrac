<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Batch Registration View
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

<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('#courseSecID').live('change', function(event) {
        $.ajax({
            type    : 'POST',
            url     : '<?=BASE_URL;?>section/runSecLookup/',
            dataType: 'json',
            data    : $('#validateSubmitForm').serialize(),
            cache: false,
            success: function( data ) {
                   for(var id in data) {        
                          $(id).val( data[id] );
                   }
            }
        });
    });
});
</script>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Batch Registration' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Batch Registration' ) ); ?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>section/runBatchReg/" id="validateSubmitForm" method="post" autocomplete="off">
		
		<!-- Widget -->
		<div class="widget widget-heading-simple widget-body-gray">
		
			<!-- Widget heading -->
			<div class="widget-head">
				<h4 class="heading"><font color="red">*</font> <?php _e( _t( 'Indicates field is required' ) ); ?></h4>
			</div>
			<!-- // Widget heading END -->
			
			<div class="widget-body">
			    
			    <div class="tab-pane" id="search-users">
                    <div class="widget widget-heading-simple widget-body-white margin-none">
                        <div class="widget-body">
                            
                            <div class="widget widget-heading-simple widget-body-simple text-left">
                                <p><?=_t('Use the batch registration process if you need to register a group of students into a particular course section. 
                                This screen comes in handy when you need to create a saved query from a course section you need to cancel. 
                                The best way is to create your saved query by selecting the student id\'s in the old course section with an \'A\' 
                                or \'N\' status. Register them into the new course section and then cancel the old course section.');?></p>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
                <div class="break"></div>
			
				<!-- Row -->
				<div class="row-fluid">
					<!-- Column -->
					<div class="span6">
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Course Sec ID' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="courseSecID" id="courseSecID" class="span12" required />
                                <input type="text" id="courseSecCode" readonly="readonly" class="span4 center" required />
                                <input type="text" id="secShortTitle" readonly="readonly" class="span4 center" required />
                                <input type="text" id="term" readonly="readonly" class="span4 center" required />
                                 i.e. (00000000001 or 1)
                                <a href="#myModal" data-toggle="modal"><img src="<?=BASE_URL;?>static/common/theme/images/help.png" /></a>
                            </div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Saved Query' ) ); ?></label>
                            <div class="controls">
                                <select style="width:100%" name="queryID" id="select2_10" required>
							        <option value="">&nbsp;</option>
							        <?php userQuery(); ?>
						        </select>
                            </div>
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
	
	<div class="modal hide fade" id="myModal">
        <div class="modal-body">
            <p><?=_t('You can find the id of a course section by visiting the');?> <a href="<?=BASE_URL;?>section/"><?=_t('search');?></a> <?=_t('screen for sections. The id is the first column in the table from the search result.');?></p>
        </div>
        <div class="modal-footer">
            <a href="#" data-dismiss="modal" class="btn btn-primary"><?php _e( _t( 'Cancel' ) ); ?></a>
        </div>
    </div>
	
</div>	
		
		</div>
		<!-- // Content END -->