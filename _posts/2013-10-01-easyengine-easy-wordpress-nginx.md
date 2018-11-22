---
ID: 43976
post_title: 'easyengine =  easy (wordpress, nginx)'
author: Rahul Bansal
post_excerpt: >
  easyengine is a set of command line
  scripts to manage various WordPress
  sites with Nginx web-server. It is like
  a command-line control-panel for Nginx.
layout: post
permalink: >
  https://easyengine.io/blog/easyengine-easy-wordpress-nginx/
published: true
post_date: 2013-10-01 13:35:09
---
<a href="https://easyengine.io/easyengine"><img class="alignright size-full wp-image-47495" src="https://easyengine.io/wp-content/uploads/2013/10/easyengine-logo-300x150px.png" alt="easyengine-logo-300x150px" width="300" height="150" /></a>

We are excited to announce the formal release of <a href="https://easyengine.io/easyengine/" target="_blank">easyengine</a>'s first version.

easyengine is a set of command line scripts to easily manage many types of WordPress sites on Nginx.

For those who haven't heard about Nginx yet, it's an alternative to the Apache webserver. The key thing is: it is generally 10-20 times faster. You can find <a href="http://wiki.nginx.org/WhyUseIt" target="_blank">reasons to use nginx here</a>.
<h2>The <em>easy</em> part</h2>
If you've managed Nginx sites in the past, or followed our <a href="https://easyengine.io/wordpress-nginx/tutorials/">Wordpress-Nginx tutorials</a>, you might have already wished for a cpanel-like interface for Nginx.

Well easyengine is not cpanel for Nginx, but it makes life easy by converting much complexity into simple commands.

As an example, if you have a fresh Ubuntu box (virtual machine, Amazon EC2 or <a href="http://rt.cx/digitalocean">DigitalOcean</a> box) simply run the following commands in it:
<pre class="no-highlight">curl -sL rt.cx/ee | sudo bash         # install easyengine
ee system install                     # install nginx, php, mysql, postfix 
ee site create wp basic example.com   # install wordpress on example.com</pre>
Can you believe what you have done in these 3 commands?
<ol>
 	<li>First command installed easyengine itself.</li>
 	<li>Second command installed Nginx, php, mysql, postfix and their dependencies.</li>
 	<li>Third command created a WordPress site for domain example.com.</li>
</ol>
You can replace <code>example.com</code> with any other domain you own and run (only) third command again. After that, open your domain in a browser and you will see the WordPress setup screen in its final stages awaiting you!

Well if this hasn't felt easy enough yet, you can try some more commands from the <a href="https://easyengine.io/easyengine/docs/">easyengine manual</a>.
<h2>More about easyengine</h2>
easyengine's simple 1-line commands can do a lot more stuff like:
<ol>
 	<li>Set up WordPress sites as well as multisite networks. Also, if need arises plain PHP site and HTML sites can be created using easyengine.</li>
 	<li>Use different page-cache mechanism. Currently supports w3-total-cache, wp-super-cache and nginx-fastcgi-cache.</li>
 	<li>Delete unwanted sites with option to delete database and files.</li>
 	<li>Show useful system information for Nginx &amp; php. Mysql variables will be added soon. Also support to automatically tweak system variables is on the way.</li>
</ol>
If you want easyengine to do anything specific, you can get involved at <a href="https://github.com/rtCamp/easyengine">https://github.com/rtCamp/easyengine</a>
<h3>Credits</h3>
easyengine is developed by Mitesh Shah, Manish Songirkar and <a href="https://github.com/rtCamp/easyengine/graphs/contributors" target="_blank">other contributors</a>.

easyengine uses <a href="http://wp-cli.org/" target="_blank">wp-cli project</a> for many tasks on WordPress side.

<strong>Links: </strong><a href="https://easyengine.io/easyengine" target="_blank">easyengine</a> | <a href="https://easyengine.io/easyengine/docs/" target="_blank">documentation</a> | <a href="https://github.com/rtCamp/easyengine" target="_blank">fork us on github</a>