---
ID: 13582
post_title: Tutorials
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/wordpress-nginx/tutorials/
published: true
post_date: 2012-09-19 23:20:43
---
Starting back from 2009, till date we have moved 100+ WordPress sites to Nginx server for our clients. This journey has given us invaluable knowledge, thanks to the active &amp; helping community built around Nginx. It was time we started giving back to the community!

From our experience, we have created few tutorials which we hope you will find useful. If you get stuck, feel free to use our <a title="WordPress Nginx Support Forum" href="https://easyengine.io/support/forum/wordpress-nginx/">free support forum</a>.
<h3>Basics</h3>
<div class="rtp-section-wrap row ">
<div class="vc_col-sm-12 wpb_column vc_column_container ">
<div class="wpb_wrapper">
<div class="wpb_text_column wpb_content_element ">
<div class="wpb_wrapper ">
<ol>
	<li><a href="https://easyengine.io/wordpress-nginx/tutorials/conventions/">Conventions &amp; File System Layout for Ideal WordPress-Nginx Setup</a></li>
	<li><a title="Permanent Link to Installing PHP+APC, MySQL, Postfix &amp; Nginx for WordPress on Ubuntu" href="https://easyengine.io/tutorials/linux/ubuntu-php-mysql-nginx-postfix/" rel="bookmark">Installing PHP+APC, MySQL, Postfix &amp; Nginx for WordPress on Ubuntu</a></li>
</ol>
</div>
</div>
</div>
</div>
</div>
<div class="rtp-section-wrap row ">
<div class="vc_col-sm-12 wpb_column vc_column_container ">
<div class="wpb_wrapper">
<div class="wpb_text_column wpb_content_element ">
<div class="wpb_wrapper ">
<h3 id="wordpress-nginx-configurations">WordPress-Nginx Configurations</h3>
<table>
<thead>
<tr>
<th>Page-Caching\Setup</th>
<th>Single-WordPress</th>
<th>Multisite with Subdirectories</th>
<th>Multisite with Subdomains</th>
</tr>
</thead>
<tbody>
<tr>
<td>No-Cache</td>
<td><a title="Installing Fresh WordPress on Nginx Server (Minimal Configuration)" href="https://easyengine.io/wordpress-nginx/tutorials/single-site/minimal/">Link</a></td>
<td><a title="Nginx + WordPress-Multisite + Subdirectories" href="https://easyengine.io/wordpress-nginx/tutorials/multisite/subdirectories/minimal/">Link</a></td>
<td><a title="Nginx + WordPress Multisite + Subdomains" href="https://easyengine.io/wordpress-nginx/tutorials/multisite/subdomains/minimal/">Link</a></td>
</tr>
<tr>
<td>WP Super Cache</td>
<td><a title="WordPress + Nginx + WP Super cache" href="https://easyengine.io/wordpress-nginx/tutorials/single-site/wp-super-cache/">Link</a></td>
<td><a title="Nginx + WordPress Multisite + Subdirectories + WP Super Cache" href="https://easyengine.io/wordpress-nginx/tutorials/multisite/subdirectories/wp-super-cache/">Link</a></td>
<td><a title="Nginx + WordPress Multisite + Subdomains + WP Super Cache" href="https://easyengine.io/wordpress-nginx/tutorials/multisite/subdomains/wp-super-cache/">Link</a></td>
</tr>
<tr>
<td>W3 Total Cache</td>
<td><a title="WordPress + Nginx + W3 Total Cache" href="https://easyengine.io/wordpress-nginx/tutorials/single-site/w3-total-cache/">Link</a></td>
<td><a title="Nginx + WordPress Multisite + Subdirectories + W3 Total Cache" href="https://easyengine.io/wordpress-nginx/tutorials/multisite/subdirectories/w3-total-cache/">Link</a></td>
<td><a title="Nginx + WordPress Multisite + Subdomains + W3 Total Cache" href="https://easyengine.io/wordpress-nginx/tutorials/multisite/subdomains/w3-total-cache/">Link</a></td>
</tr>
<tr>
<td>Nginx’s fastcgi-cache</td>
<td><a title="WordPress + Nginx + fastcgi_cache" href="https://easyengine.io/wordpress-nginx/tutorials/single-site/fastcgi-cache-with-purging/">Link</a></td>
<td><a title="Nginx + WordPress Multisite + Subdirectories + fastcgi_cache" href="https://easyengine.io/wordpress-nginx/tutorials/multisite/subdirectories/fastcgi-cache-with-purging/">Link</a></td>
<td><a title="Nginx + WordPress Multisite + Subdomains + fastcgi_cache" href="https://easyengine.io/wordpress-nginx/tutorials/multisite/subdomains/fastcgi-cache-with-purging/">Link</a></td>
</tr>
<tr>
<td>Nginx’s Redis-cache</td>
<td><a title="Nginx + WordPress + redis_cache with conditional purging" href="https://easyengine.io/wordpress-nginx/tutorials/single-site/redis_cache-with-conditional-purging/">Link</a></td>
<td><a title="Nginx + WordPress-Multisite + Subdirectories + redis_cache with conditional purging + (optional) Domain-Mapping" href="https://easyengine.io/wordpress-nginx/tutorials/multisite/subdirectories/redis_cache-conditional-purging-optional-domain-mapping/">Link</a></td>
<td><a title="Nginx + WordPress-Multisite + Subdomains + redis_cache with conditional purging + (optional) Domain-Mapping" href="https://easyengine.io/wordpress-nginx/tutorials/multisite/subdomains/redis_cache-conditional-purging-optional-domain-mapping/">Link</a></td>
</tr>
</tbody>
</table>
<div class="rtp-section-wrap row ">
<div class="vc_col-sm-12 wpb_column vc_column_container ">
<div class="wpb_wrapper">
<div class="wpb_text_column wpb_content_element ">
<div class="wpb_wrapper ">
<h3><strong>Notes:</strong></h3>
<ol>
	<li>Both, multisite with subdirectory and multisite with subdomains config supports domain-mapping</li>
	<li>fastcgi-cache is recommended way but for advance users</li>
	<li>In addition to page-caching, use an object-cache and mysql-cache preferably using APC.</li>
	<li>If you are using <a title="Nginx + WordPress-Multisite + Subdirectories (in a subdirectory itself)" href="https://easyengine.io/tutorials/nginx-wordpress-multisite-subdirectories-in-a-subdirectory-itself/">wordpress-multisite with subdirectories in a subdirectory itself, try this config.</a></li>
</ol>
</div>
</div>
</div>
</div>
</div>
<div class="rtp-section-wrap row ">
<div class="vc_col-sm-12 wpb_column vc_column_container ">
<div class="wpb_wrapper">
<div class="wpb_text_column wpb_content_element ">
<div class="wpb_wrapper ">
<h3 id="updates">Updates…</h3>
We will keep updating above sections as we move ahead.

You can find more tutorials at <a href="https://easyengine.io/tutorials/">https://easyengine.io/tutorials/</a>.

<a href="https://easyengine.io/subscribe">You can subscribe to our blog to get future article automatically</a>.

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>