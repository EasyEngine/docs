---
ID: 111545
post_title: >
  Updating Themes and Plugins (for entire
  WordPress site)
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/composer-wordpress/update-themes-plugins/
published: true
post_date: 2015-07-12 18:11:52
---
In last chapter, we saw <a href="https://easyengine.io/tutorials/composer/manage-wordpress-themes-plugins-composer-json/">how to add theme and plugin dependencies to WordPress project using composer</a>.

Like WordPress core, many themes and plugin releases updates from time to time. So we need to keep our <code>composer.json</code> updated.

Fortunately, composer allows us to specify versions in many ways, which will avoid need to edit composer.json file after certain updates. You can read this <a href="https://getcomposer.org/doc/articles/versions.md">composer version guide</a> for details.

Here, we will see managing versions with an example.
<h2>Problem (with example)</h2>
Following is a sample code for nginx-helper plugin version 1.9.3.
<pre class="javascript">    "require": {
        "wpackagist-plugin/nginx-helper": "1.9.3"
    }</pre>
In above example, we are using specific version. This means when 1.9.4 or any other update comes, we will need to edit composer.json again and again.

Just imaging doing for 50+ plugins many WordPress projects have!
<h2>Workaround</h2>
We can specify range as well as use wildcard <code>"*"</code> which will fetch latest version. But using wildcard is not recommended as we can end up upgrading to a version which is not backward compatible, thus braking our site.

When adding packages using <code>composer require</code> command line version, you may omit version number and composer will pick latest version with patch-level update support.

During manual edit to composer.json, instead of <code>1.9.3</code>, we can use <code>^1.9</code> which will give us update till 2.0, which are unlikely to break.

If WordPress theme/plugins are following <a href="http://semver.org/">semantic versioning</a>, specifying version names this way can worj out really nice.
<h2>composer.lock and versions</h2>
Although, range/wildcard versions can remove need to edit composer.json file again and again, we need to update <code>composer.lock</code> file by running <code>composer update</code>.

Continuing with above example, say composer downloads nginx-helper plugin version 1.9.3, which is latest at the time of writing this post, it will put that version information in <code>composer.lock</code> file.

So when version 1.9.4 releases, on a new (remote/production) server, composer install will download 1.9.3 - a version specified in <code>composer.lock</code> file.

We need to run composer update first, which shall update <code>composer.lock</code> and then git commit/push update composer.lock file to remoter server. After that running composer install will fetch 1.9.4 as expected.

The entire workflow looks like this:
<ol>
	<li>Updates are available</li>
	<li>Run <code>composer update</code> locally or on dev/staging server. This will update <code>composer.lock</code> and download updates locally.</li>
	<li>Test - usually this can be automated using CI (continuous integration) tools.</li>
	<li>If test pass, git commit/push changes to <code>composer.lock</code></li>
	<li>On remote server (e.g. production), changes to <code>composer.lock</code> will be pulled followed by composer install. This is usually automated using git + webhooks.</li>
</ol>
The entire process can be automated if you have a robust test coverage for your WordPress project.
<h2>Note for theme/plugin developers</h2>
If you are using your own WordPress theme and plugins published on wordpress.org for a client project, and if you need to do a public release, you may notice that new version is not readily available on <a href="http://wpackagist.org/">wpackagist.org</a> which syncs hourly!

So you may wait for an hour to run <code>composer update</code> which can get frustrating. In this case, it's better to add your own theme and plugins to composer project using <a href="https://easyengine.io/tutorials/composer/manage-wordpress-themes-plugins-composer-json/#themeplugin-under-version-control--with-composer-s">VCS repository method</a>.

As a developer, you can consider adding <code>composer.json</code> file to your own project. We will describe this in detail in next chapter.