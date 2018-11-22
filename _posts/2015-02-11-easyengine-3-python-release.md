---
ID: 80116
post_title: EasyEngine 3.0 in Python is released!
author: Aditya Kane
post_excerpt: "EasyEngine v3.0 is written in Python using Cement – a command-line application framework. Cement provides modular architecture. All EasyEngine's core commands have been implemented as plugins. You can also create your own EasyEngine plugin."
layout: post
permalink: >
  https://easyengine.io/blog/easyengine-3-python-release/
published: true
post_date: 2015-02-11 19:00:50
---
A few months ago we announced <a href="https://easyengine.io/blog/easyengine-3-roadmap/">EasyEngine's roadmap</a> for 2015. The big change was to refactor EasyEngine into Python for version 3.0.

Today we are happy to announce that we have released EasyEngine 3.0. We have moved all the existing functionality to Python.

EasyEngine is now written in Python using <a href="http://builtoncement.com/">Cement</a> – a command-line application framework. Cement provides modular architecture. All EasyEngine's core commands have been <a href="https://github.com/rtCamp/easyengine/tree/master/ee/cli/plugins">implemented as plugins</a>. You can also <a href="http://docs.rtcamp.com/easyengine/dev/plugins/">create your own EasyEngine plugin</a>.
<h2>What changes with EasyEngine 3.0?</h2>
EE v3.0 doesn't bring any new features but reimplements all existing features on python.

For end user this may not matter, but for developers, EE v3.0 has:
<ul>
	<li><a href="https://github.com/rtCamp/easyengine/tree/master/tests">Unit Tests</a> using <a href="https://nose.readthedocs.org/en/latest/">nose</a></li>
	<li>Better error handling using python's try/catch.</li>
	<li><a href="https://github.com/rtCamp/easyengine/tree/master/config/plugins.d">Config files to enable/disable EasyEngine commands</a> (i.e. plugins)</li>
	<li><a href="https://github.com/rtCamp/easyengine/blob/master/ee/cli/templates/virtualconf.mustache">Using mustache templates for site config generation</a>. This makes it easier to tweak future configs easily.</li>
	<li>SQLite database is added to keep track of <code>ee site</code> command. This will enable us to handle complex things going ahead.</li>
</ul>
There are few more changes. We hope all this will save plenty of time going ahead. So we expect to release faster and release sooner.
<h2>MIT License</h2>
A big change is that EasyEngine is now has <a href="http://opensource.org/licenses/MIT">MIT license</a>.

Since EasyEngine v3.0 is refactored from ground up, we could change license easily and some users and businesses requested us to go with something like MIT or Apache.

Based on all feedback, we have made EasyEngine v3 MIT.
<h2>Upgrading to EE 3.0</h2>
Upgrading is as easy as before, but backing up your servers/sites is highly recommended.
<pre class="no-highlight">wget -q http://rt.cx/ee &amp;&amp; sudo bash ee</pre>
We hope to move to <a href="http://en.wikipedia.org/wiki/Pip_(package_manager)">python pip</a> in the near future but currently we are facing some issues with pip related to different python versions.
<h2>Credits</h2>
EasyEngine is moved to python by <a href="https://github.com/gau1991">Gaurav</a>, <a href="https://github.com/harshadyeola">Harshad</a>, <a href="https://github.com/shitalp">Shital</a> and <a href="https://github.com/MiteshShah">Mitesh</a>.

EasyEninge v3 wouldn't have been possible without Cement framework. We thank <a href="http://bjdierkes.com/">Dierkes</a> for creating Cement and also helping EasyEngine team during our bash-to-python migration. :-)

<strong>EasyEngine Links: </strong><a href="https://easyengine.io/easyengine">Project Home</a> | <a href="http://docs.rtcamp.com/easyengine/">Docs</a> | <a href="https://github.com/rtCamp/easyengine">Github</a> | <a href="http://community.rtcamp.com/c/easyengine">Support</a>