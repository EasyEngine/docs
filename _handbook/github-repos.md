---
ID: 142674
post_title: List of Github Repos
author: Rahul Bansal
post_excerpt: ""
layout: handbook
permalink: >
  https://easyengine.io/handbook/internal/github-repos/
published: true
post_date: 2018-11-20 20:19:08
---
<!-- wp:paragraph -->
<p>The main repository for EasyEngine is at <a href="https://github.com/EasyEngine/easyengine">easyengine/easyengine</a>. It contains CLI framework for EasyEngine and other helpful functions and utilities that other packages or commands can use.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Command Repos</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Individual commands of EasyEngine v4 have their own repository. Here is a list of them:</p>
<!-- /wp:paragraph -->

<!-- wp:table -->
<table class="wp-block-table"><thead><tr><th>Repository </th><th>Descripton</th></tr></thead><tbody><tr><td><a href="https://github.com/EasyEngine/site-command">easyengine/site-command</a> </td><td>Used to manage sites</td></tr><tr><td><a href="https://github.com/EasyEngine/cron-command">easyengine/cron-command</a> </td><td>Used to manage cron jobs</td></tr><tr><td><a href="https://github.com/EasyEngine/shell-command">easyengine/shell-command</a> </td><td>Used to access a container easily for any site</td></tr><tr><td><a href="https://github.com/EasyEngine/service-command">easyengine/service-command</a> </td><td>Used to manage global services such as nginx reverse proxy</td></tr><tr><td><a href="https://github.com/EasyEngine/mailhog-command">easyengine/mailhog-command</a> </td><td>Enable/disable mailhog on a site</td></tr><tr><td><a href="https://github.com/EasyEngine/config-command">easyengine/config-command</a>   </td><td>Manage EasyEngine's own config file</td></tr><tr><td><a href="https://github.com/EasyEngine/admin-tools-command">easyengine/admin-tools-command</a> </td><td>Enable/disable admin-tools on a site</td></tr><tr><td><a href="https://github.com/EasyEngine/site-command">easyengine/auth-command</a> </td><td>Mange  authentication using HTTP Auth and IP whitelist</td></tr></tbody></table>
<!-- /wp:table -->

<!-- wp:heading -->
<h2>Site Types Repo</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Since we plan to support a lot many site types in future - there are separate repos for each "site types". They extend site-command and have logic to create a particular type of site:</p>
<!-- /wp:paragraph -->

<!-- wp:table -->
<table class="wp-block-table"><thead><tr><th>Repository </th><th>Descripton</th></tr></thead><tbody><tr><td><a href="https://github.com/EasyEngine/site-command">easyengine/site-command</a> </td><td>Manages plain &amp; simple, default HTML site type</td></tr><tr><td><a href="https://github.com/EasyEngine/site-type-php">easyengine/site-type-php</a> </td><td>Contains logic to manage PHP site</td></tr><tr><td><a href="https://github.com/EasyEngine/site-type-wp">easyengine/site-type-wp</a> </td><td>Contains logic to manage WordPress site</td></tr></tbody></table>
<!-- /wp:table -->

<!-- wp:paragraph -->
<p><strong>Note:</strong> Site-command has the logic to manage default site type as it's the default site type. When you don't pass any type to <code>ee site create</code>, it creates a HTML site. </p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Other Repos</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Here are other repos used by EasyEngine team:</p>
<!-- /wp:paragraph -->

<!-- wp:table -->
<table class="wp-block-table"><thead><tr><th>Repository </th><th>Descripton</th></tr></thead><tbody><tr><td><a href="https://github.com/EasyEngine/dockerfiles">easyengine/dockerfiles</a> </td><td>Contains all the Dockerfiles used in EasyEngine</td></tr><tr><td><a href="https://github.com/EasyEngine/easyengine-builds">easyengine/easyengine-builds</a> </td><td>Contains build artifacts of EasyEngine. Stable and nightly phars are kept here</td></tr><tr><td><a href="https://github.com/EasyEngine/installer">easyengine/installer</a> </td><td>Contains the installer scripts for EasyEngine</td></tr><tr><td><a href="https://github.com/EasyEngine/handbook">easyengine/docs</a> </td><td>v4 Documentation in Git and Github format</td></tr></tbody></table>
<!-- /wp:table -->