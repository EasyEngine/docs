---
ID: 39362
post_title: >
  Parsing access.log and error.logs using
  linux commands
author: Rahul Bansal
post_excerpt: >
  Parsing access.log and error.logs using
  awk, cut, sort, uniq and other linux
  commands. Can help you uncover broken
  links, hacking attempts, etc
layout: page
permalink: >
  https://easyengine.io/tutorials/nginx/log-parsing/
published: true
post_date: 2013-07-20 16:30:27
---
<h2>Access logs</h2>
We are using following format, which is also default nginx format named "combined":
<pre class="no-highlight">$remote_addr - $remote_user [$time_local] "$request" $status $body_bytes_sent "$http_referer" "$http_user_agent"</pre>
Explanation of fields is as follows:
<ul>
	<li>$remote_addr - IP from which request was made</li>
	<li>$remote_user - HTTP Authenticated User. This will be blank for most apps as modern apps do not use HTTP-based authentication.</li>
	<li>[$time_local] - timestamp as per server timezone</li>
	<li>"$request" - HTTP request type GET, POST, etc + requested path without args + HTTP protocol version</li>
	<li>$status - HTTP response code from server</li>
	<li>$body_bytes_sent - size of server response in bytes</li>
	<li>"$http_referer" - Referral URL (if present)</li>
	<li>"$http_user_agent" - User agent as seen by server</li>
</ul>
Lets explore some commands which can help us analyse logs.
<h3>Sort access by Response Codes</h3>
<pre class="bash">cat access.log | cut -d '"' -f3 | cut -d ' ' -f2 | sort | uniq -c | sort -rn</pre>
Sample Output:
<pre class="no-highlight"> 210433 200
  38587 302
  17571 304
   4544 502
   2616 499
   1144 500
    706 404
    355 504
    355 301
    252 000
      9 403
      6 206
      2 408
      2 400</pre>
Same thing can be done using <code>awk</code>:
<pre class="no-highlight">awk '{print $9}' access.log | sort | uniq -c | sort -rn</pre>
Sample Output:
<pre class="no-highlight"> 210489 200
  38596 302
  17572 304
   4544 502
   2616 499
   1144 500
    706 404
    355 504
    355 301
    252 000
      9 403
      6 206
      2 408
      2 400</pre>
As you can see it log says more than 700 requests were returned 404!
<h4>Lets find out which links are broken now?</h4>
Following will search for requests which resulted in 404 response and then sort them by number of requests per URL. You will get most visited 404 pages.
<pre class="no-highlight">awk '($9 ~ /404/)' access.log | awk '{print $7}' | sort | uniq -c | sort -rn</pre>
For <a href="https://easyengine.io/easyengine">easyengine</a>, use instead:
<pre class="no-highlight">awk '($8 ~ /404/)' access.log | awk '{print $8}' | sort | uniq -c | sort -rn</pre>
Sample Output (truncated):
<pre class="no-highlight">  21 /members/katrinakp/activity/2338/
  19 /blogger-to-wordpress/robots.txt
  14 /rtpanel/robots.txt</pre>
Similarly, for 502 (bad-gateway) we can run following command:
<pre class="no-highlight">awk '($9 ~ /502/)' access.log | awk '{print $7}' | sort | uniq -c | sort -r</pre>
Sample Output (truncated):
<pre class="no-highlight">    728 /wp-admin/install.php
    466 /
    146 /videos/
    130 /wp-login.php</pre>
<h4>Who are requesting broken links (or URLs resulting in 502)</h4>
<pre class="no-highlight">awk -F\" '($2 ~ "/wp-admin/install.php"){print $1}' access.log | awk '{print $1}' | sort | uniq -c | sort -r</pre>
Sample Output:
<pre class="no-highlight">     14 50.133.11.248
     12 97.106.26.244
     11 108.247.254.37
     10 173.22.165.123</pre>
<strong>404 for php files - mostly hacking attempts</strong>
<pre>awk '($9 ~ /404/)' access.log | awk -F\" '($2 ~ "^GET .*\.php")' | awk '{print $7}' | sort | uniq -c | sort -r | head -n 20</pre>
<h3>Most requested URLs</h3>
<h4>Most requested URLs</h4>
<pre class="no-highlight">awk -F\" '{print $2}' access.log | awk '{print $2}' | sort | uniq -c | sort -r</pre>
<h4>Most requested URLs containing XYZ</h4>
<pre class="no-highlight">awk -F\" '($2 ~ "ref"){print $2}' access.log | awk '{print $2}' | sort | uniq -c | sort -r</pre>
<strong>Useful: </strong><a href="https://easyengine.io/wordpress-nginx/tutorials/nginx/tweaking-fastcgi-buffers/">Tweaking fastcgi-buffers using access logs</a>

<strong>Recommended Reading: </strong><a href="http://www.the-art-of-web.com/system/logs/">http://www.the-art-of-web.com/system/logs/</a> - explains log parsing very nicely.

&nbsp;