---
ID: 131108
post_title: debug
author: Dinesh Jain
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/docs/commands/debug/
published: true
post_date: 2015-11-23 12:21:32
---
<pre><code>**Note** : --start/--stop options are deprecated since EasyEngine 3.0.5 version.
</code></pre>
<h2 id="debugging-server-parameters-globally-for-all-sites">Debugging Server Parameters Globally (For all sites)</h2>
These commands are used for server level debugging.
<pre><code>ee debug [Options]
Options :
    	-i                              # Interactive debug
      	--nginx                         # Debug Nginx
       	--rewrite                       # Debug Nginx rewrite rules
       	--fpm                           # Debug FastCGI
        --fpm7                          # Debug FastCGI PHP 7.0
       	--php                           # Debug PHP
        --php7                          # Debug PHP 7.0
       	--mysql                         # Debug MySQL
       	--import-slow-log-interval      # Import MySQL slow log to Anemometer
       	--all                           # Debug all server paramenters
</code></pre>
<em>-i</em> : This option enables interactive debugging and stop the debugging once ctrl+c is pressed

<em>–-nginx</em> : This option enables Nginx enable <code>debug_connection</code> for ip_address enlisted in<code>/etc/easyengine/ee.conf</code>. If ip_address is blank then its start debug_connection for 0.0.0.0/0 ip

<em>–-rewrite</em> : This option enable <code>rewrite_log</code> on in <code>/etc/nginx/nginx.conf</code> file

<em>–-php</em> : This option enable PHP5-FPM slow log, xdebug profiling

<em>–-fpm</em> : This option change PHP5-FPM <code>log_level</code> from <code>notice</code> to <code>debug</code> level

<em>–-php7</em> : This option enable PHP7.0-FPM slow log, xdebug profiling

<em>–-fpm7</em> : This option change PHP7.0-FPM <code>log_level</code> from <code>notice</code> to <code>debug</code> level

<em>–-mysql</em> : This option enable MySQL slow log

<em>–all</em> : This option starts debugging all parametrs at server level.
<h3 id="to-stop-debugging-for-any-parameter-just-pass-off-value-for-that-parameter">To stop debugging for any parameter just pass <code>off</code> value for that parameter</h3>
For example you started debugging all parameters and you want to stop any one say nginx
<pre><code>ee debug --nginx=off
</code></pre>
Similarly, you can do it for <code>--all</code>
<pre><code>ee debug --all=off
</code></pre>
<h1 id="site-options">Site options</h1>
These commands are used for site level debugging.
<pre><code>ee debug [websitename] [Options]
Options :
    	-i                        # Interactive debug.
    	--nginx                   # Debug Nginx.
    	--rewrite                 # Debug Nginx rewrite rules.
    	--wp                      # Debug wordpress sites.
    	--all                     # Debug all site wide parameters
</code></pre>
<em>-i</em> : This option enables interactive debugging and stop the debugging once <code>ctrl+c</code> is pressed

<em>–-nginx</em> : This option enables Nginx <code>error_log</code> for example.com in debugging mode.

<em>–-rewrite</em> : This option enable <code>rewrite_log</code> on for example.com

<em>–-wp</em> : This option enable <code>wp-content/debug.log</code> logging. This also, installs developer plugin. <a href="https://easyengine.io/tutorials/wordpress/debugging/">Click here for more details</a>

<em>–all</em> : Starts debug dor all site wide parametrs
<h1 id="start-debugging">Start Debugging</h1>
<div data-unique="Global"></div>
<h2 id="global">Global</h2>
<pre><code>ee debug --all
ee debug --nginx --rewrite --fpm --php --mysql
</code></pre>
To debug a specific part, you can use one or more command below:
<pre><code>ee debug --php
ee debug --php7
ee debug --nginx
ee debug --rewrite
ee debug --fpm
ee debug --fpm7
ee debug --mysql
</code></pre>
To enable slow log import for each time interval, let say for each 5min interval, you can command below:
<pre><code>ee debug --mysql --import-slow-log-interval=5
</code></pre>
To stop debug mode :
<pre><code>ee debug --all=off
</code></pre>
<div data-unique="Site-wide"></div>
<h2 id="site-wide">Site-wide</h2>
To start complete debugging for a site, please use either command below:
<pre><code>ee debug example.com --all
ee debug example.com --wp --nginx --rewrite
</code></pre>
To debug a specific part, you can use one or more command below:
<pre><code>ee debug example.com --wp
ee debug example.com --nginx
ee debug example.com --rewrite
</code></pre>
To stop debug mode for single parameter:
<pre><code>ee debug example.com --wp=off
</code></pre>
To stop debug mode for site :
<pre><code>ee debug example.com --all=off
</code></pre>
<div data-unique="TriggerXdebugProfiling"></div>
<h3 id="trigger-xdebug-profiling">Trigger Xdebug Profiling</h3>
If you are using <code>--php</code> flag to analyse xdebug profiling information you may be surprised to see nothing in webgrind.

This is because EasyEngine has set xdebug to profile only on trigger. This is good for profiling live sites as xdebug profiling data take too much space.

Triggering is easy. You can use this browser extension to trigger profiling for <a href="https://addons.mozilla.org/en-US/firefox/addon/the-easiest-xdebug/">Firefox</a>, <a href="https://chrome.google.com/extensions/detail/eadndfjplgieldjbigjakmdgkmoaaaoc">Chrome</a>, <a href="https://github.com/benmatselby/xdebug-toggler">Safari</a>and <a href="http://addons.opera.com/extensions/details/xdebug-launcher/">Opera</a>