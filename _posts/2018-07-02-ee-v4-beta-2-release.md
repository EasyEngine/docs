---
ID: 142267
post_title: EasyEngine v4 Beta-2 Release
author: mbtamuli
post_excerpt: ""
layout: post
permalink: >
  https://easyengine.io/blog/ee-v4-beta-2-release/
published: true
post_date: 2018-07-02 00:04:15
---
We have just released EasyEngine v4 Beta-2. We have handled a few issues and also added some new features in this release. Feel free to test out this beta release and report any issues on our <a href="https://github.com/EasyEngine/easyengine">GitHub repo</a>.

You can get started on our currently supported OSs (Ubuntu 14.04, 16.04, 18.04 and Debian 8) using -
<pre>wget -qO ee rt.cx/ee4beta <span class="pl-k">&amp;&amp;</span> sudo bash ee</pre>
We repeat, <a href="https://easyengine.io/blog/ee-v4-beta-1-release/">v4 is not ready for production.</a> For instruction on how to install on currently unsupported distributions, please see <a href="https://github.com/easyengine/easyengine#installing">installation instructions</a>.
<h3>The New Additions</h3>
<ul>
 	<li><a href="https://github.com/EasyEngine/easyengine/pull/1074">Added Behat functional tests for site command</a> - We’ve started adding Behat test cases and will keep updating it. This is somewhere where you can get started with the EasyEngine project. You can always come up on <a href="http://slack.easyengine.io/">Slack</a> if you want help getting started with development or with these tests.</li>
 	<li><a href="https://github.com/EasyEngine/shell-command/">Added shell command</a> - The shell command will put you in a new shell environment to interact with your site and currently has mysql client, wp-cli and composer. In future, it might have tools like npm, pip, etc. You should definitely test this out. Either run <code>ee shell example.com</code> or just run <code>ee shell</code> from the site root <code>~/ee-sites/example.com</code></li>
 	<li><a href="https://github.com/EasyEngine/site-command/pull/15">Added admin tools</a> - We added some admin tools like phpMyAdmin, Anemometer, phpRedisAdmin, Adminer, MailHog.</li>
 	<li><a href="https://github.com/EasyEngine/site-command/pull/22">Add compatibilty to wp-cli flags</a> - This PR adds the feature requested in <a href="https://github.com/EasyEngine/easyengine/issues/116">EasyEngine/easyengine#116</a> and discussed here <a href="https://github.com/EasyEngine/easyengine/issues/1029">EasyEngine/easyengine#1029</a>.</li>
 	<li><a href="https://github.com/EasyEngine/site-command/pull/46">Add labels to containers created by EasyEngine</a> - This PR makes sure we can track all containers created by EasyEngine and don’t accidentally remove the containers created by you.</li>
</ul>
<h3>Bug fixes</h3>
Other issues that have been fixed are
<ul>
 	<li><a href="https://github.com/EasyEngine/easyengine/pull/1070">Update bug has been fixed</a></li>
 	<li><a href="https://github.com/EasyEngine/easyengine/issues/1078">Fixed deprecated warnings while running site create</a></li>
 	<li><a href="https://github.com/EasyEngine/site-command/pull/39">Fixed sudo invocation</a></li>
 	<li><a href="https://github.com/EasyEngine/easyengine/issues/1072">Added checks for DB initialization to ensure site creation doesn’t fail</a></li>
 	<li><a href="https://github.com/EasyEngine/easyengine/pull/1091">Specify DB port in case of remote Database</a></li>
 	<li><a href="https://github.com/EasyEngine/easyengine/pull/1081">Throw error when wrong sitename is given while running a command from a site-root</a></li>
 	<li><a href="https://github.com/EasyEngine/easyengine/pull/1068">Append <i>-nightly</i> to the nightly phar version</a></li>
 	<li><a href="https://github.com/EasyEngine/site-command/pull/36">Add mime type for woff2</a></li>
</ul>
<strong>Release Link: </strong><a href="https://github.com/EasyEngine/easyengine/tree/v4.0.0-beta.2">v4.0.0-beta.2 release</a>