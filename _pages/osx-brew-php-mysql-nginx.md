---
ID: 39849
post_title: 'Brew&#8217;ing PHP, MySQL &#038; Nginx on Mac OS X'
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/mac/osx-brew-php-mysql-nginx/
published: true
post_date: 2013-06-13 15:26:03
---
There are many ways to install PHP, MySQL &amp; Nginx on Mac. Here we will be doing it using <a href="http://brew.sh/">brew</a>.
<h2>Installing PHP 5.4 (with FPM) on Mac OS X</h2>
Search for available PHP formulas <em>(formula's in homebrews are equivalent to packages in aptitude)</em>
<pre class="no-highlight">brew search php</pre>
It will return long list of php 5.2, 5.3, 5.4 packages. We need 5.4. Tap it using:
<pre class="no-highlight">brew tap josegonzalez/php
brew tap homebrew/dupes</pre>
<p class="rtp-error">If you do not tap <code>homebrew/dupes</code> you will get Error: No available formula for zlib</p>
Before we build PHP 5.4, you may like to exercise options using:
<pre class="no-highlight">brew options php54</pre>
We have built it using:
<pre class="no-highlight">brew install php54 --with-fpm  --with-imap  --without-apache --with-debug</pre>
After long wait, you can verify php &amp; php-fpm version using <code>php -v</code> and <code>php-fpm -v</code> respectively.
<h4>Adding PHP-FPM to startup routine</h4>
Please check exact plist filename in <code>/usr/local/Cellar/php54/</code>
<pre>cp /usr/local/Cellar/php54/5.4.15/homebrew-php.josegonzalez.php54.plist ~/Library/LaunchAgents/</pre>
To Start PHP-FPM:
<pre>launchctl load -w ~/Library/LaunchAgents/homebrew-php.josegonzalez.php54.plist</pre>
To Stop PHP-FPM
<pre>launchctl unload -w ~/Library/LaunchAgents/homebrew-php.josegonzalez.php54.plist</pre>
<h2>Installing MySQL on Mac OS X</h2>
Run following command:
<pre class="no-highlight">brew install mysql --enable-debug</pre>
In case you need mysql-workbench, please download it from <a href="http://www.mysql.com/products/workbench/">here</a>. It cannot be installed via brew.
<h3>Adding MySQL to startup routine</h3>
Please check exact plist filename in <code>/usr/local/Cellar/mysql/</code>
<pre>cp /usr/local/Cellar/mysql/5.6.10/homebrew.mxcl.mysql.plist ~/Library/LaunchAgents/</pre>
To Start
<pre>launchctl load -w ~/Library/LaunchAgents/homebrew.mxcl.mysql.plist</pre>
To Stop
<pre>launchctl unload -w ~/Library/LaunchAgents/homebrew.mxcl.mysql.plist</pre>
<h4>Manual Start/Stop</h4>
Start mysql: <code>/usr/local/mysql/support-files/mysql.server start</code>

Stop mysql: <code>/usr/local/mysql/support-files/mysql.server stop</code>

See other options - <code>/usr/local/mysql/support-files/mysql.server -h </code>
<pre>Usage: mysql.server {start|stop|restart|reload|force-reload|status} [ MySQL server options ]</pre>
<h3>Changes to MySQL Config (optional)</h3>
<h4>For security</h4>
<div></div>
<div>Run following command to improve security of your mysql setup. It will present you wizard to set mysql root password among other things.</div>
<pre>mysql_secure_installation</pre>
<h4>For workbench</h4>
Following changes will make it easy to use MySQL WorkBench
<pre class="no-highlight">ln -s /usr/local/Cellar/mysql/5.6.10 /usr/local/mysql
sudo ln -s /usr/local/Cellar/mysql/5.6.10/my.cnf /etc/my.cnf</pre>
<h2>Installing Nginx on Mac OS X</h2>
Run following command:
<pre>brew install nginx</pre>
<h4>Adding Nginx to startup routine</h4>
Please check exact plist filename in <code>/usr/local/Cellar/mysql/</code>
<pre>cp /usr/local/Cellar/nginx/1.4.1/homebrew.mxcl.nginx.plist ~/Library/LaunchAgents/</pre>
To Start
<pre>launchctl load -w ~/Library/LaunchAgents/homebrew.mxcl.nginx.plist</pre>
To Stop
<pre>launchctl unload -w ~/Library/LaunchAgents/homebrew.mxcl.nginx.plist</pre>
<h4>Changes to Nginx Config (optional)</h4>
By default, Nginx setup expects you to define all virtual hosts in <code>/usr/local/etc/nginx/nginx.conf</code>

Edit default config file and following line to http{..} block
<pre class="no-highlight">include sites-enabled/*.conf;</pre>
<div></div>
<div>Next you can create <code>sites-available</code> and <code>sites-enabled</code> folder to manage virtual hosts config.</div>
<div></div>
<h2>Troubleshooting</h2>
<h4>Finding default location of config/error files for PHP, MySQL &amp; Nginx</h4>
I did not get any error but after getting used to Ubuntu-conventions, I struggled to find where are config/log files and other defaults are present.

3 commands below turned out to be life-saver:
<ul>
	<li>brew list nginx</li>
	<li>brew list php54</li>
	<li>brew list mysql</li>
</ul>
Brew's list command shows all files/folders created by a package. Once you see output, you will notice, why I was getting lost!

If you come across any other error, feel free to use <a href="https://easyengine.io/groups/wordpress-nginx/forum/">our support forum</a>. We will try to fix it there.

<strong>Next</strong>: <a href="https://easyengine.io/wordpress-nginx/tutorials/">Install WordPress</a>