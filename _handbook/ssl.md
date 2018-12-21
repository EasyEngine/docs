---
ID: 143258
post_title: SSL
author: Kirtan Gajjar
post_excerpt: ""
layout: handbook
permalink: >
  https://easyengine.io/handbook/internal/ssl/
published: true
post_date: 2018-12-05 15:52:56
---
<!-- wp:paragraph -->
<p>EasyEngine uses <a href="https://github.com/acmephp/acmephp">AcmePHP</a> library to manage SSL certificates. You pass <code>--ssl</code> flag to create a site with SSL (HTTPS support).</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Currently there are three options you can pass to <code>--ssl</code>&nbsp;flag</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul><li><code>--ssl=le</code>. It&nbsp;should be used if you want to issue a new certificate from&nbsp;<a href="https://letsencrypt.org/">Let's Encrypt</a>.</li><li><code>--ssl=inherit</code>. It should be used if there's an existing site <code>example.com</code> with wildcard certificate and you want to create <code>abc.example.com</code>&nbsp;which will inherit (reuse) the certificate of&nbsp;<code>example.com</code>&nbsp;instead of issuing a new one.</li><li><code>--ssl=self</code>&nbsp;if you want to create a self signed certificate. Useful for https site on local machine.</li></ul>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>Getting Certificate from Let's Encrypt</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>In order to get certificate from Let's Encrypt, you'll have to use <code>--ssl=le</code>&nbsp;flag during site create.</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>ee site create example.com --type=wp --ssl=le</code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p>Optionally, If you want a wildcard certificate, you also need to pass <code>--wildcard</code>&nbsp;flag.</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>ee site create example.com --type=wp --ssl=le --wildcard</code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p>⚠️&nbsp;<em>Note</em>: If you've used <code>--wildcard</code>&nbsp;flag, you need to run following command after adding your DNS entries:&nbsp;</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>ee site ssl example.com</code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p>In order to get a SSL certificate from a certificate authority, you have to prove to the certificate authority that you own the domain. The certificate authority gives you a "challenge" to prove that you own the domain. You then need to "solve" the given challenge. The certificate authority gives you two primary methods which can be used to solve challenge -&nbsp;</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul><li>HTTP Challenge</li><li>DNS Challenge&nbsp;</li></ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>HTTP Challenge</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>When you use <code>--ssl=le</code>, by default this method is selected unless you've used <code>--wildcard</code>&nbsp;flag. EasyEngine automatically "solves" the challenge for you if this method is selected. Its only requirement is that the domain of site should point to the server where you're creating site.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>First of all, the certificate authority (Let's Encrypt) tells us to put a specific string in a file at <code>example.com/.well-known/acme-challenge/xxxxxxxxxxxxxxxx</code>. Once you do it, the certificate authority checks if you have added the given string there. If it finds that specific string there, it marks the given challenge as solved and gives you certificate for the domain. However, you don't need to worry about doing any of this as EasyEngine already handles it for you.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>DNS Challenge</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>When you use&nbsp;<code>--ssl=le</code>&nbsp;with <code>--wildcard</code>&nbsp;flag, DNS challenge is used by default as it is the only method which supports wildcard certificates. In this method, you have to manually add a <code>TXT</code> record in your DNS. In future, we will attempt to automate it with a <a href="https://www.cloudflare.com/">CloudFlare</a> integration&nbsp;</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>In this method, the certificate authority gives you DNS entries that you need to add to verify ownership of the domain.</p>
<!-- /wp:paragraph -->

<!-- wp:preformatted -->
<pre class="wp-block-preformatted">$ ee site create example.com --ssl=le --wildcard<br>Configuring project.<br>Creating site example.com.<br>Copying configuration files.<br>Starting site's services.<br>Success: Configuration files copied.<br>Checking and verifying site-up status. This may take some time.<br>    Add the following TXT record to your DNS zone<br>        Domain: _acme-challenge.example.com.<br>        TXT value: xxxxxxxxx<br>    Wait for the propagation before moving to the next step<br>    Tips: Use the following command to check the propagation<br>        host -t TXT _acme-challenge.example.com.<br>    Add the following TXT record to your DNS zone<br>        Domain: _acme-challenge.example.com.<br>        TXT value: yyyyyyyyy<br>    Wait for the propagation before moving to the next step<br>    Tips: Use the following command to check the propagation<br>        host -t TXT _acme-challenge.example.com.<br>IMPORTANT: Run `ee site ssl example.com` once the DNS changes have propagated to complete the certification generation and installation.<br>Starting site's services.</pre>
<!-- /wp:preformatted -->

<!-- wp:paragraph -->
<p>After running the above command, in this case, you need to add the following entries in your DNS</p>
<!-- /wp:paragraph -->

<!-- wp:table {"align":"center","className":"is-style-regular"} -->
<table class="wp-block-table aligncenter is-style-regular"><tbody><tr><td><strong>Key</strong></td><td><strong>Value</strong></td></tr><tr><td>_acme-challenge.example.com</td><td>xxxxxxxxx</td></tr><tr><td>_acme-challenge.example.com</td><td>yyyyyyyyy</td></tr></tbody></table>
<!-- /wp:table -->

<!-- wp:paragraph -->
<p>&nbsp;After adding the entries, run the following command to verify that the changes have been propagated in the DNS -&nbsp;</p>
<!-- /wp:paragraph -->

<!-- wp:preformatted -->
<pre class="wp-block-preformatted">$ host -t TXT _acme-challenge.easyengine.io<br>_acme-challenge.example.com descriptive text "jfKbXNIhMB5agYNfYQqwZdFJmaHv1j-c_-wBk3cI7qg"<br>_acme-challenge.example.com descriptive text "bIcFm-nUWaOGjtqDiTFMvDz2aFInLyro5bN9E2VvWpI"</pre>
<!-- /wp:preformatted -->

<!-- wp:paragraph -->
<p>Finally run following to verify the challenge and get the certificate from Let's Encrypt -&nbsp;</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>ee site ssl example.com</code></pre>
<!-- /wp:code -->

<!-- wp:heading {"level":4} -->
<h4>DNS Challenge on Non-wildcard Site</h4>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>If there's a site which isn't wildcard but you still need DNS challenge on it, then you can do so by setting&nbsp;<code>preferred_dns_challenge</code>&nbsp;option in config file to <code>dns</code>:</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>ee config set preferred_ssl_challenge dns</code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p>It will ensure all sites created will use DNS challenge instead of HTTP.&nbsp;</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>To restore the default behaviour, use:</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>ee config set preferred_ssl_challenge http</code></pre>
<!-- /wp:code -->

<!-- wp:heading -->
<h2>Inheriting Certs</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Let's say&nbsp; there's an existing site&nbsp;<code>example.com</code>&nbsp;with wildcard certificate and you want to create&nbsp;<code>abc.example.com</code>&nbsp;which will reuse the certificate of&nbsp;<code>example.com</code>&nbsp;instead of issuing a new one. Then you can do it with <code>--ssl=inherit</code>&nbsp;flag:</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>ee site create abc.example.com --ssl=inherit</code></pre>
<!-- /wp:code -->

<!-- wp:heading -->
<h2>Self Signed Certificates</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>You can generate a self signed certificate while creating a site by using <code>--ssl=self</code>&nbsp;flag. It is quite useful for creating https sites on local machine.&nbsp;</p>
<!-- /wp:paragraph -->

<!-- wp:preformatted -->
<pre class="wp-block-preformatted">ee site create example.com --ssl=self </pre>
<!-- /wp:preformatted -->

<!-- wp:paragraph -->
<p>EasyEngine adds the self signed certificate's Certificate Authority(CA) to your OS trust store so the sites created with self signed certificate do not display warnings in browser on that machine.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>TLS Ciphers</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><p>We use <span style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, Oxygen-Sans, Oxygen, &quot;Fira Sans&quot;, Ubuntu, Cantarell, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, sans-serif;">ciphers from </span><a href="https://mozilla.github.io/server-side-tls/ssl-config-generator/">Mozilla's Intermediate profile</a>  by default. You can use <span style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, Oxygen-Sans, Oxygen, &quot;Fira Sans&quot;, Ubuntu, Cantarell, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, sans-serif;">different set of ciphers </span>by choosing a different ssl policy. You can use other ssl policies by updating <code>ssl-policy</code> in EasyEngine's config:</p><pre>ee config set ssl-policy Mozilla-Intermediate</pre><p> Policies that you can use are - <code>Mozilla-Old, Mozilla-Intermediate, Mozilla-Modern, AWS-TLS-1-2-2017-01, AWS-TLS-1-1-2017-01, AWS-2016-08, AWS-2015-05, AWS-2015-03 and AWS-2015-02</code>. You can have a look at <a href="https://github.com/EasyEngine/dockerfiles/blob/78b9d1ba52d0ba6ba01548e9808dae83e812e542/nginx-proxy/nginx.tmpl#L291">our code</a> to see which ciphers and protocols will be used for which policy.</p></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>You can read more about how SSL is handled in nginx-proxy <a href="https://easyengine.io/handbook/internal/nginx-proxy/">here</a>.</p>
<!-- /wp:paragraph -->