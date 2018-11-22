---
ID: 25110
post_title: >
  Moving WordPress from Subdomain To Root
  Domain
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/wordpress-nginx/tutorials/move-wordpress-subdomain-to-root-domain/
published: true
post_date: 2010-05-19 08:31:24
---
If you have a blog at http://blog.example.com/ and you want to move it to WordPress at - http://example.com/

You can put following htaccess rewrite rules on blog.example.com
<pre>RewriteEngine On
RewriteRule ^(.*)$ http://example.com/$1 [R=301,L]</pre>
If you want blog homepage to redirect to - http://example.com/blog/ (you will need this if http://example.com/ has a static-homepage) then you can try following:
<pre>RewriteEngine On
RewriteRule ^/?$    http://example.com/blog/    [R=301,L]
RewriteRule ^(.*)$ http://example.com/$1 [R=301,L]</pre>
For other way round, <a href="http://devilsworkshop.org/tutorial/moving-a-wordpress-blog-from-a-subdirectory-to-subdomain-preserving-permalinks/1616/">refer to moving a WordPress blog from subdirectory to subdomain</a>.