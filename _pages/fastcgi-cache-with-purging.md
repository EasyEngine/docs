---
ID: 12732
post_title: fastcgi_cache with conditional purging
author: Rahul Bansal
post_excerpt: "Using Nginx's fastcgi_cache for wordpress full-page caching is generally faster and with fascgi_cache_purge module and nginx helper plugin you can keep cache updated"
layout: page
permalink: >
  https://easyengine.io/wordpress-nginx/tutorials/single-site/fastcgi-cache-with-purging/
published: true
post_date: 2012-09-30 11:10:47
---
<div class="rtp-success">

<strong><a href="https://easyengine.io/easyengine">easyengine</a> (ee) note:</strong> If you are using easyengine, you can accomplish everything in this article using command:
<pre>ee site create example.com --wpfc</pre>
</div>
In first part of this series, we have seen many combinations of <a href="https://easyengine.io/wordpress-nginx/tutorials/">different WordPress setup with different caching plugins</a>. Today, we will use an altogether different way of caching!

Rather than asking a complex PHP-MySQL application like WordPress to do some extra work for caching, we will ask light-weight Nginx to cache WordPress content on its end.

Nginx has built-in support for <code>fastcgi_cache</code> but it doesn't have mechanism to purge cached content built-in. So we need to rely on <a href="https://github.com/FRiCKLE/ngx_cache_purge/">third-party nginx module</a>.  Without this 3rd party module, cache won't be updated if you create/edit any post/page in WordPress.
<h2>Prerequisites</h2>
<h3>Check if your nginx has fastcgi_cache_purge module</h3>
If you have <a href="https://easyengine.io/tutorials/linux/ubuntu-php-mysql-nginx-postfix/">installed Nginx by following our guide</a>, then support for <code>fastcgi_cache_purge</code> should be already there. You can test it by running following command:
<pre>nginx -V 2&gt;&amp;1 | grep nginx-cache-purge -o</pre>
If you see <code>nginx-cache-purge</code> in output then you already have it.

Otherwise, if you are on Ubuntu with default Nginx installation, you can run following commands to install nginx with <code>fastcgi_cache_purge</code> module.
<h4>Reinstall nginx with fastcgi_cache purge module support</h4>
<pre>sudo add-apt-repository ppa:rtcamp/nginx
sudo apt-get update
sudo apt-get remove nginx*
sudo apt-get install nginx-custom</pre>
<h3>Install Nginx Helper Plugin</h3>
Above step ensures that Nginx can purge a page from its <code>fastcgi_cache</code> selectively. But Nginx cannot automatically find out which page to purge and when to purge?

So install <a href="http://wordpress.org/extend/plugins/nginx-helper/">Nginx helper plugin</a> from WordPress plugin repository and activate it. Apart from other features, it provides cache purging options. Just activate it, go to its settings and turn on <strong>"Enable Cache Purge"</strong> option.

<a href="http://wordpress.org/extend/plugins/nginx-helper/"><img class="size-full wp-image-14734 alignnone" title="Nginx Helper - Purge Options For WordPress" src="https://easyengine.io/wp-content/uploads/2012/09/Nginx-Helper-Purge-Options-For-WordPress.png" alt="" width="627" height="567" /></a>

If you want more control over your cache purging rules, you can play with different purging options it provides.
<h2>Using ramdisk (tmpfs) for cached content</h2>
<strong>This step is optional.</strong> You need give Nginx a folder store <code>fastcgi_cache</code> content. I will recommend using <code>/var/run</code> on Ubuntu as its mounted as tmpfs (in RAM). If you do not have ample RAM you can pick any other location.

If you are going with RAM, make sure you check size of <code>/var/run</code> folder. Its generally 20% of your total RAM size.

To verify it, run command <code>df -h /var/run</code>. You will see output like below:
<pre>Filesystem      Size  Used Avail Use% Mounted on
tmpfs           6.3G  364K  <strong>6.3G</strong>   1% /run</pre>
It looks like we have more than 6GB at our disposal! Our server has 32GB RAM by the way, so 6.3GB is close to 20%
<h2>Nginx Config</h2>
No matter how you are using WordPress, i.e. single or Multisite (with subdirectory/subdomain/domain-mapping) <code>fastcgi_cache</code> related configuration will remain similar.

Now make changes to <code>/etc/nginx/sites-available/example.com</code>file so it looks like one below:
<pre class="prettyprint">#move next 4 lines to /etc/nginx/nginx.conf if you want to use fastcgi_cache across many sites 
fastcgi_cache_path /var/run/nginx-cache levels=1:2 keys_zone=WORDPRESS:100m inactive=60m;
fastcgi_cache_key "$scheme$request_method$host$request_uri";
fastcgi_cache_use_stale error timeout invalid_header http_500;
fastcgi_ignore_headers Cache-Control Expires Set-Cookie;
server {
	server_name example.com www.example.com;

	access_log   /var/log/nginx/example.com.access.log;
	error_log    /var/log/nginx/example.com.error.log;

	root /var/www/example.com/htdocs;
	index index.php;

	set $skip_cache 0;

	# POST requests and urls with a query string should always go to PHP
	if ($request_method = POST) {
		set $skip_cache 1;
	}   
	if ($query_string != "") {
		set $skip_cache 1;
	}   

	# Don't cache uris containing the following segments
	if ($request_uri ~* "/wp-admin/|/xmlrpc.php|wp-.*.php|/feed/|index.php|sitemap(_index)?.xml") {
		set $skip_cache 1;
	}   

	# Don't use the cache for logged in users or recent commenters
	if ($http_cookie ~* "comment_author|wordpress_[a-f0-9]+|wp-postpass|wordpress_no_cache|wordpress_logged_in") {
		set $skip_cache 1;
	}

	location / {
		try_files $uri $uri/ /index.php?$args;
	}    

	location ~ \.php$ {
		try_files $uri =404; 
		include fastcgi_params;
		fastcgi_pass 127.0.0.1:9000;

		fastcgi_cache_bypass $skip_cache;
	        fastcgi_no_cache $skip_cache;

		fastcgi_cache WORDPRESS;
		fastcgi_cache_valid  60m;
	}

	location ~ /purge(/.*) {
	    fastcgi_cache_purge WORDPRESS "$scheme$request_method$host$1";
	}	

	location ~* ^.+\.(ogg|ogv|svg|svgz|eot|otf|woff|mp4|ttf|rss|atom|jpg|jpeg|gif|png|ico|zip|tgz|gz|rar|bz2|doc|xls|exe|ppt|tar|mid|midi|wav|bmp|rtf)$ {
		access_log off;	log_not_found off; expires max;
	}

	location = /robots.txt { access_log off; log_not_found off; }
	location ~ /\. { deny  all; access_log off; log_not_found off; }
}</pre>
The line <code>fastcgi_cache_use_stale</code> is what makes caching on Nginx-side unique. This line tells Nginx to use old (stale) cached version of page if PHP crashes. This is something not possible with WordPress caching plugins.
<h3>Don't Forget</h3>
Always test your Nginx configuration and then reload it. All changes to Nginx config must be followed with these commands:
<pre>nginx -t &amp;&amp; service nginx reload</pre>
<h2>Must Read</h2>
<ul>
	<li><a title="Checklist For Perfect WordPress-Nginx Setup" href="https://easyengine.io/tutorials/checklist-verify-wordpressnginx-setup/">Checklist For Perfect WordPress-Nginx Setup</a> - it will help you verify if your caching will work after PHP/MySQL crash.</li>
	<li><a href="https://easyengine.io/wordpress-nginx/tutorials/nginx/upstream-cache-status-in-response-header/">Perfect way to check if fastcgi-cache is working</a> - this can also help you improve fastcgi-cache efficiency.</li>
</ul>