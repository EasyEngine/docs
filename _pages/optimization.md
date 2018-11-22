---
ID: 13985
post_title: Optimizing Nginx Configuration
author: Rahul Bansal
post_excerpt: 'Optimizing nginx ny tweaking worker_processes, keepalive_timeout, worker_connections, server_names_hash_max_size & server_names_hash_bucket_size directives'
layout: page
permalink: >
  https://easyengine.io/tutorials/nginx/optimization/
published: true
post_date: 2012-09-27 20:49:19
---
<img class="alignright size-full wp-image-10804" title="wordpress-nginx" alt="" src="https://easyengine.io/wp-content/uploads/2012/09/wordpress-nginx.jpeg" width="220" height="91" />Nginx needs least tweaking as compared to PHP &amp; MySQL.

Still to get the most out of Nginx, you can tweak few directives in <code>/etc/nginx/nginx.conf</code>
<h4>worker_processes</h4>
This is very important. It controls number of worker processes Nginx is running.

Set <code>worker_processes = number of processors</code> in your system.

To find out how many processors you have on your server, run the following command:
<pre>grep processor /proc/cpuinfo | wc -l</pre>
It will display a number only:
<pre>32</pre>
Set that number as value for<code>worker_processes</code> directive.
<h4>worker_connections</h4>
If you are running very high traffic sites, its better to increase value of <code>worker_connections</code>. Default is 768.

Theoretically, nginx can handle <code>max clients = worker_processes * worker_connections</code>

We use <code>worker_connections = 10240</code>
<h4>worker_rlimit_nofile</h4>
Increase number of files opened by<code>worker_process</code>.

This directive is not present by default. You can add it in <code>/etc/nginx/nginx.conf</code> in main section (below<code>worker_processes</code>)

We use <code>worker_rlimit_nofile 100000;</code>
<h4>keepalive_timeout</h4>
I have come across many definitions for this. Apart from traffic, response time of FASTCGI backed application is a factor to be considered while tweaking this directive. Its default is 65 or 75 seconds.

We use <code>keepalive_timeout = 30s</code>
<h3>Rarely Used</h3>
Following two directives need tweaking in rarely. When the time is right, Nginx, itself, will tell you to make a change! ;-)

Nginx will throw a friendly error like below:
<pre class="rtp-alert">Reloading nginx configuration: nginx: [emerg] could not build the server_names_hash, you should increase either server_names_hash_max_size: 512 or server_names_hash_bucket_size: 64</pre>
<h4>server_names_hash_bucket_size</h4>
When you have a domain name longer than 64-chars, you will need it.

By default, its value is 64. If you have a domain 80-chars wide, do not set it to 80. Instead use next value of multiple of 2.  That means 128, 256 and so on.
<h4>server_names_hash_max_size</h4>
Its default value is 512. If you are hosting hundreds of sites on your server.

Nginx suggests, you can change either<code>server_names_hash_max_size</code> or<code>server_names_hash_bucket_size</code> to accomodate large number of sites, but I prefer keeping<code>server_names_hash_bucket_size</code> as it is and making<code>server_names_hash_max_size</code> big in multiple of 2's till error disappears.

On a server, where we host 300+ sites, we needed to change it to <strong>8192</strong>!

I used a trick to find out correct size by using following command:
<pre>ls /etc/nginx/sites-available/ | wc -c</pre>
Above command list of enabled sites' name which I pass to<code>wc</code> command to get number of total characters all<code>server_name</code> are using together. In my case, above command returned 7414, for which next 2's multiple value is 8192.

In each site config, I was using only 1<code>server_name</code> without any wildcard or regex. I guess wildcard &amp; regex will also affect value of <code>server_names_hash_max_size</code> .
<h4>WordPress Multi-site Subdomain/Domain-Mapping &amp; server_name hashing</h4>
As you know, you can host millions of subdomains/domain-mapping using a WordPress multisite setup. But as far as my experience goes, it doesn't put any load on Nginx's server_name hashing.
<h4>More...</h4>
<ul>
	<li><a title="Maintaining, Optimizing &amp; Debugging WordPress-Nginx Setup" href="https://easyengine.io/tutorials/maintaining-optimizing-debugging-wordpress-nginx-setup/">Maintaining, Optimizing &amp; Debugging WordPress-Nginx Setup</a></li>
</ul>