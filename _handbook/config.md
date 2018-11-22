---
ID: 143021
post_title: Config
author: Rahul Bansal
post_excerpt: ""
layout: handbook
permalink: https://easyengine.io/handbook/config/
published: true
post_date: 2018-11-21 11:05:23
---
<!-- wp:paragraph -->
<p>EasyEngine allows overriding its default behavior via it's own config file. </p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Config File Location</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Config file location is present at:</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>/opt/easyeninge/config/config.yml</code></pre>
<!-- /wp:code -->

<!-- wp:heading -->
<h2 id="mce_4">Config  Options</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Following are config options and their default values:</p>
<!-- /wp:paragraph -->

<!-- wp:table {"align":"center"} -->
<table class="wp-block-table aligncenter"><tbody><tr><td> <strong>Key</strong></td><td><strong>Allowed Value</strong></td><td><strong>Default Value</strong></td><td><strong>Purpose</strong></td></tr><tr><td>locale</td><td><a href="https://make.wordpress.org/polyglots/teams/">Any Valid WordPress Locale<br></a></td><td>en_US</td><td>To download and setup WordPress in specified language during site creation.<br></td></tr><tr><td>ee_installer_version</td><td>stable,<br>nightly<br></td><td>stable</td><td>Decides which version to update to by default if no parameters are passed in <code>ee cli update</code>.<br></td></tr><tr><td>le-mail</td><td>Valid email address.<br></td><td>-</td><td>Mail <g class="gr_ gr_30 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling ins-del" id="30" data-gr-id="30">id</g> used for registration in Letsencrypt. Renewal and expiration <g class="gr_ gr_67 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling ins-del" id="67" data-gr-id="67">mails</g> will come to this mail id.<br></td></tr><tr><td>preferred_ssl_challenge</td><td>http,<br>dns</td><td>http</td><td>Set Letsencrypt <g class="gr_ gr_36 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling ins-del multiReplace" id="36" data-gr-id="36">challenge</g> method. <br></td></tr></tbody></table>
<!-- /wp:table -->