---
ID: 49069
post_title: sysctl.conf
author: Rahul Bansal
post_excerpt: >
  Linux sysctl.conf parameter tweaking to
  improve memory management, network
  security, network performance
layout: page
permalink: >
  https://easyengine.io/tutorials/linux/sysctl-conf/
published: true
post_date: 2013-10-20 03:23:18
---
Ubuntu server out of box is not optimized to make full use of available hardware. This means "out-of-box" setup might fail under high load.

So we need to tweak system configuration for maximum concurrancy.
<h2>Sysctl Tweaks</h2>
Open
<pre class="no-highlight">vim /etc/sysctl.conf</pre>
Add following towards bottom
<pre class="no-highlight">### IMPROVE SYSTEM MEMORY MANAGEMENT ###

# Increase size of file handles and inode cache
fs.file-max = 2097152

# Do less swapping
vm.swappiness = 10
vm.dirty_ratio = 60
vm.dirty_background_ratio = 2

### GENERAL NETWORK SECURITY OPTIONS ###

# Number of times SYNACKs for passive TCP connection.
net.ipv4.tcp_synack_retries = 2

# Allowed local port range
net.ipv4.ip_local_port_range = 2000 65535

# Protect Against TCP Time-Wait
net.ipv4.tcp_rfc1337 = 1

# Decrease the time default value for tcp_fin_timeout connection
net.ipv4.tcp_fin_timeout = 15

# Decrease the time default value for connections to keep alive
net.ipv4.tcp_keepalive_time = 300
net.ipv4.tcp_keepalive_probes = 5
net.ipv4.tcp_keepalive_intvl = 15

### TUNING NETWORK PERFORMANCE ###

# Default Socket Receive Buffer
net.core.rmem_default = 31457280

# Maximum Socket Receive Buffer
net.core.rmem_max = 12582912

# Default Socket Send Buffer
net.core.wmem_default = 31457280

# Maximum Socket Send Buffer
net.core.wmem_max = 12582912

# Increase number of incoming connections
net.core.somaxconn = 4096

# Increase number of incoming connections backlog
net.core.netdev_max_backlog = 65536

# Increase the maximum amount of option memory buffers
net.core.optmem_max = 25165824

# Increase the maximum total buffer-space allocatable
# This is measured in units of pages (4096 bytes)
net.ipv4.tcp_mem = 65536 131072 262144
net.ipv4.udp_mem = 65536 131072 262144

# Increase the read-buffer space allocatable
net.ipv4.tcp_rmem = 8192 87380 16777216
net.ipv4.udp_rmem_min = 16384

# Increase the write-buffer-space allocatable
net.ipv4.tcp_wmem = 8192 65536 16777216
net.ipv4.udp_wmem_min = 16384

# Increase the tcp-time-wait buckets pool size to prevent simple DOS attacks
net.ipv4.tcp_max_tw_buckets = 1440000
net.ipv4.tcp_tw_recycle = 1
net.ipv4.tcp_tw_reuse = 1</pre>
<h2>Load Changes</h2>
Run following command to load changes to sysctl.
<pre>sysctl -p</pre>
<h2>Useful Systcl Commands</h2>
This section is added to main post after <a href="https://easyengine.io/members/ovidiu/">Ovidiu's</a> <a href="https://easyengine.io/tutorials/linux/sysctl-conf/#comment-74032">comment</a>.

Show all system parameters with their values (default or changed)
<pre class="no-highlight">sysctl -A</pre>
Show values of parameters modified by you
<pre class="no-highlight">sysctl -p</pre>
Show value for a single parameter  <code>parameter-name</code>
<pre class="no-highlight">sysctl parameter-name</pre>
Change value for  a single parameter <code>parameter-name</code> without editing <code>sysctl.conf</code><code> manually.</code>
<pre class="no-highlight">sysctl -w parameter-name=parameter-value</pre>
Above command will overwrite any previous modifications to <code>parameter-name</code>. Also, you may need to surround parameter-value with quotes.
<h2>Related</h2>
I do not have in-depth explanation for all parameters. Comments will guide you somewhat.

You can check <a href="https://easyengine.io/tutorials/linux/increase-open-files-limit/">https://easyengine.io/tutorials/linux/increase-open-files-limit/</a> for more details about <code>fs.file-max</code>
<h2>Credits</h2>
We do not have expertise to tweak linux at such level. So following links helped. They differ from most configs as they offered some explanation about parameters which helped us understand what we are picking and why!
<ol>
	<li><a href="http://klaver.it/linux/sysctl.conf">http://klaver.it/linux/sysctl.conf</a></li>
	<li><a href="https://github.com/GoTux/Configs/blob/master/99-sysctl.conf">https://github.com/GoTux/Configs/blob/master/99-sysctl.conf</a></li>
</ol>