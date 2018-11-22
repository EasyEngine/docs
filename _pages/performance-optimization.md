---
ID: 72239
post_title: Performance Optimization
author: Rahul Bansal
post_excerpt: >
  A comprehensive checklist to analyze
  performance and optimize a WordPress
  site for best results at web-server, PHP
  and MySQL level.
layout: page
permalink: >
  https://easyengine.io/tutorials/wordpress/performance-optimization/
published: true
post_date: 2014-10-05 13:51:57
---
TL;DR; Use <a href="https://easyengine.io/easyengine">EasyEngine</a>. It handles most of this out of the box and provide easy commands for remaining stuff.

For a WordPress site, there are many areas where performance can be improved.

A typical WordPress site setup consists of:
<ol>
	<li>Web Server e.g. <strong>Nginx</strong>, Apache, IIS</li>
	<li>PHP interpreter e.g. CGI, FastCGI, <strong>PHP-FPM, HHVM</strong></li>
	<li>MySQL e.g. oracle-mysql, <strong>percona-mysql</strong>, mariadb</li>
</ol>
Some sites uses an accelerator like Varnish in front of web-server. Varnish could be fine for Apache, but <a href="https://easyengine.io/blog/why-we-never-use-varnish-with-nginx/">don't recommend using Varnish with Nginx</a>.

In terms of audience, we need to optimize site for 2 types of users:
<ol>
	<li>Non-logged in users</li>
	<li>Logged in users (including admin users)</li>
</ol>
Non-logged in users can benefit a lot from web-server tweaking alone.

For logged in users, you need to focus on PHP and MySQL.
<h2>Web Server</h2>
<h3>Checklist</h3>
<ol>
	<li>Use Nginx as your web-server. If you are new to Nginx, try <a href="https://easyengine.io/easyengine">EasyEngine</a>. EasyEngine makes managing WordPress sites easy with Nginx web-server.</li>
	<li><a href="https://easyengine.io/tutorials/cdn/">Use CDN for static assets</a> e.g. images, css and JS files</li>
	<li>Combine CSS and JS files and if possible minify them. Try doing this via pagespeed. If that is not possible, use W3 Total Cache for this. Be very careful with this step as it can break your themes and plugins.</li>
	<li>Optimize image sizes with lossless image compression. You can do this either using pagespeed or a WordPress plugin like <a href="https://wordpress.org/plugins/wp-smushit/">smush.it</a>.</li>
	<li><a href="https://easyengine.io/tutorials/nginx/block-wp-login-php-bruteforce-attack/">Protect wp-login.php from bruteforce attack at nginx (web-server) level</a>. A strong password can save you from getting hacked, but bruteforce login attacks create unnecessary PHP-MySQL load.</li>
	<li>If you are using SSL, use it for complete site. Avoid using SSL for parts of your site. <a href="https://easyengine.io/tutorials/nginx/ssl-pci-compliance-performance/">SSL can be tweaked as well</a>.</li>
</ol>
<h3>Tools</h3>
You can use <a href="http://gtmetrix.com/">gtmetrix.com</a> and/or <a href="http://www.webpagetest.org/">webpagetest.org</a>.

Try to score as many <strong>"A"</strong> as possible.

<strong>More: </strong><a href="https://easyengine.io/tutorials/nginx">Check Nginx tutorials section</a>
<h2>PHP</h2>
<h3>Checklist</h3>
<ol>
	<li>We recommend using nginx with <a href="https://easyengine.io/tutorials/php/hhvm-with-fpm-fallback/">HHVM with PHP-FPM fallback</a>.</li>
	<li>If HHVM doesn't work with your plugins and themes, then Nginx with PHP-FPM is best.</li>
	<li>When it comes to PHP, always use latest PHP version, even though WordPress supports outdated PHP versions (which exposes WordPress sites to security risks)</li>
	<li>Always use <a href="https://easyengine.io/tutorials/php/zend-opcache/">Zend Opcache</a> for opcode caching.</li>
	<li>Move session <a href="https://easyengine.io/tutorials/php/session-tmpfs/">storage to tmpfs</a> or <a href="https://easyengine.io/tutorials/php/memcache/">memcache</a></li>
	<li>Use memcache for object-cache. You can do it using W3 Total Cache plugin.</li>
	<li><a href="https://easyengine.io/tutorials/php/xdebug-webgrind/">Analyze PHP code performance using xdebug and webgrind</a>.</li>
</ol>
If you find checklist long, try last one only.

Many WordPress plugins are coded by amateurs and if you are unlucky, you will be using a poor coded plugin. Xdebug profiling can help you find it.

If you are using <a href="https://easyengine.io/easyengine">EasyEngine</a>, you will get most of above out of the box.

For xdebug profiling, you can run command:
<pre>ee debug example.com --php</pre>
<strong>More:</strong> <a href="https://easyengine.io/tutorials/php/">Check PHP tutorials section</a>
<h2>MySQL</h2>
<h3>Checklist</h3>
<ol>
	<li>Use latest MySQL version. Though WordPress will work with older version, new mysql versions has better performance.</li>
	<li>Periodically tweak mysql configuration, using scripts like <a href="https://easyengine.io/tutorials/mysql/tuning-primer/">tuning-primer</a> and <a href="https://easyengine.io/tutorials/mysql/mysqltuner/">mysqltuner</a></li>
	<li>Enable <a href="https://easyengine.io/tutorials/mysql/slow-query-log/">slow query log</a> and analyze it with <a href="https://easyengine.io/tutorials/mysql/slow-query-log-anemometer/">anemometer</a>. This is highly recommended if you are seeing site slowed down for non-logged in users.</li>
	<li><a href="https://easyengine.io/tutorials/mysql/query-profiling/">Profile mysql query</a> to check internal execution.</li>
	<li><a href="https://easyengine.io/tutorials/mysql/myisam-to-innodb/">Convert MyISAM tables to InnoDB tables</a>. If you have plugins which relies on custom post type, this is must.</li>
	<li>Use <a href="https://easyengine.io/tutorials/mysql/tmpfs-temporary-folder-creation/">tmpfs for mysql temporary tables</a>.</li>
	<li>Add mysql indexes if possible to speed up queries. Many plugin developers don't take efforts to add proper mysql indexes for MySQL tables there plugin creates.</li>
</ol>
<strong>More: </strong><a href="https://easyengine.io/tutorials/mysql/">Check MySQL tutorials section</a>
<h2>Web Hosting</h2>
Never use shared hosting. If your site is small, you won't be reading this article. As you are reading this, it means your site is big and need to tweaked. Most of stuff here won't work on shared hosting.

WordPress specific hostings e.g. WP-Engine makes few things easier but they won't give you full control.

We recommend VPS with SSD hosting. <a href="https://rt.cx/digitalocean">DigitalOcean</a> and <a href="http://rt.cx/linode">Linode</a> are our favorites!
<h2>Notes</h2>
Of course, after all of above, your site may still be slow. Chances are high that you missed something from above list.

Unfortunately it's not possible to solve performance problem for any site over our community support forum or skype/email exchanges. rtCamp can only help if it gets first-hand access to the server! You may <a href="https://easyengine.io/contact/">contact us</a> if for professional support in that case.

<strong>Links:</strong> <a href="https://easyengine.io/easyengine">EasyEngine</a>