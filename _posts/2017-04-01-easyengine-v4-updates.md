---
ID: 141557
post_title: EasyEngine v4 and updates
author: Rahul Bansal
post_excerpt: >
  A post covering EasyEngine project
  history, people behind it, how it is
  developed, where it is heading and how
  you can contribute! ?
layout: post
permalink: >
  https://easyengine.io/blog/easyengine-v4-updates/
published: true
post_date: 2017-04-01 10:53:35
---
Before I get into the current status and future of EasyEngine, I would like to give a brief background of the project and the people behind it.

I believe this will help you better understand the situation by giving you our perspective.

If you want, you can <a href="#summary">skip to the end</a>.
<h2>But first, who is "I"?</h2>
<img class="wp-image-141748 size-full alignright" src="https://easyengine.io/wp-content/uploads/2017/03/bansal-circle.png" alt="" width="180" height="180" />I am Rahul Bansal, Founder &amp; CEO of <a href="https://rtcamp.com">rtCamp</a>. If you didn't know, rtCamp is the company that develops and maintains EasyEngine. EasyEngine powers all sites managed by rtCamp.

rtCamp is a full-time engagement for me. Like most founders, I am involved in almost every department including sales, marketing, design, engineering, hiring, operations &amp; project management. The unfortunate part is that I have been involved in all these things for last eight years and did not learn to delegate much! ?

Obviously, I enjoy everything I do, and that's why I do it! The problem is that I don't get enough time for EasyEngine. As EasyEngine is <em>(still)</em> a side project for rtCamp, I can't justify spending more time on it as part of my day-to-day activities at work.

I cannot adequately define my role in the EasyEngine project. You could say that I am the Product Lead, but it's much more than that. I am behind the very idea of the EasyEngine project, its command-line syntax, internal design, architecture, features, and background research.

Of course, I received a lot of help by a team of amazing people who worked very hard to turn my idea into a reality.

However, unfortunately, I am the only one in the EasyEngine team and at rtCamp, who knows both WordPress &amp; Nginx deeply. Most people who joined rtCamp encountered WordPress or Nginx for the first time at the rtCamp!

This makes my job very tedious as I have to spend months on training people. Furthermore, I need to spend considerable time in the hiring process to find these folk.

I often get sandwiched between system admin team (which developed EasyEngine) and WordPress developer team (which needs EasyEngine) as they can't understand each other's worlds! These differences started affecting product quality.

I realized a few months back that some radical changes needed to be made. Changes that would delay the v4 release, but will speed up things after V4 gets out.

Before I get into the details, let me quickly summarize the history of EasyEngine as a project to give you a better idea of how we got here!
<h2>The EasyEngine story thus far</h2>
Let's have a look at some important events in the life of EasyEngine in chronological order:
<ul>
 	<li><strong>2009 - </strong>The same year<strong> </strong>I started<strong> </strong>rtCamp, I found Nginx when looking for a better web server to handle traffic to our then popular tech blog <a href="http://devilsworkshop.org/">DevilsWorkshop.org</a></li>
 	<li><strong>2010 -  </strong>I <a href="https://github.com/rtCamp/rtAdmin">wrote some PHP scripts</a> which would take a site name as an argument and set up an entire WordPress site- similar to what EasyEngine does. Pragati Sureka improved Those scripts</li>
 	<li><strong>2010, March 10th</strong> - We registered a domain called wpnginx.com and started WordPress-Nginx setup and services. [Side note: The massively successful wpengine.com domain was registered on the same day, just 5 hours later! ? ]</li>
 	<li><strong>2011 - </strong>I spent most of my time working on WordPress-Nginx related problems. I was the only person in our system admin team then. Good part - I got to learn a lot!</li>
 	<li><strong>2012, Sep  - </strong>I published a long series with more than a dozen <a href="https://easyengine.io/wordpress-nginx/tutorials/">WordPress-Nginx tutorials</a>. It acted as a base for EasyEngine v1 later</li>
 	<li><strong>2013, Oct 1st  - </strong><a href="https://easyengine.io/blog/easyengine-easy-wordpress-nginx/">EasyEngine v1 released</a>. It was in bash scripting language because Mitesh (our then lead EE developer) was familiar with bash. We released it under rtcamp.com ?</li>
 	<li><strong>2014, March 15th</strong> - I presented EasyEngine at WordCamp Mumbai (<a href="https://2014.mumbai.wordcamp.org/rahul-bansal-on-easyengine-easily-manage-wordpress-sites-on-nginx/">blog post</a>). It was very well received. That was the first time I realized that we had created something genuinely useful</li>
 	<li><strong>2014, July 14th</strong> - <a href="https://easyengine.io/blog/easyengine-2-0-refactor-release/">EasyEngine v2 was released</a>. It was a bash to bash refactoring. Mitesh lead it once again with help from Gaurav and Harshad</li>
 	<li><strong>2014, Nov 13th</strong> - EasyEngine.io domain was registered</li>
 	<li><strong>2015, Feb 11th</strong> - <a href="https://easyengine.io/blog/easyengine-3-python-release/">EasyEngine v3 was released</a>. Gaurav and Harshad led the release and coded it in Python, as they were comfortable with the language. I was the one who approved their decision to go with Python, so I am the one to blame for this <a href="https://easyengine.io/blog/easyengine-v4-development-begins/">blunder</a> ?</li>
 	<li><strong>2016, Oct - </strong>EasyEngine v4 development started. Another round of refactoring. Finally going back to PHP. I published <a href="https://easyengine.io/blog/easyengine-v4-development-begins/">two</a> <a href="https://easyengine.io/blog/easyengine-v4-insights-faq/">posts</a> which covered the reasons for going with PHP, among other things</li>
 	<li><strong>2017</strong> - We are yet to release v4! I know this is frustrating for many users. Let me give you more details about this next</li>
</ul>
<h2 id="the-best-or-nothing">V4 - Current Status and Release ETA</h2>
<img class="alignnone size-large wp-image-141761" src="https://easyengine.io/wp-content/uploads/2017/03/cropped-ee-v4-blog-post-update-720x287.png" alt="EasyEngine EE v4 blog post update" width="720" height="287" />

EasyEngine was created to make managing WordPress sites on Nginx web servers EASY. If you ask me to describe our #1 goal in a single word, it would be "Easy." If it's not Easy, it's not done!

If the goal had been just to push a release, we could have released EasyEngine v4 a few months ago!

In Dec-Jan, I did an in-depth code review, and I realized that the quality wasn't up to my expectations. I wanted to review everything that's going to be in EasyEngine v4 to ensure the best possible quality. I am not happy with the number of issues users face when dealing with Let'sEncypt- one of few features that was released without much of my involvement.

While analyzing the code, I noticed that many common design patterns were not used. That was one of the main reasons why I decided to move the project from the system admin team to WordPress developer team.

Even though both teams are well-experienced, our system admin team has comparatively less programming experience. They are more familiar with writing automation scripts, Ansible playbooks, etc.

It's very hard to find a competent system admin with good PHP programming skills, at least in India. On the other hand, I am finding it easier to train our best PHP developers about Nginx internals.
<h3>What are we working on now?</h3>
Even though rtCamp's WordPress team is busy with client work, they squeezed EE development into their schedules.

It's going slowly, but things are already looking better. We have worked on many design decisions and developed modular code that can be integrated at a later stage.

Mainly:
<ul>
 	<li>The "ee stack" command's codes will be <a href="https://github.com/EasyEngine/easyengine/issues/866">separated</a> as a composer package so other PHP projects can use it. It will make supporting different OS, and even Docker support easy</li>
 	<li>The current <a href="https://github.com/EasyEngine/easyengine/issues/851">mustache templates</a> folder is a mess. We would be refactoring it to use a templating engine for real. This will improve the quality of the Nginx configurations generated. The new templating engine will be available as a standalone site so those who prefer to do things manually, can still have some "easy"-ness (when compared to copying the config from our <a href="https://easyengine.io/wordpress-nginx/tutorials">WordPress-Nginx tutorials</a> section)</li>
 	<li>There are <a href="https://github.com/EasyEngine/easyengine/issues/858">many libraries</a> we are exploring to improve code quality and achieve few things better</li>
</ul>
Apart from code, we have spent more than 500 man-hours in the last six months researching Docker-based hosting and on two more tasks:
<ol>
 	<li><strong>Troubleshooting </strong>- Debugging bad-quality code, slow MySQL queries, making sense of error logs</li>
 	<li><strong>Dev Workflow</strong> - Deploying code changes from your development machine to the remote server and vice-versa. Easily creating staging servers from live servers</li>
</ol>
We always <a href="https://easyengine.io/docs/development-lifecycle/">invest a lot more time in background research than code</a>. There are still a lot of problems to get over, but we want to use this refactoring opportunity to build a base to launch them off with minimal efforts in future.
<h3 id="eta-v4">ETA/Release Date</h3>
We can't commit any release date, but we are trying to get v4 out in July 2017.

Of course, you can help us go faster!
<h2 id="how-you-can-help">Call for Contributors</h2>
I am really happy that many in the EE community come forward to help when they saw that development on the project is moving slowly.

At this stage, we require your time more than money!

Below are some areas in which you can contribute. I will move this to a dedicated page soon. If you can figure out any other way to help the project move faster, please let us know via the comments.
<ol>
 	<li><strong>Product Lead</strong> - Set tasks/features for releases. Dedicate time to test EasyEngine from a user perspective during development. Review code for edge-cases. Ask questions about decisions made. I am ready to spend 10-hours every week, which seems enough for now</li>
 	<li><strong>Maintainer</strong> - Apart from the code itself, we have GitHub issue trackers, the community forum, and the Slack community. Maintainers will be very helpful to manage all of these</li>
 	<li><strong>Code-Reviewers</strong> - Anybody who has experience of reviewing PHP codebase can review pull requests</li>
 	<li><strong>Architects</strong> - If you have spent time designing a Laravel/Symfony project, especially a command-line one, please get in touch right now. We would need at least few hours from you per week for the next 1-2 months. <a href="https://github.com/EasyEngine/easyengine/issues/858">Please have a look at this Github issue</a> for a sample task</li>
 	<li><strong>Developers</strong> - People who can contribute full/part time on programming tasks. To keep the project healthy, we will require one developer full-time. It's hard for rtCamp to commit a full-time developer for at least the next three months</li>
 	<li><strong>QA</strong> - People who can write Behat-based BDD test cases. We are flexible on Behat as long as you take the lead. CI/CD setup with test cases is also needed</li>
 	<li><strong>Documentation</strong> - Any help with documentation or content would be great. There is so much to document!</li>
 	<li><strong>Research</strong> - Feature requests such as shared hosting, Docker, WordPress-in-subdirectories require a lot of research. But it's the work done here that makes EasyEngine "Easy"!</li>
</ol>
As you can see, to manage a project of this size, we need a bigger team. Currently and historically, the core team has been only rtCamp employees. This is not an ideal situation for the project.

One of the main reasons why we decided to refactor EasyEngine to PHP was to leverage the power of the PHP/WordPress community. We need your involvement now more than ever!
<h2 id="crowdfunding">What about crowdfunding?</h2>
Any financial help would indirectly help as it would enable us to hire dedicated developers for the v4 release. However, I'm not too keen on crowdfunding to release v4 for the following reasons:
<ul>
 	<li>I don't think it's a sustainable model to build something that will require ongoing support. The amount of effort needed <em>after</em> v4 release will be much higher than getting v4 released</li>
 	<li>We might be doing a disservice to the community by running a crowdfunding campaign, as v4 itself won't have any new features. In fact, it might take away some features!</li>
 	<li>If we decide to run a crowdfunding campaign for the v4 release as well as ongoing development, the target amount might be too large for a community of our size</li>
</ul>
I am not completely rejecting the idea of crowdsourcing. I feel that there are better alternatives, like recurring donations, something like what <a href="https://www.patreon.com">patreon.com</a> offers.

If you have any ideas, please let us know. We are not looking for a one-off solution to push us over the line, but a month-on-month recurring flow on an ongoing basis.
<h3>What about sponsorships?</h3>
Few hosting companies approached us, but things did not work out.

We still would love to have some sponsors as long as their offers are in line with EasyEngine's project goals.
<h2 id="summary">In Summary</h2>
<ol>
 	<li>We want EE v4 to be no less than awesome. And that needed us to take a step back [<a href="#the-best-or-nothing">Jump↑</a>]</li>
 	<li>We require your contribution. For now: Time &gt; Money [<a href="#how-you-can-help">Jump↑</a>]</li>
 	<li>Crowdfunding is not ideal. We are looking for sustainable ways to support the project [<a href="#crowdfunding">Jump↑</a>]</li>
 	<li>Unless we get some magical contributions, I don't think we will be able to ship EasyEngine v4 before July 2017 [<a href="#eta-v4">Jump↑</a>]</li>
</ol>
All I can ensure is that it will be worth the wait! <a href="https://github.com/EasyEngine/easyengine/projects/1">You can track progress from this GitHub project board</a>.

Do get in touch with us via <a href="https://twitter.com/easyengine/">Twitter</a> or the comments below if you think that you can help the project in any way. We are counting on your support!

<strong>Links</strong>: <a href="https://github.com/EasyEngine/">EE on GitHub</a> | <a href="https://github.com/EasyEngine/easyengine/projects/1">EE V4 Project board</a>