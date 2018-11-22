---
ID: 38176
post_title: 'Nginx &#8211; Enable PHP-FPM Status Page'
author: Rahul Bansal
post_excerpt: >
  Instructions to enable php-fpm status
  page and explanation of different
  values.
layout: page
permalink: >
  https://easyengine.io/tutorials/php/fpm-status-page/
published: true
post_date: 2013-06-11 14:38:29
---
<!-- wp:paragraph -->
<p>PHP-FPM has a very useful built-in&nbsp;status page.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>You can access it over web and also&nbsp;write scripts to monitor your PHP-FPM sites health remotely.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Enabling PHP-FPM Status Page</h2>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<h3>Edit PHP-FPM Config</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>In file <code>/etc/php5/fpm/pool.d/www.conf</code>, find <code>pm.status_path</code>&nbsp;variable.</p>
<!-- /wp:paragraph -->

<!-- wp:preformatted -->
<pre class="wp-block-preformatted">vim +/pm.status_path /etc/php5/fpm/pool.d/www.conf</pre>
<!-- /wp:preformatted -->

<!-- wp:paragraph -->
<p>Uncomment that line (if its commented).</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Default value is <code>/status</code>. You can change it to something else. May be you can add pool-prefix if you are running multiple PHP pools.</p>
<!-- /wp:paragraph -->

<!-- wp:preformatted -->
<pre class="wp-block-preformatted">pm.status_path = /status</pre>
<!-- /wp:preformatted -->

<!-- wp:heading {"level":3} -->
<h3>Edit Nginx config</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Next, in Nginx config for <code>example.com</code>&nbsp;add a location block like below:</p>
<!-- /wp:paragraph -->

<!-- wp:preformatted -->
<pre class="wp-block-preformatted">location = /status {<br>  access_log off;<br>  allow 127.0.0.1;<br>  allow 1.2.3.4#your-ip;<br>  deny all;<br>  include fastcgi_params;<br>  fastcgi_pass 127.0.0.1:9000;<br>}<br><br>location = /ping {<br>  access_log off;<br>  allow 127.0.0.1;<br>  allow 1.2.3.4#your-ip;<br>  deny all;<br>  include fastcgi_params;<br>  fastcgi_pass 127.0.0.1:9000;<br>}</pre>
<!-- /wp:preformatted -->

<!-- wp:paragraph -->
<p>Do not forget to replace your IP address. For security reasons, its better to keep your PHP-FPM status page private.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Reload PHP-FPM and Nginx config for changes to take effect.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>PHP-FPM Status Sample</h2>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<h3>Default PHP-FPM Status Sample</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Now, open&nbsp;<code>http://example.com/status</code>&nbsp;in browser to see&nbsp;summarised&nbsp;stats like below</p>
<!-- /wp:paragraph -->

<!-- wp:preformatted -->
<pre class="wp-block-preformatted">pool:                 www
process manager:      dynamic
start time:           17/May/2013:13:54:02 +0530
start since:          886617
accepted conn:        1619617
listen queue:         0
max listen queue:     0
listen queue len:     0
idle processes:       28
active processes:     2
total processes:      30
max active processes: 31
max children reached: 0
slow requests:        0</pre>
<!-- /wp:preformatted -->

<!-- wp:heading {"level":4} -->
<h4>Below is meaning of different values</h4>
<!-- /wp:heading -->

<!-- wp:list -->
<ul><li><strong>pool</strong> - the name of the pool. Mostly it will be www.</li><li><strong>process manager</strong> - possible values static, <strong>dynamic</strong> or ondemand. We never use static. &nbsp;Trying <strong>ondemand</strong> is on todo list.</li><li><strong>start time</strong> - the date and time FPM has started or reloaded. Reloading PHP-FPM (<code>service php5-fpm reload</code>) reset this value.</li><li><strong>start since</strong> - number of seconds since FPM has started</li><li><strong>accepted conn</strong> - the number of request accepted by the pool</li><li><strong>listen queue</strong> - the number of request in the queue of pending connections. If this number is non-zero, then you better increase number of process FPM can spawn.</li><li><strong>max listen queue</strong> - the maximum number of requests in the queue&nbsp;of pending connections since FPM has started</li><li><strong>listen queue len</strong> - the size of the socket queue of pending connections</li><li><strong>idle processes</strong> - the number of idle processes</li><li><strong>active processes</strong> - the number of active processes</li><li><strong>total processes</strong> - the number of idle + active processes</li><li><strong>max active processes</strong> - the maximum number of active processes since FPM&nbsp;has started</li><li><strong>max children reached -&nbsp;</strong>number of times, the process limit has been reached,&nbsp;when pm tries to start more children.&nbsp;If that value is not zero, then you may need to increase max process limit for your PHP-FPM pool. Like this, you can find other useful information to tweak your pool better way.</li><li><strong>slow requests</strong> - <a href="https://easyengine.io/tutorials/debugging-php-scripts-using-slow_log-and-more/">Enable php-fpm slow-log</a> before you consider this. If this value is non-zero you may have slow php processes. Poorly written mysql queries are generally culprit.</li></ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>Full PHP-FPM Status Sample</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>If you want detailed stats, you can pass argument&nbsp;<code>?full</code>to status page URL. It will become&nbsp;<code>http://example.com/status?full</code></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>In additional to pool-level summary we have seen above, this will show extra details for per process.&nbsp;A sample is below:</p>
<!-- /wp:paragraph -->

<!-- wp:preformatted -->
<pre class="wp-block-preformatted">pid:                  1419692
state:                Idle
start time:           27/May/2013:20:06:12 +0530
start since:          287
requests:             32
request duration:     188927
request method:       GET
request URI:          /feed.php?uid=12997446135571490564
content length:       0
user:                 -
script:               /var/www/example.com/htdocs/feed.php
last request cpu:     5.29
last request memory:  524288</pre>
<!-- /wp:preformatted -->

<!-- wp:heading {"level":4} -->
<h4>Below is meaning of different values</h4>
<!-- /wp:heading -->

<!-- wp:list -->
<ul><li><strong>pid</strong> - the PID of the process. You can use this PID to kill a long running process.</li><li><strong>state</strong> - the state of the process (Idle, Running, ...)</li><li><strong>start time</strong> - the date and time the process has started</li><li><strong>start since - </strong>the number of seconds since the process has started</li><li><strong>requests</strong> - the number of requests the process has served</li><li><strong>request duration</strong> - the duration in µs of the requests</li><li><strong>request method</strong> - the request method (GET, POST, ...)</li><li><strong>request URI</strong> - the request URI with the query string</li><li><strong>content length</strong> - the content length of the request (only with POST)</li><li><strong>user</strong> - the user (PHP_AUTH_USER) (or '-' if not set)</li><li><strong>script</strong> - the main PHP script called (or '-' if not set)</li><li><strong>last request cpu</strong> - the %cpu the last request consumed.&nbsp;it's always 0 if the process is not in Idle state&nbsp;because CPU calculation is done when the request&nbsp;processing has terminated</li><li><strong>last request memory</strong>the max amount of memory the last request consumed.&nbsp;it's always 0 if the process is not in Idle state&nbsp;because memory calculation is done when the request&nbsp;processing has terminated</li></ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p><strong>Note:</strong> If the process is in Idle state, then informations are related to the&nbsp;last request the process has served. Otherwise informations are related to&nbsp;the current request being served.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>PHP-FPM Status Page Output formats</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>By default the status page output is formatted as text/plain. Passing either&nbsp;'html', 'xml' or 'json' in the query string will return the corresponding&nbsp;output syntax.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Examples for summary status page:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul><li>http://example.com/status</li><li>http://example.com/status?json</li><li>http://example.com/status?html</li><li>http://example.com/status?xml</li></ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p>Example for detailed status page:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul><li>http://example.com/status?full</li><li>http://example.com/status?json&amp;full</li><li>http://example.com/status?html&amp;full</li><li>http://example.com/status?xml&amp;full</li></ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p>You can use json or xml format to process status page output programatically. HTML is useful when viewing detailed status report.</p>
<!-- /wp:paragraph -->