---
ID: 191
post_title: '[Solution] Nginx [emerg]: bind() to 0.0.0.0:80 failed (13: Permission denied)'
author: Rahul Bansal
post_excerpt: 'Solution for Nginx error "[emerg]: bind() to 0.0.0.0:80 failed (13: Permission denied)"'
layout: page
permalink: >
  https://easyengine.io/wordpress-nginx/troubleshooting/nginx-emerg-bind-failed-13-permission-denied/
published: true
post_date: 2012-05-02 17:34:42
---
I installed nginx using homebrew on my Mac Snow Leopard 10.6.

I was getting following my error:
<p class="rtp-alert">02/12/10 1:18:45 PM org.nginx[1651] [emerg]: bind() to 0.0.0.0:80 failed (13: Permission denied)</p>

<h3>Solution</h3>
Homebrew creates a nginx startup config file at <code>~/Library/LaunchAgents/org.nginx.plist</code>

I moved it to <code>/System/Library/LaunchDaemons/org.nginx.plist</code>

Difference is when Nginx started from <code>~/Library/LaunchAgents</code>, it started under a normal user account but when it started from <code>/System/Library/LaunchDaemons/</code> is started under root account.

If above doesn't fix your issue, you can open <code>org.nginx.plist</code> and check if it contains a key-value pair like below:
<pre><code>&lt;key&gt;UserName&lt;/key&gt;
&lt;string&gt;rahul286&lt;/string&gt;
</code></pre>
Replace <code>rahul286</code> with you UserName. You can find your username by running <code>$whoami</code>command.