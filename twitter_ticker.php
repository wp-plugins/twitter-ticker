<?php
/*
Plugin Name: Twitter Ticker
Plugin URI: http://www.eduvoyage.com/twitter_ticker/index.html
Version: v0.4
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
			$twitterTickerAdminOptions = array('auto_reveal' => 'true',
				'speed' => 'walk', 
				'query' => '@biz');
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

<script type="text/javascript" charset="utf-8"><!--
 keywords = '<?php _e(stripslashes($devOptions['query'])); ?>';
 auto = <?php _e($devOptions['auto_reveal']); ?>;
 speed = '<?php _e($devOptions['speed']); ?>';
--></script>
<script src="http://eduvoyage.com/ttseed.js" type="text/javascript"></script>	

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
						if (isset($_POST['auto_reveal'])) {
							$devOptions['auto_reveal'] = $_POST['auto_reveal'];
						}	
						if (isset($_POST['query'])) {
							$devOptions['query'] = $_POST['query'];
						}	
						if (isset($_POST['speed'])) {
							$devOptions['speed'] = apply_filters('content_save_pre', $_POST['speed']);
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

<input type="text" name="query" value="<?php _e(stripslashes(htmlspecialchars($devOptions['query'])), 'TwitterTicker') ?>">
<p>Example search queries:</p>
<ul>
    <li><p><strong>'from:tweettic'</strong> (displays tweets from tweettic only)</p></li>
    <li><p><strong>'from:tweettic from:biz from:twitter'</strong> (displays tweets from tweettic, twitter and biz only)</p></li>
    <li><p><strong>'ticker'</strong> (displays tweets containing the keyword 'ticker' only)</p></li>
    <li><p><strong>'ticker twitter'</strong> (displays tweets containing the keywords 'ticker' and 'twitter')</p></li>
    <li><p><strong>'"twitter ticker"'</strong> (displays tweets containing the exact phrase 'twitter ticker')</p></li>      
    <li><p><strong>'@tweettic'</strong> (displays tweets mentioning this user (tweettic))</p></li>
    <li><p><strong>'@tweettic @twitter'</strong> (displays tweets mentioning twitter AND tweettic)</p></li>      
    <li><p><strong>'@tweettic OR @twitter'</strong> (displays tweets mentioning twitter OR tweettic)</p></li>
    <li><p><strong>'to:tweettic'</strong> (displays tweets replying to this user (tweettic))</p></li>
    <li><p><strong>'to:tweettic to:twitter'</strong> (displays tweets replying to twitter and tweettic)</p></li>      
</ul>


<h3>Automatically reveal ticker when page loads?</h3>
<p>
<label for="twitterAutoReveal_yes">
<input type="radio" id="auto_reveal_yes" name="auto_reveal" value="true" <?php if ($devOptions['auto_reveal'] == "true") { _e('checked="checked"', "TwitterTicker"); }?> /> Yes</label>

&nbsp;&nbsp;&nbsp;&nbsp;
<label for="auto_reveal_no">
<input type="radio" id="auto_reveal_no" name="auto_reveal" value="false" <?php if ($devOptions['auto_reveal'] == "false") { _e('checked="checked"', "TwitterTicker"); }?>/> No</label></p>

<h3>Ticker Speed?</h3>
<p>
<label for="speed_crawl">
<input type="radio" id="speed_crawl" name="speed" value="crawl" <?php if ($devOptions['speed'] == "crawl") { _e('checked="checked"', "TwitterTicker"); }?> /> Crawl</label>

&nbsp;&nbsp;&nbsp;
<label for="speed_walk">
<input type="radio" id="speed_walk" name="speed" value="walk" <?php if ($devOptions['speed'] == "walk") { _e('checked="checked"', "TwitterTicker"); }?>/> Walk</label>

&nbsp;&nbsp;&nbsp;
<label for="speed_run">
<input type="radio" id="speed_run" name="speed" value="run" <?php if ($devOptions['speed'] == "run") { _e('checked="checked"', "TwitterTicker"); }?>/> Run</label>

&nbsp;&nbsp;&nbsp;
<label for="speed_sprint">
<input type="radio" id="speed_sprint" name="speed" value="sprint" <?php if ($devOptions['speed'] == "sprint") { _e('checked="checked"', "TwitterTicker"); }?>/> Sprint</label>

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