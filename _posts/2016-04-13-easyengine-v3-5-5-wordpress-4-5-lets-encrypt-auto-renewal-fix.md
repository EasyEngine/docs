---
ID: 133793
post_title: 'EasyEngine v3.5.5 for WordPress 4.5 and Let&#8217;s Encrypt Auto-Renewal Fix'
author: Aditya Kane
post_excerpt: "EasyEngine minor update for WordPress 4.5 compatibility and Let's Encrypt Auto-Renewal fix "
layout: post
permalink: >
  https://easyengine.io/blog/easyengine-v3-5-5-wordpress-4-5-lets-encrypt-auto-renewal-fix/
published: true
post_date: 2016-04-13 21:18:53
---
Today, WordPress 4.5 "Coleman" was released.  This WordPress release requires WP-CLI version 0.23, as older WP-CLI versions are not compatible with WordPress 4.5. For more details check <a href="http://wp-cli.org/blog/version-0.23.0.html">WP-CLI blog post</a>.

We have updated WP-CLI version inside EasyEngine core and released a minor update as EasyEngine version 3.5.5.
<h2>Updating EasyEngine</h2>
Current EasyEngine users can update EasyEngine using following command.

<code>ee update</code>

This will trigger a check for WP-CLI version running on your server and update WP-CLI to the latest release.

If you are installing EasyEngine on a new server, then by default the latest version of WP-CLI and WordPress will be installed. You need not take any other action.

If for some reason you cannot update EasyEngine or running very old version of EasyEngine, please <a href="http://wp-cli.org/docs/installing/">update WP-CLI version manually</a>.
<h2>Let's Encrypt Auto-renewal fix</h2>
A small change in Let's Encrypt API broke auto-renewal of SSL certificates created by EasyEngine. Yep, <a href="https://easyengine.io/docs/lets-encrypt/">EasyEngine already supports Let's Encrypt based SSL certificates</a>.

This EasyEngine version has necessary to fix to offset Let's Encrypt API change. The concern issue is on Github at <a href="https://github.com/EasyEngine/easyengine/issues/702">https://github.com/EasyEngine/easyengine/issues/702</a>.

If you have faced any issue around Let's Encrypt certificate auto-renewals, you likely benefit from this minor fix.

<strong>Links:</strong> <a href="https://github.com/EasyEngine/easyengine/releases/tag/v3.5.5">EasyEngine Release Notes</a> | <a href="http://wp-cli.org/blog/version-0.23.0.html">WP-CLI Blog Post</a>