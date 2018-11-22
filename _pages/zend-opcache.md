---
ID: 44854
post_title: 'PHP&#8217;s Zend Opcache Config &#038; Web Viewer'
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/php/zend-opcache/
published: true
post_date: 2013-08-22 15:55:41
---
PHP 5.5. has zend opcache support in core. Since APC is not updated from long time, we made a switch to new Zend Opcache. Below is our config and web-based stats viewer.
<h3>PHP's Zend Opcache Config</h3>
In your <code>php.ini</code> or depending on your PHP version

<code>/etc/php5/fpm/conf.d/05-opcache.ini</code>

or <code>/etc/php/7.0/mods-available/opcache.ini</code>
<pre class="no-highlight">zend_extension=opcache.so
opcache.memory_consumption=512
opcache.max_accelerated_files=50000

;following can be commented for production server
opcache.revalidate_freq=0
opcache.consistency_checks=1</pre>
<h3>Web Viewer</h3>
Unlike APC, for Zend Opcache there are plenty of web-based viewer. May be reason being zend opcache's official status has something to do with it. Below is list to choose from.
<h4>#1. <a href="https://github.com/rlerdorf/opcache-status">Opcache-Status by Rasmus Lerdorf</a></h4>
This is by PHP creator himself. Very beautiful.

<strong>Installation</strong>
<pre class="no-highlight">cd /var/www/example.com/htdocs
wget https://raw.github.com/rlerdorf/opcache-status/master/opcache.php</pre>
<strong>Screenshot:</strong>

<img class="alignnone size-large wp-image-44855" src="https://easyengine.io/wp-content/uploads/2013/08/rlerdorf-opcache-status-493x350.png" alt="rlerdorf-opcache-status" width="493" height="350" />
<h4>#2. <a href="https://github.com/amnuts">opcache-gui by amnuts</a></h4>
Responsive. Feature-rich. Notably option to enable real-time stats and and option to reset/flush opcache.

If you are going to use this, make sure it is protected by some security layer.

<strong>Installation:</strong>
<pre class="no-highlight">cd /var/www/example.com/htdocs/
wget https://raw.github.com/amnuts/opcache-gui/master/index.php -O op.php</pre>
<strong>Screenshot:</strong>

<img class="alignnone size-large wp-image-44856" src="https://easyengine.io/wp-content/uploads/2013/08/amnuts-opcache-gui-461x350.png" alt="amnuts-opcache-gui" width="461" height="350" />
<h4>#3. <a href="https://gist.github.com/ck-on/4959032">ocp.php by ck-on</a></h4>
Has best way to analyse/explore file-based cache. UI is more old-style.

<strong>Installation:</strong>
<pre class="no-highlight">wget https://gist.github.com/ck-on/4959032/raw/0b871b345fd6cfcd6d2be030c1f33d1ad6a475cb/ocp.php</pre>
<strong>Screenshot:</strong>

<img class="alignnone size-large wp-image-44858" src="https://easyengine.io/wp-content/uploads/2013/08/ck-Opcache-Control-Panel-329x350.png" alt="ck-Opcache-Control-Panel" width="329" height="350" />

We are using all 3 for now! We will update this post if we add or remove anything from our list.