---
ID: 11532
post_title: WordPress-Nginx + GoDaddy SSL Setup
author: Rahul Bansal
post_excerpt: 'For GoDaddy Single-Domain and WildCard SSL Setup. Covers SSL Session cache for performance. Redirecting non-SSL traffic to SSL & test cases.'
layout: page
permalink: >
  https://easyengine.io/wordpress-nginx/tutorials/ssl/godaddy/
published: true
post_date: 2012-10-15 13:45:16
---
<a href="https://easyengine.io/wordpress-nginx/tutorial"><img class="alignright size-full wp-image-14759" title="wordpress-nginx1" alt="" src="https://easyengine.io/wp-content/uploads/2012/09/wordpress-nginx1.jpeg" width="220" height="91" /></a>After exploring <a href="https://easyengine.io/wordpress-nginx/tutorials/">different WordPress-Nginx configurations</a> lets head over to secure your WordPress.

Steps mentioned in this article are similar for all kind of WordPress-Nginx configuration.
<h3>Step 1: Create CSR - Certificate Signing Request on Nginx Server</h3>
Create a directory to store keys &amp; certifcates for example.com domain. You can use any directory. Following example uses <a href="https://easyengine.io/wordpress-nginx/tutorials/conventions/">these conventions</a>.
<pre>mkdir /var/www/example.com/cert/
cd /var/www/example.com/cert/</pre>
Next, create a 2048-bit private key
<pre>openssl genrsa -out example.com.key 2048</pre>
Finally Create a CSR (Certificate signing request)
<pre>openssl req -new -key example.com.key -out example.com.csr</pre>
Running this command will ask you some details. For <code>Common Name (eg, YOUR name) []:</code> field use <code>example.com</code> <em>(or <code>*.example.com</code> if you are setting up a wild-card SSL certificate)</em>
<p class="rtp-info"><strong>Note:</strong> www.example.com and example.com are not same. Use exactly same domain your website is using.</p>

<h3>Step 2: Get a SSL Certificate from GoDaddy</h3>
<ol>
	<li>Buy a <a href="http://www.godaddy.com/ssl/ssl-certificates.aspx">SSL certificate from GoDaddy.com</a>.</li>
	<li>Paste CSR i.e. content of <code>example.com.csr</code> in GoDaddy web-interface. You will need to provide some more details, Try to match them to details in Step #1.</li>
	<li>Depending on type of certificate, it may take some time for GoDaddy to approve your certificate.</li>
	<li>Once certificate is approved, you can download it. For detailed instructions on downloading, please <a href="http://support.godaddy.com/help/article/4754/downloading-an-ssl-certificate">refer this</a>.</li>
</ol>
<p class="rtp-info"><strong>Promo:</strong> You can <a href="http://dh.rtcamp.com/digital-ssl-certificate/index.php">buy Thwate SSL certificates from us</a>. We are a Thwate reseller but we sell cheaper than them! ;-)</p>

<h3>Step 3: Fix Intermediate Certificate Chain</h3>
The zip file you will get from Godaddy will contain 2 files: <code>example.com.crt</code> and <code>gd_bundle.crt</code>.

One is your certificate and other is bundle i.e <a href="http://en.wikipedia.org/wiki/Intermediate_certificate_authorities">intermediate certificates</a>. Nginx doesn't have a special directive to specify path to certificate bundle/chain file. So we need to append bundle into SSL certificate file itself in a way that SSL certificate remains on top.

You can do it simply by running following command:
<pre>cat gd_bundle.crt &gt;&gt; example.com.crt</pre>
Move this <code>example.com.crt</code> file to <code>/var/www/example.com/cert/</code>directory on nginx server.
<h3>Step 4: Adjusting Nginx Configuration</h3>
<h4>Enable SSL for example.com</h4>
Make it look like below:
<pre>server {
    listen 443;
    server_name example.com;
    ssl on;
    ssl_certificate /var/www/example.com/cert/example.com.crt;
    ssl_certificate_key /var/www/example.com/cert/example.com.key;
 #... other stuff
}</pre>
<h4>Force non SSL site to redirect traffic to SSL</h4>
Add following codes if you want to force SSL on your site.
<pre>server {
    listen 80;
    server_name example.com;
    return 301 https://example.com$request_uri;
}</pre>
<h4>Turn on SSL session cache for performance</h4>
In file <code>/etc/nginx/nginx.conf</code>, inside <code>http {..}</code> block add following:
<pre class="nginx">http {
    ssl_session_cache   shared:SSL:10m;
    ssl_session_timeout 10m;
    #... other stuff
}</pre>
Also make sure value of <code>worker_processes</code> directive is greater than 1 (only if your server has multiple cores).

Finally, reload the processes to make the change take effect.
<pre>service nginx reload</pre>
<h4>Step-4: Ask WordPress to use SSL</h4>
Add following to you WordPress's wp-config.php file.

To force SSL for login form:
<pre>define('FORCE_SSL_LOGIN', true);</pre>
To force SSL for wp-admin section:
<pre>define('FORCE_SSL_ADMIN', true);</pre>
<h3>Step-5: Verifying SSL Installation</h3>
Last and most important step is to verify if we have installed SSL certificate properly.

Below are some nice online tools to help you with that:
<ol>
	<li><a href="https://www.wormly.com/test_ssl">https://www.wormly.com/test_ssl</a></li>
	<li><a href="https://sslcheck.globalsign.com/en_US/sslcheck">https://sslcheck.globalsign.com/en_US/sslcheck</a></li>
</ol>
If you face any issues, feel free to use our free <a href="https://easyengine.io/support">support forum</a>.

<strong>Links: </strong><a href="https://easyengine.io/wordpress-nginx/tutorials/">WordPress-Nginx Series</a> | <a href="http://dh.rtcamp.com/digital-ssl-certificate/index.php">Buy Thawte SSL Certificates for upto 67% discount</a>