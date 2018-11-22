---
ID: 131076
post_title: delete
author: Dinesh Jain
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/docs/commands/site/delete/
published: true
post_date: 2015-11-23 12:13:54
---
To delete site created with EasyEngine (ee) use
<pre><code>ee site delete example.com
</code></pre>
<div data-unique="Deletewebsitewithoutprompt"></div>
<h2 id="delete-website-without-prompt">Delete website without prompt</h2>
<pre><code>ee site delete example.com --no-prompt
</code></pre>
<div data-unique="Deletewebsitewebrootonly"></div>
<h2 id="delete-website-webroot-only">Delete website webroot only</h2>
<pre><code>ee site delete example.com --files
</code></pre>
<div data-unique="Deletewebsitedatabaseonly"></div>
<h2 id="delete-website-database-only">Delete website database only</h2>
<pre><code>ee site delete example.com --db</code></pre>