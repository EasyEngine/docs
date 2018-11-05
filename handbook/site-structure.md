# Site Filesystem Structure

All sites will be created in `/opt/easyengine/sites/` by default.

Here's how your a site's structure will look like if it's a PHP or WordPress site. HTML site won't have php-fpm and postfix directories anywhere in them.

```
.
├── app 
├── config
│   ├── nginx 
│   ├── php-fpm
│   └── postfix
├── docker-compose-admin.yml
├── docker-compose.yml
├── logs
│   ├── nginx
│   └── php-fpm
└── services
    └── postfix
```


## Site Files
Code of your site is stored in `/opt/easyengine/sites/example.com/app/htdocs`.

The only exception is - In WordPress, `wp-config.php` is placed one level up at `/opt/easyengine/sites/example.com/app/wp-config.php` for [security reasons](https://wordpress.stackexchange.com/a/74972/135772).

## Config
Config of site is stored in `/opt/easyengine/sites/example.com/config`

### NGINX
You can find site's NGINX configuration in `/opt/easyengine/sites/example.com/config/nginx`

You can put site's custom NGINX configuration in `/opt/easyengine/sites/example.com/config/nginx/custom`

### PHP
If your site uses PHP, then - 

You can find site's PHP configuration in `/opt/easyengine/sites/example.com/config/php-fpm`

You can put site's custom PHP configuration in `/opt/easyengine/sites/example.com/config/php-fpm/conf.d`

### Postfix
Postfix configuration directory is not currently mounted. The docs will be updated when it will be mounted.

## Logs
Logs of site are stored in `/opt/easyengine/sites/example.com/logs`

### NGINX
You can find site's NGINX logs in `/opt/easyengine/sites/example.com/logs/nginx`

### PHP
You can find site's PHP logs in `/opt/easyengine/sites/example.com/logs/php-fpm`