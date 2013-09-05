<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Dashboard View
 *  
 * PHP 5
 *
 * eduTrac(tm) : Student Information System (http://edutrac.org/)
 * Copyright 2013, eduTrac, LLC (http://edutrac.org/)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2013, eduTrac, LLC (http://edutrac.org/)
 * @link http://edutrac.org/ eduTrac(tm) Project
 * @since eduTrac(tm) v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>

<ul class="breadcrumb">
	<li>You are here</li>
	<li><a href="#" class="glyphicons dashboard"><i></i> Dashboard</li></a>
</ul>

<h2>Dashboard</h2>
<div class="innerLR">

	<div class="row-fluid">
		<div class="span9">
	
			<!-- 7 Media Web Solutions, LLC News -->
			<div class="widget widget-heading-simple widget-body-white">
				<div class="widget-head">
					<h4 class="heading glyphicons cardio"><i></i>Latest 7 Media News</h4>
				</div>
				<div class="widget-body">
                    <?php  $rss = new \DOMDocument();
                    $rss->load('http://www.7mediaws.org/feed/');
                    $feed = array();
                    foreach ($rss->getElementsByTagName('item') as $node) {
                    $item = array (
                    'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
                    'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
                    'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
                    'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
                    );
                    array_push($feed, $item);
                    }
                    $limit = 2;
                    for($x=0;$x<$limit;$x++) {
                    $title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
                    $link = $feed[$x]['link'];
                    $description = $feed[$x]['desc'];
                    $date = date('l F d, Y', strtotime($feed[$x]['date']));
                    echo '<p><strong><a href="'.$link.'" title="'.$title.'">'.$title.'</a></strong><br />';
                    echo '<small><em>Posted on '.$date.'</em></small></p>';
                    echo '<p>'.$description.'</p>';
                    } ?>
				</div>
			</div>
			<!-- // 7 Media Web Solutions, LLC News END -->
		
		</div>
		<div class="span3">
			
			<!-- Widget -->
			<div class="widget widget-heading-simple widget-body-grey">
					
				<!-- Widget Heading -->
				<div class="widget-head">
					<h4 class="heading glyphicons hospital_h"><i></i>Support</h4>
				</div>
				<!-- // Widget Heading END -->
				
				<div class="widget-body">
					<div class="controls-group center" data-gridalicious="false" data-type="slide" data-images="false">
						<a href="http://community.7mediaws.org/projects/edutrac/" class="glyphicons group"><i></i> <?php _e( _t( 'Community Support Site' ) ); ?></a>
					</div>
				</div>
			</div>
			<!-- // Widget END -->
			
		</div>
	</div>
	
</div>
	
		
		</div>
		<!-- // Content END -->