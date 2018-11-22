---
ID: 63705
post_title: Admin Tools on Port 22222
author: Rahul Bansal
post_excerpt: 'EasyEngine admin tools & scripts on port 22222. Includes PhpMyAdmin, WebGrind, Anemometer, Cache viewer and cleaners for memcache/opcache/nginx fastcgi-cache'
layout: page
permalink: >
  https://easyengine.io/docs/admin-tools-22222/
published: true
post_date: 2014-04-11 17:42:03
---
Though EasyEngine is command line tool, there are plenty of web-based tools and scripts which can make server administration easy.

Till version 1.2, these tools were accessible with <code>/ee/</code> URL prefix. As number of tools grew, we moved them to dedicated port <strong>22222 </strong>for better management of growing list of admin tools and also for security
<h2>Admin Tools &amp; Scripts</h2>
<ol>
	<li><code>/db</code> folder: <a href="http://www.phpmyadmin.net/">PhpMyAdmin</a>, <a href="http://www.adminer.org">Adminer</a> and <a href="https://github.com/box/Anemometer">Anemometer</a></li>
	<li><code>/php</code> folder: <code>info.php</code> file with phpinfo for production php fool and <a href="https://github.com/jokkedk/webgrind">webgrind</a> for <a href="http://xdebug.org">xdebug</a> profiling analysis</li>
	<li><code>/fpm</code> folder: status page for each fpm pool</li>
	<li><code>/cache</code> folder: memcache, opcache and nginx-fastcgi cache viewer/cleaner</li>
</ol>
All these tools are hosted under as a PHP site at location <code>/var/www/22222</code>. We choose to name site itself as 22222 so it will easily standout from other sites.

You can add/remove other tools &amp; scripts in <code>/var/www/22222/htdocs</code>. You can disable or even delete admin tools using <code>ee site</code> commands. But rest assured, they are secure as you can read below!
<h2>Port 22222 &amp; Security</h2>
You can open port 22222 (5-times two) on any IP or site hosted on your server. It uses HTTPs with a self-signed certificate. Your browser may complain about SSL certificate but you can ignore it. Your connection to server will be still encrypted.

If you prompted for username &amp; password, default will be <code>easyengine</code>. You can change username and password by  <code></code><code>ee secure --auth</code>  command.

Refer: <a href="https://rtcamp.com/easyengine/docs/commands/ee-secure/#changing-http-authentication-credentials">How to change HTTP Authentication</a>