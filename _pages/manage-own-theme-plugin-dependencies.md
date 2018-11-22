---
ID: 111591
post_title: >
  Using Composer to Manage Own
  Theme/Plugin Dependencies (for
  developers)
author: Rahul Bansal
post_excerpt: >
  Using composer to manage WordPress Theme
  and Plugin project dependencies in
  development and production environment
layout: page
permalink: >
  https://easyengine.io/tutorials/composer-wordpress/manage-own-theme-plugin-dependencies/
published: true
post_date: 2015-07-12 19:44:04
---
As you may already know, WordPress doesn't support composer so our themes/plugins distributed as zip files won't benefit from any composer magic.

But we can surely use composer in our development environment to manage development dependency and with some extra steps also manage production dependencies.
<h2>Using composer.json to manage development dependency</h2>
Following is part of snippet from example presented in last chapter:
<pre class="javascript">    "require-dev": {
        "wpreadme2markdown/wpreadme2markdown": "*"
    }
</pre>
In above example, we have declared development dependency for <a href="https://github.com/benbalter/WP-Readme-to-Github-Markdown">WP-Readme-to-Github-Markdown</a> project.

This is a simple script we run to convert readme.txt file to readme.md file i.e. from WordPress style readme to Github style readme. As Github readme is not required for WordPress projects, we don't need this script in wordpress.org zip distribution.

Composer by default installs dev dependency. So when you have require-dev section defined, in production, pass <code>--no-dev</code> flag to composer install/update commands.

You can define any other packages e.g. libraries, additional tools/scripts needed during development environment.
<h2>Using composer.json to manage production dependency</h2>
Even though WordPress doesn't support composer, you can also manage production dependencies using composer.

Let's have a look at an example from famous WordPress-SEO plugin's <code>composer.json</code> file:
<pre class="javascript">"require": {
    "composer/installers": "~1.0",
    "yoast/license-manager": "^1.2",
    "yoast/i18n-module": "^1.0",
    "xrstf/composer-php52": "^1.0.17"
},</pre>
As you can see wordpress-seo plugin declares some production dependencies. As these are standard composer packages, they will go into <code>vendor</code> directory.  On <a href="https://github.com/Yoast/wordpress-seo">github repo</a>, you will see vendor directory is missing. But it's present on <a href="http://plugins.svn.wordpress.org/wordpress-seo/trunk/vendor/">SVN repo</a>.
<h3>Build Stage/Script</h3>
If you have used grunt/bower/SASS like tools, you may be aware of a build stage where we do some extra processing before we can release code for production usage.

When managing dependencies via composer, we need to add a build stage where before exporting git repo as a zip module, we will run <code>composer install</code>. You can of courser, automate your build process using a script. Currently we do not have a standard build script, but we hope to publish one soon.

You may <a href="https://easyengine.io/subscribe/">subscribe to our newsletter for updates</a>.