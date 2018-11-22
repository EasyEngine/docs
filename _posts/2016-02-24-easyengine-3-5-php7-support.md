---
ID: 133307
post_title: >
  EasyEngine 3.5 released with PHP7
  Support
author: Rahul Bansal
post_excerpt: >
  EasyEngine 3.5 is released with
  experimental support for PHP7. A single
  line command can easily install PHP7 on
  your server.
layout: post
permalink: >
  https://easyengine.io/blog/easyengine-3-5-php7-support/
published: true
post_date: 2016-02-24 16:51:55
---
Today we released EasyEngine 3.5, we have added support for PHP7. PHP7 support was one of most in demand feature but we had reasons to delay it:
<ol>
	<li><strong>No Debian Support:</strong> First, PHP7 redis and memcache modules are not present for <a href="https://github.com/gplessis/dotdeb-php/issues/106">Debian via dotdeb repo</a>. So some cache options would break on Debian 7 and 8.</li>
	<li><strong>Experimental:</strong> PHP7 is not extensively tested by us. We fear that like HHVM, while WordPress itself may run smoothly with PHP7, some plugins may run into issues. And as we all know, we can not imagine using WordPress without plugins!</li>
	<li><strong>WP-CLI issue:</strong> We depend on WP-CLI, which also had <a href="https://github.com/wp-cli/wp-cli/issues/1842">issues with PHP7</a>. So we had to wait for a fix from WP-CLI team. Luckily they released <a href="http://wp-cli.org/blog/version-0.22.0.html">WP-CLI v0.22.0</a>.</li>
</ol>
Hence we have currently marked support for PHP7 as experimental.

<strong>Usage</strong>

Existing users first need to update EasyEngine using <code>ee update</code>

To install PHP7, just run following command:
<pre>ee stack install --php7</pre>
To create site using PHP 7.0, simply run
<pre>ee site create example.com --wp --php7</pre>
<strong>Above command will do:</strong>
<ol>
	<li>If you are using Debian7/8. If yes, it will give you a message <em>"PHP7 support is not ready for your platform yet. You may consider switching to Ubuntu or wait for a while." </em>and exit.</li>
	<li>It will then install PHP7 packages.</li>
	<li>If step 3 runs into any issues, PHP5 packages will be installed back.</li>
</ol>
<strong>Read More:</strong> <a href="https://easyengine.io/docs/php7/">PHP7 documentation</a>

<strong>Links:</strong>  <a href="https://github.com/EasyEngine/easyengine/releases/tag/v3.5.0">Release Notes</a>