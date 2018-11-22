---
ID: 63455
post_title: Analyse slow-query-log using Anemometer
author: Rahul Bansal
post_excerpt: >
  MySQL Slow log processing with
  Anemometer. Also setting up log rotate
  to process slow log for Anemometer
  automatically.
layout: page
permalink: >
  https://easyengine.io/tutorials/mysql/slow-query-log-anemometer/
published: true
post_date: 2014-04-08 20:53:44
---
<h2>Prerequisite</h2>
<ol>
	<li>Enable mysql slow log - <a href="https://easyengine.io/tutorials/mysql/slow-query-log/">https://easyengine.io/tutorials/mysql/slow-query-log/</a></li>
	<li>Peronca Toolkit - <a href="https://easyengine.io/tutorials/mysql/percona-toolkit/">https://easyengine.io/tutorials/mysql/percona-toolkit/</a></li>
</ol>
<h2>Installation</h2>
<h3>Download Anemometer &amp; Extract it</h3>
<pre><code>cd /var/www/example.com/htdocs 
git clone https://github.com/box/Anemometer.git anemometer 
cd anemometer
</code></pre>
<h3>Run mysql setup script and create a separate mysql user</h3>
<pre><code>mysql &lt; install.sql 
mysql -e "grant ALL ON slow_query_log.* to 'anemometer'@'localhost' IDENTIFIED BY 'superSecurePass';"
mysql -e "grant SELECT ON *.* to 'anemometer'@'localhost' IDENTIFIED BY 'superSecurePass';"
</code></pre>
<h3>process mysql slow log to populate anemometer database</h3>
Run following command. Make sure you update <code>superSecurePass</code> with your password.
<pre><code>pt-query-digest --user=anemometer --password=superSecurePass \
                  --review D=slow_query_log,t=global_query_review \
                  --review-history D=slow_query_log,t=global_query_review_history \
                  --no-report --limit=0% --filter=" \$event-&gt;{Bytes} = length(\$event-&gt;{arg}) and \$event-&gt;{hostname}=\"$HOSTNAME\""  /var/log/mysql/slow.log
</code></pre>
If above command is successful, you will see data getting populated in <code>global_query_review</code> and <code>global_query_review_history</code> tables in mysql's database <code>slow_query_log</code>
<h3>anemometer php config file</h3>
Copy sample config file:
<pre><code>cp conf/sample.config.inc.php conf/config.inc.php
</code></pre>
Open config file <code>conf/config.inc.php</code> and look for <code>user</code> and <code>password</code> option. Default user in sample config file is <code>root</code>. Change that to <code>anemometer</code> and password to your <code>superSecurePass</code>.

Config block will look like:
<pre><code>$conf['datasources']['localhost'] = array(
        'host'  =&gt; 'localhost',
        'port'  =&gt; 3306,
        'db'    =&gt; 'slow_query_log',
        'user'  =&gt; 'anemometer',
        'password' =&gt; 'superSecurePass',
        'tables' =&gt; array(
                'global_query_review' =&gt; 'fact',
                'global_query_review_history' =&gt; 'dimension'
        ),
        'source_type' =&gt; 'slow_query_log'
);
</code></pre>
You need to also update <code>plugins</code> section in same config file:
<pre><code>$conf['plugins'] = array(

               'visual_explain' =&gt; '/usr/bin/pt-visual-explain',
               'query_advisor' =&gt; '/usr/bin/pt-query-advisor',

#... other lines

                $conn['user'] = 'anemometer';
                $conn['password'] = 'superSecurePass';

                return $conn;
},
</code></pre>
<h3>Update PHP's timezone</h3>
You may run into errors when using Anemometer. Just copy timezone from <code>/etc/timezone</code> and update <code>date.timezone</code> value in `/etc/php5/fpm/php.ini.

Restart FPM using <code>service php5-fpm restart</code>
<h3>Automate slow.log processing</h3>
Open <code>/etc/logrotate.d/percona-server-server-5.6</code> (if using percona-mysql 5.6) or <code>/etc/logrotate.d/mysql</code>. If both doesn't exist figure out mysql slow log rotation file.

Then add slow.log processing command after <code>postrotate</code> but before <code>endscript</code>:
<pre><code>postrotate
pt-query-digest --user=anemometer --password=superSecurePass \
                  --review D=slow_query_log,t=global_query_review \
                  --review-history D=slow_query_log,t=global_query_review_history \
                  --no-report --limit=0% --filter=" \$event-&gt;{Bytes} = length(\$event-&gt;{arg}) and \$event-&gt;{hostname}=\"$HOSTNAME\"" /var/log/mysql/slow.log.1
endscript
</code></pre>
<h2>Usage</h2>
Just open <code>example.com/anemometer</code> in browser!