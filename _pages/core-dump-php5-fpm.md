---
ID: 66230
post_title: Generating core-dump for php5-fpm
author: Rahul Bansal
post_excerpt: >
  Generating core-dump for php5-fpm and
  viewing backtrace on Ubuntu server
layout: page
permalink: >
  https://easyengine.io/tutorials/php/core-dump-php5-fpm/
published: true
post_date: 2014-06-05 16:14:56
---
<h2>Install Packages</h2>
Run following command:
<pre class="no-highlight">apt-get install gdb php5-dbg</pre>
<h2>Linux Changes</h2>
First you need to enable core dumps in linux
<pre class="no-highlight">su -
echo '/tmp/core-%e.%p' &gt; /proc/sys/kernel/core_pattern
echo 0 &gt; /proc/sys/kernel/core_uses_pid
ulimit -c unlimited</pre>
<h2>PHP5-FPM Config Changes</h2>
Then you need to make changes to php5-fpm config:
<pre class="no-highlight">vim /etc/php-fpm.d/www.conf</pre>
and uncomment following line
<pre class="no-highlight">rlimit_core = unlimited
</pre>
<strong>Restart FPM</strong>
<pre class="no-highlight">service pgp5-fpm restart</pre>
<h2>Check core dumps</h2>
If you see in fpm error logs:
<pre class="no-highlight">[05-Jun-2014 06:21:12] WARNING: [pool www] child 631273 exited on signal 11 (SIGSEGV - core dumped) after 20.263546 seconds from start</pre>
Go to <code>/tmp</code> folder and you will see files like:
<pre class="no-highlight"># ls -l /tmp/core*
-rw------- 1 www-data www-data 133021696 Jun  5 06:05 /tmp/core-php5-fpm.630436
-rw------- 1 www-data www-data  66887680 Jun  5 06:09 /tmp/core-php5-fpm.630735
-rw------- 1 www-data www-data  66887680 Jun  5 06:11 /tmp/core-php5-fpm.630832
-rw------- 1 www-data www-data  72388608 Jun  5 06:21 /tmp/core-php5-fpm.631273</pre>
<h2>Reading a backtrace</h2>
Use following syntax to run gdb
<pre class="no-highlight">gdb /usr/sbin/php5-fpm /tmp/core-php5-fpm.630832
</pre>
Above will show useful info about crash from dump file and open a gdb shell.

You can run <code>bt</code> command in it to get more detailed output.
<pre class="no-highlight">(gdb) bt</pre>
&nbsp;