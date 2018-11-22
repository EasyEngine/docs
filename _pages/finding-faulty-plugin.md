---
ID: 141289
post_title: Finding a faulty plugin
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/wpcli/finding-faulty-plugin/
published: true
post_date: 2016-10-09 15:23:50
---
<h2>Issue</h2>
A WordPress site with 50+ active plugin was breaking WP-CLI.

All `wp` commands were returning empty.
<h2>Solution</h2>
As many plugins were not standard, we tried skipping all plugins first.

<code>wp --skip-plugins post list</code>

Above worked! ?

<strong>Next...</strong>

We need to skip each plugin one-by-one and till we find a faulty plugin.

Rather than doing manual work, a little bash for loop helps us automate entire thing.
<pre class="no-highlight">for plugin in `wp --skip-plugins plugin list --status=active --field=name`; do
   echo "Test :: wp --skip-plugins=$plugin post list"
   wp --skip-plugins=$plugin post list
done</pre>
When faulty plugin skipped, `wp post list` returned expected output!

As long as some other plugin was getting skipped, we saw empty response.

You may use a loop like above with other wp-cli command or your test-scripts.

<strong>TODO: </strong>
<ol>
 	<li>Add a codeception example</li>
 	<li>Add a phpunit example</li>
</ol>