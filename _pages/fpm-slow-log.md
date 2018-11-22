---
ID: 10462
post_title: >
  Debugging PHP Scripts Using slow_log and
  more
author: Rahul Bansal
post_excerpt: >
  Slowly executing PHP scripts may not
  break application itself but degrade
  overall system performance
  significantly. Using slow_log we can
  find and fix them.
layout: page
permalink: >
  https://easyengine.io/tutorials/php/fpm-slow-log/
published: true
post_date: 2012-09-26 23:49:16
---
<a href="https://easyengine.io/series/wordpress-nginx-tutorials/"><img class="alignright size-full wp-image-10804" title="wordpress-nginx" alt="" src="https://easyengine.io/wp-content/uploads/2012/09/wordpress-nginx.jpeg" width="220" height="91" /></a>If you are an old PHP programmer, you must have used PHP's <a href="http://php.net/manual/en/function.error-log.php">error_log</a> function sometime. But PHP itself does not provide a way to find out slowly executing scripts. Slow scripts are not the ones which break your site but they slow-down everything. Using FPM, we can have a slow_log for all such scripts. Let's see how to use these logs to debug PHP scripts. Also, we will see how PHP's <code>error_log</code> gets diverted if it is running behind FPM and Nginx.
<h3>Setup slow_log for PHP scripts</h3>
Open... <code>vim /etc/php5/fpm/pool.d/www.conf</code>Make necessary changes to match following values:
<pre class="prettyprint">slowlog = /var/log/php5/slow.log
request_slowlog_timeout = 10s</pre>
You can replace 10s with any other value. This will help us find scripts which execute slowly. Image resizing function, network I/O related functions are some examples which will frequently show-up in PHP slow_log. Its up to you to debug them or ignore them based on your context.
<h3 class="prettyprint">Setup error_log for PHP scripts</h3>
When running PHP using FPM, we can override any php.ini setting from FPM. Open... <code>vim /etc/php5/fpm/pool.d/www.conf</code>Scroll down towards bottom and uncomment/change following 3 lines to match values given below:
<pre>php_admin_value[error_log] = /var/log/php5/error.log
php_admin_flag[log_errors] = on</pre>
Please note that turning on <code>display_errors</code> can break ajax-based applications. So be really careful with this.
<h4>Important for Nginx Users</h4>
You will not see a file<code>/var/log/php5/error.log</code> or not any error being logged in that file. Errors in your PHP scripts for a site will go into<code>error_log</code> specified for that site in its nginx config. Most likely: <code>/var/www/example.com/logs/error.log<code> file</code></code> If you haven't specified any <code>error_log</code> path for your site, then PHP errors will go to Nginx's default error_log. Most likely <code>/var/log/nginx/error.log</code> file) You can <a title="Debugging Nginx Configuration Like A Pro!" href="https://easyengine.io/tutorials/debugging-nginx-configuration/">find more details here about debugging with Nginx</a>.
<h3>Setup FPM error_log to debug FPM itself</h3>
FPM is separate process. Like others, it can run into errors itself! FPM's error_log is on by default but we will change its path to meet our convention. Open... <code>vim /etc/php5/fpm/php-fpm.conf</code> Make sure<code>error_log</code> value looks like below
<pre>error_log = /var/log/php5/fpm.log</pre>
Please note that this error_log is not related to PHP's <code>error_log</code> function described before.
<h4>Confirm Changes...</h4>
Create php5 log directory so we can have all PHP logs in one place:
<pre>mkdir /var/log/php5/</pre>
Restart PHP-FPM for changes to take effect...
<pre>service php5-fpm restart</pre>
<h4>Monitoring log file</h4>
Best way to open a separate shell on your server and use <code>tail -f</code> command to monitor logs... As we have multiple log files to monitor,<span style="font-family: Consolas, monaco, monospace;"><span > </span></span>you can simply use following command to monitor all of them together...
<pre>tail -f /var/log/php5/*.log</pre>
<code>slow_log</code> helped us many times to eliminate bottlenecking from our applications.

Always <strong>remember</strong> to turn it off when you are done with debugging. Leaving <code>slow_log</code> on is not a good idea.