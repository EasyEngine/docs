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
<p>EasyEngine uses <a href="https://github.com/acmephp/acmephp">AcmePHP</a> library to manage SSL certificates. You pass <code>--ssl</code> flag to create a site with SSL.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Currently there are two options you can pass to <code>--ssl</code> flag - <code>--ssl=le</code> and <code>--ssl=inherit</code>. <code>--ssl=le</code> should be used if you want to issue a new certificate from <a href="https://letsencrypt.org/">Let's Encrypt</a>. <code>--ssl=inherit</code> should be used if there's an existing site <code>example.com</code> with wildcard certificate and you want to create <code>abc.example.com</code> which will inherit (reuse) the certificate of <code>example.com</code> instead of issuing a new one.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Getting Certificate from Let's Encrypt</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>In order to get certificate from Let's Encrypt, you'll have to use <code>--ssl=le</code> flag during site create.</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>ee site create example.com --type=wp --ssl=le</code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p>Optionally, If you want a wildcard certificate, you also need to pass <code>--wildcard</code> flag.</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>ee site create example.com --type=wp --ssl=le --wildcard</code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p>⚠️ <em>Note</em>: If you've used <code>--wildcard</code> flag, you need to run following command after adding your DNS entries: </p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>ee site ssl example.com</code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p>In order to get a SSL certificate from a certificate authority, you have to prove to the certificate authority that you own the domain. The certificate authority gives you a "challenge" to prove that you own the domain. You then need to "solve" the given challenge. The certificate authority gives you two primary methods which can be used to solve challenge - </p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
<li>HTTP Challenge</li>
<li>DNS Challenge </li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>HTTP Challenge</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>When you use <code>--ssl=le</code>, by default this method is selected unless you've used <code>--wildcard</code> flag. EasyEngine automatically "solves" the challenge for you if this method is selected. Its only requirement is that the domain of site should point to the server where you're creating site.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>First of all, the certificate authority (Let's Encrypt) tells us to put a specific string in a file at <code>example.com/.well-known/acme-challenge/xxxxxxxxxxxxxxxx</code>. Once you do it, the certificate authority checks if you have added the given string there. If it finds that specific string there, it marks the given challenge as solved and gives you certificate for the domain. However, you don't need to worry about doing any of this as EasyEngine already handles it for you.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>DNS Challenge</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>When you use <code>--ssl=le</code> with <code>--wildcard</code> flag, DNS challenge is used by default as it is the only method which supports wildcard certificates. In this method, you have to manually add a <code>TXT</code> record in your DNS. In future, we will attempt to automate it with a <a href="https://www.cloudflare.com/">CloudFlare</a> integration </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>In this method, the certificate authority gives you DNS entries that you need to add to verify ownership of the domain.</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre>$ ee site create example.com --ssl=le --wildcard

Configuring project.
Creating site example.com.
Copying configuration files.
Starting site's services.
Success: Configuration files copied.
Checking and verifying site-up status. This may take some time.

    Add the following TXT record to your DNS zone
        Domain: _acme-challenge.example.com.
        TXT value: jfKbXNIhMB5agYNfYQqwZdFJmaHv1j-c_-wBk3cI7qg

    Wait for the propagation before moving to the next step
    Tips: Use the following command to check the propagation

        host -t TXT _acme-challenge.example.com.

    Add the following TXT record to your DNS zone
        Domain: _acme-challenge.example.com.
        TXT value: bIcFm-nUWaOGjtqDiTFMvDz2aFInLyro5bN9E2VvWpI

    Wait for the propagation before moving to the next step
    Tips: Use the following command to check the propagation

        host -t TXT _acme-challenge.example.com.

IMPORTANT: Run `ee site ssl example.com` once the DNS changes have propagated to complete the certification generation and installation.Starting site's services.</pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p>After running the above command, in this case, you need to add the following entries in your DNS</p>
<!-- /wp:paragraph -->

<!-- wp:table {"align":"center","className":"is-style-regular"} -->
<table class="wp-block-table aligncenter is-style-regular">
<tbody>
<tr>
<td><strong>Key</strong></td>
<td><strong>Value</strong></td>
</tr>
<tr>
<td>_acme-challenge.example.com</td>
<td>jfKbXNIhMB5agYNfYQqwZdFJmaHv1j-c_-wBk3cI7qg</td>
</tr>
<tr>
<td>_acme-challenge.example.com</td>
<td>bIcFm-nUWaOGjtqDiTFMvDz2aFInLyro5bN9E2VvWpI</td>
</tr>
</tbody>
</table>
<!-- /wp:table -->

<!-- wp:paragraph -->
<p> After adding the entries, run the following command to verify that the changes have been propagated in the DNS - </p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre>$ host -t TXT _acme-challenge.easyengine.io
_acme-challenge.example.com descriptive text "jfKbXNIhMB5agYNfYQqwZdFJmaHv1j-c_-wBk3cI7qg"
_acme-challenge.example.com descriptive text "bIcFm-nUWaOGjtqDiTFMvDz2aFInLyro5bN9E2VvWpI"</pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p>Finally run following to verify the challenge and get the certificate from Let's Encrypt - </p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>ee site ssl example.com</code></pre>
<!-- /wp:code -->

<!-- wp:heading {"level":4} -->
<h4>DNS Challenge on Non-wildcard Site</h4>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>If there's a site which isn't wildcard but you still need DNS challenge on it, then you can do so by setting <code>preferred_dns_challenge</code> option in config file to <code>dns</code>:</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>ee config set preferred_ssl_challenge dns</code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p>It will ensure all sites created will use DNS challenge instead of HTTP. </p>
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
<p>Let's say  there's an existing site <code>example.com</code> with wildcard certificate and you want to create <code>abc.example.com</code> which will reuse the certificate of <code>example.com</code> instead of issuing a new one. Then you can do it with <code>--ssl=inherit</code> flag:</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>ee site create abc.example.com --ssl=inherit</code></pre>
<!-- /wp:code -->

<!-- wp:heading -->
<h2>Ciphers</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>We use <a href="https://mozilla.github.io/server-side-tls/ssl-config-generator/">Mozilla's Intermediate profile</a> ciphers by default. Other policies that you can use are - <code>Mozilla-Old, Mozilla-Intermediate, Mozilla-Modern, AWS-TLS-1-2-2017-01, AWS-TLS-1-1-2017-01, AWS-2016-08, AWS-2015-05, AWS-2015-03 and AWS-2015-02</code>. You can have a look at <a href="https://github.com/EasyEngine/dockerfiles/blob/78b9d1ba52d0ba6ba01548e9808dae83e812e542/nginx-proxy/nginx.tmpl#L291">our code</a> to see which ciphers and protocols will be used for which policy.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>&nbsp;</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>You can read more about how SSL is handled in nginx-proxy <a href="https://easyengine.io/handbook/internal/nginx-proxy/">here</a>.</p>
<!-- /wp:paragraph -->