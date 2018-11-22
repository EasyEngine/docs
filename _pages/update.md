---
ID: 74370
post_title: site update
author: Harshad Yeola
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/docs/commands/site/update/
published: true
post_date: 2014-10-10 20:09:15
---
<div class="entry-content">
<p class="alert">This command is supported by EasyEngine 2.2.0 and above version only.
This command will update sites websites created using EasyEngine 2.0.0 and next versions</p>

</div>
<h2>Policies EasyEngine use before updating any site</h2>
<code>ee site update</code> command follows following procedure while updating current site.

Before Updating any site easyengine
<ul>
	<li>Creates nginx configuration backup for site.</li>
	<li>Moves htdocs to backup while updating html/php/mysql site.</li>
	<li>Creates database dump in backup.</li>
	<li>While updating current mysql site easyengine uses same database for installing wordpress tables.</li>
	<li>All these backup are stored outside htdocs, in backup directory.</li>
</ul>
<h2>Update WordPress User Password</h2>
<pre class="bash">ee site update example.com --password</pre>
Sample Output :
<pre class="bash">root@example.com:~# ee site update example.com --password
Provide WordPress user name [admin]: admin
Provide password for admin user:</pre>
<h2>Update Site</h2>
<iframe src="https://docs.google.com/spreadsheets/d/1n-yofh39TCb3ISFB5n5yEWPATnps6_-3kMJJNgaMMOM/pubhtml?widget=true&amp;headers=false" width="780" height="500"></iframe>
<h3>Update Non WordPress Sites to WordPress sites</h3>
Update html/php/mysql site created with easyengine( refer <a href="https://easyengine.io/easyengine/docs/commands/site/ee-site-create/#wordpress-site">ee site create</a> command) to WordPress site.
Update example.com to wordpress site
<pre class="bash">ee site update example.com --wp</pre>
Sample Output :
<pre class="bash">root@example.com:~# ee site update example.com --wp
Adding Ondrej PHP5 launchpad repository, please wait...
Executing apt-get update, please wait...
Installing PHP, please wait...
Reading package lists...
Building dependency tree...
.
.
.

Backup webroot at /var/www/example.com/backup/htdocs/10Oct2014064549/, please wait...
Backup NGINX configuration at /var/www/example.com/backup/nginx/10Oct2014064549/, please wait...
Updating example.com, please wait ...
Downloading WordPress, please wait...
Setting up WordPress, please wait...
Updating WordPress permalink, please wait...
Installing Nginx Helper plugin, please wait...

WordPress Admin Username: admin
WordPress Admin Password: SMGASpsPAdR9cXg

Changing ownership of /var/www/example.com, please wait...
Executing service nginx reload, please wait...
Git commit on /etc/nginx/, please wait...
Successfully Updated Website: http://example.com</pre>

<h3>Update cache type for WordPress Sites</h3>
Update cache type for currently WordPress Sites created with easyengine (refer <a href="https://easyengine.io/easyengine/docs/commands/site/ee-site-create/#standard-wordpress-sites">ee site create</a> command.
<pre class="bash">ee site update example.com --wp --wpfc</pre>
Sample Output :
<pre class="bash">root@example.com:~# ee site update example.com --wp --wpfc
Backup NGINX configuration at /var/www/example.com/backup/nginx/10Oct2014065345/, please wait...
Backup Database example_com at /var/www/example.com/backup/db/10Oct2014065345/, please wait...
Updating example.com, please wait ...
Installing W3 Total Cache plugin, please wait...
Changing ownership of /var/www/example.com, please wait...
Executing service nginx reload, please wait...
Git commit on /etc/nginx/, please wait...
Successfully Updated Website: http://example.com</pre>

<h3>Update WordPress Single site to WordPress Multisite</h3>
Update currently WordPress single site created with easyengine ( refer <a href="https://easyengine.io/easyengine/docs/commands/site/ee-site-create/#standard-wordpress-sites%20">ee site create</a> command )to WordPress Multisite.
<pre class="bash">ee site update example.com --wpsubdir</pre>
Sample Output :
<pre class="bash">root@example.com:~# ee site update example.com --wpsubdir
Backup NGINX configuration at /var/www/example.com/backup/nginx/10Oct2014065728/, please wait...
Backup Database example_com at /var/www/example.com/backup/db/10Oct2014065728/, please wait...
Updating example.com, please wait ...
Uninstalling W3 Total Cache plugin, please wait...
Changing ownership of /var/www/example.com, please wait...
Executing service nginx reload, please wait...
Git commit on /etc/nginx/, please wait...
Successfully Updated Website: http://example.com</pre>
Similarly, you can use these commands.
<pre class="bash">ee site update example.com --wp --wpfc
ee site update example.com --wp --w3tc
ee site update example.com --wp --wpsc
ee site update example.com --wpsubdir
ee site update example.com --wpsubdir --wpfc
ee site update example.com --wpsubdir --w3tc
ee site update example.com --wpsubdir --wpsc
ee site update example.com --wpsubdomain
ee site update example.com --wpsubdomain --wpfc
ee site update example.com --wpsubdomain --w3tc
ee site update example.com --wpsubdomain --wpsc</pre>