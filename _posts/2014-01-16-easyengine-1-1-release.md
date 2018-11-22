---
ID: 55087
post_title: 'EasyEngine 1.1 Release with more automation &#038; security'
author: Rahul Bansal
post_excerpt: >
  EasyEngine 1.1 release add new features
  and most importantly introduces a
  future-proof and scalable syntax
  structure. Upgrade script is also
  created for old users.
layout: post
permalink: >
  https://easyengine.io/blog/easyengine-1-1-release/
published: true
post_date: 2014-01-16 19:10:48
---
Here comes first major update to easyengine since its launch <a href="https://easyengine.io/easyengine-easy-wordpress-nginx/">more than three months ago</a>!

Although this release took 3 months work, we hope to give regular release every month now onwards. :-)
<h2>Added in EasyEngine 1.1</h2>
<h3>New Features</h3>
<ul>
	<li>Handling redirects from "non-www to www" and vice-versa. (<a title="www and non-www handling" href="https://github.com/rtCamp/easyengine/issues/71">#71</a>)</li>
	<li>Automating mysql setup. Every site which needs a database gets a new mysql user and password automatically. mysql root is not used anymore for new sites. (<a title="More automation for system installation" href="https://github.com/rtCamp/easyengine/issues/72">#72</a>)</li>
	<li>Automated postfix installation. (<a title="More automation for system installation" href="https://github.com/rtCamp/easyengine/issues/72">#72</a>)</li>
	<li>Added "ee info" command (<a title="ee info command" href="https://github.com/rtCamp/easyengine/issues/69">#69</a>)</li>
	<li>Secured <code>/ee</code> locations (<a title="Protect EE Shared Locations" href="https://github.com/rtCamp/easyengine/issues/60">#60</a> and <a href="https://easyengine.io/tutorials/nginx/ssl-pci-compliance-performance/">https://easyengine.io/tutorials/nginx/ssl-pci-compliance-performance/</a>)</li>
	<li>SSL Session cache for nginx (<a title="SSL Session Cache" href="https://github.com/rtCamp/easyengine/issues/56">#56</a>)</li>
</ul>
<h3>Enhancements</h3>
<ul>
	<li><em>Syntax changes</em> which will help us add support for more software options in future. (<a title="Syntax Changes" href="https://github.com/rtCamp/easyengine/issues/79">#79</a>). Please check <a href="https://easyengine.io/easyengine/docs/commands/site/create/">updated documentation</a>.</li>
	<li>Smooth installation with friendly messages. (<a title="Installer tweaks" href="https://github.com/rtCamp/easyengine/issues/78">#78</a>)</li>
	<li>Subcommand help. Incomplete command/subcommand will show contextual help. (<a title="Subcommand help" href="https://github.com/rtCamp/easyengine/issues/5">#5</a>)</li>
	<li>Automatically fix <code>server_names_hash</code> issue (<a title="On default installation of nginx, the variable server_names_hash is commented which is giving this error" href="https://github.com/rtCamp/easyengine/issues/27">#27</a>)</li>
</ul>
<h2>Upgrade Instructions</h2>
If you have given EasyEngine 1.0 a try, please accept our thanks.

We have coded an upgrade script which can be run by following command:
<pre><code>/bin/bash &lt;(curl -sL https://raw.github.com/rtCamp/easyengine/stable/usr/local/sbin/eeupdate)
</code></pre>
If you face any problem during upgrade, please use our free support forum at <a href="https://easyengine.io/support/forum/wordpress-nginx/">https://easyengine.io/support/forum/wordpress-nginx/</a> . We are available to solve any upgrade issues.

For future upgrades, we have added <code>ee update</code> command to the suite.
<h2>Credits</h2>
This release is hard work of <a href="https://plus.google.com/+MiteshShah/">Mitesh Shah</a> with a lot of support from <a href="http://rtcamp.com/about/rtcampers/">rtCampers</a>.

<strong>Links:</strong> <a href="https://easyengine.io/easyengine/">EasyEngine</a> | <a href="https://easyengine.io/easyengine/docs/">Documentation</a> | <a href="https://easyengine.io/support/forum/wordpress-nginx/">Support Forum</a> | <a href="https://github.com/rtCamp/easyengine/">Github Code</a>