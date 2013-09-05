<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Manage Schools View
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
	<li><?php _e( _t( 'Schools' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Manage Schools' ) ); ?></h3>
<div class="innerLR">

	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body">
		
			<!-- Table -->
			<table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-white table-primary">
			
				<!-- Table heading -->
				<thead>
					<tr>
						<th class="center"><?php _e( _t( 'School ID' ) ); ?></th>
						<th class="center"><?php _e( _t( 'School' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Teachers' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Courses' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Students' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Actions' ) ); ?></th>
					</tr>
				</thead>
				<!-- // Table heading END -->
				
				<!-- Table body -->
				<tbody>
				<?php if($this->schoolList != '') : foreach($this->schoolList as $key => $value) { ?>
					<!-- Table row -->
					<tr class="gradeX">
						<td class="center"><?php echo clean($value['school_id']); ?></td>
						<td><?php echo clean($value['school_name']); ?></td>
						<td class="center"><?php echo clean($value['teacher_count']); ?></td>
						<td class="center"><?php echo clean($value['course_count']); ?></td>
						<td class="center"><?php echo clean($value['student_count']); ?></td>
						<td class="center">
                        	<a href="<?php echo BASE_URL; ?>admin/edit_school/<?php echo clean($value['school_id']); ?>" title="Edit School" class="btn btn-circle"><i class="icon-edit"></i></a>
                            <a href="<?php echo BASE_URL; ?>admin/studentSchool/<?php echo clean($value['school_id']); ?>" title="Show Students" class="btn btn-primary btn-circle"><i class="icon-group"></i></a>
                            <a href="<?php echo BASE_URL; ?>admin/courses/<?php echo clean($value['school_id']); ?>" title="Show Courses" class="btn btn-warning btn-circle"><i class="icon-book"></i></a>
                            <a href="<?php echo BASE_URL; ?>admin/teachers/<?php echo clean($value['school_id']); ?>" title="Show Teachers" class="btn btn-info btn-circle"><i class="icon-user"></i></a>
                            <a href="" title="Delete School" class="btn btn-danger btn-circle"><i class="icon-trash"></i></a>
						</td>
					</tr>
					<!-- // Table row END -->
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