---
ID: 141518
post_title: 'EasyEngine&#8217;s NGINX build updated'
author: Joel Abreo
post_excerpt: ""
layout: post
permalink: >
  https://easyengine.io/blog/easyengine-now-includes-the-latest-nginx-1-10-3-build/
published: true
post_date: 2017-03-23 11:09:35
---
EasyEngine now includes the latest NGINX 1.10.3 build that has a <a href="https://nginx.org/en/CHANGES-1.10">bunch of bug fixes</a>. Fresh installs of EE will come with new NGINX build out of the box.

Use the following commands to update the NGINX version in your existing EasyEngine install:
<pre>sudo apt-get update
sudo apt-get -o Dpkg::Options::="--force-confold" install nginx-custom nginx-ee</pre>
<pre><em><strong>Note:</strong> If command asks you to keep old/new config - always choose old.</em></pre>
If you want to build the package yourself, refer to this <a href="https://github.com/EasyEngine/nginx-build/wiki">GitHub Wiki page</a>. We have included detailed steps along with some other resources that you might find useful.
<h2>Why the delay?</h2>
The EasyEngine team has seen some personnel changes over the past few months. This shouldn't have affected our timelines, but our NGINX-build process was not properly documented, resulting in the delay.

This time around, we wanted to make sure that we document the entire process before release. Take a look at the <a href="https://github.com/EasyEngine/nginx-build/wiki">EE GitHub Wiki</a> for our progress thus far. We are looking for package maintainers who can carry on from here- do get in touch if you are interested.

We would love to automate the build process for the next release. We started by using <a href="https://about.gitlab.com/2016/10/12/automated-debian-package-build-with-gitlab-ci/">this post</a> as a guide, but will require more time to properly test it and get it working. If you have cracked build automation, please share your secret sauce with us :)
<h2>Need help with something?</h2>
Don't hesitate to use the EE <a href="http://community.rtcamp.com/c/easyengine">Community Forum</a> and <a href="http://slack.easyengine.io/">Slack channels</a> if you run into any issues. You can also reach out to us via <a href="http://community.rtcamp.com/c/easyengine">Twitter</a>.

Have a good one! :)

<strong>Links</strong>: <a href="https://nginx.org/en/CHANGES-1.10">NGINX changelog</a> | <a href="https://github.com/EasyEngine/">EasyEngine GitHub repo</a> | <a href="https://easyengine.io/contact/">Contact us</a>