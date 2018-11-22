---
ID: 64749
post_title: fail2ban
author: Rahul Bansal
post_excerpt: |
  Using Nginx's Limit Req Module and fail2ban together to thwart DDOS attacks on server.
layout: page
permalink: >
  https://easyengine.io/tutorials/nginx/fail2ban/
published: true
post_date: 2014-04-28 18:01:48
---
Recently one of our client server was subjected to DDOS attack. We use <a href="http://wiki.nginx.org/HttpLimitReqModule">Nginx's Limit Req Module</a> and <a href="http://www.fail2ban.org/">fail2ban</a> together to thwart this attack.
<h2>Installing fail2ban</h2>
On Ubuntu/Debian, just run...
<pre class="no-highlight">apt-get install fail2ban</pre>
<h2>Configuration</h2>
There are 2 parts. First, we need to configure nginx to limit number of requests for IP addresses. Nginx will log info about banned IP into error log. fail2ban will parse nginx error log and ban offending IP addresses.
<h3>Nginx configuration</h3>
Please follow this post for <a href="https://rtcamp.com/tutorials/nginx/block-wp-login-php-bruteforce-attack/">nginx config</a> part.
<h3>fail2ban Configuration</h3>
<h4>filter config</h4>
Create a nginx filter file:
<pre class="no-highlight">vim /etc/fail2ban/filter.d/nginx-req-limit.conf</pre>
Add following content in it:
<pre class="no-highlight"># Fail2Ban configuration file
#
# supports: ngx_http_limit_req_module module

[Definition]

failregex = limiting requests, excess:.* by zone.*client: &lt;HOST&gt;

# Option: ignoreregex
# Notes.: regex to ignore. If this regex matches, the line is ignored.
# Values: TEXT
#
ignoreregex =</pre>
<h4>jail config</h4>
Create a new jail config in:
<pre class="no-highlight">vim /etc/fail2ban/jail.local</pre>
If you don't see <code>jail.local</code>, simply run:
<pre class="no-highlight">cp /etc/fail2ban/jail.conf /etc/fail2ban/jail.local</pre>
Add following towards end:
<pre class="no-highlight">[nginx-req-limit]

enabled = true
filter = nginx-req-limit
action = iptables-multiport[name=ReqLimit, port="http,https", protocol=tcp]
logpath = /var/log/nginx/*error.log
findtime = 600
bantime = 7200
maxretry = 10</pre>
<code>findtime</code> and <code>maxretry</code> values are important. Together, they decides how often offending IP's gets banned. If you make these values smaller, IP's will get banned more often. Tweak as per your need.

After saving both config files, restart fail2ban using:
<pre class="no-highlight">service fail2ban restart</pre>
<h2>Testing</h2>
Before you exit from shell, it's better to make sure if fail2ban is working.
<h3>fail2ban logs</h3>
You can monitor fail2ban log file:
<pre class="no-highlight">tail -f /var/log/fail2ban.log</pre>
You will see lines like below:
<pre class="no-highlight">2014-04-28 14:16:02,840 fail2ban.actions: WARNING [nginx-req-limit] Ban 95.211.117.202
2014-04-28 14:16:02,848 fail2ban.actions: WARNING [nginx-req-limit] Ban 78.187.45.204
2014-04-28 14:16:03,857 fail2ban.actions: WARNING [nginx-req-limit] 78.187.45.204 already banned
2014-04-28 14:17:36,952 fail2ban.actions: WARNING [nginx-req-limit] Ban 91.216.201.114</pre>
If you don't see anything that means either misconfiguration or nothing to worry at all. If you think there is something to worry, jump to debugging section below.
<h3>fail2ban-client</h3>
You can also use fail2ban-client to find out status of a particular jail using following command:
<pre class="no-highlight">fail2ban-client status nginx-req-limit</pre>
This will show:
<pre class="no-highlight">Status for the jail: nginx-req-limit
|- filter
|  |- File list:	/var/log/nginx/test.com.error.log /var/log/nginx/example.com.error.log
|  |- Currently failed:	6
|  `- Total failed:	389
`- action
   |- Currently banned:	3
   |  `- IP list:	95.211.117.202 78.187.45.204 91.216.201.114 
   `- Total banned:	3</pre>
As you can see there are 3 IP's in jail.
<h2>Debugging</h2>
If things are not working as expected, you can debug fail2ban config.
<h3>Check debug output</h3>
Run following command to see config used by fail2ban-server:
<pre class="no-highlight">fail2ban-client -d</pre>
<h3>Debug filter</h3>
Run following command to see if fail2ban filter works for  a particular log file:
<pre class="no-highlight">fail2ban-regex /var/log/nginx/example.com.error.log  /etc/fail2ban/filter.d/nginx-req-limit.conf</pre>
Output will contain something like following <em>(towards end)</em>:
<pre class="no-highlight">Success, the total number of match is 861
</pre>
If there are zero match then there could be an issue with regex filter.