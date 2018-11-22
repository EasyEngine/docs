---
ID: 44896
post_title: Block wp-login.php bruteforce attack
author: Rahul Bansal
post_excerpt: |
  Blocking bruteforce attack on WordPress's wp-login.php using Nginx's Limit Request Module. Also includes whitelisting of IP example and test-cases.
  
  This works without any WordPress plugin.
layout: page
permalink: >
  https://easyengine.io/tutorials/nginx/block-wp-login-php-bruteforce-attack/
published: true
post_date: 2013-08-23 15:32:21
---
Last night, a site in our managed-hosting network was under attack.

Following config thwarted the bruteforce attack successfully using <a href="http://wiki.nginx.org/HttpLimitReqModule">Nginx's Limit Req Module</a>.
<h2>Nginx Settings</h2>
<h3>Global Settings</h3>
In <code>/etc/nginx/nginx.conf</code> file under <code>http{..}</code> block, add following
<pre class="nginx">limit_req_zone $binary_remote_addr zone=one:10m rate=1r/s;</pre>
10m is size of zone. 1MB can hold 16000 states. I <em>think</em> this means 16000 unique IP addresses. In case you have way too many sites or very high traffic sites, you may want to increase it to 20MB or 100MB.

1r/s means 1 request per second is allowed. You cannot specify fractions. If you want to slowdown further, means less requests per second try 30r/m which means 30 requests per min, effectively 1 request per 2 second.
<h3>Per Site Setting</h3>
You can add something like below to server{..} block:
<pre class="no-highlight">location = /wp-login.php {
    limit_req   zone=one  burst=1 nodelay;
    include fastcgi_params;
    fastcgi_pass 127.0.0.1:9000;
}</pre>
OR
<pre class="no-highlight">location ~ \.php$ {
    location ~* wp\-login\.php {
        limit_req   zone=one  burst=1 nodelay;
        include fastcgi_params;
        fastcgi_pass 127.0.0.1:9000;
    }
    #other rules
}</pre>
<code>nodelay</code> makes sure as soon as request limit exceeds, HTTP status code 503 (Service Unavailable) is returned.
<h3>Protecting other areas</h3>
On same lines you can protect other area as well. e.g. your contact form.

If you have contact form on every page, then may be you can add location of form's action handler URL.
<h3>Other Changes</h3>
In case you want to return 444 (recommended) or any other code use following in <code>http {..}</code> block for global effect or with <code>location {..}</code> block for local-effect:
<pre class="no-highlight">limit_req_status 444;</pre>
You can server custom error page using <code>error_page</code> directive.
<h2>Test</h2>
<h4>Logs</h4>
Use following command to monitor logs. Replace 503 with any other error code if you are using <code>limit_req_status</code>
<pre class="bash">tail -f /var/www/example.com/logs/*.log | egrep "login|503"</pre>
If your site is already under attack, you will see lines like below:
<pre class="no-highlight">2013/08/23 04:17:03 [error] 256554#0: *99927 limiting requests, excess: 1.852 by zone "one", client: 1.2.3.4, server: example.com, request: "GET /wp-login.php HTTP/1.0", host: "exmaple.com"</pre>
1.2.3.4  is blocked IP.
<h4>Simulate Attack</h4>
You can use apache-bench to attack server:
<pre class="no-highlight">ab -n 100 -c 10 example.com/wp-login.php</pre>
<h2>Other Notes</h2>
<h3>Whitelisting IP addresses</h3>
For wp-login example in this article you won't need whitelisting as a real-human has no business to send multiple requests to wp-login.php at any moment.

Still, for some other purpose you may need to whitelist IP addresses.

In <code>/etc/nginx/nginx.conf</code> file under <code>http{..}</code> block, add a <code>map{..}</code> block like below:
<pre class="no-highlight">map $remote_addr $rt_filtered_ip {
        default $binary_remote_addr;
        1.2.3.4 "";
        4.4.4.4 "";
}</pre>
1.2.3.4 and 4.4.4.4 are example of whitelisted IP's. You can have any number of them. Add every IP on separate line. Make sure you use "" in second column for every IP. rate limit module ignores empty values.

Then you need to use variable <code>$rt_filtered_ip</code>
<pre class="no-highlight">limit_req_zone $rt_filtered_ip zone=one:10m rate=1r/s;</pre>
Above simple method may not work if you want to whitelist a range of IP's. For which you need to <a href="http://wiki.nginx.org/HttpGeoModule">geo module</a>.
<pre class="no-highlight">geo $rt_filtered_ip {
    default        $binary_remote_addr;

    127.0.0.1      "";
    192.168.1.0/24 "";
    10.1.0.0/16    "";

    ::1            "";
    2001:0db8::/32 "";

    1.2.3.4        ""
}</pre>
<p class="rtp-alert"><strong>Important:</strong> We haven't tested geo-module example. So use at your risk.</p>