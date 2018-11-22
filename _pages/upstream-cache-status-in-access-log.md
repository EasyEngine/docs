---
ID: 42983
post_title: >
  Using $upstream_cache_status in
  access.log
author: Rahul Bansal
post_excerpt: >
  Using $upstream_cache_status variable in
  access.log to analyse efficiency of
  fastcgi_cache/proxy_cache
layout: page
permalink: >
  https://easyengine.io/tutorials/nginx/upstream-cache-status-in-access-log/
published: true
post_date: 2013-07-20 18:41:11
---
Nginx has a variable <a href="http://wiki.nginx.org/HttpUpstreamModule#.24upstream_cache_status">$upstream_cache_status</a>. This can be used for any upstream. We are using it mainly for our <a href="https://easyengine.io/tutorials/wordpress-nginx-fastcgi-cache-purge-conditional/">WordPress + fastcgi_cache</a>.
<h4>Define a new <code>log_format</code> in <code>nginx.conf</code>:</h4>
<pre class="no-highlight">log_format rt_cache '$remote_addr - $upstream_cache_status [$time_local]  '
                    '"$request" $status $body_bytes_sent '
                    '"$http_referer" "$http_user_agent"';</pre>
<h4>Then in server block:</h4>
Either replace lines like:
<pre class="no-highlight">access_log   /var/log/nginx/example.com.access.log;</pre>
With line:
<pre class="no-highlight">access_log   /var/log/nginx/example.com.access.log rt_cache;</pre>
OR you can use multiple access logs like below:
<pre class="no-highlight">access_log   /var/log/nginx/example.com.<strong>access</strong>.log;
access_log   /var/log/nginx/example.com.<strong>cache</strong>.log rt_cache;</pre>
Please note when using multiple logs, use separate file names.

Once you make above changes, reload nginx config and wait for log files to fill up!
<h3>Analysing cache efficiency:</h3>
<h4>HIT vs MISS vs etc</h4>
Run a command like below on your <code>access.log</code> file:
<pre class="no-highlight">awk '{print $3}' access.log  | sort | uniq -c | sort -r</pre>
Sample output:
<pre class="no-highlight">    800 HIT
    779 -
    392 BYPASS
     19 EXPIRED
     14 MISS</pre>
<strong>Note:</strong> dash ("-") means request never reached to upstream module. Most likely it means return 403, return 444, and so on.
<h4>MISS Request URLs</h4>
<pre class="no-highlight">awk '($3 ~ /MISS/)'  access.log | awk '{print $7}' | sort | uniq -c | sort -r</pre>
<h4>BYPASS Requests URLs</h4>
<pre>awk '($3 ~ /BYPASS/)'  access.log | awk '{print $7}' | sort | uniq -c | sort -r</pre>
<h3>MISS v/s BYPASS</h3>
MISS occurs when a pattern is configured to cache but at the time of request was not cached. In correct configuration, subsequent requests will be served from cache based on caching duration other parameters.

BYPASS occurs when a pattern was explicitly configured NOT to use cache. e.g. skipping cache for logged in user. Subsequent requests will also be bypassed.

<strong>Recommendations:</strong>
<ol>
	<li>If MISS are frequent, consider increasing cache size and/or duration.</li>
	<li>For BYPASS, analyse patterns. Many times we set requests with query strings to BYPASS cache. On high traffic site, it will be wise to cache output of certain requests with query strings, even that query_string alters outcome of pages. Be careful to not cache wp_nonce and auth_tokens. I will post more about this soon!</li>
</ol>
<strong>Must Read:</strong> <a href="https://easyengine.io/wordpress-nginx/tutorials/nginx/log-parsing/">Useful Commands to parse access.log</a>