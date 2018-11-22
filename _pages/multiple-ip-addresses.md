---
ID: 62402
post_title: >
  Assigning Multiple IP Addresses to
  Single LAN Card
author: Rahul Bansal
post_excerpt: >
  Assigning Multiple IP Addresses to
  Single Network Card on Ubuntu using
  ethernet aliases on eth0
layout: page
permalink: >
  https://easyengine.io/tutorials/linux/multiple-ip-addresses/
published: true
post_date: 2014-03-21 12:31:51
---
<p>By default, your machine might have a single eth0 ip address.</p>
<p>Run command  <code>ifconfig</code> and you will something like below.</p>
<pre>eth0      Link encap:Ethernet  HWaddr e0:3f:49:e6:35:e7  
          inet addr:192.99.15.227  Bcast:192.99.15.255  Mask:255.255.255.0
          inet6 addr: 2607:5300:60:40e3::1/64 Scope:Global
          inet6 addr: fe80::e23f:49ff:fee6:35e7/64 Scope:Link
          UP BROADCAST RUNNING MULTICAST  MTU:1500  Metric:1
          RX packets:131715052 errors:0 dropped:0 overruns:0 frame:0
          TX packets:70136866 errors:0 dropped:0 overruns:0 carrier:0
          collisions:0 txqueuelen:1000 
          RX bytes:187451050876 (187.4 GB)  TX bytes:14950325660 (14.9 GB)
          Interrupt:16 Memory:df200000-df220000 

lo        Link encap:Local Loopback  
          inet addr:127.0.0.1  Mask:255.0.0.0
          inet6 addr: ::1/128 Scope:Host
          UP LOOPBACK RUNNING  MTU:65536  Metric:1
          RX packets:2981670 errors:0 dropped:0 overruns:0 frame:0
          TX packets:2981670 errors:0 dropped:0 overruns:0 carrier:0
          collisions:0 txqueuelen:0 
          RX bytes:2238241247 (2.2 GB)  TX bytes:2238241247 (2.2 GB)</pre>
<p>Now you want to create network aliases for eth0 so you can use multiple IP addresses on this server.</p>
<p>We often do this when we need to assign SSL for multiple domains and/or host virtual machines with dedicated IP addresses.</p>
<p>There are 2 ways to do this:</p>
<h2>ifconfig command - Quick and Temporary Way</h2>
<p>Quickest way is to do this is using <code>ifconfig</code> command only.</p>
<p>For IP address 198.27.86.40, run command like below:</p>
<pre class="bash">sudo ifconfig eth0:0 198.27.86.40 up</pre>
<p>You can execute commands like above for any number of IP addresses by replacing inference (eth0:0) and IP address.</p>
<p>This will get lost on server reboot or when networking service restarts. So if you want to create permanent aliases, use method in next section.</p>
<h2>/etc/network/interfaces - Permanent Changes</h2>
<p>Open <code>/etc/network/interfaces</code> interfaces in text editor.</p>
<p>You will see something like:</p>
<pre>auto eth0
iface eth0 inet static
        address 192.99.15.227
        netmask 255.255.255.0
        network 192.99.15.0
        broadcast 192.99.15.255
        gateway 192.99.15.254</pre>
<p>Add something like below to this file. Make sure you change IP addresses and number of blocks as per your need.</p>
<pre>#virtual aliases
auto eth0:0
iface eth0:0 inet static
        address 198.27.86.40
        netmask 255.255.255.0

auto eth0:1
iface eth0:1 inet static
        address 198.27.127.177
        netmask 255.255.255.0</pre>
<p>Then save changes and restart networking service using command:</p>
<pre class="no-highlight">service networking restart</pre>
<h2>Test</h2>
<p>Just run <code>ifconfig</code> again and you will see something like below:</p>
<pre>eth0      Link encap:Ethernet  HWaddr e0:3f:49:e6:35:e7  
          inet addr:192.99.15.227  Bcast:192.99.15.255  Mask:255.255.255.0
          inet6 addr: 2607:5300:60:40e3::1/64 Scope:Global
          inet6 addr: fe80::e23f:49ff:fee6:35e7/64 Scope:Link
          UP BROADCAST RUNNING MULTICAST  MTU:1500  Metric:1
          RX packets:131797195 errors:0 dropped:0 overruns:0 frame:0
          TX packets:70226470 errors:0 dropped:0 overruns:0 carrier:0
          collisions:0 txqueuelen:1000 
          RX bytes:187498184999 (187.4 GB)  TX bytes:15073209871 (15.0 GB)
          Interrupt:16 Memory:df200000-df220000 

eth0:0    Link encap:Ethernet  HWaddr e0:3f:49:e6:35:e7  
          inet addr:198.27.86.40  Bcast:198.27.86.255  Mask:255.255.255.0
          UP BROADCAST RUNNING MULTICAST  MTU:1500  Metric:1
          Interrupt:16 Memory:df200000-df220000 

eth0:1    Link encap:Ethernet  HWaddr e0:3f:49:e6:35:e7  
          inet addr:198.27.127.177  Bcast:198.27.127.255  Mask:255.255.255.0
          UP BROADCAST RUNNING MULTICAST  MTU:1500  Metric:1
          Interrupt:16 Memory:df200000-df220000 

lo        Link encap:Local Loopback  
          inet addr:127.0.0.1  Mask:255.0.0.0
          inet6 addr: ::1/128 Scope:Host
          UP LOOPBACK RUNNING  MTU:65536  Metric:1
          RX packets:2984510 errors:0 dropped:0 overruns:0 frame:0
          TX packets:2984510 errors:0 dropped:0 overruns:0 carrier:0
          collisions:0 txqueuelen:0 
          RX bytes:2239435897 (2.2 GB)  TX bytes:2239435897 (2.2 GB)</pre>