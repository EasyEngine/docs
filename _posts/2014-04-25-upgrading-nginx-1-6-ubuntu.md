---
ID: 64653
post_title: Upgrading to Nginx 1.6 on Ubuntu
author: Rahul Bansal
post_excerpt: >
  Nginx 1.6 upgrade instruction for
  easyengine users as well as for manual
  installations performed by following our
  wordpress-nginx tutorials.
layout: post
permalink: >
  https://easyengine.io/blog/upgrading-nginx-1-6-ubuntu/
published: true
post_date: 2014-04-25 13:52:22
---
Recently, we built our first launchpad repo, as nginx repo we were relying on, wasn't updated from long time.

Within a day after building nginx repo, nginx 1.6 stable version was released. Since we are maintaining our own repo now, we have upgraded launchpad repo immediately and now you can use custom built nginx 1.6 as needed for some of our <a href="http://rtcamp.com/wordpress-nginx/tutorials/">wordpress-nginx tutorials</a>.
<h2>Upgrading to Nginx 1.6</h2>
<h3>For EasyEngine Users</h3>
Simply run <code>ee update</code> command on your server and you will be on latest Nginx 1.6.
<h3>For WordPress-Nginx Tutorials Users</h3>
Simply run following commands on server:
<pre class="no-highlight">add-apt-repository -y ppa:rtcamp/nginx
apt-get update
apt-get install nginx-custom</pre>
<h2>Verify</h2>
Run <code>nginx -v</code> to check nginx version.

If you face any issue, please use our <a href="https://easyengine.io/support">support forum</a>.

<strong>Links: </strong><a href="http://rtcamp.com/easyengine">EasyEngine Project</a> | <a href="https://easyengine.io/wordpress-nginx/tutorials/">WordPress-Nginx Tutorials</a> | <a href="https://launchpad.net/~rtcamp/+archive/nginx">LaunchPad Repo</a>