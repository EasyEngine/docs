---
ID: 63489
post_title: Serving fonts with correct mime types
author: Rahul Bansal
post_excerpt: |
  Nginx solution for  "Resource interpreted as Font but transferred with MIME type font/x-woff" and "Resource interpreted as Font but transferred with MIME type font/font-woff"
layout: page
permalink: >
  https://easyengine.io/tutorials/nginx/woff-fonts-mime-type/
published: true
post_date: 2014-04-08 23:48:01
---
<em><strong>Update:</strong> <a href="http://trac.nginx.org/nginx/ticket/292">This was added in nginx 1.3 officially</a>. You may still use this article if mime.types file is not uptodate on your nginx-server.</em>

On a nginx site, for font files, especially <code>woff</code> version, we ran into issues.

Browser console was showing warnings like:
<pre>Resource interpreted as Font but transferred with MIME type font/x-woff
Resource interpreted as Font but transferred with MIME type font/font-woff</pre>
<h2>Solution</h2>
Open <code>/etc/nginx/mime.types</code>

Add following lines in it:
<pre class="no-highlight">application/font-woff           woff; 
application/x-font-woff         woff;</pre>
Save file.

Reload nginx. (<code>service nginx reload</code>)