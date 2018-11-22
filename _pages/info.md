---
ID: 46871
post_title: info
author: Naweed Chougle
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/docs/commands/info/
published: true
post_date: 2013-09-25 19:21:58
---
This command will show you the information related to Nginx and PHP. You need to log in as root user and run this command.
<h2 id="nginx-info">NGINX Info</h2>
<pre><code>ee info --nginx
</code></pre>
Output will look like:
<pre><code>NGINX (1.6.0):
user				 www-data
worker_processes		 auto
worker_connections		 4096
keepalive_timeout		 30
fastcgi_read_timeout		 300
client_max_body_size		 100m
allow				 127.0.0.1
</code></pre>
<h1 id="php-info">PHP Info</h1>
<pre><code>ee info --php
</code></pre>
Output will look like this:
<pre><code>PHP (5.5.14-2):
user				 www-data
expose_php			 Off
memory_limit			 128M
post_max_size			 100M
upload_max_filesize		 100M
max_execution_time		 300

Information about www.conf
ping.path			 /ping
pm.status_path			 /status
process_manager			 ondemand
pm.max_requests			 500
pm.max_children			 100
pm.start_servers		 20
pm.min_spare_servers		 10
pm.max_spare_servers		 30
request_terminate_timeout	 300
xdebug.profiler_enable_trigger	 off
listen				 127.0.0.1:9000

Information about debug.conf
ping.path			 /ping
pm.status_path			 /status
process_manager			 ondemand
pm.max_requests			 500
pm.max_children			 100
pm.start_servers		 20
pm.min_spare_servers		 10
pm.max_spare_servers		 30
request_terminate_timeout	 300
xdebug.profiler_enable_trigger	 on
listen				 127.0.0.1:9001
</code></pre>
<h1 id="mysql-info">MySQL Info</h1>
<pre><code>ee info --mysql
</code></pre>
Output will look like this:
<pre><code>MySQL (5.5.37):
user				 root
port				 3306
wait_timeout			 30
interactive_timeout		 60
max_used_connections		 1/151
datadir				 /var/lib/mysql/
socket				 /var/run/mysqld/mysqld.sock
</code></pre>
<h1 id="all-info">All info</h1>
To view all commands output together use
<pre><code>ee info</code></pre>