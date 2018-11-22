---
ID: 141325
post_title: A few words on Dirty Cow
author: Joel Abreo
post_excerpt: ""
layout: post
permalink: >
  https://easyengine.io/blog/easyengine-dirty-cow/
published: true
post_date: 2016-11-03 19:41:56
---
We have been receiving a lot of questions and concerns from EasyEngine users about <a href="https://en.wikipedia.org/wiki/Dirty_COW">Dirty Cow</a>, which is why we thought it best to write this post.

Below is tweet showing concern raised by <a href="https://twitter.com/vikramuk/">Vikram</a>.

https://twitter.com/vikramuk/status/792375352995622912
<h3>What is Dirty Cow?</h3>
Dirty Cow is a Linux kernel vulnerability that can be exploited to elevate an unauthorized user's system privileges. Without going too far into the specifics, an attacker can take advantage of a flaw in the copy-on-write (COW) mechanism in the Linux kernel to gain root access to a system.

The Debian software community, including the Ubuntu security team, have already released patches that rectify this issue. (<a href="http://people.canonical.com/~ubuntu-security/cve/2016/CVE-2016-5195.html">Ubuntu</a> / <a href="https://security-tracker.debian.org/tracker/CVE-2016-5195">Debian</a> security trackers)
<h3>Is EasyEngine affected?</h3>
EasyEngine is not affected by this vulnerability. This is because Dirty Cow affects the layer "beneath" EasyEngine, as shown in the diagram below.

<img class="size-full wp-image-141347 alignnone" src="https://easyengine.io/wp-content/uploads/2016/11/ee_blog_post_dirty_cow.jpg" alt="Standard server architecture" width="645" height="392" />

As with most modern systems, the OS is not directly visible to a user, especially someone who doesn't have access to your server. Any potential intruder will have to obtain direct access to your server to cause you any harm. In other words, <em>Dirty Cow cannot be exploited remotely without the help of  another security flaw.</em>
<h3>What should I do?</h3>
Dirty Cow has caused a major splash in the technology world, with many news outlets picking up on the hype.

Regardless of how dangerous this exploit is, this should serve as a reminder of the importance security measures. We recommend that you take this opportunity to have a look at your security setup and tie up any loose ends.

Most major Linux distributions have already acknowledged and started work fixing this issue.

Hint: <code>apt-get update &amp;&amp; apt-get upgrade </code>

As EasyEngine is not affected, there will be no update or patch release. That's one less update to worry about :)

Feel free to start a conversation via the comments below or our social channels. Have a safe weekend!

<strong>Links</strong>: <a href="https://twitter.com/easyengine">Twitter</a> | <a href="https://www.facebook.com/easyengine/">Facebook</a> | <a href="http://people.canonical.com/~ubuntu-security/cve/2016/CVE-2016-5195.html">Ubuntu</a> &amp; <a href="https://security-tracker.debian.org/tracker/CVE-2016-5195">Debian</a> security trackers