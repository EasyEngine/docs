---
ID: 106326
post_title: >
  Git and File-System Layout (non-default
  setup)
author: Rahul Bansal
post_excerpt: >
  A non-default file-system layout for
  WordPress projects using composer and
  git. Everything is managed using stuff
  WordPress already supports.
layout: page
permalink: >
  https://easyengine.io/tutorials/composer-wordpress/git-file-system-layout/
published: true
post_date: 2015-07-11 17:49:47
---
We assume you are already familiar with composer. If not please read <a href="https://easyengine.io/tutorials/composer/getting-started/">Getting Started with Composer for WordPress Projects</a> first.

Before we really get going with composer, we need to make few changes to WordPress default setup to make it more composer/git friendly.
<h2>File System Layout</h2>
Following are example content for webroot. Usually  <code>htdocs</code>,<code>public_html</code> or<code>www</code> folder depending on your server config.
<pre class="no-highlight">composer.json
composer.lock
index.php
wordpress/
wp-content/
uploads/
wp-config.php
.gitignore</pre>
Let's explain each of above one-by-one.
<h3>.gitignore file</h3>
Some files and folders will be automatically created and showed above for illustration only. This also means we shall not put them under version control. So at bare minimum, please add following to .gitignore
<pre class="no-highlight">vendor/
wordpress/
wp-content/</pre>
<code>vendor</code> directory will be created by composer at runtime. We won't be using it for any purpose.
<h3>"wordpress" directory</h3>
We will giving WordPress core  it's own directory. <a href="https://codex.wordpress.org/Giving_WordPress_Its_Own_Directory">WordPress supports this kind of setup since long time</a>.

Please note that you don't need to create this directory or download WordPress yourself. Composer will take care of this.
<h3>index.php in webroot</h3>
In order to support above, we will need to copy <code>index.php</code> from WordPress folder to root (<code>htdocs</code>) folder and edit it to include "wordpress" folder path. You can use example below as it is:
<pre class="no-highlight">&lt;?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define('WP_USE_THEMES', true);

/** Loads the WordPress Environment and Template */
require( dirname( __FILE__ ) . '/wordpress/wp-blog-header.php' );</pre>
You can notice <code>wordpress/</code> in last line.
<h3>"wp-content" directory</h3>
Next we need to move <code>wp-content</code> outside <code>wordpress</code> directory. <a href="https://codex.wordpress.org/Editing_wp-config.php#Moving_wp-content_folder">WordPress supports this as well</a>.

Again, you no need to create wp-content or download any themes/plugins. Composer will be doing this for you.
<h3>wp-config.php</h3>
For our non-default layout to work, we need to add some lines to our <code>wp-config.php</code> files.

You can add following at the top (after <code>&lt;?php</code> tag)
<pre class="php">define('WP_SITEURL', 'https://' . $_SERVER['SERVER_NAME'] . '/wordpress');
define('WP_HOME',    'https://' . $_SERVER['SERVER_NAME']);
define('WP_CONTENT_DIR', dirname(__FILE__) . '/wp-content');
define('WP_CONTENT_URL', 'https://' . $_SERVER['SERVER_NAME'] . '/wp-content');</pre>
First two lines takes care of <code>wordpress</code> directory and next two lines takes care of <code>wp-content</code> directory.
<h4>Moving wp-config.php outside webroot (optional)</h4>
As you may have noticed, <code>wp-config.php</code> is present in public webroot directory here.

<a href="http://codex.wordpress.org/Hardening_WordPress#Securing_wp-config.php">Method of moving wp-config.php one-level up</a> will not work here. This is because we are already one level up with respect to <code>wordpress</code> directory. But we can still move it a level up by doing some extra work:

<strong>With original wp-config.php</strong>
<ol>
	<li>Move original wp-config.php one level up, outside webroot. Let's call webroot <code>htdocs</code> here.  It can be <code>public_html</code>, <code>www</code> or anything else. What you call your folder doesn't matter as long as you remember it's name.</li>
	<li>Change line <code>define('WP_CONTENT_DIR', dirname(__FILE__) . '/wp-content');</code> to include webroot folder as this line refers to absolute filesystem path. In our case, it will become <code>define('WP_CONTENT_DIR', dirname(__FILE__) . '/htdocs/wp-content');</code></li>
	<li>Now go to last line <code>#require_once(ABSPATH . 'wp-settings.php');</code> and comment it out.</li>
</ol>
<strong>Create a new "fake" wp-config.php</strong>

After moving and modifying original <code>wp-config.php</code>, we need to create a fake/placeholder <code>wp-config.php</code> in webroot. Remember WordPress cannot lookup two level up for <code>wp-config.php</code>.

You can put following wp-config.php as it is:
<pre class="php">&lt;?php
/** path to real wp-config.php **/
require_once( dirname(__DIR__) . '/wp-config.php');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
</pre>
<h3>composer.lock file</h3>
As explained in <a href="https://easyengine.io/tutorials/composer/getting-started/">previous chapter</a>, <code>composer.lock</code> file will be generated automatically. So we no need to explore more about it.
<h3>composer.json file</h3>
At bare minimum <code>composer.json</code> file for WordPress will look like below:
<pre>{
    "require": {
        "johnpbloch/wordpress": "4.2.2"
    }
}</pre>
Composer's official repo has a <a href="https://packagist.org/packages/johnpbloch/wordpress">composer package for WordPress</a> maintained by <a href="http://johnpbloch.com/">John P. Bloch</a>.

You can copy above content in <code>composer.json</code> file on your filesystem or run <code>composer init --require johnpbloch/wordpress:4.2.2</code><span class="s1"> which will generate a <code>composer.json</code> file followed by an interactive wizard.</span>

In either case, you will have a <code>composer.json</code> file.

Next, run <code>composer install</code> command, it will create a<code>wordpress</code> directory and download WordPress version 4.2.2 in it. You can specify any other version and it will get dowloaded.

You will also see a <code>vendor</code> directory and <code>composer.lock</code> file generated. You no need to dig into them.

In next chapter, we will explore <code>composer.json</code> in more details.

Don't forget to git commit/push changes you have made so far. From here onwards you will be only editing <code>composer.json</code> and running <code>composer update</code> command to update <code>composer.lock</code> file. Other files will remain mostly untouched.