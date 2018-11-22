---
ID: 70776
post_title: 'EasyEngine 2.1 Makes Mail Server Setup &#8220;Easy&#8221;'
author: Avadhoot Kulkarni
post_excerpt: >
  Today, we are excited to announce the
  release of v 2.1 of EasyEngine. The
  highlight of this release is long
  awaited Mail Server Setup.
layout: post
permalink: >
  https://easyengine.io/blog/easyengine-2-1-mail-server-setup/
published: true
post_date: 2014-09-03 21:26:13
---
Today, we are excited to announce the release of EasyEngine 2.1

The highlight of this release is long awaited Mail Server Setup which<span style="color: #000000;"> adds another automation for hasty installation and configuration of mail server.</span>

Along with it, some more features are added and issues are fixed.
<h2>Mail Server Setup</h2>
To <a title="Install Mail Packages" href="https://github.com/rtCamp/easyengine/wiki/Install-Mail-Packages">set up the mail server</a>, use the following command:
<pre>ee stack install --mail</pre>
Along with this feature, support for pt-query-advisor is also added in this release.
<h2>Bugs Fixed</h2>
<ul>
 	<li><span style="font-size: inherit;"><a title="Debug" href="https://github.com/rtCamp/easyengine/issues/299">Incorrect log file path during debug</a></span></li>
 	<li><a title="Nano Editor" href="http://community.rtcamp.com/t/ee-site-edit-domain-com-with-nano-and-putty/2858">ee site edit command on Nano editor</a></li>
</ul>
<h2>Upgrade</h2>
To update the EasyEngine, please set following line in your <code>~/.bashrc</code>
<div>
<pre>alias eeupdate="wget -qO eeup http://rt.cx/eeup &amp;&amp; sudo bash eeup"
</pre>
</div>
Let's source the ~/.bashrc
<div>
<pre>source ~/.bashrc
</pre>
</div>
Now Update EasyEngine using command:
<div>
<pre>eeupdate</pre>
If you run into any issue, please catch us on <a style="color: #3475ba;" title="Support Forum" href="http://community.rtcamp.com/category/easyengine">our easyengine support forum</a>.

<strong>Links: </strong><a style="color: #3475ba;" href="https://easyengine.io/easyengine/">EasyEngine Homepage</a> | <a style="color: #3475ba;" href="https://github.com/rtCamp/easyengine/">EasyEngine Github Repo</a> | <a title="Wiki" href="https://github.com/rtCamp/easyengine/wiki/">Wiki</a>

</div>