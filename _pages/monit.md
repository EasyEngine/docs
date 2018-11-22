---
ID: 63185
post_title: Latest Monit setup on Ubuntu
author: Rahul Bansal
post_excerpt: >
  Installing latest monit from binary
  package on Ubuntu. Configuring it to
  monitor nginx, php, mysql, system (cpu,
  memory, disk space) and email alerts.
layout: page
permalink: >
  https://easyengine.io/tutorials/monitoring/monit/
published: true
post_date: 2014-04-04 23:37:06
---
<h2>Install</h2>
<h3>apt-based</h3>
<pre class="no-highlight">apt-get install monit</pre>
Following installs Monit 5.3 on Ubuntu 12.04. Which is very old!
<h3>Binary Install</h3>
Go to <a href="http://mmonit.com/monit/#download">http://mmonit.com/monit/#download</a> and pick correct binary for your system. Following lines will install Monit 5.14 for Ubuntu 64-bit.
<pre class="no-highlight">cd ~
wget http://mmonit.com/monit/dist/binary/5.14/monit-5.14-linux-x64.tar.gz
tar zxvf monit-5.14-linux-x64.tar.gz
cd monit-5.14/
cp bin/monit /usr/bin/monit
mkdir /etc/monit
touch /etc/monit/monitrc
chmod 0700 /etc/monit/monitrc 
ln -s /etc/monit/monitrc /etc/monitrc
wget https://gist.githubusercontent.com/rahul286/9975061/raw/1aa107e62ecaaa2dacfdb61a12f13efb6f15005b/monit -P /etc/init.d/
chmod u+x /etc/init.d/monit
echo "START=yes" &gt; /etc/default/monit
monit -t</pre>
<span style="color: #222222; font-size: 2.5rem; line-height: 1.4;">Config</span>
<h3>Monit Config File</h3>
Add/Update following in <code>/etc/monit/monitrc</code>
<pre class="no-highlight">#Monitoring Interval in Seconds
set daemon  60

#Enable Web Access
set httpd port 2812
     allow admin:easyengine

#Event Queue for 5000 events
set eventqueue basedir /var/monit slots 5000

#MySQL Monitoring
check process mysqld with pidfile "/var/run/mysqld/mysqld.pid"				
	if cpu &gt; 80% for 2 cycles then alert

#PHP-FPM
check process php5-fpm with pidfile "/var/run/php5-fpm.pid"
	if cpu &gt; 80% for 2 cycles then alert

#Nginx
check process nginx with pidfile "/var/run/nginx.pid"
	if cpu &gt; 80% for 2 cycles then alert

#System Monitoring 
check system PUT_YOUR_HOSTNAME_HERE
	if memory usage &gt; 80% for 2 cycles then alert
	if cpu usage (user) &gt; 70% for 2 cycles then alert
        if cpu usage (system) &gt; 30% then alert
 	if cpu usage (wait) &gt; 20% then alert
	if loadavg (1min) &gt; 6 for 2 cycles then alert 
	if loadavg (5min) &gt; 4 for 2 cycles then alert
	if swap usage &gt; 5% then alert

check filesystem rootfs with path /
       if space usage &gt; 80% then alert
set mailserver localhost
set alert you@example.com

##mmonit (optional)
#set mmonit http://user:pass@IP:port/collector</pre>
You may also wish to change username <code>admin </code>and password <code>easyengine</code>. Also, change numbers 6 and 4 in <code>loadavg</code> lines based on number of CPU cores on your system.
<h4>Start</h4>
First test your config using <code>monit -t</code> command. Then start monit using <code>service monit start</code>
<h2>Verify</h2>
Run command  <code>monit status</code>, it should something like:
<pre class="no-highlight">The Monit daemon 5.13 uptime: 2m 

System 'example.com'
  status                            Running
  monitoring status                 Monitored
  load average                      [0.48] [0.40] [0.81]
  cpu                               0.0%us 0.0%sy 0.0%wa
  memory usage                      8276900 kB [25.1%]
  swap usage                        1192 kB [0.0%]
  data collected                    Thu, 03 Apr 2014 10:41:45

#many more lines...</pre>
You may also open <code>example.com:2182</code> in your browser to use web-based interface.
<h2>Monit-Graph</h2>
You can use commercial version M/Monit for a lot many features or free script <a href="https://github.com/danschultzer/monit-graph">monit-graph</a>
<h3>Install monit-graph</h3>
<pre class="no-highlight">cd /var/www/example.com/htdocs
git clone https://github.com/danschultzer/monit-graph mg
cd mg
chmod -R 0777 data
chmod 0644 data/index.php</pre>
<h3>Config File</h3>
Open config.php and adjust following values:
<pre class="no-highlight">"url" =&gt; "localhost:2812",   
"url_ssl" =&gt; false,
"http_username" =&gt; "admin",
"http_password" =&gt; "easyengine",</pre>
<h3>Setup Cron</h3>
Add following line to cron:
<pre class="no-highlight">* * * * * php /var/www/example.com/htdocs/mg/cron.php &gt;&gt; /var/log/monit-graph.log</pre>
<h3>View Graphs</h3>
You can open <a href="http://example.com/mg">http://example.com/mg</a> in browser to see visual graphs!
<h2>TODO</h2>
<ol>
	<li>monit check program for custom script to monitor php5-fpm status page and nginx status page.</li>
	<li>Explore: https://github.com/perusio/monit-miscellaneous/blob/master/php-fpm-tcp</li>
	<li>Explore: https://github.com/regilero/check_phpfpm_status</li>
</ol>