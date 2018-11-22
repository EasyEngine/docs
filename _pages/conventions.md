---
ID: 10472
post_title: 'Conventions &#038; File System Layout'
author: Rahul Bansal
post_excerpt: 'Files-system paths & conventions you should follow for an ideal WordPress-Nginx setup, which will make it easy to maintain & debug on ongoing basis.'
layout: page
permalink: >
  https://easyengine.io/wordpress-nginx/tutorials/conventions/
published: true
post_date: 2012-09-11 17:30:05
---
<p class="rtp-success"><strong>Important:</strong> You can use <a href="https://easyengine.io/easyengine">easyengine</a> which automated WordPress-Nginx site management.</p>
There is a famous proverb that goes like this:
<blockquote>A place for everything and everything in its place!</blockquote>
There is no denying to this. So we are devoting a dedicated page for all conventions we have used in <a href="https://easyengine.io/wordpress-nginx/tutorials/">wordpress-nginx tutorials</a> series.

This page might feel a little boring to read. But it will help you get a grip on all the conventions used. You will definitely thank me for this when you will end-up breaking something. Because in that panic moment, this page will help you troubleshoot quickly.
<h2><span style="font-size: 2.5rem; line-height: 1.4;">File-System Layout</span></h2>
Please note that following layout is for Ubuntu 12.04 LTS. Most of them are default locations for respective packages. Sticking with default will save us from some trouble. On non-Ubuntu/Debian OS, some locations may vary.
<h3>Nginx</h3>
<h4>Configuration Files:</h4>
<ul>
	<li><code>/etc/nginx/</code> - all nginx related configuration will be in this folder</li>
	<li><code>/etc/nginx/nginx.conf</code> - THE (main) nginx configuration file</li>
	<li><code>/etc/nginx/sites-available/</code> - nginx configuration for different sites will be available here</li>
	<li><code>/etc/nginx/sites-enables/</code> - symlinks to nginx configuration files which are "active"</li>
</ul>
<h4>Log Files:</h4>
<ul>
	<li><code>/var/log/nginx/</code> - default log directory for nginx. We will use this for logs of all sites we will create.</li>
	<li><code>/var/log/nginx/example.com.access.log</code> - access log file for <em>example.com</em></li>
	<li><code>/var/log/nginx/example.com.error.log</code> - error log file for example.com</li>
	<li><code>/etc/logrotate.d/nginx</code> - this file control log-rotation policy for nginx related log files</li>
</ul>
<h3>PHP</h3>
<h4>Configuration Files:</h4>
<ul>
	<li><code>/etc/php5/</code> - all php related configuration will be in this folder</li>
	<li><code>/etc/php5/fpm/php.ini</code> - THE (main) php configuration file</li>
	<li><code>/etc/php5/fpm/php-fpm.conf</code> - FPM related settings</li>
	<li><code>/etc/php5/fpm/conf.d/www.conf</code> - "www" i.e. default pool related settings</li>
</ul>
<h4>Log Files:</h4>
<em>Note: You may not find following files by default. They were added in by us. </em>
<ul>
	<li><code>/var/log/php5-fpm/</code> - php related to logs. you should check this if you feel your site is slow or broken</li>
	<li><code>/var/log/php5-fpm/slow.log</code> - this file will help you find slow php scripts</li>
	<li><code>/var/log/php5-fpm/php.log</code> - this file will help you find slow php scripts</li>
	<li><code>/etc/logrotate.d/php5-fpm</code> - this file control how long php logs will be maintained</li>
</ul>
<h3>MySQL - Configuration &amp; logs</h3>
<h4>Configuration Files:</h4>
<ul>
	<li><code>/etc/mysql/my.cnf</code> - this is mysql configuration file <em>(not folder)</em></li>
</ul>
<h4>Log Files:</h4>
<ul>
	<li><code>/var/log/mysql/mysql.log</code> - mysql general/error logs</li>
	<li><code>/var/log/mysql/mysql-slow.log</code> - this file will help you find slow mysql queries</li>
	<li><code>/etc/logrotate.d/mysql-server</code> - this file control how long php logs will be maintained</li>
</ul>
<h3>Website Structure</h3>
Following is the convention we will be using for WordPress as well as non-WordPress sites.
<ul>
	<li><code>/var/www</code> - all your websites will be here</li>
	<li><code>/var/www/example.com</code> - everything related to example.com will be inside this folder</li>
	<li><code>/var/www/example.com/htdocs</code> - this is web-root for example.com. Its like DocumentRoot in Aapche. You will put WordPress will here.</li>
	<li><code>/var/www/example.com/logs</code> - contains logs for example.com only.</li>
	<li><code>/var/www/example.com/logs/access.log</code> - contains access.logs for example.com only. If you want to use a tool like AWStat then this is the server-log file you will need. This is a symbolic link to <code>/var/log/nginx/example.com.access.log</code> file.</li>
	<li><code>/var/www/example.com/logs/error.log</code> - contains error.logs for example.com only. This will help you in debugging. It captures some PHP related error as well. This is a symbolic link to <code>/var/log/nginx/example.com.error.log</code> file.</li>
	<li><code>/var/www/example.com/wp-content</code> - in case you want to keep wp-content outside web-accessible folder. I will NOT cover this in this tutorial. Consider this is an exercise for yourself! ;-)</li>
</ul>
<h3>Notes:</h3>
<h4>Few notes about the above website-structure:</h4>
<ol>
	<li>Following structure does not take into account shared-hosting scenarios where generally all sites for a users are located under his home directory. Something like /home/bill/www or /home/bill/public_html</li>
	<li>Subdomains are treated like domains. They reside directly under /var/www with their own htdocs and logs folder. e.g. subdomain.example.com will use directory /var/www/subdomain.example.com</li>
</ol>
<a name="NOTES-LOGS"></a>
<h4>Notes about access.log &amp; error.log files for websites:</h4>
You might have noticed that you can check access.log &amp; error.log for a domain by 2 ways - either from logs folder under domain or nginx's log folder. There are few reasons for this kind of setup:
<ol>
	<li>Keeping all log files places under /var/log/nginx location make things like logrotation, disk cleanup very easy. Also, things like checking logs for all sites hosted on your nginx server or for all subdomains for a top-level domain will be easy.</li>
	<li>Site-specific log folder can make debugging easy. Also, from security perspective you may want to create a user and give him access to a specific site only. In that case we can access logs for that site <em>(if needed)</em></li>
</ol>
<strong>Related:</strong> You can find the complete list of <a href="https://easyengine.io/series/wordpress-nginx-tutorials/">WordPress-Nginx tutorials</a> here.

<strong>Important:</strong> You can use <a href="https://easyengine.io/easyengine">easyengine</a> which automates WordPress-Nginx site management.