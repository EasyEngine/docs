---
ID: 55313
post_title: Directly connect to PHP-FPM
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/php/directly-connect-php-fpm/
published: true
post_date: 2014-01-09 17:17:41
---
During debugging, we often need to isolate problem first to make sure if its really PHP problem or Nginx is doing something wrong.

In those cases, <code>cgi-fcgi</code> command might come handy.
<h2>Installing cgi-fcgi of Ubuntu</h2>
Just run following command:
<pre class="no-highlight">apt-get install libfcgi0ldbl</pre>
<h2>Connect to PHP-FPM Directly</h2>
Assuming you are running PHP-FPM using TCP/IP with IP and PORT values 127.0.0.1 and 9000 respectively, below are some code sample you may want to execute.
<h3>Test PHP-FPM Ping Page</h3>
I have posted about this at length here <a href="https://easyengine.io/tutorials/php/fpm-status-page/">https://easyengine.io/tutorials/php/fpm-status-page/</a>

You can run following codes from command line to test output:
<pre>SCRIPT_NAME=/ping \
SCRIPT_FILENAME=/ping \
REQUEST_METHOD=GET \
cgi-fcgi -bind -connect 127.0.0.1:9000</pre>
Above will return output like below:
<pre>Content-Type: text/plain
Expires: Thu, 01 Jan 1970 00:00:00 GMT
Cache-Control: no-cache, no-store, must-revalidate, max-age=0
pong</pre>
<h3>Test PHP-FPM Status Page</h3>
I have posted about this at length here <a href="https://easyengine.io/tutorials/php/fpm-status-page/">https://easyengine.io/tutorials/php/fpm-status-page/</a>

You can run following codes from command line to test output:
<pre class="no-highlight">SCRIPT_NAME=/status \
SCRIPT_FILENAME=/status \
REQUEST_METHOD=GET \
cgi-fcgi -bind -connect 127.0.0.1:9000</pre>
Above will return output like below:
<pre>Expires: Thu, 01 Jan 1970 00:00:00 GMT
Cache-Control: no-cache, no-store, must-revalidate, max-age=0
Content-Type: text/plain

pool:                 www
process manager:      dynamic
start time:           08/Jan/2014:15:04:57 +0530
start since:          93492
accepted conn:        1215
listen queue:         0
max listen queue:     1
listen queue len:     0
idle processes:       26
active processes:     4
total processes:      30
max active processes: 34
max children reached: 0
slow requests:        150</pre>
In case you want to test <strong>full</strong> status page, you can use commands like:
<pre>SCRIPT_NAME=/status \
SCRIPT_FILENAME=/status \
QUERY_STRING=full \
REQUEST_METHOD=GET \
cgi-fcgi -bind -connect 127.0.0.1:9000</pre>
In case you want to execute custom script, you can specify document root using
<pre>SCRIPT_NAME=/custom.php \
SCRIPT_FILENAME=/custom.php \
QUERY_STRING=VAR1 \
DOCUMENT_ROOT=/var/www/example.com/htdocs/ \
REQUEST_METHOD=GET \
cgi-fcgi -bind -connect 127.0.0.1:9000</pre>
<strong>References:</strong> <a href="http://www.fastcgi.com/devkit/doc/fcgi-devel-kit.htm#S4.2">http://www.fastcgi.com/devkit/doc/fcgi-devel-kit.htm#S4.2</a>