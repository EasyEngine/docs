# Emails in EasyEngine

EasyEngine v4 has support for sending emails out of the box just like v3 had, but it does not have support for receiving incoming emails. This was done as maintaining a mailserver is a challenging task, both for site administrators and EasyEngine developers. If you really want a mail server, we recommend using managed email service provider like [Gmail for work](https://gsuite.google.co.in/intl/en_in/products/gmail/) or [Rackspace](https://www.rackspace.com/en-in/email-hosting/).

## Sending Emails in EasyEngine

All PHP and WordPress sites in EasyEngine come with [Postfix](http://www.postfix.org/) configured to send emails. So by out of the box, for any site, PHP's [mail()](http://php.net/manual/en/function.mail.php) or WordPress's [wp_mail()](https://developer.wordpress.org/reference/functions/wp_mail/) function should work.

To test if mails sending are working on a site, run - 
```
ee shell example.com

# For WordPress site
wp eval 'echo wp_mail("your-email@example.com","Hello Human","Hello from EasyEngine!");'

# For PHP site
php -r 'mail("your-email@example.com", "Hello Human", "Hello from EasyEngine!");'
```

## Mailhog

Sometimes you want to check if email is being sent by PHP script, or sometimes you don't want your email to go out of your server i.e on a development or staging site. In such case, you can [enable mailhog](https://github.com/EasyEngine/docs/blob/master/commands/mailhog/enable.md) on the site.

When you enable Mailhog, Postfix sends all the outgoing emails to Mailhog instead of sending them to actual mail server.

After enabling mailhog, go to `example.com/ee-admin/mailhog`. Here you will see all the mail that your application has sent.

![mailhog screen](https://user-images.githubusercontent.com/8456197/48132429-7edc6400-e2b9-11e8-919e-08c20bfe9366.png)

:warning: If you're using mailhog in production, don't forget to turn it off.
:warning: Emails sent through SMTP will still be sent to actual mail servers. Only emails sent through PHP's mail function will be catched by mailhog.

## Using AWS SES or other email service

If you want to use external service for sending emails, Postfix is not needed and can be disabled. However command to disable Postfix is not yet in EasyEngine. It will be available in future release. You can track it's progress [here](https://github.com/EasyEngine/easyengine/issues/1276).

If you are going to use AWS SES with WordPress, we recommend using Delicious brain's [wp-ses](https://wordpress.org/plugins/wp-ses/) or Human Made's [aws-ses-wp-mail](https://github.com/humanmade/aws-ses-wp-mail).