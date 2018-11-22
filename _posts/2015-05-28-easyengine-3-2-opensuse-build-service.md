---
ID: 85078
post_title: >
  EasyEngine 3.2 with openSUSE Build
  Service
author: Dinesh Jain
post_excerpt: >
  EasyEngine 3.2 with openSUSE Build
  Service. This means EasyEngine stack
  install process will be more stable
  across debian and ubuntu.
layout: post
permalink: >
  https://easyengine.io/blog/easyengine-3-2-opensuse-build-service/
published: true
post_date: 2015-05-28 15:20:06
---
Recently <a href="https://www.dotdeb.org/">Dotdeb</a> had made changes in their Nginx configuration due to which EasyEngine users faced many issues as reported on <a href="https://github.com/rtCamp/easyengine/issues">Github </a> and <a href="http://community.rtcamp.com/c/easyengine">community support forum</a>.
<ul>
	<li><a href="https://github.com/rtCamp/easyengine/issues/546" target="_blank">https://github.com/rtCamp/easyengine/issues/546</a></li>
	<li><a href="https://github.com/rtCamp/easyengine/issues/539" target="_blank">https://github.com/rtCamp/easyengine/issues/539</a></li>
	<li><a href="http://community.rtcamp.com/t/after-debian-dotdeb-nginx-and-ee-upgrade-i-got-blank-web-pages/4506" target="_blank">http://community.rtcamp.com/t/after-debian-dotdeb-nginx-and-ee-upgrade-i-got-blank-web-pages/4506</a></li>
</ul>
To overcome such issues we first try to patch EasyEngine by adding conditional logic to separate between Debian and Ubuntu setups. Soon we realized there are too many conditional statements as this issue popped many times.

EE felt fragile as another nginx config change could broke EE again! So we started looking for a solution where we could build Ubuntu and Debian packages in same way.

We came across many solutions but we ended up using <a href="https://build.opensuse.org/">openSUSE Build Service</a>.

Packages built status can be checked here: <a href="https://build.opensuse.org/project/monitor/home:rtCamp:EasyEngine">https://build.opensuse.org/project/monitor/home:rtCamp:EasyEngine</a>
<h2>Goal of this release</h2>
#1 goal of entire EasyEngine project is to make things easy as it's name suggest.

Issues that arose from external package dependency too most of our time, and prevented many users from using EasyEngine.

If install of any software fails, remainder of it doesn't matter!

That is why our entire EasyEngine team spent almost 2 weeks in solving this single problem with single goal to make sure <code>ee stack install</code> should always works. We hope to see significantly lower issues related to package managers ahead.

Other positive side-effect of this change is - EasyEngine might soon support non-LTS Ubuntu releases and may be even Non-Debian distros.

We plan to build php and other packages EasyEngine depends on ourself soon. Idea is to remove every hurdle in between you and high performance self-managed WordPress-Nginx hosting! :-)
<h2>Upgrading to EasyEngine 3.2</h2>
Existing EasyEngine users don’t have to worry about their configuration as EasyEngine will first backup their current server <code>nginx.conf</code> and <code>ee-nginx.conf</code> and then will create a new nginx.conf
<p class="rtp-warning"><strong>Note:</strong> While updating EasyEngine, your old repository will be removed and new Nginx repository will be installed. Due to this there might be a downtime of few minutes.</p>
Please run following command to update EasyEngine to the latest version.
<pre class="nginx">ee update</pre>
If the above command fails, that means you are running EasyEngine version older than 3.0.6. In that case, please use following command
<pre class="nginx">wget -qO eeup http://rt.cx/eeup &amp;&amp; sudo bash eeup</pre>
If you run into any issue, please catch us on <a title="EasyEngine community support forum" href="http://community.rtcamp.com/category/easyengine">our EasyEngine community support forum</a>.

Non-EasyEngine users can also use <a href="http://software.opensuse.org/download.html?project=home%3ArtCamp%3AEasyEngine&amp;package=nginx" target="_blank">EasyEngine Nginx package</a>.

<strong>Links:</strong> <a href="https://easyengine.io/easyengine">EasyEngine Home</a> | <a href="https://github.com/rtCamp/easyengine">Github Repo</a> | <a href="https://easyengine.io/docs/">EasyEngine Docs</a>