---
ID: 76829
post_title: >
  EasyEngine 3.0 starts on Python and
  future roadmap
author: Rahul Bansal
post_excerpt: 'Future roadmap for the EasyEngine project includes EasyEngine 3.0 in Python, CLI plugins, premium support, REST API,  Web interface and Mobile apps.'
layout: post
permalink: >
  https://easyengine.io/blog/easyengine-3-roadmap/
published: true
post_date: 2014-12-01 17:05:24
---
This is followup post for <a href="https://easyengine.io/blog/feedback-request-from-easyengine-users/">EasyEngine feedback post</a> we published last month.

We want to thank every EasyEngine user for their overwhelming feedback and showing interest in commercial offerings. :-)

Now, after considering all feedback and almost a month-long of brainstorming, here is what we have decided.
<h2>EasyEngine Roadmap</h2>
Next year, 2015, will be most exciting year for EasyEngine. We have decided to work on everything <a href="https://easyengine.io/blog/feedback-request-from-easyengine-users/#comments">we discussed in last post</a>.

Below is very rough roadmap for the entire year:
<ol>
	<li>EasyEngine 3.0 on python. Henceforth current EasyEngine project will be referred as CLI - command line interface.</li>
	<li>EasyEngine-CLI plugins (modules) with some premium modules from rtCamp. And marketplace to distribute other's module.</li>
	<li>Premium support portal which will integrate with EasyEngine (CLI) running on your server.</li>
	<li>Dedicated site for EasyEngine project, documentation, tutorials and may be a dedicated blog.</li>
	<li>REST API layer on top of EasyEngine 3.0. This will be called called EasyEngine API (ee-api).</li>
	<li>Web Interface as a service which will use EasyEngine API to manage your server.</li>
	<li>Mobile App (android) to manage your server using EasyEngine API. Plan is to make mobile app independent of web interface.</li>
</ol>
It's very difficult to achieve all this in a year. But we hope to scale up our development team by adding atleast 5 full-time members to EasyEngine team this month alone. Yep, <a href="https://easyengine.io/careers/python-developer/">we are looking for python developers</a>!
<h2>Why Python?</h2>
We literally tried and tested firsthand developing CLI application in three different programming languages - nodejs, Go and Python. All languages have turned out be nice so it boiled down to practical reasons rather than technical comparison.

Below are key points that went into Python's favor:
<ol>
	<li><strong>Libraries:</strong> Python turned out to be favored hugely by system-admin community so there are plenty of libraries and tools already available.</li>
	<li><strong>Cement:</strong> Python has <a href="http://builtoncement.com/">Cement</a> - a command-line application framework. It is so powerful that it comes with scaffolding (<a href="https://github.com/datafolklabs/boss-templates/">boss templates</a>), plugin architecture, templates, hooks (yeah WordPress style hooks!). In fact Cement by itself gives us a strong reason to use Python for our next CLI project.</li>
	<li><strong>Golang:</strong> EasyEngine internally does not have complex algorithms. It consists of simple automation scripts where every commands spends maximum time in filesystem and network I/O. So Go languages speed benefit are not a major factor.</li>
	<li><strong>Nodejs:</strong> Nodejs's parallel/multithreaded/async features are not required in CLI as EasyEngine does it's work in single-thread <em>(atleast as of now)</em>.</li>
	<li><strong>Ruby: </strong>We did not code much in Ruby but it was rejected much before. We wanted a language which is explicit, gives only one way to do one thing, favors documentation over magic and finally has a coding style guide of it's own (e.g. <a href="https://www.python.org/dev/peps/pep-0008">PEP08 for python</a>).</li>
	<li><strong>Skilled workforce:</strong> An idea without execution has no real value. And to make future roadmap reality, we need real people. Our HR survey showed, India has 10 times more skilled python developers as compared to Go language.</li>
</ol>
By the way, we are already hiring <a href="https://easyengine.io/careers/python-developer/">Python developers</a> to join EasyEngine project. You can <a href="https://easyengine.io/careers/python-developer/">apply</a> from anywhere as rtCamp <a href="https://easyengine.io/careers/working-remotely/">offers work from home</a>.

I know I am posting it again here. But that is just because we wish to race ahead as soon as possible! Joining early will give you many advantages.
<h2>Just to remind</h2>
Before anybody makes any assumptions, I would like to remind a few things we discussed before. :-)

These are just to avoid any misconception about the project.
<ol>
	<li>EasyEngine 3.0 will have all features currently present in EasyEngine 2.x.</li>
	<li>EasyEngine 3.0 will have an upgrade script to migrate from EasyEngine 2.x server. So you can keep using EasyEngine as it is.</li>
	<li>EasyEngine 3.0 will be open-source and GPL. Though as we are coding everything from scratch, we have choice to change the license. <em>Anybody interested in changing license?</em></li>
</ol>
<a href="https://www.flickr.com/photos/ndmccrae/5839861972/"><em>image credits</em></a>

<strong>Links:</strong> <a href="https://easyengine.io/easyengine">EasyEngine Project</a> | <a href="https://easyengine.io/careers/python-developer/">Python Opening</a> | <a href="https://easyengine.io/subscribe/?newsletter-topic=nginx">Subscribe to future EasyEngine updates</a>