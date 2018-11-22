---
ID: 129198
post_title: >
  Manage Amazon RDS with phpMyAdmin via
  EasyEngine
author: Harshad Yeola
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/docs/manage-amazon-rds-with-phpmyadmin-via-easyengine/
published: true
post_date: 2015-11-06 14:47:39
---
This article explains the configuration for  phpMyAdmin installed via EasyEngine for <a href="http://docs.aws.amazon.com/AmazonRDS/latest/UserGuide/CHAP_GettingStarted.CreatingConnecting.MySQL.html" target="_blank">AWS RDS </a> instance.
<h3>PreRequisites:</h3>
<ol>
	<li><a href="http://docs.aws.amazon.com/AmazonRDS/latest/UserGuide/CHAP_GettingStarted.CreatingConnecting.MySQL.html" target="_blank">Amazon RDS instance </a>setup and configure with proper security group.</li>
	<li>EasyEngine installed server.</li>
</ol>
<h3>Install MySQL client</h3>
<pre class="bash">apt-get update
apt-get install mysql-client</pre>
<h3>Configure Mysql Credentials</h3>
Your mysql credentials file should look like following to use your Amazon RDS  with EasyEngine.
<pre class="bash">vim /etc/mysql/conf.d/my.cnf

[client]
host=xxxx.xxxxxx.xxxx.rds.amazonaws.com
user=&lt;REMOTE_MYSQL_USER&gt;
password=&lt;REMOTE_MYSQL_PASSWORD&gt;</pre>
Change permissions of file  <code>/etc/mysql/conf.d/my.cnf</code>to <code>600</code> .  So that only user with sudo privileges can access your database.
<pre class="no-highlight">sudo chmod 600 /etc/mysql/conf.d/my.cnf</pre>
<h3>Install phpMyAdmin</h3>
Install phpMyAdmin via EasyEngine command.
<pre class="bash">ee stack install --pma</pre>
Above command will install and configure phpMyAdmin for Amazon RDS instance.

You can see phpMyAdmin at<code>https://example.com:22222/db/pma/</code>
<h3></h3>