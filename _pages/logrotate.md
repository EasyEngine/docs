---
ID: 40450
post_title: Logrotate Example for Custom Logs
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/linux/logrotate/
published: true
post_date: 2013-06-21 20:50:11
---
You will need this if you are using custom location for log files.

Below is example for Nginx where log files are directly created in <code>/var/www/example.com/logs</code>

You can put following in <code>/etc/logrotate.d/nginx</code>
<pre class="no-highlight">/var/www/<strong>example.com</strong>/logs/*.log {
        daily
        missingok
        rotate 52
        compress
        delaycompress
        notifempty
        create 0640 www-data adm
        sharedscripts
        prerotate
                if [ -d /etc/logrotate.d/httpd-prerotate ]; then \
                        run-parts /etc/logrotate.d/httpd-prerotate; \
                fi; \
        endscript
        postrotate
                [ ! -f /var/run/nginx.pid ] || kill -USR1 `cat /var/run/nginx.pid`
        endscript
}</pre>
<h3>Verify</h3>
Its always better to verify if logrotate script is correct.

Just run command
<pre class="no-highlight">logrotate -d</pre>
It will produce debug output.
<h3>Restart/Force Update</h3>
Remember, logrotate is not service which can be restarted. In case you need your logrotate script to run immediately, use:
<pre>logrotate -f -v /etc/logrotate.d/nginx</pre>
Rotating log is very important. Otherwise some day your harddisk may get full and then mysql will be the first process which will refuse to start!

<strong>Recommended Reading: </strong><a href="http://articles.slicehost.com/2010/6/30/understanding-logrotate-on-ubuntu-part-1">Slicehost wiki has nice explanation<strong></strong></a>