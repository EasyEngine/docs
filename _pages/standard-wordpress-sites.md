---
ID: 71774
post_title: Standard WordPress Sites
author: Dinesh Jain
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/docs/commands/site/standard-wordpress-sites/
published: true
post_date: 2014-09-24 13:06:34
---
#### **Wordpress Website**
```bash
ee site create example.com --wp
```
Sample Output : 
```bash
^_^[root@example.com:~]# ee site create example.com --wp
Creating example.com, please wait...
Creating symbolic link for example.com
Creating htdocs & logs directory
Downloading WordPress, please wait...
Setting up WordPress, please wait...
Updating WordPress permalink, please wait...
Installing Nginx Helper plugin, please wait...
Changing ownership of /var/www/example.com, please wait...
Git commit on /etc/nginx/, please wait...
Executing service nginx reload, please wait...

WordPress Admin Username: admin
WordPress Admin Password: CV1JtR0MfUdaDcQ

Successfully created new website: http://example.com
```
#### **WordPress + WP Super Cache**
```bash
ee site create example.com --wpsc
```
Sample Output : 
```bash
^_^[root@example.com:~]# ee site create example.com --wpsc
Creating example1.com, please wait...
Creating symbolic link for example1.com
Creating htdocs & logs directory
Downloading WordPress, please wait...
Setting up WordPress, please wait...
Updating WordPress permalink, please wait...
Installing Nginx Helper plugin, please wait...
Installing WP Super Cache plugin, please wait...
Changing ownership of /var/www/example1.com, please wait...
Git commit on /etc/nginx/, please wait...
Executing service nginx reload, please wait...

WordPress Admin Username: admin
WordPress Admin Password: fV5WkzRxPgwVWYx

Configure WPSC:		http://example.com/wp-admin/options-general.php?page=wpsupercache
Successfully created new website: http://example1.com
```

#### **WordPress + W3 Total Cache**
```bash
ee site create example.com --w3tc
```
Sample Output : 
```bash
^_^[root@example.com:~]# ee site create example.com --w3tc
Creating example.com, please wait...
Creating symbolic link for example.com
Creating htdocs & logs directory
Downloading WordPress, please wait...
Setting up WordPress, please wait...
Updating WordPress permalink, please wait...
Installing Nginx Helper plugin, please wait...
Installing W3 Total Cache plugin, please wait...
Changing ownership of /var/www/example.com, please wait...
Git commit on /etc/nginx/, please wait...
Executing service nginx reload, please wait...

WordPress Admin Username: admin
WordPress Admin Password: L9wyVGrXQTMYIqA

Configure W3TC:		http://example.com/wp-admin/admin.php?page=w3tc_general
Page Cache:		    Disk Enhanced
Database Cache:		Memcached
Object Cache:		Memcached
Browser Cache:		Disable
Successfully created new website: http://example.com
```
#### **Configure Plugins:**
Configure W3TC: 
![page cache](https://cloud.githubusercontent.com/assets/7354660/3731529/ea4989b8-16ec-11e4-9d28-a22e8ed53948.png)
![database objectcache](https://cloud.githubusercontent.com/assets/7354660/3731535/3d7aa3f6-16ed-11e4-9331-68dc8b35365b.png)
![browser cache](https://cloud.githubusercontent.com/assets/7354660/3731528/ea483ca2-16ec-11e4-828e-fde693003668.png)

#### **WordPress + FastCGI Cache**
```bash
ee site create example.com --wpfc
```
Sample Output : 
```bash
^_^[root@example.com:~]# ee site create example.com --wpfc
Creating example3.com, please wait...
Creating symbolic link for example3.com
Creating htdocs & logs directory
Downloading WordPress, please wait...
Setting up WordPress, please wait...
Updating WordPress permalink, please wait...
Installing Nginx Helper plugin, please wait...
Installing W3 Total Cache plugin, please wait...
Changing ownership of /var/www/example3.com, please wait...
Git commit on /etc/nginx/, please wait...
Executing service nginx reload, please wait...

WordPress Admin Username: admin
WordPress Admin Password: azVCKVnOrXti0mi

Configure nginx-helper:	http://example.com/wp-admin/options-general.php?page=nginx
Configure W3TC:		http://example.com/wp-admin/admin.php?page=w3tc_general
Page Cache:		    Disable
Database Cache:		Memcached
Object Cache:		Memcached
Browser Cache:		Disable
Successfully created new website: http://example.com
```

#### **Configure Plugins:**
Configure nginx-helper:
![easyengine-nginx helper](https://cloud.githubusercontent.com/assets/7354660/3746458/b33586d8-17bf-11e4-920a-718d9bc28e39.png)

Configure W3TC:
![database objectcache](https://cloud.githubusercontent.com/assets/7354660/3731535/3d7aa3f6-16ed-11e4-9331-68dc8b35365b.png)
![browser cache](https://cloud.githubusercontent.com/assets/7354660/3731528/ea483ca2-16ec-11e4-828e-fde693003668.png)