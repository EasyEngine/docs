---
ID: 74497
post_title: Upgrade to Percona MySQL 5.6
author: Mitesh Shah
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/docs/upgrade-percona-mysql-5-6/
published: true
post_date: 2014-10-13 20:20:41
---
<h2>Backup MySQL DB</h2>
<pre># Take Database Dump
wget https://raw.githubusercontent.com/MiteshShah/admin/master/backup/mysqldump.sh
bash mysqldump.sh

# Cross check database dump
ls /var/www/mysqldump

mkdir -p /backup/mysql/data
service mysql stop
cp -av /etc/mysql /backup
cp -av /var/www/mysqldump /backup/mysql
cp -av /var/lib/mysql/ /backup/mysql/data
</pre>
<h3 id="remove-mysql-55-packages">Remove MySQL 5.5 Packages</h3>
<pre>apt-get purge mysql-server*
apt-get autoremove
</pre>
<h3>Install Percona MySQL 5.6</h3>
<pre>ee stack install mysql</pre>
<h3>Install PV command:</h3>
<pre>apt-get update
apt-get install pv
</pre>
<h3>Import Database:</h3>
<pre>cd /var/www/mysql 
gunzip * 
pv example_com.13Oct2014142434 | mysql example_com
</pre>
&nbsp;
<h2>How to revert</h2>
In any case you can face some issue, you can revert it using following commands:
<h3>Remove Percona MySQL 5.6</h3>
<pre>ee stack purge mysql
</pre>
&nbsp;
<h3>Install MySQL 5.5</h3>
<pre>apt-get install mysql-server
</pre>
&nbsp;
<h3>Import Database</h3>
<pre>cd /var/www/mysqldump</pre>
<pre>gunzip * pv example_com.13Oct2014142434 | mysql example_com</pre>
&nbsp;

&nbsp;