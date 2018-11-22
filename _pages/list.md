---
ID: 131093
post_title: list
author: Dinesh Jain
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/docs/commands/site/list/
published: true
post_date: 2015-11-23 12:18:08
---
<h2 id="list-all-available-websites">List all available websites:</h2>
<pre><code>ee site list
</code></pre>
NOTE: above command run the ls <code>/etc/nginx/sites-enabled/</code>
<div data-unique="Listenabledwebsites:"></div>
<h2 id="list-enabled-websites">List enabled websites:</h2>
<pre><code>ee site list --enabled
</code></pre>
<div data-unique="Listdisabledwebsites:"></div>
<h2 id="list-disabled-websites">List disabled websites:</h2>
<pre><code>ee site list --disabled
</code></pre>
NOTE: above command run the ls <code>/etc/nginx/sites-available/</code>