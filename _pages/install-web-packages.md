---
ID: 71716
post_title: Install Web Packages
author: Dinesh Jain
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/docs/commands/stack/install-web-packages/
published: true
post_date: 2014-09-24 12:12:29
---
#### **Install web packages:**
```bash
ee stack install
# Another way
ee stack install web
```
Sample output:
```bash
^_^[root@example.com:~]# ee stack install
Adding rtCamp NGINX launchpad repository, please wait...
Adding Ondrej PHP5 launchpad repository, please wait...
Executing apt-get update, please wait...
Installing nginx-custom, please wait...
Reading package lists...
Building dependency tree...
Reading state information...
The following extra packages will be installed:
libxslt1.1 nginx-common
The following NEW packages will be installed:
libxslt1.1 nginx-common nginx-custom
0 upgraded, 3 newly installed, 0 to remove and 78 not upgraded.
Need to get 595 kB of archives.
After this operation, 1,692 kB of additional disk space will be used.
[...]
.
.
.
[...]
Setting up NGINX, please wait...
Generating SSL private key
Generating a certificate signing request (CSR)
Removing pass phrase from SSL private key
Generating SSL certificate
Setting up PHP5, please wait...
Setting up MySQL, please wait...
Executing service nginx restart, please wait...
Executing service php5-fpm restart, please wait...
Executing service mysql restart, please wait...
Git commit on /etc/nginx/, please wait...
Git commit on /etc/php5/, please wait...
Git commit on /etc/mysql/, please wait...
Git commit on /etc/postfix, please wait...
Downloading Adminer, please wait...
Downloading phpMyAdmin, please wait...
Downloading WP-CLI, please wait...
Installing phpMemcachedAdmin, please wait...
Downloading nginx FastCGI cleanup script, please wait...
Downloading OPcache, please wait...
Cloning Webgrind, please wait...
Cloning Anemometer, please wait...
Successfully installed web packages
Create your first WordPress site powered by NGINX using:
ee site create example.com --wp
```
Above command install all the require packages, now you can create your site using <a title="Site Module" href="https://rtcamp.com/easyengine/docs/commands/site/">Site Module</a>.

_NOTE: By default EasyEngine set `easyengine:easyengine` as HTTP authentication_

<em>Refer: <a href="https://rtcamp.com/easyengine/docs/commands/ee-secure/#changing-http-authentication-credentials">How to change HTTP Authentication</a></em>

If you are thinking installing all packages is not suitable for you, can install single packages by using following commands:

#### **<a title="Install NGINX" href="http://nginx.org/" target="_blank">Install NGINX</a>**
```bash
ee stack install nginx
# Deprecated way
ee system install nginx
```
_NOTE: By default EasyEngine set `easyengine:easyengine` as HTTP authentication_

<em>Refer: <a href="https://rtcamp.com/easyengine/docs/commands/ee-secure/#changing-http-authentication-credentials">How to change HTTP Authentication</a></em>

#### **<a title="Install PHP" href="https://php.net/" target="_blank">Install PHP</a>**
```bash
ee stack install php
# Deprecated way
ee system install php
```

#### **<a title="Install MySQL" href="http://www.mysql.com/" target="_blank">Install MySQL</a>**

```bash
ee stack install mysql
# Deprecated way
ee system install mysql
```
#### **<a title="Install Postfix" href="http://www.postfix.org/" target="_blank">Install Postfix</a>**

```bash
ee stack install postfix
# Deprecated way
ee system install postfix
```
#### **<a title="Install WP-CLI" href="https://github.com/wp-cli/wp-cli" target="_blank">Install WP-CLI</a>**

```bash
ee stack install wpcli
# Deprecated way
ee system install wpcli
```
#### **<a title="Install Adminer" href="http://www.adminer.org/" target="_blank">Install Adminer</a>**

```bash
ee stack install adminer
# Deprecated way
ee system install adminer
```
#### **<a title="Install phpMyAdmin" href="http://www.phpmyadmin.net/" target="_blank">Install phpMyAdmin</a>**
```bash
ee stack install phpMyAdmin
# Deprecated way
ee system install phpmyadmin
```
#### **<a title="Install Utilites" href="https://github.com/rtCamp/easyengine/wiki/Install-Web-Packages#install-utilities" target="_blank">Install Utilities</a>**

Below command installs phpMemcachedAdmin, FastCGI cleanup script, OPcache, Webgrind, Anemometer.
```bash
ee stack install utils
# Deprecated way
ee system install utils
```