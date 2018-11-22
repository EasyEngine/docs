---
ID: 133765
post_title: Disabling PageSpeed
author: Rahul Bansal
post_excerpt: >
  It is recommended to disable PageSpeed
  on your sites and server in wake of
  recent PageSpeed security issues
layout: post
permalink: >
  https://easyengine.io/blog/disabling-pagespeed/
published: true
post_date: 2016-04-08 23:12:59
---
<p class="warning">Note: This feature is depreciated with <a href=https://easyengine.io/blog/easyengine-3-6-nginx-1-10-ubuntu-16-04-support/>EasyEngine v3.6.0.</a></p>
Sorry for delay in replying. I got many personal emails, messages on social media and also our forum has been flooded with topics about <a href="https://developers.google.com/speed/pagespeed/module/announce-0.10.22.6">recent pagespeed update</a>.

First let's get to the point!
<h2>How to disable pagespeed</h2>
On every site you are using PageSpeed, just run following command to disable PageSpeed.
<pre>ee site update example.com --pagespeed=off</pre>
Additionally, you can run:
<pre>ee stack purge --pagespeed</pre>
Above will remove PageSpeed global config from Nginx.

Now...
<h2>Why Not Provide PageSpeed Update?</h2>
It will take a lot more time for us to update our Nginx build. We tried today to update our Nginx build with latest PageSpeed first.

There are also some compatibility issues between 32-bit OS and PageSpeed. So we need to do a lot more work which will probably happen on Monday. If things gets complicated, we will drop support for PageSpeed altogether.

PageSpeed is already experimental feature.  We did not find it useful ourself and haven't used it on any sites.

For static sites - it does more harm than benefit. Here is discussion - <a href="https://github.com/EasyEngine/easyengine/issues/497">https://github.com/EasyEngine/easyengine/issues/497</a>.

Our Nginx-Build is open-source so if anyone like to contribute, please help us at <a href="https://github.com/EasyEngine/nginx-build">https://github.com/EasyEngine/nginx-build</a>. We use <a href="https://build.opensuse.org/">https://build.opensuse.org/</a> for package building and hosting.

I can understand you may still want to use PageSpeed but it is really hard to support something we do not use ourself. So sorry for any inconvenience it may cause:
<h2>Have Questions?</h2>
Please use comment form below for general concerns and questions. If above command fails for you, please create a topic in <a href="http://community.rtcamp.com/c/easyengine">http://community.rtcamp.com/c/easyengine</a> forum.

<strong>Link: </strong><a href="https://easyengine.io/docs/lets-encrypt/">Use Let's Encrypt</a> | <a href="https://github.com/EasyEngine/nginx-build">Our Nginx+PageSpeed build</a>