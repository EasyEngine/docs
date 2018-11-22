---
ID: 43350
post_title: >
  Adding $upstream_cache_status in HTTP
  Response Headers
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/nginx/upstream-cache-status-in-response-header/
published: true
post_date: 2013-07-26 21:24:24
---
In our checklist for perfect <a href="https://easyengine.io/wordpress-nginx/tutorials/checklist/">WordPress-Nginx setup</a>, we have a section dedicated to check if page-caching will work in case PHP/MySQL backend crash. Some readers did not like my way of actually shutting down PHP backend for cache-verification.

If you are using Nginx's<code>fastcgi_cache</code>, then you can use<code>upstream_cache_status</code> variable to test cache for particular URLs without shutting down PHP.

All you need to do is, add a line like below to <code>/etc/nginx/nginx.conf</code> file, in <code>http{..}</code> block:
<pre class="no-highlight">add_header rt-Fastcgi-Cache $upstream_cache_status;</pre>
Just reload nginx config: <code>service nginx reload</code>

Check HTTP response for any page and you will see something like:
<pre class="no-highlight">HTTP/1.1 200 OK
Server: nginx
Date: Fri, 26 Jul 2013 15:38:51 GMT
Content-Type: text/html; charset=UTF-8
Connection: keep-alive
Vary: Accept-Encoding
X-Powered-By: PHP/5.4.17-1~precise+1
Expires: Thu, 19 Nov 1981 08:52:00 GMT
Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0
Pragma: no-cache
X-Pingback: http://rtcamp.com/xmlrpc.php
<strong>rt-Fastcgi-Cache: HIT</strong></pre>
Please note last line. Value next to rt-Fastcgi-Cache indicates fastcgi-cache status.

If you see a MISS, send similar request again and it should get you a HIT.

If you see BYPASS, that means some conditions for skipping cache are met.

<strong>Related:</strong> <a href="https://easyengine.io/wordpress-nginx/tutorials/nginx/upstream-cache-status-in-access-log/">Using $upstream_cache_status improving cache efficiency</a>