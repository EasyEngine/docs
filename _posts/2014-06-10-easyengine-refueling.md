---
ID: 66405
post_title: EasyEngine is refueling
author: Rahul Bansal
post_excerpt: >
  We are refactoring EasyEngine which has
  delayed release from sometime. This post
  explains our reasons for refactoring and
  how it will help future releases.
layout: post
permalink: >
  https://easyengine.io/blog/easyengine-refueling/
published: true
post_date: 2014-06-10 16:22:21
---
<img class="alignnone wp-image-66406 size-large" src="https://easyengine.io/wp-content/uploads/2014/06/3728242273_2f1a25fac1_b-720x346.jpg" alt="3728242273_2f1a25fac1_b" width="620" height="297" />

<em>(<a href="https://www.flickr.com/photos/dwmoran/3728242273">image by Darryl Moran</a>)</em>

It has been more than a month since we last released EasyEngine's major version. This delay got many users thinking that the project has been abandoned.

I am writing this post to specifically inform all users that EasyEngine is being actively developed. In fact, we now have 3 full-time developers working on its codebase. You can see all the action in <a href="https://github.com/rtCamp/easyengine/tree/refactor">refactor branch</a>.

Refactoring is like a <a href="http://en.wikipedia.org/wiki/Pit_stop">pit stop</a> in racing. You stop for a while, but only for betterment!
<h2>Why refactor?</h2>
Like a pit stop has different goals/needs like refueling, changing tires and repairs, our refactoring has reasons as well.

In the current stable release, <a href="https://github.com/rtCamp/easyengine/blob/v1.3.8/usr/local/sbin/easyengine">main EasyEngine source codes are present in a single file with more than 3000 lines</a>!

One major goal of the new release is to divide codes into modules and commands scattered over different files.

This will make it:
<ol>
	<li>Easy to contribute/send pull requests</li>
	<li>Easy to test/maintain (we are planning to add <a href="https://code.google.com/p/shunit2/">some kind of unit testing</a>. Any help with this will be highly appreciated)</li>
	<li>Easy to build third party plugins (your own modules/commands) in future</li>
	<li>Easy to develop multiple modules in parallel</li>
</ol>
We have also extracted common codes into libraries which other bash projects can use. Reusing these code libraries internally reduces code size significantly.
<h2>How will it affect the future?</h2>
The first and most important question existing users may face is how it will work on current setup.

The good news is that we will be maintaining backward compatibility, so 99% commands will work without any change. There might be a few very small changes, but less than 1% users will encounter them. In any case, we will publish them in advance. We will have a public beta release as well, where you can test  the new EasyEngine.
<h3>Developer Community</h3>
EasyEngine has many contributors. Its new code base will be totally different, starting from files and folder hierarchy. We believe that the new structure is self-explanatory, but we will not make this an excuse to shun away from documentation.

I am documenting every aspect of the new EasyEngine, so that developer friends can catch up with the new code base easily, and contribute more often in the future.
<h2>ETA/Release Date?</h2>
For most users, this remains the most important question.

We do not have any fixed release date, but we are working hard to release Easy Engine around June 20. At the very least, we will release a public beta by then.

We have set up <a href="https://gitter.im/rtCamp/easyengine">a public chat forum for EasyEngine using gitter.im</a>. Please do not use it for general technical support.

<strong>Links: </strong><a href="https://github.com/rtCamp/easyengine/tree/refactor">EasyEngine refactor branch</a> | <a href="http://rtcamp.com/easyengine">EasyEngine Home</a>