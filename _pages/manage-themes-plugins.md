---
ID: 111556
post_title: >
  Managing Themes and Plugins (for entire
  WordPress site)
author: Rahul Bansal
post_excerpt: >
  Using composer to define themes and
  plugin needed for a WordPress site.
  Covers wordpress.org hosted,
  git/svn-hosted, public and
  private/premium zip files.
layout: page
permalink: >
  https://easyengine.io/tutorials/composer-wordpress/manage-themes-plugins/
published: true
post_date: 2015-07-11 23:01:03
---
As our basic <a href="https://easyengine.io/tutorials/composer/wordpress-file-system-layout/">composer project is ready with desired version of WordPress</a>, we can proceed to add themes and plugin to our project.

As WordPress ecosystem has tons of free and paid themes/plugins from different sources, we need to follow few different methods to handle them. We will see them one-by-one.
<h2>Managing WordPress.org hosted themes and plugins</h2>
Composer makes it easy to use anything as dependency, even if target library/repo is not a composer package!

This involves fair amount of work, as we will see later in this chapter alone. But thanks to <a href="http://wpackagist.org/">wpackagist.org</a> - a composer package repository created  by fine folks at <a href="http://outlandish.com/">Outlandish</a>, working with WordPress.org hosted themes and plugins becomes cakewalk!

<a href="http://wpackagist.org/">wpackagist.org</a> homepage explains usage in nice details but we will try to over-simplify things for composer newbies here by breaking process in two steps.
<h3>Adding wpackagist.org repository to composer.json</h3>
Composer by default only looks for packages hosted on <a href="https://packagist.org/">packagist.org</a>. So first thing we need to tell composer is to look for WordPress themes and plugins at <a href="http://wpackagist.org/">wpackagist.org</a>. This can be done by adding following lines to <code>composer.json</code> file:
<pre class="javascript"> "repositories":[
        {
            "type":"composer",
            "url":"https://wpackagist.org"
        }
    ],</pre>
You can add above lines automatically by running command <code>composer config repositories.0 composer https://wpackagist.org/</code> So <code>composer.json</code> file will look like:
<pre class="javascript">{
    "name": "rtcamp/wordpress-composer-template",
    "description": "Using Composer to manage complete WordPress Project",
    "license": "MIT",
    "repositories": [
        {
            "type": "composer",
            "url": "https://wpackagist.org"
        }
    ],
    "require": {
        "johnpbloch/wordpress": "4.2.2",
    }
}</pre>
<h3>Adding actual wordpress.org themes and plugins</h3>
Each wordpress theme and plugin has a unique slug. You can use that slug to search theme/plugin on <a href="http://wpackagist.org/">wpackagist.org</a>.  wpackagist.org will show you a result page with versions available trough composer. You can click on a version and composer will give one-line statements like:
<ul>
 	<li><code>"wpackagist-plugin/nginx-helper": "1.9.3"</code> - for <a href="https://wordpress.org/plugins/nginx-helper/">nginx-helper</a> plugin</li>
 	<li><code>"wpackagist-theme/twentyfifteen": "1.2"</code> - for <a href="https://wordpress.org/themes/twentyfifteen/">twentyfifteen</a> theme</li>
</ul>
You can copy code blocks to require section in composer.json like below:
<pre class="javascript">{
    "name": "rtcamp/wordpress-composer-template",
    "description": "Using Composer to manage complete WordPress Project",
    "license": "MIT",
    "repositories": [
        {
            "type": "composer",
            "url": "https://wpackagist.org"
        }
    ],
    "require": {
        "johnpbloch/wordpress": "4.2.2",
        "wpackagist-theme/twentyfifteen": "1.2",
        "wpackagist-plugin/nginx-helper": "1.9.3"
    }
}</pre>
Once <code>composer.json</code> file is updated, you can run composer install/update to download dependencies. <strong>Command Line Way</strong> Alternatively, you can run following composer command to add dependency without opening composer.json file

<code>composer require wpackagist-theme/twentyfifteen:1.2 wpackagist-plugin/nginx-helper:1.9.3</code>

Please note that composer require will update <code>composer.json</code> and also download packages right away.  If you want to prevent automatic downloading of dependencies, you can pass flag <code>--no-update</code> to above command.
<h2>Managing non-WordPress.org themes and plugins</h2>
Unlike above, this is very broad. Mainly we need to deal with:
<ol>
 	<li>Theme/Plugin published as composer package via <a href="https://packagist.org/">packagist.org</a></li>
 	<li>Theme/Plugin under version control - <strong>with</strong> composer support</li>
 	<li>Theme/Plugin under version control - <strong>without</strong> composer support</li>
 	<li>Theme/Plugin <strong>without</strong> version control e.g. zip file</li>
</ol>
Let's deal with each of above with an example.
<h3>Theme/Plugin published as composer package via <a href="https://packagist.org/">packagist.org</a></h3>
As an example, let's use <a href="https://github.com/afragen/github-updater">github-updater</a> WordPress plugin which is <a href="https://github.com/afragen/github-updater/issues/34">not allowed</a> on wordpress.org repo but available as composer package at - <a href="https://packagist.org/packages/afragen/github-updater">https://packagist.org/packages/afragen/github-updater</a> You can add a line like below to composer.json file's require section and it will work just fine

<code>"afragen/github-updater": "^4.6"</code>

Or can run composer command <code>composer require afragen/github-updater</code>

Above works so easily because github-updater is composer package. Things will not be easy for remaining cases!
<h3>Theme/Plugin under version control - with composer support</h3>
There could be a case that a project is neither hosted on wordpress.org or in some composer repo <em>but</em> still has composer.json in it.

As an example consider this plugin - <a href="https://github.com/rtCamp/rtAntiSpam">https://github.com/rtCamp/rtAntiSpam</a> we use on our sites but did not release it on wordpress.org! This plugin has a <a href="https://github.com/rtCamp/rtAntiSpam/blob/master/composer.json">composer.json file</a> you may like to have a look at.

To install such theme/plugin, we need to perform two steps:

<strong>Add version control project as a new composer repository (like wpackagist.org)</strong>

We can do that by adding following to composer.json file:
<pre class="javascript">    "repositories": [
        {
            "type": "composer",
            "url": "https://wpackagist.org/"
        },
        {
            "type": "vcs",
            "url": "git@github.com:rtCamp/rtAntiSpam.git"
        }
    ],</pre>
Please note that repo type is<code>vcs</code> (or we can use git). For wpackagist.org it was<code>composer</code> since wpackagist.org is a composer repository.

Above can be done via command line as well:

<code>composer config repositories.rtantispam vcs git@github.com:rtCamp/rtAntiSpam.git</code>

Adding repos via command updates composer.json file in slight different way:
<pre class="javascript">    "repositories": {
        "0": {
            "type": "composer",
            "url": "https://wpackagist.org/"
        },
        "rtantispam": {
            "type": "vcs",
            "url": "git@github.com:rtCamp/rtAntiSpam.git"
        }
    },</pre>
The difference really don't matter so ignore it if it's not making sense.

<strong>Add actual composer package</strong>

Once we add our git repo, we can add it as a package like below.
<pre class="javascript">    "require": {
        "rtcamp/rtantispam": "dev-master"
    }</pre>
<code>dev-master</code> will point to git's master branch. This is really bad practise but we are explaining it this way because many developers (including us) do not use git tags for internal projects. :|

For command-line interface, we can achieve above by running:

<code>composer require rtcamp/rtantispam:dev-master</code>

If you have taken look at <a href="https://github.com/rtCamp/rtAntiSpam/blob/master/composer.json">composer.json for rtAntiSpam plugin</a>, you may notice it has package name equal to <code>rtcamp/rtantispam</code>.

We need to match package name with <code>composer.json</code>.

Please note that <code>composer.json</code> in your project is different than composer.json in other project.
<h3>Theme/Plugin under version control - without composer support</h3>
Composer allow you to dynamically include any version controlled repo as a package, even if destination doesn't contain <code>composer.json</code> file!

As an example, we will use a <a href="https://github.com/digitalmedia/rollbar">https://github.com/digitalmedia/rollbar</a> plugin which is neither hosted on wordpress.org, nor has composer.json.

Again this will need two steps.

<strong>Add version control project as a new composer repository</strong>
<pre class="javascript">{
    "type": "package",
    "package": {
        "name": "digitalmedia/rollbar",
        "type": "wordpress-plugin",
        "version": "dev-master",
        "source": {
            "type": "git",
            "url": "git@github.com:digitalmedia/rollbar.git",
            "reference": "master"
        }
    }
}
</pre>
If you have taken look at <a href="https://github.com/rtCamp/rtAntiSpam/blob/master/composer.json">composer.json for rtAntiSpam</a> then some fields like <code>name</code> and <code>type</code> are similar.

You may notice repo type is now <strong>package</strong>, earlier it was <strong>vcs</strong> and before that it was <strong>composer</strong>. So when a target repo is not a composer package, we can declare it as a package on our own end by adding it to repositories list.

To avoid confusion and clear context, below is complete repositories block from composer.json
<pre class="javascript">    "repositories": {
        "0": {
            "type": "composer",
            "url": "https://wpackagist.org/"
        },
        "rtantispam": {
            "type": "vcs",
            "url": "git@github.com:rtCamp/rtAntiSpam.git"
        },
        "rollbar":{
            "type": "package",
            "package": {
                "name": "digitalmedia/rollbar",
                "type": "wordpress-plugin",
                "version": "dev-master",
                "source": {
                    "type": "git",
                    "url": "git@github.com:digitalmedia/rollbar.git",
                    "reference": "master"
                }
            }
        }
    },
</pre>
<strong>Notes:</strong>
<ol>
 	<li>In reality, package type <code>wordpress-plugin</code> has dependency on <code>composer/installers</code> but <code>wordpress-core</code> composer package already satisfies it. So we are avoid duplicate lines in our composer.json file to keep it lean.</li>
 	<li>We really don't know how to define entire package via composer command. But as you can see it has plenty of lines, we will prefer to copy-paste and edit.</li>
 	<li>Composer doesn't directly support custom path if package doesn't have <code>composer.json</code> in it's source code with <code>composer/installers</code> as dependency but because we are using <code>wpackagist </code>if we specify "<code>type"</code> as "<code>wordpress-plugin"</code> or "<code>wordpress-theme"</code> it will take care of it.</li>
</ol>
<strong>Add actual composer package</strong>

Once we add our git repo, we can add it as a package like below.
<pre class="javascript">    "require": {
        "digitalmedia/rollbar": "dev-master"
    }</pre>
<code>dev-master</code> will point to git's master branch. Rollbar git repo also doesn't have any tags. For command-line interface, we can achieve above by running:

<code>composer require digitalmedia/rollbar:dev-master</code>

<strong>Note: </strong>when defining package like this, you can use any package name. It no need to be <strong>githuborg/githubrepo</strong>. Only care you need to take is to keep <strong>githubrepo</strong> unique so it won't conflict with any other WordPress package.
<h3>Theme/Plugin without version control <em>e.g. zip file</em></h3>
This applies to packages available without any version control. This is common for premium themes and plugins which are often delivered as zip file.

For sake of example, let's take example of our premium product <a href="https://easyengine.io/products/rtbiz-helpdesk/">rtBiz Helpdesk</a>. We sell this plugin using <a href="https://easydigitaldownloads.com/">easydigitaldownloads.com</a> which generates a zip file link like below for each download:

<code>https://easyengine.io/index.php?eddfile=[FILE]&amp;ttl=[TTL]&amp;file=0&amp;token=[TOKEN]</code>

We can add such zip file links directly as a composer package by following two steps like above.

<strong>Add zip file as a new composer repository</strong>
<pre class="javascript">{
    "type": "package",
    "package": {
        "name": "rtcamp/rtbiz-helpdesk",
        "type": "wordpress-plugin",
        "version": "1.0.0",
        "dist": {
            "type": "zip",
            "url": "https://easyengine.io/index.php?eddfile=[FILE]&amp;ttl=[TTL]&amp;file=0&amp;token=[TOKEN]"
        }
    }
}
</pre>
Above example will look familiar.

<strong>Notes:</strong>
<ol>
 	<li>If you do not have a unique download link for zip file, you can upload zip file on a private server and use that link. As long as it's a valid link, composer won't complain.</li>
 	<li>You may notice version field is set to 1.0.0. This won't matter as zip packages won't have version control data. You may keep this version updated to remind yourself which package version you are using.</li>
</ol>
<strong>Add actual composer package</strong>

Once we add our zip repo, we can add it as a package like below.
<pre class="javascript">    "require": {
        "rtcamp/rtbiz-helpdesk": "dev-master"
    }</pre>
Again version won't matter for zip files. <strong>For command-line interface, we can achieve above by running:</strong>

<code>composer require rtcamp/rtbiz-helpdesk:dev-master</code>
<h2>Note about private git/svn repos</h2>
Composer can works transparently with private git/svn repo, provided machine on which composer running is pre-authenticated.

As an example, if you are cloning git repos from Github using git-based URL and SSH public key for that machine is already added to your Github profile, composer will work without any issue.

Please avoid HTTP based URLs when defining vcs repositories in composer.
<h2>Summary</h2>
As you can see, we tried to cover all cases so you can define all themes and plugins as composer dependency and manage entire WordPress projects from a single <code>composer.json</code> file.

Composer by default will only download dependencies. In next chapter, we will deal with theme/plugin activation, again with the help of composer!