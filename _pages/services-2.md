---
ID: 3012
post_title: Services
author: Apeksha
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/wordpress-nginx/services-2/
published: true
post_date: 2012-04-25 12:55:03
---
Below is list of services/packages we offer. We strongly recommend going through FAQ and pricing details before hiring us!
<ol>
	<li>
<h5 class="rtp-margin-bottom-0 rtp-margin-top-0"><a href="#nginx-setup">Fresh WordPress-Nginx Server Setup</a></h5>
</li>
	<li>
<h5 class="rtp-margin-bottom-0 rtp-margin-top-0"><a href="#apache-nginx">Moving WordPress from Apache to Nginx</a></h5>
</li>
	<li>
<h5 class="rtp-margin-bottom-0 rtp-margin-top-0"><a href="#wordpress-setup">Moving Many Single-WordPress to a WordPress Multi-site Setup</a></h5>
</li>
	<li>
<h5 class="rtp-margin-bottom-0 rtp-margin-top-0"><a href="#other-nginx">Other Nginx Configurations</a></h5>
</li>
</ol>
<h3 class="rtp-special-title rtp-double-border-top rtp-margin-top-30 rtp-margin-bottom-30"></h3>
<h3 id="nginx-setup"><strong>A. Fresh WordPress-Nginx Server Setup</strong></h3>
In this service, we generally setup:
<ul>
	<li>Nginx with Ubuntu 12.04 Linux <em><a href="#note-1">(see note #1)</a></em></li>
	<li>PHP support with PHP-FPM <em><a href="#note-2">(see note #2)</a></em></li>
	<li>APC cache to accelerate PHP-requests <em><a href="#note-3">(see note #3)</a></em></li>
	<li>MySQL Server Setup and installation with MySQL configuration tweaking</li>
	<li>PhpMyAdmin setup to manage your databases easily</li>
	<li>WordPress Setup with support for W3 Total Cache and WP Super Cache plugin(s)<em><a href="#note-4">(see note #4)</a> </em></li>
</ul>
<strong>If needed, we also setup WordPress multi-site with following enhancements:</strong>
<ul>
	<li>Domain-mapping Support</li>
	<li>Google Sitemap Generator configuration <em><a href="#note-5">(see note #5)</a></em></li>
	<li style="text-decoration: none;">Support for X-Accel-Redirect which reduces load dramatically on your server for serving images and other attachments <em><a href="#note-6">(see note #6)</a></em></li>
	<li>Per-site forums at "/forums" like address using bbPress for forums <strong>on request</strong> <em><a href="#note-7">(see note #7)</a></em></li>
</ul>
<h3 id="apache-nginx"><strong>B. Moving WordPress from Apache to Nginx</strong></h3>
In this package, we move one or more existing WordPress sites to Nginx setup.

Cost of service, depends on number of WordPress Sites need to be moved. Each WordPress site will be configured as mentioned in above package.
<h3 id="wordpress-setup"><strong>C. Moving Many Single-WordPress to a WordPress Multi-site Setup</strong></h3>
With native support for multi-site in WordPress 3.0, many bloggers &amp; small-businesses are increasingly moving towards WordPress multi-site setup + domain mapping.

You can move from Single-WordPress to multi-site setup on your existing Apache server but we highly recommends switching to Nginx.
<h3>In this package we usually do following stuff:</h3>
<ul>
	<li>Setup a fresh WordPress multi-site + domain mapping with Nginx</li>
	<li>Configure Google Sitemap and other plugins which needs special care on multi-site running on Nginx</li>
	<li>Move your WordPress sites one by one the new multi-site setup.</li>
</ul>
<h3 id="other-nginx"><strong>D. Other Nginx Configurations</strong></h3>
Here are some of are related services/products we are working with. Some of following services are close to release. If you are interested in them, get in touch with us for more details.
<ul>
	<li><strong>Managed WordPress-Nginx webhosting</strong> - This is for busy blog/blog-network owners. We will be offering a wide range of managed webhosting packages to choose from.</li>
	<li><strong>ActiveCollab with Nginx Setup</strong> - <a href="http://www.activecollab.com/">ActiveCollab</a> is a project management system we use at rtCamp.</li>
	<li><strong>SubVersion with Nginx Setup</strong> - Goal is to use Subversion (SVN) without Apache. SVN is our only system which is using Apache as of now.</li>
	<li><strong>Nginx Control Panel</strong> - It will be a simple web-interface to do common-tasks. No need to wonder about pricing. It will be released in open-source for absolutely free soon. It will be our way of saying thank you to Igor and the entire Nginx community. :-)</li>
</ul>
<h3><em>Notes:</em></h3>
<ol>
	<li id="note-1"><em>We use Ubuntu as it has better support and we really like its package management system. As of now we do not provide service for Nginx setup with other Linux distributions. <strong>This does NOT mean that Nginx works with Ubuntu only! </strong></em></li>
	<li id="note-2"><em>PHP-FPM supports adaptive process swamping which is reason it is chosen for PHP. This means on low-traffic days, your server will run super-fast and on high-traffic days, it will slow-down slowly to avoid normal crashes! ;-)</em></li>
	<li id="note-3"><em>APC is chosen because it will be officially included in future releases of PHP . Also we are happy with the performance gain it has given us. </em></li>
	<li id="note-4"><em>W3 Total Cache will use disk-based caching for page-cache and APC for object &amp; database cache. We do not enable JavaScript/CSS minification as it often breaks a badly coded theme.</em></li>
	<li id="note-5"><em>Google-sitemap generator plugin does not work with WordPress multi-site + domain-mapping as of now. We will surely add support for this in the future.</em></li>
	<li id="note-6"><em>X-Accel Redirection is a Nginx feature which help WordPress/PHP
"pass on"</em><em> file-reading operation to Nginx. If you have a blog/site where article contains too many images, this single configuration can result in dramatic performance gains.</em></li>
	<li id="note-7"><em></em><em>Per site forum support means giving each site in a multi-site setup its own dedicated forum at an address like "/forums". This requires extremely sophisticated configuration. This is an exclusive service we provide. You will be billed separately for this!</em></li>
</ol>