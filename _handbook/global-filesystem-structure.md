---
ID: 142673
post_title: Global Filesystem Structure
author: Rahul Bansal
post_excerpt: ""
layout: handbook
permalink: >
  https://easyengine.io/handbook/global-filesystem-structure/
published: true
post_date: 2018-11-20 12:20:00
---
<!-- wp:heading -->
<h2>Top Level Directory</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>All files created by EasyEngine are stored:</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Linux</h3>
<!-- /wp:heading -->

<!-- wp:code -->
<pre class="wp-block-code"><code>/opt/easyengine﻿</code></pre>
<!-- /wp:code -->

<!-- wp:heading {"level":3} -->
<h3>Mac</h3>
<!-- /wp:heading -->

<!-- wp:code -->
<pre class="wp-block-code"><code>~/easyengine</code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p>All config, files, data, logs created by EasyEngine are stored within these folders only.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Sub Folders</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Under top-level Easyengine directory, there are following folders for different purpose.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Sites</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p> EasyEngine stores all sites data in <code>/opt/easyengine/sites</code>. </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Everything related to a <code>example.com</code> site such as it's source code, database, configuration, and logs are stored <g class="gr_ gr_29 gr-alert gr_gramm gr_inline_cards gr_run_anim Style multiReplace" id="29" data-gr-id="29">in&nbsp;</g><code>/opt/easyengine/sites/example.com</code><g class="gr_ gr_29 gr-alert gr_gramm gr_inline_cards gr_disable_anim_appear Style multiReplace" id="29" data-gr-id="29">.</g></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Please check the documentation on <a href="https://easyengine.io/handbook/global-filesystem-structure/site-filesystem-structure/">a site's filesystem structure</a> to know more about individual site's files.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Services</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>There are some containers in EasyEngine which are used by multiple sites. These are called services.&nbsp;</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Configuration, logs and other files of these services can be found at&nbsp;<code>/opt/easyengine/services</code>.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Please check the documentation on&nbsp;<a href="https://easyengine.io/handbook/services-filesystem-structure/">service filesystem structure</a>&nbsp;to know more about individual service.<br></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Admin Tools</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Admin tools of EasyEngine are mostly PHP based and kept at <code>/opt/easyengine/admin-tools</code>. This directory is created and admin tools are downloaded when you <a href="https://github.com/EasyEngine/docs/blob/master/commands/admin-tools/enable.md#ee-admin-tools-enable">enable admin-tools</a> on a site for first time.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>When you enable admin-tools on a site, this directory, <code>/opt/easyengine/admin-tools</code>, gets mounted in <code>htdocs/ee-admin</code> in the container.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>You can read more about <a href="https://easyengine.io/handbook/admin-tools/">admin-tools</a> here.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>EasyEngine Database</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>EasyEngine uses an sqlite database to store data related to sites, cron jobs, options and few more things.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>The database is located at <code>/opt/easyengine/db/ee.sqlite</code></p>
<!-- /wp:paragraph -->