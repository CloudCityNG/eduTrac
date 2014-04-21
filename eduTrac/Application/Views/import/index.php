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
 * @since       3.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */
?>

<ul class="breadcrumb">
	<li><?=_t( 'You are here' );?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
	<li class="divider"></li>
	<li><?=_t( 'Quick Importer' );?></li>
</ul>

<h3><?=_t( 'Quick Importer' );?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>import/runQuickImport/" id="validateSubmitForm" method="post" autocomplete="off" enctype="multipart/form-data">
		
		<!-- Widget -->
		<div class="widget widget-heading-simple widget-body-gray">
		
			<!-- Widget heading -->
			<div class="widget-head">
				<h4 class="heading"><font color="red">*</font> <?=_t( 'Indicates field is required' );?></h4>
			</div>
			<!-- // Widget heading END -->
			
			<div class="widget-body">
			
				<!-- Row -->
				<div class="row">
					<!-- Column -->
					<div class="col-md-6">
						
						<!-- Group -->
						<div class="form-group col-md-12">
						<div class="fileupload fileupload-new margin-none" data-provides="fileupload">
						  	<div class="input-group">
						    	<div class="form-control col-md-3"><i class="fa fa-file fileupload-exists"></i> <span class="fileupload-preview"></span></div>
						    	<span class="input-group-btn">
						    		<span class="btn btn-default btn-file"><span class="fileupload-new"><?=_t( 'Select file' );?></span><span class="fileupload-exists"><?=_t( 'Change' );?></span><input type="file" name="file_source" margin-none" /></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload"><?=_t( 'Remove' );?></a>
						    	</span>
						  	</div>
						</div>
						</div>
						
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Database Table' );?></label>
                            <div class="col-md-8">
                                <select name="table" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" required>
                                    <option value="">&nbsp;</option>
                                    <option value="semester"><?=_t( 'Semester' );?></option>
                                    <option value="term"><?=_t( 'Term' );?></option>
                                    <option value="acad_year"><?=_t( 'Academic Year' );?></option>
                                    <option value="department"><?=_t( 'Department' );?></option>
                                    <option value="subject"><?=_t( 'Subject' );?></option>
                                    <option value="credit_load"><?=_t( 'Credit Load' );?></option>
                                    <option value="degree"><?=_t( 'Degree' );?></option>
                                    <option value="major"><?=_t( 'Major' );?></option>
                                    <option value="minor"><?=_t( 'Minor' );?></option>
                                    <option value="ccd"><?=_t( 'CCD' );?></option>
                                    <option value="specialization"><?=_t( 'Specialization' );?></option>
                                    <option value="cip"><?=_t( 'CIP' );?></option>
                                    <option value="location"><?=_t( 'Location' );?></option>
                                    <option value="building"><?=_t( 'Building' );?></option>
                                    <option value="room"><?=_t( 'Room' );?></option>
                                    <option value="school"><?=_t( 'School' );?></option>
                                    <option value="course"><?=_t( 'Course' );?></option>
                                    <option value="course_sec"><?=_t( 'Course Section' );?></option>
                                    <option value="acad_program"><?=_t( 'Academic Program' );?></option>
                                    <option value="person"><?=_t( 'Person' );?></option>
                                    <option value="address"><?=_t( 'Address' );?></option>
                                    <option value="staff"><?=_t( 'Staff' );?></option>
                                    <option value="staff_meta"><?=_t( 'Staff Meta' );?></option>
                                    <option value="application"><?=_t( 'Application' );?></option>
                                    <option value="institution"><?=_t( 'Institution' );?></option>
                                    <option value="institution_attended"><?=_t( 'Institution Attended' );?></option>
                                    <option value="student"><?=_t( 'Student' );?></option>
                                    <option value="stu_acad_cred"><?=_t( 'Student Acad Cred' );?></option>
                                    <option value="stu_acad_level"><?=_t( 'Student Acad Level' );?></option>
                                    <option value="stu_course_sec"><?=_t( 'Student Course Section' );?></option>
                                    <option value="stu_program"><?=_t( 'Student Program' );?></option>
                                    <option value="stu_term"><?=_t( 'Student Term' );?></option>
                                    <option value="stu_term_gpa"><?=_t( 'Student Term GPA' );?></option>
                                    <option value="stu_term_load"><?=_t( 'Student Term Load' );?></option>
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
					<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=_t( 'Submit' );?></button>
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