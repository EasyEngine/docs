---
ID: 143420
post_title: Share your local sites on internet
author: Kirtan Gajjar
post_excerpt: >
  You can share your sites from your
  laptop to anyone with site publish
  command
layout: handbook
permalink: >
  https://easyengine.io/handbook/share-your-local-sites-on-internet/
published: true
post_date: 2018-12-14 19:32:48
---
<!-- wp:paragraph -->
<p>EasyEngine provides you a way to share your sites with anybody even if there's no DNS entry pointing to it. This is especially useful if</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul><li>You are Developing your sites on local machine and want to share with your coworker.</li><li>You want to access a site on remote server which has no DNS entry pointed at it.</li></ul>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>Publish a site</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>You can publish a site using <code>site publish</code>&nbsp;command.</p>
<!-- /wp:paragraph -->

<!-- wp:preformatted -->
<pre class="wp-block-preformatted">ee site publish example.test<br><br>Checking ngrok api for tunnel details.<br>Success: Successfully published example.test to url: http://xxxxxx.ngrok.io<br>Running additional WordPress configurations.<br>Success: WordPress configurations updated for publish.</pre>
<!-- /wp:preformatted -->

<!-- wp:paragraph -->
<p>EasyEngine uses <a href="https://ngrok.com/">ngrok</a>'s API behind the scenes to accomplish it. It creates a tunnel from your local machine to ngrok's server.</p>
<!-- /wp:paragraph -->

<!-- wp:image -->
<figure class="wp-block-image"><img src="https://camo.githubusercontent.com/f2d698991e6a0411680413ebcc15a6460b8beda3/68747470733a2f2f6e67726f6b2e636f6d2f7374617469632f696d672f6f766572766965772e706e67" alt=""/><figcaption>Image taken from <a href="https://github.com/inconshreveable/ngrok">ngrok's github repo</a></figcaption></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3} -->
<h3>Using paid plan of ngrok</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>If you already have a paid plan of ngrok, you can use it to overcome limitations applied by ngrok's free plan that EasyEngine uses by default.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>You need get auth token from your ngrok dashboard and pass it while publishing site</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>ee site publish example.test --token=&lt;auth_token></code></pre>
<!-- /wp:code -->

<!-- wp:heading {"level":3} -->
<h3>Publish for more than 7 hours</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Ngrok's free tier has a limitation that a ngrok process can only run for 7 hours simultaneously. If you find your published site isn't accessible after 7 hours, you can use <code>--refresh</code>&nbsp;flag to republish the site.</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>ee site publish example.test --refresh</code></pre>
<!-- /wp:code -->

<!-- wp:heading -->
<h2>Unpublishing a site</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>When you want to stop sharing a site, use <code>site publish --disable</code></p>
<!-- /wp:paragraph -->

<!-- wp:preformatted -->
<pre class="wp-block-preformatted">ee site publish a.test --disable<br><br>Checking ngrok api for tunnel details.<br>Disabling publish.<br>Success: Site publish disabled.<br>Running additional WordPress configurations.<br>Success: WordPress configurations updated for publish.</pre>
<!-- /wp:preformatted -->

<!-- wp:heading -->
<h2>Limitations</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>There are some limitations of <code>site publish</code>. These are mainly because of limits applied by <a href="https://ngrok.com/pricing">ngrok's free tier</a>. If you already have a paid plan of ngrok, you can also <a href="#using-paid-plan-of-ngrok">use it's paid plan with EE</a>.</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul><li>Only one site can be published at a time.</li><li>Site can be published for 7 hours at a stretch.</li></ul>
<!-- /wp:list -->