---
ID: 10558
post_title: >
  Installing WordPress + Nginx Server
  (Minimal Configuration)
author: Rahul Bansal
post_excerpt: >
  A quick way to install latest WordPress
  from scratch with minimal Nginx
  configuration. Support for separate log
  files per domain/wordpress site to make
  debugging easier.
layout: page
permalink: >
  https://easyengine.io/wordpress-nginx/tutorials/single-site/minimal/
published: true
post_date: 2012-09-14 15:36:50
---
<div class="rtp-success">

<strong><a href="https://easyengine.io/easyengine">easyengine</a> (ee) note:</strong> If you are using easyengine, you can accomplish everything in this article using following commands:
<pre>ee system install nginx</pre>
<pre>ee site create example.com --wp</pre>
</div>
<a href="https://easyengine.io/series/wordpress-nginx-tutorials/"><img class="alignright size-full wp-image-10804" title="wordpress-nginx" alt="" src="https://easyengine.io/wp-content/uploads/2012/09/wordpress-nginx.jpeg" width="220" height="91" /></a>If this is your first Nginx setup, most likely you are moving from Apache to a WordPress-Nginx setup. I will cover moving process in next article.

In this article we will see fresh WordPress installation and its configuration with Nginx.
<h3>Installing Fresh WordPress</h3>
<h4>Download and unzip latest WordPress</h4>
Following will download and extract latest copy of WordPress for example.com domain
<pre>mkdir -p /var/www/<strong>example.com</strong>/htdocs/ /var/www/<strong>example.com</strong>/logs/
cd /var/www/<strong>example.com</strong>/htdocs/
wget http://wordpress.org/latest.tar.gz
tar --strip-components=1 -xvf latest.tar.gz
rm latest.tar.gz
chown -R www-data:www-data /var/www/<strong>example.com</strong>/</pre>
<h4>Create a database for new WordPress</h4>
Following command will create a fresh database for the new WordPress you are installing.
<pre>mysql -u <strong>USERNAME</strong> -p<strong>PASSWORD</strong> -e 'create database <strong>DB_NAME</strong>'</pre>
In above command, replace USERNAME, PASSWORD &amp; DB_NAME with appropriate values. You will also need these values during WordPress installation wizard.

You can open <em>example.com</em> in browser to complete WordPress installation as soon as we finish next step!
<h3>Simplest Nginx Configuration for WordPress</h3>
I am posting below a simple Nginx configuration for WordPress.

It doesn't have support for any <a title="WordPress-Nginx + WP Super cache" href="https://easyengine.io/tutorials/wordpress-wp-super-cache-nginx/">caching</a> <a title="WordPress-Nginx + W3 Total Cache" href="https://easyengine.io/tutorials/wordpress-nginx-w3-total-cache/">plugin</a> or things like SSL, <a title="Creating A WordPress Multisite Network with Nginx" href="https://easyengine.io/tutorials/creating-wordpress-multisite-network-nginx/">WordPress multisite</a>, etc. It also uses Nginx's default access.log &amp; error.log files.

Create Nginx-config file for <em>example.com</em>
<pre>vim /etc/nginx/sites-available/<strong>example.com</strong></pre>
<strong>Add following lines to it:</strong>
<pre>server {
        server_name <strong>example.com</strong> www.<strong>example.com</strong>;

	access_log   /var/log/nginx/<strong>example.com</strong>.access.log;
	error_log    /var/log/nginx/<strong>example.com</strong>.error.log;

        root /var/www/<strong>example.com</strong>/htdocs;
        index index.php;

        location / {
                try_files $uri $uri/ /index.php?$args; 
        }

        location ~ \.php$ {
                try_files $uri =404;
                include fastcgi_params;
                fastcgi_pass 127.0.0.1:9000;
        }
}</pre>
Next, add <em>example.com</em> to Nginx <em>sites-enabled</em> folder:
<pre>ln -s /etc/nginx/sites-available/<strong>example.com</strong> /etc/nginx/sites-enabled/</pre>
Then test Nginx-configuration before you ask Nginx to load it:
<pre>nginx -t</pre>
It will show an output like below:
<pre>nginx: the configuration file /etc/nginx/nginx.conf syntax is ok
nginx: configuration file /etc/nginx/nginx.conf test is successful</pre>
It you see any error in output, most likely you have made mistakes while creating Nginx config files. Try to fix them yourself first. Help is always available here.
<h4>Finally reload Nginx configuration:</h4>
<pre>service nginx reload</pre>
<h4>Create symbolic links for example.com log files:</h4>
This will be helpful (<a href="https://easyengine.io/tutorials/wordpress-nginx-setup-conventions/#NOTES-LOGS">as explained before</a>)
<pre>ln -s /var/log/nginx/example.com.access.log /var/www/example.com/logs/access.log
ln -s /var/log/nginx/example.com.error.log /var/www/example.com/logs/error.log</pre>
<h4>Complete WordPress installation:</h4>
You can now open <em>example.com</em> in your favorite web-browser. You will see a WordPress installation wizard.
<h3>What's Next...</h3>
In next chapter, we will explore different <a title="WordPress-Multisite: Subdirectory, Subdomain, Domain Mapping Overview" href="https://easyengine.io/tutorials/wordpress-multisite-subdirectory-subdomain-domain-mapping-overview/">WordPress configurations for Multisite</a>, <a title="WordPress-Nginx Configuration with W3 Total Cache" href="https://easyengine.io/tutorials/standard-wordpressnginx-configuration-w3-total-cache/">caching</a> <a title="WordPress-Nginx Configuration with W3 Super Cache" href="https://easyengine.io/tutorials/standard-wordpress-wp-super-cache-nginx-configuration/">plugins</a>, <a title="SSL Setup on WordPress-Nginx" href="https://easyengine.io/tutorials/wordpress-nginx-ssl-setup/">SSL</a>, etc. You can also find the complete list of <a href="https://easyengine.io/series/wordpress-nginx-tutorials/">WordPress-Nginx tutorials</a> here.