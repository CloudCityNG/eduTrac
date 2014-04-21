<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Timetable View
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
 * @since       4.0.9
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */
?>

<script type="text/javascript">
$(document).ready(function() { 
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    var calendar = $('#calendar').fullCalendar({
        eventMouseover: function( event, jsEvent, view ) { 
            var item = $(this);
            if(item.find('.nube').length == 0){
                var info = '<span class="nube"><p><strong>End:</strong> '+event.end+' <br /> <strong>Room:</strong> '+event.roomCode+' <br /> <strong>Description:</strong> '+event.description+'</p></span>';
                item.append(info);
            }
            if(parseInt(item.css('top')) <= 200){
                item.find('.nube').css({'top': 20,'bottom':'auto'});
                item.parent().find('.fc-event').addClass('z0');
            }
            item.find('.nube').stop(true,true).fadeIn();
        },
        eventMouseout: function( event, jsEvent, view ) { 
            var item = $(this);
            item.find('.nube').stop(true,true).fadeOut();
        },
    //configure options for the calendar
       header: {
          left: 'title',
          center: '',
          right: ''
       },
       selectable: true,
       selectHelper: true,


       // this is where you specify where to pull the events from.

       events: "<?=BASE_URL;?>timetable/getEvents/",
       editable: false,
       defaultView: 'agendaWeek',
       allDayDefault: false,
       //etc etc
   });
   	$(".change-view").click(function(){
		 var data=$(this).data();
		$('#calendar').fullCalendar( 'changeView', data.view ); 
	});
	$(".change-today").click(function(){
		$('#calendar').fullCalendar( 'today' );
	});
	$(".change").click(function(){
		  var data=$(this).data();
		$('#calendar').fullCalendar( data.change );
	});
   
});
</script>

                <ol class="breadcrumb">
                        <li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>"><?=_t( 'Dashboard' );?></a></li>
                        <li class="active"><?=_t( 'Timetable' );?></li>
                </ol>
                <!-- //breadcrumb-->
                
                <div id="content">
				<div class="tabbable">
						<ul class="nav nav-tabs" data-provide="tabdrop">
								<li><a href="#" class="change" data-change="prev"><i class="fa fa-chevron-left"></i></a></li>
								<li><a href="#" class="change" data-change="next"><i class="fa fa-chevron-right"></i></a></li>
								<li><a href="#" data-view="month" data-toggle="tab" class="change-view"><?=_t( 'Month' );?></a></li>
								<li class="active"><a href="#" data-view="agendaWeek" data-toggle="tab" class="change-view"><?=_t( 'Week' );?></a></li>
								<li><a href="#" data-view="agendaDay" data-toggle="tab" class="change-view"><?=_t( 'Day' );?></a></li>
								<li><a href="#" class="change-today"><?=_t( 'Today');?></a></li>
						</ul>
						<div class="tab-content">
								<div class="row">
                        
	                                <div class="col-lg-12">
	                                        <section class="panel">
	                                                <header class="panel-heading sm" data-color="theme-inverse">
	                                                        <h2><strong><?=_t( 'Time' );?></strong><?=_t( 'table' );?></h2>
	                                                </header>
	                                                <div class="panel-body">
	                                                	<section class="panel">
																<div class="col-lg-12" >
																		<div id="calendar"></div>
																</div>
														</section>
	                                                </div>
	                                        </section>
	                                </div>

                        		</div>
                        		<!-- //content > row-->
                		</div>
                       
				</div> 
                </div>
                <!-- //content-->