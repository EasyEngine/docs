---
ID: 39920
post_title: Character Sets and Collations
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/mysql/character-sets-collations/
published: true
post_date: 2013-06-14 15:39:41
---
Using this example, you can change character set and collation for a MySQL database table(s).

Most likely you will be need to do this if you haven't specified character set and collation at the time of database/table creation and default character set/collation applied are not desirable.
<h2>Setting MySQL default character set and collation in my.cnf</h2>
Below are settings for MySQL version 5.5.9 and onwards.

Put them in <code>/etc/mysql/my.cnf</code> is correct sections. Please be careful as some settings might be already present.
<pre class="no-highlight">[mysqld]
character-set-server=utf8 
collation-server = utf8_unicode_ci
init-connect='SET NAMES utf8'
init_connect='SET collation_connection = utf8_unicode_ci' 
skip-character-set-client-handshake</pre>
Next, restart mysql and log into mysql shell:
<pre class="no-highlight">mysql&gt; show variables like "%character%";show variables like "%collation%";</pre>
<strong>Sample output as:</strong>
<pre class="no-highlight">+--------------------------+----------------------------+
| Variable_name            | Value                      |
+--------------------------+----------------------------+
| character_set_client     | utf8                       |
| character_set_connection | utf8                       |
| character_set_database   | utf8                       |
| character_set_filesystem | binary                     |
| character_set_results    | utf8                       |
| character_set_server     | utf8                       |
| character_set_system     | utf8                       |
| character_sets_dir       | /usr/share/mysql/charsets/ |
+--------------------------+----------------------------+
8 rows in set (0.00 sec)

+----------------------+-----------------+
| Variable_name        | Value           |
+----------------------+-----------------+
| collation_connection | utf8_general_ci |
| collation_database   | utf8_general_ci |
| collation_server     | utf8_general_ci |
+----------------------+-----------------+
3 rows in set (0.00 sec)</pre>
<h2>Checking current character set and collation for database/table/columns</h2>
<h3>For Database:</h3>
<pre>SELECT default_character_set_name, default_collation_name FROM information_schema.SCHEMATA  
WHERE schema_name = "databasename";</pre>
<strong>It will show output as:</strong>
<pre class="no-highlight">+----------------------------+------------------------+
| default_character_set_name | default_collation_name |
+----------------------------+------------------------+
| latin1                     | latin1_swedish_ci      |
+----------------------------+------------------------+</pre>
<h3>For Tables:</h3>
<pre>SELECT T.table_name, T.table_collation, CCSA.character_set_name FROM information_schema.`TABLES` T,
information_schema.`COLLATION_CHARACTER_SET_APPLICABILITY` CCSA
WHERE CCSA.collation_name = T.table_collation
AND T.table_schema = "databasename";</pre>
<strong>Sample output as below:</strong>
<pre class="no-highlight">+-----------------------------------------------------+-------------------+--------------------+
| table_name                                          | table_collation   | character_set_name |
+-----------------------------------------------------+-------------------+--------------------+
| rtc_wp_rtAccountToken                               | latin1_swedish_ci | latin1             |
| rtc_wp_rtAccountVerify                              | latin1_swedish_ci | latin1             |
| rtc_wp_rt_crm_mail_messageids                       | latin1_swedish_ci | latin1             |
| rtc_wp_w3tc_cdn_queue                               | latin1_swedish_ci | latin1             |
| gp_meta                                             | utf8_general_ci   | utf8               |
+-----------------------------------------------------+-------------------+--------------------+</pre>
<h3>For Columns:</h3>
<pre>SELECT table_name, column_name, character_set_name, collation_name FROM information_schema.`COLUMNS` C 
WHERE character_set_name != 'NULL' AND table_schema = "db_name"</pre>
<strong>Sample Output:</strong>
<pre class="no-highlight">+------------------------+--------------+--------------------+-------------------+
| table_name             | column_name  | character_set_name | collation_name    |
+------------------------+--------------+--------------------+-------------------+
| rtc_wp_rtAccountToken  | accesstoken  | latin1             | latin1_swedish_ci |
| rtc_wp_rtAccountToken  | refreshtoken | latin1             | latin1_swedish_ci |
| rtc_wp_rtAccountVerify | email        | latin1             | latin1_swedish_ci |
| rtc_wp_rtAccountVerify | type         | latin1             | latin1_swedish_ci |
| rtc_wp_rtAccountVerify | code         | latin1             | latin1_swedish_ci |
+------------------------+--------------+--------------------+-------------------+</pre>
<h2>Converting character set and collations</h2>
<h3>MAKE BACKUP</h3>
We are serious. Just use mysqldump rather than regretting it later
<h3>Changing Database Character Sets and Collations</h3>
This is simplest:
<pre class="no-highlight">ALTER DATABASE db_name CHARACTER SET utf8 COLLATE utf8_general_ci;</pre>
Replace your database name with db_name. Also after running query verify if database-level defaults are changed indeed.
<h3>Changing Tables Character Sets and Collations</h3>
Below is a syntax to covert character set of<code>wp_posts</code> and <code>wp_postmeta</code>tables.
<pre>alter table wp_posts convert to character set utf8 collate utf8_unicode_ci;
alter table wp_postmeta convert to character set utf8 collate utf8_unicode_ci;</pre>
If you want to covert all your MySQL tables, then run a command like below on database <code>db_wordpress</code>
<pre>mysql -e "SELECT concat('alter table ', TABLE_NAME , ' convert to character set utf8 collate utf8_unicode_ci;')
FROM information_schema.TABLES
WHERE table_schema = 'db_wordpress'
AND TABLE_COLLATION = 'latin1_swedish_ci'" |
tail -n+2 &gt; collation.sql</pre>
After you run above query, check <code>collation.sql</code> content to verify if all rows are correct. If <code>collation.sql</code> is empty, you probably do not have a table using MyISAM engine.

If all looks good, run following to convert all mysql tables to InnoDB.
<pre>mysql db_wordpress &lt; collation.sql</pre>
<h3>Changing Column Character Sets and Collations</h3>
Below is syntax to convert columns to utf8
<pre class="no-highlight">alter table table_name change col_name col_name col_data_type character set utf8;</pre>
Please note that we have to use same col_name twice!
col_data_type can be found form a sql query like...
<pre>mysql&gt; SELECT table_name, column_name, data_type, character_set_name, collation_name FROM information_schema.`COLUMNS` WHERE  table_schema = "db_name" AND table_name = "table_name" AND column_name = "col_name";</pre>
Sample output:
<pre class="no-highlight">+--------------+--------------+-----------+
| table_name   | column_name  | data_type |
+--------------+--------------+-----------+
| wp_posts     | post_content | longtext  |
+--------------+--------------+-----------+</pre>
Example for wordpress's wp_posts table
<pre class="no-highlight">alter table wp_posts change post_content post_content LONGTEXT CHARACTER SET utf8;</pre>
Please be very careful for column conversion. Specially if you have non-english characters stored in database. In that case, you can refer to this <a href="http://codex.wordpress.org/Converting_Database_Character_Sets#Changing_the_charset_of_individual_columns">WordPress Codex section</a>.