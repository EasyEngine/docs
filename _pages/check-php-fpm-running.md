---
ID: 40446
post_title: Check if php-fpm is running
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/wordpress-nginx/troubleshooting/check-php-fpm-running/
published: true
post_date: 2013-06-21 20:41:53
---
Sometimes php-fpm may refuse to start.

Chances are high that it is already running.

You can see activity on port 9000 using following command (assuming fpm is bind 9000 tcp/ip port)
<pre class="no-highlight">netstat -an | grep :9000</pre>
If you have nmap package installed, you can alternatively use it:
<pre class="no-highlight">nmap localhost -p 9000</pre>