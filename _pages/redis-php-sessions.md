---
ID: 78880
post_title: >
  Using Redis for PHP Sessions on Ubuntu
  Server
author: Rahul Bansal
post_excerpt: >
  Using redis for php session-storage on
  ubuntu server. Installing php-based web
  viewer to check redis cache status.
layout: page
permalink: >
  https://easyengine.io/tutorials/php/redis-php-sessions/
published: true
post_date: 2015-01-14 16:12:08
---
<h2>Redis Installation</h2>
Add repo which maintains latest redis
<pre class="no-highlight">add-apt-repository ppa:chris-lea/redis-server</pre>
Install redis-server and php-binding
<pre class="no-highlight">apt-get install redis-server php5-redis</pre>
<h2>PHP session config</h2>
Open file <code>vim /etc/php5/mods-available/redis.ini</code>

Add following lines:
<pre class="no-highlight">session.save_handler = redis
session.save_path = "tcp://127.0.0.1:6379"
</pre>
<h2>Restart PHP5-FPM</h2>
<pre class="no-highlight">service php5-fpm restart</pre>
<h2>Web Viewer</h2>
Paths we are referring are EasyEngine specific:
<pre>mkdir /var/www/22222/htdocs/cache/redis &amp;&amp; cd /var/www/22222/htdocs/cache/redis</pre>
<h3>phpRedisAdmin</h3>
Link: https://github.com/ErikDubbelboer/phpRedisAdmin
<pre class="no-highlight">git clone https://github.com/ErikDubbelboer/phpRedisAdmin.git
cd phpRedisAdmin
git clone https://github.com/nrk/predis.git vendor
</pre>
<h3>redis-inspector</h3>
<pre class="no-highlight">git clone https://github.com/tijmenb/redis-inspector
</pre>
<h2>Restart CLI commands</h2>
redis-cli gets automatically installed.
<h3>monitor</h3>
<pre class="no-highlight">redis-cli monitor</pre>
<h3>List all keys</h3>
<pre class="no-highlight">redis-cli KEYS *</pre>