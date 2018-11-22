---
ID: 41687
post_title: Enable innodb_file_per_table
author: Rahul Bansal
post_excerpt: >
  This post deals with correct way to
  enable innodb_file_per_table and getting
  it working on old databases
layout: page
permalink: >
  https://easyengine.io/tutorials/mysql/enable-innodb-file-per-table/
published: true
post_date: 2013-07-02 15:03:25
---
<p class="rtp-success"><strong>Note:</strong> You may wish to <a href="https://easyengine.io/wordpress-nginx/tutorials/mysql/myisam-to-innodb/">convert MyISAM tables to InnoDB tables</a> before you proceed.</p>
<code>innodb_file_per_table</code> is by default ON Mysql 5.6.6 and onwards. There is plenty of stuff on Google about pros &amp; cons of<code>innodb_file_per_table</code>.

This post details how to enable innodb_file_per_table on an existing database. Because innodb_file_per_table affects new tables only, created after innodb_file_per_table is enabled, we need to recreate old databases to force innodb_file_per_table on old tables and reclaim some disk space.
<h3>Backup First</h3>
Create a dir to take backups:
<pre class="no-highlight">cd ~
mkdir backup
cd backup</pre>
<h4>Copy mysql data files (raw)</h4>
If all goes well, we will not need this.

For better results, shut down PHP and other apps/scripts which update mysql. You can keep Nginx running and server non-logged in visitors cached content.
<pre class="no-highlight">service mysql stop &amp;&amp; cp -ra /var/lib/mysql mysqldata &amp;&amp; service mysql start</pre>
<h4><span style="font-size: 1.125em; line-height: 1.3333em; font-weight: 400;">Take mysqldump</span></h4>
As soon as above line completes, take a mysqldump of all databases
<pre class="no-highlight">mysqldump --routines --events --flush-privileges --all-databases &gt; all-db.sql</pre>
<h3>Drop Databases</h3>
Create a sql file to drop all databases EXCEPT mysql database
<pre class="no-highlight">mysql -e "SELECT DISTINCT CONCAT ('DROP DATABASE ',TABLE_SCHEMA,' ;') FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA &lt;&gt; 'mysql' AND TABLE_SCHEMA &lt;&gt; 'information_schema';" | tail -n+2 &gt; drop.sql</pre>
Verify if <span class="code-key">drop.sql</span> has correct database names and then execute <span class="code-key">drop.sql</span> queries.
<pre class="no-highlight">mysql &lt; drop.sql</pre>
Verify all InnoDB tables gone
<pre class="no-highlight">SELECT table_name, table_schema, engine FROM information_schema.tables WHERE engine = 'InnoDB';</pre>
<h3>Remove InnoDB files</h3>
Stop mysql server first
<pre class="no-highlight">service mysql stop</pre>
Then
<pre class="no-highlight">rm /var/lib/mysql/ibdata1 &amp;&amp; rm /var/lib/mysql/ib_logfile0 &amp;&amp; rm /var/lib/mysql/ib_logfile1</pre>
At this point most likely you will have only <code>/var/lib/mysql/mysql</code> directory only.
<h3>Enable innodb_file_per_table</h3>
Open <code>my.cnf</code> file
<pre class="no-highlight">vim /etc/mysql/my.cnf</pre>
Add following lines
<pre class="no-highlight">innodb_file_per_table = 1
innodb_file_format = barracuda</pre>
<h2>Time to import from mysqldump</h2>
Start mysql server now
<pre class="no-highlight">service mysql start</pre>
Run mysql import
<pre class="no-highlight">mysql &lt; all-db.sql</pre>
Force mysql_upgrade (to generate performance_schema)
<pre class="no-highlight">mysql_upgrade --force</pre>
That's All!