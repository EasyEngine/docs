---
ID: 10610
post_title: Debugging Nginx Configuration
author: Rahul Bansal
post_excerpt: >
  As your nginx configuration gets
  lengthier, its easy to loose track and
  end up messing up things! This guide
  will help you debug nginx config like a
  pro.
layout: page
permalink: >
  https://easyengine.io/tutorials/nginx/debugging/
published: true
post_date: 2012-09-27 23:04:57
---
By default, Nginx logs only standard errors to default Nginx error log file or a file specified by <code>error_log</code> directive in site-specific server configuration.

We can control many aspects about error logging which will help us debug our Nginx configuration.

<strong>Important: </strong>After any change to any Nginx configuration file, you must test and reload Nginx configuration for changes to take effect. On Ubuntu, you can simply run <code>nginx -t &amp;&amp; service nginx reload</code> command.
<h3>Before we proceed...</h3>
I believe, we never break something that we never code! So before you copy-paste any Nginx config, make sure you remove unwanted codes. Also, every time you upgrade Nginx, update your config files also to use latest Nginx offering.

And before we proceed, please read these official articles: <a href="http://wiki.nginx.org/Pitfalls">common Nginx Pitfalls</a>, <a href="http://wiki.nginx.org/IfIsEvil">if-is-evil</a>, <a href="http://wiki.nginx.org/NginxHttpCoreModule#location">location-directive</a> &amp; <a href="http://nginx.org/en/docs/http/request_processing.html">Nginx's request processing</a>. You might end up fixing your problem using them alone.

Alright... looks like you need some serious debugging... Lets go ahead!
<h3>Debug only rewrite rules</h3>
Most of the time, you will be needing this only. Specially when you are seeing 404 or unexpected pages.
<pre>server {
        #other config
        error_log    /var/logs/nginx/example.com.error.log;
        <strong>rewrite_log on;</strong>
        #other config
}</pre>
<code>rewrite_log</code> is simply a flag. When turned on, it will send rewrite related log messages inside<code>error_log</code> file with <code>[notice]</code> level.

So once you turn it on, start looking for log messages in <code>error_log</code> file.
<h3>Set Nginx log-level to debug</h3>
Following example adds <code>debug</code> log-level which logs most to specified path:
<pre class="prettyprint">server {
        #other config
        error_log    /var/logs/nginx/example.com.error.log <strong>debug</strong>;
        #other config
}</pre>
<p class="prettyprint"><code>debug</code> will log maximum messages. You can find <a href="http://wiki.nginx.org/CoreModule#error_log">other possible values here</a>.</p>
<p class="prettyprint alert"><strong>Note:</strong> Do NOT forget to revert debug-level for error_log on a *very* high traffic site. error_log may end up eating all your available disk space and cause your server to crash!</p>

<h3 class="prettyprint">Set Nginx to log errors from your IP only</h3>
<p class="prettyprint">When you will set log-level to <code>debug<em></em></code><em>, </em>your error log will log so many messages for every request that it will become meaningless if you are debugging a high-traffic site on a live-server.</p>
<p class="prettyprint">To force Nginx to log errors from only your IP, add the following line to <code>events{..}</code> block inside <code>/etc/nginx/nginx.conf</code></p>
<p class="prettyprint">Make sure you replace <code>1.2.3.4</code> with your own public IP. You can <a href="http://www.google.com/search?q=what+is+my+ip">find your public IP here</a>.</p>

<pre class="prettyprint">events {
        <strong>debug_connection 1.2.3.4;</strong>
}</pre>
<p class="prettyprint">You can find <a href="http://wiki.nginx.org/EventsModule#debug_connection">more details on this here</a>.</p>

<h3 class="prettyprint">Nginx Location Specific Error logs</h3>
In Nginx, we use <code>location{..}</code> block all over.

To debug parts of an application, you can specify <code>error_log</code> directive inside one or more <code>location{..}</code> block.
<pre class="prettyprint">server {
        #other config
        error_log    /var/logs/nginx/example.com.error.log;
        <strong>location /admin/ {</strong> 
		<strong>error_log /var/logs/nginx/admin-error.log debug;</strong> 
	<strong>}</strong>         
	#other config
}</pre>
<p class="prettyprint">Above will debug only <code>/admin/</code> part of you application and error logs will be recorded to a different file.</p>
<p class="prettyprint">You can combine location-specific <code>error_log</code> with <code>debug_connection</code> to gain more control over debug logs.</p>

<h3 class="prettyprint">Debug using Nginx's HttpEchoModule</h3>
<a href="http://wiki.nginx.org/HttpEchoModule">HttpEchoModule</a> is a separate Nginx module which can help you debug in altogether different way. This module doesn't come bundled with Nginx.

You need to recompile Nginx to use this. For Ubuntu users, there is a <a title="Nginx LaunchPad repo with HttpEchoModule" href="https://launchpad.net/~brianmercer/+archive/nginx">launchpad repo</a>.

I recently came across this and I am yet to use it for debugging on a project. When I will do it, I will post details about it.
<h3>Using Perl/Lua Language for Nginx config</h3>
If you are still having a tough time and you config Nginx regularly, should consider using other languages for Nginx configuration.

There is a Nginx module for <a href="http://wiki.nginx.org/HttpPerlModule">Perl language</a> and one for <a href="https://github.com/chaoslawful/lua-nginx-module">Lua language</a>.

As I am very bad at learning new languages, chances are less that I will ever write more on this. But it might be fun if you already know or can easily learn Perl/Lua.
<h4>More...</h4>
<ul>
	<li><a href="http://agentzh.blogspot.in/2011/03/how-nginx-location-if-works.html">How Nginx's location-if works!</a></li>
	<li><a title="Maintaining, Optimizing &amp; Debugging WordPress-Nginx Setup" href="https://easyengine.io/tutorials/maintaining-optimizing-debugging-wordpress-nginx-setup/">Maintaining, Optimizing &amp; Debugging WordPress-Nginx Setup</a></li>
</ul>