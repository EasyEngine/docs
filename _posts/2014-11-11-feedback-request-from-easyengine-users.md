---
ID: 75751
post_title: >
  Feedback Request from EasyEngine Users
  for biggest upcoming changes
author: Rahul Bansal
post_excerpt: >
  EasyEngine team is looking for user
  feedback for some critical technical as
  well as non-technical decisions that
  will affect project in long run.
layout: post
permalink: >
  https://easyengine.io/blog/feedback-request-from-easyengine-users/
published: true
post_date: 2014-11-11 18:05:17
---
<strong>Update:</strong> We have posted <a href="https://easyengine.io/blog/easyengine-3-roadmap/">updated roadmap and other details for EasyEngine</a> based on all feedback we have received. Thanks for all your feedback. :-)

<hr />

<em><strong>Note:</strong> Be assured that our current feature set of EasyEngine will remain free. Even if we decide to refactor EasyEngine on new platform.</em>

If you are following the <a href="https://easyengine.io/easyengine">EasyEngine</a> project for some time, you may have realized that development has slowed down. We missed the deadline for the last few milestones.

To get the project back on track we need to do go through some major changes - technical as well as non-technical. As this could affect you, we thought it is better to get some feedback from you.

Mainly we need answers for following questions:
<ol>
	<li>Future Development Strategy: Which programming language you would like to see EasyEngine developed on in future?</li>
	<li>What do you think about business/revenue models for EasyEngine?</li>
</ol>
I will explain these one by one.
<h2>Future Development Strategy</h2>
<em><strong>Note:</strong> EasyEngine commands will not break and will continue to work the same way. Including <code>ee update</code> command.</em>
<h3>Choice of Programming Language</h3>
<img class="alignright wp-image-75872 size-full" src="https://easyengine.io/wp-content/uploads/2014/11/efficiency.png" alt="" width="329" height="214" />We are planning to refactor EasyEngine in higher-level programming language. There are many reason to do this.

It is getting increasingly painful to manage large/modular codebase in bash. Testing is hard. Implementing plugin architecture might be harder.

With every small enhancements, we are spending a lot of time in regression issues. Every time we add a subcommand or even add a flag, we need to spend a lot of time.

I already posted <a href="http://www.quora.com/Programming-Language-Comparisons-Which-is-better-for-command-line-project">question about this on quora</a> but met with zero response. So we started testing all programming languages under consideration by creating a small project in python, javascript (nodejs) and golang. Ruby is also under consideration but not among prime contenders. Of course, we are open to try other languages as well.

<a href="https://github.com/rtCamp/cli/">Code for this dummy project is here on Github</a>.

Another reason to go for higher level language is - availability of skilled programmers. I personally feel bash as a programming language isn't taken seriously by developers community.

Most programmers I interviewed were good at writing install scripts, but they were blank when asked about designing a modular, extendable, testable big project in bash.

So we need your opinions about programming language choice. If we have to leave bash behind - <strong>which programming language you would like to see EasyEngine version 3 being developed?  </strong>
<h2>Business/Revenue model</h2>
Before you jump to any conclusion, let me clarify that current feature set of EasyEngine will remain free. Even if we decide to refactor EasyEngine on new platform.

Until now, EasyEngine was developed mostly in free time. I want to have a dedicated team on it. We already have 3 developers and we are willing to hire many more on the EasyEngine project.
<h3>Current Service-oriented Revenue Model</h3>
But the current team's salary is paid from <a href="https://easyengine.io/wordpress-nginx/">wordpress-nginx</a> and <a href="https://easyengine.io/wordpress-nginx/retainer-contract/">managed-hosting </a>services.

The problem with current model is - EasyEngine project becomes a secondary priority. We first have to focus on serving our paying customers for obvious reasons.

We tested this model with our <a href="https://easyengine.io/rtmedia/">rtMedia</a> project and at one point, there was so much hard to work on actual project that we abandoned it. But almost a year, we went freemium and since then developing the project has been very smooth ride.
<h3>New Revenue Models</h3>
After a lot of thinking, we came up with following new revenue models.
<h4>Premium Helpdesk</h4>
In between free <a href="http://community.rtcamp.com/">support inside community forum</a> and our <a href="https://easyengine.io/wordpress-nginx/">premium wordpress-nginx services</a>, we are planning to introduce a premium-helpdesk.

It will be designed for system-admin who do not want to pay high for our premium services but still require some 1-on-1 support with guaranteed response time on ongoing basis.
<h4>Freemium</h4>
EasyEngine free version with some premium features delivered as EasyEngine modules (plugins).

This model might be attractive for other developers as well. Hence choice of programming language for next version of EasyEngine is crucial.
<h4>Web-Based Version &amp; Mobile-Apps</h4>
Apart from command-line premium modules, we are also planning to start work on web-based version and mobile-apps.

Web-based version will be likely delivered as a service with self-hosted on-premise options for enterprises. It will be much more than just web-interface to EasyEngine commands. That is why it will take big deal of money to develop it!

I am serious enough about this web-based version that for the first time, I am even considering going for external funding! ;-)

Be it web or mobile app, both will be using well-documented REST API for project. Hence, REST API is another reason for doing things in high level programming language.

<strong>Let us know what do you think about new revenue models? </strong>

We reassure you that features you see in today's EasyEngine will remain free and accessible with same easiness as of today!

Please send your feedback as soon as possible. Because these are the kind of changes which has potential to change course of this project forever.

<em>(image credits: <a href="http://xkcd.com/1445/">xkcd</a>)</em>