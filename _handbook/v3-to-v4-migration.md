---
ID: 142679
post_title: v3 to v4 Migration
author: Rahul Bansal
post_excerpt: ""
layout: handbook
permalink: >
  https://easyengine.io/handbook/v3-to-v4-migration/
published: true
post_date: 2018-11-21 16:33:41
---
<!-- wp:paragraph -->
<p>EasyEngine v4 is complete rewrite in terms of many aspects. The key one being:</p>
<!-- /wp:paragraph -->

<!-- wp:list {"ordered":true} -->
<ol><li>Programming Language: v3 had Python, v4 has PHP</li><li>Architecture: v3 was using native OS packages, v4 uses Docker images&nbsp;&nbsp;</li><li>Focus: v3 was focused on system admin tasks, v4 is focused on developer workflow</li></ol>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p>That being said we tried our best to preserve semantics where possible so v3 users won't have a steep learning curve when moving to EasyEngine v4.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>This document outlines changes and answers some questions in details. Reading this will make moving to v4 easy.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>v3 - End of Life</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>We do not support v3 in any way except fixing critical security&nbsp;vulnerabilities. The security fixes will be provided until <strong>January 31, 2019</strong>. </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>There won't be new features or enhancements. The core team won't be answering any <a href="https://community.easyengine.io/c/v3">v3 related support topics</a> on forum or Github issue tracker. To keep forum/issue tracker clean, if a v3 related discussion gets no reply for 30 days, we will close it.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>As v3's end of life is near, you can consider migrating to v4 or any other alternatives you may like. We do not recommend using unsupported software, even if it was made by us.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Now let's deep dive into v3 to v4 changes and get you ready to migrate.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Feature Changes</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>This section covers some of major feature changes in details. Not every change is breaking. We believe, you may like some changes in the following list, but nonetheless, we should tell you about them here to avoid surprises!&nbsp;</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><em>Note: The emoji under each subsection represent an anticipated emotional response!&nbsp;</em>😉</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Removal of Mail Hosting&nbsp;😞</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>v3 had email hosting support with web interface powered by&nbsp;ViMbAdmin and RoundCube. If you never used that feature, you don't need to worry about it.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Running a mail server is hard. We ourselves have been using Google Suite (Google Apps) for email hosting since the inception of rtCamp (from 2008).</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>The feature in v3 was added an as experiment. While it worked, we did not used it in production so it became very hard to manage &amp; support it.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>There are many tools to migrate emails between IMAP servers. We use <a href="https://github.com/rgrove/larch">larch</a> all the time. It still works. even if it officially unmaintained by author.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Limit on number of EE sites&nbsp;😞</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>As v4 depends on docker, it is affected by <a href="https://loomchild.net/2016/09/04/docker-can-create-only-31-networks-on-a-single-machine/">Docker's limitation of 31 network per machine</a>.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>v4 creates one network per site. Then v4 also needs few Docker networks for global services. So roughly we limit the&nbsp;<g class="gr_ gr_27 gr-alert gr_gramm gr_inline_cards gr_run_anim Grammar only-ins replaceWithoutSep" id="27" data-gr-id="27">number</g> of sites to 25.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Please note, a WordPress multisite is counted as a single site. We highly recommend you use&nbsp;WordPress multisite more often. Aside site limit,&nbsp;multisite reduces overall burden and in a way enforce usage of quality codes.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>While we already have a patch to overcome this 31 network limit, we will wait for a few months before we make a decision on this.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>If you already have a v3 server with more than 25 sites, you may migrate them in chuks to multiple v4 servers.&nbsp;</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>WordPress Cache Types&nbsp;😐</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>v3 has four different cache types but we only used redis backed full page cache. It was also our recommended caching method.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Maintaining four ways to achieve the same thing is hard. So we removed all other cache types to make project lean and clean. Also, now we have only one cache type to focus on, we will be able to improve it in a much better way going ahead.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>To be specific, we have dropped support for nginx fastcgi cache, wp super cache,&nbsp;<g class="gr_ gr_5 gr-alert gr_gramm gr_inline_cards gr_run_anim Punctuation only-ins replaceWithoutSep" id="5" data-gr-id="5">and</g> w3 total cache. But since Redis cache has all the features and supports many more use cases such as wildcard purging in linear time using Lua script, we hope you won't get affected by this change.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>If you use v3 to v4 migration script, it will automatically handle cache type change appropriately. So again nothing to worry here unless you depend on anything that wasn't part of default v3 cache config.&nbsp;</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Complete Rewrite in PHP&nbsp;🤷</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>v3 was written in Python. Python is a decent programming language but rtCamp - the company behind EasyEngine is primarily a WordPress agency. Also, most EasyEngine users are from WordPress ecosystem. It was getting difficult for us to hire decent Python developers and even harder was to get them motivated to fix <g class="gr_ gr_616 gr-alert gr_gramm gr_inline_cards gr_disable_anim_appear Grammar only-ins replaceWithoutSep" id="616" data-gr-id="616">problem</g> of an ecosystem they are not part of!<br></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>So v4 is completely rewritten in PHP. Since PHP used by EasyEngine itself and PHP used by sites created via EasyEngine are not related, the&nbsp;EasyEngine itself is coded in PHP 7.2 to make most of the latest PHP version.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Uses WP-CLI as a Framework&nbsp;☺️</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>You may have used WP-CLI in past. You are in for a good news. <a href="https://easyengine.io/handbook/internal/wp-cli/">v4 uses WP-CLI as a base framework</a>.&nbsp;</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>If you are familiar with WP-CLI package development, you will be able to extend EasyEngine using similar packages.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>PHP 7 is new default&nbsp;🎉</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>In v4, all PHP and WordPress sites will be created using the latest PHP version by default. At the time of v4.0.0 release, PHP is (was) set to PHP 7.2 by default. You can also create site in PHP 5.6 if you want.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Admin Tools Port 22222 🎉</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Earlier admin-tools were accessible from a dedicated port 22222. Now they will be accessible from&nbsp;<code>example.com/ee-admin/</code>.&nbsp;You can have a look at <a href="https://github.com/EasyEngine/easyengine/issues/1013">this issue</a> to know more about why this change was made.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>This will simplify networking and firewall as you don't have to open ports in firewall. No more issues when putting site behind Cloudflare.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>We believe you will love &amp; welcome this change!&nbsp;♥️</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Command Changes</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>This section list EasyEngine command changes from v3 to v4. As many commands, have many flags, and then flags together can be used in almost endless permutations, for sake of <g class="gr_ gr_270 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling ins-del multiReplace" id="270" data-gr-id="270">readbility</g>, we are covering commands &amp; flags which are frequently used.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Site Create Command</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Site creation - the biggest EasyEngine feature, has undergone some significant changes. Overall, there is no real loss in functionality but few things are removed and renamed.&nbsp; As this is biggest command, it is documented here in detail here.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":4} -->
<h4>Removed Flags</h4>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>v4 doesn't support following site create flags. Following command will throw an error:</p>
<!-- /wp:paragraph -->

<!-- wp:preformatted -->
<pre class="wp-block-preformatted">ee site create example.com --wpfc<br>ee site create example.com --wp3tc<br>ee site create example.com --wpsc<br>ee site create example.com --pagespeed<br>ee site create example.com --hhvm</pre>
<!-- /wp:preformatted -->

<!-- wp:heading {"level":4} -->
<h4>Remapped Flags</h4>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>For following v3 flags, v4 will internally convert them to their v4 equivalent:</p>
<!-- /wp:paragraph -->

<!-- wp:table -->
<table class="wp-block-table"><tbody><tr><td><strong>v3 flag</strong></td><td><strong>v4 equivalent command</strong></td></tr><tr><td><code>--wp</code></td><td><code>ee site create example.com --type=wp</code></td></tr><tr><td><code>--wpredis</code></td><td><code>ee site create example.com --type=wp --cache</code></td></tr><tr><td><code>--wpsubdom</code></td><td><code>ee site create example.com --type=wp --mu=subdom</code></td></tr><tr><td><code>--wpsubdir</code></td><td><code>ee site create example.com --type=wp --mu=subdir</code></td></tr><tr><td><code>--html</code></td><td><code>ee site create example.com --type=html</code></td></tr><tr><td><code>--php</code></td><td><code>ee site create example.com --type=php</code></td></tr><tr><td><code>--mysql</code></td><td><code>ee site create example.com --type=php --with-db</code></td></tr><tr><td><code>--le</code></td><td><code>ee site create example.com --type=html --ssl=le</code></td></tr><tr><td><code>--letsencrypt</code></td><td><code>ee site create example.com --type=html --ssl=le</code></td></tr></tbody></table>
<!-- /wp:table -->

<!-- wp:heading {"level":4} -->
<h4>Renamed Flags</h4>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>In addition to above, for WordPress site creation, some v3 flags has been renamed. These are handled internally without any issue:</p>
<!-- /wp:paragraph -->

<!-- wp:table {"hasFixedLayout":true} -->
<table class="wp-block-table has-fixed-layout"><tbody><tr><td><strong>v3 WordPress Site Flag</strong></td><td><strong>v4 WordPress Site Flag</strong></td></tr><tr><td><code>--user</code></td><td><code>--admin-user</code></td></tr><tr><td><code>--pass</code></td><td><code>--admin-pass</code></td></tr><tr><td><code>--email</code></td><td><code>--admin-email</code></td></tr></tbody></table>
<!-- /wp:table -->

<!-- wp:heading {"level":3} -->
<h3>Other Commands</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Following commands are permanently removed/replaced from EasyEngine.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":4} -->
<h4>Stack Command Removed</h4>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>In v4, we do not install anything on the host. Hence the entire <code>stack</code> command from v3 is irrelevant. Following will simply throw an&nbsp;error:</p>
<!-- /wp:paragraph -->

<!-- wp:preformatted -->
<pre class="wp-block-preformatted">stack install<br>stack migrate<br>stack purge<br>stack remove<br>stack upgrade</pre>
<!-- /wp:preformatted -->

<!-- wp:paragraph -->
<p>v4 has a new concept of <a href="https://easyengine.io/commands/service/">services</a> but it should not be seen as replacement for <code>stack</code>.&nbsp;</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":4} -->
<h4>Secure Command Replaced</h4>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Since admin-tools in v4 are not running on a special port such as 22222, <code>ee secure &lt;port&gt;</code> command is no longer needed, hence removed.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><g class="gr_ gr_35 gr-alert gr_gramm gr_inline_cards gr_disable_anim_appear Style multiReplace" id="35" data-gr-id="35">Other </g><code>ee secure</code><g class="gr_ gr_35 gr-alert gr_gramm gr_inline_cards gr_disable_anim_appear Style multiReplace" id="35" data-gr-id="35">&nbsp;sub-commands</g> are replaced by new <a href="https://easyengine.io/commands/auth/">auth command</a>. <code>ee auth</code>&nbsp;is a lot more powerful and configurable,</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":4} -->
<h4>Info Command Replaced</h4>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><code>ee info</code>&nbsp;command is replaced with:</p>
<!-- /wp:paragraph -->

<!-- wp:list {"ordered":true} -->
<ol><li><code><a href="https://easyengine.io/commands/cli/info/">ee cli info</a></code>&nbsp;- displays easyengine own info and host machine info.&nbsp;</li><li><code><a href="https://easyengine.io/commands/site/info/">ee site info</a></code>&nbsp;- displays site-specific info</li></ol>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>Update Command Replaced</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>v3's <code>ee update</code> command to update EasyEngine itself is replaced by <code>ee cli update</code>.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Temporarily Removed Commands</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Following commands have been temporarily removed but these will be added back soon:</p>
<!-- /wp:paragraph -->

<!-- wp:preformatted -->
<pre class="wp-block-preformatted">ee site log<br>ee site show<br>ee site edit<br>ee debug<br>ee clean<br>ee log</pre>
<!-- /wp:preformatted -->

<!-- wp:heading {"level":3} -->
<h3>New v4 Commands</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>v4 introduces many new commands as below:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul><li><a href="https://easyengine.io/commands/mailhog/">mailhog</a> &nbsp;- to capture outgoing emails for SMTP testing &amp; debugging</li><li><a href="https://easyengine.io/commands/admin-tools/">admin-tools</a> - to selectively enable/disable admin tools per site</li><li><a href="https://easyengine.io/commands/cron/">cron</a> - manage cronjobs per site and/or globally</li><li><a href="https://easyengine.io/commands/service/">service</a>&nbsp;- to manage shared services such as global mysql &amp; global redis</li><li><a href="https://easyengine.io/commands/cli/">cli</a> - stuff that is related to easyengine itself</li></ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p><a href="https://easyengine.io/commands/">You can check all v4 commands reference documentation here</a>.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Automation Impact</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>If you are a hosting company provisioning EasyEngine v3 based server via some automation script, nothing will break.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>If you use our famous one-line install -&nbsp;<code>wget -qO ee rt.cx/ee &amp;&amp; sudo bash ee</code>&nbsp;in any script, it will fetch v3 only. v4 has a new short URL.&nbsp;</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Similarly, if you <g class="gr_ gr_12 gr-alert gr_gramm gr_inline_cards gr_disable_anim_appear Style multiReplace" id="12" data-gr-id="12">run </g><code>ee update</code><g class="gr_ gr_12 gr-alert gr_gramm gr_inline_cards gr_disable_anim_appear Style multiReplace" id="12" data-gr-id="12"> <g class="gr_ gr_11 gr-alert gr_gramm gr_inline_cards gr_disable_anim_appear Grammar only-ins doubleReplace replaceWithoutSep" id="11" data-gr-id="11">command</g></g> on a v3 server periodically or via some script, it will only fetch EasyEngine v3 update, if a minor update is available.&nbsp;</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>v3 doesn't update to v4 automatically. We have a migration script for that, which you need to run manually. </p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Migration Script</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>First, thanks for reading this far! If you are excited about v4 but think moving more than a dozen sites you have created on v3 will take time,&nbsp;</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>We understand you may have a lot many sites on v3. So we have created a migration script to move sites from v3 to v4. The script support migration on the&nbsp;same server as well a migration to new server.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Please read this for v3 to v4 Migration Script [TODO LINK]</p>
<!-- /wp:paragraph -->