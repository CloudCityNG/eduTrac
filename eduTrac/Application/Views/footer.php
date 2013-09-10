<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Site Footer
 *  
 * PHP 5
 *
 * eduTrac(tm) : Student Information System (http://www.7mediaws.org/)
 * Copyright (C) 2013 Joshua Parker
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
 * @since eduTrac(tm) v 1.0
 * @license GNU General Public License v3 (http://www.gnu.org/licenses/gpl-3.0.html)
 */
?>
		<div id="footer" class="hidden-print">
			
			<!--  Copyright Line -->
			<div class="copy"><?php _e( _t( '&copy; 2013' ) ); ?> - <a href="http://edutrac.org">eduTrac</a> <?php footer(); ?></div>
			<!--  End Copyright Line -->
	
		</div>
		<!-- // Footer END -->
		
	</div>
	<!-- // Main Container Fluid END -->
	
	<!-- Code Beautify -->
	<script src="<?=BASE_URL;?>static/common/theme/scripts/plugins/other/js-beautify/beautify.js"></script>
	<script src="<?=BASE_URL;?>static/common/theme/scripts/plugins/other/js-beautify/beautify-html.js"></script>
	
	<!-- Global -->
	<script>
	var basePath = '',
		commonPath = '<?=BASE_URL;?>static/common/';
		adminPath = '<?=BASE_URL;?>admin/';
	</script>
	
	<!-- JQueryUI -->
	<script src="<?=BASE_URL;?>static/common/theme/scripts/plugins/system/jquery-ui/js/jquery-ui-1.9.2.custom.min.js"></script>
	
	<!-- JQueryUI Touch Punch -->
	<!-- small hack that enables the use of touch events on sites using the jQuery UI user interface library -->
	<script src="<?=BASE_URL;?>static/common/theme/scripts/plugins/system/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
	
	
	<!-- Modernizr -->
	<script src="<?=BASE_URL;?>static/common/theme/scripts/plugins/system/modernizr.js"></script>
	
	<!-- Bootstrap -->
	<script src="<?=BASE_URL;?>static/common/bootstrap/js/bootstrap.min.js"></script>
	
	<!-- SlimScroll Plugin -->
	<script src="<?=BASE_URL;?>static/common/theme/scripts/plugins/other/jquery-slimScroll/jquery.slimscroll.min.js"></script>
	
	<!-- Common Demo Script -->
	<script src="<?=BASE_URL;?>static/common/theme/scripts/demo/common.js?1371788382"></script>
	
	<!-- Holder Plugin -->
	<script src="<?=BASE_URL;?>static/common/theme/scripts/plugins/other/holder/holder.js"></script>
	<script>
		Holder.add_theme("dark", {background:"#000", foreground:"#aaa", size:9});
		Holder.add_theme("white", {background:"#fff", foreground:"#c9c9c9", size:9});
	</script>
	
	<!-- Uniform Forms Plugin -->
	<script src="<?=BASE_URL; ?>static/common/theme/scripts/plugins/forms/pixelmatrix-uniform/jquery.uniform.min.js"></script>

	<!-- Bootstrap Extended -->
	<script src="<?=BASE_URL;?>static/common/bootstrap/extend/bootstrap-select/bootstrap-select.js"></script>
	<script src="<?=BASE_URL;?>static/common/bootstrap/extend/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
	<script src="<?=BASE_URL;?>static/common/bootstrap/extend/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js"></script>
	<script src="<?=BASE_URL;?>static/common/bootstrap/extend/jasny-fileupload/js/bootstrap-fileupload.js"></script>
	<script src="<?=BASE_URL;?>static/common/bootstrap/extend/bootbox.js"></script>
	<script src="<?=BASE_URL;?>static/common/bootstrap/extend/bootstrap-wysihtml5/js/wysihtml5-0.3.0_rc2.min.js"></script>
	<script src="<?=BASE_URL;?>static/common/bootstrap/extend/bootstrap-wysihtml5/js/bootstrap-wysihtml5-0.0.2.js"></script>
	
	<!-- Google Code Prettify -->
	<script src="<?=BASE_URL;?>static/common/theme/scripts/plugins/other/google-code-prettify/prettify.js"></script>
	
	<!-- Gritter Notifications Plugin -->
	<script src="<?=BASE_URL;?>static/common/theme/scripts/plugins/notifications/Gritter/js/jquery.gritter.min.js"></script>
	
	<!-- MiniColors Plugin -->
	<script src="<?=BASE_URL;?>static/common/theme/scripts/plugins/color/jquery-miniColors/jquery.miniColors.js"></script>
	
	<!-- DateTimePicker Plugin -->
	<script src="<?=BASE_URL;?>static/common/theme/scripts/plugins/forms/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

	<!-- Cookie Plugin -->
	<script src="<?=BASE_URL;?>static/common/theme/scripts/plugins/system/jquery.cookie.js"></script>
	
	<!-- Ba-Resize Plugin -->
	<script src="<?=BASE_URL;?>static/common/theme/scripts/plugins/other/jquery.ba-resize.js"></script>
	
	<!-- Dashboard Demo Script -->
	<script src="<?=BASE_URL;?>static/common/theme/scripts/demo/index.js?1371788382"></script>
	
	<!-- Shortcut Keys -->
	<script src="<?=BASE_URL;?>static/common/theme/scripts/demo/mousetrap.js"></script>
	<script src="<?=BASE_URL;?>static/common/theme/scripts/demo/shortcut.js"></script>
	
	
	<!-- Google JSAPI -->
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	
	<?php
		if (isset($this->js)) {
        foreach ($this->js as $js){
            _e( '<script type="text/javascript" src="' . BASE_URL . 'static/common/'.$js.'"></script>' . "\n" );
        }
    }
	?>
<!-- <a href="<?=BASE_URL;?>" title="cronJob"><img src="<?=BASE_URL;?>cron/fireCron/?image=1" style="border:0;" /></a> -->
</body>
</html>
<?php print_gzipped_page(); ?>