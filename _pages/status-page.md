---
ID: 38182
post_title: Enable Nginx Status Page
author: Rahul Bansal
post_excerpt: "Nginx status page can give realtime data about Nginx's health. It can help you tweak few Nginx config. Status data can be used in load-balancer env also."
layout: page
permalink: >
  https://easyengine.io/tutorials/nginx/status-page/
published: true
post_date: 2013-06-11 15:49:04
---
Nginx status page can give realtime data about Nginx's health. It can help you tweak few Nginx config. Status data can be used in load-balancer env also.
<h3>Requirement</h3>
Nginx must be compiled with <a href="http://wiki.nginx.org/HttpStubStatusModule">HttpStubStatusModule</a> module. You can check that by running following command:
<pre class="no-highlight">nginx -V 2&gt;&amp;1 | grep -o with-http_stub_status_module</pre>
If you see following output, you are good to go ahead. Otherwise, <a href="https://easyengine.io/wordpress-nginx/tutorials/ubuntu-php-apc-mysql-postfix/">refer this post to install nginx-full</a>.
<pre class="no-highlight">with-http_stub_status_module</pre>
<h3>Nginx Config</h3>
You need to add following to a nginx site, say <code>example.com</code>, inside <code>server {..}</code> block.
<pre class="no-highlight">        location /nginx_status {
          stub_status on;
          access_log   off;
          allow 1.1.1.1;
          deny all;
        }</pre>
Make sure you replace 1.1.1.1 with your machine's IP-address. It's good idea to keep this page accessible to only you.
<h4>Output:</h4>
Once you codes and reload nginx config, just visit: http://example.com/nginx_status You will see output like below:
<pre class="no-highlight">Active connections: 43 
server accepts handled requests
 7368 7368 10993 
Reading: 0 Writing: 5 Waiting: 38</pre>
<h4>Interpretation</h4>
<ul>
	<li><strong>Active connections</strong> – Number of all open connections. This doesn't mean number of users. A single user, for a single pageview can open many concurrent connections to your server.</li>
	<li><strong>Server accepts handled requests</strong> – This shows three values.
<ul>
	<li>First is total <em>accepted</em> connections.</li>
	<li>Second is total <em>handled</em> connections. Usually first 2 values are same.</li>
	<li>Third value is number of and handles <em>requests. </em>This is usually greater than second value.</li>
	<li>Dividing third-value by second-one will give you number of requests per connection handled by Nginx. In above example, 10993/7368, <strong>1.49 requests per connections</strong>.</li>
</ul>
</li>
	<li><strong>Reading</strong> – nginx reads request header</li>
	<li><strong>Writing</strong> – nginx reads request body, processes request, or writes response to a client</li>
	<li><strong>Waiting</strong> – keep-alive connections, actually it is <code>active – (reading + writing).</code>This value depends on <a href="http://wiki.nginx.org/HttpCoreModule#keepalive_timeout">keepalive-timeout</a>. Do not confuse non-zero waiting value for poor performance. It can be ignored. Although, you can force zero waiting by setting <code>keepalive_timeout 0;</code></li>
</ul>