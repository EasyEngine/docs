---
ID: 56924
post_title: Using Google Public DNS on Ubuntu Server
author: Rahul Bansal
post_excerpt: |
  Using Google Public DNS IP's 8.8.8.8 and 8.8.4.4 on Ubuntu Server. One of solution for "Failed to resolve host:" error.
layout: page
permalink: >
  https://easyengine.io/tutorials/linux/google-public-dns/
published: true
post_date: 2014-02-06 16:56:46
---
We prefer <a href="https://developers.google.com/speed/public-dns/docs/using">Google Public DNS</a> for Ubuntu Server.
<h2>Changing  Nameserver</h2>
Below are steps to get it/

Open <code>/etc/resolv.conf</code> file and paste following lines in it:
<pre class="no-highlight">nameserver 8.8.8.8
nameserver 8.8.4.4</pre>
Remove/comment out any existing lines. That's it. :-)
<h3>Testing</h3>
<code>ping</code> any domain/hostname. If you get "Failed to resolve host:" error, then there is something wrong in network configuration (apart from DNS).

<strong>Note: </strong>You can always ping IP address even if your machine do not any have nameserver entries or nameservers are down.

&nbsp;

&nbsp;

&nbsp;