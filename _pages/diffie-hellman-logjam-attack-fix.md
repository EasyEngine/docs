---
ID: 133327
post_title: Weak Diffie Hellman Logjam Attack Fix
author: Harshad Yeola
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/nginx/diffie-hellman-logjam-attack-fix/
published: true
post_date: 2016-01-12 12:35:25
---
To fix issue with weak Diffie Hellman Logjam Attack you need to:
<ol>
	<li>Disable Export Cipher Suites</li>
	<li>Deploy ECDHE and</li>
	<li>Use a Strong Diffie Hellman Group</li>
</ol>
This can be accomplished in following way.
<h2>Update Ciphers</h2>
Update  global NGINX configuration file
<pre>vim /etc/nginx/nginx.conf
</pre>
and update <code>ssl_ciphers</code> to below
<pre>ssl_ciphers ECDHE-RSA-AES128-GCM-SHA256:ECDHE-ECDSA-AES128-GCM-SHA256:ECDHE-RSA-AES256-GCM-SHA384:ECDHE-ECDSA-AES256-GCM-SHA384:DHE-RSA-AES128-GCM-SHA256:DHE-DSS-AES128-GCM-SHA256:kEDH+AESGCM:ECDHE-RSA-AES128-SHA256:ECDHE-ECDSA-AES128-SHA256:ECDHE-RSA-AES128-SHA:ECDHE-ECDSA-AES128-SHA:ECDHE-RSA-AES256-SHA384:ECDHE-ECDSA-AES256-SHA384:ECDHE-RSA-AES256-SHA:ECDHE-ECDSA-AES256-SHA:DHE-RSA-AES128-SHA256:DHE-RSA-AES128-SHA:DHE-DSS-AES128-SHA256:DHE-RSA-AES256-SHA256:DHE-DSS-AES256-SHA:DHE-RSA-AES256-SHA:ECDHE-RSA-DES-CBC3-SHA:ECDHE-ECDSA-DES-CBC3-SHA:AES128-GCM-SHA256:AES256-GCM-SHA384:AES128-SHA256:AES256-SHA256:AES128-SHA:AES256-SHA:AES:CAMELLIA:DES-CBC3-SHA:!aNULL:!eNULL:!EXPORT:!DES:!RC4:!MD5:!PSK:!aECDH:!EDH-DSS-DES-CBC3-SHA:!EDH-RSA-DES-CBC3-SHA:!KRB5-DES-CBC3-SHA;
</pre>
<strong>Note:</strong> If you have<code>ssl_ciphers</code> defined in<code>server</code> block of your site specific NGINX configuration then you must update it there.
<h2><strong>Using a Strong DH Group</strong></h2>
Run following command on your server
<pre>openssl dhparam -out /etc/nginx/dhparams.pem 2048
</pre>
open your NGINX configuration file
<pre>vim /etc/nginx/nginx.conf
</pre>
and update below directive into it
<pre>ssl_dhparam /etc/nginx/dhparams.pem;
</pre>
<h2>References</h2>
<ol>
	<li><a href="https://weakdh.org/" target="_blank">https://weakdh.org/</a></li>
	<li><a href="https://weakdh.org/sysadmin.html" target="_blank">https://weakdh.org/sysadmin.html</a></li>
</ol>