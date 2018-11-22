---
ID: 40429
post_title: Serverdensity
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/linux/serverdensity/
published: true
post_date: 2013-06-21 20:13:02
---
<h3>Add PHP-FPM plugin</h3>
PHP-FPM monitoring is provided via plugin. You just need to run following commands to install it.
<pre class="no-highlight">cd /usr/bin/sd-agent
sudo ./plugins.py -v 4f4a2463c86da15d7e000001</pre>
<h3>ServerDensity Config for PHP, MySQL &amp; Nginx</h3>
Create/Edit ServerDensity config file:
<pre class="no-highlight">vim /etc/sd-agent/config.cfg</pre>
Make sure <code>[Main]</code> section looks like below:
<pre class="no-highlight">[Main]
mysql_server = DB_HOST
mysql_user = DB_USER
mysql_pass = DB_PASS
nginx_status_url = http://127.0.0.1/nginx_status
fpm_status_url = http://127.0.0.1/status
sd_url = http://SUBDOMAIN.serverdensity.com
agent_key = SERVERDENSITY_API_KEY
plugin_directory = /usr/bin/sd-agent/plugins</pre>
<h4>Notes:</h4>
<ul>
	<li>Please replace values in CAPS with proper values.</li>
	<li>For nginx_status_url, <a href="https://easyengine.io/wordpress-nginx/tutorials/nginx/status-page/">enable nginx status page</a></li>
	<li>For fpm_status_url, <a href="https://easyengine.io/wordpress-nginx/tutorials/php/fpm-status-page/">enable php-fpm status page</a></li>
</ul>