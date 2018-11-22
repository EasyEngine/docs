---
ID: 132521
post_title: 'Let&#8217;s Encrypt with EasyEngine'
author: Gaurav
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/nginx/letsencrypt/
published: true
post_date: 2015-12-04 17:41:21
---
<strong>UPDATE: If you are using EasyEngine v3.4+ then you can configure letsencrypt certificate with one command. Please check the  <a href="https://easyengine.io/docs/lets-encrypt/" target="_blank">Let's Encrypt Command</a>.</strong>

<strong>First make sure that your site is live and running on same server on which you are running <em>Let's Encrypt</em> Client to allow it to verify the site automatically.</strong>

First allow <em>.well-known</em> directory to be reachable in EasyEngine.
<pre><code>vim /etc/nginx/common/locations.conf
</code></pre>
and add the following code immediately after the <em># Deny hidden files</em> lines.
<pre><code># Deny hidden files
location ~ /\.well-known {
  allow all;
}</code></pre>
After this step, reload Nginx configuration.
<pre><code>nginx -t &amp;&amp; service nginx reload</code></pre>
Now download <em>Let's Encrypt</em> Client.
<pre><code>git clone https://github.com/letsencrypt/letsencrypt
cd letsencrypt</code></pre>
Now request for SSL from <em>Let's Encrypt</em>.
<pre><code>./letsencrypt-auto certonly --webroot -w /var/www/example.com/htdocs/ -d example.com -d www.example.com --email admin@exmaple.com --text --agree-tos</code></pre>
After successful verification you will receive following message.
<pre><code>IMPORTANT NOTES:
 - Congratulations! Your certificate and chain have been saved at
   /etc/letsencrypt/live/example.com/fullchain.pem. Your cert will
   expire on 2016-03-03. To obtain a new version of the certificate in
   the future, simply run Let's Encrypt again.
 - If like Let's Encrypt, please consider supporting our work by:

   Donating to ISRG / Let's Encrypt:   https://letsencrypt.org/donate
   Donating to EFF:                    https://eff.org/donate-le</code></pre>
Once you receive SSL from <em>Let's Encrypt</em>, configure the SSL with your site.
<pre><code>vi /var/www/example.com/conf/nginx/ssl.conf </code></pre>
and add following Nginx Config into it:
<pre><code>    listen 443 ssl http2;
    ssl on;
    ssl_certificate     /etc/letsencrypt/live/example.com/fullchain.pem;
    ssl_certificate_key     /etc/letsencrypt/live/example.com/privkey.pem;

</code></pre>
At the end, you need to reload Nginx:
<pre><code>nginx -t &amp;&amp; service nginx reload</code></pre>
If you want HTTP to HTTPS redirection then:
<pre><code>vim /etc/nginx/conf.d/force-ssl.conf </code></pre>
and add following Nginx config into it:
<pre><code>server {
	listen 80;
	server_name www.example.com example.com;
	return 301 https://example.com$request_uri;
}</code></pre>
At the end, you need to reload Nginx
<pre><code>nginx -t &amp;&amp; service nginx reload</code></pre>