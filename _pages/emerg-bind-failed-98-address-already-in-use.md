---
ID: 40443
post_title: '[emerg]: bind() to 0.0.0.0:80 failed (98: Address already in use)'
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/nginx/troubleshooting/emerg-bind-failed-98-address-already-in-use/
published: true
post_date: 2013-06-21 20:37:34
---
If you get following error, when you try to start nginx...
<p class="rtp-error">[emerg]: bind() to 0.0.0.0:80 failed (98: Address already in use)</p>
Then it means nginx or some other process is already using port 80.

You can kill it using:
<p class="rtp-success">sudo fuser -k 80/tcp</p>
And then try restarting nginx again:
<pre class="no-highlight">service nginx start</pre>