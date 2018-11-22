---
ID: 133901
post_title: >
  EasyEngine 3.6 with Nginx 1.10 and
  Ubuntu 16.04 Support
author: Rahul Bansal
post_excerpt: ""
layout: post
permalink: >
  https://easyengine.io/blog/easyengine-3-6-nginx-1-10-ubuntu-16-04-support/
published: true
post_date: 2016-05-16 15:57:24
---
I know many users are eagerly waiting for Ubuntu 16.04 support. But personally, it was support for Nginx 1.10 which excites me more. Both were released around the same time.

There are many exciting changes in this EasyEngine release. Let me describe them one by one.
<h2>Nginx 1.10 + HTTP/2 Support</h2>
Nginx 1.10 adds HTTP/2 feature in it's stable branch. So you no longer need to use Nginx Mainline for HTTP/2 (<a href="https://easyengine.io/docs/http2-support/">as described here</a>).

I was very much against adding support for Nginx Mainline release channel in EasyEngine. EasyEngine's main goal is to make things Easy, so it was designed to only support Nginx Stable.

Due to a lot of pressure from EasyEngine community, we added a workaround for it and it worked nicely. But with Nginx 1.10 we don't need Nginx 1.9x (mainline) branch for HTTP/2. So we have removed support for nginx-mainline builds.
<h3>spdy to http/2 migration</h3>
We also removed support for <a href="http://nginx.org/en/docs/http/ngx_http_spdy_module.html">nginx spdy module</a>. But if you are an old EasyEngine user and some of your Nginx conf has <code>spdy</code> enabled for any of your site, <code>ee update</code> will automatically move those sites from <code>spdy</code> to <code>http2</code>.
<h3>pagespeed completely removed</h3>
We announced <a href="https://easyengine.io/blog/disabling-pagespeed/">removal of pagespeed support</a> sometime ago. While updating our nginx build, we also removed pagespeed module.

We have added a check to <code>ee update</code> script for this. Update script will check if any of your site is using pagespeed. If pagespeed is found on any site, update script will check that site's name and ask you to disable pagespeed by following - <a href="https://easyengine.io/blog/disabling-pagespeed/">https://easyengine.io/blog/disabling-pagespeed/</a>. Once you disable pagespeed, you can run <code>ee update</code> again.

If you want to continue using pagepseed, you cannot upgrade to the new EasyEngine version.
<h2>Ubuntu 16.04 Support</h2>
We have added support for 16.04 LTS release. Other Ubuntu LTS releases with active support are supported already.

There was a strong demand for Ubuntu 16.04 support. As a new OS support requires a lot of work to build our custom nginx package for it, this took time.

Also, there were significant changes to Nginx build itself, as mentioned above, we needed more time to fix them first. We did not want to carry <a href="https://en.wikipedia.org/wiki/Technical_debt">technical debt</a> resulting from spdy module, pagespeed module and nginx-mainline to Ubuntu 16.04 LTS. So we chose to fix our Nginx build for existing OS first.

Apart from this, upgrade from one LTS to another LTS release is easy. So you can always start with any LTS release which gets the job done. Please remember <a href="https://wiki.ubuntu.com/LTS">LTS means Long Term Support</a>.
<h2>Upgrade Summary</h2>
As this is a major release, it's better to summarize what <code>ee update</code> will do internally:
<ol>
 	<li>Remove pagespeed - only if no site is using pagespeed</li>
 	<li>Move SPDY sites to HTTP/2</li>
 	<li>Remove Nginx Mainline package (if installed)</li>
 	<li>Update Nginx stable to Nginx 1.10</li>
</ol>
Please check release <a href="https://github.com/EasyEngine/easyengine/releases/tag/v3.6.0">changelog</a> for details.

Please note that ee update won't upgrade Ubuntu version. I hope someday EasyEngine can handle that as well. :-)

<strong>Link: </strong><a href="https://github.com/EasyEngine/easyengine/releases/tag/v3.6.0">EasyEngine Release Notes</a>