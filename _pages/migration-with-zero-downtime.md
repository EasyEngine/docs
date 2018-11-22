---
ID: 10566
post_title: Moving WordPress To New Server (Faster)
author: Rahul Bansal
post_excerpt: >
  Moving a WordPress to new server without
  any downtime or inconsistency in a fast
  way. Instructions in this article can be
  used for non-WordPress sites as well.
layout: page
permalink: >
  https://easyengine.io/tutorials/wordpress/migration-with-zero-downtime/
published: true
post_date: 2012-10-26 23:23:06
---
During my recent <a href="https://easyengine.io/series/wordpress-nginx-tutorials/">WordPress-Nginx tutorials series</a>, I posted how to <a title="Installing Fresh WordPress on Nginx Server (Minimal Configuration)" href="https://easyengine.io/tutorials/installing-fresh-wordpress-nginx-minimal/">setup a fresh wordpress</a> but did not say anything about moving an existing wordpress setup. There are many ways to move a WordPress setup from one server to another. And the way you follow doesn't have any impact on your Nginx config so I kept that topic for a separate post.

We generally use following workflow coupled with one of the 2-migration methods described later. Even though our job involves moving WordPress sites mosly, following can be used to move any type of sites/files from old-server to new-server.
<h4>Notes:</h4>
<ul>
	<li><strong>old-server: </strong>Server which has WordPress running before moving.</li>
	<li><strong>new-server: </strong>New destination server where we want to move WordPress. (<a href="https://easyengine.io/tutorials/install-php-mysql-postfix-nginx-wordpress-ubuntu/">Assuming PHP, Mysql already installed</a>)</li>
	<li><strong>old-server-ip</strong>: IP Address of old-server</li>
	<li><strong>new-server-ip</strong>: IP Address of new-server</li>
	<li><strong>example.com</strong>: Public domain on which WordPress site/blog is running. Please <a href="https://easyengine.io/tutorials/wordpress-nginx-setup-conventions/">check this for other conventions</a>.</li>
</ul>
<h2>Workflow for moving WordPress/Websites:</h2>
To avoid downtime or disruption of service for site visitors, we generally follow following steps:
<ol>
	<li>Lower TTL value for relevant DNS-records for <em>example.com. </em></li>
	<li>Put old-server in frozen state so that people can read your articles but can not comment on them! We use <a href="http://wordpress.org/extend/plugins/code-freeze/">code-freeze plugin</a> for this.</li>
	<li>If old-server supports SSH access, take a mysqldump of database. Or download zipped sql dump via phpMyAdmin, cPanel, etc.</li>
	<li>Transfer WordPress stuff (files, database, etc) to new server. Using rsync or ncftp as explained below.</li>
	<li>Configure new server properly (wp-config.php changes, mysql import, file-system paths, etc)</li>
	<li>Cross-check if WordPress on new-server is running properly by making pointing IP address for example.com to new-server (by making changes to <code>/etc/hosts</code> file on local machine).</li>
	<li>Then remove code-freeze plugin on new server. Please note that its still running on old-server!</li>
	<li>Finally make changes to DNS entries for <em>example.com (mostly A-record). </em>You may need to update SPF-records if you are using them. Also, you may increase TTL values again.</li>
	<li>Setup old-server as transparent proxy to new-server.</li>
</ol>
If you are doing this for the first time, then its better to perform a dry-run. Otherwise you may end up <em>freezing</em> your old-wordpress for long time. ;-)

Most steps are self-explanatory. Some depends on your old &amp; new server environment/config/hosting-company. Below are some codes to help you.
<h3>Lowering TTL Values (step #0)</h3>
Please note that we need to lower TTL value only. This is NOT time to change IP address value or other things in DNS-records.

Only TTL-value.

<em>(Thanks to Neal for <a href="https://easyengine.io/tutorials/moving-wordpress-to-new-server-faster/#comment-17368">reminding</a> me to add this point here)</em>
<h3>Using mysqldump to backup/restore database (step #3)</h3>
This is possible only if your old-server allows SSH access.

We use following command. Values of MYSQL_USER, MYSQL_PASS &amp; DATABASE_NAME are replaces by values from wp-config.php.
<pre class="no-highlight">mysqldump -u MYSQL_USER -pMYSQL_PASS DATABASE_NAME &gt; DATABASE_NAME.sql</pre>
Once DATABASE_NAME.sql gets transfered to new-server, you can use following command to import it:
<pre class="no-highlight">mysql -u MYSQL_USER -pMYSQL_PASS DATABASE_NAME &lt; DATABASE_NAME.sql</pre>
If you do not have SSH access, then just download database dump using phpMyAdmin and upload/import it using normal FTP or phpMyAdmin again on new-server.
<h3>Methods of moving WordPress files, database dump, etc (step #4)</h3>
We generally follow one of two ways listed below and the choice depends on availability of SSH access.
<h4>Using ssh/rsync (fastest)</h4>
If SSH access is available on both, old and new server, we use rsync. Exact instructions are hard to provide but following is a recommended workflow.
<ol>
	<li><strong>On old-server: </strong>take database dump using <code>mysqldump</code> command. <em>(see example above)</em></li>
	<li><strong>On new-server:</strong> Use rsync to move wordpress files &amp; mysql backup to new server.</li>
	<li><strong>On new-server: </strong>restore mysql from backup and make changes to WordPress wp-config.php <em>(if needed)</em></li>
</ol>
<strong>Rsync Example:</strong>
<pre class="no-highlight">rsync -avz --human-readable --progress user@example.com:/path/to/www-on-old-server /path/to/www-on-new-server</pre>
<h4>Using ncftp (fast enough)</h4>
If you do not have shell access to server, then most likely you will have FTP access only.

Mostly, I see people downloading from old-server to local-machine and then uploading from local-machine to new-server. This can be slow like hell depending on your Internet connection speed. We recommend using ncftp tool to move files from old-server to new-server directly!

<strong>On new-server, if you have SSH access...</strong>

Run following commands...
<pre>apt-get install ncftp 
cd /var/www/example.com/htdocs/
ncftpget –R –v –u "USERNAME" old-server-ip /path/on/old-server</pre>
If you do not like ncftp or face issues with it, you can try wget:
<pre>cd /var/www/example.com/htdocs/
wget -nc -r ftp://oldserver.com/path/on/old-server  --ftp-user=olduser --ftp-password=old-pass</pre>
<strong><strong>On new-server, if you do NOT have SSH access...</strong>
</strong>

You can use ncftp for recursive upload as well. Trick is to install ncftp on a third-server with SSH-access and then download/upload content from there. Unless you have a server hosted on your home-machine with average Internet speed, server-to-server file upload and download are very fast.

Sample commands are like below:
<pre class="no-highlight">cd ~/tmp/example.com/
ncftpget –R –v –u "USERNAME" old-server-ip /path/on/old-server
ncftpput –R –v –u "USERNAME" new-server-ip /path/on/new-server</pre>
There is <a href="http://freecode.com/projects/wput">wput</a> for wget but I never tried it. As we <a href="https://easyengine.io/services/wordpress-migration-services/">keep moving things all the times</a>, it helps us to have ncftp in our toolbox!
<h4>Setup old-server as transparent proxy to new-server (Step #9)</h4>
Once your new-server goes live, you may still some traffic to old-server. Most common reason for user seeing old-sites is local DNS cache's which you can not control or flush at will!

In such cases, we setup old-server to proxy entire traffic it gets to new-server. Codes/configuration for the same depends on web-server software running on old-server. Still, below are common code-snippets we use for 2 popular servers we deals with frequently:
<h4>Reverse-Proxy code-snippet For Apache:</h4>
Please change new-server-ip in following code. You may also need to make some more changes.
<pre class="apache">&lt;VirtualHost *:80&gt;
     ServerName  example.com
     ProxyPreserveHost   On
     ProxyPass   /   http://new-server-ip/
     ProxyPassReverse    /   http://new-server-ip/
&lt;/VirtualHost&gt;</pre>
<h4>Reverse-Proxy code-snippet For Nginx:</h4>
Please change new-server-ip in following code. You may also need to make some more changes.
<pre class="nginx">    location / {
        proxy_pass http://new-server-ip ; 
	proxy_redirect     	off;
	proxy_set_header        Host            $host;
	proxy_set_header        X-Real-IP       $remote_addr;
	proxy_set_header        X-Forwarded-For $proxy_add_x_forwarded_for;
   }</pre>
In all cases, do not forget to reload server-config on old-server. Also by altering your own /etc/hosts file, check if old-server is proxying traffic properly to new-server.

At this point, you will be shocked to see that old-server may get traffic even after 1 week since you have updated DNS records! Its fine. You can keep old-server proxy up and running as long as you wish. You can add caching layer e.g. nginx's proxy_cache to cache response from new-server!

That's All! If you find any mistake, please let me know.

<strong>Recommended: </strong><a href="https://easyengine.io/wordpress-nginx/tutorials/">Try Nginx for your new WordPress setup</a>