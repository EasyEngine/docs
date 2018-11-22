---
ID: 42032
post_title: >
  Install/Upgrade to MySQL 5.6 on Ubuntu
  12.04 LTS
author: Rahul Bansal
post_excerpt: "Instructions to install or upgrade to MySQL 5.6 on Ubuntu 5.6 using Oracle's deb installer package. "
layout: page
permalink: >
  https://easyengine.io/tutorials/mysql/mysql-5-6-ubuntu-12-04/
published: true
post_date: 2013-07-10 14:00:02
---
I keep hearing good things about MySQL 5.6, so I decided to give it a try, even Ubuntu 12.04 LTS  do not have launchpad repo for it.<em> (atleast, as of July 10, 2013)</em>
<h3>Download &amp; Install MySQL 5.6 deb package from official site</h3>
You can get MySQL installers from <a href="https://dev.mysql.com/downloads/mysql/#downloads">https://dev.mysql.com/downloads/mysql/#downloads</a>

I ran following command to get MySQL 5.6.14
<pre class="no-highlight">wget -O mysql-5.6.deb http://cdn.mysql.com/Downloads/MySQL-5.6/mysql-5.6.14-debian6.0-x86_64.deb</pre>
Then install Mysql 5.6.x
<pre class="no-highlight">dpkg -i  mysql-5.6.deb</pre>
and install dependency
<pre class="no-highlight">apt-get install libaio1</pre>
<h3>Backup MySQL 5.5 Data</h3>
You will need this only if you are upgrading...
<pre class="no-highlight">cd ~ 
mkdir backup &amp;&amp; cd backup
mysqldump -A --events &gt; dump/alldb.sql

cp -pr /etc/mysql config

service mysql stop
cp -pr /var/lib/mysql/ data</pre>
At this point your mysql is stopped and you have mysql's data directory and mysqldump output in <code>~/backup</code> directory. If all goes well you will not need backups!
<h3>Remove MySQL 5.5 Packages</h3>
<pre class="no-highlight">apt-get remove mysql-common mysql-server-5.5 mysql-server-core-5.5 mysql-client-5.5 mysql-client-core-5.5
apt-get autoremove</pre>
<h3>Setup MySQL 5.6 Startup Script</h3>
<pre class="no-highlight">cp /opt/mysql/server-5.6/support-files/mysql.server /etc/init.d/mysql.server
update-rc.d -f mysql remove
update-rc.d mysql.server defaults</pre>
<strong>Note:</strong> I am not sure why but renaming mysql 5.6's startup script from mysql.server to mysql was throwing error.
<h3>Update Config &amp; Environment settings</h3>
<h4>Update environment</h4>
MySQL 5.6 directory layout is different than Lauchpad packages.
<pre class="no-highlight">vim /etc/environment
PATH="/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/usr/games<strong>:/opt/mysql/server-5.6/bin</strong>"
source /etc/environment</pre>
<strong>Confirm changes</strong>

Running... <code>which mysql</code>

<strong></strong>Should show... <code>/opt/mysql/server-5.6/bin/mysql</code>
<h4>Update mysql config file</h4>
<pre class="no-highlight">vim /etc/mysql/my.cnf</pre>
<pre class="no-highlight">basedir = /opt/mysql/server-5.6
lc-messages-dir = /opt/mysql/server-5.6/share</pre>
You may also need to tweak few other settings.

For example:<code>table_cache</code> has been renamed to <code>table_open_cache</code>
<h3>Start MySQL 5.6</h3>
Its time to start new mysql...
<pre class="no-highlight">service mysql.server start</pre>
If you are facing any issue during startup, refer to mysql error log.
<h3>Final Step</h3>
If you are upgrading from mysql, run command <code>mysql_upgrade</code>

Otherwise if its a fresh install, run following:
<pre class="no-highlight">/opt/mysql/server-5.6/scripts/mysql_install_db --user=mysql --datadir=/var/lib/mysql</pre>
That's it! Enjoy MySQL 5.6.