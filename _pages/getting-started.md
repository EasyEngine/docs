---
ID: 111348
post_title: Getting Started
author: Rahul Bansal
post_excerpt: >
  Using concepts to manage entire
  WordPress projects, without needing git
  submodules. Useful to manage WordPress
  sites in cloud/multi-server enviornments
layout: page
permalink: >
  https://easyengine.io/tutorials/composer-wordpress/getting-started/
published: true
post_date: 2015-07-11 15:15:07
---
<a href="https://getcomposer.org/">Composer</a> is package manager for PHP. Explaining purpose of package manager is beyond scope of this article.

This article, actually section, will describe how to use Composer within WordPress ecosystem.  We believe this will benefit developers as well as system-admins.
<h2>Assumptions</h2>
<ol>
	<li>You are comfortable with git.</li>
	<li>You are comfortable with command-line interface.</li>
</ol>
<h2>Scope</h2>
As composer is a big topic, it's better to define scope first. We will cover following:
<ol>
	<li>Using composer to manage entire WordPress project including theme/plugin dependencies
<ul>
	<li>Managing WordPress themes and plugins hosted on wordpress.org repo</li>
	<li>Managing WordPress themes and plugins and any other dependency hosted elsewhere as git/svn repo or as a zip file</li>
	<li>Custom composer commands</li>
</ul>
</li>
	<li>Adding composer support to your own WordPress theme/plugin project</li>
</ol>
We will also cover some composer concepts for newbies.
<h2>Installing Composer</h2>
You may follow official instructions present <a href="https://getcomposer.org/doc/00-intro.md">here</a>.

We follow and recommend slightly different installation as below:
<h3>On Ubuntu (Linux)</h3>
<pre class="no-highlight">curl -sS https://getcomposer.org/installer | php -- --filename=composer --install-dir=/usr/local/bin
</pre>
This will install <code>composer</code> binary in <code>/usr/local/bin</code> path. This will make it easy to run composer commands from anywhere in system.
<h3>On Mac</h3>
We recommend using <a href="http://brew.sh/">brew</a>:
<pre class="no-highlight">brew install composer</pre>
<h2>How Composer Works?</h2>
Composer has a really good <a href="https://getcomposer.org/doc/">documentation</a> which can explain this in much better way.

Everything in project revolves around <code>composer.json</code>

To understand concept in quickly, lets divide entire workflow between: <strong>development</strong> and <strong>deployment</strong>.
<h3>Developer Workflow</h3>
<ol>
	<li>A project is started with a <code>composer.json</code> file. It can be created from scratch, copy/pasted from existing sample or can be generated using composer commands like <code>composer init</code>/<code>composer create-project</code>.</li>
	<li>Project dependencies are added to <code>composer.json</code> file.  Again dependencies can be added by directly editing <code>composer.json</code> file in text-editor or using composer command <code>composer require</code>.</li>
	<li>Dependencies can in turn have their own <code>composer.json</code> file for their sub-dependencies.</li>
	<li>Dependencies are often downloaded from <a href="https://packagist.org/">packagist.org</a> which is default repo for composer packages. We can add other composer package repos and can even install dependency from any git/svn repo or simply a zip file.</li>
	<li>After we are done with defining dependency, we run <code>composer update</code> command. This downloads all dependencies locally and generates a <code>composer.lock</code> file.</li>
	<li>By convention, we commit both - <code>composer.json</code> and <code>composer.lock</code> files to git repo. And git push our project/package to something like Github.</li>
</ol>
Steps 5 and 6 need to followed everytime we need to update dependencies.

<strong>Note: </strong>Please note that sometime a dependency update may not require making changes to <code>composer.json</code> file. Only running composer update command would suffice.
<h3>Deployment Workflow</h3>
<ol>
	<li><code>git clone</code> a composer-powered project.</li>
	<li>Run <code>composer install</code> commands which will download dependencies based on <code>composer.lock</code> content.</li>
	<li>If <code>composer.lock</code> file is not present, composer install will refer to <code>composer.json</code>. But we strongly recommend using composer.lock in production setup.</li>
</ol>
As you can see, deployment process is very streamline. You may add <code>composer install</code> to your webhooks or deploy scripts.
<h2>How Composer Works for entire WordPress Project</h2>
<strong>Use Case:</strong> If you want to deploy a WordPress project across multiple-servers or may be using a cloud-hosting platform like Amazon ElasticBeanstalk, you need to put entire WordPress project under version control.

Usually this involves using <code>git submodules</code>, which we find tedious. Here is a simpler and better way to achieve same with composer.
<h3>Developer Workflow</h3>
<ol>
	<li>Create a WordPress project with <code>composer.json</code> in root folder (<code>htdocs</code> typically).</li>
	<li><code>composer.json</code> will contain required WordPress version, theme and plugin dependencies.</li>
	<li>Technically plugin and theme repos can also have their own dependencies, if they are packaged as composer project. Remember, in composer world your dependency no need to be a composer package itself!</li>
	<li>For themes and plugins hosted on wordpress.org, there is a composer repo at <a href="http://wpackagist.org/">wpackagist.org</a>. This composer repo syncs with wordpress.org and makes each theme and plugin's available as composer package.</li>
	<li>After we are done with defining dependency, we run <code>composer update</code> command. This downloads wordpress core, themes and plugins locally and generates a <code>composer.lock</code> file.</li>
	<li>By convention, we commit both - <code>composer.json</code> and <code>composer.lock</code> files to git repo. And git push our project/package to something like Github.</li>
</ol>
Steps 5 and 6 need to followed everytime we add or remove themes/plugins or change WordPress core version.
<h3>Deployment Workflow</h3>
<ol>
	<li><code>git clone</code> a composer-powered project.</li>
	<li>Run <code>composer install</code> commands which will download WordPress core, themes, plugins and any other dependencies  based on <code>composer.lock</code> content.</li>
	<li>If <code>composer.lock</code> file is not present, composer install will refer to <code>composer.json</code>. But we strongly recommend using composer.lock in production setup.</li>
</ol>
We also use some custom <a href="https://getcomposer.org/doc/articles/scripts.md">composer scripts</a> as part of deployment flow. More about it will be explained later.
<h2>Composer Commands</h2>
Following are commands we use quite often:
<ol>
	<li><strong>composer init</strong> - to generate <code>composer.json</code> interactively. We really don't use this but copy/paste existing files.</li>
	<li><strong>composer update</strong> - download dependencies based on <code>composer.json</code> and generate/update <code>composer.lock</code> file.</li>
	<li><strong>composer install</strong> -  download dependencies based on <code>composer.lock</code> file. If composer.lock doesn't exists, download dependencies based on <code>composer.json</code></li>
	<li><strong>composer diagnose</strong> - check if <strong>composer.json</strong> is correct. This does much more than validating JSON.</li>
	<li><strong>composer require</strong> - add one or more dependencies without editing <strong>composer.json</strong> manually.</li>
	<li><strong>composer remove</strong> - remove one or more dependencies without editing <strong>composer.json</strong> manually.</li>
</ol>