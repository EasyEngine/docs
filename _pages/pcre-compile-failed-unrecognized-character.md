---
ID: 49548
post_title: 'Error: pcre_compile() failed: unrecognized character after'
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/nginx/troubleshooting/pcre-compile-failed-unrecognized-character/
published: true
post_date: 2013-10-24 17:40:15
---
When using named capture, if PCRE library is old, Nginx config won't support lines like below:
<pre class="no-highlight">~^(?&lt;blogpath&gt;/[_0-9a-zA-Z-]+/)files/(.*)</pre>
Rather than getting $blogpath in named capture, you will get error like:
<pre class="no-highlight">nginx: [emerg] pcre_compile() failed: unrecognized character after (?&lt; in "^(?/[_0-9a-zA-Z-]+/)files/(.*)” at “blogpath&gt;/[_0-9a-zA-Z-]+/)files/(.*)” in /etc/nginx/conf.d/my.conf:2</pre>
<h3>Solution</h3>
Replace <code>?</code> with <code>?P</code>
So above line should be rewritten as:
<pre class="no-highlight">~^(?P&lt;blogpath&gt;/[_0-9a-zA-Z-]+/)files/(.*)</pre>
You can notice there is a <code>P</code> between <code>?</code> and <code>&lt;</code>