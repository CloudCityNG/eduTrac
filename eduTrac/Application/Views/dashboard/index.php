<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Dashboard View
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
$cache = new \eduTrac\Classes\Libraries\Cache('3600', BASE_PATH . 'tmp/cache/', 'rss');
?>

<script type="text/javascript">
$(document).ready(function() { 
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    var calendar = $('#calendar').fullCalendar({
    //configure options for the calendar
       header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,agendaWeek,agendaDay'
       },
       selectable: true,
       selectHelper: true,
       select: function() {
            $('#add-event').dialog('open');
       },


       // this is where you specify where to pull the events from.

       events: "<?=BASE_URL;?>dashboard/getEvents/",
       editable: true,
       defaultView: 'month',
       allDayDefault: false,
       //etc etc
   });
   
$("#add-event").dialog({
    autoOpen: false,
    height: 'auto',
    width: 'auto',
    autoResize:true,
    modal: true,
    resizable: false,
    title: 'Add Event',
    open: function(){
        $("#title").attr("tabindex","1");
    },
    buttons: {
        "Save Event": function() {
            $.ajax({
                type:"POST",
                url: "<?=BASE_URL;?>dashboard/runEvent/",
                data: $('#validateSubmitForm').serialize(),
                success: function(){
                    calendar.fullCalendar('refetchEvents');
                }
            });
            $(this).dialog("close");
        },

        Cancel: function() {
            $(this).dialog("close");
        }
    },
});
   
});
</script>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="#" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
</ul>

<?=show_update_message();?>

<h2><?php _e( _t( 'Dashboard' ) ); ?></h2>
<div class="innerLR">

	<div class="row-fluid">
		<div class="span9">
	    <?php if(!$cache->setCache()) : ?>
			<!-- 7 Media Web Solutions, LLC News -->
			<div class="widget widget-heading-simple widget-body-white">
				<div class="widget-head">
					<h4 class="heading glyphicons cardio"><i></i><?php _e( _t( 'Latest 7 Media News' ) ); ?></h4>
				</div>
				<div class="widget-body">
                    <?php  $rss = new \DOMDocument();
                    $rss->load('http://feeds.feedburner.com/7mws/');
                    $feed = array();
                    foreach ($rss->getElementsByTagName('item') as $node) {
                    $item = array (
                    'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
                    'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
                    'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
                    'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
                    );
                    array_push($feed, $item);
                    }
                    $limit = 2;
                    for($x=0;$x<$limit;$x++) {
                    $title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
                    $link = $feed[$x]['link'];
                    $description = $feed[$x]['desc'];
                    $date = date('l F d, Y', strtotime($feed[$x]['date']));
                    echo '<p><strong><a href="'.$link.'" title="'.$title.'">'.$title.'</a></strong><br />';
                    echo '<small><em>Posted on '.$date.'</em></small></p>';
                    echo '<p>'.$description.'</p>';
                    } ?>
				</div>
			</div>
			<!-- // 7 Media Web Solutions, LLC News END -->
        <?php endif; echo $cache->getCache(); ?>
        
        <!-- Widget -->
        <div class="widget" style="display:none;">
            <div class="widget-head">
                <h4 class="heading glyphicons calendar"><i></i><?php _e( _t( 'Calendar' ) ); ?></h4>
            </div>
            
            <div id="add-event" title="Add New Event" style="display:none;">
                <form class="form-horizontal margin-none" action="" id="validateSubmitForm" method="post" autocomplete="off">
                    <!-- Group -->
                    <div class="control-group">
                        <label class="control-label"><?php _e( _t( 'Event Name' ) ); ?></label>
                        <div class="controls">
                            <input type="text" name="title" class="span5" />
                        </div>
                    </div>
                    <!-- // Group END -->
                    
                    <!-- Group -->
                    <div class="control-group">
                        <label class="control-label"><?php _e( _t( 'Description' ) ); ?></label>
                        <div class="controls">
                            <textarea name="description" rows="5" cols="20" style="width:396px"></textarea>
                        </div>
                    </div>
                    <!-- // Group END -->
                    
                    <!-- Group -->
                    <div class="control-group">
                        <label class="control-label"><?php _e( _t( 'Room' ) ); ?></label>
                        <div class="controls">
                            <select name="roomID" style="width:100%" id="select2_9">
                                <option value="">&nbsp;</option>
                                <?php table_dropdown('room','','roomID','roomCode','roomCode'); ?>
                            </select>
                        </div>
                    </div>
                    <!-- // Group END -->
                    
                    <!-- Group -->
                    <div class="control-group">
                        <label class="control-label"><?php _e( _t( 'Date' ) ); ?></label>
                        <div class="controls">
                            <div class="input-append date" id="datetimepicker6">
                                <input id="startDate" name="startDate" type="text" />
                                <span class="add-on"><i class="icon-th"></i></span>
                            </div>
                        </div>
                    </div>
                    <!-- // Group END -->
                    
                    <!-- Group -->
                    <div class="control-group">
                        <label class="control-label"><?php _e( _t( 'Start Time' ) ); ?></label>
                        <div class="controls">
                            <div class="input-append bootstrap-timepicker">
                                <input id="timepicker13" type="text" name="startTime" class="input-small" />
                                <span class="add-on"><i class="icon-time"></i></span>
                            </div>
                        </div>
                    </div>
                    <!-- // Group END -->
                    
                    <!-- Group -->
                    <div class="control-group">
                        <label class="control-label"><?php _e( _t( 'End Time' ) ); ?></label>
                        <div class="controls">
                            <div class="input-append bootstrap-timepicker">
                                <input id="timepicker14" type="text" name="endTime" class="input-small" />
                                <span class="add-on"><i class="icon-time"></i></span>
                            </div>
                        </div>
                    </div>
                    <!-- // Group END -->
                    
                    <!-- Group -->
                    <div class="control-group">
                        <label class="control-label"><?php _e( _t( 'Repeat?' ) ); ?></label>
                        <div class="controls">
                            <input type="checkbox" name="repeats" id="repeats" value="1" />
                        </div>
                    </div>
                    <!-- // Group END -->
                    
                    <!-- Group -->
                    <div class="control-group">
                        <label class="control-label"><?php _e( _t( 'Repeat Occurrence' ) ); ?></label>
                        <div class="controls">
                            <input type="radio" value="1" name="repeatFreq" align="bottom" />
                            <?php _e( _t( 'Every Day' ) ); ?>
                            
                            <input type="radio" value="7" name="repeatFreq" align="bottom" />
                            <?php _e( _t( 'Weekly' ) ); ?>
                            
                            <input type="radio" value="14" name="repeatFreq" align="bottom" />
                            <?php _e( _t( 'Every Two Weeks' ) ); ?>
                        </div>
                    </div>
                    <!-- // Group END -->
                </form>
            </div>
        
            <div class="widget-body">
                <div id="calendar"></div>
            </div>
        </div>
        <!-- // Widget END -->
		
		</div>
		<div class="span3">
			
			<!-- Widget -->
			<div class="widget widget-heading-simple widget-body-grey">
					
				<!-- Widget Heading -->
				<div class="widget-head">
					<h4 class="heading glyphicons life_preserver"><i></i><?php _e( _t( 'Support' ) ); ?></h4>
				</div>
				<!-- // Widget Heading END -->
				
				<div class="widget-body">
					<div class="controls-group center" data-gridalicious="false" data-type="slide" data-images="false">
				        <ul style="list-style:none;margin:0;">
						  <li><a href="http://community.7mediaws.org/projects/edutrac/" class="glyphicons group"><i></i> <?php _e( _t( 'Community Support Site' ) ); ?></a></li>
					      <li><a href="http://edutrac.org/survey/index.php/survey/index" class="glyphicons check"><i></i> <?php _e( _t( 'eduTrac Satisfaction Survey' ) ); ?></a></li>
					    </ul>
					</div>
				</div>
			</div>
			<!-- // Widget END -->
			
		</div>
	</div>
	
</div>
	
		
		</div>
		<!-- // Content END -->