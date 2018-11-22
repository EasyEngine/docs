---
ID: 71786
post_title: WordPress Multisite With Subdomain
author: Dinesh Jain
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/docs/commands/site/wordpress-multisite-subdomain/
published: true
post_date: 2014-09-24 13:15:53
---
```bash
ee site create example.com --wpsubdom
```
Sample Output : 
```bash
^_^[root@example.com:~]# ee site create example.com --wpsubdom
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
WordPress Admin Password: y5zJv9wWV1kOJH0

Successfully created new website: http://example.com
```
#### **WordPress Subdomain + WP Super Cache**
```bash
ee site create example.com --wpsubdom --wpsc
```
Sample Output : 
```bash
^_^[root@example.com:~]# ee site create example.com --wpsubdom --wpsc
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
WordPress Admin Password: bTeadd6oIgyrDuK

Configure WPSC:		http://example.com/wp-admin/network/settings.php?page=wpsupercache
Successfully created new website: http://example.com
```

#### **WordPress Subdomain + W3 Total Cache**
```bash
ee site create example.com --wpsubdom --w3tc
```
Sample Output : 
```bash
^_^[root@example.com:~]# ee site create example.com --wpsubdom --w3tc
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
WordPress Admin Password: rrrl0LoNpCCLSKe

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

#### **WordPress Subdomain + FastCGI Cache**
```bash
ee site create example.com --wpsubdom --wpfc
```
Sample Output : 
```bash
^_^[root@example.com:~]# ee site create example.com --wpsubdom --wpfc
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
WordPress Admin Password: BONfdrkRbYK9rp9

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
#### *WordPress Subdomain Setup Guide*

Lets create http://blog.example.com

Open http://example.com/wp-admin/network/site-new.php  and setup like

![ee wpsubdomain blog](https://cloud.githubusercontent.com/assets/7354660/3796281/8fc2eaf0-1bc6-11e4-9daf-f73e4d0ff535.png)