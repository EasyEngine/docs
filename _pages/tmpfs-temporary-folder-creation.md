---
ID: 40077
post_title: >
  Using tmpfs for temporary folder
  creation
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/mysql/tmpfs-temporary-folder-creation/
published: true
post_date: 2013-07-06 18:58:04
---
If you are on Ubuntu, then do this first:
<pre class="no-highlight">vim /etc/apparmor.d/usr.sbin.mysqld</pre>
Add a line:
<pre class="no-highlight">/run/mysqld/tmp/** rwk,</pre>
Restart Apparmor
<pre class="no-highlight">service apparmor restart</pre>
Also create tmp directory and fix ownership/permissions.
<pre class="no-highlight">mkdir /run/mysqld/tmp/
chown -R mysql:mysql /run/mysqld/tmp/
chmod 1777 /run/mysqld/tmp/</pre>
<h3>Edit mysql config</h3>
Open <code>my.cnf</code> file
<pre class="no-highlight">vim /etc/mysql/my.cnf</pre>
Set/Change tmpdir location
<pre class="no-highlight">tmpdir = /run/mysqld/tmp</pre>
Restart Mysql
<pre class="no-highlight">service mysql restart</pre>