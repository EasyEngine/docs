---
ID: 78881
post_title: Using Redis for WordPress Object-Cache
author: Rahul Bansal
post_excerpt: >
  Using drop-in WordPress object-cache
  plugin with redis. Uses PECL extension
  for better performance.
layout: page
permalink: >
  https://easyengine.io/tutorials/wordpress/redis-wordpress-object-cache/
published: true
post_date: 2015-01-14 16:17:47
---
<h2>Redis Installation</h2>
Add repo which maintains latest redis
<pre class="no-highlight">add-apt-repository ppa:chris-lea/redis-server</pre>
Install redis-server and php-binding
<pre class="no-highlight">apt-get update
apt-get install redis-server php5-redis</pre>
<h2>WordPress Object Cache</h2>
We are using this object-cache plugin - <a href="https://github.com/alleyinteractive/wp-redis">https://github.com/alleyinteractive/wp-redis</a>
<pre>cd /var/www/example.com/htdocs/wp-content
wget https://raw.githubusercontent.com/alleyinteractive/wp-redis/master/object-cache.php
chown www-data: object-cache.php</pre>
<h3>WordPress Cache Salt/Prefix</h3>
Useful if you have multiple WordPress.

Inside <code>wp-config.php</code>
<pre>define('WP_CACHE', true);
define('WP_CACHE_KEY_SALT', 'example.com/subdir');</pre>
<strong>Related:</strong> <a href="https://easyengine.io/tutorials/php/redis-php-sessions/">https://easyengine.io/tutorials/php/redis-php-sessions/</a>