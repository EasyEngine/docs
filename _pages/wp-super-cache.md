---
ID: 10651
post_title: WP Super cache
author: Rahul Bansal
post_excerpt: >
  Wordpress-Nginx configuration with WP
  Super cache Support. Includes tests to
  verify your cache will work even after
  PHP/MySQL go down. Also support for gzip
  compression check.
layout: page
permalink: >
  https://easyengine.io/wordpress-nginx/tutorials/single-site/wp-super-cache/
published: true
post_date: 2012-09-15 15:38:35
---
<div class="rtp-success">

<strong><a href="https://easyengine.io/easyengine">easyengine</a> (ee) note:</strong> If you are using easyengine, you can accomplish everything in this article using following commands:
<pre>ee site create example.com --wpsc</pre>
</div>
<h4>Assumption:</h4>
<a href="https://easyengine.io/series/wordpress-nginx-tutorials/"><img class="alignright size-full wp-image-10804" title="wordpress-nginx" src="https://easyengine.io/wp-content/uploads/2012/09/wordpress-nginx.jpeg" alt="" width="220" height="91" /></a>
<ol>
	<li>You already <a href="https://easyengine.io/tutorials/linux/ubuntu-php-mysql-nginx-postfix/">installed PHP, MySQL, Nginx &amp; Postfix</a></li>
	<li>You already <a href="https://easyengine.io/tutorials/installing-fresh-wordpress-nginx-minimal/">installed a fresh WordPress</a> or moved an existing WordPress to current server</li>
</ol>
Based on these assumptions, we will jump to directly a WordPress-Nginx configuration part.
<h4>Standard Wordpress-Nginx configuration with WP Super cache support:</h4>
As you are getting into Nginx, I hope you don't need my help with configuring WP Super Cache plugin.

Still, make sure you are using <em><strong>"Use mod_rewrite to serve cache files. (Recommended)" </strong></em>option under <em><strong>"Advanced"</strong></em> tab.

Following configuration supports:
<ol>
	<li>Static Page Caching using Disk</li>
	<li>Direct browser cache for static content like images, js, css, etc</li>
</ol>
<pre>server {
	server_name example.com www.example.com;

	access_log   /var/log/nginx/example.com.access.log;
	error_log    /var/log/nginx/example.com.error.log debug;

	root /var/www/example.com/htdocs;
	index index.php;

	set $cache_uri $request_uri;

	# POST requests and urls with a query string should always go to PHP
	if ($request_method = POST) {
		set $cache_uri 'null cache';
	}   
	if ($query_string != "") {
		set $cache_uri 'null cache';
	}   

	# Don't cache uris containing the following segments
	if ($request_uri ~* "(/wp-admin/|/xmlrpc.php|/wp-(app|cron|login|register|mail).php|wp-.*.php|/feed/|index.php|wp-comments-popup.php|wp-links-opml.php|wp-locations.php|sitemap(_index)?.xml|[a-z0-9_-]+-sitemap([0-9]+)?.xml)") {
		set $cache_uri 'null cache';
	}   

	# Don't use the cache for logged in users or recent commenters
	if ($http_cookie ~* "comment_author|wordpress_[a-f0-9]+|wp-postpass|wordpress_logged_in") {
		set $cache_uri 'null cache';
	}

	# Use cached or actual file if they exists, otherwise pass request to WordPress
	location / {
		try_files /wp-content/cache/supercache/$http_host/$cache_uri/index.html $uri $uri/ /index.php ;
	}    

	location = /favicon.ico { log_not_found off; access_log off; }
	location = /robots.txt  { log_not_found off; access_log off; }

	location ~ \.php$ {
		try_files $uri =404; 
		include fastcgi_params;
                fastcgi_pass 127.0.0.1:9000;
	}

	# Cache static files for as long as possible
	location ~* .(ogg|ogv|svg|svgz|eot|otf|woff|mp4|ttf|css|rss|atom|js|jpg|jpeg|gif|png|ico|zip|tgz|gz|rar|bz2|doc|xls|exe|ppt|tar|mid|midi|wav|bmp|rtf)$ {
		expires max; log_not_found off; access_log off;
	}
}</pre>
<h4>Note:</h4>
<div>To simplify configuration, I haven't added Mobile user agent checks. We are in the iPhone era where finally phones are getting smart. So there is no need to create separate mobile site, when you can cater to today's iPhone/Android devices using responsive designs.</div>
<h4>Don't Forget:</h4>
Always test your Nginx configuration and then reload it. All changes to Nginx config must be followed with these commands:
<pre>nginx -t &amp;&amp; service nginx reload</pre>
<h4>Important Note:</h4>
WP Super Cache caching will conflict with plugins that uses query vars. WooCommerce is an example known plugin known to work with above configuration. Reason is following line:<strong> </strong>
<pre>try_files /wp-content/cache/supercache/$http_host/$cache_uri/index.html $uri $uri/ /index.php ;</pre>
It doesn't passes <strong>$args</strong> to <strong>/index.php. </strong>If you set last <strong>try_files</strong> argument to <code>/index.php?$args</code> as with other WordPress-Nginx configuration, WP Super Cache, itself will break!
<h4>Must Read:</h4>
<ul>
	<li><a title="Checklist For Perfect WordPress-Nginx Setup" href="https://easyengine.io/tutorials/checklist-verify-wordpressnginx-setup/">Checklist For Perfect WordPress-Nginx Setup</a> - It will help you verify if your caching will work after PHP/MySQL crash.</li>
	<li>Catch the complete list of <a href="https://easyengine.io/series/wordpress-nginx-tutorials/">WordPress-Nginx tutorials</a> here.</li>
</ul>