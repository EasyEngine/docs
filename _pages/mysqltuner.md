---
ID: 10787
post_title: >
  Using MySQLTuner to Optimize MySQL
  configuration
author: Rahul Bansal
post_excerpt: 'Using mysqltuner to tweak mysql configuration on ongoing basis. This helps in better utilization of system RAM & speed-up mysql-server.'
layout: page
permalink: >
  https://easyengine.io/tutorials/mysql/mysqltuner/
published: true
post_date: 2012-09-28 22:03:53
---
Tweaking MySQL is something you need to do regularly. Unlike PHP &amp; Nginx tweaking, this is not a set &amp; forget job!

We will use mysqltuner for tweaking mysql on a regular basis.
<h3>Tweaking MySQL default config first</h3>
Open <code>/etc/mysql/my.cnf</code> file &amp; scroll down to <code>[mysqld]</code> section.

You will see many settings &amp; some config variables. Some values are global while some are per-thread values. Its important because if you change something like<code>join_buffer_size</code> from 2M to 4M, it can shoot-up mysql's max memory utilization by 300M memory (as per default 150 mysql's <code>max_connections</code> value)

To start with, adjust following values:
<pre>max_connections = 50     #default is 150
wait_timeout = 30        #default is 28800</pre>
You can leave remaining as it is. Mysqltuner will guide you further.

Don't forget to restart mysql. Command: <code>service mysql restart</code>
<h3>Using mysqltuner</h3>
If you are following our setup, you may already have mysqltuner installed. Otherwise run <code>apt-get install mysqltuner</code> on Ubuntu. Non-ubuntu guys can get it from <a href="https://github.com/rackerhacker/MySQLTuner-perl">here</a>. It's just a perl script!

When you run mysqltuner, it will show you a report with many suggestions. Just follow them. Exact suggestion will vary so its hard to cover all of them here. Rather I will give you some notes some of them are offered by mysqltuner itself.
<h4>Notes:</h4>
<ol>
	<li>Run mysqltuner after 24 hours. It you don't, it will remind you by showing <em>"MySQL started within last 24 hours - recommendations may be inaccurate." </em><strong>Reason: </strong>mysqltuner recommendation may prove inaccurate.</li>
	<li>If it asks you to change value of<code>tmp_table_size</code> or<code>max_heap_table_size</code> variable, make sure you change both and keep them equal. These are global values so feel free to increase them by large chunks (provided you have enough memory on server)</li>
	<li>If it asks you to tweak <code>join_buffer_size</code>, tweak in small chunks as it will be multiplied by value of<code>max_connections</code>.</li>
	<li>If it asks you to increase <code>innodb_buffer_pool_size</code>, make it large. Ideally, it should be large enough to accomodate your all innodb databases. If you do not have enough RAM consider buying some. Otherwise try to delete unwanted database. Do not ignore this as it can degrade performance significantly.</li>
</ol>
Apart from above, always keep an eye on following lines in <code>Performance Metrics</code> section of mysqltuner report:
<pre>[--] Total buffers: 2.6G global + 130.6M per thread (100 max threads)
[OK] Maximum possible memory usage: 15.3G (<strong>48%</strong> of installed RAM)
[OK] Highest usage of available connections: 81% (81/100)</pre>
Try to keep maximum possible memory less than 50%. Other lines can tell you, if your site is using too "less" mysql connections. In that case, you can reduce<code>max_connections</code> and increase other buffers more generously.

Also, whenever you make changes to mysql config and restart mysql server, always run mysqltuner immediately to check if by mistake you haven't made maximum possible memory usage too high! Ignore any other suggestion it will give for next 24-hours!
<h3>mysqltuner &amp; automatic password</h3>
As we use mysqltuner many times, it will be convenient use <a href="https://easyengine.io/tutorials/mysql/mycnf-preference/">something like this</a>.