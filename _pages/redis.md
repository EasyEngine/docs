---
ID: 141363
post_title: Redis
author: Rahul Bansal
post_excerpt: >
  Tweaking redis so it can handle more
  connections and higher workload
layout: page
permalink: https://easyengine.io/tutorials/redis/
published: true
post_date: 2016-11-23 16:56:01
---
This is a collection of our notes to tweak redis.

There are few redis default config options inside <code>/etc/redis/redis.conf</code> you can play with.
<h2>loglevel</h2>
By default, redis logs message about it's periodic database saving to disk. These messages can clutter redis logs. So you may change log level to warning and errors only.
<pre class="p1"><span class="s1">loglevel warning</span></pre>
The default log level is notice which makes scanning redis logs tough.
<h2>maxclients</h2>
This is a number of clients redis can handle simultaneously.  The default limit is 10000.
<pre>maxclients 20000</pre>
But you may see warnings such as below in your error log:
<pre># You requested maxclients of 10000 requiring at least 10032 max file descriptors.
# Redis can't set maximum open files to 10032 because of OS error: Operation not permitted.
# Current maximum open files is 4096. maxclients has been reduced to 4064 to compensate for low ulimit. If you need higher maxclients increase 'ulimit -n'.</pre>
Please try increasing <a href="https://easyengine.io/tutorials/linux/increase-open-files-limit/">open file limit</a> first.

If you see warning like above, even after you restart redis, then try following:
<ol>
 	<li>Open file <code>/lib/systemd/system/redis-server.service</code></li>
 	<li>Look for <code>[Service]</code> section and add a line <code>LimitNOFILE=64000</code> in it.</li>
 	<li>Reload daemon using <code>systemctl daemon-reload</code></li>
 	<li>Restart redis-server <code>service redis-server restart</code></li>
</ol>
Now redis log must not complain about ulimit. If it does, please <a href="http://community.rtcamp.com/c/easyengine">open a support request in our forum</a>.
<h2>tcp-backlog</h2>
This value is critical if you have very high number of redis connections.
<pre>tcp-backlog 8192</pre>
Changing above also requires tweaking <code>somaxconn</code> and <code>tcp_max_syn_backlog</code> OS parameters.
<pre>echo "net.core.somaxconn=65536" &gt;&gt; /etc/sysctl.conf
echo "net.ipv4.tcp_max_syn_backlog=8192" &gt;&gt; /etc/sysctl.conf
sysctl -p</pre>
<h2>WARNING: Transparent Huge Pages</h2>
For a warning like below:
<pre># WARNING you have Transparent Huge Pages (THP) support enabled in your kernel. This will create latency and memory usage issues with Redis. To fix this issue run the command 'echo never &gt; /sys/kernel/mm/transparent_hugepage/enabled' as root, and add it to your /etc/rc.local in order to retain the setting after a reboot. Redis must be restarted after THP is disabled.</pre>
As described in warning, please run following command.
<pre>echo never &gt; /sys/kernel/mm/transparent_hugepage/enabled</pre>
Also, add above line to the file <code>/etc/rc.local</code> for change to persist after a reboot. You do NOT need a reboot now.
<h2>WARNING: overcommit_memory</h2>
For a warning like below:
<pre>WARNING overcommit_memory is set to 0! Background save may fail under low memory condition. To fix this issue add 'vm.overcommit_memory = 1' to /etc/sysctl.conf and then reboot or run the command 'sysctl vm.overcommit_memory=1' for this to take effect.</pre>
Run following commands:
<pre>echo "vm.overcommit_memory=1" &gt;&gt; /etc/sysctl.conf
sysctl -p</pre>
<h2>References</h2>
<ul>
 	<li><a href="http://shokunin.co/blog/2014/11/11/operational_redis.html">http://shokunin.co/blog/2014/11/11/operational_redis.html</a></li>
 	<li><a href="http://posidev.com/blog/2009/06/04/set-ulimit-parameters-on-ubuntu/">http://posidev.com/blog/2009/06/04/set-ulimit-parameters-on-ubuntu/</a></li>
 	<li><a href="https://sskaje.me/systemd-ulimit/">https://sskaje.me/systemd-ulimit/</a></li>
</ul>