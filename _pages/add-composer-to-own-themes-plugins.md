---
ID: 111533
post_title: >
  Adding Composer Support to Your Own
  Themes and Plugins (for developers)
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/composer-wordpress/add-composer-to-own-themes-plugins/
published: true
post_date: 2015-07-12 19:08:26
---
In <a href="https://easyengine.io/tutorials/composer/manage-wordpress-plugin-theme-updates/">last chapter</a>, we saw <a href="https://easyengine.io/tutorials/composer/manage-wordpress-plugin-theme-updates/#note-for-themeplugin-developers">a reason</a> to add <code>composer.json</code> support to your own WordPress themes and plugins. We will see how to do that now.

<em><strong>Note:</strong> <code>composer.json</code> in this chapter refers to file in root directory of your theme and plugin repo, and NOT file with same name in WordPress document root (<code>htdocs</code> / <code>public_html</code>) directory.</em>
<h2>Adding Composer Support</h2>
Let's start with an example file as below:
<pre class="javascript">{
    "name": "org-name/project-name",
    "type": "wordpress-plugin",
    "require": {
        "composer/installers": "^1.0"
    }
}</pre>
Above is bare minimum information needed for a plugin repo.

A detailed version looks like:
<pre class="javascript">{
    "name": "rtcamp/nginx-helper",
    "description": "Cleans nginx's fastcgi/proxy cache or redis-cahce whenever a post is edited/published. Also does few more things.",
    "keywords": ["wordpress", "plugin", "nginx", "nginx-helper", "fastcgi", "redis-cahce", "redis", "cache"],
    "homepage": "https://easyengine.io/nginx-helper/",
    "license": "GPL-2.0+",
    "authors": [{
        "name": "rtCamp",
        "email": "support@rtcamp.com",
        "homepage": "https://easyengine.io"
    }],
    "minimum-stability": "dev",
    "prefer-stable": true,
    "type": "wordpress-plugin",
    "support": {
		"issues": "https://github.com/rtCamp/nginx-helper/issues",
		"forum": "https://wordpress.org/support/plugin/nginx-helper",
		"wiki": "https://github.com/rtCamp/nginx-helper/wiki",
		"source": "https://github.com/rtCamp/nginx-helper/"
	},
    "require": {
        "php": "&gt;=5.3.2",
        "composer/installers": "^1.0"
    },
    "require-dev": {
        "wpreadme2markdown/wpreadme2markdown": "*"
    }
}
</pre>
Meaning of every <code>composer.json</code> field is <a href="https://getcomposer.org/doc/04-schema.md">explained in details in composer documentation</a>.

From WordPress perspective only field important is <code>type</code> field. It can take three values for WordPress projects:
<ol>
	<li>wordpress-theme</li>
	<li>wordpress-plugin</li>
	<li>wordpress-muplugin</li>
</ol>
While type field itself is part of composer core, support for above is added via <a href="https://github.com/composer/installers">composer-installers</a> package from version 1.0.6.

composer-installers itself is a composer plugin which is needed for WordPress themes and plugins. It's purpose is to tell composer to download WordPress packages to <code>wp-content</code> subdirectories rather than default <code>vendor</code> directory. Hence we need to declare it as a dependency for our theme/plugin project under <code>require</code> section.
<h2>Distributing as Composer Package</h2>
Once you add composer.json to your git repo, it will turn your into a composer package.

But in order to use your package, a WordPress project's composer.json still need to define a new composer repository for your project. Something like:
<pre class="javascript">"repositories": [
    {
        "type": "vcs",
        "url": "git@github.com:rtCamp/nginx-helper.git"
    }
],</pre>
But you can make life easy for others by distributing your composer packages via <a href="https://packagist.org/">packagist.org</a>. That way other simply need to add one line:
<pre class="javascript">"require": {
    "rtcamp/nginx-helper":"^1.9"
},</pre>
<em><strong>Note:</strong> require section would have needed even when defining VCS repository.</em>

Adding packages to <a href="http://packagist.org/">packagist.org</a> is very easy so we are not covering it here in details.
<h4>Duplicate package on packagist.org as well as wpackagist.org</h4>
As you may have noticed above, nginx-helper is available via both - official composer repo as well as wpackagist repo. Which one gets picked will be depend on what namespace you use.

Example:
<ol>
	<li><strong>rtcamp/nginx-helper</strong> - will fetch package from packagist.org (in this case rtcamp/nginx-helper exists as composer package also)</li>
	<li><strong>wpackagist-plugin/nginx-helper</strong> - will fetch package from wpackagist.org</li>
</ol>
Please do not use both. It may create issues.