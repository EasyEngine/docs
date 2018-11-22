---
ID: 75352
post_title: Installing ghost with nginx proxy-cache
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/nodejs/ghost-nginx/
published: true
post_date: 2014-10-31 00:36:43
---
<strong>Prerequisite:</strong> <a href="https://easyengine.io/tutorials/nodejs/node-js-npm-install-ubuntu/">You need to have node.js &amp; npm installed</a>.
<h2>Installing Ghost</h2>
Run following commands
<pre class="bash">mkdir /var/www/example.com/htdocs/
cd /var/www/example.com/htdocs/
git clone https://github.com/TryGhost/Ghost .
npm install -g grunt-cli
npm install
grunt init
grunt prod

npm install -g forever 
forever start index.js</pre>
Above will start ghost on <a href="http://localhost:2368/">http://localhost:2368/</a>.

Goto <a href="http://localhost:2368/ghost/setup/">http://localhost:2368/ghost/setup/</a> to create admin user and complete one-time setup.
<h2>Create Nginx Proxy</h2>
Create a config file <a href="/etc/nginx/sites-available/example.com">/etc/nginx/sites-available/example.com</a> and paste following:

<em> (following config is directly copied from <a href="https://gist.github.com/pnommensen/707b5519766ba45366dd">https://gist.github.com/pnommensen/707b5519766ba45366dd</a>)</em>
<pre class="nginx">upstream ghost_upstream {
    server 127.0.0.1:2368;
    keepalive 64;
}

proxy_cache_path /var/run/cache levels=1:2 keys_zone=STATIC:75m inactive=24h max_size=512m;

server {
   server_name domain.com;
   add_header X-Cache $upstream_cache_status;
   location / {
        proxy_cache STATIC;
        proxy_cache_valid 200 30m;
        proxy_cache_valid 404 1m;
        proxy_pass http://ghost_upstream;
        proxy_ignore_headers X-Accel-Expires Expires Cache-Control;
        proxy_ignore_headers Set-Cookie;
        proxy_hide_header Set-Cookie;
        proxy_hide_header X-powered-by;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header Host $http_host;
        expires 10m;
    }
    location /content/images {
        alias /path/to/ghost/content/images;
        access_log off;
        expires max;
    }
    location /assets {
        alias /path/to/ghost/content/themes/uno-master/assets;
        access_log off;
        expires max;
    }
    location /public {
        alias /path/to/ghost/core/built/public;
        access_log off;
        expires max;
    }
    location /ghost/scripts {
        alias /path/to/ghost/core/built/scripts;
        access_log off;
        expires max;
    }
    location ~ ^/(?:ghost|signout) { 
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header Host $http_host;
        proxy_pass http://ghost_upstream;
        add_header Cache-Control "no-cache, private, no-store, must-revalidate, max-stale=0, post-check=0, pre-check=0";
    }
}</pre>
If you are using EasyEngine, you may <a href="https://github.com/rtCamp/easyengine/issues/319">watch this issue</a>. We are planning to add ghost support in EasyEngine soon! :-)