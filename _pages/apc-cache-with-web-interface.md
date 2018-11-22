---
ID: 13974
post_title: 'APC Cache Optimization &#038; Monitoring Using Web Interface'
author: Rahul Bansal
post_excerpt: "Using PHP's APC cache with W3 Total Cache. Also optimizing APC and monitoring its performance via web-interface provided by apc.php"
layout: page
permalink: >
  https://easyengine.io/tutorials/php/apc-cache-with-web-interface/
published: true
post_date: 2012-09-26 21:45:44
---
While we installed PHP with other things, we also installed a <code>php-apc</code> package.

APC is one of the most popular caching mechanism for PHP's op-code caching. Once activated, it starts caching PHP codes automatically. It also works nicely with W3 Total Cache plugin for storing Object &amp; MySQL caches.
<h3>APC - Web-based User Interface</h3>
Its always better to check if APC is working correctly. Thankfully, APC comes with file <code>apc.php</code>, which provides a simple web-based interface. Just copy it to your site's web-root folder:
<pre>cp /usr/share/doc/php-apc/apc.php /var/www/example.com/htdocs</pre>
Then open <code>http://example.com/apc.php</code> in browser.

In case you want to use admin-side of <code>apc.php</code>, you will need to change default password to something else.

Just open apc.php file and edit following line:
<pre>defaults('ADMIN_PASSWORD','password');          // Admin Password - CHANGE THIS TO ENABLE!!!</pre>
You can change a few more defaults to customize web-based UI as per your needs.
<h3>APC Cache Configuration</h3>
You can tweak APC's parameter by editing <code>vim /etc/php5/conf.d/20-apc.ini</code> (if you have <a href="https://easyengine.io/tutorials/install-php-mysql-postfix-nginx-wordpress-ubuntu/">installed PHP this way</a>). In other cases, you can simply add following values to your <code>php.ini</code>

If <code>apc.php</code> is showing miss-rate above 10%, the chances are high that you need to change value of some APC configuration option.

<img class="alignnone size-full wp-image-13980" title="apc-poor-performance" alt="" src="https://easyengine.io/wp-content/uploads/2012/09/apc-poor-performance.png" width="533" height="316" />

There are <a href="http://php.net/manual/en/apc.configuration.php">many APC configuration options</a>, but I recommend making changes to the following:

Total RAM storage allocated for APC (default is 32 MB)
<pre>apc.shm_size=1024M</pre>
Maximum size of a single file APC can store (default is 1MB)
<pre>apc.max_file_size=10M</pre>
Number of op-code "files" APC can store (default is 1000)
<pre>apc.num_files_hint=20000</pre>
Number of data entries APC can store (default is 4096)
<pre>apc.user_entries_hint=20000</pre>
Once you are done with tweaking, you need to restart PHP. Command: <code>service php5-fpm restart</code>
<h3>APC &amp; WordPress + WP3 Total Cache</h3>
If you are using W3 Total Cache plugin, then you must make use of APC for <strong>Database Cache</strong> and <strong>Object Cache. </strong>

Check following screenshot:

<img class="alignnone size-full wp-image-13977" title="W3 Total Cache &amp; APC" alt="" src="https://easyengine.io/wp-content/uploads/2012/09/W3-Total-Cache-APC-1.png" width="549" height="544" />
<p class="warning alert"><strong>Note:</strong> W3 Total cache will offer APC storage option for Page Cache and Minify Cache also. Do NOT use it. "Disk enhanced" is better for Page Cache &amp; Minify Cache.</p>
There are many caching engines available for PHP but I like APC for its simplicity. Also APC will be official caching mechanism for PHP 6 (someday...)
<h4>More:</h4>
<ul>
	<li><a title="Maintaining, Optimizing &amp; Debugging WordPress-Nginx Setup" href="https://easyengine.io/tutorials/maintaining-optimizing-debugging-wordpress-nginx-setup/">Maintaining, Optimizing &amp; Debugging WordPress-Nginx Setup</a></li>
</ul>