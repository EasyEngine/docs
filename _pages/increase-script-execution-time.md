---
ID: 10624
post_title: >
  Increase PHP script execution time with
  Nginx
author: Rahul Bansal
post_excerpt: >
  Solution for "504 Gateway Time-out"
  error. If you have a large WordPress
  setup or a server with limited
  resources, then you will this often.
layout: page
permalink: >
  https://easyengine.io/tutorials/php/increase-script-execution-time/
published: true
post_date: 2012-09-25 19:28:19
---
If you have a large WordPress setup or a server with limited resources, then you will often see the "504 Gateway Time-out" error.

You can follow the steps given below to increase the timeout value. PHP default is 30s.
<h3>Changes in php.ini</h3>
If you want to change max execution time limit for php scripts from 30 seconds (default) to 300 seconds.
<pre>vim /etc/php5/fpm/php.ini</pre>
Set...
<pre>max_execution_time = 300</pre>
In Apache, applications running PHP as a module above would have suffice. But in our case we need to make this change at 2 more places.
<h3>Changes in PHP-FPM</h3>
This is only needed if you have already un-commented request_terminate_timeout parameter before. It is commented by default, and takes value of max_execution_time found in php.ini

Edit...
<pre>vim /etc/php5/fpm/pool.d/www.conf</pre>
Set...
<pre>request_terminate_timeout = 300</pre>
<h3>Changes in Nginx Config</h3>
To increase the time limit for <strong>example.com</strong> by
<pre>vim /etc/nginx/sites-available/example.com</pre>
<pre class="prettyprint">location ~ \.php$ {
	include /etc/nginx/fastcgi_params;
        fastcgi_pass  unix:/var/run/php5-fpm.sock;
	<strong>fastcgi_read_timeout 300;</strong> 
}</pre>
If you want to increase time-limit for all-sites on your server, you can edit main nginx.conf file:
<pre>vim /etc/nginx/nginx.conf</pre>
Add following in http{..} section
<pre>http {
	#...
        <strong>fastcgi_read_timeout 300; </strong>
	#...
}</pre>
<h3 class="prettyprint">Reload PHP-FPM &amp; Nginx</h3>
Don't forget to do this so that changes you have made will come into effect:
<pre class="prettyprint">service php5-fpm reload
service nginx reload</pre>
<h4>More</h4>
<ul>
	<li><a title="Increase file upload size limit in PHP-Nginx" href="https://easyengine.io/tutorials/increasing-file-upload-limit-php-fpm-nginx-setup/">How to increase file-upload size limit in PHP-Nginx</a></li>
	<li><a title="Maintaining, Optimizing &amp; Debugging WordPress-Nginx Setup" href="https://easyengine.io/tutorials/maintaining-optimizing-debugging-wordpress-nginx-setup/">More optimization tips for WordPress-Nginx setup</a></li>
</ul>