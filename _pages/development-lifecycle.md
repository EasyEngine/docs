---
ID: 141659
post_title: Development Lifecycle
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/docs/development-lifecycle/
published: true
post_date: 2017-03-30 19:53:05
---
We are not sure what people calls it or if it formally exists. We call it <strong>Documentation Driven Development (DDD)</strong>.

Under Documentation Driven Development, this is how we do things:
<ul>
 	<li>We pick a task/feature.</li>
 	<li>We then evaluate the need for it, identify existing solution, spend days reading and getting hands on it.</li>
 	<li>If we see value in it, we start documenting the way we are using it - mostly in an internal Google Doc.</li>
 	<li>Then we test new methods/process on our test servers, from there on our production servers.</li>
 	<li>As we move from one round of testing to the next one, we keep updating the document.</li>
 	<li>Finally, we post document under <a href="https://easyengine.io/tutorials/">https://easyengine.io/tutorials/</a>. You may visit <a href="https://easyengine.io/tutorials/composer-wordpress/">Composer &amp; WordPress</a> section for a currently work-in-progress section.</li>
 	<li>Here is the point where people who read our articles gives us feedback.</li>
 	<li>Assuming, the documented thing is ready for easyengine integration, we create a "draft" documentation page about CLI interface i.e. commands, subcommands, arguments, options and their default/possible values under <a href="https://easyengine.io/docs/commands/">https://easyengine.io/docs/commands/</a>. We add a note to the page, so the user understands that the document refers to the future commands. There is no example of any "draft" document page publicly accessible.</li>
 	<li>When a new version of EasyEngine is ready, we verify it against the document. If there is a mismatch, we discuss it and either fix code or docs or both.</li>
 	<li>Release new version.</li>
 	<li>Test new version on our clients' test server and production server, in this order only.</li>
</ul>