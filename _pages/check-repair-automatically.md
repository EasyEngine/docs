---
ID: 13999
post_title: >
  mysqlcheck with cron to optimize
  automatically
author: Rahul Bansal
post_excerpt: 'Over the time mysql tables can get fragmented. If we do not defragment/optimize them, mysql performance degrades significantly. You can automate this using cron to keep your mysql-server healthy.  '
layout: page
permalink: >
  https://easyengine.io/tutorials/mysql/check-repair-automatically/
published: true
post_date: 2012-09-29 16:35:12
---
Over a period of time, mysql tables usually get fragmented. It degrades the performance of mysql-server significantly.

WordPress has many plugins to do this but it's better to defragment tables manually from command-line using <code>mysqlcheck</code>
<h3>Using mysqlcheck</h3>
Run the following command by replacing USER &amp; PASS values:
<pre>mysqlcheck -Aos -u USER -pPASS</pre>
It will show you some output e.g. <em>"note : Table does not support optimize, doing recreate + analyze instead"</em> if you have some InnoDB tables. You can ignore these notes. I really think <code>mysqlcheck</code> should show only errors rather than showing notes.
<h3>Automating mysql defragmentation using cron</h3>
You can run mysqlcheck using cron automatically.

Open your <code>crontab -e</code> and add following line in it:
<pre>0         4      *       *       *       mysqlcheck -Aos -u USER -pPASS &gt; /dev/null 2&gt;&amp;1</pre>
Above will run mysqlcheck daily at 4AM.
<h3>Optimizing MyISAM tables only</h3>
As InnoDB tables do not support optimization, you may be interested in optimizing MySQL tables only.

You can do that using following: <em>(<a href="http://empulsegroup.com/?p=342">source</a>)</em>
<pre class="prettyprint lang-sh">for i in `mysql -e 'select concat(table_schema,".",table_name) from information_schema.tables where engine="MyISAM"'`; do mysql -e "optimize table $i"; done</pre>
<h4>More...</h4>
<ul>
	<li><a title="Maintaining, Optimizing &amp; Debugging WordPress-Nginx Setup" href="https://easyengine.io/tutorials/maintaining-optimizing-debugging-wordpress-nginx-setup/">Maintaining, Optimizing &amp; Debugging WordPress-Nginx Setup</a></li>
</ul>