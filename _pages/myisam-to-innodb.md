---
ID: 37621
post_title: Convert MyISAM to InnoDB
author: Rahul Bansal
post_excerpt: >
  Instructions to convert MyISAM tables to
  InnoDB in bulk. Drop MyISAM fulltext
  index feature. Converting
  latin1_swedish_ci to utf8_unicode_ci.
layout: page
permalink: >
  https://easyengine.io/tutorials/mysql/myisam-to-innodb/
published: true
post_date: 2013-05-27 19:40:26
---
Recently we migrated all MyISAM tables to InnoDB for most of our sites.

We saw some improvement in mysql performance, specially when editing posts. I think earlier parallel write on<code>wp_posts</code> table were getting blocked because MyISAM do not support row-level locking. There might be more logic to it but I am no database expert to comment on it.

Anyway, below is how we moved our WordPress sites. You may find process useful.
<p class="rtp-error"><strong>Important:</strong> Backup first, proceed later!</p>

<h3>Backing up a table in SQL</h3>
I know I remind you to backup. Just in case you missed it, below is a quick way to backup a table MySQL itself. This may come handy if you are playing on live site.

Run following two commands to backup <code>wp_posts</code> and <code>wp_postmeta</code> tables.
<pre class="sql">CREATE TABLE wp_posts_BAK LIKE wp_posts ; 
INSERT wp_posts_BAK SELECT * FROM wp_posts;

CREATE TABLE wp_postmeta_BAK LIKE wp_postmeta ; 
INSERT wp_postmeta_BAK SELECT * FROM wp_postmeta;</pre>
<h2>Drop Fulltext Indexes</h2>
If you are using a plugin like <a href="http://wordpress.org/plugins/yet-another-related-posts-plugin/">YARPP</a>, you need to drop fulltext indexes. If you proceed without dropping fulltext indexes, you will get an error going ahead.

Below are commands to drop YARPP's fulltext indexes.
<pre class="sql">ALTER TABLE wp_posts DROP INDEX yarpp_title;
ALTER TABLE wp_posts DROP INDEX yarpp_content;</pre>
<h4>For all tables in ONE database</h4>
Below is a query to help you find all fulltext indexes on all your mysql tables for database <code>db_wordpress.</code>
<pre class="sql">mysql -e "SELECT concat('ALTER TABLE ',TABLE_NAME,' DROP INDEX ', index_name, ' ;')
FROM information_Schema.STATISTICS 
WHERE table_schema = 'db_wordpress' 
AND index_type = 'FULLTEXT' ORDER BY index_name " | tail -n+2 &gt; drop.sql</pre>
<h4>For all tables in ALL databases</h4>
Alternatively, if you wish to drop indexes for all tables from all databases (except mysql database itself), you can use following query:
<pre class="sql">mysql -e "SELECT concat('ALTER TABLE \`',TABLE_SCHEMA,'\`.',TABLE_NAME,' DROP INDEX ', index_name, ' ;')
FROM information_Schema.STATISTICS 
WHERE TABLE_SCHEMA != 'mysql' 
AND index_type = 'FULLTEXT' ORDER BY index_name " | tail -n+2 &gt; drop.sql</pre>
After you run above query, check <code>drop.sql</code> content to verify if all rows are correct. If <code>drop.sql</code> is empty, you can directly jump to next step.

If all looks good, run following to drop all fulltext indexes in one go:
<pre>mysql -f db_wordpress &lt; drop.sql</pre>
For all databases version use:
<pre>mysql -f &lt; drop.sql</pre>
<h3>MyISAM to InnoDB</h3>
Below is a syntax to change storage engine of<code>wp_posts</code> and <code>wp_postmeta</code>tables to InnoDB.
<pre class="sql">ALTER TABLE wp_posts ENGINE=InnoDB;
ALTER TABLE wp_postmeta ENGINE=InnoDB;</pre>
<h4>For all tables in ONE database</h4>
If you want to covert all your MySQL tables, then run a command like below on database <code>db_wordpress</code>
<pre class="sql">mysql -e "SELECT concat('ALTER TABLE ',TABLE_NAME,' ENGINE=InnoDB;')  
FROM Information_schema.TABLES 
WHERE TABLE_SCHEMA = 'db_wordpress'  AND ENGINE =  'MyISAM'  AND TABLE_TYPE='BASE TABLE'" | tail -n+2 &gt; alter.sql</pre>
<h4>For all tables in ALL databases</h4>
Alternatively, if you wish to covert all tables from all databases (except mysql database itself), you can use following query:
<pre class="sql">mysql -e "SELECT concat('ALTER TABLE \`',TABLE_SCHEMA,'\`.',TABLE_NAME,' ENGINE=InnoDB;')  
FROM Information_schema.TABLES 
WHERE TABLE_SCHEMA != 'mysql' AND ENGINE = 'MyISAM'  AND TABLE_TYPE='BASE TABLE'" | tail -n+2 &gt; alter.sql</pre>
After you run above query, check <code>alter.sql</code> content to verify if all rows are correct. If <code>alter.sql</code> is empty, you probably do not have a table using MyISAM engine.

If all looks good, run following to convert all mysql tables to InnoDB.
<pre>mysql -f db_wordpress &lt; alter.sql</pre>
For all databases version use:
<pre>mysql -f &lt; alter.sql</pre>
<h3>Troubleshooting:</h3>
Most likely you will not need to troubleshoot anything. Still, if you get following error:
<p class="rtp-error">ERROR 1071 (42000) at line 1: Specified key was too long; max key length is 767 bytes InnoDB doesn't allow primary key wider than 767 bytes</p>
Then you need to change primary key column for that mysql table. Most likely you did not specified any primary key and by default InnoDB picks first column as primary-key. You can add an auto increment column and set it as primary-key and then retry running MyISAM to InnoDB conversion.