---
ID: 13590
post_title: Static Files Handling + Nginx-Helper
author: Rahul Bansal
post_excerpt: "Using WPMU_ACCEL_REDIRECT, X-Accel-Redirection and Nginx's map to handle static files without increasing load on PHP. Must use for multisite network created before WordPress 3.5. "
layout: page
permalink: >
  https://easyengine.io/wordpress-nginx/tutorials/multisite/static-files-handling/
published: true
post_date: 2012-09-18 08:17:48
---
<a href="https://easyengine.io/series/wordpress-nginx-tutorials/"><img class="alignright size-full wp-image-10804" title="wordpress-nginx" alt="" src="https://easyengine.io/wp-content/uploads/2012/09/wordpress-nginx.jpeg" width="220" height="91" /></a>WordPress 3.4 and older multisite, by default, uses PHP's <code>readfile() </code>function to serve static files. This means every static file request will go through PHP. If you are uploading large files then most likely your PHP will crash and will throw an out of memory error. If you are in Apache world where PHP is run using mod_php (without X-Sendfile) then you will curse WordPress-Multisite!

WordPress 3.5 changed this but for old multisite network, rather than creating upgrade script, WordPress decided to maintain backward-compatibility. This article is still relevant for multisite networks created before WordPress 3.5. You will need this, even if you upgrade old-WordPress to latest version.
<h2>WPMU_ACCEL_REDIRECT and X-Accel-Redirect</h2>
WordPress-Multisite supports X-Accel-Redirect header which can improve performance, specially if you are serving large static files e.g. mp3.
<h3>Changes in wp-config.php</h3>
Add following line to <code>wp-config.php</code>:
<pre>define('WPMU_ACCEL_REDIRECT', true);</pre>
This is only change you will need on WordPress side.
<h3>Changes in Nginx Config</h3>
Assuming you are following us throughout our WordPress-Nginx series and using conventions documented here...

<strong>Add following lines to mark <code>/blogs.dir</code> directory as internal:</strong>
<pre class="nginx">server{	## inside server block 

	#avoid php readfile()
	location ^~ /blogs.dir {
		internal;
		alias /var/www/example.com/htdocs/wp-content/blogs.dir ;
		access_log off;	log_not_found off;	expires max;
	}
}</pre>
<strong>WordPress-Multisite <code>/files</code> section with Subdirectories:</strong>
<pre class="nginx">server{	## inside server block 

	location ~ ^(/[^/]+/)?files/(?&lt;rt_file&gt;.+) {
		try_files /wp-content/blogs.dir/$blogid/files/$rt_file /wp-includes/ms-files.php?file=$rt_file ;
		access_log off;	log_not_found off; expires max;
	}
}</pre>
If you have installed WordPress in a subdirectory, modify <code>try_files</code> path accordingly.

<strong>WordPress-Multisite <code>/files</code> section with Subdomains:</strong>
<pre class="nginx">server{	## inside server block 

	#WPMU Files
        location ~ ^/files/(.*)$ {
                try_files /wp-includes/ms-files.php?file=$1 =404;
                access_log off; log_not_found off; expires max;
        }
}</pre>
With above changes, rather than reading complete file, PHP determines <em>only</em> file-system path for request file-url. Then PHP created X-Accel-Redirection header with file-path value which Nginx intercepts, because of <code>blogs.dir</code> directive. This way file-reading is performed by Nginx.
<h4>Problem...</h4>
Problem with this approach is, a static file request still reaches PHP. And that PHP file, <code>wp-includes/ms-files.php</code>, loads WordPress in memory which loads MySQL in memory as well! Sound like quite a lot work for serving static-files.

Ideally, a static file should never put any load on PHP/MySQL at all. This is what we achieve next using Nginx's <code>map{..}</code> directive.
<h2>Nginx's map{..} to Handle Static files in WordPress-Multisite</h2>
If you look inside <code>wp-content/blogs.dir</code> folder on a WordPress-multisite setup, you will see for each site, wordpress create a directory to store that sites' uploaded content. Names of these directory are number like 2, 3, 4, 9 etc. These number are basically site-ids for sites in the WordPress Multisite network.

If Nginx can find the correct numeric site-id for a site, it can serve requested file itself without putting any load on PHP &amp; MySQL.

We use Nginx's <code>map {..}</code> section to hold site-names and site-ids pairs as you can see in following example:
<pre class="nginx">map $http_host $blogid {
    default               0;

    example.com           1;
    site1.example.com 	  2;
    site1.com 	   	  2;
}</pre>
Using it, Nginx can map a request for file:
<pre class="no-highlight">http://site1.com/files/2012/09/somefile.png</pre>
to file-system path:
<pre class="no-highlight">/var/www/example.com/htdocs/wp-content/blogs.dir/2/2012/09/somefile.png</pre>
<h3>Using Nginx-helper WordPress Plugin to generate Maps{..} automatically:</h3>
For small networks, you can create map manually. But for large network, you can use <a href="http://wordpress.org/extend/plugins/nginx-helper/">Nginx-Helper WordPress plugin</a> to generate Nginx <code>map{..}</code> automatically.

Once you install Nginx Helper, go to <code>Network-Admin &gt;&gt; Settings &gt;&gt; Nginx</code> page. Enable Nginx Map feature. It will appear only if you are running WordPress Multisite.

<img class="size-large wp-image-14467 alignnone" title="Nginx Map for WordPress Multisite" alt="" src="https://easyengine.io/wp-content/uploads/2012/09/Nginx-Map-for-WordPress-Multisite-610x350.png" width="610" height="350" />

You can either copy-paste map values from text-area directly into map{..} section in nginx config OR include absolute path to <code>map.conf</code> file like below:
<h3>Nginx Config</h3>
<h4>For WordPress Multisite with subdomains:</h4>
<pre class="nginx">map $http_host $blogid {
    default       -999;
    include /var/www/example.com/htdocs/wp-content/plugins/nginx-helper/map.conf ;
}

server{	## inside server block 
	#WPMU Files
        location ~ ^/files/(.*)$ {
                try_files /wp-content/blogs.dir/$blogid/$uri /wp-includes/ms-files.php?file=$1 ;
                access_log off; log_not_found off; expires max;
        }
}</pre>
<h4>For WordPress Multisite with subdirectories:</h4>
<pre class="nginx">map $uri $blogname{
	~^(?&lt;blogpath&gt;/[^/]+/)files/(.*)	$blogpath ;
}

map $blogname $blogid{
	default -999;
        include /var/www/example.com/htdocs/wp-content/plugins/nginx-helper/map.conf ;
}

server{	## inside server block 

	location ~ ^(/[^/]+/)?files/(?&lt;rt_file&gt;.+) {
		try_files /wp-content/blogs.dir/$blogid/files/$rt_file /wp-includes/ms-files.php?file=$rt_file ;
		access_log off;	log_not_found off; expires max;
	}
}</pre>
Above nginx-config snippets already have fallback support for WPMU_ACCEL_REDIRECT and X-Accel-Redirect support. So if you are creating maps manually and you forgot to update it for newly created sites, static-file handing will still work.

In fact, technically, you need to always reload Nginx config after a new site created in WordPress-Multisite. But above fallback will ensure static file-handing will work even if you do not reload nginx config.

If you are running a very big network, like WordPress.com, you may put a cron-job to reload Nginx config every hour or so.

Try it! If you get stuck, feel free to use our <a href="https://easyengine.io/support/forum/wordpress-nginx/">free support-forum for help</a>.

<strong>Link:</strong> <a href="https://easyengine.io/series/wordpress-nginx-tutorials/">WordPress-Nginx tutorials</a>