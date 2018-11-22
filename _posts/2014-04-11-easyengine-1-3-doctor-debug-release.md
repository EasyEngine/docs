---
ID: 63434
post_title: 'EasyEngine 1.3 &#8220;Doctor&#8221; release with Debug command'
author: Rahul Bansal
post_excerpt: >
  EasyEngine 1.3 "doctor" release adds
  debug commands, web-based admin tools
  and scripts, easy way to check status
  and restart php, mysql, nginx and
  postfix
layout: post
permalink: >
  https://easyengine.io/blog/easyengine-1-3-doctor-debug-release/
published: true
post_date: 2014-04-11 17:11:52
---
<img class="alignright size-large wp-image-63702" alt="easyengine" src="https://easyengine.io/wp-content/uploads/2014/04/easyengine.png" width="256" height="256" />

Today, we are happy to bring EasyEngine 1.3 (codenamed "Doctor").

This release has support for new <code>debug</code> command among other features. This release is delayed by almost a month from original planned date. But we hope that easy debugging will save your plenty of time going ahead. :-)
<h2>New Features</h2>
<ol>
	<li>Addition of <code>debug</code> command</li>
	<li>Separate admin tools on port 22222</li>
	<li>New <code>ee system</code> sub-commands</li>
</ol>
<h2><code>debug</code> Command</h2>
<h3>Usage</h3>
<code>debug</code> commands goal is to make debugging easy for WordPress sites and generally system.
<h4>Debugging a site</h4>
For a site, you can enable debugging using:
<pre><code>ee debug example.com</code></pre>
Above will put WordPress into debug mode, Enable xdebug profiling for PHP, PHP-FPM Slow-log, MySQL's slow query log and nginx's debug log! All this in just one command. You can refer debug doc to control individual options.

When you finish debugging, run following command to turn off debugging mode:
<pre><code>ee debug example.com --stop</code></pre>
<h4>Debugging entire system</h4>
Sometimes, it may happen that entire system needs debugging. You can run following command:
<pre><code>ee debug</code></pre>
Above will turn on php, mysql, nginx debugging. Please note that it will not enable any WordPress debugging.

When you finish debugging, run following command to turn off debugging mode:
<pre><code>ee debug --stop</code></pre>
For more details, please refer to docs. <code>debug</code> command comes with many options!
<h3>Debug Command Internals</h3>
<h4>Sperate PHP-FPM Pools</h4>
When you enable debugging on a site, it will not affect other sites PHP performance. EasyEngine has 2 separate PHP-FPM pools, one for production sites and one for debug sites. So debug sites will not penalise production sites with xdebug and slow-log. Though mysql-slowlog will be systemwide (atleast for now).
<h4>Interactive Mode</h4>
When you pass <code>-i</code> flag to any debug command, it will turn ON debugging, starts displaying log files right away on your screen till you press <code>CTRL+C</code> from keyword. EasyEngine will capture keyboard signal properly, turn OFF debugging and return command-line control.

You may want to start another terminal for usual work while you observer debug logs from different systems in a separate terminal window!
<h2>EasyEngine Admin Tools on Port 22222</h2>
Though EasyEngine is command line tool, there are plenty of web-based tools and scripts which can make server administration easy. We included few tool in past releases under <code>/ee/</code> urls. <code>/ee/</code> URLs involved some nginx rewrites which we did not like much. So from this release we have moved all admin tools to a dedicated port 22222.

You can find all <a href="https://easyengine.io/easyengine/docs/admin-tools-22222/">admin tool details here</a>.
<h3></h3>
<h2>New ee system sub-commands</h2>
We have added 4 subcommands to ee system: status, start, stop and restart.

<code>ee system status</code> will show you system (OS) status and also running status of php, mysql, nginx and postfix services.

start, stop and restart will act as a shortcut to start, stop and restart php, mysql, nginx and postfix services in one go!

Please note <code>ee system restart</code> won't reboot your OS. We realised it sounds bit confusing when we started documenting it! We hope to solve confusion in future.
<h2>Updating EasyEngine</h2>
Updating EasyEngine is easy. Just fire <code>ee update</code> command.

If you run into any issue, please catch us on <a href="http://rtcamp.com/support/forum/easyengine">our easyengine support forum</a>.

<strong>Links: </strong><a href="https://easyengine.io/easyengine/">EasyEngine Homepage</a> | <a href="https://github.com/rtCamp/easyengine/">EasyEngine Github Repo</a> | <a href="https://easyengine.io/easyengine/docs/commands/debug/">Debug Command</a> | <a href="https://easyengine.io/easyengine/docs/admin-tools-22222/">Admin Tools</a>