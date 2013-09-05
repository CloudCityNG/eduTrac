<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Manage Students by School View
 *  
 * PHP 5
 *
 * eGrades(tm) : Online Grading System (http://egrades.org/)
 * Copyright 2013, 7 Media Web Solutions, LLC (http://www.7mediaws.org/)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2013, 7 Media Web Solutions, LLC (http://www.7mediaws.org/)
 * @link http://egrades.org/ eGrades(tm) Project
 * @since eGrades(tm) v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?php echo BASE_URL; ?>admin/" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Students' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Managing Students @ ' ) ); ?><?php if($this->studentSchool != '') : foreach($this->studentSchool as $key => $value) { echo clean(get_school_name($value['schoolid'])); } endif; ?></h3>
<div class="innerLR">

	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body">
		
			<!-- Table -->
			<table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-white">
			
				<!-- Table heading -->
				<thead>
					<tr>
						<th><?php _e( _t( 'Student ID' ) ); ?></th>
						<th><?php _e( _t( 'Name' ) ); ?></th>
						<th><?php _e( _t( 'Email' ) ); ?></th>
						<th><?php _e( _t( 'Grade' ) ); ?></th>
						<th><?php _e( _t( 'Course Count' ) ); ?></th>
						<th><?php _e( _t( 'Actions' ) ); ?></th>
					</tr>
				</thead>
				<!-- // Table heading END -->
				
				<!-- Table body -->
				<tbody>
				<?php if($this->studentSchool != '') : foreach($this->studentSchool as $key => $value) { ?>
                <tr class="gradeX">
                    <td class="center"><?php echo clean($value['sid']); ?></td>
                    <td class="center"><?php echo clean($value['lname']) . ', ' . clean($value['fname']); ?></td>
                    <td class="center"><a href="mailto:<?php echo clean($value['email']); ?>"><?php echo clean($value['email']); ?></a></td>
                    <td class="center"><?php echo clean($value['grade']); ?></td>
                    <td class="center"><?php echo clean($value['course_count']); ?></td>
                    <td class="center">
                    	<span class="btn btn-circle" data-toggle="tooltip" data-original-title="Edit Student" data-placement="top"><a href="<?php echo BASE_URL; ?>admin/edit_student/<?php echo clean($value['sid']); ?>"><i class="icon-group"></a></i></span>
                    	<span class="btn btn-primary btn-circle" data-toggle="tooltip" data-original-title="View Grades" data-placement="top"><a href="<?php echo BASE_URL; ?>admin/grades/<?php echo clean($value['sid']); ?>"><i class="icon-file icon-white"></a></i></span>
                        <span class="btn btn-warning btn-circle" data-toggle="tooltip" data-original-title="Delete Student" data-placement="top"><a href=""><i class="icon-trash icon-white"></a></i></span>
                    </td>
                </tr>
                <?php } endif; ?>
					
				</tbody>
				<!-- // Table body END -->
				
			</table>
			<!-- // Table END -->
			
		</div>
	</div>
	<div class="separator bottom"></div>
	<!-- // Widget END -->
	
</div>	
	
		
		</div>
		<!-- // Content END -->