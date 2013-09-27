<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Site Header
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

ob_start();
ob_implicit_flush(0);
use \eduTrac\Classes\Libraries\Hooks;
use \eduTrac\Classes\Libraries\Cookies;
$auth = new Cookies;
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7 fluid sticky-sidebar"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8 fluid sticky-top sticky-sidebar"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9 fluid sticky-top sticky-sidebar"> <![endif]-->
<!--[if gt IE 8]> <html class="ie gt-ie8 fluid sticky-top sticky-sidebar"> <![endif]-->
<!--[if !IE]><!--><html class="fluid sticky-top sticky-sidebar"><!-- <![endif]-->
<head>
	<title><?php if(isset($this->staticTitle)) { foreach($this->staticTitle as $title) { echo $title . ' - ' . Hooks::get_option('site_title'); } } else { echo Hooks::get_option('site_title'); } ?></title>
	
	<!-- Meta -->
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
	<link rel="shortcut icon" href="<?=BASE_URL;?>favicon.ico" type="image/x-icon">
	
	<!-- Bootstrap -->
	<link href="<?=BASE_URL;?>static/common/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="<?=BASE_URL;?>static/common/bootstrap/css/responsive.css" rel="stylesheet" type="text/css" />
	
	<!-- Glyphicons Font Icons -->
	<link href="<?=BASE_URL;?>static/common/theme/fonts/glyphicons/css/glyphicons.css" rel="stylesheet" />
	
	<link rel="stylesheet" href="<?=BASE_URL;?>static/common/theme/fonts/font-awesome/css/font-awesome.min.css">
	<!--[if IE 7]><link rel="stylesheet" href="<?=BASE_URL; ?>static/common/theme/fonts/font-awesome/css/font-awesome-ie7.min.css"><![endif]-->
	
	<!-- Uniform Pretty Checkboxes -->
	<link href="<?=BASE_URL;?>static/common/theme/scripts/plugins/forms/pixelmatrix-uniform/css/uniform.default.css" rel="stylesheet" />
	
	<!--[if IE]><!--><script src="<?=BASE_URL;?>static/common/theme/scripts/plugins/other/excanvas/excanvas.js"></script><!--<![endif]-->
	<!--[if lt IE 8]><script src="<?=BASE_URL; ?>static/common/theme/scripts/plugins/other/json2.js"></script><![endif]-->
	
	<!-- Bootstrap Extended -->
	<link href="<?=BASE_URL;?>static/common/bootstrap/extend/jasny-fileupload/css/fileupload.css" rel="stylesheet">
	<link href="<?=BASE_URL;?>static/common/bootstrap/extend/bootstrap-wysihtml5/css/bootstrap-wysihtml5-0.0.2.css" rel="stylesheet">
	<link href="<?=BASE_URL;?>static/common/bootstrap/extend/bootstrap-select/bootstrap-select.css" rel="stylesheet" />
	<link href="<?=BASE_URL;?>static/common/bootstrap/extend/bootstrap-toggle-buttons/static/stylesheets/bootstrap-toggle-buttons.css" rel="stylesheet" />
	
	<!-- DateTimePicker Plugin -->
	<link href="<?=BASE_URL;?>static/common/theme/scripts/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" rel="stylesheet" />
	
	<!-- JQueryUI -->
	<link href="<?=BASE_URL;?>static/common/theme/scripts/plugins/system/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" />
	
	<!-- MiniColors ColorPicker Plugin -->
	<link href="<?=BASE_URL;?>static/common/theme/scripts/plugins/color/jquery-miniColors/jquery.miniColors.css" rel="stylesheet" />
	
	<!-- Notyfy Notifications Plugin -->
	<link href="<?=BASE_URL;?>static/common/theme/scripts/plugins/notifications/notyfy/jquery.notyfy.css" rel="stylesheet" />
	<link href="<?=BASE_URL;?>static/common/theme/scripts/plugins/notifications/notyfy/themes/default.css" rel="stylesheet" />
	
	<!-- Gritter Notifications Plugin -->
	<link href="<?=BASE_URL;?>static/common/theme/scripts/plugins/notifications/Gritter/css/jquery.gritter.css" rel="stylesheet" />

	<!-- Google Code Prettify Plugin -->
	<link href="<?=BASE_URL;?>static/common/theme/scripts/plugins/other/google-code-prettify/prettify.css" rel="stylesheet" />

	<!-- Pageguide Guided Tour Plugin -->
	<!--[if gt IE 8]><!--><link media="screen" href="<?=BASE_URL;?>static/common/theme/scripts/plugins/other/pageguide/css/pageguide.css" rel="stylesheet" /><!--<![endif]-->
	
	<!-- JQuery -->
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	
	<?php
	if (isset($this->css)) {
        foreach ($this->css as $css){
            _e( '<link href="' . BASE_URL . 'static/common/'.$css.'" rel="stylesheet">' . "\n" );
        }
    }
	?>
	
	<!-- Main Theme Stylesheet :: CSS -->
	<link href="<?=BASE_URL;?>static/common/theme/css/style-default.css?1371788382" rel="stylesheet" type="text/css" />
	
	
	<!-- LESS.js Library -->
	<script src="<?=BASE_URL;?>static/common/theme/scripts/plugins/system/less.min.js"></script>
	<?php head(); ?>
</head>
<body class="">
	
		<!-- Main Container Fluid -->
	<div class="container-fluid fluid menu-left">
		
				
		<!-- Content -->
		<div id="content">
		
				<!-- Top navbar (note: add class "navbar-hidden" to close the navbar by default) -->
		<div class="navbar main hidden-print">
			
			<!-- Menu Toggle Button -->
			<button type="button" class="btn btn-navbar">
				<span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
			</button>
			<!-- // Menu Toggle Button END -->
			
						<!-- Top Menu -->
			<ul class="topnav pull-left">
				<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> Dashboard</a></li>
				<li<?=ae('access_plugin_screen');?> class="dropdown dd-1">
					<a href="" data-toggle="dropdown" class="glyphicons electrical_plug"><i></i>Plugins <span class="caret"></span></a>
					<ul class="dropdown-menu pull-left">
						<li<?=ae('access_plugin_screen');?>><a href="<?=BASE_URL;?>plugins/<?=bm();?>" class="glyphicons cogwheel"><i></i><?php _e( _t( 'Plugins' ) ); ?></a></li>
						<?php Hooks::list_plugin_admin_pages();?>
						<!-- // Components Submenu Regular Items END -->
					</ul>
				</li>
				<li class="dropdown dd-1">
					<a href="" data-toggle="dropdown" class="glyphicons notes"><i></i><?php _e( _t( 'Screens' ) ); ?> <span class="caret"></span></a>
					<ul class="dropdown-menu pull-left">
                        
                        <li<?=ae('edit_settings');?> class="dropdown submenu">
                            <a data-toggle="dropdown" class="dropdown-toggle glyphicons settings"><i></i><?php _e( _t( 'Settings' ) ); ?></a>
                            <ul class="dropdown-menu submenu-show submenu-hide pull-right">
                                <li class=""><a href="<?=BASE_URL;?>setting/<?=bm();?>"><?php _e( _t( 'General' ) ); ?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>cron/<?=bm();?>"><?php _e( _t( 'Cron Jobs' ) ); ?></a></li>
                                <!-- <li class=""><a href="<?=BASE_URL;?>reservation/<?=bm();?>"><?php _e( _t( 'Reservation' ) ); ?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>reservation/category/<?=bm();?>"><?php _e( _t( 'Reservation Categories' ) ); ?></a></li> -->
                            </ul>
                        </li>
						
						<li<?=ae('access_forms');?> class="dropdown submenu">
                            <a data-toggle="dropdown" class="dropdown-toggle glyphicons notes_2"><i></i><?php _e( _t( 'Forms' ) ); ?></a>
                            <ul class="dropdown-menu submenu-show submenu-hide pull-right">
                                <li class=""><a href="<?=BASE_URL;?>form/semester/<?=bm();?>"><?php _e( _t( '(SEM) - Semester' ) ); ?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>form/term/<?=bm();?>"><?php _e( _t( '(TERM) - Term' ) ); ?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>form/acad_year/<?=bm();?>"><?php _e( _t( '(AYR) - Academic Year' ) ); ?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>form/department/<?=bm();?>"><?php _e( _t( '(DEPT) - Department' ) ); ?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>form/subject/<?=bm();?>"><?php _e( _t( '(SUBJ) - Subject' ) ); ?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>form/credit_load/<?=bm();?>"><?php _e( _t( '(CRL) - Credit Load' ) ); ?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>form/class_year/<?=bm();?>"><?php _e( _t( '(CLYR) - Class Year' ) ); ?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>form/degree/<?=bm();?>"><?php _e( _t( '(DEG) - Degree' ) ); ?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>form/major/<?=bm();?>"><?php _e( _t( '(MAJR) - Major' ) ); ?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>form/minor/<?=bm();?>"><?php _e( _t( '(MINR) - Minor' ) ); ?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>form/ccd/<?=bm();?>"><?php _e( _t( '(CCD) - CCD' ) ); ?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>form/specialization/<?=bm();?>"><?php _e( _t( '(SPEC) - Specialization' ) ); ?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>form/cip/<?=bm();?>"><?php _e( _t( '(CIP) - CIP' ) ); ?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>form/location/<?=bm();?>"><?php _e( _t( '(LOC) - Location' ) ); ?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>form/building/<?=bm();?>"><?php _e( _t( '(BLDG) - Building' ) ); ?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>form/room/<?=bm();?>"><?php _e( _t( '(ROOM) - Room' ) ); ?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>form/school/<?=bm();?>"><?php _e( _t( '(SCH) - School' ) ); ?></a></li>
                            </ul>
                        </li>
                        
                        <li<?=ae('access_save_query_screens');?> class="dropdown submenu">
                            <a data-toggle="dropdown" class="dropdown-toggle glyphicons database_plus"><i></i><?php _e( _t( 'Saved Query' ) ); ?></a>
                            <ul class="dropdown-menu submenu-show submenu-hide pull-right">
                                <li class=""><a href="<?=BASE_URL;?>savequery/<?=bm();?>"><?php _e( _t( 'Queries' ) ); ?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>savequery/add/<?=bm();?>"><?php _e( _t( 'Create Query' ) ); ?></a></li>
                            </ul>
                        </li>
                        
                        <li<?=ae('access_sql_interface_screen');?>><a href="<?=BASE_URL;?>sql/<?=bm();?>" class="glyphicons database_plus"><i></i><?php _e( _t( 'SQL Interface' ) ); ?></a></li>
						
						<li<?=ae('access_acad_prog_screen');?> class="dropdown submenu">
                            <a data-toggle="dropdown" class="dropdown-toggle glyphicons cargo"><i></i><?php _e( _t( 'Acad Program' ) ); ?></a>
                            <ul class="dropdown-menu submenu-show submenu-hide pull-right">
                                <li class=""><a href="<?=BASE_URL;?>program/<?=bm();?>"><?php _e( _t( '(PROG) - Program' ) ); ?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>program/add/<?=bm();?>"><?php _e( _t( '(APRG) - New Program' ) ); ?></a></li>
                            </ul>
                        </li>
						
						<li<?=ae('access_course_screen');?> class="dropdown submenu">
                            <a data-toggle="dropdown" class="dropdown-toggle glyphicons keynote"><i></i><?php _e( _t( 'Course' ) ); ?></a>
                            <ul class="dropdown-menu submenu-show submenu-hide pull-right">
                                <li class=""><a href="<?=BASE_URL;?>course/<?=bm();?>"><?php _e( _t( '(CRSE) - Course' ) ); ?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>course/add/<?=bm();?>"><?php _e( _t( '(ACRS) - New Course' ) ); ?></a></li>
                            </ul>
                        </li>
                        
                        <li<?=ae('access_course_sec_screen');?> class="dropdown submenu">
                            <a data-toggle="dropdown" class="dropdown-toggle glyphicons book"><i></i><?php _e( _t( 'Course Section' ) ); ?></a>
                            <ul class="dropdown-menu submenu-show submenu-hide pull-right">
                                <li class=""><a href="<?=BASE_URL;?>section/<?=bm();?>"><?php _e( _t( '(SECT) - Section' ) ); ?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>section/register/<?=bm();?>"><?php _e( _t( '(RGN) - Register' ) ); ?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>section/courses/<?=bm();?>"><?php _e( _t( '(GRDE) - Grading' ) ); ?></a></li>
                            </ul>
                        </li>
                        
                        <li<?=ae('access_institutions_screen');?> class="dropdown submenu">
                            <a data-toggle="dropdown" class="dropdown-toggle glyphicons building"><i></i><?php _e( _t( 'Institution' ) ); ?></a>
                            <ul class="dropdown-menu submenu-show submenu-hide pull-right">
                                <li class=""><a href="<?=BASE_URL;?>institution/<?=bm();?>"><?php _e( _t( '(INST) - Institution' ) ); ?></a></li>
                                <li<?=ae('add_institution');?> class=""><a href="<?=BASE_URL;?>institution/add/<?=bm();?>"><?php _e( _t( '(AINST) - New Institution' ) ); ?></a></li>
                            </ul>
                        </li>
						
						<li<?=ae('edit_settings');?> class="dropdown submenu">
                            <a data-toggle="dropdown" class="dropdown-toggle glyphicons e-mail"><i></i><?php _e( _t( 'Communication Mgmt' ) ); ?></a>
                            <ul class="dropdown-menu submenu-show submenu-hide pull-right">
                                <li class=""><a href="<?=BASE_URL;?>mailer/<?=bm();?>"><?php _e( _t( 'Email Templates' ) ); ?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>mailer/add/<?=bm();?>"><?php _e( _t( 'Add Email Template' ) ); ?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>mailer/schedule/<?=bm();?>"><?php _e( _t( 'Schedule Email' ) ); ?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>mailer/queue/<?=bm();?>"><?php _e( _t( 'Email Queue' ) ); ?></a></li>
                            </ul>
                        </li>
						
						<li<?=ae('access_nslc');?> class="dropdown submenu">
							<a data-toggle="dropdown" class="dropdown-toggle glyphicons hdd"><i></i><?php _e( _t( 'NSLC' ) ); ?></a>
							<ul class="dropdown-menu submenu-show submenu-hide pull-right">
							    <li class=""><a href="<?=BASE_URL;?>nslc/purge/<?=bm();?>"><?php _e( _t( '(NSCP) Purge' ) ); ?></a></li>
								<li class=""><a href="<?=BASE_URL;?>nslc/setup/<?=bm();?>"><?php _e( _t( '(NSCS) Setup' ) ); ?></a></li>
								<li class=""><a href="<?=BASE_URL;?>nslc/extraction/<?=bm();?>"><?php _e( _t( '(NSCX) Extraction' ) ); ?></a></li>
								<li class=""><a href="<?=BASE_URL;?>nslc/verification/<?=bm();?>"><?php _e( _t( '(NSCE) Verification' ) ); ?></a></li>
								<li class=""><a href="<?=BASE_URL;?>nslc/<?=bm();?>"><?php _e( _t( '(NSCC) Correction' ) ); ?></a></li>
								<!-- <li class=""><a href="<?=BASE_URL;?>nslc/file/<?=bm();?>"><?php _e( _t( '(NSCT) NSLC File' ) ); ?></a></li> -->
							</ul>
						</li>
						
						<li<?=ae('access_person_screen');?> class="dropdown submenu">
                            <a data-toggle="dropdown" class="dropdown-toggle glyphicons user"><i></i><?php _e( _t( 'Person' ) ); ?></a>
                            <ul class="dropdown-menu submenu-show submenu-hide pull-right">
                                <li class=""><a href="<?=BASE_URL;?>person/<?=bm();?>"><?php _e( _t( '(NAE) Search' ) ); ?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>person/add/<?=bm();?>"><?php _e( _t( '(APER) Add Person' ) ); ?></a></li>
                            </ul>
                        </li>
                        
                        <li<?=ae('access_student_portal');?> class=""><a href="<?=BASE_URL;?>student/portal/<?=bm();?>" class="glyphicons globe"><i></i><?php _e( _t( 'Student Portal' ) ); ?></a></li>
                        
                        <li<?=ae('access_application_screen');?> class=""><a href="<?=BASE_URL;?>application/<?=bm();?>" class="glyphicons show_big_thumbnails"><i></i><?php _e( _t( '(APPL) Application' ) ); ?></a></li>
                        
                        <li<?=ae('access_faculty_screen');?> class=""><a href="<?=BASE_URL;?>faculty/<?=bm();?>" class="glyphicons user"><i></i><?php _e( _t( '(FAC) Faculty' ) ); ?></a></li>
                        
                        <li<?=ae('access_staff_screen');?> class=""><a href="<?=BASE_URL;?>staff/<?=bm();?>" class="glyphicons user"><i></i><?php _e( _t( '(STAF) Staff' ) ); ?></a></li>
                        
                        <li<?=ae('access_student_screen');?> class="dropdown submenu">
                            <a data-toggle="dropdown" class="dropdown-toggle glyphicons user"><i></i><?php _e( _t( 'Student' ) ); ?></a>
                            <ul class="dropdown-menu submenu-show submenu-hide pull-right">
                                <li<?=ae('access_student_screen');?> class=""><a href="<?=BASE_URL;?>student/<?=bm();?>"><?php _e( _t( '(SPRO) Student Profile' ) ); ?></a></li>
                                <li<?=ae('graduate_students');?> class=""><a href="<?=BASE_URL;?>student/graduation/<?=bm();?>"><?php _e( _t( 'Graduate Student(s)' ) ); ?></a></li>
                                <li<?=ae('generate_transcript');?> class=""><a href="<?=BASE_URL;?>student/tran/<?=bm();?>"><?php _e( _t( 'Generate Transcript' ) ); ?></a></li>
                            </ul>
                        </li>
						
						<li<?=ae('access_permission_screen');?> class=""><a href="<?=BASE_URL;?>permission/<?=bm();?>" class="glyphicons keys"><i></i><?php _e( _t( '(MPRM) Manage Perm' ) ); ?></a></li>
						
                        <li<?=ae('access_role_screen');?> class=""><a href="<?=BASE_URL;?>role/<?=bm();?>" class="glyphicons rotation_lock"><i></i><?php _e( _t( '(MRLE) Manage Role' ) ); ?></a></li>
                        
                        <li<?=ae('access_error_log_screen');?>><a href="<?=BASE_URL;?>error/logs/<?=bm();?>" class="glyphicons file"><i></i><?php _e( _t( 'Error Log' ) ); ?></a></li>
                        
						<li<?=ae('access_audit_trail_screen');?>><a href="<?=BASE_URL;?>audittrail/<?=bm();?>" class="glyphicons road"><i></i><?php _e( _t( 'Audit Trail' ) ); ?></a></li>
					</ul>
				</li>
				<li class="search open">
					<form autocomplete="off" class="dropdown dd-1" method="post" action="<?=BASE_URL;?>dashboard/search/">
						<input type="text" name="screen" value="" placeholder="Type for suggestions .." data-toggle="aScreen" />
						<button type="button" class="glyphicons search"><i></i></button>
					</form>
				</li>
			</ul>
			<!-- // Top Menu END -->
						
						
			<!-- Top Menu Right -->
			<ul class="topnav pull-right hidden-phone">
			
				<!-- Profile / Logout menu -->
				<li class="account dropdown dd-1">
					<a data-toggle="dropdown" href="" class="glyphicons logout lock"><span class="hidden-tablet hidden-phone hidden-desktop-1"><?=$auth->getPersonField('uname');?></span><i></i></a>
					<ul class="dropdown-menu pull-right">
						<li class="profile">
							<span>
								<span class="heading"><?php _e( _t( 'Profile' ) ); ?> <a href="<?=BASE_URL;?>profile/" class="pull-right"><?php _e( _t( 'edit' ) ); ?></a></span>
								<span class="avatar"><?=get_user_avatar($auth->getPersonField('email'),'48');?></span>
								<span class="details">
									<a href="<?=BASE_URL;?>profile/"><?=$auth->getPersonField('fname').' '.$auth->getPersonField('lname');?></a>
									<?=$auth->getPersonField('email');?>
								</span>
								<span class="clearfix"></span>
							</span>
						</li>
						<li>
							<span>
								<a class="btn btn-default btn-mini pull-right" href="<?=BASE_URL;?>dashboard/logout/"><?php _e( _t( 'Sign Out' ) ); ?></a>
							</span>
						</li>
					</ul>
									</li>
				<!-- // Profile / Logout menu END -->
				
			</ul>
			<div class="clearfix"></div>
			<!-- // Top Menu Right END -->
			
		</div>
		<!-- Top navbar END -->
        <?php redirect_upgrade_db(); ?>
	