---
ID: 49021
post_title: >
  CDN77 Configuration with W3 Total Cache
  WordPress
author: Abhishek Kaushik
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/cdn/cdn77-configuration-w3-total-cache-wordpress/
published: true
post_date: 2013-10-18 13:13:36
---
In this tutorial we will show you how to configure CDN on <a href="http://www.cdn77.com/" target="_blank">cdn77.com</a> with W3 TOTAL CACHE.
<h5>Configuring CDN with CDN77 on your WordPress is really easy with some simple steps:</h5>
<ol>
	<li>Go to <a href="http://www.cdn77.com/">cdn77.com</a> and login there.</li>
	<li>Under CDN tab click on <strong>New CDN Resource.<a href="https://easyengine.io/wp-content/uploads/2013/10/add-new-cdn.png"><img style="padding-top: 0px; padding-left: 0px; padding-right: 0px; border-width: 0px;" title="add-new-cdn" alt="add-new-cdn" src="https://easyengine.io/wp-content/uploads/2013/10/add-new-cdn_thumb.png" width="639" height="283" border="0" /></a></strong></li>
	<li>Under <strong>Original </strong>section,  enter your hostname where you want to configure CDN.</li>
	<li>Under <strong>CNAMEs</strong> section, enter CDN hostname <strong>e.g. cdn.example.com </strong>(You can choose any name of your choice).<a href="https://easyengine.io/wp-content/uploads/2013/10/create-cdn4.png"><img style="padding-top: 0px; padding-left: 0px; padding-right: 0px; border-width: 0px;" title="create-cdn" alt="create-cdn" src="https://easyengine.io/wp-content/uploads/2013/10/create-cdn_thumb4.png" width="643" height="370" border="0" /></a></li>
	<li>Again go to CDN tab, you can see newly created  CDN there, click on <strong>manage</strong> button.</li>
	<li>Go to <strong>Instructions</strong> tab and copy CNAME Record for DNS Settings, your host will be cdn.example.com.<a href="https://easyengine.io/wp-content/uploads/2013/10/copy-cdn1.png"><img style="padding-top: 0px; padding-left: 0px; padding-right: 0px; border: 0px;" title="copy-cdn" alt="copy-cdn" src="https://easyengine.io/wp-content/uploads/2013/10/copy-cdn_thumb1.png" width="640" height="379" border="0" /></a></li>
	<li>Go to domain registration account where your website is registered (We are taking example of GODADDY).</li>
	<li>Go to <strong>DNS Zone file</strong>, click on <strong>Edit </strong>button.<a href="https://easyengine.io/wp-content/uploads/2013/10/edit-dns5.png"><img title="edit-dns" alt="edit-dns" src="https://easyengine.io/wp-content/uploads/2013/10/edit-dns_thumb5.png" width="640" height="295" border="0" /></a></li>
	<li>Under CNAME section click on <strong>Quick Edit.</strong></li>
	<li>Add cdn hostname under <strong>Host</strong> Section and add CNAME Record (that you copied while creating CDN) under <strong>Points to</strong> Section.<a href="https://easyengine.io/wp-content/uploads/2013/10/add-cname4.png"><img title="add-cname" alt="add-cname" src="https://easyengine.io/wp-content/uploads/2013/10/add-cname_thumb4.png" width="640" height="171" border="0" /></a></li>
	<li>Now go to your WordPress Website's admin page and then go to <strong>W3 TOTAL CACHE</strong> <em>General Settings</em>.</li>
	<li>Under CDN Section Click on Enable checkbox and set CDN Type to Generic Mirror.<a href="https://easyengine.io/wp-content/uploads/2013/10/cdn-settings1.png"><img title="cdn-settings" alt="cdn-settings" src="https://easyengine.io/wp-content/uploads/2013/10/cdn-settings_thumb1.png" width="640" height="286" border="0" /></a></li>
	<li>Now Go to Performance &gt; CDN and add your CDN Hostname there.<a href="https://easyengine.io/wp-content/uploads/2013/10/w3-total-cache-add-cdn.png"><img title="w3-total-cache-add-cdn" alt="w3-total-cache-add-cdn" src="https://easyengine.io/wp-content/uploads/2013/10/w3-total-cache-add-cdn_thumb.png" width="640" height="362" border="0" /></a></li>
	<li>Click on Save settings.</li>
</ol>
Now you have configured CDN on CDN.NET with W3 Total Cache.