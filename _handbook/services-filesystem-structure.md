---
ID: 142766
post_title: Services Filesystem Structure
author: Rahul Bansal
post_excerpt: ""
layout: handbook
permalink: >
  https://easyengine.io/handbook/global-filesystem-structure/services-filesystem-structure/
published: true
post_date: 2018-11-20 19:59:21
---
<!-- wp:paragraph -->
<p>There are some containers in EasyEngine which are used by multiple sites. These are called services. </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Configuration, logs and other files of these services can be found at <code>/opt/easyengine/services</code>.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>We have following services in EasyEngine as of now:</p>
<!-- /wp:paragraph -->

<!-- wp:list {"ordered":true} -->
<ol><li>Global MariaDB</li><li>Global Redis</li><li>Nginx Proxy</li><li>Cron Scheduler</li></ol>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p>When a site is created, by default it uses Global MariaDB and Redis, if required. Site creation command allows overriding this behavior to have a <g class="gr_ gr_110 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling ins-del multiReplace" id="110" data-gr-id="110">site specific</g>&nbsp;MariaDB and Redis containers also.&nbsp;</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Each of these services are explained below.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Global MariaDB</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Global MariaDB uses following Host directories for different purpose:</p>
<!-- /wp:paragraph -->

<!-- wp:table {"hasFixedLayout":true} -->
<table class="wp-block-table has-fixed-layout"><tbody><tr><td><strong>Purpose</strong></td><td><strong>Host Directory Path</strong></td></tr><tr><td>Config</td><td>/opt/easyengine/services/mariadb/conf/</td></tr><tr><td>Data</td><td>/opt/easyengine/services/mariadb/data/</td></tr><tr><td>Logs</td><td>/opt/easyengine/services/mariadb/logs/</td></tr></tbody></table>
<!-- /wp:table -->

<!-- wp:paragraph -->
<p><strong>Notes:</strong></p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul><li>You can add your custom config in files ending with <code>.cnf</code> extension inside the directory&nbsp;<code>/opt/easyengine/services/mariadb/conf/conf.d/</code></li><li>Please do not tamper with the MariaDB data folder manually. You must use mysql command and tools such as mysqldump for any database import, export, and even backups.</li></ul>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>Global Redis</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Global Redis uses following Host directories for different purpose:</p>
<!-- /wp:paragraph -->

<!-- wp:table {"hasFixedLayout":true} -->
<table class="wp-block-table has-fixed-layout"><tbody><tr><td><strong>Purpose</strong></td><td><strong>Host Directory Path</strong></td></tr><tr><td>Config</td><td>/opt/easyengine/services/redis/conf/</td></tr><tr><td>Data</td><td>/opt/easyengine/services/redis/data/</td></tr><tr><td>Logs</td><td>/opt/easyengine/services/redis/logs/</td></tr></tbody></table>
<!-- /wp:table -->

<!-- wp:heading -->
<h2>Nginx Proxy</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The v4 uses Nginx in two different ways. One is a plain old way of serving a site using Nginx as a web server. The other is to route traffic to different sites using Nginx as a reverse proxy. </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>You can <a href="https://easyengine.io/handbook/nginx-proxy/">read more about nginx reverse-proxy here</a>.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Cron Scheduler</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>EasyEngine is using <a href="https://github.com/mcuadros/ofelia">Ofelia</a> as a job scheduler behind the scene. Whenever you create a WordPress site and/or manipulate cron jobs using <a href="https://easyengine.io/commands/cron/">cron command</a>, EasyEngine update Ofelia config internally. </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Config for <a href="https://github.com/mcuadros/ofelia/"><g class="gr_ gr_324 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling ins-del multiReplace" id="324" data-gr-id="324">ofelia</g></a> is kept at </p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>/opt/easyengine/services/cron/config.ini</code></pre>
<!-- /wp:code -->

<!-- wp:heading -->
<h2>Related</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>You may like to read <a href="https://easyengine.io/handbook/site-filesystem-structure/">site filesystem structure</a>.</p>
<!-- /wp:paragraph -->