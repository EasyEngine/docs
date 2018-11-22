---
ID: 13765
post_title: >
  WordPress-Multisite + Domain-Mapping
  Guide
author: Rahul Bansal
post_excerpt: >
  This guide covers how to setup
  Domain-Mapping itself and also how to
  configure/map external domains to sites
  in WordPress-multisite
layout: page
permalink: >
  https://easyengine.io/wordpress-nginx/tutorials/multisite/domain-mappinng/
published: true
post_date: 2012-09-21 00:52:13
---
<a href="https://easyengine.io/series/wordpress-nginx-tutorials/"><img class="alignright size-full wp-image-10804" title="wordpress-nginx" alt="" src="https://easyengine.io/wp-content/uploads/2012/09/wordpress-nginx.jpeg" width="220" height="91" /></a>There are 2 ways in which you can map external domains to sites inside a Multisite network. You can either use 'A' record or use 'CNAME' record at DNS end (for domain being mapped).

In this article, I will explain how to setup Domain-Mapping itself and then how to configure or map external domains in WordPress-Multisite.

Before you go ahead, you must have a <a title="Creating A WordPress Multisite Network with Nginx" href="https://easyengine.io/tutorials/creating-wordpress-multisite-network-nginx/">WordPress Multisite Network</a> created using subdomains or subdirectory.
<h3>WordPress Multisite Domain-Mapping Setup <em>(one-time)</em></h3>
This is one-time activity only.
<ol>
	<li>Install <a href="http://wordpress.org/extend/plugins/wordpress-mu-domain-mapping/">WordPress MU Domain Mapping</a> plugin. Activate it Network-wide.</li>
	<li>Add the following line in <em>wp-config.php</em> file. (<code>vim /var/www/example.com/htdocs/wp-config.php</code>)</li>
</ol>
<pre>define( 'SUNRISE', 'on' );</pre>
<ol start="3">
	<li>Copy <code>sunrise.php</code> from Domain-mapping plugins folder to <code>wp-content</code> folder of your WordPress setup.</li>
</ol>
<pre>cp /var/www/example.com/htdocs/wp-content/plugins/wordpress-mu-domain-mapping/sunrise.php /var/www/example.com/htdocs/wp-content/</pre>
<ol start="4">
	<li>After this, go to <code>Network Admin &gt;&gt; Dashboard &gt;&gt; Settings &gt;&gt; Domain Mapping</code> menu.</li>
	<li>On next screen, either provide IP address of your server or a CNAME record which you want to use with other domains. <span class="rtp-error"><strong>Note:</strong> If you add both - an IP address and a CNAME record, only CNAME will work!</span></li>
	<li>Apart from this, you will notice few more settings: <strong>"Domain Options"</strong>. You can leave them as it is. I recommend enabling the <strong>"Permanent redirect" </strong>option.</li>
</ol>
<div>That's all. At this point your WordPress network is ready to handle domain mapping.</div>
<h4>IP-Address (A-record) v/s CNAME-records based Domain Mapping</h4>
If you are confused what to use, the following may help you make a choice:
<ol>
	<li>IP-address based domain mapping uses A-records. IP-Address based domain-mapping will be slightly faster as it saves 1 DNS look-ups. This advantage is not significant since most name-servers use caches.</li>
	<li>CNAME-records are easy to manage, if you will be hosting 100's of sites on your network. If you change IP of your WordPress server, say change in hosting service, then you will need to make update IP address for your own CNAME record only. In other case, you need to update IP address for all A-records for all domains mapped to your server.</li>
</ol>
<strong>Dedicated IP:</strong>

In both cases, your server must have a dedicated IP address. You can host other sites on same IP address but you cannot host 2 or more WordPress Multisite networks with domain mapping on same IP address.
<h3>Mapping External Domains to sites in WordPress-Multisite <em>(ongoing)</em></h3>
You can create new sites as usual in your WordPress-Multisite network. You will need to follow these extra steps in case you wish to map one or more domains to network sites.
<ol>
	<li>Go to <code>Network Admin &gt;&gt; All Sites</code>list</li>
	<li>Click on edit link for a site for which you want to map external domain.</li>
	<li>If link is =&gt; http://example.com/wp-admin/network/site-info.php?id=5 ; your site-id =&gt; 5</li>
	<li>Go to <code>Network Admin &gt;&gt; Dashboard &gt;&gt; Settings &gt;&gt; Domains</code></li>
	<li>Look for <code>New Domain</code> option</li>
	<li>Enter site-id and external-domain name.</li>
	<li>Click <code>Save</code> button!</li>
</ol>
<strong>Screenshot:</strong>
<div><a href="https://easyengine.io/wp-content/uploads/2012/09/Add-domain-in-domain-mapping.png"><img class="alignnone size-full wp-image-13785" title="Add-domain-in-domain-mapping" alt="" src="https://easyengine.io/wp-content/uploads/2012/09/Add-domain-in-domain-mapping.png" width="603" height="379" /></a></div>
At this point, you need to add a CNAME-record or A-record for external domain at your DNS registrar end. Since instructions for them vary from domain to domain its not possible to post all of them here! You can Google for help or contact your domain registrar! :-)

<strong>Link:</strong> <a href="https://easyengine.io/series/wordpress-nginx-tutorials/">WordPress-Nginx Configurations</a>