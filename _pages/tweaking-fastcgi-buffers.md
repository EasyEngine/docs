---
ID: 43356
post_title: Tweaking fastcgi-buffers
author: Rahul Bansal
post_excerpt: "Practical way to tweak Nginx's fastcgi-buffers to based on response-size analysis based on real access.log"
layout: page
permalink: >
  https://easyengine.io/tutorials/nginx/tweaking-fastcgi-buffers/
published: true
post_date: 2013-07-26 21:45:00
---
Following can help you tweak <a href="http://wiki.nginx.org/HttpFastcgiModule#fastcgi_buffers">fastcgi_buffers</a> size &amp; numbers.
<h4>Maximum Response Size</h4>
<pre>awk '($9 ~ /200/)' access.log  | awk '{print $10}' | sort -nr | head -n 1</pre>
Please note we taking HTTP 200 OK response only into consideration.
<h4>Average Response Size</h4>
<pre>echo $(( `awk '($9 ~ /200/)' access.log | awk '{print $10}' | awk '{s+=$1} END {print s}'` / `awk '($9 ~ /200/)' access.log  | wc -l` ))</pre>
Based on above result, for rtCamp.com we found following values:
<pre>Avg. 24807
Max. 629622</pre>
So we are using:
<pre>fastcgi_buffers 32 32k;
fastcgi_buffer_size 32k;</pre>
<strong>Related: </strong><a href="https://easyengine.io/wordpress-nginx/tutorials/nginx/log-parsing/">Nginx Log Parsing Examples</a>