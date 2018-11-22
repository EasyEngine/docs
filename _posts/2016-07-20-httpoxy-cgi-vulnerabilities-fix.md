---
ID: 141191
post_title: HTTPoxy CGI Vulnerabilities Fix
author: Prabuddha
post_excerpt: 'EasyEngine security update to fix httpoxy - a set of vulnerabilities that affects PHP/CGI applications that rely on HTTP_PROXY header'
layout: post
permalink: >
  https://easyengine.io/blog/httpoxy-cgi-vulnerabilities-fix/
published: true
post_date: 2016-07-20 14:02:21
---
A serious vulnerability was recently discovered based on how Linux uses CGI script execution for PHP, Python, Go and other scripting language.

<a href="https://httpoxy.org/">httpoxy</a> is the name given to a set of vulnerabilities that affect application code running in CGI, or CGI-like environments. The vulnerability allows an attacker to remotely set the HTTP_PROXY environment variable on affected servers which can lead to a number of bad consequences.

Best advice is to patch as soon as possible as Linux vendors have started releasing patches. But immediate mitigation before patching can be performed by blocking ‘Proxy’ request headers as early as possible before they hit your application. <a href="https://httpoxy.org/">httproxy.org</a> has this spelled out in detail for Nginx/FastCGI and others web servers.
<h2>For EasyEngine users</h2>
Just run  <code>ee update</code> command and it will take care of blocking proxy request header.

We also updated our custom Nginx builds which has necessary patch.

Either way, you will get same result so you better go ahead with <code>ee update.</code>

<strong>Link:</strong> <a href="https://github.com/EasyEngine/easyengine/releases/tag/v3.7.2">EasyEngine v3.7.2 Release</a>