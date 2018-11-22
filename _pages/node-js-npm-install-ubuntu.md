---
ID: 48910
post_title: 'Latest node.js &#038; npm installation on Ubuntu 12.04'
author: Rahul Bansal
post_excerpt: >
  Latest node.js and npm installation
  using launchpad repo and apt-get method
  on Ubuntu 12.04 LTS
layout: page
permalink: >
  https://easyengine.io/tutorials/nodejs/node-js-npm-install-ubuntu/
published: true
post_date: 2013-10-17 01:14:26
---
Compiling is way to go for many but I am mostly in hurry so following works for me!
<h2>Adding Chris Lea's Repo</h2>
Using <a href="https://launchpad.net/~chris-lea/+archive/node.js/">Launchpad repo by Chris Lea</a> just run following commands
<pre class="no-highlight">apt-get install python-software-properties
apt-add-repository ppa:chris-lea/node.js
apt-get update</pre>
<h2>node.js install</h2>
<pre class="no-highlight">apt-get install nodejs</pre>
Check node.js version
<pre class="no-highlight">node -v</pre>
Outputs
<pre class="no-highlight">v0.10.20</pre>
<h2>npm install</h2>
Above command should install npm.

Check npm version
<pre class="no-highlight">npm -v</pre>
Outputs
<pre class="no-highlight">1.4.3</pre>
If for some reason, if you see npm is not installed, you may try running:
<pre class="no-highlight">apt-get install npm</pre>
P.S. Do not miss out on our other amazing <a href="https://rtcamp.com/tutorials/">tutorials</a>. Stay tuned with <a href="https://rtcamp.com/subscribe/">us</a>. Join us on <a href="https://twitter.com/rtCamp">twitter</a> and <a href="https://www.facebook.com/rtCamp.solutions">facebook</a> for more updates.

(updated on 20 Feb 2014. After <a href="#comment-114163">this comment</a> from <a href="http://www.dodyrw.com/">dodyrw</a>)
<h4></h4>
<h4></h4>