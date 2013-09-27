<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Dashboard View
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
$cache = new \eduTrac\Classes\Libraries\Cache('3600', BASE_PATH . 'tmp/cache/', 'rss');
?>

<ul class="breadcrumb">
	<li>You are here</li>
	<li><a href="#" class="glyphicons dashboard"><i></i> Dashboard</a></li>
</ul>

<?=show_update_message();?>

<h2>Dashboard</h2>
<div class="innerLR">

	<div class="row-fluid">
		<div class="span9">
	    <?php if(!$cache->setCache()) : ?>
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
        <?php endif; echo $cache->getCache(); ?>
		
		</div>
		<div class="span3">
			
			<!-- Widget -->
			<div class="widget widget-heading-simple widget-body-grey">
					
				<!-- Widget Heading -->
				<div class="widget-head">
					<h4 class="heading glyphicons life_preserver"><i></i>Support</h4>
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