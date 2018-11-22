---
ID: 14293
post_title: WordPress In Subdirectories Itself
author: Rahul Bansal
post_excerpt: >
  If you want to put your
  WordPress-multisite with sub-directories
  setup in a subdirectory/folder on your
  server, this nginx config will help
layout: page
permalink: >
  https://easyengine.io/wordpress-nginx/tutorials/multisite/subdirectories/in-a-subdirectory/
published: true
post_date: 2012-09-18 23:24:20
---
<p class="rtp-info"><strong>Update:</strong> This article is updated for WordPress 3.5 multisite's file-handling.</p>
<a href="https://easyengine.io/wp-content/uploads/2012/09/wordpress-nginx.jpeg"><img class="alignright size-full wp-image-10804" title="wordpress-nginx" alt="" src="https://easyengine.io/wp-content/uploads/2012/09/wordpress-nginx.jpeg" width="220" height="91" /></a>

It is not possible to setup WordPress-Multisite with subdomains in a subdirectory. As soon as WordPress detects you are running another WordPress from <code>example.com/folder</code> rather than <code>example.com/</code> - it will not ask you to choose between sub-directories and sub-domains.

But it is possible to setup a WordPress-Multisite with Subdirectories in a subdirectory itself. This is what I will be covering today. Most of the stuff is similar to <a href="https://easyengine.io/tutorials/wordpress-nginx-multisite-subdirectories-nginx-map/">my previous post</a>.
<h4>Creating A WordPress Multisite Network:</h4>
If you haven't done this yet, <a title="Creating A WordPress Multisite Network with Nginx" href="https://easyengine.io/tutorials/creating-wordpress-multisite-network-nginx/">please check our guide here</a>.
<h3>Nginx Configuration for WordPress-Multisite with Subdirectories in a subdirectory itself!</h3>
Below is the recommended Nginx configuration for WordPress Multisite using subdirectories setup.

Generally we replace <code>example.com</code> with your domain in our configurations. In this case, we will also replace <code>wordpress</code> with your folder/subdirectory name.
<pre class="nginx">server {
        server_name example.com ;

        access_log   /var/log/nginx/example.com.access.log;
        error_log    /var/log/nginx/example.com.error.log debug;

        root /var/www/example.com/htdocs ;
        index index.php;

        if (!-e $request_filename) {
                rewrite /wp-admin$ $scheme://$host$uri/ permanent;         
                rewrite ^/wordpress(/[^/]+)?(/wp-.*) /wordpress$2 last;      
                rewrite ^/wordpress(/[^/]+)?(/.*\.php)$ /wordpress$2 last;
        }

        location / {
                try_files $uri $uri/ /wordpress/index.php?$args ;
        }

        location ~ \.php$ {
                try_files $uri /wordpress/index.php;
                include fastcgi_params;
                fastcgi_pass 127.0.0.1:9000;
        }

        location ~* ^.+\.(ogg|ogv|svg|svgz|eot|otf|woff|mp4|ttf|rss|atom|jpg|jpeg|gif|png|ico|zip|tgz|gz|rar|bz2|doc|xls|exe|ppt|tar|mid|midi|wav|bmp|rtf)$ {
                access_log off; log_not_found off; expires max;
        }

        location = /robots.txt { access_log off; log_not_found off; }
        location ~ /\. { deny  all; access_log off; log_not_found off; }
}</pre>
<p class="rtp-alert"><strong>For Multisite Networks Created with WordPress 3.4 or older:</strong> Please use <a href="https://easyengine.io/tutorials/nginx-map-wordpress-multisite-static-files-handling/">this article</a> to improve static-file handling. It alone can improve overall performance by 10x.</p>
In the next article, we will <a title="Nginx + WordPress-Multisite + Subdirectories + WP Super Cache" href="https://easyengine.io/tutorials/wordpress-multisite-nginx-config-subdirectories-wp-super-cache/">add support for WP Super Cache for the above Nginx config</a>. Read the <a href="https://easyengine.io/series/wordpress-nginx-tutorials/">complete series</a> here.

<strong>Must Read: </strong><a title="Checklist For Perfect WordPress-Nginx Setup" href="https://easyengine.io/tutorials/checklist-verify-wordpressnginx-setup/">Checklist For Perfect WordPress-Nginx Setup</a>