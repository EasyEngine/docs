---
ID: 74477
post_title: >
  EasyEngine 2.2 released with new
  commands and percona mysql 5.6
author: Rahul Bansal
post_excerpt: >
  EasyEngine 2.2 released with easier
  setup, updating WordPress cache type,
  easy password reset, percona mysql 5.6
  support, clean cache command.
layout: post
permalink: >
  https://easyengine.io/blog/easyengine-2-2-released/
published: true
post_date: 2014-10-14 15:50:18
---
Today, we are excited to announce the release of version 2.2 of EasyEngine.

In this release many new commands have been introduced and some commands are updated to fulfil some feature requests. As always goal of each EasyEngine release is to make your life easier! :-)
<h2>New Features</h2>
<h3>Easier Installation</h3>
Most important feature of this new version is - we have reduced 3-commands setup to 2-commands.

Now you don't have to use "ee stack install" command.

Just install EasyEngine and let it know what kind of site you want to setup. EasyEngine will automatically figure out required stack dependency and if any package is missing, EasyEngine will install missing packages automatically.

EasyEngine currently supports PHP-based sites only but soon we will be supporting node.js based <a title="Ghost" href="https://ghost.org/" type="">Ghost</a> blogging platform and then rail-based apps like <a href="http://www.discourse.org/">Discourse</a> and <a href="http://gitlab.org/">GitLab</a>.
<h3>Update Cache, Password, Site type, etc</h3>
We have added a new <a title="ee site update" href="https://easyengine.io/easyengine/docs/commands/site/update/">ee site update</a> sub-command to allow:
<ol>
	<li>changing site type e.g. php to WordPress, WordPress single-site to multisite</li>
	<li>(WordPress only) changing caching mechanism e.g w3 total cache to nginx's fastcgi-cache.</li>
	<li>(WordPress only) updating site password. Refer <a href="https://github.com/rtCamp/easyengine/issues/315">this discussion</a> for more details.</li>
</ol>
For WordPress sites, we always recommended <code>--wpfc</code> i.e. Nginx's fastcgi-cache option. Now you can switch to this by running just a single command.
<h3>Clean cache command</h3>
Only way to delete nginx's fastcgi-cache is to run <code>rm -rf /path/on/cache</code> command. If every time you <code>rm -rf</code>, and feel anxiety, then <a title="ee clean" href="https://easyengine.io/easyengine/docs/commands/clean/">ee clean</a> command is for you.

Depending on parameters, it cleans NGINX FastCGI cache, Opcacache and/or Memcache.
<h3>MySQL 5.6 Support</h3>
New servers will now get Percona MySQL 5.6 by default. If you are already using EasyEngine, here is a short tutorial you can follow to <a href="https://easyengine.io/easyengine/docs/upgrade-percona-mysql-5-6/">upgrade to Percona MySQL 5.6</a>.

As database is a critical component and upgrading it often results in downtime, we haven't added mysql 5.5 to percona mysql 5.6 upgrade to EasyEngine core update script. You can refer to the tutorial and plan update at your convenience.
<h3>Other commands</h3>
<ul>
	<li><a title="ee stack [install|remove|purge] admin" href="https://easyengine.io/easyengine/docs/commands/stack/">ee stack [install|remove|purge] admin</a>: You can manage admin tools like Adminer, phpMyAdmin, phpMemcached Admin, FastCGI cleanup script, OPcache, Webgrind, Anemometer, etc.</li>
	<li><a title="ee site cd" href="https://easyengine.io/easyengine/docs/commands/site/cd/">ee site cd</a>: It helps to change directory to site webroot in subshell. You don't have to remember EasyEngine conventions.</li>
	<li><a title="ee site log" href="https://easyengine.io/easyengine/docs/commands/site/log/">ee site log</a>: It helps to monitor site access and error logs.</li>
	<li><a title="ee import-slow-log" href="https://easyengine.io/easyengine/docs/commands/import-slow-log/" target="_blank">ee import-slow-log</a>:  imports MySQL slow log to Anemometer. You can also specify <a href="https://easyengine.io/easyengine/docs/commands/ee-debug/#global">importing slow log at a specific time interval</a>.</li>
</ul>
<h3>Other fixes/enhancements</h3>
<ul>
	<li><a href="https://github.com/rtCamp/easyengine/issues/312" target="_blank">WP debug.log symlink in /logs/ folder so all site logs can be in one place</a></li>
	<li><a href="https://github.com/rtCamp/easyengine/issues/311" target="_blank">Better autocomplete for debug script</a></li>
	<li><a href="https://github.com/rtCamp/easyengine/issues/301" target="_blank">Security warning message: The configuration file now needs a secret passphrase(blowfish_secret) phpMyAdmin 4.0.9</a></li>
</ul>
<h2>Upgrading to EasyEngine 2.2</h2>
To update the EasyEngine, please add following alias in your <code>~/.bashrc</code>
<pre><span class="nb" style="color: #0086b3;">alias </span><span class="nv" style="color: teal;">eeupdate</span><span class="o" style="font-weight: bold;">=</span><span class="s2" style="color: #dd1144;">"wget -qO eeup http://rt.cx/eeup &amp;&amp; sudo bash eeup"</span></pre>
Now Update EasyEngine using command:
<pre>eeupdate</pre>
If you run into any issue, please catch us on <a style="color: #3475ba;" title="Support Forum" href="http://community.rtcamp.com/category/easyengine">our easyengine support forum</a>.

<strong>Links: </strong><a style="color: #3475ba;" href="https://easyengine.io/easyengine/">EasyEngine Homepage</a> | <a style="color: #3475ba;" href="https://github.com/rtCamp/easyengine/">EasyEngine Github Repo</a> | <a title="EasyEngineDocs" href="https://easyengine.io/easyengine/docs">EasyEngine Docs</a>

<em><strong>PS:</strong> <a href="https://easyengine.io/blog/meet-easyengine-nginx-conf-2014-san-francisco-usa/">EasyEngine will be presented in Nginx conf</a> in San Francicso USA on Oct 21, 2014. If you like to attend, you can register <a href="https://nginx.busyconf.com/bookings/new">here</a>. Use promo code <strong>SPEAKER25</strong> for discount</em>