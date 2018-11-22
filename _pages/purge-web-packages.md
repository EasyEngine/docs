---
ID: 71755
post_title: Purge Web Packages
author: Dinesh Jain
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/docs/commands/stack/purge-web-packages/
published: true
post_date: 2014-09-24 12:33:18
---
```bash
ee stack purge
# Another way
ee stack purge web
```
Sample output:
```bash
^_^[root@example.com:~]# ee stack purge
purge nginx-custom package, please wait...
Reading package lists...
Building dependency tree...
Reading state information...
The following package was automatically installed and is no longer required:
libxslt1.1
Use 'apt-get autoremove' to remove it.
The following packages will be REMOVED:
[...]
.
.
.
[...]
Removing Adminer, please wait...
Removing phpMyAdmin, please wait...
Removing WP-CLI, please wait...
Remove EasyEngine (ee) admin utilities, please wait...
Removing unwanted packages, please wait...
[...]
.
.
.
[...]
Successfully purged all packages
```
Above command removes all packages installed by `ee stack install`

If you are thinking removing all packages is not suitable for you, can remove single packages by using following commands:

#### **<a title="Purge NGINX" href="http://nginx.org/" target="_blank">Purge NGINX</a>**
```bash
ee stack purge nginx
# Deprecated way
ee system purge nginx
```

#### **<a title="Purge PHP" href="https://php.net/" target="_blank">Purge PHP</a>**
```bash
ee stack purge php
# Deprecated way
ee system purge php
```
#### **<a title="Purge MySQL" href="http://www.mysql.com/" target="_blank">Purge MySQL</a>**
```bash
ee stack purge mysql
# Deprecated way
ee system purge mysql
```
#### **<a title="Purge Postfix" href="http://www.postfix.org/" target="_blank">Purge Postfix</a>**
```bash
ee stack purge postfix
# Deprecated way
ee system purge postfix
```
#### **<a title="Purge WP-CLI" href="https://github.com/wp-cli/wp-cli" target="_blank">Purge WP-CLI</a>**

```bash
ee stack purge wpcli
# Deprecated way
ee system purge wpcli
```
#### **<a title="Purge Adminer" href="http://www.adminer.org/" target="_blank">Purge Adminer</a>**

```bash
ee stack purge adminer
# Deprecated way
ee system purge adminer
```
#### **<a title="Purge phpMyAdmin" href="http://www.phpmyadmin.net/" target="_blank">Purge phpMyAdmin</a>**
```bash
ee stack purge phpMyAdmin
# Deprecated way
ee system purge phpmyadmin
```
#### **<a title="Purge Utilities" href="https://github.com/rtCamp/easyengine/wiki/Stack-Purge#purge-utilities" target="_blank">Purge Utilities</a>**

Below command remove phpMemcachedAdmin, FastCGI cleanup script, OPcache, Webgrind, Anemometer.
```bash
ee stack purge utils
# Deprecated way
ee system purge utils
```