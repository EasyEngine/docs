---
ID: 64489
post_title: >
  EasyEngine 1.3.4 with better Ubuntu
  Support
author: Rahul Bansal
post_excerpt: 'EasyEngine version 1.3.4 adds support for Ubuntu 12.04, 12.10, 13.10 & 14.04 and latest nginx version 1.4.7'
layout: post
permalink: >
  https://easyengine.io/blog/easyengine-1-3-4-better-ubuntu-support/
published: true
post_date: 2014-04-22 20:09:14
---
Recently, a new Ubuntu LTS release, version 14.04, became available.

EasyEngine was using <a href="https://launchpad.net/~brianmercer/+archive/nginx">Brian Mercer's launchpad</a> repo for nginx and this repo was not updated for any version after 12.04, hence EasyEngine was not working on new distros. So we setup our own <a href="https://launchpad.net/~rtcamp/+archive/nginx">launchpad repo</a> to rectify situation.
<h2>Changelog</h2>
Even though, this is a minor release, it addresses many issues.
<ul>
	<li>Supports Ubuntu 12.04, 12.10, 13.10 &amp; 14.04 (fixed issues <a title="Support for newer versions of Ubuntu" href="https://github.com/rtCamp/easyengine/issues/94">#94</a> and <a title="Ubuntu 14.04" href="https://github.com/rtCamp/easyengine/issues/195">#195</a>)</li>
	<li>Change FPM process management from dynamic to ondemand (fixed issue <a title="PHP5-FPM consuming all CPU, 504 Gateway Time Out" href="https://github.com/rtCamp/easyengine/issues/184">#184</a>)</li>
	<li>Show php memory limit in <code>ee info</code> command (fixed issue <a title="ee info command issue" href="https://github.com/rtCamp/easyengine/issues/188">#188</a>)</li>
	<li>Fixed Debian 6 wget command issue (found during testing)</li>
	<li>Upgrade Nginx to latest stable version 1.4.7</li>
</ul>
Please note that Ubuntu version 13.04 has reached end of life and Launchpad doesn't allow packages to be built for outdated distro versions.
<h2>Upgrading</h2>
Existing users can simply run  <code>ee update</code> to upgrade EasyEngine and Nginx to latest version.