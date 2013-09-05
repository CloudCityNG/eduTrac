<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Login View
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

			<h1 class="glyphicons lock"><?php _e( _t( 'eGrades' ) ); ?> <i></i></h1>
		
			<!-- Box -->
			<div class="widget widget-heading-simple widget-body-gray">
				
				<div class="widget-body">
				
					<!-- Form -->
					<form method="post" action="<?php echo BASE_URL; ?>/admin/runLogin/">
						<label><?php _e( _t( 'Username' ) ); ?></label>
						<input type="text" class="input-block-level" name="uname" placeholder="Your Username" required /> 
						<label><?php _e( _t( 'Password' ) ); ?> <a class="password" href="http://support.egrades.org/">forgot it?</a></label>
						<input type="password" class="input-block-level margin-none" name="password" placeholder="Your Password" required />
						<div class="separator bottom"></div> 
						<div class="row-fluid">
							<div class="span8">
								<div class="uniformjs"><label class="checkbox"><input type="checkbox" name="rememberme" /><?php _e( _t( 'Remember me' ) ); ?></label></div>
							</div>
							<div class="span4 center">
								<button class="btn btn-block btn-inverse" type="submit"><?php _e( _t( 'Sign in' ) ); ?></button>
							</div>
						</div>
					</form>
					<!-- // Form END -->
							
				</div>
			</div>
			<!-- // Box END -->
			
			<div class="innerT center">
			
				<a href="" class="btn btn-icon-stacked btn-block btn-success glyphicons vcard"><i></i><span>Are you faculty?</span><span class="strong">Sign in here</span></a>
				
				<p>&nbsp;</p>
				
				<a href="" class="btn btn-icon-stacked btn-block btn-facebook glyphicons parents"><i></i><span>Are you a parent?</span><span class="strong">Sign in here</span></a>
				
				<p>&nbsp;</p>
				
				<a href="" class="btn btn-icon-stacked btn-block btn-google glyphicons user"><i></i><span>Are you a student?</span><span class="strong">Sign in here</span></a>

				<p>Having troubles? <a href="">Get Help</a></p>
			</div>
			
		</div>
		
	</div>