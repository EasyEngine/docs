---
ID: 131123
post_title: secure
author: Dinesh Jain
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/docs/commands/secure/
published: true
post_date: 2015-11-23 12:24:29
---
<h2 id="changing-http-authentication-credentials">Changing HTTP authentication credentials</h2>
HTTP authentication credentials can be changed with this command.
<pre><code>ee secure --auth [Optional user name] [Optional password]
</code></pre>
This will prompt you to enter username and password, if you don’t give any user name and password at command line
<pre><code>Provide HTTP authentication user name [bob]: user
Provide HTTP authentication password [aeUtefDscwG]:
Executing service nginx reload, please wait...
</code></pre>
<h1 id="changing-admin-port">Changing Admin Port</h1>
EasyEngine (ee) provides access to its web utilities through registered port 22222, it can be customized using
<pre><code>ee secure --port [Optional port no]
</code></pre>
This command will ask you to enter the port you want to setup for accessing web utilities of EasyEngine (ee), if you don’t provid optional port at command line .
<pre><code>EasyEngine admin port [22222]: 55555
Executing service nginx reload, please wait...
</code></pre>
<h1 id="whitelisting-ips">Whitelisting IP’s</h1>
EasyEngine (ee) can whitelist IP’s, which can be done using
<pre><code>ee secure --ip [Optional comma separated IPs]
</code></pre>
If you don’t provide IP address list at command line, Then EasyEngine will ask you IPs. The list of IP addresses, should be provided in comma seperated format for whitelisting them.
<pre><code>Enter the comma separated IP addresses to white list [127.0.0.1]: 1.2.3.4, 2.3.6.4,2.3.9.8
Executing service nginx reload, please wait...</code></pre>