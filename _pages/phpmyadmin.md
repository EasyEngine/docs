---
ID: 40392
post_title: Installing PhpMyAdmin Quickly
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/php/phpmyadmin/
published: true
post_date: 2013-06-21 18:03:48
---
EasyEngine users can install phpMyAdmin quickly with command
<pre class="no-highlight">ee stack install --phpmyadmin
</pre>
Since phpMyAdmin does not ship with all the dependancies anymore, you will have install the dependancies manually with the following commands.

Note that you will have to <a href="https://easyengine.io/tutorials/composer-wordpress/getting-started/">install Composer</a> for these commands to work.
<pre class="no-highlight">cd /var/www/22222/htdocs/db/pma/
composer install --no-dev</pre>
Non EasyEngine Users will have to follow below steps.
<h3>Installing PhpMyAdmin in a subdirectory</h3>
Assuming <code>example.com</code> site has PHP support enabled.

Run following commands:
<pre class="no-highlight">cd /var/www/example.com/htdocs/
git clone https://github.com/phpmyadmin/phpmyadmin.git phpmyadmin 
cd phpmyadmin
composer update --no-dev
</pre>
It will install latest PhpMyAdmin which can be accessed from <a href="http://example.com/phpmyadmin">http://example.com/phpmyadmin</a>
<h3>Installing PhpMyAdmin on a separate subdomain</h3>
You need to first create a site like <code>mysql.example.com</code> site with PHP support. You can use this tutorial to create a virtual-host with PHP support. Just skip WordPress downloading and database setup part.

Then, run following commands:

Run following commands:
<pre class="no-highlight">cd /var/www/example.com/htdocs/
git clone https://github.com/phpmyadmin/phpmyadmin.git .
composer update --no-dev
</pre>
This will install latest phpMyAdmin which can be accessed from <a href="http://mysql.example.com/">http://mysql.example.com/</a>