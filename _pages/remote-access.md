---
ID: 39868
post_title: Enable Remote Access (Grant)
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/mysql/remote-access/
published: true
post_date: 2013-06-13 17:34:55
---
If you try to connect to your mysql server from remote machine, and run into error like below, this article is for you.
<p class="rtp-error">ERROR 1130 (HY000): Host '1.2.3.4' is not allowed to connect to this MySQL server</p>

<h3>Change mysql config</h3>
Start with editing mysql config file
<pre class="no-highlight">vim /etc/mysql/my.cnf</pre>
Comment out following lines.
<pre class="no-highlight">#bind-address           = 127.0.0.1
#skip-networking</pre>
If you do not find <span class="code-key">skip-networking</span> line, add it and comment out it.

Restart mysql server.
<pre class="no-highlight">service mysql restart</pre>
<h3>Change GRANT privilege</h3>
You may be surprised to see even after above change you are not getting remote access or getting access but not able to all databases.

By default, mysql username and password you are using is allowed to access mysql-server locally. So need to update privilege.

Run a command like below to access from all machines.
<pre class="no-highlight">mysql&gt; GRANT ALL PRIVILEGES ON *.* TO 'USERNAME'@'%' IDENTIFIED BY 'PASSWORD' WITH GRANT OPTION;</pre>
Run a command like below to give access from specific IP.
<pre>mysql&gt; GRANT ALL PRIVILEGES ON *.* TO 'USERNAME'@'1.2.3.4' IDENTIFIED BY 'PASSWORD' WITH GRANT OPTION;</pre>
You can replace <code>1.2.3.4</code> with your IP. You can run above command many times to GRANT access from multiple IPs.

You can also specify a separate <code>USERNAME</code> &amp; <code>PASSWORD</code> for remote access.

You can check final outcome by:
<pre class="no-highlight">SELECT * from information_schema.user_privileges where grantee like "'USERNAME'%";</pre>
Finally, you may also need to run:
<pre class="no-highlight">mysql&gt; FLUSH PRIVILEGES;</pre>
<h3>Test Connection</h3>
From terminal/command-line:
<pre class="no-highlight">mysql -h HOST -u USERNAME -pPASSWORD</pre>
If you get a mysql shell, don't forget to run <code>show databases;</code> to check if you have right privileges from remote machines.
<h3>Bonus-Tip: Revoke Access</h3>
If you accidentally grant access to a user, then better have revoking option handy.

Following will revoke all options for USERNAME from all machines:
<pre class="no-highlight">mysql&gt; REVOKE ALL PRIVILEGES, GRANT OPTION FROM 'USERNAME'@'%';</pre>
Following will revoke all options for USERNAME from particular IP:
<pre class="no-highlight">mysql&gt; REVOKE ALL PRIVILEGES, GRANT OPTION FROM 'USERNAME'@'1.2.3.4';</pre>
Its better to check <code>information_schema.user_privileges</code> table after running REVOKE command.

If you see USAGE privilege after running REVOKE command, its fine. It is as good as no privilege at all. I am not sure if it can be revoked.
<pre class="no-highlight">+-------------------------+---------------+-------------------------+--------------+
| GRANTEE                 | TABLE_CATALOG | PRIVILEGE_TYPE          | IS_GRANTABLE |
+-------------------------+---------------+-------------------------+--------------+
| 'USERNAME'@'%'          | def           | USAGE                   | NO           |
+-------------------------+---------------+-------------------------+--------------+</pre>
If we missed anything, feel free to let us know using comment form below.