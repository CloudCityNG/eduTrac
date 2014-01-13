<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Support View
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
 * @since       1.1.4
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */
?>

<script>
  var iframe = window.getElementsByTagName( "iframe" )[ 0 ];
  alert( "Frame title: " + iframe.contentWindow.title );
</script>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Online Documenation' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Online Documenation' ) ); ?></h3>
<div class="innerLR">
		
	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		
		<div class="widget-body">
			
			<iframe src="http://edutrac.7mediaws.org/" width="100%" height="900" marginwidth="0" marginheight="0" frameborder="0">
			  <p><?=_t( 'Your browser does not support iframes.' );?></p>
			</iframe>
			
		</div>
	</div>
	<!-- // Widget END -->
	
</div>	
		
		</div>
		<!-- // Content END -->