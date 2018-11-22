---
ID: 10648
post_title: W3 Total Cache
author: Rahul Bansal
post_excerpt: 'Best way to configure standard single-site WordPress-Nginx with w3 total cache. Nginx configuration supports CSS/JS minification, browser-caching & more.'
layout: page
permalink: >
  https://easyengine.io/wordpress-nginx/tutorials/single-site/w3-total-cache/
published: true
post_date: 2012-09-16 02:39:07
---
<div class="rtp-success"><strong><a href="https://easyengine.io/easyengine">easyengine</a> (ee) note:</strong> If you are using easyengine, you can accomplish everything in this article using following commands:
<pre><span style="font-size: 1em; line-height: 1.75;">ee site create example.com --w3tc</span></pre>
</div>
<h4>Assumption:</h4>
<a href="https://easyengine.io/series/wordpress-nginx-tutorials/"><img class="alignright size-full wp-image-10804" title="wordpress-nginx" alt="" src="https://easyengine.io/wp-content/uploads/2012/09/wordpress-nginx.jpeg" width="220" height="91" /></a>
<ol>
	<li>You already <a href="https://easyengine.io/tutorials/install-php-mysql-postfix-nginx-wordpress-ubuntu/">installed PHP, MySQL, Nginx &amp; Postfix</a></li>
	<li>You already <a href="https://easyengine.io/tutorials/installing-fresh-wordpress-nginx-minimal/">installed a fresh WordPress</a> or moved an existing WordPress to current server</li>
</ol>
Based on these assumptions, we will jump to directly a WordPress-Nginx configuration part.
<h4>Standard Wordpress-Nginx configuration with W3 Total Cache:</h4>
W3 Total Cache plugin provides many options. I will recommend using the given below:
<ul>
	<li><strong>Page Cache - Disk Enhanced</strong></li>
	<li>Minify - Disable this unless you are 100% sure your theme/plugin will support it nicely. Automatic minification rarely works for us.</li>
	<li>Database Cache - <a href="https://easyengine.io/tutorials/php/memcache/">Memcache</a></li>
	<li>Object Cache - <a href="https://easyengine.io/tutorials/php/memcache/">Memcache</a></li>
	<li><strong>Browser Cache - Disabled</strong></li>
	<li>CDN - You can use any CDN. Origin Pull is recommended. Check <a href="https://easyengine.io/tutorials/cdn/">CDN Setup Guides</a> for details.</li>
</ul>
If you have noticed, I have highlighted two options only. These are the only two options we are  going to handle in our configuration.
<pre class="prettyprint">server {
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
		try_files /wp-content/cache/page_enhanced/${host}${cache_uri}_index.html $uri $uri/ /index.php?$args ;
	}

        location ~ ^/wp-content/cache/minify/[^/]+/(.*)$ {
                try_files $uri /wp-content/plugins/w3-total-cache/pub/minify.php?file=$1;
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
<h4>Notes:</h4>
<div>
<ol>
	<li>To simplify configuration, I haven't added Mobile user agent checks. Its better to use responsive design than maintaining a separate site for mobile devices.</li>
	<li>You may not see special rules for <strong>minify</strong> feature. Above rules can handle W3 total minification without any change.</li>
</ol>
</div>
<h4>Don't Forget:</h4>
Always test your Nginx configuration and then reload it. All changes to Nginx config must be follow with these commands:
<pre>nginx -t &amp;&amp; service nginx reload</pre>
<h4>Must Read:</h4>
<ul>
	<li><a title="Checklist For Perfect WordPress-Nginx Setup" href="https://easyengine.io/tutorials/checklist-verify-wordpressnginx-setup/">Checklist For Perfect WordPress-Nginx Setup</a> - It will help you verify if your caching will work after PHP/MySQL crash.</li>
	<li>Catch the complete list of <a href="https://easyengine.io/series/wordpress-nginx-tutorials/">WordPress-Nginx tutorials</a> here.</li>
</ul>