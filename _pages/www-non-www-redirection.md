---
ID: 23903
post_title: >
  Nginx config for www to non-www and
  non-www to www redirection
author: Rahul Bansal
post_excerpt: 'There are many ways to force Nginx to use either www or non-www version your site. This article provides config for a clean & optimzed way'
layout: page
permalink: >
  https://easyengine.io/tutorials/nginx/www-non-www-redirection/
published: true
post_date: 2013-02-21 22:01:15
---
There are many ways to force Nginx to use either WWW version or non-WWW version of URLs for your site.

We use following codes all the time.
<h2>Redirect non-www to WWW</h2>
<h3>Single domain</h3>
<pre class="nginx">server {
        server_name example.com;
        return 301 $scheme://www.example.com$request_uri;
}</pre>
<h3>All domains</h3>
<pre class="nginx">server {
        server_name "~^(?!www\.).*" ;
        return 301 $scheme://www.$host$request_uri;
}</pre>
<h2>From WWW to non-WWW</h2>
<h3>Single domain</h3>
<pre class="nginx">server {
        server_name www.example.com;
        return 301 $scheme://example.com$request_uri;
}</pre>
<h3>All domains</h3>
<pre class="nginx">server {
         server_name "~^www\.(.*)$" ;
         return 301 $scheme://$1$request_uri ;
}</pre>
In both cases, for other-www, we create a altogether different <code>server { }</code> block. IMHO, this is cleanest and optimised way to handle www to non-www and non-www to www redirection.

There are some WordPress plugins available there which can handle this at PHP-level. But for performance reason, always handle things in Nginx, that can be handled in Nginx alone! ;-)