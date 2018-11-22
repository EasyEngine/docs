---
ID: 63507
post_title: Timezone Sync
author: Rahul Bansal
post_excerpt: >
  Automatically synchronise timezone using
  NTP daemon on Ubuntu
layout: page
permalink: >
  https://easyengine.io/tutorials/linux/timezone-sync/
published: true
post_date: 2014-04-09 01:29:49
---
This is must if machine is part of multi-server setup.
<h2>Once-time sync</h2>
<pre class="no-highlight">ntpdate pool.ntp.org</pre>
This will sync clock once but quickly. You will see output like:
<pre> 8 Apr 19:47:13 ntpdate[30780]: adjust time server 38.229.71.1 offset 0.002989 sec</pre>
<h2>Automate Sync using NTP Daemon</h2>
<pre class="no-highlight">sudo apt-get install ntp</pre>
At this point you can consider job to be finished.

But if you want much better sync, open  /etc/ntp.conf file.

Locate default NTP servers like below:
<pre class="no-highlight">server 0.ubuntu.pool.ntp.org
server 1.ubuntu.pool.ntp.org
server 2.ubuntu.pool.ntp.org
server 3.ubuntu.pool.ntp.org</pre>
And replace them with pool near to your server/machine. You can find nearest pool using - <a href="http://support.ntp.org/bin/view/Servers/NTPPoolServers">http://support.ntp.org/bin/view/Servers/NTPPoolServers</a>

We have maximum servers in US, so we use:
<pre>server 0.us.pool.ntp.org
server 1.us.pool.ntp.org
server 2.us.pool.ntp.org
server 3.us.pool.ntp.org</pre>
Finally don't forget to restart <code>ntp</code> service
<pre>service ntp restart</pre>