---
ID: 133230
post_title: HTTP/2 support
author: Prabuddha
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/docs/http2-support/
published: true
post_date: 2016-01-04 13:44:48
---
<em><strong>Important:</strong> HTTP/2 is available in Nginx 1.10 stable. So from EasyEngine 3.6.0 support for Nginx Mainline is not needed, hence removed.</em>

<hr />

NGINX has released HTTP/2 support in its mainline version and not in its stable version yet.  Mainline version of NGINX has other features too.

For the users who wants to use NGINX mainline version or wants to enable  HTTP/2  on their websites they need to explicitly install NGINX mainline with EasyEngine. EasyEngine made this task easy for the users with  following single command.
<h2 id="install-nginx">Install NGINX HTTP/2</h2>
<pre>ee stack install --nginxmainline</pre>
<h2 id="install-nginx">Remove NGINX HTTP/2</h2>
<pre>ee stack remove --nginxmainline</pre>
<h2 id="install-nginx">Purge NGINX HTTP/2</h2>
<pre>ee stack purge --nginxmainline</pre>
<h2 id="install-nginx">For Existing EasyEngine Installation with NGINX stable</h2>
<pre>ee stack remove --nginx</pre>
<pre>ee stack install --nginxmainline</pre>
<h2>Check Nginx Version</h2>
<pre>root@example.com:~$ nginx -v
nginx version: nginx/1.9.0</pre>
<h2 id="install-nginx">Reverting back to Nginx - Stable:</h2>
<pre>ee stack remove --nginxmainline</pre>
<pre>ee stack install --nginx</pre>
<h2 id="install-nginx">Important Notes:</h2>
<ol>
 	<li>NGINX HTTP/2 does not support on Debian 7</li>
 	<li>Installing HTTP/2 will depreciate the support for<span class="st"> SPDY</span></li>
 	<li> command :  <code>--nginxmainline</code> is <strong>not available</strong> with <code>ee site create example.com</code></li>
</ol>