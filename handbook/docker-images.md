# Docker Images Maintained by EasyEngine Team

Following are the images that are maintained by EasyEngine team - 

 * [easyengine/nginx-proxy](#easyengine/nginx-proxy)
 * [easyengine/nginx](#easyengine/nginx)
 * [easyengine/php](#easyengine/php)
 * [easyengine/mariadb](#easyengine/mariadb)
 * [easyengine/redis](#easyengine/redis)
 * [easyengine/postfix](#easyengine/postfix)
 * [easyengine/mailhog](#easyengine/mailhog)
 * [easyengine/cron](#easyengine/cron)


## easyengine/nginx-proxy
It is a fork of [jwilder/nginx-proxy](https://github.com/jwilder/nginx-proxy) that routes request to individual site's nginx containers. We've modified go template used to generate config to support some changes that ee needed such as - 
 * [Allow routing based on path instead of just host](https://github.com/jwilder/nginx-proxy/pull/1083)
 * Change Basic Auth file structure to support auton only on admin-tools
 * Add whitelisting support using nginx allow module

## easyengine/nginx
Every site will have it's own nginx container. They will be created from this image.

Previously we used to manage our own nginx build. But in v4, we've decided to use [openresty](https://openresty.org/en/) since it has all the nginx modules we need.

## easyengine/php
It runs PHP process and has other utilities such as WP-CLI.

It has following php modules:
```
[PHP Modules]
Core
ctype
curl
date
dom
fileinfo
filter
ftp
gd
hash
iconv
imagick
json
libxml
mbstring
mcrypt
memcache
memcached
mysqli
mysqlnd
openssl
pcre
PDO
pdo_sqlite
Phar
posix
readline
redis
Reflection
session
SimpleXML
sodium
SPL
sqlite3
standard
tokenizer
xml
xmlreader
xmlwriter
Zend OPcache
zip
zlib

[Zend Modules]
Zend OPcache
```

To add more modules, checkout [instructions on php docker library's readme](https://github.com/docker-library/docs/tree/master/php#how-to-install-more-php-extensions)

## easyengine/mariadb
Mariadb database container.

## easyengine/redis
Redis is used for full page caching and WordPress object caching.

## easyengine/postfix
Postfix is used to send emails. If you want to send emails through external email service like gmail or Amazon SES, Postfix is not necessary and could be disabled. The feature to disable postfix will be available in furute EasyEngine releases.

We recommend using [Delicious Brain's plugin](https://wordpress.org/plugins/wp-ses/) if you're planning to send mail through Amazon SES

## easyengine/mailhog
Mailhog serves as a mailcatcher utility when you do not want your mail to go out of your server. 

If you have [enabled mailhog](https://github.com/EasyEngine/docs/blob/master/commands/mailhog/enable.md#ee-mailhog-enable), Postfix will send emails to mailhog instead of sending it to mailservers on internet.

## easyengine/cron
It is used to manage crons in EasyEngine. Uses [ofelia](https://github.com/mcuadros/ofelia/) to schedule crons.

[Here](https://github.com/EasyEngine/docs/blob/master/commands/cron/create.md#ee-cron-create) is documentation on how to add cron. 
