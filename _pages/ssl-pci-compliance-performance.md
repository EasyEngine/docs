---
ID: 52186
post_title: 'SSL &#8211; PCI compliance and performance optimization'
author: Rahul Bansal
post_excerpt: >
  For Nginx server, optimizing SSL for
  performance by adding SSL session cache
  and tweaking ssl_ciphers. Mitigating
  BEAST attack. Meeting PCI-DSS
  compliance.
layout: page
permalink: >
  https://easyengine.io/tutorials/nginx/ssl-pci-compliance-performance/
published: true
post_date: 2013-11-29 21:57:46
---
<p>SSL is must. PCI compliance is required to accept/store credit card information on your server.</p>
<p>Most small websites (including this), technically doesn't accept/store customer credit themselves. They simply redirect a customer to PayPal or another payment gateway page.</p>
<h2>SSL Cache:</h2>
<p>First and most important option is to enable SSL cache.</p>
<p>Put following lines in /etc/nginx/nginx.conf</p>
<pre class="no-highlight">ssl_session_cache   shared:SSL:20m;
ssl_session_timeout 10m;</pre>
<p>20m is size of nginx cache. You can adjust it as per your needs.</p>
<p>10m is duration for ssl session timeout. If a user does not send another request before timeout, SSL cache for their session will be cleared.</p>
<p>Just reload nginx for SSL session cache to take effect.</p>
<h2>Performance Optimization</h2>
<p>Nginx's default set of ciphers includes:</p>
<pre class="no-highlight">ssl_ciphers HIGH:!aNULL:!MD5;</pre>
<p>This enables strong <a href="http://en.wikipedia.org/wiki/Diffie%E2%80%93Hellman_key_exchange">Diffie–Hellman_key_exchange algorithm</a> which is slow. Since PCI compliance doesn't need this algorithm, we can safely disable it by explicitly defining ssl_ciphers.</p>
<pre class="no-highlight">ssl_ciphers HIGH:!aNULL:!MD5:!kEDH;</pre>
<p>You can check more about <a href="http://www.openssl.org/docs/apps/ciphers.html#CIPHER_LIST_FORMAT">ssl_ciphers </a><a href="http://www.openssl.org/docs/apps/ciphers.html#CIPHER_LIST_FORMAT">format</a> here.</p>
<h2>SSL Security</h2>
<p>Next, lets disable <a href="http://en.wikipedia.org/wiki/Transport_Layer_Security#BEAST_attack">BEAST attack</a> by forcing browsers to use ciphers listed on server side:</p>
<pre class="no-highlight">ssl_prefer_server_ciphers on;</pre>
<h2>Test</h2>
<p>Test your SSL setup with <a href="https://www.ssllabs.com/ssltest/">SSL Lab</a>.</p>
<p>You may see a complain about "Forward Secrecy". We let it remain to avoid better speed-up without compromising PCI-DSS compliance.</p>