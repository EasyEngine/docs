---
ID: 48720
post_title: >
  CDN.NET Configuration with W3 Total
  Cache WordPress
author: Abhishek Kaushik
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/cdn/cdn-net-configuration-w3-total-cache-wordpress/
published: true
post_date: 2013-10-15 16:34:16
---
In this tutorial we will show you how to configure CDN on <a href="http://www.cdn.net/">cdn.net</a> with W3 TOTAL CACHE.
<h3>Configuring CDN on your WordPress is really easy with some simple steps:</h3>
<ol>
	<li>Go to <a href="http://www.cdn.net/" target="_blank">cdn.net</a> and login there.</li>
	<li>Click on <strong>create HTTP.<a href="https://easyengine.io/wp-content/uploads/2013/10/create-cdn3.png"><img style="padding-top: 0px; padding-left: 0px; padding-right: 0px; border-width: 0px;" title="create-cdn" alt="create-cdn" src="https://easyengine.io/wp-content/uploads/2013/10/create-cdn_thumb3.png" width="640" height="346" border="0" /></a></strong></li>
	<li>Under <strong>Original hostname</strong> section,  enter your hostname where you want to configure CDN.</li>
	<li>Under CDN hostname section, enter CDN hostname <strong>e.g. cdn.example.com </strong>(You can choose any name of your choice).</li>
	<li>Leave everything else as it is and click on <strong>Create CDN</strong>.<a href="https://easyengine.io/wp-content/uploads/2013/10/add-cdn3.png"><img style="padding-top: 0px; padding-left: 0px; padding-right: 0px; border-width: 0px;" title="add-cdn" alt="add-cdn" src="https://easyengine.io/wp-content/uploads/2013/10/add-cdn_thumb3.png" width="639" height="440" border="0" /></a></li>
	<li>Now you will get success message for creating CDN and you can see the CNAME record on the bottom of the message, please copy your CDN hostname and CNAME Record for further use.<a href="https://easyengine.io/wp-content/uploads/2013/10/success-massage3.png"><img style="padding-top: 0px; padding-left: 0px; padding-right: 0px; border-width: 0px;" title="success-massage" alt="success-massage" src="https://easyengine.io/wp-content/uploads/2013/10/success-massage_thumb3.png" width="640" height="268" border="0" /></a></li>
	<li>Go to domain registration account where your website is registered (We are taking example of GODADDY).</li>
	<li>Go to <strong>DNS Zone file</strong>, click on <strong>Edit </strong>button.<a href="https://easyengine.io/wp-content/uploads/2013/10/edit-dns5.png"><img style="padding-top: 0px; padding-left: 0px; padding-right: 0px; border: 0px;" title="edit-dns" alt="edit-dns" src="https://easyengine.io/wp-content/uploads/2013/10/edit-dns_thumb5.png" width="640" height="295" border="0" /></a></li>
	<li>Under CNAME section click on <strong>Quick Edit.</strong></li>
	<li>Add cdn hostname under <strong>Host</strong> Section and add CNAME Record (that you copied while creating CDN) under <strong>Points to</strong> Section.<a href="https://easyengine.io/wp-content/uploads/2013/10/add-cname4.png"><img style="padding-top: 0px; padding-left: 0px; padding-right: 0px; border: 0px;" title="add-cname" alt="add-cname" src="https://easyengine.io/wp-content/uploads/2013/10/add-cname_thumb4.png" width="640" height="171" border="0" /></a></li>
	<li>Now go to your WordPress Website's admin page and then go to <strong>W3 TOTAL CACHE</strong>  <em>General Settings</em>.</li>
	<li>Under CDN Section Click on Enable checkbox and set CDN Type to Generic Mirror.<a href="https://easyengine.io/wp-content/uploads/2013/10/cdn-settings1.png"><img style="padding-top: 0px; padding-left: 0px; padding-right: 0px; border-width: 0px;" title="cdn-settings" alt="cdn-settings" src="https://easyengine.io/wp-content/uploads/2013/10/cdn-settings_thumb1.png" width="640" height="286" border="0" /></a></li>
	<li>Now Go to Performance &gt; CDN and add your CDN Hostname there.<a href="https://easyengine.io/wp-content/uploads/2013/10/w3-total-cache-add-cdn.png"><img style="padding-top: 0px; padding-left: 0px; padding-right: 0px; border: 0px;" title="w3-total-cache-add-cdn" alt="w3-total-cache-add-cdn" src="https://easyengine.io/wp-content/uploads/2013/10/w3-total-cache-add-cdn_thumb.png" width="640" height="362" border="0" /></a></li>
	<li>Click on Save settings.</li>
</ol>
Now you have configured CDN on CDN.NET with W3 Total Cache.