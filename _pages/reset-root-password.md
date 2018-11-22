---
ID: 44869
post_title: Reset MySQL root password
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/mysql/reset-root-password/
published: true
post_date: 2013-08-22 19:54:09
---
<h3>Below are commands:</h3>
<pre class="no-highlight">service mysql stop
mysqld_safe --skip-grant-tables &gt; /dev/null 2&gt;&amp;1 &amp;  
mysql -u root -e "use mysql; update user set password=PASSWORD('NEW-PASSWORD') where User='root'; flush privileges;"
service mysql restart</pre>
<strong>Note:</strong> You may need to wait after <code>mysqld_safe</code> command, before you can run subsequent <code>mysql</code> command.
<h3>Test:</h3>
<pre class="no-highlight">mysql -u root -pNEW-PASSWORD</pre>
<em>(Credit: <a href="http://www.cyberciti.biz/tips/recover-mysql-root-password.html">NixCraft</a>)</em>