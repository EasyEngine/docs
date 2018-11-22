---
ID: 142294
post_title: EasyEngine v4 Beta-4 Release
author: mbtamuli
post_excerpt: >
  Easyengine v4 beta-4 release adds
  support for cron jobs and uninstalling
  EasyEngine.
layout: post
permalink: >
  https://easyengine.io/blog/ee-v4-beta-4-release/
published: true
post_date: 2018-07-25 16:47:03
---
We have released EasyEngine v4 Beta-4.

The missing features that are necessary for an MVP are postfix, to have basic mail functionality, and a migration script to migrate from EasyEngine v3 to v4. Other than that, we need to tweak the configuration, of Nginx, PHP and MySQL and the other tools in the stack to work harmoniously with a containerized environment.

This beta release fixes issues found in <a href="https://easyengine.io/blog/ee-v4-beta-1-release/">beta-1</a>,<a href="https://easyengine.io/blog/ee-v4-beta-2-release/">beta-2</a> and <a href="https://easyengine.io/blog/ee-v4-beta-3-release/">beta-3</a> releases and also introduces a few features. Please leave us helpful comment or report issues on our <a href="https://github.com/EasyEngine/easyengine">GitHub repo</a>.

You can get started on our currently supported OSs (Ubuntu 14.04, 16.04, 18.04 and Debian 8) using -
<pre>wget -qO ee rt.cx/ee4beta &amp;&amp; sudo bash ee</pre>
We repeat, v4 is <strong>not ready for production</strong>. For instruction on how to install on currently unsupported distributions, please see <a href="https://github.com/easyengine/easyengine#installing">installation instructions</a>.
<h2>New Additions</h2>
Cron command - We’re using Ofelia, a job scheduler for our cron requirements in a Docker-based container environment. We introduced a new command `ee cron` to interact with Ofelia where you can add, delete and update a cron job and also list all jobs.
<pre># Adds a cron job on example.com every minute
ee cron add example.com --command='wp cron event run --due-now' --schedule='* * * * *'
# Lists all scheduled cron jobs of example.com
ee cron list example.com
</pre>
Checkout our cron command repository for more details.
<h2>Bug fixes and other improvements</h2>
<ol>
 	<li>Add a provision to uninstall EasyEngine. Issue: <a href="https://github.com/EasyEngine/easyengine/issues/1125">https://github.com/EasyEngine/easyengine/issues/1125</a> PR: <a href="https://github.com/EasyEngine/easyengine/pull/1127">https://github.com/EasyEngine/easyengine/pull/1127</a></li>
 	<li>Update database to accommodate cron-command.</li>
 	<li>Update tests and separate EasyEngine cli tests and site tests.</li>
 	<li>Fix letsencrypt site recreation bug. Issue: <a href="https://github.com/EasyEngine/easyengine/issues/1123">https://github.com/EasyEngine/easyengine/issues/1123</a> and <a href="https://github.com/EasyEngine/site-command/issues/71">https://github.com/EasyEngine/site-command/issues/71</a> PR: <a href="https://github.com/EasyEngine/site-command/pull/76">https://github.com/EasyEngine/site-command/pull/76</a></li>
 	<li>Update webroot from <code>/var/www/html</code> to <code>/var/www/htdocs</code>. PR: <a href="https://github.com/EasyEngine/site-command/pull/81">https://github.com/EasyEngine/site-command/pull/81</a> and <a href="https://github.com/EasyEngine/dockerfiles/pull/25">https://github.com/EasyEngine/dockerfiles/pull/25</a></li>
 	<li>Add confirmation to destructive commands such as <code>site delete</code>. Issue: <a href="https://github.com/EasyEngine/site-command/issues/50">https://github.com/EasyEngine/site-command/issues/50</a> PR: <a href="https://github.com/EasyEngine/site-command/pull/56">https://github.com/EasyEngine/site-command/pull/56</a></li>
 	<li>Add a provision to choose primary domain (with-www or without-www) and redirect from one to the other. Issue: <a href="https://github.com/EasyEngine/easyengine/issues/1021">https://github.com/EasyEngine/easyengine/issues/1021</a> PR: <a href="https://github.com/EasyEngine/site-command/pull/70">https://github.com/EasyEngine/site-command/pull/70</a></li>
 	<li>Add Travis tests and integrations PR: <a href="https://github.com/EasyEngine/site-command/pull/69">https://github.com/EasyEngine/site-command/pull/69</a></li>
 	<li>Add more tests for subdir and subdom sites. <a href="https://github.com/EasyEngine/site-command/pull/74">https://github.com/EasyEngine/site-command/pull/74</a></li>
 	<li>Add labels to site containers. <a href="https://github.com/EasyEngine/site-command/pull/78">https://github.com/EasyEngine/site-command/pull/78</a></li>
</ol>
<strong>Release Link:</strong> <a href="https://github.com/EasyEngine/easyengine/releases/tag/v4.0.0-beta.4">v4.0.0-beta.4 release</a>