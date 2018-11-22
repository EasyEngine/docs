---
ID: 133597
post_title: EasyEngine PHP7 Document
author: Harshad Yeola
post_excerpt: ""
layout: page
permalink: https://easyengine.io/docs/php7/
published: true
post_date: 2016-02-24 15:25:03
---
EasyEngine v3.5.0  and future versions now supports PHP7.  Support for PHP7 has been added in EasyEngine for the Ubuntu 14.04 (Trusty) version only. Hence following commands will work only on Ubuntu 14.04 (Trusty).

<strong>Note </strong>that while updating EasyEngine v3.5.0 you will get PHP version 5.6 as a default PHP stack. You can run your site on PHP 5.6 or PHP 7.0 as described in below commands.

For existing EasyEngine Users please use following command to upgrade your EasyEngine for this feature.
<pre>ee update</pre>
<h2>Install PHP7 stack</h2>
You can use following command for installing php7 stack on your server.
<pre>ee stack install --php7</pre>
<h2>Create Site<strong> </strong></h2>
You can create site with following command and it will install PHP7 stack runtime.
<pre>ee site create example.com --wp --php7</pre>
<h2>Switch PHP version on your site</h2>
To update existing site to PHP7 use following command
<pre>ee site update example.com --php7</pre>
To revert your site from php7 stack use following command:
<pre>ee site update example.com --php7=off</pre>
<h2>Get Information about your site</h2>
Following command shows PHP version you are using on your site.
<pre>ee site info example.com</pre>
<strong>Output:</strong>
<pre>root@test:~# ee site info example.com
Information about example.com:

Nginx configuration     wp wpredis (enabled) 
PHP Version             7.0
Pagespeed               disabled
HHVM                    disabled
SSL                     disabled

[...]</pre>
<strong>Get PHP7 Stack Information :</strong>
<pre>ee info --php7</pre>
<h2><strong>Operating PHP7 Service</strong></h2>
Use following commands to operate PHP7 service.
<pre>ee stack [start|stop|reload|restart|status] --php7</pre>
<h2><strong>Remove/Purge PHP7 Stack</strong></h2>
To Remove PHP7 Stack use following command.
<pre>ee stack [remove|purge] --php7</pre>