---
ID: 48650
post_title: '.my.cnf &#8211; mysql user &#038; password'
author: Rahul Bansal
post_excerpt: >
  .my.cnf file in your home directory can
  be used to provide default mysql
  username and password
layout: page
permalink: >
  https://easyengine.io/tutorials/mysql/mycnf-preference/
published: true
post_date: 2013-10-14 22:05:31
---
This one is for lazy ones! If you are paranoid about security, do not use this.

Create file <code>~/.my.cnf</code> and add following lines in it and replace mysqluser &amp; mysqlpass values.
<pre>[client]
user=mysqluser
password=mysqlpass</pre>
For safety, make this file readable to you only by running <code>chmod 0600 ~/.my.cnf</code><code> </code>
<h3>Purpose</h3>
Next time you run mysql commands mysql, mysqlcheck, mysqdump, etc; they will pick username &amp; password from this file if you do not provide them as argument (-u and -p). It can save your time.

Of-course, if you specify username and password explicitly as part of commands arguments, they will be used.