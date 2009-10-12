=== Plugin Name ===
Contributors: osahyoun
Tags: twitter, tweets, ticker, feed, widget
Requires at least: 1.5
Tested up to: 2.8.4
Stable tag: trunk

Twitter Ticker is a stylish widget to display twitter search results, in a news ticker fashion. 

== Description ==


== Installation ==

1. Upload `twitter_ticker.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Plugin requires your theme to have the wp_footer hook: `<?php get_footer(); ?>`
4. From the settings menu select 'Twitter Ticker' to adjust your ticker settings, including speed and search query.

<p>You can search tweets by keywords, or fetch tweets for a particular user ('from:bob'). Tweets can be displayed at variable speeds: 'crawl', 'walk', 'run' and 'sprint'.</p>

<p>Example search queries:</p>

<ul>
    <li><p><strong>'from:tweettic';</strong> (displays tweets from tweettic only)</p></li>
    <li><p><strong>'from:tweettic from:biz from:twitter';</strong> (displays tweets from tweettic, twitter and biz only)</p></li>
    <li><p><strong>'ticker';</strong> (displays tweets containing the keyword 'ticker' only)</p></li>
    <li><p><strong>'ticker twitter';</strong> (displays tweets containing the keywords 'ticker' and 'twitter')</p></li>
    <li><p><strong>'"twitter ticker"';</strong> (displays tweets containing the exact phrase 'twitter ticker')</p></li>      
    <li><p><strong>'@tweettic';</strong> (displays tweets mentioning this user (tweettic))</p></li>
    <li><p><strong>'@tweettic @twitter';</strong> (displays tweets mentioning twitter AND tweettic)</p></li>      
    <li><p><strong>'@tweettic OR @twitter';</strong> (displays tweets mentioning twitter OR tweettic)</p></li>
    <li><p><strong>'to:tweettic';</strong> (displays tweets replying to this user (tweettic))</p></li>
    <li><p><strong>'to:tweettic to:twitter';</strong> (displays tweets replying to twitter and tweettic)</p></li>      
</ul>

 <p>Visit <a href="http://search.twitter.com/operators">search.twitter.com/operators</a> for a full list of operators you can use in 
your query.</p>


<a href="http://eduvoyage.com/twitter_ticker/index.html">Visit the ticker home page to see it in action</a>.

Follow <a href="http://twitter.com/tweettic">Twitter Ticker</a> to stay up-to-date with new developments.

== Screenshots ==

1. Twitter Ticker at the bottom of the screen.
2. Twitter Ticker neatly collapsed.


== FAQ ==
Contact us at ticker [at] eduvoyage [dot] com if you need any help installing the plugin or have any feature requests.

== Changelog ==
<ul>
<li>5 Oct: Define settings before seeding</li>
<li>5 Oct: Improved code reliability across major browsers</li>
<li>6 Oct: Updated example search queries</li>
<li>11 Oct: Improved robustness of CSS</li>
<li>12 Oct (v0.4.3): Removed invalid function call (thanks to Dj PHANTOMZ @ http://www.mediaz-empire.com for brining the error to my attention)</li>
</ul>