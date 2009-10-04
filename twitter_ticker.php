<?php
/*
Plugin Name: Twitter Ticker
Plugin URI: http://www.eduvoyage.com/twitter_ticker/index.html
Version: v0.1
Author: EduVoyage
Description: Stylish widget to display twitter search results, in a news ticker fashion.

 
Copyright 2009  EduVoyage  (email : ticker [a t ] eduvoyage DOT com)

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
if (!class_exists("TwitterTicker")) {
	class TwitterTicker {
		var $adminOptionsName = "TwitterTickerAdminOptions";
		function TwitterTicker() { //constructor
			
		}
		function init() {
			$this->getAdminOptions();
		}
		//Returns an array of admin options
		function getAdminOptions() {
			$twitterTickerAdminOptions = array('show_header' => 'true',
				'add_content' => 'walk', 
				'content' => '@biz');
			$devOptions = get_option($this->adminOptionsName);
			if (!empty($devOptions)) {
				foreach ($devOptions as $key => $option)
					$twitterTickerAdminOptions[$key] = $option;
			}				
			update_option($this->adminOptionsName, $twitterTickerAdminOptions);
			return $twitterTickerAdminOptions;
		}
		
		function addHeaderCode() {
			$devOptions = $this->getAdminOptions();
			
      ?>
      <script src="http://eduvoyage.com/ttseed.js" type="text/javascript"></script>	
      <script type="text/javascript" charset="utf-8"><!--
       //SETTINGS BELOW
       keywords = '<?php _e(stripslashes($devOptions['content'])); ?>';
       auto = <?php _e($devOptions['show_header']); ?>;
       speed = '<?php _e($devOptions['add_content']); ?>';
      --></script>
      			<?php
		
		}
		
		
		function addContent($content = '') {
			$devOptions = $this->getAdminOptions();
      // if ($devOptions['add_content'] == "walk") {
				$content .= $devOptions['content'];
      // }
			return $content;
		}
		//Prints out the admin page
		function printAdminPage() {
					$devOptions = $this->getAdminOptions();
										
					if (isset($_POST['update_twitterTickerPluginSeriesSettings'])) { 
						if (isset($_POST['twitterTickerHeader'])) {
							$devOptions['show_header'] = $_POST['twitterTickerHeader'];
						}	
						if (isset($_POST['twitterTickerAddContent'])) {
							$devOptions['add_content'] = $_POST['twitterTickerAddContent'];
						}	
						if (isset($_POST['twitterTickerContent'])) {
							$devOptions['content'] = apply_filters('content_save_pre', $_POST['twitterTickerContent']);
						}
						update_option($this->adminOptionsName, $devOptions);
						
						?>
<div class="updated"><p><strong><?php _e("Settings Updated.", "TwitterTicker");?></strong></p></div>
					<?php
					} ?>
<div class=wrap>
<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
<h2>Twitter Ticker</h2>
<h3>Search Query</h3>

<input type="text" name="twitterTickerContent" value="<?php _e(stripslashes(htmlspecialchars($devOptions['content'])), 'TwitterTicker') ?>">

<ul>
<li><strong>from:bbc</strong> - Tweets only from the tweettic</li>
<li><strong>ticker</strong> - Tweets containing the word 'ticker'</li>
<li><strong>@tweettic</strong> - Tweets mentioning a user (tweettic)</li>
<li><strong>to:tweettic</strong> - Tweets replying to a user (tweettic)</li>
<li>Visit: <a href="http://search.twitter.com/operators">http://search.twitter.com/operators</a> for a list of oeprators you can use in your query</li>
</ul>

<h3>Automatically reveal ticker when page loads?</h3>
<p>
<label for="twitterTickerHeader_yes">
<input type="radio" id="twitterTickerHeader_yes" name="twitterTickerHeader" value="true" <?php if ($devOptions['show_header'] == "true") { _e('checked="checked"', "TwitterTicker"); }?> /> Yes</label>

&nbsp;&nbsp;&nbsp;&nbsp;
<label for="devloungeHeader_no">
<input type="radio" id="twitterTickerHeader_no" name="twitterTickerHeader" value="false" <?php if ($devOptions['show_header'] == "false") { _e('checked="checked"', "TwitterTicker"); }?>/> No</label></p>

<h3>Ticker Speed?</h3>
<p>
<label for="twitterTickerAddContent_crawl">
<input type="radio" id="twitterTickerAddContent_crawl" name="twitterTickerAddContent" value="crawl" <?php if ($devOptions['add_content'] == "crawl") { _e('checked="checked"', "TwitterTicker"); }?> /> Crawl</label>

&nbsp;&nbsp;&nbsp;
<label for="twitterTickerAddContent_walk">
<input type="radio" id="twitterTickerAddContent_walk" name="twitterTickerAddContent" value="walk" <?php if ($devOptions['add_content'] == "walk") { _e('checked="checked"', "TwitterTicker"); }?>/> Walk</label>

&nbsp;&nbsp;&nbsp;
<label for="twitterTickerAddContent_run">
<input type="radio" id="twitterTickerAddContent_run" name="twitterTickerAddContent" value="run" <?php if ($devOptions['add_content'] == "run") { _e('checked="checked"', "TwitterTicker"); }?>/> Run</label>

&nbsp;&nbsp;&nbsp;
<label for="twitterTickerAddContent_sprint">
<input type="radio" id="twitterTickerAddContent_sprint" name="twitterTickerAddContent" value="sprint" <?php if ($devOptions['add_content'] == "sprint") { _e('checked="checked"', "TwitterTicker"); }?>/> Sprint</label>


</p>


<div class="submit">
<input type="submit" name="update_twitterTickerPluginSeriesSettings" value="<?php _e('Update Settings', 'TwitterTicker') ?>" /></div>
</form>
 </div>
					<?php
				}//End function printAdminPage()
	
	}

} //End Class DevloungePluginSeries

if (class_exists("TwitterTicker")) {
	$dl_twitterTicker = new TwitterTicker();
}

//Initialize the admin panel
if (!function_exists("TwitterTicker_ap")) {
	function TwitterTicker_ap() {
		global $dl_twitterTicker;
		if (!isset($dl_twitterTicker)) {
			return;
		}
		if (function_exists('add_options_page')) {
	    add_options_page('Twitter Ticker', 'Twitter Ticker', 9, basename(__FILE__), array(&$dl_twitterTicker, 'printAdminPage'));
		}
	}	
}

//Actions and Filters	
if (isset($dl_twitterTicker)) {
	//Actions
	add_action('admin_menu', 'TwitterTicker_ap');
	add_action('wp_footer', array(&$dl_twitterTicker, 'addHeaderCode'), 1);
	add_action('activate_twitterticker/twitter_ticker.php',  array(&$dl_twitterTicker, 'init'));
	//Filters
  // add_filter('the_content', array(&$dl_twitterTicker, 'addContent'),1); 
	add_filter('get_comment_author', array(&$dl_twitterTicker, 'authorUpperCase'));
}

?>