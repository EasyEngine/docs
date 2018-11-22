---
ID: 13579
post_title: >
  Creating A WordPress Multisite Network
  with Nginx
author: Rahul Bansal
post_excerpt: >
  Instructions for creating a wordpress
  multisite network for nginx. Uses
  WPMU_ACCEL_REDIRECT/X-Accel-Redirection
  for better static file-handling
layout: page
permalink: >
  https://easyengine.io/wordpress-nginx/tutorials/multisite/create-a-network/
published: true
post_date: 2012-09-18 00:03:48
---
<p class="rtp-info"><strong>Update:</strong> This article is updated for WordPress 3.5. If you are running old version of WordPress, its highly recommended to upgrade WordPress before creating multisite network.</p>
As we saw in <a href="https://easyengine.io/tutorials/wordpress-multisite-subdirectory-subdomain-domain-mapping-overview/">previous article</a>, there are many ways to create a WordPress Multisite Network. Each way can be further optimized using different caching solutions &amp; techniques. But process to create Multisite network itself remains much similar.

To avoid repetition of information across articles, I am posting techniques to create a WordPress Multisite network here itself. If you are familiar with this or already have a Multisite network up, you may jump to <a title="Nginx Map + WordPress-Multisite + Static Files Handling" href="https://easyengine.io/tutorials/nginx-map-wordpress-multisite-static-files-handling/">Nginx configuration part</a> directly.

In any case, don't forget to check how to configure server for static content without PHP!
<h2>Creating A WordPress Multisite Network</h2>
<h3>#1. Turn on "Network Setup" option</h3>
By default, its disabled in WordPress dashboard.

Open <code>vim /var/www/example.com/htdocs/wp-config.php</code>

Then add following lines to it:
<pre>define('WP_ALLOW_MULTISITE', true);</pre>
<h3>#2. Choose WordPress Multisite Mode</h3>
Go to WordPress <em><strong>"Dashboard &gt;&gt; Tools &gt;&gt; Network Setup".</strong></em>

You will see something like below:

<img class="size-full wp-image-13585 alignnone" title="Create a Network of WordPress Sites-1" alt="" src="https://easyengine.io/wp-content/uploads/2012/09/Create-a-Network-of-WordPress-Sites-1.png" width="612" height="434" />

<em><strong></strong></em>If you can't find <strong><em>"Network Setup"</em></strong> sub-menu, then you may have probably forget to save changes to <strong>wp-config.php</strong> file. If this is not a fresh wordpress, wordpress may ask you to deactivate other plugins. Deactivate them and try again.

You will be asked to make a choice between <strong>sub-domains</strong> and <strong>sub-directories </strong>setup. I find subdomains easier to deal with.
<h3>#3. Update wp-config.php</h3>
<strong></strong>Open <code>vim /var/www/example.com/htdocs/wp-config.php</code>

Paste codes given by WordPress above line:  <code>/* That’s all, stop editing! Happy blogging. */</code>
<h4>Below is sample code WordPress-Multisite using sub-directores for <code>example.com</code></h4>
<pre class="prettyprint">define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
$base = '/';
define('DOMAIN_CURRENT_SITE', 'example.com');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);</pre>
<div>
<h4>Below is sample code WordPress-Multisite using sub-domains/domain-mapping for <code>example.com</code></h4>
<pre class="prettyprint">define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', true);
$base = '/';
define('DOMAIN_CURRENT_SITE', 'mu.rtcamp.net');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);</pre>
<h3>#4. Web-Server (Nginx) Configuration</h3>
WordPress will show .htaccess rules for Apache web-server. Since we are on Nginx, these are of no use to us.

You can use any of following Nginx Configuration for your WordPress-Multisite Setup. All following config has extra instructions to activate domain-mapping.
<ol>
	<li><a title="WordPress-Multisite Nginx Configuration Using Subdirectories" href="https://easyengine.io/tutorials/wordpress-nginx-multisite-subdirectories-nginx-map/">Nginx + WordPress Multisite (Subdirectories)</a></li>
	<li><a title="Nginx + WordPress-Multisite with Subdirectories in a subdirectory itself!" href="https://easyengine.io/tutorials/wordpress-nginx-multisite-subdirectories-in-subdirectory-itself/">Nginx + WordPress Multisite (Subdirectories) in subdirectory only </a></li>
	<li><a title="WordPress-Multisite Nginx Config Using Subdirectories with WP Super Cache" href="https://easyengine.io/tutorials/wordpress-multisite-nginx-config-subdirectories-wp-super-cache/">Nginx + WordPress Multisite (Subdirectories) + WP Super Cache</a></li>
	<li><a title="Nginx + WordPress-Multisite + Subdirectories + W3 Total Cache" href="https://easyengine.io/tutorials/wordpress-multisite-nginx-config-subdirectories-w3-total-cache/">Nginx + WordPress Multisite (Subdirectories) + W3 Total Cache</a></li>
	<li><a title="Nginx + WordPress-Multisite + Subdomains + Domain-Mapping" href="https://easyengine.io/tutorials/nginx-wordpress-multisite-subdomains-domain-mapping/">Nginx + WordPress Multisite (Subdomains)</a></li>
	<li><a title="Nginx + WordPress-Multisite + Subdomains + Domain-Mapping + WP Super Cache" href="https://easyengine.io/tutorials/nginx-wordpressmultisite-subdomains-domainmapping-wp-super-cache/">Nginx + WordPress Multisite (Subdomains) + WP Super Cache</a></li>
	<li><a title="Nginx + WordPress-Multisite + Subdomains + Domain-Mapping + W3 Total Cache" href="https://easyengine.io/tutorials/nginx-wordpress-multisite-subdomains-domain-mapping-w3-total-cache/">Nginx + WordPress Multisite (Subdomains) + W3 Total Cache</a></li>
</ol>
All above article uses PHP with FPM &amp; APC.

</div>
I am also working of <a title="Nginx + WordPress + fastcgi_cache with conditional purging" href="https://easyengine.io/tutorials/wordpress-nginx-fastcgi-cache-purge-conditional/">fastcgi_cache</a> and hope to publish 3-4 articles about it towards the end of <a href="https://easyengine.io/series/wordpress-nginx-tutorials/">this series</a>. So <a href="https://easyengine.io/subscribe/">keep reading</a>! :-)