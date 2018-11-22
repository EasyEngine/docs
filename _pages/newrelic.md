---
ID: 51521
post_title: >
  NewRelic Setup for Ubuntu Server with
  PHP, FPM, Nginx and MySQL
author: Rahul Bansal
post_excerpt: >
  NewRelic Setup for Ubuntu Server with
  PHP, FPM, Nginx and MySQL. Perfect
  monitoring setup for WordPress
  site/server.
layout: page
permalink: >
  https://easyengine.io/tutorials/monitoring/newrelic/
published: true
post_date: 2013-11-23 16:41:04
---
This guide is for <a href="http://newrelic.com/">newrelic</a> service.
<h2>Add Ubuntu Repo</h2>
Run following commands once on target server which need to be monitored:
<pre class="no-highlight">wget -O - http://download.newrelic.com/548C16BF.gpg | sudo apt-key add -
sudo sh -c 'echo "deb http://apt.newrelic.com/debian/ newrelic non-free" &gt; /etc/apt/sources.list.d/newrelic.list'
apt-get update</pre>
<h2>Server Monitoring</h2>
To enable server monitoring, install package <strong>newrelic-sysmond</strong>
<pre class="no-highlight">apt-get install newrelic-sysmond</pre>
Then add license key:
<pre class="no-highlight">nrsysmond-config --set license_key=XXXXXXXXXX</pre>
You can get your license key, i.e. value of XXXXXXXXXX from <a href="https://rpm.newrelic.com/accounts/">https://rpm.newrelic.com/accounts/</a>

Start monitoring daemon:
<pre class="no-highlight">service newrelic-sysmond start</pre>
This will start monitoring CPU, Memory, Disk utilization.
<h2>PHP App Monitoring</h2>
Since we are running WordPress (mostly), we need to setup PHP app monitoring as well.

For this there is a separate package in newrelic repo. Run following command to install it:
<pre class="no-highlight">sudo apt-get install newrelic-php5</pre>
Next run command:
<pre class="no-highlight">newrelic-install install</pre>
Above will prompt you for license key, which is same as previous step.

You may manually need to copy newrelic ini file from php-cli to php-fpm:
<pre class="no-highlight">cp /etc/php5/cli/conf.d/newrelic.ini /etc/php5/fpm/conf.d/</pre>
If you are monitoring multiple servers with  <code>newrelic.appname</code>, you may like to change newrelic.appname in  <code>/etc/php5/fpm/conf.d/newrelic.ini </code>to something unique.

You may need to restart PHP monitor:
<pre class="no-highlight">service php5-fpm restart</pre>
PHP app monitor will graph PHP response time, error rate and throughput.
<h2>PHP-FPM and Nginx Status Monitoring</h2>
Before we proceed, I am assuming that you already have <a href="https://easyengine.io/tutorials/php/fpm-status-page/">PHP-FPM status</a> and <a href="https://easyengine.io/tutorials/nginx/status-page/">Nginx status</a> page enabled.

For PHP-FPM and Nginx, we will be using a <a href="https://pypi.python.org/pypi/newrelic_plugin_agent">third party plugin coded in python</a>. (<a href="https://github.com/MeetMe/newrelic-plugin-agent#installation-instructions">Github Link</a>)
<h3>Installation</h3>
<pre class="no-highlight">pip install newrelic-plugin-agent</pre>
<h3>Config</h3>
Copy sample config file and open it in editor.
<pre class="no-highlight">cp /opt/newrelic_plugin_agent/newrelic_plugin_agent.cfg  /etc/newrelic/newrelic_plugin_agent.cfg
vim /etc/newrelic/newrelic_plugin_agent.cfg</pre>
Fine <code>license_key</code> line and change it's value to your newrelic license key.

Alter fpm config-block to look like below:
<pre class="no-highlight">  php_fpm:
      name: UNIQUNE-NAME
      host: example.com
      path: /status
      query: json</pre>
Alter nginx config-block to look like below:
<pre class="no-highlight">  nginx:
     name: UNIQUE-NAME
     host: example.com
     path: /nginx_status</pre>
<h3>Test</h3>
<pre class="no-highlight">newrelic_plugin_agent -c /etc/newrelic/newrelic_plugin_agent.cfg -f</pre>
If all looks good, start monitoring using:
<pre>newrelic_plugin_agent -c /etc/newrelic/newrelic_plugin_agent.cfg</pre>
We just removed -f from end.
<h2>MySQL Monitoring</h2>
You can get latest download link for MySQL plugin from <a href="https://rpm.newrelic.com/accounts/219515/plugins/directory/52">https://rpm.newrelic.com/accounts/219515/plugins/directory/52</a>
<pre class="no-highlight">wget https://rpm.newrelic.com/plugins/52/6d5832e3a0ca0ee6e2cf45da8d0da170 -O nr-mysql.tar.gz 
tar xvf nr-mysql.tar.gz 
cd newrelic_mysql_plugin-1.0.9
cp config/template_newrelic.properties config/newrelic.properties
cp config/template_mysql.instance.json config/mysql.instance.json
cp config/example_logging.properties config/logging.properties</pre>
Then open  <code>config/newrelic.properties </code>and update  <code>licenseKey</code>.

Also update mysql username and password in  <code>config/mysql.instance.json</code>

Finally start mysql monitoring:
<pre class="no-highlight">java -jar newrelic_mysql_plugin-1.0.9.jar</pre>
If you don't have java installed, you may need to install it first.