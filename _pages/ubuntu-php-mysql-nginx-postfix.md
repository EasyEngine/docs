---
ID: 10456
post_title: >
  PHP 5.5, MySQL, Postfix, Nginx and
  WordPress on Ubuntu
author: Rahul Bansal
post_excerpt: "Installing PHP 5.5, Percona MySQL 5.6, Nginx, Postfix using launchpad repos on Ubuntu 12.04 LTS. Covers PHP's zend-opcache, mysqlnd support, mecmache."
layout: page
permalink: >
  https://easyengine.io/tutorials/linux/ubuntu-php-mysql-nginx-postfix/
published: true
post_date: 2012-09-13 15:58:41
---
<div class="rtp-success">

<strong><a href="https://easyengine.io/easyengine">easyengine</a> (ee) note:</strong> If you are using easyengine, you can accomplish everything in this article using following command:
<pre>ee stack install --all</pre>
</div>
A complete WordPress-Nginx setup will involve PHP, MySQL, Nginx stack and on the top of it WordPress itself.

If you already have PHP, MySQL &amp; Nginx up &amp; running then you may jump to next part i.e <a href="https://easyengine.io/tutorials/installing-fresh-wordpress-nginx-minimal/">Nginx configuration for different WordPress</a>
<h4>Assumption:</h4>
I am assuming few things before you start.
<ol>
 	<li>You have a Ubuntu server up and running. This guide may work on other Debian based distros but this is tested on Ubuntu 12.04 LTS only.</li>
 	<li>You have shell access to your Ubuntu server with sudo privilege or you have direct root-user access.</li>
</ol>
<h2>Installing PHP 5.6</h2>
We are going to use latest PHP 5.6 as it is much faster &amp; better than PHP 5.3 and PHP 5.4.

As official repo for Ubuntu 12.04 LTS contains PHP version 5.3 only, we will use a launchpad repo maintained by <a href="https://launchpad.net/~ondrej/+archive/php5">Ondřej Surý</a>
<h4>Run following codes to add launchpad repo to apt-sources:</h4>
<pre>sudo apt-get install python-software-properties
sudo add-apt-repository ppa:ondrej/php</pre>
Press "enter" key whenever asked!
<h4>Update apt-cache...</h4>
This is must, otherwise next command may end up installing PHP 5.3!
<pre>sudo apt-get update</pre>
<h4>Now, run following to install PHP itself</h4>
<pre>sudo apt-get install php5-common php5-mysqlnd php5-xmlrpc php5-curl php5-gd php5-cli php5-fpm php-pear php5-dev php5-imap php5-mcrypt</pre>
<h4>Check PHP Version</h4>
Run following command...
<pre>php -v</pre>
You will see following output...
<pre class="no-highlight">PHP 5.6.29-1+deb.sury.org~xenial+1 (cli)
Copyright (c) 1997-2016 The PHP Group
Zend Engine v2.6.0, Copyright (c) 1998-2016 Zend Technologies
 with Zend OPcache v7.0.6-dev, Copyright (c) 1999-2016, by Zend Technologies</pre>
<h2>Installing MySQL</h2>
We use Percona-MySQL everywhere for extra features and up-to-date Ubunut builds they maintain.
<h4>Add Percona Repo</h4>
Execute following commands:
<pre class="no-highlight">apt-key adv --keyserver keys.gnupg.net --recv-keys 1C4CBDCDCD2EFD2A

echo "deb http://repo.percona.com/apt `lsb_release -cs` main" &gt;&gt; /etc/apt/sources.list.d/percona.list
echo "deb-src http://repo.percona.com/apt `lsb_release -cs` main" &gt;&gt; /etc/apt/sources.list.d/percona.list

apt-get update</pre>
<h4>Installing percona-mysql server</h4>
<pre>sudo apt-get install percona-server-server-5.6 percona-server-client-5.6</pre>
Above wizard should ask you to enter a mysql password for user <code>root</code>. If it doesn't, then run the following command to change MySQL password.
<pre>sudo mysqladmin -u root password NEWPASSWORD</pre>
Please note that above command will not help you in case you forget your mysql root password in future.
<h2>Installing Postfix</h2>
If you want to send mails from your WordPress, you will need a SMTP server. You can use a remote SMTP server like gmail.com for this. But I prefer using postfix package to run a SMTP server locally.

In simple words, if you skip this step and do not configure remote SMTP server with WordPress either, your WordPress will not be send email notifications for comments, etc.
<pre>sudo apt-get install postfix</pre>
It will take you through few steps. The important one are:
<ol>
 	<li>Select option – <strong>Internet Site</strong></li>
 	<li>Hostname – generally your main domain i.e <strong>example.com</strong>. Recommended - a <abbr title="fully qualified domain name">FQDN</abbr> like <strong>mail.example.com</strong><strong> </strong></li>
</ol>
You no need to touch other options. Just restart mail service to be safe.
<pre>/etc/init.d/postfix restart</pre>
<h4>Testing your mail config:</h4>
Run following PHP code with <strong>admin@example.com</strong> replaced by your mail id:
<pre>php -a
mail ('admin@example.com', "Hello from nginx!", "My email setup works!");
exit ();</pre>
Alternatively you can use <a href="http://wordpress.org/extend/plugins/check-email/">check-mail WordPress Plugin</a> after your WordPress setup completes to be sure that your WordPress can send emails.
<h2>Installing Nginx</h2>
Ubuntu official repos come with a Nginx package but I prefer using <a href="http://wiki.nginx.org/Install#Official_Debian.2FUbuntu_packages">launchpad repo maintained by Nginx team</a>.
<pre>sudo add-apt-repository ppa:nginx/stable
sudo apt-get update 
sudo apt-get install nginx</pre>
If you prefer to use Nginx package in Ubuntu repo, you can simply run following command:
<pre>sudo apt-get install nginx-full</pre>
<h3>What's Next?</h3>
At this point, we are done with installing prerequisite for WordPress.
<ul>
 	<li><a href="https://easyengine.io/wordpress-nginx/tutorials/">Create a wordpress-nginx site</a></li>
 	<li><a href="https://easyengine.io/tutorials/php/zend-opcache/">Tweak PHP's Zend Opcache</a></li>
 	<li><a href="https://easyengine.io/tutorials/php/memcache/">Add memcache</a></li>
</ul>
<h4>Changelog:</h4>
As technology evolves, we keep upgrading our installation. This article is "how" we work here at rtCamp. So this article need to be changed over time.

<strong>Oct 15, 2013</strong>
<ul>
 	<li>Replaced PHP 5.4 with PHP 5.5</li>
 	<li>Removed APC</li>
 	<li>Using PHP's built-in zend-opcache for opcode-cache.</li>
 	<li>Using memcache for user/data-cache requirement</li>
 	<li>Switched to mysql native driver for PHP (php-mysqlnd package)</li>
 	<li>Replaced oracle-mysql with percona-mysql. Mysql 5.6 at the time of writing this article.</li>
</ul>
<strong> </strong>