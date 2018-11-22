---
ID: 16830
post_title: ActiveCollab with Nginx + APC Cache
author: Rahul Bansal
post_excerpt: >
  Speeding up ActiveCollab using Nginx APC
  Cache. Support for ActiveCollab Clean
  URLs/Permalinks included.
layout: page
permalink: >
  https://easyengine.io/tutorials/activecollab-with-nginx-apc-cache/
published: true
post_date: 2012-10-25 18:07:40
---
<img class="alignright size-full wp-image-17401" title="activeCollab-nginx" alt="" src="https://easyengine.io/wp-content/uploads/2012/10/ac-nginx1.png" width="329" height="246" />From more than 3 years, we are using <a href="http://www.activecollab.com/">ActiveCollab</a> to manage our 600+ clients and 900+ projects (as of today).

Over the time, as our data grew we needed to tweak ActiveCollab. We managed to speed-it up using Nginx (with proper browser caching) and PHP's APC cache. We are using Nginx from almost 2-years now so you can count on following steps... ;-)
<h2>Changes to ActiveCollab Config for Clean-URLs</h2>
These changes are necessary if you like to remove /public/index.php from URLs. Before making any changes, please take necessary backups.

Goto activecollab setup's <code>config/config.php</code>

#1. Change
<pre class="no-highlight">define('ROOT_URL', 'http://ac.example.com/public');</pre>
To
<pre class="no-highlight">define('ROOT_URL', 'http://ac.example.com');</pre>
#2. Then add following 4 lines:
<pre class="no-highlight">define('URL_BASE', ROOT_URL . '/');
define('ASSETS_URL', ROOT_URL . '/public/assets');
define('PUBLIC_AS_DOCUMENT_ROOT', true);
define('PATH_INFO_THROUGH_QUERY_STRING', false);</pre>
<h2>Nginx Config</h2>
Below is a sample nginx-config we use. Please replace <code>ac.example.com</code> with your domain on which you are hosting your activeCollab. You will also need to change few more parameters to match your system paths/config. Following uses our <a href="https://easyengine.io/tutorials/wordpress-nginx-setup-conventions/">nginx-setup conventions documented here</a>.
<pre class="nginx">server {
        server_name     ac.example.com;

    	access_log      /var/log/nginx/ac.example.com.access.log;
    	error_log       /var/log/nginx/ac.example.com.error.log;

        root    /var/www/ac.example.com/htdocs/public;
    	index  index.php ;

        location / {
               try_files $uri $uri/ /index.php?path_info=$uri&amp;$args;
               access_log off; expires max;
        }

        location ~ \.php$ {
                try_files $uri =404;
                include /etc/nginx/fastcgi_params;
                fastcgi_pass 127.0.0.1:9000;
        }

        location = /favicon.ico {
        	 try_files /brand/favicon.ico =404;
        	 access_log off; log_not_found off; expires max;
        }

        location ~ /\. { deny  all; access_log off; log_not_found off; }

        #fix old ticket URLs. Uncomment if you are coming from AC2 to AC3
        #rewrite ^/projects/([^/]+)/tickets/([^/]+)/?$ http://ac.rtcamp.com/projects/$1/tasks/$2 permanent;
        #rewrite ^/projects/([^/]+)/tickets/? http://ac.rtcamp.com/projects/$1/tasks/ permanent;
}</pre>
From activeCollab 2 to activeCollab 3,  tickets were renamed to tasks. Last 2 lines can take care of old permalinks in old mails/documents.

That's all you need to get activeCollab running on Nginx. :-)
<h2>APC Cache</h2>
If you have PHP installed with APC Cache support, then you just need to add one line to activeCollab's <code>config/config.php</code>
<pre class="no-highlight">define('CACHE_BACKEND', 'APCCacheBackend');</pre>
Above will enable APC cache support but to get proper speed-up you must change APC's default storage limit from 32MB to minimum 100MB. You can do that by following <a href="https://easyengine.io/tutorials/php/apc-cache-with-web-interface/">this article</a>.

APC cache alone can improve performance significantly provided its large enough to accomodate as many entries activeCollab wants to store there.

<strong>Recommended: </strong><a href="https://easyengine.io/wordpress-nginx/tutorial">WordPress-Nginx Tutorial Series</a>

<em>(Last Updated on Oct 28, 2012 by nice <a href="http://www.activecollab.com/forums/post/44692/#post44692">suggestions</a> from <a href="http://www.activecollab.com/user/4209/profile/">Blaise Laflamme</a>)</em>