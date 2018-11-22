---
ID: 141217
post_title: >
  Nginx Helper v1.9.8 Plugin Maintenance
  Release
author: Radhe
post_excerpt: ""
layout: post
permalink: >
  https://easyengine.io/blog/nginx-helper-v1-9-8-maintenance-release/
published: true
post_date: 2016-09-07 12:20:31
---
Some of the fixes in Nginx Helper v1.9.8 Plugin includes
<h2>One Nginx Helper Log file for WordPress Multisite:</h2>
Nginx helper plugin will create one log file per WordPress Multisite setup. To make it simple, all the WordPress Multisite logs will be added under one log file.
<h2></h2>
<h2>Redis page cache purge logic fix:</h2>
Now Prefix and Hostname is being used so that Purge action does not effect other site's page cache.
<h2></h2>
<h2>Change Log</h2>
<ul>
 	<li>Multilingual homepage cache cleared with WordPress Multisite plugin <a href="https://github.com/rtCamp/nginx-helper/pull/116">#116</a></li>
 	<li>Fix - Purge Cache clears the whole Redis cache <a href="https://github.com/rtCamp/nginx-helper/issues/113">#113</a></li>
 	<li>Single site Redis cache purge when click on Purge Cache button under WordPress Multisite <a href="https://github.com/rtCamp/nginx-helper/pull/122">#122</a></li>
 	<li>Fix - notices and warnings.</li>
</ul>
Contributors to this release: <a href="https://github.com/HansVanEijsden">Niwreg</a>, <a href="https://github.com/HansVanEijsden">HansVanEijsden</a>, <a href="https://github.com/larssn">Larssn</a>, <a href="https://github.com/chandra-patel">Chandra-patel</a>

If you have any issues feel free to use <a href="http://community.rtcamp.com/c/wordpress-nginx">community support</a>.