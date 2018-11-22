---
ID: 49191
post_title: 'Nginx&#8217;s Open file cache'
author: Rahul Bansal
post_excerpt: "Enable Nginx's Open file cache to improve static content handling"
layout: page
permalink: >
  https://easyengine.io/tutorials/nginx/open-file-cache/
published: true
post_date: 2013-10-20 02:14:08
---
When it comes to serving static content, Nginx is quite a beast!

You can further improve static content handling by enabling open_file_cache in nginx.

Please note that open_file_cache will cache metadata about files only. Not actual content of files. So performance gain by this kind of cache may not be noticeable.

Since this is part of Nginx's core HTTP module, you no need to worry about setup/installation.
<h3>open_file_cache</h3>
Just open <code>/etc/nginx/nginx.conf</code>

Add following lines in HTTP block:
<pre class="no-highlight">open_file_cache          max=10000 inactive=5m;
open_file_cache_valid    2m;
open_file_cache_min_uses 1;
open_file_cache_errors   on;</pre>
<h3>Explanation</h3>
If you have way too many files, change max from 10000 to more appropriate value.

If files don't change much often, or accesses less frequently, you can change inactive duration from 5m to something else. inactive and<code>open_file_cache_min_uses</code> works together.

Above sample tells nginx to cache a file information as long as minimum 2 requests are made during 5m window.

<code>open_file_cache_valid</code> tell nginx to check if information it is holding is valid every 2 minutes.

<code>open_file_cache_errors</code> tell nginx to cache errors like 404 (file not found). If you are using nginx as load-balancer, leave this off.

For more details, check <a href="http://nginx.org/en/docs/http/ngx_http_core_module.html#open_file_cache">nginx docs</a>.
<h3>Restart</h3>
Don't forget to restart nginx.
<pre class="no-highlight">nginx -t &amp;&amp; service nginx restart</pre>