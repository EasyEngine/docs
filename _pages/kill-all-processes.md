---
ID: 63482
post_title: >
  kill all php, nginx, mysql or any kind
  of processes
author: Rahul Bansal
post_excerpt: >
  kill all php, nginx, mysql or any kind
  of processes using kill, grep and awk
  command in one go! Useful on linux
  servers in case of emergency
layout: page
permalink: >
  https://easyengine.io/tutorials/linux/kill-all-processes/
published: true
post_date: 2014-04-08 23:28:08
---
<em><strong>Important: </strong>This should be used in case of emergency only. </em>

Just one line...
<h2>To kill all PHP Processes</h2>
<pre class="no-highlight">kill $(ps aux | grep '[p]hp' | awk '{print $2}')</pre>
<h2>To kill all Nginx Processes</h2>
<pre class="no-highlight">kill $(ps aux | grep '[n]ginx' | awk '{print $2}')</pre>
<h2>To kill all MySQL Processes</h2>
<pre class="no-highlight">kill $(ps aux | grep '[m]ysql' | awk '{print $2}')</pre>
You can kill any other type of processes as well. Just make sure you replace <code>[p]hp</code> with name of that process. Remember to keep first letter in bracket.