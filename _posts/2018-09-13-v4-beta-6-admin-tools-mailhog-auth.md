---
ID: 142327
post_title: >
  EasyEngine v4 Beta-6 with admin-tools,
  mailhog and auth
author: mbtamuli
post_excerpt: >
  EasyEngine v4 final beta adds support
  for admin-tools, mailhog, shared
  services and nginx-level global/per-site
  auth support.
layout: post
permalink: >
  https://easyengine.io/blog/v4-beta-6-admin-tools-mailhog-auth/
published: true
post_date: 2018-09-13 18:42:24
---
We have released EasyEngine v4 Beta-6.

You can start testing on a fresh VPS. Currently, we support limited operating system that includes Ubuntu 14.04, 16.04, 18.04 and Debian 8. Please run following command:
<pre class="wp-block-code"><code>wget -qO ee rt.cx/ee4beta &amp;&amp; sudo bash ee</code></pre>
<a href="https://github.com/easyengine/easyengine#installing">You can find detailed instructions here.</a>

⚠️We repeat, v4 is not production ready! ⚠️
<h4>What's changed</h4>
<ul>
 	<li>We’ve made EasyEngine more modular. We’ve all site-command related features from EasyEngine core to site-command. (<a href="https://github.com/EasyEngine/easyengine/pull/1195">EasyEngine/easyengine#1195</a>)</li>
 	<li>Move global services to docker-compose (<a href="https://github.com/EasyEngine/easyengine/pull/1187">EasyEngine/easyengine#1187</a>)</li>
 	<li>Added <a href="https://github.com/EasyEngine/admin-tools-command/releases/tag/v1.0.0-beta.1">admin-tools</a>, <a href="https://github.com/EasyEngine/mailhog-command/releases/tag/v1.0.0-beta.1">mailhog</a>, <a href="https://github.com/EasyEngine/service-command/releases/tag/v1.0.0-beta.1">service</a> and <a href="https://github.com/EasyEngine/auth-command/releases/tag/v1.0.0-beta.1">auth</a> commands.</li>
 	<li>We’ve added support for simple <a href="https://github.com/EasyEngine/site-type-php/releases/tag/v1.0.0-beta.1">PHP sites</a>.</li>
 	<li>Able to use LetsEncrypt wildcard for all site types. (<a href="https://github.com/EasyEngine/easyengine/pull/1171">EasyEngine/easyengine#1171)</a></li>
</ul>
Release Link:<a href="https://github.com/EasyEngine/easyengine/releases/tag/v4.0.0-beta.6"> v4.0.0-beta.6 release</a> | GitHub Link: <a href="https://github.com/orgs/EasyEngine/projects/1">Github project progress board</a>