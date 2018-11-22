---
ID: 41587
post_title: 'Better wp-cron using linux&#8217;s crontab'
author: Rahul Bansal
post_excerpt: "Replace WordPress default wp-cron with linux's crontab. This will speed up page-loading for some visitors and will also make sure that cron always run."
layout: page
permalink: >
  https://easyengine.io/tutorials/wordpress/wp-cron-crontab/
published: true
post_date: 2013-06-28 15:43:19
---
WordPress has something called wp-cron. If you haven't read about it, its fine. But please be aware that you cannot live without it! That is why, I am not asking you to <strong>disable</strong> wp-cron.
<h3>Disable wp-cron</h3>
Still, we need to disable WordPress default wp-cron behaviour by adding following line to wp-config.php file:
<pre class="no-highlight">define('DISABLE_WP_CRON', true);</pre>
<h3>Setup a real cronjob</h3>
From your Linux terminal, first open crontab:
<pre class="no-highlight">crontab -e</pre>
Then add a line like below in it.
<pre>*/10 * * * * curl http://example.com/wp-cron.php?doing_wp_cron &gt; /dev/null 2&gt;&amp;1</pre>
<pre class="no-highlight"><span style="font-family: 'Open Sans', Arial, sans-serif; line-height: 24px;">OR</span></pre>
<pre>*/10 * * * * cd /var/www/example.com/htdocs; php /var/www/example.com/htdocs/wp-cron.php?doing_wp_cron &gt; /dev/null 2&gt;&amp;1</pre>
<p class="rtp-info">Please make sure you use correct path to <code>wp-cron.php</code>.</p>
Alternately, you can also use WP-Cli
<pre>*/10 * * * * cd /var/www/example.com/htdocs; wp cron event run --due-now &gt; /dev/null 2&gt;&amp;1</pre>
Above will run wp-cron every 10 minutes. You can change <code>*/10</code> to <code>*/5</code> to make it run every 5 minutes.

Difference between two-lines is, first one uses PHP-FPM (or PHP-CGI) and second one uses PHP-CLI. CLI scripts do not have time limits. Depending on your setup, it may be desirable or undesirable.
<h3>Is it recommend for high-traffic site?</h3>
I haven't digged into wp-cron a lot but what I know is that it executes on every page-load. So if there is a long running process which gets triggers by wp-cron, it will delay page loading for that user.

Using crontab, wp-cron is run by independent PHP process. So it will not interfere with any visitors page-request.

Because of this, we highly recommend running wp-cron via linux crontab rather than WordPress's default way, irrespective of size or traffic of your site.