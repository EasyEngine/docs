---
ID: 39731
post_title: 'Using tmpfs for mysqldump &#038; mysqlimport'
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/mysql/tmpfs-mysqldump-mysqlimport/
published: true
post_date: 2013-06-24 19:13:21
---
For large database dump &amp; restore, its better to use tmpfs - a filesystem created in memory. Since its a RAM based filesystem, it will be much faster as compared to harddisk-based storage.

Please note that tmpfs is volatile and generally limited in size. If your goal is to create permanent backup, do NOT use tmpfs.

Also check available free space before you proceed using a command like below:
<pre class="no-highlight">df -H</pre>
<strong>Sample output:</strong>
<pre class="no-highlight">Filesystem      Size  Used Avail Use% Mounted on
/dev/md0        463G  365G   75G  83% /
udev             17G   13k   17G   1% /dev
<strong>tmpfs           6.8G  525M  6.3G   8% /run</strong>
none            5.3M     0  5.3M   0% /run/lock
none             17G     0   17G   0% /run/shm
cgroup           17G     0   17G   0% /sys/fs/cgroup</pre>
<h3>Now...</h3>
Lets consider case where we need to copy <code>DB_NAME_OLD</code> to <code>DB_NAME_NEW</code>
<h4>Backup</h4>
Use following to backup mysql database, if target database is different you
<pre class="no-highlight">mysqldump --single-transaction --no-autocommit --no-create-db --skip-comments DB_NAME_OLD &gt; /run/db.sql</pre>
<h4>Restore</h4>
For same database
<pre>mysql DB_NAME_NEW &lt; /run/db.sql</pre>
<h4>Usage</h4>
We use this to duplicate databases. Also when converting data from one character-set encoding to another.