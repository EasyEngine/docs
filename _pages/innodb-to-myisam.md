---
ID: 44205
post_title: Convert from INNODB to MYISAM
author: Nitun Lanjewar
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/mysql/innodb-to-myisam/
published: true
post_date: 2013-08-08 18:03:53
---
MYISAM is use by very less hosting companies now a days, as its mostly provided with the shared hosting account.

But sometimes, we needed to change mysql engine, when its create a problem while exporting and importing sql data from INNODB to MYISAM engine.

<strong>Steps to follow:</strong>
<ul>
	<li>Take backup of Mysql database.</li>
	<li>Run this sql query via terminal or in phpmyadmin for the database which you wish to convert into MYISAM.</li>
</ul>
<pre class="sql"> 
mysql -u username -p -e "SELECT concat('ALTER TABLE ', TABLE_NAME,' ENGINE=MYISAM;') FROM Information_schema.TABLES WHERE TABLE_SCHEMA = 'db_name' AND ENGINE = 'InnoDB' AND TABLE_TYPE = 'BASE TABLE'" | tail -n+2 &gt;&gt; alter.sql</pre>
<strong>Note:</strong> Change '<em>db_name'</em> with your actual database name
<ul>
	<li>Import that alter.sql file into INNODB database</li>
</ul>
And you are done! :)

&nbsp;