---
ID: 143288
post_title: WordPress.com VIP Go Sites
author: Kirtan Gajjar
post_excerpt: ""
layout: handbook
permalink: >
  https://easyengine.io/handbook/wordpress-vip/
published: true
post_date: 2018-11-30 13:48:34
---
<!-- wp:paragraph -->
<p>EasyEngine v4.0.2 added support for creating WordPress VIP sites.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>This feature is helpful for developing and testing WordPress VIP sites on local environment. Currently we only support VIP GO for now.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Create new VIP site</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>To create a site with VIP setup, run:</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>ee site create example.com --vip</code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p>⚠️ <em>Note:</em>&nbsp;<code>--vip</code>&nbsp;flag implies <code>--type=wp</code>. Hence you can use the flags of WordPress site with it.&nbsp;</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>This command will setup VIP site from VIP GO <a href="https://github.com/Automattic/vip-go-skeleton">skeleton repository</a>&nbsp;and install its <a href="https://github.com/Automattic/vip-go-mu-plugins-built">mu-plugins</a>.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>The VIP GO skeleton repository replaces&nbsp;<code>wp-content</code>&nbsp;of default WordPress installation.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 id="mce_11">Create VIP site from existing repository</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>If you have an existing VIP repository, on GitHub, you can pass repo URL to have your repo's content used.</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>ee site create example.com --vip=git@github.com:rtcamp/my-vip-site.git</code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p>Above command also has a shorthand version where you can pass <code>github-org-name/repo-name</code>&nbsp;directly. This automatically uses SSH based URL.</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>ee site create example.com --vip=rtcamp/my-vip-site</code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p>This command will setup VIP site from a git repository. The site's <code>wp-content</code> will be replaced by the contents of git repository instead of the VIP skeleton repo.</p>
<!-- /wp:paragraph -->