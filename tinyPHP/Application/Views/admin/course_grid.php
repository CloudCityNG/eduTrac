<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Course Grid View
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
	<li><a href="<?php echo BASE_URL; ?>admin/courses/"><?php _e( _t( 'Courses' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Courses' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Course Grid  - ' ) ); ?> 
	<?php if($this->courseGrid != '') : foreach($this->courseGrid as $key => $value) { echo $value['title']; } endif; ?> <?php _e( _t( 'Semester' ) ); ?>
</h3>
<div class="innerLR">

	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body">
		
			<!-- Table -->
			<table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-white">
			
				<!-- Table heading -->
				<thead>
					<tr>
						<th><?php _e( _t( 'Period' ) ); ?></th>
						<th><?php _e( _t( 'Sunday' ) ); ?></th>
						<th><?php _e( _t( 'Monday' ) ); ?></th>
						<th><?php _e( _t( 'Tuesday' ) ); ?></th>
						<th><?php _e( _t( 'Wednesday' ) ); ?></th>
						<th><?php _e( _t( 'Thursday' ) ); ?></th>
						<th><?php _e( _t( 'Friday' ) ); ?></th>
						<th><?php _e( _t( 'Saturday' ) ); ?></th>
					</tr>
				</thead>
				<!-- // Table heading END -->
				
				<!-- Table body -->
				<tbody>
				<?php if($this->courseGrid != '') : foreach($this->courseGrid as $key => $value) { ?>
					
					<?php echo course_grid(clean($value['courseid']),clean($value['schoolid'])); ?>
               
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