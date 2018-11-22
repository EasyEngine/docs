---
ID: 71781
post_title: WordPress Multisite with subdirectory
author: Dinesh Jain
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/docs/commands/site/wordpress-multisite-subdirectory/
published: true
post_date: 2014-09-24 13:11:30
---
```bash
ee site create example.com --wpsubdir
```
Sample Output : 
```bash
^_^[root@example.com:~]# ee site create example.com --wpsubdir
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
WordPress Admin Password: od6D2Elo6oh5lgk

Successfully created new website: http://example.com
```
#### **WordPress Subdirectory + WP Super Cache**
```bash
ee site create example.com --wpsubdir --wpsc
```
Sample Output : 
```bash
^_^[root@example.com:~]# ee site create example.com --wpsubdir --wpsc
Creating example.com, please wait...
Creating symbolic link for example.com
Creating htdocs & logs directory
Downloading WordPress, please wait...
Setting up WordPress, please wait...
Updating WordPress permalink, please wait...
Installing Nginx Helper plugin, please wait...
Installing WP Super Cache plugin, please wait...
Changing ownership of /var/www/example.com, please wait...
Git commit on /etc/nginx/, please wait...
Executing service nginx reload, please wait...

WordPress Admin Username: admin
WordPress Admin Password: YiuSsNTfYagVhVW

Configure WPSC:		http://example.com/wp-admin/network/settings.php?page=wpsupercache
Successfully created new website: http://example.com
```

#### **WordPress Subdirectory + W3 Total Cache**
```bash
ee site create example.com --wpsubdir --w3tc
```
Sample Output : 
```bash
^_^[root@example.com:~]# ee site create example.com --wpsubdir --w3tc
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
WordPress Admin Password: Gv2fxO5SxgYstbW

Configure W3TC:		http://example.com/wp-admin/network/admin.php?page=w3tc_general
Page Cache:		    Disk Enhanced
Database Cache:		Memcached
Object Cache:		Memcached
Browser Cache:		Disable
Successfully created new website: http://example.com

```
Configure W3TC: 
![page cache](https://cloud.githubusercontent.com/assets/7354660/3731529/ea4989b8-16ec-11e4-9d28-a22e8ed53948.png)
![database objectcache](https://cloud.githubusercontent.com/assets/7354660/3731535/3d7aa3f6-16ed-11e4-9331-68dc8b35365b.png)
![browser cache](https://cloud.githubusercontent.com/assets/7354660/3731528/ea483ca2-16ec-11e4-828e-fde693003668.png)

#### **WordPress Subdirectory + FastCGI Cache**
```bash
ee site create example.com --wpsubdir --wpfc
```
Sample Output : 
```bash
^_^[root@example.com:~]# ee site create example.com --wpsubdir --wpfc
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
WordPress Admin Password: 0KdB2ErszQmKrHT

Configure nginx-helper:	http://example.com/wp-admin/network/settings.php?page=nginx
Configure W3TC:		http://example.com/wp-admin/network/admin.php?page=w3tc_general
Page Cache:		    Disable
Database Cache:		Memcached
Object Cache:		Memcached
Browser Cache:		Disable
Successfully created new website: http://example.com
```
Configure nginx-helper:
![easyengine-nginx helper](https://cloud.githubusercontent.com/assets/7354660/3746458/b33586d8-17bf-11e4-920a-718d9bc28e39.png)

Configure W3TC:
![database objectcache](https://cloud.githubusercontent.com/assets/7354660/3731535/3d7aa3f6-16ed-11e4-9331-68dc8b35365b.png)
![browser cache](https://cloud.githubusercontent.com/assets/7354660/3731528/ea483ca2-16ec-11e4-828e-fde693003668.png)

***
#### WordPress Subdirectory Setup Guide:
Lets create http://example.com/blog website

Open http://example.com/wp-admin/network/site-new.php
![EasyEngine WordPress Subdirectory Setup] (https://cloud.githubusercontent.com/assets/7354660/3795985/cba8e01a-1bc1-11e4-94cd-68615e2035e0.png)