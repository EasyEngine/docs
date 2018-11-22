---
ID: 44950
post_title: memcache
author: Rahul Bansal
post_excerpt: 'PHP, memcache & w3-total cache for WordPress object-cache and database-cache'
layout: page
permalink: >
  https://easyengine.io/tutorials/php/memcache/
published: true
post_date: 2013-08-24 18:09:07
---
Since we moved to PHP 5.5 and it's built in <a href="https://easyengine.io/wordpress-nginx/tutorials/php/zend-opcache/">zend opcache</a>, we decided to stop using APC.

Since zend opcache filled opcaching need only, we needed something for data-cache. There is one APC fork trying to extract data-caching code on <a href="https://github.com/krakjoe/apcu">Github</a>. But we wanted something stable and mature so we choose to go with memcache.

I always hated presence of <a href="http://www.php.net/manual/en/intro.memcache.php">php5-memcache</a> and <a href="http://www.php.net/manual/en/intro.memcached.php">php5-memcached</a> - two solutions for similar needs. I read <a href="http://stackoverflow.com/questions/1442411/using-memcache-vs-memcached-with-php">this</a> and <a href="http://stackoverflow.com/questions/1825256/memcache-vs-memcached">this</a> and many more threads but could reach a conclusion.

Actually for our trivial needs both extensions should work fine. But we <em>(forced)</em> to choose php5-memcache as w3-total-cache doesn't support only this!
<h2>Installation</h2>
<pre class="no-highlight">apt-get install memcached php5-memcache
service php5-fpm restart</pre>
<h2>Config</h2>
<h3>Increase Max Memory memcache can use</h3>
By default, its 64MB. You may need more.
<ol>
	<li>Open <code>/etc/memcached.conf </code></li>
	<li>Look for value <code>-m 64</code></li>
	<li>Change it to <code>-m 1024</code></li>
	<li>Restart memcached  <code>service memcached restart</code></li>
</ol>
<h3>Move PHP's session storage to memcache</h3>
Open <code>/etc/php5/mods-available/memcache.ini</code>

Add following lines:
<pre class="no-highlight">session.save_handler = memcache
session.save_path = "tcp://localhost:11211"</pre>
Extra: Since memcached can works in multiserver mode, you can share session across server. Google for more info on this. I will post our config when we will write one! ;-)
<h3>Changes in w3-total-cache plugin</h3>
In w3-total-cache plugin you need to choose memcache as backend for object-cache and database-cache.
<h2>Web-based Stats Viewer for Memcache</h2>
There are many but we choose <a href="https://code.google.com/p/phpmemcacheadmin/">phpmemcacheadmin</a>
<pre class="no-highlight">cd /var/www/example.com/htdocs/
mkdir mem &amp;&amp; cd mem
wget http://phpmemcacheadmin.googlecode.com/files/phpMemcachedAdmin-1.2.2-r262.tar.gz
tar -xvzf phpMemcachedAdmin-1.2.2-r262.tar.gz
chmod +r *
chmod 0777 Config/Memcache.php</pre>
&nbsp;