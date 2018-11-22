---
ID: 133656
post_title: >
  Pre-installation steps-non interactive
  way
author: Nitun Lanjewar
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/docs/dev/pre-installation-non-interactive-way/
published: true
post_date: 2016-03-02 09:42:07
---
First make sure all the required parameters has been set in git config.

Use this command:
<pre><code>sudo bash -c 'echo -e "[user]\n\tname = abc\n\temail = root@localhost.com" &gt; /home/user/.gitconfig'</code></pre>
&nbsp;

Change email &amp; name as per your need. Once, you have created above file, run easyengine default installation command <code> wget -qO ee rt.cx/ee &amp;&amp; sudo bash ee</code> to install it in a non-interactive way.

Refer other variable <a href="https://github.com/EasyEngine/easyengine/blob/master/.travis.yml">https://github.com/EasyEngine/easyengine/blob/master/.travis.yml </a>to make script non interactive.