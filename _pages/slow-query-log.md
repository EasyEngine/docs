---
ID: 13998
post_title: 'Analyse slow-query-log using mysqldumpslow &#038; pt-query-digest'
author: Rahul Bansal
post_excerpt: >
  One mysql query can bring entire server
  down, irrespective of your hardware
  configuration. Slow-query-log can help
  you catch those queries so you can fix
  them easily.
layout: page
permalink: >
  https://easyengine.io/tutorials/mysql/slow-query-log/
published: true
post_date: 2012-09-29 15:55:30
---
<em><a href="https://easyengine.io/series/wordpress-nginx-tutorials/"><img class="alignright size-full wp-image-8712" title="WordPress-NGinx" alt="" src="https://easyengine.io/wp-content/uploads/2009/03/NGinx.jpg" width="220" height="91" /></a>Note: This is written for mysql version 5.5. Old mysql version has slightly different syntax.</em>

Mysql can log slow queries which takes longer to execute. In some cases this is expected but some queries take longer because of coding mistakes. slow-query-log can definitely help you find those queries and make it easy to debug your application.

In WordPress world, many plugins are often coded my amateurs who have no idea about the scale at which big sites operate! Its better to use slow-query-log to find out such plugins.
<h2>Enable slow-query-log</h2>
You can enable slow-log by un-commenting following lines in <code>/etc/mysql/my.cnf</code>
<pre>slow-query-log = 1
slow-query-log-file = /var/log/mysql/mysql-slow.log
long_query_time = 1
log-queries-not-using-indexes</pre>
Last line will tell slow-log to log queries not using indexes. You can keep it commented if you want to ignore queries which are not using indexes.

If your server has less RAM and you are seeing many of your queries in slow-query-log, you may increase value of <code>long_query_time</code>.

Its advisable to enable slow-query-log while debugging only and disable it once you are done with it. Lets move on to analysis part.
<h3>mysqldumpslow</h3>
This comes bundled with mysql-server.
<pre>mysqldumpslow /var/log/mysql/mysql-slow.log</pre>
Following will show top 5 query which returned maximum rows. It can find queries where you missed LIMIT clause. A common performance killer!
<pre class="no-highlight">mysqldumpslow -a -s r -t 5 /var/log/mysql/mysql-slow.log</pre>
Following will sort output by count i.e. number of times query found in slow-log. Most frequency queries sometimes turned out to be unexpected queries!
<pre class="no-highlight">mysqldumpslow -a -s c -t 5 /var/log/mysql/mysql-slow.log</pre>
<h3>pt-query-digest</h3>
This is part of <a href="https://easyengine.io/wordpress-nginx/tutorials/mysql/percona-toolkit/">percona toolkit</a>.

Then basic usage is:
<pre class="no-highlight">pt-query-digest /var/log/mysql/mysql-slow.log</pre>
If you have multiple databases, you can enable filtering for a particular database:
<pre class="no-highlight">pt-query-digest /var/log/mysql/mysql-slow.log  --filter '$event-&gt;{db} eq "db_wordpress"'</pre>
<h3>mysqlsla</h3>
This is another 3rd party tool. Can be downloaded <a href="http://hackmysql.com/mysqlsla">from here</a>.

Basic Usage:
<pre class="no-highlight"> ./mysqlsla  /var/log/mysql/mysql-slow.log</pre>
Filter for a database:
<pre class="no-highlight">./mysqlsla  /var/log/mysql/mysql-slow.log -mf "db=db_name"</pre>
https://github.com/box/Anemometer
<h4>Don't forget..</h4>
Always restart mysql, every time you enable/disable slow-query-log for changes to take effect.