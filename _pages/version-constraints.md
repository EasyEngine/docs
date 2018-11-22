---
ID: 141837
post_title: Version Constraints
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/composer-wordpress/version-constraints/
published: true
post_date: 2017-07-02 13:42:52
---
As you start using Composer to manage your dependencies, you need to take care specifying correct version of packages.

Most often you would specify a range because you don't want to edit composer.json file every time a minor plugin update gets a release.
<h2>Version Constraint</h2>
The composer has many ways to specify version constraints and also has a <a href="https://getcomposer.org/doc/articles/versions.md#writing-basic-version-constraints">section dedicated to it on the official website</a>.

There are five ways to specify non-exact versions for a plugin at version 1.2.
<ol>
 	<li>Range (operator-based) e.g. &gt;=1.2 &lt;2.0</li>
 	<li>Range (hyphen) e.g. 1.2 - 2.0</li>
 	<li>Wildcard (*) e.g. 1.2.*</li>
 	<li>Tilde (~) e.g. ~1.2</li>
 	<li>Caret (^) e.g. ^1.2</li>
</ol>
All of above can allow you to add a plugin to version 1.2 today and have it updated till 2.0.

At first, tilde and caret may seem confusing, but <a href="https://stackoverflow.com/a/43145865/156336">these</a> <a href="https://getcomposer.org/doc/articles/versions.md#next-significant-release-operators">links</a> can help understand the difference.

There is also an online <a href="https://semver.mwl.be/">semantic version checker tool</a> that you can use. Try it with <a href="https://semver.mwl.be/#?package=laravel%2Fframework&amp;version=~5.3.0&amp;minimum-stability=stable">Laravel</a> and <a href="https://packagist.org/packages/yoast/wordpress-seo">WordPress SEO</a> plugin.

Most article on composer recommends using caret, but it will create a problem for us.
<h2>Semantic Versioning (SemVer)</h2>
You can read about semantic versioning at <a href="http://semver.org/">semver.org</a> in details.

Unfortunately, the majority in WordPress ecosystem doesn't follow semantic versioning so using caret can create problems. You may be surprised to know that Laravel also doesn't follow <a href="https://vinkla.com/2016/laravel-semver/">semantic versioning</a>.

Most WordPress plugin developers and even Laravel follows what is called (or trolled) <a href="http://blog.legacyteam.info/2015/12/romver-romantic-versioning/">Romantic versioning</a> (RomVer).
<h2>Specifying Version Constraint in WordPress</h2>
It's better to use tilde with the minor version specified. In cases, where a plugin is released as 2.4 and not 2.4.0, you can still specify ~2.4.0.

~2.4.0 will get you all updates till 2.5.

In SemVer, you can when using 2.4, you can trust 2.5 blindly. But this is not true in WordPress ecosystem and at most other places.
<h3>Warning</h3>
~2.4 is not same ~2.4.0.
<ul>
 	<li>~2.4 means all updates &lt; 3.0</li>
 	<li>~2.4.0 means all updates &lt; 2.5</li>
</ul>
So we must specify minor release.
<h3>Point Releases</h3>
Some plugins/projects follow 0.x version number in an early stage. A recent example is <a href="https://wordpress.org/plugins/gutenberg/">Gutenberg editor in WordPress</a>.

In this case:
<ul>
 	<li>~0.2 means all updates &lt; 1.0</li>
 	<li>~0.2.0 means all updates &lt; 0.3</li>
</ul>