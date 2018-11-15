---
ID: 142414
post_title: >
  EasyEngine v4 – Second Release
  Candidate
author: Kirtan Gajjar
post_excerpt: >
  EasyEngine v4 second RC. This could be
  last one before final 4.0. Help us test
  and make EasyEngine as easy as possible
  for all! 🙏
layout: post
permalink: >
  https://easyengine.io/blog/easyengine-v4-second-release-candidate/
published: true
post_date: 2018-11-14 19:00:09
---
We have released second release candidate for EasyEngine v4 tagged RC2. This release focuses mainly on bug fixes from RC1.

<h3>Update from v4 RC1</h3>

If you have already have RC1 on your server, you can update to RC2 with the following command

<pre>wget -O /usr/local/bin/ee https://raw.githubusercontent.com/EasyEngine/easyengine-builds/master/phar/easyengine.phar
chmod +x /usr/local/bin/ee
ee cli version</pre>

This would be needed as update command is broken in RC1 and hence needs a manual download of the latest release.

Note: There could be a downtime of ~1-2 minutes for your sites. Also, <code>ee cli version</code> will take some time as EasyEngine will update existing sites to RC2.

<h3>For Fresh Install</h3>

If you want to test RC2 on the new server, use the following command:

<pre>wget -qO ee rt.cx/ee4 &amp;&amp; sudo bash ee</pre>

<a href="https://github.com/easyengine/easyengine#installing">You can find the detailed instructions, here.</a>

<h2>What has changed?</h2>

<ul>
    <li>The issue with ee-admin and whitelisting IP for HTTP Auth has been fixed</li>
    <li>PHP and Postfix mounts have been corrected</li>
    <li>Incorrect cron entries have been fixed and `no-overlap` has been added.</li>
    <li>ping/nginx status has been added in admin-tools</li>
</ul>

<h2>Issue with ee-admin</h2>

There was an issue with nginx configuration generation due to which /ee-admin/ was not accessible. This issue has been fixed.

<h2>PHP and Postfix Mounts</h2>

In site’s PHP config, now we have mounted all PHP’s config on host including that of PHP daemon. Earlier only the config of PHP-fpm was mounted but not of PHP itself.

The configuration of Postfix has been mounted correctly. Earlier they weren’t mounted.

<h2>Fix Incorrect Cron Entries and add no overlap</h2>

We found out that sometimes cron entries were not getting generated correctly. This has been fixed. Also, we’ve configured our cron scheduler to ensure that two same crons don’t run simultaneously.

So if a cron is configured to run at 5 minutes interval and if it takes more than 5 minutes to complete one cron, then another cron process will not be created as the previous cron process is still running.

<h2>Add ping and nginx_status in Admin Tools</h2>

Now we have added two Admin Tools that were present in EasyEngine v3.

The ‘ping’ admin tool is used to verify that PHP-FPM is alive and responding. It can be accessed at example.com/ee-admin/ping. You should see ‘pong’ in response.

The ‘nginx_status’ admin tool is used to display basic nginx statistics that might be helpful in debugging nginx related issues. It can be accessed at example.com/ee-admin/nginx_status.

Note: If you try to access above URL, you’ll be prompted for username/password. You can obtain these credentials from

<pre>ee auth list global</pre>

<h2>Status</h2>

Next release will be 4.0. We are targeting the 19th of November.

<b>Link:</b> <a href="https://github.com/EasyEngine/easyengine/releases/tag/v4.0.0-rc.2">EasyEngine 4.0.0-rc.2 release</a>