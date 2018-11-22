---
ID: 14707
post_title: Checking if PHP/WordPress can send mails
author: Rahul Bansal
post_excerpt: >
  If you are not receiving email
  notifications from your WordPress, its
  time to check if your PHP setup and
  WordPress can send emails.
layout: page
permalink: >
  https://easyengine.io/tutorials/php/test-email-sending/
published: true
post_date: 2012-09-25 18:49:59
---
<a href="https://easyengine.io/series/wordpress-nginx-tutorials/"><img class="alignright size-full wp-image-8712" title="WordPress-NGinx" src="https://easyengine.io/wp-content/uploads/2009/03/NGinx.jpg" alt="" width="220" height="91" /></a>WordPress has grown from a blogging platform to become a highly efficient CMS. Chances are high that you are using a contact form on your WordPress. Imagine if a prospective client fills up your contact form but WordPress fails to send you an email notification!

If you are facing problems like these, you should do the following:
<h4>First check if PHP-scripts can send emails</h4>
<pre>php -a
mail ('you@example.com', "Test Postfix", "Test mail from postfix");
exit ();</pre>
Note: if after running <code>php -a</code>, you get <code>"Interactive mode enabled"</code> message but no <code>php&gt;</code> prompt, then your PHP is not compiled with readline support. If its working nice, you will get only <code>"Interactive mode"</code> message with <code>php&gt;</code> prompt.

You can still run test though. Just create a <code>testmail.php</code> with following lines of codes:
<pre>&lt;?php
    mail ('you@example.com', "Test Postfix", "Test mail from postfix");
?&gt;</pre>
and run it on your server with <code>php -f testmail.php</code> command. If you can't see any email form PHP, then that means its PHP's fault.

Check value of <code>sendmail_path</code> in php.ini config. If its wrong, fix it and run above test again.
<div>If PHP can send mails, but WordPress cannot, its better to test WordPress.</div>
<div>
<h4>Check if WordPress can send emails</h4>
</div>
Testing WordPress is easy. You can do it using <a href="http://wordpress.org/extend/plugins/check-email/">this plugin</a>. I know that plugin is not updated from 2 years but I tested it with WordPress 3.4 without any issue. Its a simple plugin so chances are very less that it will break in future as well! ;-)

Now if in your test you can send emails but still facing issues with contact form, its better to check your plugins then. Mostly likely it will be some coding issue.