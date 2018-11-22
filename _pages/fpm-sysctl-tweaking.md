---
ID: 26015
post_title: 'PHP-FPM: Socket vs TCP/IP and sysctl tweaking'
author: Rahul Bansal
post_excerpt: >
  Tweak PHP-FPM for higher concurrency.
  Also switching from unix-sockets to
  TCP/IP and sysctl.conf tweaks.
layout: page
permalink: >
  https://easyengine.io/tutorials/php/fpm-sysctl-tweaking/
published: true
post_date: 2013-02-09 20:32:36
---
<h2>Tweaking FPM config</h2>
You may also need to tweak PHP-FPM config to match new sysctl.conf settings.

Open PHP-FPM pool config file:
<pre class="no-highlight">vim /etc/php5/fpm/pool.d/www.conf</pre>
Look for line:
<pre class="no-highlight">;listen.backlog = 128</pre>
Change it to:
<pre class="no-highlight">listen.backlog = 65536</pre>
Restart php5-fpm service.
<pre class="no-highlight">service php5-fpm restart</pre>
Additionally, make sure that operating system limit allows for above value.

Run:
<pre class="no-highlight">sysctl net.core.somaxconn</pre>
Should display value 65536 or higher.

If no, then run following commands to verify.
<pre class="no-highlight">echo "net.core.somaxconn=65536" &gt;&gt; /etc/sysctl.conf
sysctl -p</pre>
<h3>Test</h3>
Check FPM status page via web interface or command-line:
<pre class="no-highlight">curl localhost/status</pre>
It will display parameters like:
<pre class="no-highlight">pool:                 www
process manager:      ondemand
start time:           06/Nov/2016:19:02:09 +0800
start since:          2
accepted conn:        4
listen queue:         0
max listen queue:     0
<strong>listen queue len:     65536</strong>
idle processes:       1
active processes:     2
total processes:      3
max active processes: 3
max children reached: 0
slow requests:        0</pre>
In the output, <code>listen queue len </code>value should  match <code>listen.backlog</code> value set in the config.
<h2>Using TCP/IP for FPM</h2>
Sockets are slightly faster as compared to TCP/IP connection. But they are less scalable <em>by default</em>.

If you start getting errors like below <em>(as faced <a href="https://rtcamp.com/support/users/ovidiu/">ovidiu</a> <a href="https://rtcamp.com/support/topic/hitting-a-limit-with-the-tuning-or-am-i/">here</a>) </em>

<code>connect() to unix:/var/run/php5-fpm.sock failed</code> or <code>**apr_socket_recv: Connection reset by peer (104)**</code>

Then it means you need to either switch to TCP/IP or tweak with linux-system parameter so that your OS can handle large number of connections.

Open PHP-FPM pool config file
<pre class="no-highlight">vim /etc/php5/fpm/pool.d/www.conf</pre>
Replace line:
<pre class="no-highlight">listen = /var/run/php5-fpm.sock</pre>
by line:
<pre class="no-highlight">listen = 127.0.0.1:9000</pre>
<h4>Changes to Nginx</h4>
Next, open Nginx virtual-host config file(s).

Look for line
<pre class="no-highlight">fastcgi_pass unix:/var/run/php5-fpm.sock;</pre>
Replace it with
<pre class="no-highlight">fastcgi_pass 127.0.0.1:9000;</pre>
<strong>Important:</strong> Reload php-fpm and nginx so that changes can take effect.
<pre class="no-highlight">service php5-fpm reload &amp;&amp; service nginx reload</pre>
<h3>Sysctl.conf Tweaking</h3>
<p class="rtp-alert">Finally, don't forget to tweak Linux's sysctl values by following this - <a href="https://rtcamp.com/tutorials/linux/sysctl-conf/">http://rtcamp.com/tutorials/linux/sysctl-conf/</a></p>