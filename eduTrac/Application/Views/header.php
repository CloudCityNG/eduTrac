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
 * @since       3.0.0
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
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7 fluid top-full"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8 fluid top-full sticky-top"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9 fluid top-full sticky-top"> <![endif]-->
<!--[if gt IE 8]> <html class="ie gt-ie8 fluid top-full sticky-top"> <![endif]-->
<!--[if !IE]><!--><html class="fluid top-full sticky-top"><!-- <![endif]-->
<head>
	<title><?php if(isset($this->staticTitle)) { foreach($this->staticTitle as $title) { echo $title . ' - ' . Hooks::get_option('site_title'); } } else { echo Hooks::get_option('site_title'); } ?></title>
	
	<!-- Meta -->
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
	<link rel="shortcut icon" href="<?=BASE_URL;?>favicon.ico" type="image/x-icon">
	
	<!-- 
	**********************************************************
	In development, use the LESS files and the less.js compiler
	instead of the minified CSS loaded by default.
	**********************************************************
	<link rel="stylesheet/less" href="<?=get_less_directory_uri();?>admin/module.admin.page.layout.section.layout-fluid-menu-top-full.less" />
	<?php
	if (isset($this->less)) {
        foreach ($this->less as $less){
            _e( '<link rel="stylesheet/less" href="' . BASE_URL . 'static/assets/'.$less.'">' . "\n" );
        }
    }
	?>
	-->
	
	<!--[if lt IE 9]><link rel="stylesheet" href="<?=BASE_URL;?>static/assets/components/library/bootstrap/css/bootstrap.min.css" /><![endif]-->
	<link rel="stylesheet" href="<?=get_css_directory_uri();?>admin/module.admin.page.layout.section.layout-fluid-menu-top-full.min.css" />
	<link rel="stylesheet" href="<?=get_css_directory_uri();?>admin/custom.css" />
	
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

<script src="<?=get_javascript_directory_uri();?>library/jquery/jquery.min.js?v=v2.1.0"></script>
<script src="<?=get_javascript_directory_uri();?>library/jquery/jquery-migrate.min.js?v=v2.1.0"></script>
<script src="<?=get_javascript_directory_uri();?>library/modernizr/modernizr.js?v=v2.1.0"></script>
<script src="<?=get_javascript_directory_uri();?>plugins/less-js/less.min.js?v=v2.1.0"></script>
<script src="<?=get_javascript_directory_uri();?>modules/admin/charts/flot/assets/lib/excanvas.js?v=v2.1.0"></script>
<script src="<?=get_javascript_directory_uri();?>plugins/browser/ie/ie.prototype.polyfill.js?v=v2.1.0"></script>
<script src="<?=get_javascript_directory_uri();?>plugins/typeahead/bootstrap-typeahead.js?v=v2.3.2"></script>
	
	<?php
	if (isset($this->css)) {
        foreach ($this->css as $css){
            _e( '<link href="' . BASE_URL . 'static/assets/'.$css.'" rel="stylesheet">' . "\n" );
        }
    }
	?>
	<?php head(); ?>
</head>
<body class="">
	
		<!-- Main Container Fluid -->
	<div class="container-fluid fluid">
		
				
		<!-- Content -->
		<div id="content">
		
						<!-- Top navbar -->
			<div class="navbar main">
			
			<!-- Menu Toggle Button -->
			<button type="button" class="btn btn-navbar navbar-toggle pull-left">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<!-- // Menu Toggle Button END -->
			
						<!-- Top Menu -->
			<ul class="topnav pull-left">
				<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> Dashboard</a></li>
				<li<?=ae('access_plugin_screen');?> class="dropdown dd-1">
					<a href="" data-toggle="dropdown" class="glyphicons electrical_plug"><i></i>Plugins <span class="caret"></span></a>
					<ul class="dropdown-menu pull-left">
						<li<?=ae('access_plugin_screen');?>><a href="<?=BASE_URL;?>plugins/<?=bm();?>" class="glyphicons cogwheel"><i></i><?=_t( 'Plugins' );?></a></li>
						<?php Hooks::list_plugin_admin_pages();?>
						<!-- // Components Submenu Regular Items END -->
					</ul>
				</li>
				<li class="dropdown dd-1">
					<a href="" data-toggle="dropdown" class="glyphicons notes"><i></i><?=_t( 'Screens' );?> <span class="caret"></span></a>
					<ul class="dropdown-menu pull-left">
                        
                        <li<?=hl('settings','edit_settings');?> class="dropdown submenu">
                            <a data-toggle="dropdown" class="dropdown-toggle glyphicons settings"><i></i><?=_t( 'Administrative' );?></a>
                            <ul class="dropdown-menu submenu-show submenu-hide pull-right">
                                <li<?=hl('general_settings');?>><a href="<?=BASE_URL;?>setting/<?=bm();?>"> <?=_t( 'General Settings' );?></a></li>
								<li<?=hl('general_settings');?>><a href="<?=BASE_URL;?>registration/<?=bm();?>"> <?=_t( 'Registration Settings' );?></a></li>
								<li<?=hl('cron_jobs');?>><a href="<?=BASE_URL;?>cron/<?=bm();?>"> <?=_t( 'Cron Jobs' );?></a></li>
								<li<?=hl('permissions','access_permission_screen');?>><a href="<?=BASE_URL;?>permission/<?=bm();?>"> <?=_t( '(MPRM) Manage Perm' );?></a></li>
								<li<?=hl('roles','access_role_screen');?>><a href="<?=BASE_URL;?>role/<?=bm();?>"> <?=_t( '(MRLE) Manage Role' );?></a></li>
								<li<?=hl('errorlogs','access_error_log_screen');?>><a href="<?=BASE_URL;?>error/logs/<?=bm();?>"> <?=_t( 'Error Log' );?></a></li>
                            </ul>
                        </li>
                        
                        <li<?=hl('forms','access_forms');?> class="dropdown submenu">
                            <a data-toggle="dropdown" class="dropdown-toggle glyphicons notes_2"><i></i><?=_t( 'Forms' );?></a>
                            <ul class="dropdown-menu submenu-show submenu-hide pull-right">
                                <li class=""><a href="<?=BASE_URL;?>form/semester/<?=bm();?>"><?=_t( '(SEM) - Semester' );?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>form/term/<?=bm();?>"><?=_t( '(TERM) - Term' );?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>form/acad_year/<?=bm();?>"><?=_t( '(AYR) - Academic Year' );?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>form/department/<?=bm();?>"><?=_t( '(DEPT) - Department' );?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>form/subject/<?=bm();?>"><?=_t( '(SUBJ) - Subject' );?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>form/student_load_rule/<?=bm();?>"><?=_t( '(SLR) - Student Load Rules' );?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>form/degree/<?=bm();?>"><?=_t( '(DEG) - Degree' );?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>form/major/<?=bm();?>"><?=_t( '(MAJR) - Major' );?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>form/minor/<?=bm();?>"><?=_t( '(MINR) - Minor' );?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>form/ccd/<?=bm();?>"><?=_t( '(CCD) - CCD' );?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>form/specialization/<?=bm();?>"><?=_t( '(SPEC) - Specialization' );?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>form/cip/<?=bm();?>"><?=_t( '(CIP) - CIP' );?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>form/rstr_code/<?=bm();?>"><?=_t( '(RSTR) - Restriction Codes' );?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>form/location/<?=bm();?>"><?=_t( '(LOC) - Location' );?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>form/building/<?=bm();?>"><?=_t( '(BLDG) - Building' );?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>form/room/<?=bm();?>"><?=_t( '(ROOM) - Room' );?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>form/school/<?=bm();?>"><?=_t( '(SCH) - School' );?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>form/grade_scale/<?=bm();?>"><?=_t( '(GRSC) - Grade Scale' );?></a></li>
                            </ul>
                        </li>
                        
                        <li<?=hl('FTP','access_ftp');?>><a href="<?=BASE_URL;?>ftp/" class="glyphicons upload"><i></i><?=_t( 'FTP' );?></a></li>
                        
                        <li<?=hl('importer','import_data');?> class=""><a href="<?=BASE_URL;?>import/<?=bm();?>" class="glyphicons file_import"><i></i><?=_t( 'Importer' );?></a></li>
                        
                        <li class=""><a href="<?=BASE_URL;?>support/<?=bm();?>" class="glyphicons life_preserver"><i></i><?=_t( 'Online Documentation' );?></a></li>
                        
                        <li<?=hl('human_resources','access_human_resources');?> class="dropdown submenu">
                            <a data-toggle="dropdown" class="dropdown-toggle glyphicons settings"><i></i><?=_t( 'Human Resources' );?></a>
                            <ul class="dropdown-menu submenu-show submenu-hide pull-right">
                                <li class=""><a href="<?=BASE_URL;?>hr/<?=bm();?>"><?=_t( 'Employees' );?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>hr/grades/<?=bm();?>"><?=_t( 'Pay Grades' );?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>hr/jobs/<?=bm();?>"><?=_t( 'Job Titles' );?></a></li>
                            </ul>
                        </li>
                        
                        <?=Hooks::do_action('main_nav_middle');?>
                        
                        <li<?=hl('SQL','access_sql');?> class="dropdown submenu">
                            <a data-toggle="dropdown" class="dropdown-toggle glyphicons database_plus"><i></i><?=_t( 'SQL' );?></a>
                            <ul class="dropdown-menu submenu-show submenu-hide pull-right">
                            	<li<?=hl('add_savequery','access_save_query_screens');?>><a href="<?=BASE_URL;?>savequery/add/<?=bm();?>"><?=_t( 'Create Query' );?></a></li>
                                <li<?=hl('savequery','access_save_query_screens');?>><a href="<?=BASE_URL;?>savequery/<?=bm();?>"><?=_t( 'Queries' );?></a></li>
                                <li<?=hl('sql_interface','access_sql_interface_screen');?>><a href="<?=BASE_URL;?>sql/<?=bm();?>"><?=_t( 'SQL Interface' );?></a></li>
                            </ul>
                        </li>
                        
                        <li<?=ae('access_academics');?> class="dropdown submenu">
                            <a data-toggle="dropdown" class="dropdown-toggle glyphicons keynote"><i></i><?=_t( 'Academics' );?></a>
                            <ul class="dropdown-menu submenu-show submenu-hide pull-right">
                                <li<?=ae('access_acad_prog_screen');?> class="dropdown submenu">
                                	<a data-toggle="dropdown" href="#" class="dropdown-toggle"><?=_t( 'Academic Program' );?></a>
	                                <ul class="dropdown-menu submenu-show submenu-hide pull-right">
		                                <li class=""><a href="<?=BASE_URL;?>program/<?=bm();?>"><?=_t( '(PROG) - Program' );?></a></li>
		                                <li<?=ae('add_acad_prog');?> class=""><a href="<?=BASE_URL;?>program/add/<?=bm();?>"><?=_t( '(APRG) - New Program' );?></a></li>
	                            	</ul>
                            	</li>

                                <li<?=ae('access_course_screen');?> class="dropdown submenu">
                                	<a data-toggle="dropdown" href="#" class="dropdown-toggle"><?=_t( 'Course' );?></a>
	                                <ul class="dropdown-menu submenu-show submenu-hide pull-right">
		                                <li class=""><a href="<?=BASE_URL;?>course/<?=bm();?>"><?=_t( '(CRSE) - Course' );?></a></li>
                                		<li<?=ae('add_course');?> class=""><a href="<?=BASE_URL;?>course/add/<?=bm();?>"><?=_t( '(ACRS) - New Course' );?></a></li>
	                            	</ul>
                            	</li>
                            	
                            	<li<?=ae('access_course_sec_screen');?> class="dropdown submenu">
                                	<a data-toggle="dropdown" href="#" class="dropdown-toggle"><?=_t( 'Course Section' );?></a>
	                                <ul class="dropdown-menu submenu-show submenu-hide pull-right">
		                                <li class=""><a href="<?=BASE_URL;?>section/<?=bm();?>"><?=_t( '(SECT) - Section' );?></a></li>
                                		<li<?=ae('register_students');?> class=""><a href="<?=BASE_URL;?>section/register/<?=bm();?>"><?=_t( '(RGN) - Register' );?></a></li>
                                		<li<?=ae('register_students');?> class=""><a href="<?=BASE_URL;?>section/batch_register/<?=bm();?>"><?=_t( '(BRGN) - Batch Register' );?></a></li>
                                		<li<?=ae('access_stu_roster_screen');?> class=""><a href="<?=BASE_URL;?>section/sros/<?=bm();?>"><?=_t( '(SROS) - Student Roster' );?></a></li>
                                		<li<?=ae('access_course_sec_screen');?> class=""><a href="<?=BASE_URL;?>section/catalog/<?=bm();?>"><?=_t( 'Course Catalogs' );?></a></li>
                                		<li<?=ae('access_grading_screen');?> class=""><a href="<?=BASE_URL;?>section/courses/<?=bm();?>"><?=_t( 'My Course Sections' );?></a></li>
	                            	</ul>
                            	</li>
                            </ul>
                        </li>
                        
                        <li<?=ae('access_institutions_screen');?> class="dropdown submenu">
                            <a data-toggle="dropdown" class="dropdown-toggle glyphicons building"><i></i><?=_t( 'Institution' );?></a>
                            <ul class="dropdown-menu submenu-show submenu-hide pull-right">
                                <li class=""><a href="<?=BASE_URL;?>institution/<?=bm();?>"><?=_t( '(INST) - Institution' );?></a></li>
                                <li<?=ae('add_institution');?> class=""><a href="<?=BASE_URL;?>institution/add/<?=bm();?>"><?=_t( '(AINST) - New Institution' );?></a></li>
                            </ul>
                        </li>
						
						<li<?=ae('access_communication_mgmt');?> class="dropdown submenu">
                            <a data-toggle="dropdown" class="dropdown-toggle glyphicons inbox"><i></i><?=_t( 'Communication Mgmt' );?></a>
                            <ul class="dropdown-menu submenu-show submenu-hide pull-right">
                                <li class=""><a href="<?=BASE_URL;?>mailer/<?=bm();?>"><?=_t( 'Email Templates' );?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>mailer/add/<?=bm();?>"><?=_t( 'Add Email Template' );?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>mailer/schedule/<?=bm();?>"><?=_t( 'Schedule Email' );?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>mailer/queue/<?=bm();?>"><?=_t( 'Email Queue' );?></a></li>
                            </ul>
                        </li>
						
						<!--<li<?=ae('access_nslc');?> class="dropdown submenu">
							<a data-toggle="dropdown" class="dropdown-toggle glyphicons hdd"><i></i><?=_t( 'NSLC' );?></a>
							<ul class="dropdown-menu submenu-show submenu-hide pull-right">
							    <li class=""><a href="<?=BASE_URL;?>nslc/purge/<?=bm();?>"><?=_t( '(NSCP) Purge' );?></a></li>
								<li class=""><a href="<?=BASE_URL;?>nslc/setup/<?=bm();?>"><?=_t( '(NSCS) Setup' );?></a></li>
								<li class=""><a href="<?=BASE_URL;?>nslc/extraction/<?=bm();?>"><?=_t( '(NSCX) Extraction' );?></a></li>
								<li class=""><a href="<?=BASE_URL;?>nslc/verification/<?=bm();?>"><?=_t( '(NSCE) Verification' );?></a></li>
								<li class=""><a href="<?=BASE_URL;?>nslc/<?=bm();?>"><?=_t( '(NSCC) Correction' );?></a></li>
								<li class=""><a href="<?=BASE_URL;?>nslc/file/<?=bm();?>"><?=_t( '(NSCT) NSLC File' );?></a></li>
							</ul>
						</li>-->
						
						
						<li<?=ae('access_person_mgmt');?> class="dropdown submenu">
                            <a data-toggle="dropdown" class="dropdown-toggle glyphicons user"><i></i><?=_t( 'Person Management' );?></a>
                            <ul class="dropdown-menu submenu-show submenu-hide pull-right">
                                <li<?=ae('access_person_screen');?> class="dropdown submenu">
                                	<a data-toggle="dropdown" href="#" class="dropdown-toggle"><?=_t( 'Person' );?></a>
	                                <ul class="dropdown-menu submenu-show submenu-hide pull-right">
		                                <li class=""><a href="<?=BASE_URL;?>person/<?=bm();?>"><?=_t( '(NAE) Search' );?></a></li>
                                		<li<?=ae('add_person');?> class=""><a href="<?=BASE_URL;?>person/add/<?=bm();?>"><?=_t( '(APER) Add Person' );?></a></li>
	                            	</ul>
                            	</li>

                                <li<?=ae('access_staff_screen');?>><a href="<?=BASE_URL;?>staff/<?=bm();?>"><?=_t( '(STAF) Staff' );?></a></li>
                            	
                            	<li<?=ae('access_student_screen');?> class="dropdown submenu">
                                	<a data-toggle="dropdown" href="#" class="dropdown-toggle"><?=_t( 'Student' );?></a>
	                                <ul class="dropdown-menu submenu-show submenu-hide pull-right">
		                                <li<?=ae('access_student_screen');?> class=""><a href="<?=BASE_URL;?>student/<?=bm();?>"><?=_t( '(SPRO) Student Profile' );?></a></li>
                                		<li<?=ae('graduate_students');?> class=""><a href="<?=BASE_URL;?>student/graduation/<?=bm();?>"><?=_t( 'Graduate Student(s)' );?></a></li>
                                		<li<?=ae('generate_transcript');?> class=""><a href="<?=BASE_URL;?>student/tran/<?=bm();?>"><?=_t( 'Generate Transcript' );?></a></li>
	                            	</ul>
                            	</li>
                            </ul>
                        </li>
                        
                        <li<?=hl('applications','access_application_screen');?> class="dropdown submenu">
                            <a data-toggle="dropdown" class="dropdown-toggle glyphicons show_big_thumbnails"><i></i><?=_t( 'Application' );?></a>
                            <ul class="dropdown-menu submenu-show submenu-hide pull-right">
                                <li class=""><a href="<?=BASE_URL;?>application/<?=bm();?>"><?=_t( '(APPL) Application' );?></a></li>
                                <li class=""><a href="<?=BASE_URL;?>application/inst_attended/<?=bm();?>"><?=_t( 'Institution Attended' );?></a></li>
                            </ul>
                        </li>
                        
                        <li<?=ae('access_student_portal');?> class=""><a href="<?=BASE_URL;?>student/portal/<?=bm();?>" class="glyphicons globe"><i></i><?=_t( 'Student Portal' );?></a></li>
                        
                        <?=Hooks::do_action('main_nav_end');?>
                        
					</ul>
				</li>
				<?php if($auth->getPersonField('personType') != 'STU') { ?>
				<li class="search open">
					<form autocomplete="off" class="dropdown dd-1" method="post" action="<?=BASE_URL;?>dashboard/search/">
						<input type="text" name="screen" placeholder="Type for suggestions . . ." data-toggle="screen" />
						<button type="button" class="glyphicons search"><i></i></button>
					</form>
				</li>
				<?php } ?>
			</ul>
			<!-- // Top Menu END -->
						
						
			<!-- Top Menu Right -->
			<ul class="topnav pull-right hidden-xs hidden-sm">
			    
			    <!-- Themer -->
                <!-- <li><a href="#themer" data-toggle="collapse" class="glyphicons eyedropper single-icon"><i></i></a></li> -->
                <!-- // Themer END -->
			
				<!-- Profile / Logout menu -->
				<li class="account dropdown dd-1">
					<a data-toggle="dropdown" href="" class="glyphicons logout lock"><span class="hidden-tablet hidden-xs hidden-desktop-1"><?=$auth->getPersonField('uname');?></span><i></i></a>
					<ul class="dropdown-menu pull-right">
						<li class="profile">
							<span>
								<span class="heading"><?=_t( 'Profile' );?> <a href="<?=BASE_URL;?>profile/" class="pull-right"><?=_t( 'edit' );?></a></span>
								<span class="media display-block margin-none">
									<span class="pull-left display-block thumb"><?=get_user_avatar($auth->getPersonField('email'),'38');?></span>
										<a href="<?=BASE_URL;?>profile/"><?=$auth->getPersonField('fname').' '.$auth->getPersonField('lname');?></a><br />
										<?=$auth->getPersonField('email');?>
								</span>
								<span class="clearfix"></span>
							</span>
						</li>
						<?php if(isset($_COOKIE['SWITCH_USERBACK'])) : ?>
						<li>
							<a href="<?=BASE_URL;?>index/switchUserBack/<?=$_COOKIE['SWITCH_USERBACK'];?>"><?php _e( _t( 'Switch Back to' ) ); ?> <?=$_COOKIE['SWITCH_USERNAME'];?></a>
						</li>
						<?php endif; ?>
						<?php if(!isset($_COOKIE['SWITCH_USERBACK']) && !isset($_COOKIE['SCREENLOCK'])) : ?>
						<li><a href="<?=BASE_URL;?>index/runLock/" class="glyphicons lock"><?=_t( 'Lock Screen' );?><i></i></a></li>
						<?php endif; ?>
						<li class="innerTB half">
							<span>
								<a class="btn btn-default btn-xs pull-right" href="<?=BASE_URL;?>dashboard/logout/"><?=_t( 'Sign Out' );?></a>
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
	