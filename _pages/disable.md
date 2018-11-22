---
ID: 131079
post_title: disable
author: Dinesh Jain
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/docs/commands/site/disable/
published: true
post_date: 2015-11-23 12:15:37
---
It will disable site by removing symbolic link example.com in <code>/etc/nginx/sites-enabled/example.com</code>to <code>/etc/nginx/sites-available/example.com</code>
<pre><code>ee site disable example.com</code></pre>