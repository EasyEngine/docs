---
ID: 78747
post_title: Using MariaDB 10
author: Gaurav
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/mysql/using-mariadb-10/
published: true
post_date: 2015-01-09 11:50:29
---
<p class="alert">Note: Test your site properly before using this in production.</p>

<h2>Taking backup of current databases</h2>
As a precautionary we will first take backup of all databases using following simple command
<pre class="no-highlight">wget https://raw.githubusercontent.com/MiteshShah/admin/master/backup/mysqldump.sh
bash mysqldump.sh</pre>
This script will take backup of all your databases at following location
<pre class="no-highlight"> ls -al /var/www/mysqldump</pre>
<h2>Stop MySQL service</h2>
Stop running MySQL service
<pre class="no-highlight"> service mysql stop</pre>
<h2>Install MariaDB</h2>
Use following official MariaDB link to install MariaDB. This installation will remove your current MySQL / Percona MySQL and install MariaDB.

MariaDB installation: <a href="https://downloads.mariadb.org/mariadb/repositories/">https://downloads.mariadb.org/mariadb/repositories/</a>
<h2>Update MySQL root password</h2>
<em>If you are not EasyEngine user you can skip this step</em>

Open my.cnf file
<pre class="no-highlight">vim ~/.my.cnf
</pre>
and Update MySQL root password
<pre class="no-highlight">[client]
user = root
password = new-password
</pre>