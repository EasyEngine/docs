---
ID: 74355
post_title: clean
author: Harshad Yeola
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/docs/commands/clean/
published: true
post_date: 2014-10-10 20:13:13
---
<div class="entry-content">

Clean NGINX FastCGI cache, Opcacache, Memcache
<pre><code>ee clean
</code></pre>
clean fastgi cache by default.
<h2 id="clean-fastcgi-cache">Clean FastCGI cache</h2>
<pre><code>ee clean --fastcgi
</code></pre>
<h2 id="clean-memcache">Clean Memcache</h2>
<pre><code>ee clean --memcache
</code></pre>
<h2 id="clean-opcache">Clean OPcache</h2>
<pre><code>ee clean --opcache
</code></pre>
<h2 id="clean-pagespeed-cache">Clean Pagespeed cache</h2>
<pre><code>ee clean --pagespeed
</code></pre>
<h2 id="clean-redis-cache">Clean Redis cache</h2>
<pre><code>ee clean --redis
</code></pre>
<h2 id="clean-fastcgi-memcache-opcache-and-pagespeed-cache">Clean FastCGI, Memcache, OPcache and PageSpeed cache</h2>
<pre><code>ee clean --all</code></pre>
</div>