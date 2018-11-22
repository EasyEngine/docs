---
ID: 142247
post_title: Configuring HTTP/2 Server Push
author: mbtamuli
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/nginx/configuring-http-2-server-push/
published: true
post_date: 2018-05-31 02:54:15
---
Nginx introduced HTTP/2 Server Push <a href="https://www.nginx.com/blog/nginx-1-13-9-http2-server-push/">with NGINX 1.13.9</a>. To upgrade Nginx to the latest version, 1.14.0, just run
<pre><code class="terminal"># ee stack upgrade --nginx</code></pre>
You can check the version using
<pre><code class="terminal"># nginx -v
nginx version: nginx/1.14.0 (EasyEngine)</code></pre>
<h2>Configuration</h2>
To configure HTTP/2 Server Push, you will have to use TLS(SSL). Almost all modern browsers will only support HTTP/2 over TLS.

You need to add the http2 parameter to the listen directive.
<pre>listen 443 ssl <strong>http2</strong>;<code>
</code></pre>
Then you will have to add the http2_push_preload directive with the <code>proxy_pass</code> or <code>fastcgi</code> directive, on EasyEngine installation, this will be in the file <code>/etc/nginx/common/php7.conf</code>
<pre>fastcgi_pass php7;
<strong>http2_push_preload on;
</strong></pre>
Then reload Nginx using - <code>nginx -t &amp;&amp; nginx -s reload</code>
<h2>Verification</h2>
<code></code>For WordPress site, you can install this plugin - <a href="https://wordpress.org/plugins/http2-server-push/">HTTP/2 Server Push</a>. To verify the setup, you need the <a href="https://nghttp2.org/documentation/nghttp.1.html">nghttp</a> tool. On Ubuntu, the package containing this tool is <a href="https://packages.ubuntu.com/search?keywords=nghttp2">nghttp2</a>
Run the command
<pre><code class="terminal">nghttp -ans https://example.com</code></pre>
Following is the output of the command for https://easyengine.io (Truncated for brevity). If you see the asterisk (*) in the requestStart column, you know the server push is working.
<pre class="no-highlight">sorted by 'complete'

id  responseEnd requestStart  process code size request path
 13      +1.31s        +66us    1.31s  200  15K /
  2      +1.32s <strong>*</strong>     +1.23s  87.81ms  200   4K /wp-includes/js/wp-emoji-release.min.js
  6      +1.38s <strong>*</strong>     +1.23s 151.90ms  200  27K /wp-includes/css/dashicons.min.css
  8      +1.39s <strong>*</strong>     +1.23s 158.18ms  200   4K /wp-content/uploads/bb-plugin/cache/39791-layout.css</pre>
You can read the post mentioned at the start of this article for more details on HTTP/2 Server Push