---
ID: 142677
post_title: Outbound Emails
author: Rahul Bansal
post_excerpt: ""
layout: handbook
permalink: https://easyengine.io/handbook/mail/
published: true
post_date: 2018-11-21 12:53:32
---
<!-- wp:paragraph -->
<p>All PHP and WordPress sites in EasyEngine come with <a href="http://www.postfix.org/">Postfix</a> configured to send emails. So out of the box, for any site, PHP's <a href="http://php.net/manual/en/function.mail.php">mail()</a> or WordPress's <a href="https://developer.wordpress.org/reference/functions/wp_mail/">wp_mail()</a> function should work.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>To test if mails sending are working on a site, run:</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>ee shell example.com

# For WordPress site
wp eval 'echo wp_mail("your-email@example.com","Hello Human","Hello from EasyEngine!");'

# For PHP site
php -r 'mail("your-email@example.com", "Hello Human", "Hello from EasyEngine!");'</code></pre>
<!-- /wp:code -->

<!-- wp:heading -->
<h2>Mailhog</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Sometimes you want to check if email is being sent by PHP script, or sometimes you don't want your email to go out of your server i.e on a development or staging site. In such case, you can <a href="https://github.com/EasyEngine/docs/blob/master/commands/mailhog/enable.md">enable mailhog</a> on the site.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>When you enable Mailhog, Postfix sends all the outgoing emails to Mailhog instead of sending them to actual mail server.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>After enabling Mailhog, go to <code>example.com/ee-admin/mailhog</code>. Here you will see all the mail that your application has sent.</p>
<!-- /wp:paragraph -->

<!-- wp:image -->
<figure class="wp-block-image"><img src="https://user-images.githubusercontent.com/8456197/48132429-7edc6400-e2b9-11e8-919e-08c20bfe9366.png" alt="mailhog screen"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph -->
<p>⚠️&nbsp;If you're using Mailhog in production, don't forget to turn it off.<br>⚠️ Emails sent through SMTP will still be sent to actual mail servers. Only emails sent through PHP's mail function will be catched by Mailhog.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Using AWS SES or other email service</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>If you want to use external service for sending emails, Postfix is not needed and can be disabled. However command to disable Postfix is not yet in EasyEngine. It will be available in future release. You can track it's progress <a href="https://github.com/EasyEngine/easyengine/issues/1276">here</a>.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>If you are going to use AWS SES with WordPress, we recommend using Delicious brain's <a href="https://wordpress.org/plugins/wp-ses/">wp-ses</a> or Human Made's <a href="https://github.com/humanmade/aws-ses-wp-mail">aws-ses-wp-mail</a>.</p>
<!-- /wp:paragraph -->