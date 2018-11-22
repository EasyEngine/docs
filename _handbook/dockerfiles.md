---
ID: 142671
post_title: List of Dockerfiles
author: Rahul Bansal
post_excerpt: ""
layout: handbook
permalink: >
  https://easyengine.io/handbook/internal/dockerfiles/
published: true
post_date: 2018-11-20 20:47:15
---
<!-- wp:paragraph -->
<p>Following is the list of Docker images that are maintained by EasyEngine team:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul><li><a href="#easyengine/nginx-proxy">easyengine/nginx-proxy</a></li><li><a href="#easyengine/nginx">easyengine/nginx</a></li><li><a href="#easyengine/php">easyengine/php</a></li><li><a href="#easyengine/mariadb">easyengine/mariadb</a></li><li><a href="#easyengine/redis">easyengine/redis</a></li><li><a href="#easyengine/postfix">easyengine/postfix</a></li><li><a href="#easyengine/mailhog">easyengine/mailhog</a></li><li><a href="#easyengine/cron">easyengine/cron</a></li></ul>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>easyengine/nginx-proxy</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>It is a fork of <a href="https://github.com/jwilder/nginx-proxy">jwilder/nginx-proxy</a> that routes request to individual site's nginx containers. We've modified nginx-proxy's go template used to generate config to support some changes that EasyEngine needed such as -</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul><li><a href="https://github.com/jwilder/nginx-proxy/pull/1083">Allow routing based on path instead of just host</a></li><li>Change Basic Auth file structure to support authentication only on admin-tools vs entire site.</li><li>Add IP whitelisting support using nginx allow module</li></ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p><strong>Note:</strong> SSL is terminated at nginx-proxy.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>easyengine/nginx</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Every site will have it's own nginx container. They will be created from this image.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Previously we used to manage our own nginx build. But in v4, we've decided to use <a href="https://openresty.org/en/">openresty</a> since it has all the nginx modules we need.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>easyengine/php</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>It runs PHP process and has other utilities such as WP-CLI.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>The <a href="https://easyengine.io/handbook/php-modules/">list of php modules</a> is here.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>easyengine/mariadb</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Mariadb database container.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>easyengine/redis</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Redis is used for full page caching and WordPress object caching.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>easyengine/postfix</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Postfix is used to send emails. We highly recommend you to use external email sending service such as Amazon SES on sites where emails are critical such as e-commerce sites. </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>For Amazon SES, you can use  <a href="https://github.com/humanmade/aws-ses-wp-mail">aws-ses-wp-mail</a> plugin.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Postfix is not necessary and could be disabled in such case. The feature to disable postfix will be available in future EasyEngine releases. </p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>easyengine/mailhog</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Mailhog serves as a mailcatcher utility when you do not want your mail to go out of your server. This is desirable in dev/test environment.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>If you have <a href="https://github.com/EasyEngine/docs/blob/master/commands/mailhog/enable.md#ee-mailhog-enable">enabled mailhog</a>, postfix will send emails to mailhog.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>easyengine/cron</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>It is used to manage crons in EasyEngine. Uses <a href="https://github.com/mcuadros/ofelia/">ofelia</a> to schedule crons.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><a href="https://github.com/EasyEngine/docs/blob/master/commands/cron/create.md#ee-cron-create">Here</a> is documentation on how to add cron.</p>
<!-- /wp:paragraph -->