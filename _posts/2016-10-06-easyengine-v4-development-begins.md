---
ID: 141261
post_title: EasyEngine v4 Development Begins
author: Rahul Bansal
post_excerpt: >
  EasyEngine v4 development starts on PHP.
  Next version will be based on WP_CLI. We
  are looking for contributors to make
  EasyEngine easier.
layout: post
permalink: >
  https://easyengine.io/blog/easyengine-v4-development-begins/
published: true
post_date: 2016-10-06 14:20:46
---
<img class="alignnone size-large wp-image-141273" src="https://easyengine.io/wp-content/uploads/2016/10/blogpost-EEv4-in-making-SD-02-720x266.jpg" alt="EE v4 development begins!" width="720" height="266" />

<em><strong>Update:</strong> I have <a href="https://easyengine.io/blog/easyengine-v4-insights-faq/">published a followup post providing more details</a>.</em>

<hr />

After a long hiatus, during which we worked mostly on bug fixes and security patches, we are back in full swing with EasyEngine's development.

EasyEngine v4 will have a "sub-set" of the current feature-set. In technical terms, this is another round of refactoring, and hopefully a final one! I am not a big fan of refactoring big projects, but sometimes you have no choice! :-|

We are aware of the many pending feature requests- this release will not have any additional user-centric features, but focus on the developer side of things.
<h2>v4 Goals</h2>
We are developing v4 in PHP, based on the <a href="https://github.com/wp-cli/wp-cli">WP-CLI project</a>. Current goals are:
<ol>
 	<li>Make v4 modular with something like <code>ee packages</code> , based on <a href="https://wp-cli.org/commands/package/">WP-CLI packages</a>. This is the primary goal of this version. We not only wish to support adding new commands but also adding new arguments to existing commands. As an example, <code>ee site create</code> commands could have <code>ee site create example.com --laravel </code>which as the argument suggests, can be used to set up a Laravel site.</li>
 	<li>Reuse as many things from the WP-CLI project as possible. Going ahead, the idea is to contribute back more frequently. We wanted to use WP-CLI as a "framework," but as it is a "project" itself, it took some time to figure out how to get started.</li>
 	<li>Move some core features to packages, depending on the success with <code>ee packages.</code> Our plan is to remove some core features such as mail stack, admin tools,  HHVM support &amp; W3 Total Cache support and move them to EasyEngine packages. The remaining features will be left to the community.</li>
 	<li>Make migration from v3 to v4 smoother by having fewer v3 releases during v4 development. This will effectively deprecate some v3 features.</li>
 	<li>Move <a href="https://easyengine.io/docs/admin-tools-22222/">EE admin tools</a> into its own repo and maybe manage it via an EE package.</li>
</ol>
That's it! No new features! In fact, as mentioned, we plan on removing some features from the core and turning them into packages.

It is always hard to maintain something that we don't use ourselves. This is why I firmly believe that packages are the right direction for some features.
<h2>Call for contributors</h2>
In the past, a common reason why EasyEngine users did not contribute when asked is because they did not believe they had the Python skills needed.

These users should find it easier to contribute to v4, now that the project has been shifted to PHP and WP-CLI.

Another motivation to contribute is the package system. You can now build EE packages that can be completely free, paid or free packages that make consuming your premium offerings easier. In any case, we will help you with package distribution.

Some ideas for packages you may consider are <a href="https://github.com/EasyEngine/easyengine/issues/150">shared hosting support</a> or integration with a premium backup service.

We are also considering setting up a marketplace for EE packages, but it's too early to say more.
<h2>How do I contribute?</h2>
The first thing you should do is join the <span style="background-color: #f5f6f5; font-family: monospace, serif;">#v4 </span>channel on <a href="https://easyengine.io/slack/">EasyEngine's slack team</a>.

You can also join the v4 project on Github - <a href="https://github.com/EasyEngine/easyengine/tree/feature/v4.0.0">https://github.com/EasyEngine/easyengine/tree/feature/v4.0.0</a> . As always, all core development will be visible to all.

Some other ways you can get involved:
<ol>
 	<li>Design/Architecture - If you know WP-CLI inside &amp; out, please contact us ASAP. You are most wanted! ?</li>
 	<li>Development - You can work on any open issue, or even better, create some packages. ?</li>
 	<li>Testing - If you are familiar with PHPUnit/Behat, you can help with testing. ✅</li>
 	<li>Documentation - We do not anticipate many changes with EE commands themselves. But existing documentation can always be improved ?</li>
</ol>
If you feel you can contribute in any other way, please join us! You can reach out to us on <a href="https://twitter.com/easyengine">Twitter</a> or <a href="https://www.facebook.com/easyengine/">Facebook</a>.

<strong>Links: </strong><a href="https://github.com/easyengine/easyengine">EasyEngine on Github</a> | <a href="https://easyengine.io/slack">Join EasyEngine Slack Team</a>

<em><strong>Update:</strong> I have <a href="https://easyengine.io/blog/easyengine-v4-insights-faq/">published a followup post providing more details</a>.</em>