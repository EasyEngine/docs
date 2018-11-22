---
ID: 40434
post_title: Webmin
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/linux/webmin/
published: true
post_date: 2013-06-21 20:29:09
---
Percona maintains Ubuntu repos for their products. Below is process to install it quickly.

<strong>Add GPG Key</strong>
<pre>wget http://www.webmin.com/jcameron-key.asc
apt-key add jcameron-key.asc</pre>
<strong>Add Repos</strong>
<pre>echo "deb http://download.webmin.com/download/repository `lsb_release -cs` contrib" &gt;&gt; /etc/apt/sources.list.d/percona.list
echo "deb http://webmin.mirror.somersettechsolutions.co.uk/repository `lsb_release -cs` contrib" &gt;&gt; /etc/apt/sources.list.d/percona.list</pre>
<strong>Update</strong>
<pre>apt-get update</pre>
<strong>Install</strong>
<pre>apt-get install webmin</pre>
<strong>Start Using</strong>

By default, webmin starts on port 10000 with https. So you can open https://example.com/10000 in browser. Ignore any security warning that browser may give if example.com do not have a SSL certificate.

Login with your linux username and password only.

<em>(Source: <a href="http://www.webmin.com/deb.html">webmin official page</a>)</em>