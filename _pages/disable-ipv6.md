---
ID: 57136
post_title: Disable IPv6 on Ubuntu 12.04
author: Rahul Bansal
post_excerpt: >
  Completely disable IPv6 on Ubuntu Server
  12.04 without rebooting
layout: page
permalink: >
  https://easyengine.io/tutorials/linux/disable-ipv6/
published: true
post_date: 2014-02-07 23:37:06
---
I really think IPv6 is a step in future direction but I saw poor performance on one of our OVH server.
<h2>Disabling IPv6</h2>
<h3>Sysctl Edit</h3>
Open <code>/etc/sysctl.conf</code> and add following lines.
<pre>net.ipv6.conf.all.disable_ipv6 = 1
net.ipv6.conf.default.disable_ipv6 = 1
net.ipv6.conf.lo.disable_ipv6 = 1</pre>
Then run <code>sudo sysctl -p</code>
<h3>Change proc</h3>
Just run following command
<pre class="no-highlight">cat /proc/sys/net/ipv6/conf/all/disable_ipv6</pre>
If it returns 0, then ipv6 is not completely disabled. May be you need to reboot OS which is something not desired on server.

So just run following command to disable manually.
<pre class="no-highlight">echo "1" &gt; /proc/sys/net/ipv6/conf/all/disable_ipv6</pre>
You can test again to see if its disabled.

Thats it. Next section has tests I have carried out before reaching to conclusion that I need to disable IPv6. You may skip it.
<h2>Tests</h2>
<h3>wget with IPv6</h3>
<pre class="no-highlight">wget -O /dev/null http://proof.ovh.ca/files/1Gb.dat
--2014-02-06 06:42:26--  http://proof.ovh.ca/files/1Gb.dat
Resolving proof.ovh.ca (proof.ovh.ca)... 2607:5300:60:273a::1, 198.27.85.58
Connecting to proof.ovh.ca (proof.ovh.ca)|2607:5300:60:273a::1|:80... connected.
HTTP request sent, awaiting response... 200 OK
Length: 125000000 (119M) [application/x-ns-proxy-autoconfig]
Saving to: `/dev/null'

100%[======================================&gt;] 125,000,000 1.35M/s   in 94s     

2014-02-06 06:44:00 (1.27 MB/s) - `/dev/null' saved [125000000/125000000]</pre>
<h3>wget with IPv4</h3>
<pre class="no-highlight">wget -4 -O /dev/null http://proof.ovh.ca/files/1Gio.dat
--2014-02-07 06:30:46--  http://proof.ovh.ca/files/1Gio.dat
Resolving proof.ovh.ca (proof.ovh.ca)... 198.27.85.58
Connecting to proof.ovh.ca (proof.ovh.ca)|198.27.85.58|:80... connected.
HTTP request sent, awaiting response... 200 OK
Length: 1073741824 (1.0G) [application/x-ns-proxy-autoconfig]
Saving to: `/dev/null'

100%[====================================&gt;] 1,073,741,824  108M/s   in 9.5s    

2014-02-07 06:30:56 (108 MB/s) - `/dev/null' saved [1073741824/1073741824]</pre>
<h3>Difference</h3>
As you can see there with IPv4 file got downloaded with 108 Mbps speed but with IPv6 it was just 1.32 Mbps i.e. 100 times slower!