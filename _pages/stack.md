---
ID: 44118
post_title: stack
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/docs/commands/stack/
published: true
post_date: 2013-08-08 12:11:08
---
EasyEngine(ee) Stack Module covers following operations:

### **Install Packages**

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
<h5><strong><a title="Install NGINX" href="http://nginx.org/" target="_blank" rel="noopener noreferrer">Install NGINX</a></strong></h5>
```bash

ee stack install --nginx

```

_NOTE: By default EasyEngine set `easyengine:easyengine` as HTTP authentication_

<em>Refer: <a href="https://rtcamp.com/easyengine/docs/commands/ee-secure/#changing-http-authentication-credentials">How to change HTTP Authentication</a></em>
<h5><strong><a title="Install PHP" href="https://php.net/" target="_blank" rel="noopener noreferrer">Install PHP</a></strong></h5>
```bash

ee stack install --php

# Deprecated way

ee system install php

```
<h5><strong><a title="Install MySQL" href="http://www.mysql.com/" target="_blank" rel="noopener noreferrer">Install MySQL</a></strong></h5>
```bash

ee stack install --mysql

# Deprecated way

ee system install mysql

```
<h5><strong><a title="Install Postfix" href="http://www.postfix.org/" target="_blank" rel="noopener noreferrer">Install Postfix</a></strong></h5>
```bash

ee stack install --postfix

# Deprecated way

ee system install postfix

```
<h5><strong><a title="Install WP-CLI" href="https://github.com/wp-cli/wp-cli" target="_blank" rel="noopener noreferrer">Install WP-CLI</a></strong></h5>
```bash

ee stack install --wpcli

# Deprecated way

ee system install wpcli

```
<h5><strong><a title="Install Adminer" href="http://www.adminer.org/" target="_blank" rel="noopener noreferrer">Install Adminer</a></strong></h5>
```bash

ee stack install --adminer

# Deprecated way

ee system install adminer

```
<h5><strong><a title="Install phpMyAdmin" href="http://www.phpmyadmin.net/" target="_blank" rel="noopener noreferrer">Install phpMyAdmin</a></strong></h5>
```bash

ee stack install --phpmyadmin

# Deprecated way

ee system install phpmyadmin

```
<h5><strong><a title="Install Utilites" href="https://github.com/rtCamp/easyengine/wiki/Install-Web-Packages#install-utilities" target="_blank" rel="noopener noreferrer">Install Utilities</a></strong></h5>
Below command installs phpMemcachedAdmin, FastCGI cleanup script, OPcache, Webgrind, Anemometer.

```bash

ee stack install --utils

# Deprecated way

ee system install utils

```

#### **Install Mail Packages:**

_Note: Recomened RAM for Mail Package installation is minimum 1GB_

```bash

ee stack install --mail

```

Sample output:

```bash

^_^[root@example.com:~]# ee stack install --mail

Installing Dovecot, please wait...

Reading package lists...

Building dependency tree...

Reading state information...

Suggested packages:

ntp dovecot-gssapi dovecot-pgsql dovecot-sqlite dovecot-ldap dovecot-solr

ufw

The following NEW packages will be installed:

dovecot-core dovecot-imapd dovecot-lmtpd dovecot-managesieved dovecot-mysql

dovecot-pop3d dovecot-sieve

0 upgraded, 7 newly installed, 0 to remove and 106 not upgraded.

Need to get 2,437 kB of archives.

After this operation, 7,370 kB of additional disk space will be used.

[...]

.

.

.

[...]

Setting up Postfix, please wait...

Generating self signed certificate for Postfix, please wait...

Setting up Dovecot, please wait...

Generating self signed certificate for Dovecot, please wait...

Setting up Amavis, please wait...

Setting up ViMbAdmin, please wait...

Setting up Roundcube, please wait...

Setting up Sieve rules, please wait...

Executing service nginx restart, please wait...

Executing service postfix restart, please wait...

Executing service dovecot restart, please wait...

Executing service amavis restart, please wait...

Git commit on /etc/nginx, please wait...

Git commit on /etc/postfix, please wait...

Git commit on /etc/dovecot, please wait...

Git commit on /etc/amavis, please wait...

Configure ViMbAdmin: https://example.com:22222/vimbadmin

Security Salt: UpRBT4LLJwfFcZTNOg0CJkDeJSnSLPYsUylCFzrILcoAreOPRhVwqqipjTCltOBw

Successfully installed mail server packages

```

Above command install all the require packages for mail server.
&lt;h5&gt;&lt;strong&gt;ViMbAdmin Setup&lt;/strong&gt;&lt;/h5&gt;
Now you need to complete ViMbAdmin setup by accessing following url

```bash

https://example.com:22222/vimbadmin

```

and Copy Security salt from terminal to browser

```bash

Security Salt: UpRBT4LLJwfFcZTNOg0CJkDeJSnSLPYsUylCFzrILcoAreOPRhVwqqipjTCltOBw

```

Paste that into webpage and click on `activate my account`

![ViMbAdmin Setup](https://cloud.githubusercontent.com/assets/1296181/4111570/443e89ac-320c-11e4-9cab-bda0e8e5ce0f.png)

Now you can create virtual domains and mailboxes in your mail server.

_NOTE: If you are getting this error: `Fatal error: session_start(): Failed to initialize storage module: memcache` then to resolve this use this [FAQ](https://github.com/rtCamp/easyengine/wiki/FAQ#resolving-vimbadmin-memcache-glitch)_
<h5><strong>Accessing roundcube</strong></h5>
Webmail can be accessed using

```bash

http://webmail.example.com

```

![RoundCube](https://cloud.githubusercontent.com/assets/1296181/4111600/ef35f7f0-320c-11e4-805b-f762639183d1.png)
<h5><strong>Setting Up Organization Identity</strong></h5>
```bash

vim /var/www/22222/htdocs/vimbadmin/application/configs/application.ini +250

```

Now set the following details as per your Organization:

```bash

;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;

;;

;; Identity

identity.orgname = &quot;Example Limited&quot;

identity.name = &quot;Example Support Team&quot;

identity.email = &quot;support@example.com&quot;

identity.autobot.name = &quot;ViMbAdmin Autobot&quot;

identity.autobot.email = &quot;autobot@example.com&quot;

identity.mailer.name = &quot;ViMbAdmin Autobot&quot;

identity.mailer.email = &quot;do-not-reply@example.com&quot;

identity.sitename = &quot;ViMbAdmin&quot;

identity.siteurl = &quot;https://www.example.com/vimbadmin/&quot;

;;

;; All mail and correspondence will come from the following;;

server.email.name = &quot;ViMbAdmin Administrator&quot;

server.email.address = &quot;support@example.com&quot;

```

#### **Install All Packages:**

```bash

ee stack install --all

```

This command is combination of following two commands:

```bash

ee stack install --web

ee stack install --mail

```

***

### **Remove Packages**

#### **Remove Web Packages**

```bash
ee stack remove
# Another way
ee system remove --web
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
<h5><strong><a title="Remove NGINX" href="http://nginx.org/" target="_blank" rel="noopener noreferrer">Remove NGINX</a></strong></h5>
```bash
ee stack remove --nginx
# Deprecated way
ee system remove nginx
```
<h5><strong><a title="Remove PHP" href="https://php.net/" target="_blank" rel="noopener noreferrer">Remove PHP</a></strong></h5>
```bash
ee stack remove --php
# Deprecated way
ee system remove php
```
<h5><strong><a title="Remove MySQL" href="http://www.mysql.com/" target="_blank" rel="noopener noreferrer">Remove MySQL</a></strong></h5>
```bash
ee stack remove --mysql
# Deprecated way
ee system remove mysql
```
<h5><strong><a title="Remove Postfix" href="http://www.postfix.org/" target="_blank" rel="noopener noreferrer">Remove Postfix</a></strong></h5>
```bash
ee stack remove --postfix
# Deprecated way
ee system remove postfix
```
<h5><strong><a title="Remove WP-CLI" href="https://github.com/wp-cli/wp-cli" target="_blank" rel="noopener noreferrer">Remove WP-CLI</a></strong></h5>
```bash
ee stack remove --wpcli
# Deprecated way
ee system remove wpcli
```
<h5><strong><a title="Remove Adminer" href="http://www.adminer.org/" target="_blank" rel="noopener noreferrer">Remove Adminer</a></strong></h5>
```bash
ee stack remove --adminer
# Deprecated way
ee system remove adminer
```
<h5><strong><a title="Remove phpMyAdmin" href="http://www.phpmyadmin.net/" target="_blank" rel="noopener noreferrer">Remove phpMyAdmin</a></strong></h5>
```bash
ee stack remove --phpMyAdmin
# Deprecated way
ee system remove phpmyadmin
```
<h5><strong><a title="Remove Utilities" href="https://github.com/rtCamp/easyengine/wiki/Stack-Remove#remove-utilities" target="_blank" rel="noopener noreferrer">Remove Utilities</a></strong></h5>
Below command remove phpMemcachedAdmin, FastCGI cleanup script, OPcache, Webgrind, Anemometer.

```bash
ee stack remove --utils
# Deprecated way
ee system remove utils
```

#### **Remove Mail Packages**
```bash
ee stack remove --mail
````
This command will remove all mail server packages keeping configuration files as it.

Sample output:
```bash
^_^[root@example.com:~]# ee stack remove --mail
remove Dovecot package, please wait...
Reading package lists...
Building dependency tree...
Reading state information...
The following packages will be REMOVED:
dovecot-core dovecot-imapd dovecot-lmtpd dovecot-managesieved dovecot-mysql
dovecot-pop3d dovecot-sieve
0 upgraded, 0 newly installed, 7 to remove and 59 not upgraded.
After this operation, 11.7 MB disk space will be freed.
[...]
.
.
[...]
Removing Roundcube dependencies, please wait...
Removing Roundcube, please wait...
Removing unwanted packages, please wait...
[...]
.
.
[...]
Removing libunix-syslog-perl (1.1-2build5) ...
Removing pax (1:20120606-2+deb7u1) ...
Removing re2c (0.13.5-1build2) ...
Removing spamc (3.4.0-1ubuntu1) ...
Removing librpm3 (4.11.1-3) ...
Removing librpmio3 (4.11.1-3) ...
Removing liblua5.2-0:amd64 (5.2.3-1) ...
Removing libnss3:amd64 (2:3.15.4-1ubuntu7) ...
Removing libnss3-nssdb (2:3.15.4-1ubuntu7) ...
Removing libnspr4:amd64 (2:4.10.2-1ubuntu1.1) ...
Processing triggers for man-db (2.6.7.1-1) ...
Processing triggers for libc-bin (2.19-0ubuntu6) ...
Successfully removed mail server packages
```

#### **Remove All packages**
```bash
ee stack remove --all
```
This command is combination of following two commands:
```bash
ee stack remove --web
ee stack remove --mail
```
***

### **Purge Packages**
#### **Purge Web Packages:**
```bash
ee stack purge
# Another way
ee stack purge --web
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
<h5><strong><a title="Purge NGINX" href="http://nginx.org/" target="_blank" rel="noopener noreferrer">Purge NGINX</a></strong></h5>
```bash
ee stack purge --nginx
# Deprecated way
ee system purge nginx
```
<h5><strong><a title="Purge PHP" href="https://php.net/" target="_blank" rel="noopener noreferrer">Purge PHP</a></strong></h5>
```bash
ee stack purge --php
# Deprecated way
ee system purge php
```
<h5><strong><a title="Purge MySQL" href="http://www.mysql.com/" target="_blank" rel="noopener noreferrer">Purge MySQL</a></strong></h5>
```bash
ee stack purge --mysql
# Deprecated way
ee system purge mysql
```
<h5><strong><a title="Purge Postfix" href="http://www.postfix.org/" target="_blank" rel="noopener noreferrer">Purge Postfix</a></strong></h5>
```bash
ee stack purge --postfix
# Deprecated way
ee system purge postfix
```
<h5><strong><a title="Purge WP-CLI" href="https://github.com/wp-cli/wp-cli" target="_blank" rel="noopener noreferrer">Purge WP-CLI</a></strong></h5>
```bash
ee stack purge --wpcli
# Deprecated way
ee system purge wpcli
```
<h5><strong><a title="Purge Adminer" href="http://www.adminer.org/" target="_blank" rel="noopener noreferrer">Purge Adminer</a></strong></h5>
```bash
ee stack purge --adminer
# Deprecated way
ee system purge adminer
```
<h5><strong><a title="Purge phpMyAdmin" href="http://www.phpmyadmin.net/" target="_blank" rel="noopener noreferrer">Purge phpMyAdmin</a></strong></h5>
```bash
ee stack purge --phpMyAdmin
# Deprecated way
ee system purge phpmyadmin
```
<h5><strong><a title="Purge Utilities" href="https://github.com/rtCamp/easyengine/wiki/Stack-Purge#purge-utilities" target="_blank" rel="noopener noreferrer">Purge Utilities</a></strong></h5>
Below command remove phpMemcachedAdmin, FastCGI cleanup script, OPcache, Webgrind, Anemometer.
```bash
ee stack purge --utils
# Deprecated way
ee system purge utils
```

#### **Purge Mail Packages:**
```bash
ee stack purge --mail
```

This command will purge all mail server packages.

Sample output:
```bash
^_^[root@example.com:~]# ee stack purge --mail
purge Dovecot package, please wait...
Reading package lists...
Building dependency tree...
Reading state information...
The following packages will be REMOVED:
dovecot-core* dovecot-imapd* dovecot-lmtpd* dovecot-managesieved*
dovecot-mysql* dovecot-pop3d* dovecot-sieve*
0 upgraded, 0 newly installed, 7 to remove and 59 not upgraded.
After this operation, 11.7 MB disk space will be freed.
[...]
.
.
[...]
Processing triggers for man-db (2.6.7.1-1) ...
Removing Roundcube dependencies, please wait...
Removing Roundcube, please wait...
Removing unwanted packages, please wait...
Reading package lists...
[...]
.
.
[...]
Removing libunix-syslog-perl (1.1-2build5) ...
Removing pax (1:20120606-2+deb7u1) ...
Removing re2c (0.13.5-1build2) ...
Removing spamc (3.4.0-1ubuntu1) ...
Removing librpm3 (4.11.1-3) ...
Removing librpmio3 (4.11.1-3) ...
Removing liblua5.2-0:amd64 (5.2.3-1) ...
Removing libnss3:amd64 (2:3.15.4-1ubuntu7) ...
Removing libnss3-nssdb (2:3.15.4-1ubuntu7) ...
Removing libnspr4:amd64 (2:4.10.2-1ubuntu1.1) ...
Processing triggers for man-db (2.6.7.1-1) ...
Processing triggers for libc-bin (2.19-0ubuntu6) ...
Successfully purged mail server packages
```

#### **Purge All Packages:**
```bash
ee stack purge --all
```
This command is combination of following two commands:
```bash
ee stack purge --web
ee stack purge --mail
```
***

### **EE Stack Status**

Display important status about EasyEngine services.

```bash

ee stack status

# Deprecated way

ee system status

```

Sample Output :

```bash

^_^[root@example.com:~]# ee stack status

System information as of Mon Jul 28 17:19:41 IST 2014

System load: 0.14 Processes: 183

Usage of /: 79% Users logged in: 4

Memory usage: 74% Swap usage: 32.39%

Service status information

Nginx: Running

PHP5-FPM: Running

MySQL: Running

Postfix: Running

```

***

### **EE Stack Services**

All EasyEngine services can be operated using following commands:

#### **Start NGINX, PHP, MySQL &amp; Postfix service**

```bash

ee stack start

# Deprecated way

ee system start

```

Sample output:

```bash

^_^[root@example.com:~]# ee stack start

Executing service nginx start, please wait...

Executing service php5-fpm start, please wait...

Executing service mysql start, please wait...

Executing service postfix start, please wait...

```

#### **Stop NGINX, PHP, MySQL &amp; Postfix service**

```bash

ee stack stop

# Deprecated way

ee system stop

```

Sample output:

```bash

^_^[root@example.com:~]# ee stack stop

Executing service nginx stop, please wait...

Executing service php5-fpm stop, please wait...

Executing service mysql stop, please wait...

Executing service postfix stop, please wait...

```

#### **Reload NGINX, PHP, MySQL &amp; Postfix service**

```bash

ee stack reload

# Deprecated way

ee system reload

```

Sample output:

```bash

^_^[root@example.com:~]# ee stack reload

Executing service nginx reload, please wait...

Executing service php5-fpm reload, please wait...

Executing service mysql reload, please wait...

Executing service postfix reload, please wait...

```

#### **Restart NGINX, PHP, MySQL &amp; Postfix service**

```bash

ee stack restart

# Deprecated way

ee system restart

```

Sample output:

```bash

^_^[root@example.com:~]# ee stack restart

Executing service nginx restart, please wait...

Executing service php5-fpm restart, please wait...

Executing service mysql restart, please wait...

Executing service postfix restart, please wait...

```