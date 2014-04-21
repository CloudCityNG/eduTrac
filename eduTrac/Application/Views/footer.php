<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Site Footer
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
use \eduTrac\Classes\Libraries\Hooks;
?>
<div class="clearfix"></div>

		<div id="custom-footer" class="hidden-print">
			
			<!--  Copyright Line -->
			<div class="copy"><?php _e( _t( '&copy; 2013' ) ); ?> - <?php version(); ?> &nbsp; <a href="http://tinyphp.us/"><img src="<?=BASE_URL;?>static/images/button.png" alt="Powered by tinyPHP"/></a></div>
			<!--  End Copyright Line -->
	
		</div>
		<!-- // Footer END -->
		
	</div>
	<!-- // Main Container Fluid END -->
	
	<!-- Global -->
	<script>
	var basePath = '',
		commonPath = '<?=BASE_URL;?>static/assets/',
		rootPath = '<?=BASE_URL;?>',
		DEV = false,
		componentsPath = '<?=BASE_URL;?>static/assets/components/';
	
	var primaryColor = '#4a8bc2',
		dangerColor = '#b55151',
		infoColor = '#74a6d0',
		successColor = '#609450',
		warningColor = '#ab7a4b',
		inverseColor = '#45484d';
	
	var themerPrimaryColor = primaryColor;
	</script>
<script src="<?=BASE_URL;?>static/assets/components/library/bootstrap/js/bootstrap.min.js?v=v2.1.0"></script>
<script src="<?=BASE_URL;?>static/assets/components/plugins/slimscroll/jquery.slimscroll.js?v=v2.1.0"></script>
<script src="<?=BASE_URL;?>static/assets/components/plugins/breakpoints/breakpoints.js?v=v2.1.0"></script>
<script src="<?=BASE_URL;?>static/assets/components/core/js/core.init.js?v=v2.1.0"></script>
	
	<?php
		if (isset($this->js)) {
        foreach ($this->js as $js){
            _e( '<script type="text/javascript" src="' . BASE_URL . 'static/assets/'.$js.'"></script>' . "\n" );
        }
    }
	?>

<?php if(Hooks::get_option('enable_cron_jobs') == 1) { ?>
<img src="<?=BASE_URL;?>cron/fireCron/?image=1" width="1px" height="1px" style="border:0;" />
<?php } ?>

<?php footer(); ?>
</body>
</html>
<?php print_gzipped_page(); ?>