<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Error View
 *  
 * PHP 5
 *
 * tinyPHP(tm) : Simple & Lightweight MVC Framework (http://tinyphp.us/)
 * Copyright 2012, 7 Media Web Solutions, LLC (http://www.7mediaws.org/)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2012, 7 Media Web Solutions, LLC (http://www.7mediaws.org/)
 * @link http://tinyphp.us/ tinyPHP(tm) Project
 * @since tinyPHP(tm) v 0.1
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>

<!-- Wrapper -->
<div id="login">

	<div class="container">

	<!-- Box -->
	<div class="hero-unit well">
		<h1 class="padding-none">Ouch! <span>404 error</span></h1>
		<hr class="separator" />
		<!-- Row -->
		<div class="row-fluid">
		
			<!-- Column -->
			<div class="span6">
				<div class="center">
					<p>It seems the page you are looking for is not here anymore. The page might have moved to another address or just removed by our staff.</p>
				</div>
			</div>
			<!-- // Column END -->
			
			<!-- Column -->
			<div class="span6">
				<div class="center">
					<p>Is this a serious error? <a href="http://www.7mediaws.org/client/">Let us know</a></p>
					<div class="row-fluid">
						<div class="span6">
							<a href="<?=BASE_URL;?>dashboard/" class="btn btn-icon-stacked btn-block btn-success glyphicons user_add"><i></i><span>Go back to</span><span class="strong">Dashboard</span></a>
						</div>
						<div class="span6">
							<a href="http://community.7mediaws.org/projects/edutrac/" class="btn btn-icon-stacked btn-block btn-danger glyphicons circle_question_mark"><i></i><span>Browse through our</span><span class="strong">Support Centre</span></a>
						</div>
					</div>
				</div>
			</div>
			<!-- // Column END -->
			
		</div>
		<!-- // Row END -->
		
	</div>
	<!-- // Box END -->
	
	</div>
	
</div>
<!-- // Wrapper END -->