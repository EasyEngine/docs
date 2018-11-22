---
ID: 142681
post_title: Site Filesystem Structure
author: Rahul Bansal
post_excerpt: ""
layout: handbook
permalink: >
  https://easyengine.io/handbook/global-filesystem-structure/site-filesystem-structure/
published: true
post_date: 2018-11-20 14:14:44
---
<!-- wp:paragraph -->
<p>All sites will be created in <code>/opt/easyengine/sites/</code> by default.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>For a site like <code>example.com</code>, the site's root folder will be <code>/opt/easyengine/sites/example.com</code></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Here's how your a site's structure will look like if it's a PHP or WordPress site. HTML site won't have php and postfix directories anywhere in them.</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>.
├── app 
│   ├── htdocs
│   └── wp-config.php
├── config
│   ├── nginx
│   ├── php
│   └── postfix
├── docker-compose-admin.yml
├── docker-compose.yml
├── logs
│   ├── nginx
│   └── php
└── services
    └── postfix</code></pre>
<!-- /wp:code -->

<!-- wp:heading -->
<h2>Source Code</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Source code of your site is stored in <code>/opt/easyengine/sites/example.com/app/htdocs</code>.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>In case of  WordPress site, the&nbsp;<code>wp-config.php</code>&nbsp;file  placed in <code>app</code>&nbsp;folder at <code>/opt/easyengine/sites/example.com/app/wp-config.php</code> for <a href="https://wordpress.stackexchange.com/a/74972/135772">security reasons</a>.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Configuration</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>All config of a site is stored in <code>/opt/easyengine/sites/example.com/config/</code></p>
<!-- /wp:paragraph -->

<!-- wp:table {"className":"is-style-regular"} -->
<table class="wp-block-table is-style-regular"><tbody><tr><td><strong>Config Type</strong></td><td><strong>Path on host</strong></td></tr><tr><td>Nginx config</td><td>/opt/easyengine/sites/example.com/config/nginx/</td></tr><tr><td>Nginx custom config</td><td>/opt/easyengine/sites/example.com/config/nginx/custom/</td></tr><tr><td>PHP config</td><td>/opt/easyengine/sites/example.com/config/php/php/</td></tr><tr><td>PHP-FPM config</td><td>/opt/easyengine/sites/example.com/config/php/php-fpm.d/<br></td></tr><tr><td>Postfix config</td><td>/opt/easyengine/sites/example.com/config/postfix/</td></tr></tbody></table>
<!-- /wp:table -->

<!-- wp:heading -->
<h2>Logs</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>All logs related to a site are stored in <code>/opt/easyengine/sites/example.com/logs/</code></p>
<!-- /wp:paragraph -->

<!-- wp:table {"className":"is-style-regular"} -->
<table class="wp-block-table is-style-regular"><tbody><tr><td><strong>Log Type</strong></td><td><strong>Path on host</strong></td></tr><tr><td>Nginx </td><td>/opt/easyengine/sites/example.com/logs/nginx/</td></tr><tr><td>PHP</td><td>/opt/easyengine/sites/example.com/logs/php/</td></tr></tbody></table>
<!-- /wp:table -->

<!-- wp:heading -->
<h2>Docker Compose</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>You may notice two more files - <code>docker-compose.yml</code> and <code>docker-compose-admin.yml</code>. This files are used by Docker to configure software stack for the site and that site's <a href="https://easyengine.io/handbook/admin-tools/">admin-tools</a> respectively.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>If you are familiar with the Docker, you can use these files to modify software stack used by a site among other things.</p>
<!-- /wp:paragraph -->