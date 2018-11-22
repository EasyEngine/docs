---
ID: 71743
post_title: Remove Web Packages
author: Dinesh Jain
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/docs/commands/stack/remove-web-packages/
published: true
post_date: 2014-09-24 12:23:18
---
```bash
ee stack remove
# Another way
ee system remove web
```
Sample output:
```bash
^_^[root@example.com:~]# ee stack remove
remove nginx-custom package, please wait...
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
Successfully removed all packages
```
Above command removes all packages installed by `ee stack install`

If you are thinking removing all packages is not suitable for you, can remove single packages by using following commands:

#### **<a title="Remove NGINX" href="http://nginx.org/" target="_blank">Remove NGINX</a>**
```bash
ee stack remove nginx
# Deprecated way
ee system remove nginx
```

#### **<a title="Remove PHP" href="https://php.net/" target="_blank">Remove PHP</a>**
```bash
ee stack remove php
# Deprecated way
ee system remove php
```

#### **<a title="Remove MySQL" href="http://www.mysql.com/" target="_blank">Remove MySQL</a>**
```bash
ee stack remove mysql
# Deprecated way
ee system remove mysql
```
#### **<a title="Remove Postfix" href="http://www.postfix.org/" target="_blank">Remove Postfix</a>**
```bash
ee stack remove postfix
# Deprecated way
ee system remove postfix
```
#### **<a title="Remove WP-CLI" href="https://github.com/wp-cli/wp-cli" target="_blank">Remove WP-CLI</a>**

```bash
ee stack remove wpcli
# Deprecated way
ee system remove wpcli
```
#### **<a title="Remove Adminer" href="http://www.adminer.org/" target="_blank">Remove Adminer</a>**

```bash
ee stack remove adminer
# Deprecated way
ee system remove adminer
```
#### **<a title="Remove phpMyAdmin" href="http://www.phpmyadmin.net/" target="_blank">Remove phpMyAdmin</a>**
```bash
ee stack remove phpMyAdmin
# Deprecated way
ee system remove phpmyadmin
```
#### **<a title="Remove Utilities" href="https://github.com/rtCamp/easyengine/wiki/Stack-Remove#remove-utilities" target="_blank">Remove Utilities</a>**

Below command remove phpMemcachedAdmin, FastCGI cleanup script, OPcache, Webgrind, Anemometer.
```bash
ee stack remove utils
# Deprecated way
ee system remove utils
```