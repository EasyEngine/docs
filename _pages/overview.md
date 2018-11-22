---
ID: 12735
post_title: >
  Subdirectory, Subdomain, Domain Mapping
  Overview
author: Rahul Bansal
post_excerpt: 'A quick overview/comparison of different WordPress-multisite configuration modes. Followed by answer to question - "is wordpress multisite right choice?"'
layout: page
permalink: >
  https://easyengine.io/wordpress-nginx/tutorials/multisite/overview/
published: true
post_date: 2012-09-17 16:36:50
---
<a href="https://easyengine.io/series/wordpress-nginx-tutorials/"><img class="alignright size-full wp-image-10804" title="wordpress-nginx" src="https://easyengine.io/wp-content/uploads/2012/09/wordpress-nginx.jpeg" alt="" width="220" height="91" /></a>After exploring <a title="Installing Fresh WordPress on Nginx Server (Minimal Configuration)" href="https://easyengine.io/tutorials/installing-fresh-wordpress-nginx-minimal/">WordPress-Nginx Configurations for standard/single-site setup</a>, its time to explore WordPress-Nginx Configuration for Multisite setup.

In today's article, we will take a general overview of WordPress-Multisite. Then in the subsequent chapters we will explore different Nginx configurations.
<h3>WordPress Multisite</h3>
There are three ways in which WordPress Multisite can be configured. Each has its own use cases and different level of setup complexity.
<table class="aligncenter">
<tbody>
<tr>
<th>Configuration</th>
<th>Sub-directory mode</th>
<th>Sub-domain mode</th>
<th>Sub-domain with Domain Mapping</th>
</tr>
<tr>
<td>Site Address Examples</td>
<td>example.com/site1
example.com/site2</td>
<td>site1.example.com
site2.example.com</td>
<td>site1.com
site2.com</td>
</tr>
<tr>
<td>DNS requirement</td>
<td>None</td>
<td>Wildcard domain name support</td>
<td>Wildcard domain name support</td>
</tr>
<tr>
<td>Ongoing DNS Efforts</td>
<td>None</td>
<td>None</td>
<td>Creation of "A" or "CNAME" record for "mapped" domains</td>
</tr>
<tr>
<td>Dedicated IP</td>
<td>Not Required</td>
<td>Not Required</td>
<td>Required - if we want to use A-records for "mapped" domains</td>
</tr>
<tr>
<td>Common Usage</td>
<td>Development environment, Demo Sites</td>
<td>Blog Networks with generally common owner, Community Sites</td>
<td>Open Blog Networks, WordPress as CMS hosting</td>
</tr>
</tbody>
</table>
<em><strong>* Note:</strong> In domain mapping mode, its not compulsory to map top level domain for every site in Multisite.</em>

There are some differences and quirks you need to be familiar when running a WordPress-Multisite network. All of these will be addressed in separate chapters for three modes.

If you have never used WordPress Multisite before, its better to check right now if it is a good choice going ahead. We get this question many times from our clients.
<h4>Is WordPress multisite right choice?</h4>
WordPress multisite has many advantages but in some cases you may regret going for it. For this reason I am addressing this question earlier and quickly.

<strong>WordPress-Multisite may prove bad:</strong>
<ol>
	<li>If there is remarkable difference between functionality of sites. For example, if you put mixture sites running e-commerce, event-website, membership portal, bbPress-forums, job-boards, community blogs, big CMS, wikis, etc - you will end-up with complicated user-permissions which you will find hard to manage. There are <a href="http://wordpress.org/extend/plugins/multisite-plugin-manager/">some plugins</a> to help you out but from management perspective you will have hard-time.</li>
	<li>As you host hybrid sites, total number of plugins will keep going up. You can activate/deactivate plugins per site, but then again managing plugins will get tough. Also, if plugins you uninstall leaves a database tables behind, your WordPress database will become bloated soon.</li>
	<li>One poorly coded theme/plugin can bring an entire network down. I see people using poorly coded/outdated plugins in Multisite. They think a bad plugin may impact just 1 site but most likely it will degrade the performance of the entire network.</li>
</ol>
<strong>Good things about WordPress-Multisite:</strong>
<ol>
	<li>Multisite works very well when you have similar sites in network. For example, <a href="http://wordpress.com">wordpress.com</a> itself. They offer some paid-feature but list of plugins/themes they maintain is same across all sites.</li>
	<li>It has some administrative advantages like ease of maintaining WordPress in terms of backup, upgrades, etc. But this can be done easily using other tools &amp; scripts so this advantage alone is not worth going for WordPress Multisite.</li>
</ol>
Technically, Multisite comes with some performance issues out of the box, but these can be solved by small tweaks. In terms of scaliblity, you can again look at <a href="http://en.wordpress.com/stats/">wordpress.com stats</a> which is proof of WordPress Multisite scalability! So performance issue can be ignored if you are willing to put some efforts into tweaking.

Nginx itself is capable of handing many performance issues. I will shed more light on this in the next chapters.

Tomorrow, we will deal with <a title="Creating a WordPress Multisite Network with Nginx" href="https://easyengine.io/tutorials/creating-wordpress-multisite-network-nginx/">WordPress-Multisite configuration</a> with some optimization! <a href="https://easyengine.io/subscribe">Keep reading</a>!

You can also find the complete list of <a href="https://easyengine.io/series/wordpress-nginx-tutorials/">WordPress-Nginx tutorials</a> here.