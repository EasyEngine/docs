---
ID: 141937
post_title: 'Solution: Couldn&#8217;t extract WordPress archive error'
author: Siddharth Thevaril
post_excerpt: |
  Workarounds for "Error: Couldn't extract WordPress archive. unable to decompress gzipped phar archive ... to temporary file".
layout: post
permalink: >
  https://easyengine.io/blog/solution-couldnt-extract-wordpress-archive-error/
published: true
post_date: 2017-09-27 18:01:29
---
Since last few days, EasyEngine users are facing an issue creating a WordPress site on Ubuntu systems. The error thrown by WP-CLI (which EE uses internally to download WordPress Core) looks something like:
<pre>Error: Couldn't extract WordPress archive. unable to decompress gzipped phar archive "/tmp/wp_59cb76c85c61c.tar.gz" to temporary file
</pre>
<h2>Workaround</h2>
As the issue itself is not related to EasyEngine, we haven't released an update from EasyEngine.

But there are multiple workarounds to fix this on your end.
<h3>#1. Update WP-CLI to a nightly build <em>(recommended)</em></h3>
The nightly build of WP-CLI is working correctly. You can update WP-CLI using:

<code>sudo wp --allow-root cli update --nightly</code>

Now you should be able to download WordPress successfully using Easy Engine.
<h3>#2. Force WP-CLI to download WordPress 4.8.1</h3>
Please run following commands in once to create a <em><strong>config.yml</strong></em> file that will override the WP-CLI defaults.
<pre>cat &lt;&lt;EOF &gt; ~/.wp-cli/config.yml
core download:
  version: 4.8.1
EOF
</pre>
Now, you can create a WordPress site using EasyEngine commands.

It is recommended you update WordPress sites to the latest version. You can do it manually via the admin dashboard, or, you can use WP-CLI to update the site using:

<code>sudo wp core update --allow-root</code>
<h2>Reasons</h2>
One of the causes of the error was assumed to be due to faulty gzip compression of WordPress' <strong>en_US</strong> locale, which later came out to be false.

Another one was that something went possibly wrong with WP-CLI's <a href="https://github.com/wp-cli/wp-cli/blob/master/php/WP_CLI/Extractor.php#L78">Extractor class</a> which uses <code>PharData()</code> to extract the zip and, as <a href="https://github.com/wp-cli/wp-cli/pull/4371">observed</a> by Daniel Bachhuber, the error was indeed indirectly caused by PharData which had its dependency on a <a href="https://github.com/wp-cli/wp-cli/issues/4370#issuecomment-331448980">Debian PHP patch</a>.

For time being, above workarounds will get the job done. If you need further help, please use <a href="http://community.rtcamp.com/c/easyengine">EasyEngine forum</a>.