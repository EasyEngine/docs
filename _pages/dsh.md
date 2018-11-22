---
ID: 71241
post_title: 'dsh &#8211; distributed shell'
author: Mitesh Shah
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/linux/dsh/
published: true
post_date: 2014-09-16 21:11:53
---
DSH is Distributed Shell. It allows you to run shell commands on multiple servers at once and gather see their output in local terminal.
<h2>Install</h2>
Install  On Debian/Ubuntu
<pre>apt-get install dsh
</pre>
Mac
<pre>brew install dsh</pre>
<h2>Config</h2>
You can use default config but we always add following to dsh config file:

Global config =&gt; <code>/etc/dsh.conf</code>

Local config =&gt;  <code>~/.dsh/dsh.conf</code>
<pre class="p1">remoteshell = ssh
showmachinenames = 1</pre>
<h2>Hostname List</h2>
Edit/create

Global list =&gt; <code>/etc/dsh/machines.list</code>

Local list =&gt;  <code>~/.dsh/dsh/machines.list</code>

Add hostnames, one on each line.

Please note that, you need to add SSH key's separately <em>(beforehand)</em>.
<pre>example.com
example.net
</pre>
<h2>Usage</h2>
We need to pass actual command to dsh command with optional prameters:

Lets check uptime
<pre> dsh -a uptime</pre>
You will see output as below
<pre>example.com: 18:07:18 up 294 days,  6:38,  3 users,  load average: 0.17, 0.26, 0.24
example.net: 18:09:47 up 9 days, 19:54,  1 user,  load average: 0.26, 0.2
</pre>
<code>-a</code> denotes run for all hosts.

We can also pass <code>-c</code> which will create concurrent connections to all servers.
<h2>Grouping Hosts/Servers</h2>
You can make group and run dsh command on that group servers only.

You can add a file under group directory like below

Global settings =&gt; <code>/etc/dsh/group/hello</code>

Local settings =&gt;  <code>~/.dsh/dsh/group/hello</code>

Add list of hostnames. You can add multiple hostnames to groups
<pre>hello.com
hello.net
hello.org
</pre>
Lets check uptime on hello group servers:
<pre>dsh -g hello uptime</pre>
Will display something like
<pre>hello.com: 18:11:45 up 9 days, 19:56,  0 users,  load average: 0.05, 0.18, 0.22
hello.net: 18:11:45 up 19 days, 19:56,  0 users,  load average: 0.15, 0.18, 0.22
hello.org: 18:11:45 up 119 days, 19:56,  0 users,  load average: 0.15, 1.8, 0.22</pre>
<h2>Web-Based Alternative</h2>
If you are looking for web-based service which does things like this, you may try <a href="https://commando.io/">https://commando.io/</a>.  It has some really nice features and a free plan for 2 users.