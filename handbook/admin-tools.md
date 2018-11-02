# Admin Tools in EasyEngine v4

In EasyEngine v4, we have support for following tools to help site administrators. These admin-tools needs to be enabled/disabled per site:

 * [opcache-gui](#opcache-gui)
 * [phpinfo](#phpinfo)
 * [phpMyAdmin](#phpMyAdmin)
 * [phpRedisAdmin](#phpRedisAdmin)
 * [MailHog](#MailHog)

## Usage
In order to use the admin-tools, you must first enable them using 
```bash
ee admin-tools enable example.com
```

By default, we enable auth on admin-tools. To view username/password with which you can login, run
```bash
ee auth list global
```

Then navigate to `example.com/ee-admin/` in browser. That's you'll see a list of admin-tools there. 

## opcache-gui
[opcache-gui](https://github.com/amnuts/opcache-gui) helps you visualize zend opcache statistics. It showes statistics, settings,cached files, and provide real-time update on information.

## phpinfo
It is a simple php script with a `phpinfo()` call so you can view information on php like with how many modules it was compiled with and inspect php configuration values. 

## phpMyAdmin
[phpMyAdmin](https://www.phpmyadmin.net) gives you a GUI to ineract with your database.

On the login screen, you need to add credentials. You can find the credentials by typing 
```bash
ee site info example.com
+--------------------+--------------------------------+
| Site               | https://example.com            |
+--------------------+--------------------------------+
| Access admin-tools | https://example.com/ee-admin/  |
+--------------------+--------------------------------+
| Site Title         | example.com                    |
+--------------------+--------------------------------+
| WordPress Username | example.com-K8FzH              |
+--------------------+--------------------------------+
| WordPress Password | q27eGm5pYRe2                   |
+--------------------+--------------------------------+
| DB Host            | global-db                      |
+--------------------+--------------------------------+
| DB Name            | example_com                    |
+--------------------+--------------------------------+
| DB User            | example.com-c1O1a7             |
+--------------------+--------------------------------+
| DB Password        | dg5T9GNhr4Ah                   |
+--------------------+--------------------------------+
| E-Mail             | admin@example.com              |
+--------------------+--------------------------------+
| SSL                | Enabled                        |
+--------------------+--------------------------------+
| SSL Wildcard       | No                             |
+--------------------+--------------------------------+
| Cache              | None                           |
+--------------------+--------------------------------+
```

So in this case, 
Server would be `global-db`. 
Username would be `example.com-c1O1a7`. 
Password would be `dg5T9GNhr4Ah`.

## phpRedisAdmin
[phpRedisAdmin](https://github.com/erikdubbelboer/phpRedisAdmin) gives you a GUI to ineract with Redis.

You can easily view cached keys and their values and also modify or delete the cached content.

In EasyEngine v4, we've set different key prefix for page and object cache. So it will be easy to inspect/flush them seperatly.

## MailHog
[MailHog](https://github.com/mailhog/MailHog) is a mailcatcher utility that displays emails sent by your application in browser.

To use mailhog, first of all, you'll have to enable it:

```
ee mailhog enable example.com
```

Then open `example.com/ee-admin/mailhog` in browser. Also please remember to disable mailhog after it's need is over or your site will not be able to send emails.

Please note mailhog should only be enabled only on development sites and not on production.
