---
ID: 142669
post_title: Manage Cron Jobs
author: Rahul Bansal
post_excerpt: ""
layout: handbook
permalink: https://easyengine.io/handbook/cron/
published: true
post_date: 2018-11-20 20:46:12
---
<!-- wp:paragraph -->
<p>Most of EasyEngine v4's server stack is on Docker containers. Running cron in containers is not as straightforward as it's on a linux server. There are many caveats that you have to take care of in order to ensure cron executes as it's intended and has no side effects.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Hence, EasyEngine v4 uses <a href="https://github.com/mcuadros/ofelia">Ofelia</a> to schedule and run cron. Ofelia runs in a separate container and it schedules all cron jobs according to a config. It also ensures that a second occurance of a particular cron job won't start if the earlier one has not ended - something we found quite useful. </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>When Ofelia has to execute the cron, it runs the command into the target container similar to how we execute commands in container with <code>docker exec</code>.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Adding your cron jobs</h2>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<h3>Adding cron on a site</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>If you want to add cron to a site, use:</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>ee cron create example.com --command='wp core verify-checksums' --schedule='@daily'</code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p>The above command runs the given command in the site's PHP container daily at midnight.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>The <code>schedule</code> parameter also supports linux cron syntax. If you are not comfortable with cron syntax, you may find <a href="https://crontab.guru/">this site helpful</a>.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>To checkout the syntax supported by schedule parameter, run <code>ee cron create --help</code>.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>By default the command executes with the user used to start the container. So in case of PHP container it is <code>www-data</code>. </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>If you want to run the cron with another user i.e. root, then you can pass <code>--user=example</code> parameter to it.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Adding cron on host </h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>You can even use EasyEngine to run crons on host! In fact, it is recommended to do so. </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Primary reason being that you don't want some cron jobs to run from EE (Ofelia) and some through traditional crontab as tracking and managing them might become a bit cumbersome when you have lots of cron to manage.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>To run cron on host, use:</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>ee cron create host --command='~/backup.sh' --schedule='@daily'</code></pre>
<!-- /wp:code -->