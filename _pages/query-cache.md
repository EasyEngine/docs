---
ID: 45417
post_title: Improving MySQL Query Cache
author: Rahul Bansal
post_excerpt: >
  Optimizing mysql query cache for
  WordPress sites. Also a small
  explanation on using InnoDB buffer pool
  and mysql query cache together.
layout: page
permalink: >
  https://easyengine.io/tutorials/mysql/query-cache/
published: true
post_date: 2013-09-01 15:57:42
---
<strong>Important Note:</strong> From MySQL 5.6.8,<code>query_cache_type</code> is set to OFF by default. So if you haven't explicitly turned it ON on old version, it may not work anymore!
<h3>Check current status of query_cache</h3>
<pre class="no-highlight">mysql -e "show variables like 'query_cache_%'"</pre>
Will output something like:
<pre class="no-highlight">+------------------------------+-----------+
| Variable_name                | Value     |
+------------------------------+-----------+
| query_cache_limit            | 2097152   |
| query_cache_min_res_unit     | 4096      |
| query_cache_size             | 268435456 |
| query_cache_strip_comments   | ON        |
| query_cache_type             | ON        |
| query_cache_wlock_invalidate | OFF       |
+------------------------------+-----------+</pre>
<h3>Query Cache Config</h3>
Add something like below following to your <code>/etc/my/my.cnf</code>
<pre class="no-highlight">query_cache_type = 1
query_cache_size = 256M
query_cache_limit = 2M
query_cache_strip_comments =1</pre>
<p class="error rtp-margin-top-20">Please note that <code>query_cache_strip_comments</code> variable is available on Percona &amp; MariaDB mysql variants as of now.</p>

<h3>Meaning of variables</h3>
<h4>query_cache_type</h4>
Just turn it ON. From mysql 5.6.8 its OFF by default.

If this is OFF, you will see error "[!!] Query cache is disabled" when running mysqltuner.

Earlier mysql version used to set<code>query_cache_type</code> = 1 but<code>query_cache_size</code> = 0. If either of<code>query_cache_type</code> and<code>query_cache_size</code> is set to 0, query_cache gets disabled.
<h4>query_cache_size</h4>
Default is 1MB. You can set it upto 4GB but very high values are not recommend for sites where tables are modified quite frequently.

In WordPress scenario, if you have a multi-author blog, or some other custom post types, then query cache prunes might be frequent. Query cache is invalidated for entire table even if a small value is modified.
<h4>query_cache_limit</h4>
Default is 1MB. You can set it upto 4GB. Again very high values are not recommended.

Better optimize your codes to not fetch too much data in one query. If you need 10 rows, add pagination, WHERE conditions rather than fetching all rows from mysql and then using only 10 rows out of them!
<h3>InnoDB Buffer &amp; Query Cache</h3>
Many references on Internet will tell you that query cache is useless if InnoDB is being used.

Well if you are using InnoDB only and have limited RAM, InnoDB buffer pool without a doubt should get first priority.

If you have some spare RAM, it is highly recommended to use query_cache for WordPress sites. Even for big WordPress sites, most likely percentage of SELECT queries will be much higher as compared to INSERT or UPDATE.

Best way is to monitor query cache efficiency using mysqltuner. Look for a line like:
<pre class="no-highlight">[OK] Query cache efficiency: 71.5% (8K cached / 11K selects)</pre>
100% Query cache efficiency may not be possible for 100% read-only sites but try to stay above 50%.