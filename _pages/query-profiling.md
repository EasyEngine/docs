---
ID: 70997
post_title: MySQL Query Profiling
author: Rahul Bansal
post_excerpt: >
  MySQL Query Profiling to breakdown
  complex query execution
layout: page
permalink: >
  https://easyengine.io/tutorials/mysql/query-profiling/
published: true
post_date: 2014-09-11 01:39:31
---
Sometimes you need get breakdown of a complex mysql query to understand where it is spending most time.

You can profile a query by doing following:
<pre><code>mysql&gt; SET SESSION profiling = 1;
mysql&gt; USE database_name;
mysql&gt; SELECT * FROM table WHERE column = 'value';
mysql&gt; SHOW PROFILES;
</code></pre>
First line enables profiling for current mysql interactive session only. Global profiling is not recommended.

Second line selects database on which we need to fire query.

Third line is actual query. (do not use EXPLAIN here).

Fourth line shows list of recorded profiles. It's output looks like:
<pre><code>
mysql&gt; SHOW PROFILES;
+----------+------------+-----------------------------------------------------------------------------------------------------------------------------------+
| Query_ID | Duration   | Query                                                                                                                             |
+----------+------------+-----------------------------------------------------------------------------------------------------------------------------------+
|        1 | 0.00008050 | SELECT DATABASE()                                                                                                                 |
|        2 | 0.00034975 | show databases                                                                                                                    |
|        3 | 0.00073850 | show tables                                                                                                                       |
|        4 | 0.00040525 | SELECT * From wp_terms wt INNER JOIN wp_term_taxonomy wtt ON wt.term_id=wtt.term_id WHERE wtt.taxonomy='post_tag' AND wtt.count=0 |
+----------+------------+-----------------------------------------------------------------------------------------------------------------------------------+
4 rows in set (0.00 sec)
</code></pre>
Above is list of queries profiled in current session.

You can get execution time breakdown by running another mysql query:
<pre>SELECT * FROM INFORMATION_SCHEMA.PROFILING WHERE QUERY_ID=4;</pre>
It will print data like:
<pre><code>
mysql&gt; SELECT * FROM INFORMATION_SCHEMA.PROFILING WHERE QUERY_ID=4;
+----------+-----+--------------------------------+----------+----------+------------+-------------------+---------------------+--------------+---------------+---------------+-------------------+-------------------+-------------------+-------+-----------------------+---------------+-------------+
| QUERY_ID | SEQ | STATE                          | DURATION | CPU_USER | CPU_SYSTEM | CONTEXT_VOLUNTARY | CONTEXT_INVOLUNTARY | BLOCK_OPS_IN | BLOCK_OPS_OUT | MESSAGES_SENT | MESSAGES_RECEIVED | PAGE_FAULTS_MAJOR | PAGE_FAULTS_MINOR | SWAPS | SOURCE_FUNCTION       | SOURCE_FILE   | SOURCE_LINE |
+----------+-----+--------------------------------+----------+----------+------------+-------------------+---------------------+--------------+---------------+---------------+-------------------+-------------------+-------------------+-------+-----------------------+---------------+-------------+
|        4 |   2 | starting                       | 0.000014 |     NULL |       NULL |              NULL |                NULL |         NULL |          NULL |          NULL |              NULL |              NULL |              NULL |  NULL | NULL                  | NULL          |        NULL |
|        4 |   3 | Waiting for query cache lock   | 0.000002 |     NULL |       NULL |              NULL |                NULL |         NULL |          NULL |          NULL |              NULL |              NULL |              NULL |  NULL | try_lock              | sql_cache.cc  |         646 |
|        4 |   4 | Waiting on query cache mutex   | 0.000001 |     NULL |       NULL |              NULL |                NULL |         NULL |          NULL |          NULL |              NULL |              NULL |              NULL |  NULL | try_lock              | sql_cache.cc  |         650 |
|        4 |   5 | checking query cache for query | 0.000057 |     NULL |       NULL |              NULL |                NULL |         NULL |          NULL |          NULL |              NULL |              NULL |              NULL |  NULL | send_result_to_client | sql_cache.cc  |        1853 |
|        4 |   6 | checking permissions           | 0.000003 |     NULL |       NULL |              NULL |                NULL |         NULL |          NULL |          NULL |              NULL |              NULL |              NULL |  NULL | check_access          | sql_parse.cc  |        5007 |
|        4 |   7 | checking permissions           | 0.000004 |     NULL |       NULL |              NULL |                NULL |         NULL |          NULL |          NULL |              NULL |              NULL |              NULL |  NULL | check_access          | sql_parse.cc  |        5007 |
|        4 |   8 | Opening tables                 | 0.000046 |     NULL |       NULL |              NULL |                NULL |         NULL |          NULL |          NULL |              NULL |              NULL |              NULL |  NULL | open_tables           | sql_base.cc   |        4944 |
|        4 |   9 | System lock                    | 0.000009 |     NULL |       NULL |              NULL |                NULL |         NULL |          NULL |          NULL |              NULL |              NULL |              NULL |  NULL | mysql_lock_tables     | lock.cc       |         299 |
|        4 |  10 | Waiting for query cache lock   | 0.000001 |     NULL |       NULL |              NULL |                NULL |         NULL |          NULL |          NULL |              NULL |              NULL |              NULL |  NULL | try_lock              | sql_cache.cc  |         646 |
|        4 |  11 | Waiting on query cache mutex   | 0.000021 |     NULL |       NULL |              NULL |                NULL |         NULL |          NULL |          NULL |              NULL |              NULL |              NULL |  NULL | try_lock              | sql_cache.cc  |         650 |
|        4 |  12 | init                           | 0.000032 |     NULL |       NULL |              NULL |                NULL |         NULL |          NULL |          NULL |              NULL |              NULL |              NULL |  NULL | mysql_select          | sql_select.cc |        2622 |
|        4 |  13 | optimizing                     | 0.000015 |     NULL |       NULL |              NULL |                NULL |         NULL |          NULL |          NULL |              NULL |              NULL |              NULL |  NULL | optimize              | sql_select.cc |         889 |
|        4 |  14 | statistics                     | 0.000057 |     NULL |       NULL |              NULL |                NULL |         NULL |          NULL |          NULL |              NULL |              NULL |              NULL |  NULL | optimize              | sql_select.cc |        1099 |
|        4 |  15 | preparing                      | 0.000017 |     NULL |       NULL |              NULL |                NULL |         NULL |          NULL |          NULL |              NULL |              NULL |              NULL |  NULL | optimize              | sql_select.cc |        1121 |
|        4 |  16 | executing                      | 0.000002 |     NULL |       NULL |              NULL |                NULL |         NULL |          NULL |          NULL |              NULL |              NULL |              NULL |  NULL | exec                  | sql_select.cc |        1879 |
|        4 |  17 | Sending data                   | 0.000099 |     NULL |       NULL |              NULL |                NULL |         NULL |          NULL |          NULL |              NULL |              NULL |              NULL |  NULL | exec                  | sql_select.cc |        2423 |
|        4 |  18 | end                            | 0.000003 |     NULL |       NULL |              NULL |                NULL |         NULL |          NULL |          NULL |              NULL |              NULL |              NULL |  NULL | mysql_select          | sql_select.cc |        2658 |
|        4 |  19 | query end                      | 0.000003 |     NULL |       NULL |              NULL |                NULL |         NULL |          NULL |          NULL |              NULL |              NULL |              NULL |  NULL | mysql_execute_command | sql_parse.cc  |        4686 |
|        4 |  20 | closing tables                 | 0.000007 |     NULL |       NULL |              NULL |                NULL |         NULL |          NULL |          NULL |              NULL |              NULL |              NULL |  NULL | mysql_execute_command | sql_parse.cc  |        4738 |
|        4 |  21 | freeing items                  | 0.000011 |     NULL |       NULL |              NULL |                NULL |         NULL |          NULL |          NULL |              NULL |              NULL |              NULL |  NULL | mysql_parse           | sql_parse.cc  |        5931 |
|        4 |  22 | logging slow query             | 0.000001 |     NULL |       NULL |              NULL |                NULL |         NULL |          NULL |          NULL |              NULL |              NULL |              NULL |  NULL | log_slow_statement    | sql_parse.cc  |        1625 |
|        4 |  23 | cleaning up                    | 0.000002 |     NULL |       NULL |              NULL |                NULL |         NULL |          NULL |          NULL |              NULL |              NULL |              NULL |  NULL | dispatch_command      | sql_parse.cc  |        1475 |
+----------+-----+--------------------------------+----------+----------+------------+-------------------+---------------------+--------------+---------------+---------------+-------------------+-------------------+-------------------+-------+-----------------------+---------------+-------------+
22 rows in set (0.00 sec)

</code></pre>