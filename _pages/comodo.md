---
ID: 134140
post_title: WordPress-Nginx + Comodo SSL Setup
author: Nitun Lanjewar
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/wordpress-nginx/tutorials/ssl/comodo/
published: true
post_date: 2016-06-09 19:16:58
---
After exploring <a href="https://easyengine.io/wordpress-nginx/tutorials/">different WordPress-Nginx configurations</a> lets head over to secure your WordPress.

Steps mentioned in this article are similar for all kind of WordPress-Nginx configuration.
<h3 id="step-1-create-csr--certificate-signing-request-on-">Step 1: Create CSR – Certificate Signing Request on Nginx Server</h3>
Create a directory to store keys &amp; certifcates for example.com domain. You can use any directory. Following example uses <a href="https://easyengine.io/wordpress-nginx/tutorials/conventions/">these conventions</a>.
<pre><code class="no-highlight">mkdir /var/www/example.com/cert/
cd /var/www/example.com/cert/</code></pre>
Next, create a 2048-bit private key
<pre><code class="no-highlight">openssl genrsa -out example.com.key 2048</code></pre>
Finally Create a CSR (Certificate signing request)
<pre><code class="no-highlight">openssl req -new -key example.com.key -out example.com.csr -sha256</code></pre>
Running this command will ask you some details. For <code>Common Name (eg, YOUR name) []:</code>field use <code>example.com</code>
<p class="rtp-info"><strong>Note:</strong> Comodo SSL provide www.example.com and example.com in same certificate.</p>
<p class="warning">If you are renewing existing SSL certificate, you can follow step 2 and 3 below. Make sure CSR already generated from server.</p>

<h3 id="step-2-get-a-sslcertificate-from-thawte">Step 2: Get a SSL Certificate</h3>
<ol>
 	<li>Buy a SSL certificate from <a href="https://www.comodo.com/">comodo</a> site or <a href="http://dh.rtcamp.com/digital-certificate">dh.rtcamp.com</a> (is our portal).</li>
 	<li>Paste CSR i.e. content of <code>example.com.csr</code> in comodo account or dh.rtcamp.com portal. You will need to provide some more details, Try to match them to details in Step #1.</li>
 	<li>Depending on type of certificate, it may take some time for Comodo to approve your certificate.</li>
 	<li>Once certificate is approved, you will get a link via emails. Once email to verify your SSL certificate and once it approved, second email with bundle zip file of SSL.</li>
</ol>
<h3 id="step-3-fixintermediate-certificate-chain">Step 3: Fix Intermediate Certificate Chain</h3>
In email's zip file you will get  4 files:
<ol>
<ol>
 	<li>Root CA Certificate - AddTrustExternalCARoot.crt</li>
 	<li>Intermediate CA Certificate - COMODORSAAddTrustCA.crt</li>
 	<li>Intermediate CA Certificate - COMODORSADomainValidationSecureServerCA.crt</li>
 	<li>Your PositiveSSL Certificate - example_com.crt</li>
</ol>
</ol>
Now we need to append these file into SSL certificate file itself in a way that SSL certificate remains on top.

You can do it simply by running following command:
<pre><code class="no-highlight">cat example_com.crt COMODORSADomainValidationSecureServerCA.crt  COMODORSAAddTrustCA.crt &gt; example.com.crt</code></pre>
No need to use `AddTrustExternalCARoot.crt` just to avoid Chain issues - Contains anchor.

Move this <code>example.com.crt</code> file to <code>/var/www/example.com/cert/</code>directory on nginx server.
<h3 id="step-4-adjusting-nginx-configuration">Step 4: Adjusting Nginx Configuration</h3>
<h4 id="enable-sslfor-examplecom">Enable SSL for example.com</h4>
Make it look like below:
<pre><code class="no-highlight">server {
    listen 443;
    server_name example.com;
    ssl on;
    ssl_certificate /var/www/example.com/cert/example.com.crt;
    ssl_certificate_key /var/www/example.com/cert/example.com.key;
 #... other stuff
}</code></pre>
<h4 id="force-non-ssl-site-to-redirect-traffic-to-ssl">Force non SSL site to redirect traffic to SSL</h4>
Add following codes if you want to force SSL on your site.
<pre><code class="no-highlight">server {
    listen 80;
    server_name example.com;
    return 301 https://example.com$request_uri;
}</code></pre>
<h4 id="turn-on-ssl-session-cache-for-performance">Turn on SSL session cache for performance</h4>
In file <code>/etc/nginx/nginx.conf</code>, inside <code>http {..}</code> block add following:
<pre><code class="nginx"><span class="title">http</span> {
    <span class="title">ssl_session_cache</span>   shared:SSL:<span class="number">10m</span>;
    <span class="title">ssl_session_timeout</span> <span class="number">10m</span>;
    <span class="comment">#... other stuff</span>
}</code></pre>
Also make sure value of <code>worker_processes</code> directive is greater than 1 (only if your server has multiple cores).

Finally, reload the processes to make the change take effect.
<pre><code class="no-highlight">service nginx reload</code></pre>
<h4 id="step-4-ask-wordpress-to-use-ssl">Step-4: Ask WordPress to use SSL</h4>
Add following to you WordPress’s wp-config.php file.

To force SSL for login form:
<pre><code class="no-highlight">define('FORCE_SSL_LOGIN', true);</code></pre>
To force SSL for wp-admin section:
<pre><code class="no-highlight">define('FORCE_SSL_ADMIN', true);</code></pre>
<h3 id="step-5-verifying-ssl-installation">Step-5: Verifying SSL Installation</h3>
Last and most important step is to verify if we have installed SSL certificate properly.

Below are some nice online tools to help you with that:
<ol>
<ol>
<ol>
 	<li><a href="https://www.wormly.com/test_ssl">https://www.wormly.com/test_ssl</a></li>
 	<li><a href="https://sslcheck.globalsign.com/en_US/sslcheck">https://sslcheck.globalsign.com/en_US/sslcheck</a></li>
</ol>
</ol>
</ol>
If you face any issues, feel free to use our free <a href="http://community.rtcamp.com/c/easyengine">support forum</a>.

<strong>Links: </strong><a href="https://easyengine.io/wordpress-nginx/tutorials/">WordPress-Nginx Series</a> | <a href="http://dh.rtcamp.com/digital-certificate">Buy Comodo SSL certificate</a>