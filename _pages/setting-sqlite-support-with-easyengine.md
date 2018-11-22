---
ID: 133720
post_title: Setting Sqlite support with PHP
author: Gaurav
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/php/setting-sqlite-support-with-easyengine/
published: true
post_date: 2016-03-14 17:50:47
---
<h2><strong>Installing on Ubuntu 14.04 with EasyEngine 3.5+</strong></h2>
1. Update package list

<code>sudo apt-get update</code>

2. If you are using on PHP 5.6 then

<code>sudo apt-get install php5.6-sqlite3</code>

and restart service

<code>service php5.6-fpm restart</code>

If you are using PHP 7.0 then

<code>sudo apt-get install php7.0-sqlite3</code>

and restart service

<code>service php7.0-fpm restart</code>
<h2><strong>Installing on Ubuntu 12.04 /Debian 7 &amp; 8 with EasyEngine 3.5+</strong></h2>
1. Update package list

<code>sudo apt-get update</code>

2. Install PHP Sqlite package

<code>sudo apt-get install php5-sqlite</code>

3. Restart PHP5-FPM

<code>sudo service php5-fpm restart</code>