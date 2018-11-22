---
ID: 131129
post_title: sync
author: Dinesh Jain
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/docs/commands/sync/
published: true
post_date: 2015-11-23 12:25:28
---
<h2 id="available-with-easyengine-v309-and-onwards">Available with EasyEngine v3.0.9 and onwards</h2>
EasyEngine maintains a lightweight sqlite database, which needs to be synced with your sites information, in order to work EasyEngine commands perfectly.

If an user want to update database for a site, and modifies <code>wp-config.php</code> file with other database created, EasyEngine will need to update its database for maintaining correct information and making its work easier.

The following command will help user to maintain his sites information updated with EasyEngine database.
<pre><code>ee sync</code></pre>