---
ID: 142256
post_title: EasyEngine v4 Beta-1 Release
author: Rahul Bansal
post_excerpt: |
  EasyEngine version 4, beta-1 is here. We need your help in testing!  ?? ?
  Alert - Beta release is not for faint-hearted! ☢️⚠️☠️
layout: post
permalink: >
  https://easyengine.io/blog/ee-v4-beta-1-release/
published: true
post_date: 2018-06-12 19:22:19
---
After a long wait, finally, it’s time to try out EasyEngine v4 first BETA version. ☢ ⚠ ☠

This is really a beta release. Do NOT use it in production. It doesn't include any code to migrate from v3 to v4. So as of now, there is no point in cloning a VPS setup by the EasyEngine version 3, and then attempting the version 4 installation/upgrade on it. That is something we will handle in one of upcoming beta.

For now, we need your help in testing the first beta to understand if we missed anything major, <em>unintentionally</em>, in the complete rewrite.

Also, there are few things EasyEngine 4 won't have in its "core", even after beta. There is a reason for stressing the word core as new EasyEngine allows features to be added via EasyEngine packages. In fact, the site-command is implemented as a package. More on packages later in another post!
<h2>EasyEngine v4 won't have</h2>
<ol>
 	<li>Multiple full-page caching backends like WP Super Cache, W3 Total Cache, and Nginx cache are not available. Instead there will be only one Redis cache (<code>--wpredis</code>) option for full-page caching. If you are using another caching mechanism on v3, you no need to worry about it at the moment. We will try our best to handle things in an automated and safe way from v3 to v4 upgrade script. (<a href="https://github.com/EasyEngine/easyengine/issues/1015">see issue #1015</a>)</li>
 	<li>Support for webmail hosting. So if you have set up something like ViMbaAdmin, you will need to find an alternative. We use G Suite (formally GoogleApps everywhere). So it's hard to invest in a feature we don't use ourself. But if you are a PHP developer and would like to implement something like <code>ee webmail</code> command, please get in touch with us. We will be happy to guide you how to bundle webmail hosting in an EasyEngine package.</li>
 	<li>A dedicated port such as 22222 for admin tools. Instead admin tools will be moved to <code>/ee-admin</code> subpath. This means no extra firewall or cloudflare config to access admin tools. (<a href="https://github.com/EasyEngine/easyengine/issues/1013">see issue #1013</a>)</li>
</ol>
<h2>v4 Beta-1 limitations</h2>
Below are limitations of beta but will be handled before we ship final version 4! ⏳
<ol>
 	<li>Comparing with version 3, the only <code>ee site</code> command is added. A few other commands will be added in subsequent beta releases.</li>
 	<li>Site creation has been limited to WordPress site types. Both single site and multisite WordPress variant are supported. But support for other site types html, php, proxy site isn't included in this version.</li>
 	<li>This beta version does not contain LetsEncrypt SSL support. But we don't expect sites created with beta release to be used in production.</li>
 	<li>Site created with this beta won't have admin tools such as phpMyAdmin, redis-cache web viewer avaialble.</li>
</ol>
Please understand limitations of beta release so you test beta with clear expectations.
<h2>v4 Beta-1 includes</h2>
<ol>
 	<li>This beta1 release includes the basic EasyEngine site functionalities, and focusing on the WordPress based sites first. Please see command list in next section.</li>
 	<li>Basic site actions like create, delete, enable, disable, list and info are available in this version.</li>
 	<li>The site create command includes the flexibility of adding most of the <code>wp core download</code>, <code>wp config create</code> and <code>wp core install</code> flags. You can take a look at <code>ee help site create</code> to find out all the supported flags. This is new feature in v4. ?</li>
 	<li>An effect of supporting wp-cli flag is that v4 will make non-English WordPress installs easier. You can pass <code>--locale=</code> flag with a value WordPress support during site creation and EE v4 will pass it correctly to wp-cli internally. The default locale is <code>en_US</code> but it can be modified in global config <code>/opt/easyengine/config.yml</code>.</li>
</ol>
<h2>Install EasyEngine v4 beta-1</h2>
We have created an automated installed for Ubuntu 14.04, 16.04, 18.04 and Debian 8. Installing beta-1 is just a command-away!
<pre>wget -qO ee rt.cx/ee4beta &amp;&amp; sudo bash ee</pre>
Since EasyEngine v4 uses docker for all heavylifting, it is very easy to run on almost every *nix OS including MacOS. You can see some details in <a href="https://github.com/EasyEngine/easyengine/tree/master-v4#installing">installation part of README</a>.
<h2>v4 Commands (to test)</h2>
You can test following commands with v4 beta-1. Please note that the syntax might change slightly as we move towards stable release. But following should work for beta-1 right now.
<h3>Site creation</h3>
<pre>ee site create example.com --wp  # install wordpress without any page caching
ee site create example.com --wpredis # install wordpress + redis caching
ee site create example.com --wpsubir # install wpmu-subdirectory without any page caching
ee site create example.com --wpsubir --wpredis # install wpmu-subdirectory + redis caching
ee site create example.com --wpsubdom # install wpmu-subdomain without any page caching
ee site create example.com --wpsubdom --wpredis # install wpmu-subdomain + redis caching</pre>
<h3>Site delete</h3>
<pre>ee site delete example.com</pre>
<h3>Site enable/disable</h3>
<pre>ee site disable example.com
ee site enable example.com</pre>
<h3>Site info</h3>
<pre>ee site info example.com</pre>
<h3>Site list</h3>
<pre>ee site list</pre>
EasyEngine will currently only run with root privileges.

You can run <code>ee help</code>, <code>ee help site</code> and <code>ee help site create</code> to get all the details about the various commands and subcommands that you can run.

If you encounter any issue when testing beta-1 release, please create an <a href="https://github.com/EasyEngine/easyengine/issues">issue on main Github repo</a>.
<h2>WordCamp Europe</h2>
I will be attending WordCamp Europe. If you are around, I would love to chat with you about EasyEngine. I am <a href="https://twitter.com/rahul286">rahul286 on Twitter</a>. ?

<strong>Links: </strong><a href="https://github.com/EasyEngine/easyengine/releases/tag/v4.0.0-beta.1">v4 Beta-1 release</a>