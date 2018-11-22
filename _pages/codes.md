---
ID: 131149
post_title: Developer Documentation
author: Dinesh Jain
post_excerpt: ""
layout: page
permalink: https://easyengine.io/docs/dev/codes/
published: true
post_date: 2015-11-23 12:33:24
---
<h2 id="easyengine-directory-structure">EasyEngine Directory structure</h2>
This page outlines the directory structure of the EasyEngine source. This page does not contain Documentation for whole directories but enlists important that should be considered.

<strong>config/</strong> - files for main application configuration and directory with configuration files for plugins
<pre><code>config
|-- bash_completion.d
|-- ee.conf
`-- plugins.d
</code></pre>
<strong>ee/</strong> - This is the core directory of the application
<pre><code>ee
|-- cli
|   |-- controllers
|   |-- ext
|   |-- plugins
|   `-- templates
|-- core
`-- utils
</code></pre>
<strong>docs/</strong> - contains manpages files for the easyengine commands.

<strong>tests/</strong> - testcases written for core and cli part of the application.
<pre><code>tests
|-- cli
|   |-- ext
|   |-- plugins
`-- core</code></pre>