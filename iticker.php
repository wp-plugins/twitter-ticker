<?php
/*
Plugin Name: iticker - The information ticker
Plugin URI: http://www.itickerapp.com
Version: v0.6.2
Author: iticker
Description: Stylish, customisable information toolbar for your website or blog.

 
Copyright 20010  ITICKER  (email : iticker [a t ] itickerapp DOT com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

if( !is_admin() ) {
	add_action('wp_footer', 'insert_js');

}
add_action('admin_menu', 'iticker_config_page');

function iticker_filter_footer() {
  $url = "http://static.itickerapp.com/iticker_seed.js";
  $iticker_sid = get_option('ItickerSID');
	$iticker_enabled = get_option('ItickerEnabled');	

	if ($iticker_sid != '' and $iticker_enabled) {
		wp_enqueue_script('itickerToolbar', $url, false, false, true );
	}
}

function insert_js() {
  $a = '<script type="text/javascript">';
  $b = "iticker_id = ".get_option('ItickerSID').";";
  $c = "</script>";
  echo $a;
  echo $b;
  echo $c;  

echo <<<Javascript

 <script type='text/javascript' src='http://static.itickerapp.com/iticker_seed.js?ver=0.0.1'></script>

Javascript;

}

function iticker_config_page() {
	add_submenu_page('themes.php', __('ITICKER Configuration'), __('ITICKER Configuration'), 'manage_options', 'iticker-key-config', 'iticker_config');
}

function iticker_config() {
	$iticker_sid = get_option('ItickerSid');
	$iticker_enabled = get_option('ItickerEnabled');

	if ( isset($_POST['submit']) ) {
		if (isset($_POST['sid']))
		{
			$iticker_sid = $_POST['sid'];
			if ($_POST['iticker_enabled'] == 'on')
			{
				$iticker_enabled = 1;
			}
			else
			{
				$iticker_enabled = 0;
			}
		}
		else
		{
			$iticker_toolbarpath = '';
			$iticker_enabled = 0;
		}
		update_option('ItickerSid', $iticker_sid);
		update_option('ItickerEnabled', $iticker_enabled);
		echo "<div id=\"updatemessage\" class=\"updated fade\"><p>iticker settings updated.</p></div>\n";
		echo "<script type=\"text/javascript\">setTimeout(function(){jQuery('#updatemessage').hide('slow');}, 3000);</script>";	
	}
	?>
	<div class="wrap">
		<h2>iticker for WordPress Configuration</h2>
		<div class="postbox-container">
			<div class="metabox-holder">	
				<div class="meta-box-sortables">
					<form action="" method="post" id="">
					<div id="" class="postbox">
						<div class="handlediv" title="Click to toggle"><br /></div>
						<h3 class="hndle"><span>ITICKER Settings</span></h3>
						<div class="inside">
							<table class="form-table">
								<tr><th valign="top" scrope="row">ITICKER On/Off:</th>
								<td valign="top"><input type="checkbox" id="iticker_enabled" name="iticker_enabled" <?php echo ($iticker_enabled ? 'checked="checked"' : ''); ?> /> <label for="iticker_enabled">Enable or disable iticker</label><br/></td></tr>
								<tr><th valign="top" scrope="row"><label for="toolbarpath">ITICKER ID:</label></th>
								<td valign="top"><input id="sid" name="sid" type="text" size="20" value="<?php echo $iticker_sid; ?>"/></td></tr>
								<tr><td colspan='2'><p>Get your <strong>ITICKER ID</strong> from <a href="http://www.itickerapp.com" target="_blank">www.itickerapp.com</a></p></td></tr>
							</table>
						</div>
					</div>
					<div class="submit"><input type="submit" class="button-primary" name="submit" value="Update ITICKER &raquo;" /></div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php
} 
?>