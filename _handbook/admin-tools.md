---
ID: 142666
post_title: Admin Tools
author: Rahul Bansal
post_excerpt: 'EasyEngine v4 has following admin-tools - opcache-gui, phpinfo, phpMyAdmin, phpRedisAdmin, MailHog, Ping, Status, Nginx Status'
layout: handbook
permalink: >
  https://easyengine.io/handbook/admin-tools/
published: true
post_date: 2018-11-20 12:22:36
---
<!-- wp:paragraph -->
<p>In EasyEngine v4, we have support for following tools to help site administrators.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>These admin-tools needs to be enabled/disabled per site. By default they are disabled.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Usage</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>In order to use the admin-tools, you must first enable them using</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>ee admin-tools enable example.com</code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p>By default, we enable auth on admin-tools. To view username/password with which you can login, run</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>ee auth list global</code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p>Then navigate <g class="gr_ gr_24 gr-alert gr_gramm gr_inline_cards gr_run_anim Style multiReplace" id="24" data-gr-id="24">to </g><code>example.com/ee-admin/</code><g class="gr_ gr_24 gr-alert gr_gramm gr_inline_cards gr_disable_anim_appear Style multiReplace" id="24" data-gr-id="24"> in</g> the browser. There you'll see a list of admin-tools.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>List Of Admin Tools</h2>
<!-- /wp:heading -->

<!-- wp:table -->
<table class="wp-block-table"><tbody><tr><td><strong>Admin Tools</strong></td><td><strong>Purpose</strong></td><td><strong>URL</strong></td></tr><tr><td><a href="https://github.com/amnuts/opcache-gui">opcache-gui</a></td><td>visualize PHP <g class="gr_ gr_22 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling ins-del multiReplace" id="22" data-gr-id="22">zend</g> <a class="" href="http://php.net/manual/en/intro.opcache.php">opcache</a> stats</td><td>example.com/ee-admin/opcache-gui.php</td></tr><tr><td>phpinfo</td><td>A file with just <code>&lt;?php phpinfo() ?></code> in it </td><td>example.com/ee-admin/phpinfo.php</td></tr><tr><td><a href="https://www.phpmyadmin.net/">phpMyAdmin</a>﻿</td><td>Check "Database Access for PhpMyAdmin" section below for login details<br> </td><td>example.com/ee-admin/pma</td></tr><tr><td><a href="https://github.com/erikdubbelboer/phpRedisAdmin">phpRedisAdmin</a></td><td>Web interface for Redis cache</td><td>example.com/ee-admin/pra</td></tr><tr><td><a href="https://easyengine.io/handbook/mailhog/">MailHog</a></td><td>Catches &amp; displays email from your app in Web GUI</td><td>example.com/ee-admin/mailhog</td></tr><tr><td>php-fpm ping</td><td>a response of "pong" on this URL means your site's PHP is working fine</td><td>example.com/ee-admin/ping</td></tr><tr><td><a href="https://easyengine.io/tutorials/php/fpm-status-page/">php-fpm status</a></td><td>displays php fpm pool status </td><td>example.com/ee-admin/status</td></tr><tr><td><a href="https://easyengine.io/tutorials/nginx/status-page/">nginx status</a></td><td>displays nginx status </td><td>example.com/ee-admin/nginx_status.</td></tr></tbody></table>
<!-- /wp:table -->

<!-- wp:heading {"level":3} -->
<h3>Database Access for PhpMyAdmin </h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>You can find database access  credentials for <code>example.com</code> by running:</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>$ ee site info example.com

+--------------------+--------------------------------+
| Site               | https://example.com            |
+--------------------+--------------------------------+
| Access admin-tools | https://example.com/ee-admin/  |
+--------------------+--------------------------------+
| Site Title         | example.com                    |
+--------------------+--------------------------------+
| WordPress Username | example.com-K8FzH              |
+--------------------+--------------------------------+
| WordPress Password | q27eGm5pYRe2                   |
+--------------------+--------------------------------+
| DB Host            | global-db                      |
+--------------------+--------------------------------+
| DB Name            | example_com                    |
+--------------------+--------------------------------+
| DB User            | example.com-c1O1a7             |
+--------------------+--------------------------------+
| DB Password        | dg5T9GNhr4Ah                   |
+--------------------+--------------------------------+
| E-Mail             | admin@example.com              |
+--------------------+--------------------------------+
| SSL                | Enabled                        |
+--------------------+--------------------------------+
| SSL Wildcard       | No                             |
+--------------------+--------------------------------+
| Cache              | None                           |
+--------------------+--------------------------------+</code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p>So in this case:<br></p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul><li>Server would be <code>global-db</code>.</li><li>Username would be <code>example.com-c1O1a7</code>.</li><li>Password would be <code>dg5T9GNhr4Ah</code>.</li></ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p>You can access phpMyAdmin at <code>example.com/ee-admin/pma</code></p>
<!-- /wp:paragraph -->