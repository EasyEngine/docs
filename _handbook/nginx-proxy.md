---
ID: 142693
post_title: Nginx Reverse Proxy
author: Rahul Bansal
post_excerpt: ""
layout: handbook
permalink: >
  https://easyengine.io/handbook/internal/nginx-proxy/
published: true
post_date: 2018-11-20 13:49:38
---
<!-- wp:paragraph -->
<p>The v4 uses Nginx in two different ways. One is <g class="gr_ gr_8 gr-alert gr_gramm gr_inline_cards gr_run_anim Grammar only-ins replaceWithoutSep" id="8" data-gr-id="8">plain</g> old way of serving a site using Nginx as a web server. The other is to route traffic to different sites using Nginx as a reverse proxy. This article explains nginx-proxy part in details.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Why we need reverse p<g class="gr_ gr_7 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling ins-del multiReplace" id="7" data-gr-id="7">roxy</g>?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>EasyEngine v4 uses docker for every site. This means, if you create 10 sites, then there will 10 nginx web servers running on your machine.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>But the host machine has only one port 80/443. So by default, only one container (site) can use these ports. &nbsp;</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p> So we need an intermediate layer which will listen to these ports (80/443) and based on HTTP Host header route requests to correct nginx containers.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>This layer is reverse proxy layer which is a bit complicated to understand if you are new to the container world.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 id="mce_5">What we liked about nginx proxy?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>We wanted to find a lightweight and transparent solution for reverse proxy needs. We explored many, even tried&nbsp;<a href="https://traefik.io/">traefik.io</a> but finally settled on&nbsp;<a href="https://github.com/jwilder/nginx-proxy"><g class="gr_ gr_294 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling ins-del multiReplace" id="294" data-gr-id="294">jwilder's</g> nginx-proxy</a>.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>For us - using Nginx for reverse proxy and web server gave many advantages such as the&nbsp;ability to use Nginx features we are already familiar with at both levels. </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Also, since we know Nginx very well, debugging Nginx reverse-proxy was easy.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>How Nginx Proxy Works?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>You may visit <a href="https://easyengine.io/handbook/request-cycle/">request cycle</a> article to understand how it works in overall scheme.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Nginx Proxy File Structure</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Nginx Proxy stores all data, config, logs and other files in a top-level host directory <code>/opt/easyengine/services/nginx-proxy/</code>. This directory has following directory for different purpose:</p>
<!-- /wp:paragraph -->

<!-- wp:table -->
<table class="wp-block-table"><tbody><tr><td><strong>Purpose</strong></td><td><strong>Host Directory Path</strong></td></tr><tr><td>Let's encrypt acme-php libraries work directory&nbsp;</td><td>acme-conf/</td></tr><tr><td>SSL&nbsp;certificates and keys for each sites</td><td>certs/</td></tr><tr><td>Global nginx reverse proxy config&nbsp;</td><td>conf.d/</td></tr><tr><td>Diffie-Hellman key folder</td><td>dhparam/</td></tr><tr><td>Folder used during let's encrypt certificate generation <g class="gr_ gr_10 gr-alert gr_gramm gr_inline_cards gr_run_anim Style multiReplace" id="10" data-gr-id="10">for .</g>well-know</td><td>html/</td></tr><tr><td>HTTP auth password file</td><td>htpasswd/</td></tr><tr><td>Nginx reverse proxy logs folder</td><td>logs/</td></tr><tr><td>Site-specific configs folder</td><td>vhost.d/</td></tr></tbody></table>
<!-- /wp:table -->

<!-- wp:heading {"level":4} -->
<h4>Nginx Proxy &amp; Containers</h4>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>We are using containers for almost everything. When container starts or even recreated, containers gets a&nbsp;random IP assigned.  </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>The Nginx Proxy  keeps track of these events and regenerates the nginx configuration to allow traffic for a domain to be passed to the correct Nginx container. </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>This config is regenerated from a&nbsp;<a href="https://github.com/EasyEngine/dockerfiles/blob/master/nginx-proxy/nginx.tmpl">go template</a>&nbsp;and stored in file:</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>/opt/easyengine/services/nginx-proxy/conf.d/default.conf</code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p>Do not&nbsp;modify&nbsp;this file as it will&nbsp; gets regenerated whenever any of container starts/stops.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Nginx Proxy Config Customization</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Please refer to&nbsp;<a href="https://github.com/jwilder/nginx-proxy#custom-nginx-configuration">jwilder/nginx-proxy's readme</a>&nbsp;for more info.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>EasyEngine supports adding basic HTTP Authentication via&nbsp;<a href="https://github.com/easyengine/auth-command">auth-command</a>. So please do not modify files inside&nbsp;<code>/opt/easyengine/services/nginx-proxy/htpasswd</code>. You may ignore <a href="https://github.com/jwilder/nginx-proxy#basic-authentication-support">basic authentication support from jwilder/nginx-proxy</a>&nbsp;as it is not required and also can conflict with EasyEngine's&nbsp;<a href="https://github.com/easyengine/auth-command">auth-command</a>.&nbsp;</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>SSL Certificates</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Nginx Reverse Proxy is where external SSL requests are terminated. The site-specific Nginx doesn't expose port 443. Traffic between outer Nginx reverse-proxy to inner site-specific Nginx is not encrypted but both Nginx being on same host machine, it is not needed.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>For each site, EasyEngine creates  three files for reverse nginx-proxy and store them in <code>/opt/easyengine/services/nginx-proxy/certs</code></p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul><li><code>example.com.crt</code> - SSL Certificate(Public Key)</li><li><code>example.com.key</code> - Private key</li><li><code>example.com.chain.pem</code> - Certificate Chain File</li></ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p><strong>Link:</strong>&nbsp;<a href="https://github.com/jwilder/nginx-proxy">https://github.com/jwilder/nginx-proxy</a></p>
<!-- /wp:paragraph -->