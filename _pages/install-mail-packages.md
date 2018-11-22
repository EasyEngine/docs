---
ID: 71732
post_title: Install Mail Packages
author: Dinesh Jain
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/docs/commands/stack/install-mail-packages/
published: true
post_date: 2014-09-24 12:15:01
---
_Note: Recomened RAM for Mail Package installation is minimum 1GB_
```bash
ee stack install mail
```
Sample output:
```bash
^_^[root@example.com:~]# ee stack install mail
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
Configure ViMbAdmin:	https://example.com:22222/vimbadmin
Security Salt:			UpRBT4LLJwfFcZTNOg0CJkDeJSnSLPYsUylCFzrILcoAreOPRhVwqqipjTCltOBw

Successfully installed mail server packages
```
Above command install all the require packages for mail server.


### **ViMbAdmin Setup**

Now you need to complete ViMbAdmin setup by accessing following url
```bash
https://example.com:22222/vimbadmin
```
and Copy Security salt from terminal to browser
```bash
Security Salt:			UpRBT4LLJwfFcZTNOg0CJkDeJSnSLPYsUylCFzrILcoAreOPRhVwqqipjTCltOBw
```
Paste that into webpage and click on `activate my account`

![ViMbAdmin Setup](https://cloud.githubusercontent.com/assets/1296181/4111570/443e89ac-320c-11e4-9cab-bda0e8e5ce0f.png)

Now you can create virtual domains and mailboxes in your mail server.

_NOTE: If you are getting this error: `Fatal error: session_start(): Failed to initialize storage module: memcache` then to resolve this use this [FAQ](https://github.com/rtCamp/easyengine/wiki/FAQ#resolving-vimbadmin-memcache-glitch)_

### **Accessing roundcube**
Webmail can be accessed using
```bash
http://webmail.example.com
```

![RoundCube](https://cloud.githubusercontent.com/assets/1296181/4111600/ef35f7f0-320c-11e4-805b-f762639183d1.png)

### **Setting Up Oragnization Identity**
```bash
vim /var/www/22222/htdocs/vimbadmin/application/configs/application.ini +250
```
Now set the following details as per your Organization:

```bash
;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
;;
;; Identity

identity.orgname  = &quot;Example Limited&quot;
identity.name  = &quot;Example Support Team&quot;
identity.email = &quot;support@example.com&quot;
identity.autobot.name  = &quot;ViMbAdmin Autobot&quot;
identity.autobot.email = &quot;autobot@example.com&quot;
identity.mailer.name   = &quot;ViMbAdmin Autobot&quot;
identity.mailer.email  = &quot;do-not-reply@example.com&quot;

identity.sitename = &quot;ViMbAdmin&quot;
identity.siteurl = &quot;https://www.example.com/vimbadmin/&quot;


;;
;; All mail and correspondence will come from the following;;

server.email.name = &quot;ViMbAdmin Administrator&quot;
server.email.address = &quot;support@example.com&quot;
```