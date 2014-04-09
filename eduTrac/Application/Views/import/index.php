<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Default Importer View
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
 * @since       1.1.1
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */
?>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Quick Importer' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Quick Importer' ) ); ?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>import/runQuickImport/" id="validateSubmitForm" method="post" autocomplete="off" enctype="multipart/form-data">
		
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
                            <div class="fileupload fileupload-new margin-none" data-provides="fileupload">
                                <font color="red">*</font>
                                <div class="input-append">
                                    <div class="uneditable-input span3"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div>
                                    <span class="btn btn-default btn-file"><span class="fileupload-new"><?php _e( _t( 'Select file' ) ); ?></span><span class="fileupload-exists"><?php _e( _t( 'Change' ) ); ?></span>
                                    <input type="file" name="file_source" class="span10 margin-none" required /></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload"><?php _e( _t( 'Remove' ) ); ?></a>
                                </div>
                            </div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Database Table' ) ); ?></label>
                            <div class="controls">
                                <select name="table" id="select2_9" style="width:35%" required>
                                    <option value="">&nbsp;</option>
                                    <option value="semester"><?php _e( _t( 'Semester' ) ); ?></option>
                                    <option value="term"><?php _e( _t( 'Term' ) ); ?></option>
                                    <option value="acad_year"><?php _e( _t( 'Academic Year' ) ); ?></option>
                                    <option value="department"><?php _e( _t( 'Department' ) ); ?></option>
                                    <option value="subject"><?php _e( _t( 'Subject' ) ); ?></option>
                                    <option value="credit_load"><?php _e( _t( 'Credit Load' ) ); ?></option>
                                    <option value="degree"><?php _e( _t( 'Degree' ) ); ?></option>
                                    <option value="major"><?php _e( _t( 'Major' ) ); ?></option>
                                    <option value="minor"><?php _e( _t( 'Minor' ) ); ?></option>
                                    <option value="ccd"><?php _e( _t( 'CCD' ) ); ?></option>
                                    <option value="specialization"><?php _e( _t( 'Specialization' ) ); ?></option>
                                    <option value="cip"><?php _e( _t( 'CIP' ) ); ?></option>
                                    <option value="location"><?php _e( _t( 'Location' ) ); ?></option>
                                    <option value="building"><?php _e( _t( 'Building' ) ); ?></option>
                                    <option value="room"><?php _e( _t( 'Room' ) ); ?></option>
                                    <option value="school"><?php _e( _t( 'School' ) ); ?></option>
                                    <option value="course"><?php _e( _t( 'Course' ) ); ?></option>
                                    <option value="course_sec"><?php _e( _t( 'Course Section' ) ); ?></option>
                                    <option value="acad_program"><?php _e( _t( 'Academic Program' ) ); ?></option>
                                    <option value="person"><?php _e( _t( 'Person' ) ); ?></option>
                                    <option value="faculty"><?php _e( _t( 'Faculty' ) ); ?></option>
                                    <option value="staff"><?php _e( _t( 'Staff' ) ); ?></option>
                                    <option value="application"><?php _e( _t( 'Application' ) ); ?></option>
                                    <option value="institution"><?php _e( _t( 'Institution' ) ); ?></option>
                                    <option value="institution_attended"><?php _e( _t( 'Institution Attended' ) ); ?></option>
                                    <option value="student"><?php _e( _t( 'Student' ) ); ?></option>
                                    <option value="stu_acad_cred"><?php _e( _t( 'Student Acad Cred' ) ); ?></option>
                                    <option value="stu_acad_level"><?php _e( _t( 'Student Acad Level' ) ); ?></option>
                                    <option value="stu_course_sec"><?php _e( _t( 'Student Course Section' ) ); ?></option>
                                    <option value="stu_program"><?php _e( _t( 'Student Program' ) ); ?></option>
                                    <option value="stu_term"><?php _e( _t( 'Student Term' ) ); ?></option>
                                    <option value="stu_term_gpa"><?php _e( _t( 'Student Term GPA' ) ); ?></option>
                                    <option value="stu_term_load"><?php _e( _t( 'Student Term Load' ) ); ?></option>
                                    <option value="parent"><?php _e( _t( 'Parent' ) ); ?></option>
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
	
</div>	
		
		</div>
		<!-- // Content END -->