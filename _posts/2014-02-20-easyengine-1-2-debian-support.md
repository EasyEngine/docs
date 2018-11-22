---
ID: 57702
post_title: EasyEngine 1.2 with Debian Support
author: Rahul Bansal
post_excerpt: >
  EasyEngine adds support for Debian 6 and
  Debian 7
layout: post
permalink: >
  https://easyengine.io/blog/easyengine-1-2-debian-support/
published: true
post_date: 2014-02-20 19:27:22
---
<a href="https://easyengine.io/wp-content/uploads/2014/02/easyengine-debian1.jpg"><img class="alignright  wp-image-57730" alt="easyengine-debian" src="https://easyengine.io/wp-content/uploads/2014/02/easyengine-debian1.jpg" width="312" height="204" /></a>Latest release of EasyEngine 1.2 added support for Debian 6 and 7 using packages from <a href="http://www.dotdeb.org/">dotdeb.org</a>.

Debian support wasn't planned anytime early but when we visited <a href="http://www.dotdeb.org/">dotdeb.org</a> we found their package list as per our expectation.
<h2>Version Notes</h2>
For Debian 7, PHP 5.5 will be installed.

For Debian 6, PHP 5.4 will be installed.

DotDeb repo do not have <a href="http://www.dotdeb.org/instructions/">PHP 5.5 for Debian 6</a>.

We have tested complete EasyEngine 1.2 on following distros:
<ol>
	<li>Debian-7 (64-bit)</li>
	<li>Debian-7 (32-bit)</li>
	<li>Debian-6 (64-bit)</li>
	<li>Debian-6 (32-bit)</li>
</ol>
Still, if you run into any issues, feel free to use <a href="https://easyengine.io/support/forum/easyengine/">EasyEngine support forum</a>.
<h2>Upgrade Notes</h2>
This release only changes installer part. So if you have a server with easyengine up and running, you no need to worry about upgrades.

Though if you run EasyEngine upgrade - i.e. <code>ee upgrade</code> command, nothing will break on your system.
<h2>Special Thanks</h2>
Debian support would not have been possible without <a href="http://www.dotdeb.org/">DotDeb</a> repo. So special thanks to DotDeb team. :-)

Also credit for this release goes to Mitesh Shah, who completed Debian support in less than 8 hours!

<strong>Links: </strong><a href="http://rtcamp.com/easyengine">EasyEngine Home</a> | <a href="https://github.com/rtCamp/easyengine">Github Repo</a> | <a href="https://easyengine.io/support/forum/easyengine/">Support Forum</a>