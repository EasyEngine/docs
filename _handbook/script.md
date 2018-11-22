---
ID: 142678
post_title: v3 to v4 Migration Script
author: Rahul Bansal
post_excerpt: Migrating v3 sites to v4
layout: handbook
permalink: >
  https://easyengine.io/handbook/v3-to-v4-migration/script/
published: true
post_date: 2018-11-21 14:14:39
---
<!-- wp:paragraph -->
<p>EasyEngine provides a migration script if you want to migrate your existing sites running on v3 to v4.&nbsp;</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>The migration script support migrating sites on the same server as well as a new remote server.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>The migration script automatically installs EasyEngine v4 - either locally or remotely, if it is not already installed.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Limitations</h2>
<!-- /wp:heading -->

<!-- wp:list -->
<ul><li>v4 doesn't support email hosting. So your v3 email won't be migrated by the script.</li><li>You need to migrate your own custom NGINX configuration which are outside paths specified for custom configuration in EasyEngine v3. It's hard to predict what may go in custom config so its better you do it <g class="gr_ gr_1058 gr-alert gr_gramm gr_inline_cards gr_run_anim Punctuation only-del replaceWithoutSep" id="1058" data-gr-id="1058">yourself,</g> if required.</li></ul>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>Download Migration Script</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Run following command to download the migration script on v3 server&nbsp;</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>wget -o migrate.sh https://rt.cx/ee3to4 &amp;&amp;
chmod +x migrate.sh</code></pre>
<!-- /wp:code -->

<!-- wp:heading -->
<h2>Start a tmux/screen session</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>This is optional but highly recommended.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Migration script can&nbsp;take time. Especially migration to a remote server. </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Please ensure that you run either start&nbsp;<code>tmux</code>&nbsp;or&nbsp;<code>screen</code>&nbsp;session on v3 server. This will ensure the script runs without any issues even if your Internet connection to your v3 server breaks.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 id="mce_1">Migrating Sites on the Same Server</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>This method will migrate your v3 sites to v4 on the same server. In this method, old sites of v3 will continue running&nbsp;on 80 and 443 ports while sites migrated to v4 will run on 8080 and 8443 ports.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Start the migration process when the load on the server is low. This will ensure that you will not run out of CPU/RAM while running both v3 and v4 sites simultaneously.&nbsp;</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Requirements</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul><li>EasyEngine v3 must be installed on the server (implied)</li><li>Port 8080/8443 must be free</li><li>Enough disk space to hold both v3 and v4 sites</li></ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>Steps</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Run the following command which will run a check to ensure all requirements for migration are met and will give you a report on how the migration will proceed.</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>./migrate.sh --dry-run --all</code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p>After ensuring requirements of script are met, you can now migrate an individual site or migrate all sites at once.</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>./migrate.sh &lt;site-name>
./migrate.sh --all</code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p>You can do a test migration of a single site <g class="gr_ gr_3 gr-alert gr_gramm gr_inline_cards gr_disable_anim_appear Style multiReplace" id="3" data-gr-id="3">with </g><code>./migrate.sh&nbsp;&lt;site-name&gt;</code><g class="gr_ gr_3 gr-alert gr_gramm gr_inline_cards gr_disable_anim_appear Style multiReplace" id="3" data-gr-id="3">&nbsp;first</g> followed by rest of the sites <g class="gr_ gr_4 gr-alert gr_gramm gr_inline_cards gr_disable_anim_appear Style multiReplace" id="4" data-gr-id="4">using </g><code>./migrate.sh --all</code><g class="gr_ gr_4 gr-alert gr_gramm gr_inline_cards gr_disable_anim_appear Style multiReplace" id="4" data-gr-id="4">.</g>&nbsp;</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>The migration script tracks sites which are already migrated and only migrate sites that haven't been previously migrated.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>After all the sites will be migrated, the script will prompt you&nbsp;to verify if the sites are running as expected.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p> You can now check your sites <g class="gr_ gr_7 gr-alert gr_gramm gr_inline_cards gr_run_anim Style multiReplace" id="7" data-gr-id="7">on </g><code>example.com:8080</code><g class="gr_ gr_7 gr-alert gr_gramm gr_inline_cards gr_disable_anim_appear Style multiReplace" id="7" data-gr-id="7">&nbsp;for</g> HTTP site <g class="gr_ gr_8 gr-alert gr_gramm gr_inline_cards gr_run_anim Style multiReplace" id="8" data-gr-id="8">or&nbsp;</g><code>example.com:8443</code><g class="gr_ gr_8 gr-alert gr_gramm gr_inline_cards gr_disable_anim_appear Style multiReplace" id="8" data-gr-id="8">&nbsp;for</g> HTTPS site.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>After you confirm that sites are running as expected, the script will stop the v3 stack and v4 will switch ports from 8080/8443 to 80/443.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>WordPress MU Port Limitation</strong></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Since WordPress multisite requires to be run on port 80/443, you won't be able to verify multisite on v4. This is <g class="gr_ gr_75 gr-alert gr_gramm gr_inline_cards gr_disable_anim_appear Grammar only-ins doubleReplace replaceWithoutSep" id="75" data-gr-id="75">limitation</g> from WordPress itself <a href="https://mu.trac.wordpress.org/ticket/189">https://mu.trac.wordpress.org/ticket/189</a> and&nbsp;<a href="https://core.trac.wordpress.org/ticket/12043">https://core.trac.wordpress.org/ticket/12043</a>.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 id="mce_21">Migrating Sites on Different Server</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>If your existing v3 server does not have enough space or for some reason you want to migrate your site on another server, you can also do it from script.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Start the migration process when the&nbsp;load on the server is low. This will ensure that sites running on v3 will continue to run smoothly and won't slow down due to disk or network I/O.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Requirements</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul><li>A fresh server on which v4 sites will be migrated.&nbsp;</li><li>v3 server's public key is added to v4 server's root user SSH authorized_keys&nbsp;</li><li>Port 80/443 should be free on the v4 server.</li><li>v4 server should have enough disk space for v3 sites.</li></ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>Steps</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Run the following command to check if requirements for migration are met. The script will give you a report on how the migration will proceed on remote host.</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>./migrate.sh --dry-run --remote-host=&lt;v4-server-hostname-or-ip> --all</code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p>If you find all good, you can either migrate sites one by one or all at once.</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>./migrate.sh &lt;site-name> --remote-host=&lt;v4-server-hostname-or-ip></code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p>Please replace&nbsp;<code>&lt;v4-server-hostname-or-ip&gt;</code>&nbsp;with IP address or hostname of the server. Hostname is NOT site-name.&nbsp;</p>
<!-- /wp:paragraph -->

<!-- wp:preformatted -->
<pre class="wp-block-preformatted">./migrate.sh --all --remote-host=2.2.2.2<br>./migrate.sh --all --remote-host=abc.example.com</pre>
<!-- /wp:preformatted -->

<!-- wp:paragraph -->
<p>You can do a test migration of a single site&nbsp;<g class="gr_ gr_16 gr-alert gr_gramm gr_inline_cards gr_run_anim Style multiReplace" id="16" data-gr-id="16">with </g><code>./migrate.sh &lt;site-name&gt;&nbsp;--remote-host=&lt;new-server-ip&gt;</code><g class="gr_ gr_16 gr-alert gr_gramm gr_inline_cards gr_disable_anim_appear Style multiReplace" id="16" data-gr-id="16"> first</g>&nbsp;followed by rest of the sites&nbsp;using<g class="gr_ gr_5 gr-alert gr_gramm gr_inline_cards gr_run_anim Style multiReplace" id="5" data-gr-id="5">&nbsp;</g><code>./migrate.sh --all --remote-host=&lt;new-server-ip&gt;</code><g class="gr_ gr_5 gr-alert gr_gramm gr_inline_cards gr_disable_anim_appear Style multiReplace" id="5" data-gr-id="5">.</g>&nbsp;</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>The migration script tracks sites which are already migrated and only migrate sites that haven't been previously migrated.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>After all the sites will be migrated, the script will display an entry that you will need to add in<code>/etc/hosts</code>&nbsp;of your local machine to test that the sites are working. </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>It's recommended to open sites in incognito/private window to ensure that sites aren't being served from browser cache.&nbsp;</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>After ensuring that the sites are working, You can manually update the DNS entries of all sites and point them to new server.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Cleanup</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Finally, if all goes well, you need delete v3 site's data after migration manually. This is avoid accidental data loss.</p>
<!-- /wp:paragraph -->