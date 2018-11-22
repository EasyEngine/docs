---
ID: 111766
post_title: >
  redis_cache + conditional purging +
  (optional) Domain-Mapping
author: Harshad Yeola
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/wordpress-nginx/tutorials/multisite/subdirectories/redis_cache-conditional-purging-optional-domain-mapping/
published: true
post_date: 2015-07-15 18:26:22
---
<strong><a href="https://easyengine.io/easyengine">easyengine</a> (ee) note:</strong> If you are using easyengine, you can accomplish everything in this article using following command:
<pre class="no-highlight">ee site create example.com --wpsubdir --wpredis</pre>
This article is an extension of the previous article  <a href="https://easyengine.io/wordpress-nginx/tutorials/redis_cache-wi…tional-purging/">WordPress + Nginx + Redis cache</a>.

Please read that article to check if Nginx is compiled with necessary modules to start caching on redis, and help on installing Nginx Helper plugin.
<h3 id="wordpress-multisite-subdirectories--nginx--fastcgi">WordPress-Multisite (Subdirectories) + Nginx + redis cache</h3>
Make changes to <code>/etc/nginx/sites-available/example.com</code> file so that it looks like below:
<pre class="nginx">server {
    #@DM - uncomment following line for domain mapping or you will need to add every mapped-domain to server_name list 
    #listen 80 default_server;
    server_name example.com *.example.com ;
    #@DM - uncomment following line for domain mapping
    #server_name_in_redirect off;

    access_log   /var/log/nginx/example.com.access.log;
    error_log    /var/log/nginx/example.com.error.log;

    root /var/www/example.com/htdocs;
    index index.php;

    #redis cache start
    set $skip_cache 0;

    # POST requests and urls with a query string should always go to PHP
    if ($request_method = POST) {
        set $skip_cache 1;
    }   
    if ($query_string != "") {
        set $skip_cache 1;
    }   

    # Don't cache uris containing the following segments
    if ($request_uri ~* "(/wp-admin/|/xmlrpc.php|/wp-(app|cron|login|register|mail).php|wp-.*.php|/feed/|index.php|wp-comments-popup.php|wp-links-opml.php|wp-locations.php|sitemap(_index)?.xml|[a-z0-9_-]+-sitemap([0-9]+)?.xml)") {
        set $skip_cache 1;
    }   

    # Don't use the cache for logged in users or recent commenters
    if ($http_cookie ~* "comment_author|wordpress_[a-f0-9]+|wp-postpass|wordpress_no_cache|wordpress_logged_in") {
        set $skip_cache 1;
    }

        if (!-e $request_filename) {
                rewrite /wp-admin$ $scheme://$host$uri/ permanent;
                rewrite ^(/[^/]+)?(/wp-.*) $2 last;
                rewrite ^/[^/]+(/.*.php)$ $1 last;
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
        redis2_query expire $key 6h;
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
 
    location ~* ^.+.(ogg|ogv|svg|svgz|eot|otf|woff|mp4|ttf|rss|atom|jpg|jpeg|gif|png|ico|zip|tgz|gz|rar|bz2|doc|xls|exe|ppt|tar|mid|midi|wav|bmp|rtf)$ {
        access_log off; log_not_found off; expires max;
    }

    location = /robots.txt { access_log off; log_not_found off; }
    location ~ /. { deny  all; access_log off; log_not_found off; }
}</pre>
Save above configuration. Test and reload Nginx configuration with following commands
<pre class="bash">nginx -t &amp;&amp; service nginx reload</pre>
<h4>Domain Mapping</h4>
You need to uncomment few lines in above nginx-config to get domain mapping working. Apart from above config changes, you can <a title="WordPress-Multisite Subdomains + Domain Mapping Guide" href="https://easyengine.io/tutorials/wordpress-multisite-subdomains-domain-mapping-guide/">read this guide to setup/configure domain-mapping</a>.

<strong>Links: </strong><a href="https://wordpress.org/plugins/nginx-helper/">Nginx-Helper Plugin</a> | <a href="https://easyengine.io/easyengine/">EasyEngine</a>