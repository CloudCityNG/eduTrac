<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Parent Portal View
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
 * @since       1.0.2
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */
?>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Parent Portal' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Parent Portal' ) ); ?></h3>
<div class="innerLR">

    <div class="relativeWrap">
		<div class="widget widget-heading-simple widget-body-gray">
			<div class="widget-body padding-none">
				<div class="hero-unit margin-none center">
					<h1 class="separator bottom"><?php _e( _t( 'Hello Parent!' ) ); ?></h1>
					<p><?php _e( _t( 'Welcome to the parent portal. The parent portal allows you to see your child\'s final grades and progress reports.' ) ); ?></p>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row-fluid">
		<div class="span12">
			<div class="widget widget-heading-simple widget-body-white">
				<div class="widget-head"><h4 class="heading strong text-uppercase"><?php _e( _t( 'Menu' ) ); ?></h4></div>
				<div class="widget-body">
					<ul>
						<li><a href="<?=BASE_URL;?>parents/children/"><?php _e( _t( 'Child(ren)' ) ); ?></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>

</div>	
	
		
		</div>
		<!-- // Content END -->