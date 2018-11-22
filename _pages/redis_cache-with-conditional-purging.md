---
ID: 111682
post_title: redis_cache with conditional purging
author: Harshad Yeola
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/wordpress-nginx/tutorials/single-site/redis_cache-with-conditional-purging/
published: true
post_date: 2015-07-15 17:52:28
---
<strong><a href="https://easyengine.io/easyengine">easyengine</a> (ee) note</strong>: If you are using easyengine, you can accomplish everything in this article using command:
<pre class="bash">ee site create example.com --wpredis</pre>
Nginx does not have built-in support for <span class="code-key">redis_cache</span>.  We need four Nginx modules: <a href="https://github.com/openresty/srcache-nginx-module">srcache-nginx-module</a>, <a href="https://github.com/openresty/redis2-nginx-module">redis2-nginx-module</a>, <a href="http://wiki.nginx.org/HttpRedisModule">HttpRedisModule</a> and <a href="https://github.com/openresty/set-misc-nginx-module">set-misc-nginx-module</a> to get everything working on Nginx.

We will have to rely on <a href="http://wiki.nginx.org/HttpSRCacheModule">third party nginx module</a>. Without this module, you won't be able to cache with  Redis.
<h3>Prerequisites</h3>
You will need<a href="https://easyengine.io/tutorials/php/redis-php-sessions/"> redis server installed</a> to cache your site with redis.

If you have <a href="https://software.opensuse.org/download.html?project=home%3ArtCamp%3AEasyEngine&amp;package=nginx">installed Nginx from our repository </a>you will have these modules already available with Nginx . You can test with following command:
<pre class="bash">nginx -V 2&gt;&amp;1 | grep 'srcache-nginx-module\|redis2-nginx-module\|HttpRedisModule\|set-misc-nginx-module' -o</pre>
If you see  following output, then you have it.
<pre class="bash">srcache-nginx-module
HttpRedisModule
redis2-nginx-module
set-misc-nginx-module</pre>
Otherwise, if you are on Ubuntu or Debian with Nginx default installation, you can use following commands  to install nginx with necessary modules from <a href="https://software.opensuse.org/download.html?project=home%3ArtCamp%3AEasyEngine&amp;package=nginx">our nginx repo</a>.
<h4>Reinstall Nginx with modules that support Redis cache</h4>
<pre class="bash"># For Ubuntu 16.04
sudo sh -c "echo 'deb http://download.opensuse.org/repositories/home:/rtCamp:/EasyEngine/xUbuntu_16.04/ /' &gt;&gt; /etc/apt/sources.list.d/nginx.list"
sudo apt-get update
sudo apt-get install nginx-custom nginx-ee

# For Debian 8
echo 'deb http://download.opensuse.org/repositories/home:/rtCamp:/EasyEngine/Debian_8.0/ /' &gt;&gt; /etc/apt/sources.list.d/nginx.list 
apt-get update
apt-get install nginx-custom nginx-ee</pre>
For other versions of Ubuntu and Debian, <a href="https://software.opensuse.org/download.html?project=home%3ArtCamp%3AEasyEngine&amp;package=nginx">install packages as per instructed here</a>.
<h3>Install Nginx Helper Plugin</h3>
Above steps ensures that you have necessary modules with Nginx, so that Nginx can store and access cache from redis. Nginx cannot automatically find out which page to purge and when to purge?

So install <a href="https://wordpress.org/plugins/nginx-helper/">Nginx helper plugin</a> from WordPress plugin repository and activate it. Apart from other features, it provides cache purging options. Just activate it.

Nginx Helper  Settings

<strong>1. Enable Cache Purge </strong>

<a href="https://easyengine.io/wp-content/uploads/2015/07/1.png"><img class="alignnone size-medium wp-image-111737" src="https://easyengine.io/wp-content/uploads/2015/07/1-400x50.png" alt="1" width="400" height="50" /></a>

<strong>2. Cacheing Method (Redis Cache)</strong>

<strong>   </strong>Provide redis server <strong>hostname</strong> , <strong>port</strong> and <strong> prefix</strong> you have used for cacheing.

<a href="https://easyengine.io/wp-content/uploads/2015/07/2.png"><img class="alignnone size-medium wp-image-111736" src="https://easyengine.io/wp-content/uploads/2015/07/2-400x109.png" alt="2" width="400" height="109" /></a>

<strong>3</strong>. <strong>Select Cache Purging conditions</strong>

<a href="https://easyengine.io/wp-content/uploads/2015/07/3.png"><img class="alignnone size-medium wp-image-111738" src="https://easyengine.io/wp-content/uploads/2015/07/3-400x208.png" alt="3" width="400" height="208" /></a>

Save your settings.
<h3>Nginx Config</h3>
Now let's make changes to /etc/nginx/sites-available/example.com file so that it looks like one below
<pre class="nginx">server {
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

    location /redis-fetch {
        internal  ;
        set  $redis_key $args;
        redis_pass  127.0.0.1:6379;
    }

    location /redis-store {
        internal  ;
        set_unescape_uri $key $arg_key ;
        redis2_query  set $key $echo_request_body;
        redis2_query expire $key 14400;
        redis2_pass  127.0.0.1:6379;
    } 

    location ~ \.php$ {
        
        set $key "nginx-cache:$scheme$request_method$host$request_uri";
        try_files $uri =404;

        srcache_fetch_skip $skip_cache;
        srcache_store_skip $skip_cache;

        srcache_response_cache_control off;

        set_escape_uri $escaped_key $key;

        srcache_fetch GET /redis-fetch $key;
        srcache_store PUT /redis-store key=$escaped_key;

        more_set_headers 'X-Cache $srcache_fetch_status';
        more_set_headers 'X-Cache-2 $srcache_store_status';

        include fastcgi_params;
        fastcgi_pass php;
    } 

    location ~* ^.+\.(ogg|ogv|svg|svgz|eot|otf|woff|mp4|ttf|rss|atom|jpg|jpeg|gif|png|ico|zip|tgz|gz|rar|bz2|doc|xls|exe|ppt|tar|mid|midi|wav|bmp|rtf)$ {
        access_log off; log_not_found off; expires max;
    }

    location = /robots.txt { access_log off; log_not_found off; }
    location ~ /\. { deny  all; access_log off; log_not_found off; }
}</pre>
<h3>Don't Forget</h3>
Always test your Nginx configuration and reload it. All changes to Nginx config must be followed by these commands
<pre class="bash">nginx -t &amp;&amp; service nginx reload</pre>
<strong>Links: </strong><a href="https://wordpress.org/plugins/nginx-helper/">Nginx-Helper Plugin</a> | <a href="https://easyengine.io/easyengine/">EasyEngine</a>