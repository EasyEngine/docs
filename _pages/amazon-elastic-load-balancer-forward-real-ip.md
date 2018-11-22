---
ID: 51030
post_title: >
  Amazon Elastic Load Balancer and
  Forwarding Real-IP Nginx
author: Rahul Bansal
post_excerpt: >
  Forwarding real-IP, client-IP,
  visitor-IP address to Nginx on EC2
  instances, running behind Amazon Elastic
  Load Balancer
layout: page
permalink: >
  https://easyengine.io/tutorials/nginx/amazon-elastic-load-balancer-forward-real-ip/
published: true
post_date: 2013-11-21 11:28:37
---
This article is for Amazon AWS only. For forwarding visitor real IP in nginx proxy setup, <a href="https://easyengine.io/tutorials/nginx/forwarding-visitors-real-ip/">check this</a>.

If you are running nginx on Amazon EC2 instance, behind Amazon Elastic Load Balancer (ELB), for any IP-specific nginx config and/or applicaiton code to work, you need to do following:

Open <code>/etc/nginx/nginx.conf</code> file

Add following inside <code>http {..}</code> block
<pre>real_ip_header X-Forwarded-For;
set_real_ip_from 0.0.0.0/0;</pre>
Then just reload nginx for change to take effect.
<h3>Security Consideration:</h3>
If your nginx EC2 instance can be accessed directly, apart from traffic coming through Elastic Load Balancer, then its better to change:
<pre>set_real_ip_from 0.0.0.0/0;</pre>
to fixed IP address assigned to Elastic Load Balancer.

If IP address for ELB is 1.2.3.4, then it should look like:
<pre>set_real_ip_from 1.2.3.4;</pre>