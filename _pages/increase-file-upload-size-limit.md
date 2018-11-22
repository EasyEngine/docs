---
ID: 10628
post_title: >
  Increase file upload size limit in
  PHP-Nginx
author: Rahul Bansal
post_excerpt: >
  Configuring PHP to upload large files in
  Nginx setup. Also covers
  WordPress-multisite "Upload Settings"
  changes.
layout: page
permalink: >
  https://easyengine.io/tutorials/php/increase-file-upload-size-limit/
published: true
post_date: 2012-09-25 20:53:58
---
If Nginx aborts your connection when uploading large files, you will see something like below in Nginx's error logs:
<p class="rtp-error">[error] 25556#0: *52 client intended to send too large body:</p>
This means, you need to increase PHP file-upload size limit. Following steps given below will help you troubleshoot this!
<h3>Changes in php.ini</h3>
To change max file upload size to 100MB

Edit...
<pre>vim /etc/php5/fpm/php.ini</pre>
Set...
<pre>upload_max_filesize = 100M
post_max_size = 100M</pre>
<h4>Notes:</h4>
<ol>
	<li>Technically,  <em>post_max_size</em> should always be larger than <em>upload_max_filesize</em> but for large numbers like 100M you can safely make them equal.</li>
	<li>There is another variable <em>max_input_time</em> which can limit upload size but I have never seen it creating any issue. If your application supports uploads of file-size in GBs, you may need to adjust it accordingly. I am using PHP-FPM behind Nginx from very long time and I think in such kind of setup, its Nginx to which a client uploads file and then Nginx copies it to PHP. As Nginx to PHP copying will be local operation max_input_time may never create issue. I also believe Nginx may not copy the file but merely hand-over the location of file or descriptor records to PHP!</li>
</ol>
<div>You may like to read <a href="http://www.radinks.com/upload/config.php">these</a> <a href="http://nigel.mcnie.name/blog/uploadmaxfilesizepostmaxsize-experimentation">posts</a> which explains PHP file upload related config in some details.</div>
<h3>Change in Nginx config</h3>
Add following line to <em>http{..}</em> block in nginx config:
<pre>http {
	#...
        <strong>client_max_body_size 100m;</strong>
	#...
}</pre>
<p class="rtp-info"><strong>Note:</strong> For very large files, you may need to change value of <em>client_body_timeout </em>parameter. Default is 60s.</p>

<h4>Reload PHP-FPM &amp; Nginx</h4>
<pre class="prettyprint">service php5-fpm reload
service nginx reload</pre>
<h3>Changes in WordPress-Multisite</h3>
If you are running <a title="Creating WordPress Multisite network with Nginx" href="https://easyengine.io/tutorials/creating-wordpress-multisite-network-nginx/">WordPress Multisite setup</a>, then you may need to make one more change at the WordPress end.

Go to: <em>Network Admin Dashboard &gt;&gt; Settings</em>. Look for <strong>Upload Settings</strong>

Also change value for <strong>Max upload file size</strong>

<img class="size-full wp-image-13949 alignnone" title="Max Upload file size - WordPress Multisite" src="https://easyengine.io/wp-content/uploads/2012/09/Max-Upload-file-size-WordPress-Multisite.png" alt="" width="589" height="189" />
<h3>More...</h3>
<ul>
	<li><a title="Increase PHP script execution time with Nginx" href="https://easyengine.io/tutorials/increasing-php-script-execution-time-nginx/">You may need to change PHP max execution time limit also.</a></li>
	<li><a title="Maintaining, Optimizing &amp; Debugging WordPress-Nginx Setup" href="https://easyengine.io/tutorials/maintaining-optimizing-debugging-wordpress-nginx-setup/">More optimization tips for WordPress-Nginx setup</a></li>
</ul>
&nbsp;