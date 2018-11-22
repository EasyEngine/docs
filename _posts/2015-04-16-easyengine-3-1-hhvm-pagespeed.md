---
ID: 82931
post_title: EasyEngine 3.1 with HHVM and PageSpeed
author: Dinesh Jain
post_excerpt: >
  EasyEngine 3.1 is released with new
  features that allow creating/updating
  sites to work with HHVM and Pagespeed
  using one-line command.
layout: post
permalink: >
  https://easyengine.io/blog/easyengine-3-1-hhvm-pagespeed/
published: true
post_date: 2015-04-16 18:13:55
---
Today we are releasing EasyEngine 3.1, our first major release with new features, after <a href="https://easyengine.io/blog/easyengine-3-python-release/">moving to Python</a>.

We are excited to announce support for <a title="HHVM" href="http://hhvm.com/">HHVM</a> and <a title="Pagespeed" href="https://developers.google.com/speed/pagespeed/module/">PageSpeed</a> with simplicity of EasyEngine with this release.

<a href="http://hhvm.com/">HHVM</a> (aka the HipHop Virtual Machine) is much faster implementation of PHP. <a title="HHVM is developed by Facebook" href="https://github.com/facebook/hhvm">HHVM is developed by Facebook</a> and used on <a title="facebook.com" href="https://www.facebook.com">facebook.com</a> itself.

<a title="PageSpeed" href="https://developers.google.com/speed/pagespeed/module">PageSpeed</a> is a project to improve load time of webpages by optimizing them on server side. <a title="PageSpeed is developed by Google" href="https://github.com/pagespeed">PageSpeed is developed by Google</a>.

So with this release you will have easy access to two powerful tools by two giants. :-)
<h2>Using HHVM</h2>
You can create a site with HHVM by adding <code style="font-size: inherit; line-height: 1.9;">--hhvm</code> to site creation command
<pre class="nginx">ee site create example.com --wp --hhvm</pre>
For existing site you can use <code>update</code> command
<pre class="nginx">ee site update example.com --wp --hhvm</pre>
EasyEngine already adds FPM fallback for all HHVM sites. This means if for some reason HHVM crashes, sites will run using FPM rather than showing error.

To turn off HHVM, you can use <code>--hhvm=off</code>.

For more details, please refer to:
<ul>
	<li><a href="http://docs.rtcamp.com/easyengine/commands/site/create#HHVMSite">http://docs.rtcamp.com/easyengine/commands/site/create#HHVMSite</a></li>
	<li><a href="http://docs.rtcamp.com/easyengine/commands/site/update#Enable/DisableHHVMonsite">http://docs.rtcamp.com/easyengine/commands/site/update#Enable/DisableHHVMonsite</a></li>
</ul>
<h3>Additional Notes about HHVM</h3>
As HHVM is newer, we will be keeping FPM as default for all PHP sites. So you need to enable it for existing sites as well as new sites. Please share your HHVM feedback in <a title="rtCamp Community Support Forum" href="http://community.rtcamp.com/">community forum</a>.

If HHVM works nicely for majority users, we will make HHVM as default for all WordPress sites in future.
<h2>Using PageSpeed</h2>
<p class="warning">Note: This feature is depreciated with <a href=https://easyengine.io/blog/easyengine-3-6-nginx-1-10-ubuntu-16-04-support/>EasyEngine v3.6.0.</a></p>
You can create a site with PageSpeed support by adding <code style="font-size: inherit; line-height: 1.9;">--pagespeed</code> to site creation command
<pre class="nginx">ee site create example.com --wp --pagespeed</pre>
For existing site you can use <code>update</code> command
<pre class="nginx">ee site update example.com --wp --pagespeed</pre>
To turn off PageSpeed, you can use <code>--pagespeed=off</code>.

For more details, please refer to:
<ul>
	<li><a href="http://docs.rtcamp.com/easyengine/commands/site/create#PagespeedSite">http://docs.rtcamp.com/easyengine/commands/site/create#PagespeedSite</a></li>
	<li><a href="http://docs.rtcamp.com/easyengine/commands/site/update#Enable/DisablePagespeedonsite">http://docs.rtcamp.com/easyengine/commands/site/update#Enable/DisablePagespeedonsite</a></li>
</ul>
<h3>Additional Notes about PageSpeed</h3>
PageSpeed is experimental so it may break your website. For this reason, when you run EasyEngine commands related to PageSpeed, it only enable support for PageSpeed but keeps all PageSpeed filters off.

Please enable/disable PageSpeed filter manually and test if they work nicely with your site.

You can edit pagespeed filters by running <code>ee edit</code> command
<pre>ee site edit example.com --pagespeed</pre>
<h2>Other fixes/enhancements</h2>
<ul>
	<li><a href="https://github.com/rtCamp/easyengine/issues/485">Added warning message while executing stack purge and stack remove command.</a></li>
	<li><a href="https://github.com/rtCamp/easyengine/issues/448">Improved ee log command</a><b></b></li>
</ul>
<h2>Upgrading to EasyEngine 3.1</h2>
Please run following command to update EasyEngine to latest version.
<pre class="nginx">ee update</pre>
If above command fails, that means you are running EasyEngine version older than 3.0.6. In that case, please use following command
<pre class="nginx">wget -qO eeup http://rt.cx/eeup &amp;&amp; sudo bash eeup</pre>
If you run into any issue, please catch us on <a title="EasyEngine community support forum" href="http://community.rtcamp.com/category/easyengine">our EasyEngine community support forum</a>.

We also provide <a title="EasyEngine Premium Support" href="https://easyengine.io/products/easyengine-premium-support/">EasyEngine Premium Support</a> where we offer faster, direct 1-on-1 direct support to you.

<strong>Links:</strong> <a href="https://easyengine.io/easyengine">EasyEngine Homepage</a> | <a href="https://github.com/rtCamp/easyengine">EasyEngine Github Repo</a> | <a href="http://demo.rtcamp.com/easyengine">EasyEngine Docs</a> | <a href="https://easyengine.io/products/easyengine-premium-support/">EasyEngine Premium Support</a>