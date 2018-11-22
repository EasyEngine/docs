---
ID: 43263
post_title: Enable gzip compression
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/nginx/enable-gzip/
published: true
post_date: 2013-07-25 19:04:26
---
You can use a site like <a href="http://gtmetrix.com/">gtmetrix.com</a> to check if your site has gzip compression enabled properly.

You can use these tools: 
<ul><li><a href="http://www.whatsmyip.org/http-compression-test/">http://www.whatsmyip.org/http-compression-test/</a> </li>
<li><a href="http://www.toolsiseek.com/gzip-compression-test/">http://www.toolsiseek.com/gzip-compression-test/ </a></li></ul>
check for gzip compression on HTML output of pages.

You can enable gzip compression for CSS and JavaScript files also. Apart from that any text data, e.g. XML files will also benefit from gzip compression. However, never turn on gzip compression on images or any kind of binary data.
<h3>Enable Gzip Compression</h3>
Most likely gzip is enabled on your server. If not, you can following codes in <code>/etc/nginx/nginx.conf</code>
<pre class="no-highlight">	gzip on;
	gzip_disable "msie6";

	gzip_vary on;
	gzip_proxied any;
	gzip_comp_level 6;
	gzip_buffers 16 8k;
	gzip_http_version 1.1;
	gzip_types text/plain text/css application/json application/x-javascript text/xml application/xml application/xml+rss text/javascript;</pre>
Most important lines are <code>gzip on</code> and <code>gzip_types</code>

<code>gzip on</code> turns on gzip compression. Later on, you can add <code>gzip off</code> under a <code>server{..}</code> block or <code>location{..}</code> to turn off gzip compression for one or more sites/regions.

<code>gzip_types</code>is list of MIME-types for which you want to turn on compression. <code>text/html</code> is implied and cannot be turned off (unless you set <code>gzip off</code>). <code>text/css</code> and <code>application/x-javascript</code> enables gzip compression for CSS and javascript files respectively.

<strong>Reference:</strong> <a href="http://nginx.org/en/docs/http/ngx_http_gzip_module.html">gzip documentation</a>