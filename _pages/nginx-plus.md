---
ID: 132411
post_title: EasyEngine with NGINX PLUS
author: Dinesh Jain
post_excerpt: ""
layout: page
permalink: https://easyengine.io/docs/nginx-plus/
published: true
post_date: 2015-11-27 17:36:54
---
<h3 id="pre-requisites-">Pre Requisites :</h3>
We assume that you have freshly installed NGINX PLUS version as instructed here.

https://cs.nginx.com/repo_setup
<h3 id="install-easyengine">Install EasyEngine</h3>
You can install EasyEngine with usual method as describe here. http://docs.rtcamp.com/easyengine/install/#QuickSetup
<h3 id="limitations">Limitations</h3>
<em>–wpredis</em> option will not work while creating site with EasyEngine.

<em>–wpfc</em> with NGINX PLUS you can purge cache as given here. http://nginx.org/en/docs/http/ngx_http_fastcgi_module.html#fastcgi_cache_purge

You may receive following warning when using <code>ee debug --nginx=on</code> if you have not nginx with debug option.

<code>nginx: [warn] "debug_connection" is ignored, you need to rebuild nginx using --with-debug option to enable it in /etc/nginx/nginx.conf:11</code>