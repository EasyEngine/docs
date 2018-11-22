---
ID: 111748
post_title: >
  EasyEngine 3.3 released with Full-Page
  Redis Cache support
author: Rahul Bansal
post_excerpt: >
  EasyEngine new release adds full-page
  redis-cache support without any changes
  or plugins requirement on WordPress end.
  Redis-cache is must faster and works
  better in multi-server setup.
layout: post
permalink: >
  https://easyengine.io/blog/easyengine-3-3-full-page-redis-cache/
published: true
post_date: 2015-07-14 18:29:43
---
In this <a href="https://easyengine.io/easyengine">EasyEngine</a> release, we have added support for full-page redis cache support.

Unlike other methods around, this works without any changes to WordPress index.php file or any plugin to add pages in redis-cache.

With this new method some benchmarks we done using <a href="https://loader.io/">loader.io</a> and it showed 3-4x improvement over fastcgi-cache. But benchmark/performance is not a reason for experimenting  with redis cache.

We needed a caching solution which works across multiple servers.  So the only choice was to go with something like memcache/redis. Both supported master-slave replication and both performed equally.

We chose to go with Redis as it seems to be a lot easier to work with. Another plus was that we like redis feature, where it can save/reload cache from the disk. This can be used in some very creative ways for some really big sites. We will write more about the more "creative" stuff some other day!

Let's get going with the new feature. :-)
<h2>Usage</h2>
First, you will need to update EasyEngine itself by running <code>ee update</code>

Then you can create a new site using <code>ee site create example.com --wpredis</code>

or update an existing site using <code>ee site update example.com --wpredis</code>

Please note that multi-server setup is not present currently in EasyEngine. But we hope to provide some documentation soon and of course some EasyEngine commands in the future.
<h3>Experimental warning!</h3>
When you will run the above commands, you will get a warning from EasyEngine. As this is a new caching method and it also uses redis as object-cache (instead of W3 Total Cache), we thought it was better to warn users in advance.

We are using this feature here on <a href="https://easyengine.io">rtcamp.com</a> and moved many of our <a href="https://easyengine.io/wordpress-nginx/retainer-contract/">managed-hosting </a>clients to new caching method last week. It's working really great so far but we really like you to understand risks involving a new cutting-edge feature.

We recommend, you use redis cache when you have some extra time to verify if the site is working really nice. If you face any issues, you may deactivate <a href="https://wordpress.org/plugins/redis-cache/">redis-cache object-cache</a> plugin first. This would have been added by EasyEngine for object-cache.

Going ahead we are planning to move away from W3 Total Cache for object caching. So with <code>--wpredis</code> we have changed full-page caching method and WordPress object-cache method.
<h2>Implementation Details</h2>
<h3>Cache Get/Set</h3>
We have used four nginx modules, <a href="https://github.com/openresty/srcache-nginx-module">srcache-nginx-module</a>, <a href="https://github.com/openresty/redis2-nginx-module">redis2-nginx-module</a>, <a href="http://wiki.nginx.org/HttpRedisModule">HttpRedisModule</a> and <a href="https://github.com/openresty/set-misc-nginx-module">set-misc-nginx-moduleto</a>, get everything working on nginx.

Our <a href="https://build.opensuse.org/project/monitor/home:rtCamp:EasyEngine">nginx build</a> has already been upgraded with all the required packages.  This was to avoid using a WordPress plugin to buffer entire output and write to redis cache. We always try to handle things on nginx end first.
<h3>Cache Purging</h3>
We have also updated <a href="https://wordpress.org/plugins/nginx-helper/">nginx helper</a> plugin, so it now has redis support. So now whenever you edit/publish some content, some post and pages will be purged from redis cache.
<h2>FAQ</h2>
With new redis-cache we have stopped installing W3TC. We are anticipating a few questions and thought it would be proactive to answer some in advance.
<h3>Does Redis Cache fix PageSpeed and Fastcgi Cache issue?</h3>
<a href="https://github.com/rtCamp/easyengine/issues/497">PageSpeed doesn't work nicely with fastcgi-cache as being discussed here</a>. Unfortunately, PageSpeed runs into similar problem with Redis cache module also.

Currently we have stopped using PageSpeed and W3TC internally for all our sites.
<h3>How do you manage CDN without PageSpeed or W3TC?</h3>
We use nginx subs-filter module to replace file URLs. This method works nicely for origin pull CDNs e.g. Amazon CloudFront.

You can edit a site (<code>ee site edit example.com</code> command) and a line like below to <code>server{ }</code> block.
<pre class="no-highlight">subs_filter http://example.com/wp-content/uploads http://cdn.example.com/wp-content/uploads;</pre>
Above will replace all point and all file paths to your CDN domain. Please note <code>example.com</code> is the original domain while <code>cdn.example.com</code> will be your CDN domain. Verify page output after you save changes.
<h3>What about CSS/JS minify and combine without PageSpeed or W3TC?</h3>
We are using <a href="https://wordpress.org/plugins/autoptimize/">autoptimize</a> WordPress plugin to manage css/js minification and combining for now. So far, it's working well for CSS. We really never got any plugin or even pagespeed working nicely for JS files.

Currently we are not installing this plugin as part of EasyEngine site creation process. You may add it separately.

You are free to use any other plugin or even pagespeed. But remember, pagespeed will break full-page cache.
<h3>How Redis Full Page Caching Works without WordPress/PHP?</h3>
We are using a third-party <a href="https://github.com/openresty/srcache-nginx-module">nginx module for subrequest based caching</a>.

Here is out it works in general - <a href="https://github.com/openresty/srcache-nginx-module#description">https://github.com/openresty/srcache-nginx-module#description</a>

And here is redis part - <a href="https://github.com/openresty/srcache-nginx-module#caching-with-redis">https://github.com/openresty/srcache-nginx-module#caching-with-redis</a>

The whole readme is worth reading.

This was <a href="https://github.com/rtCamp/easyengine/issues/510">on the list for a long time</a> but we did not manage to have enough time and resources to dedicate towards it. As with any new feature, it needs a lot of time in testing, tweaking and playing around before it can be made "easy".
<h2>Need Support?</h2>
If you run into any issues or have any questions, please use our <a href="http://community.rtcamp.com/">community support forum</a>.

If you are using <a href="https://easyengine.io/products/easyengine-premium-support/">EasyEngine Premium Support</a>, you can <a href="https://easyengine.io/premium-support/">create a support request</a> and let our team update EasyEngine as well as move your sites to new redis cache.

Also, if you use new redis-cache, please share your feedback.

<strong>Links:</strong> <a href="https://easyengine.io/easyengine">EasyEngine Home</a> | <a href="https://github.com/rtCamp/easyengine">Github Repo</a> | <a href="https://github.com/rtCamp/easyengine/releases/tag/v3.3.0">Release Notes</a> | <a href="http://docs.rtcamp.com/easyengine/">EasyEngine Docs</a>