---
ID: 25102
post_title: Enabling FastCGI on MediaTemple
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/enable-fastcgi-php-mediatemple/
published: true
post_date: 2010-04-29 08:46:42
---
This article applies to enabling FastCGI support for PHP scripts on MediaTemple hosting.

Following sequence of commands/actions as mentioned below. Order is important!
<h3>1. Check how your PHP scripts are served?</h3>
Create a file with name <strong>"info.php"</strong> on your domains webroot directory - example path:** "/var/www/vhosts/example.com/"**

Add following codes in it.** **
<pre>&lt;?php phpinfo(); ?&gt;<strong></strong></pre>
After saving file like above access URL from browser: <strong>http://example.com/info.php</strong>

In output, look for option <strong>Server API **and its value. It must be **"CGI/FastCGI"</strong>.

In following screenshot, originally taken from a domain on MediaTemple account you can see below <strong>Server API</strong> is set to <strong>"Apache 2.0 Handler"</strong>

**<a href="http://wiki.rtcamp.com/enabling-fastcgi-on-mediatemple/phpinfo-says-apache-2/" rel="attachment wp-att-53"><img class="alignnone size-large " title="phpinfo() says Apache-2" alt="" src="http://wiki.rtcamp.com/files/2010/04/phpinfo-says-Apache-2-600x481.png" width="600" height="481" /></a> **
<h3>2. Login via Plesk panel and enable CGI as well as FASTCGI support for the domain in question, say for example.com</h3>
For domain in question, make sure following options are configures:
<ul>
	<li><strong>PHP</strong> - Enabled</li>
	<li><strong>PHP 'safe_mode'</strong> - Disabled</li>
	<li><strong>CGI</strong> - Enabled</li>
	<li><strong>FastCGI</strong> - Disabled</li>
</ul>
See following screenshot for reference:

<a href="http://wiki.rtcamp.com/enabling-fastcgi-on-mediatemple/plesk-8-6-0-cgi-fastcgi-settings-1/" rel="attachment wp-att-56"><img class="alignnone size-large wp-image-56" title="Plesk 8.6.0 - CGI, FASTCGI Settings-1" alt="" src="http://wiki.rtcamp.com/files/2010/04/Plesk-8.6.0-CGI-FASTCGI-Settings-1-600x350.png" width="600" height="350" /></a>
<h3>3. Login as root over SSH and execute following commands</h3>
<h3>1. Move to webroot directory for exmaple.com</h3>
<pre>cd /var/www/vhosts/example.com</pre>
<h3>2. Copy <strong>php-cgi</strong> file to <strong>bin</strong> sub-directory under **example.com **</h3>
<pre>cp /usr/bin/php-cgi bin/</pre>
<h3>3. Change owner for <strong>bin</strong> directory and its content (that includes php-cgi file)</h3>
<pre>chown -R username:psacln bin</pre>
<em>(replace username with your FTP login name for this domain)</em>
<h3>4. Create a <strong>vhost.conf</strong> file in <strong>conf</strong> sub-directory under **example.com **</h3>
<pre>vi conf/vhost.conf</pre>
<h3>5. Paste following content in that file. <strong>DO NOT</strong> forget to replace <strong>example.com</strong> with your actual domain name.* *</h3>
<pre>AddHandler fcgid-script .php .php5
&lt;Directory /var/www/vhosts/example.com/httpdocs&gt;
   FCGIWrapper /var/www/vhosts/example.com/bin/php-cgi .php
 allow from all
&lt;/Directory&gt;</pre>
<h3>6. Run following command so that Plesk will update its configuration including apache server restart</h3>
<pre>/usr/local/psa/admin/sbin/websrvmng -a -v</pre>
<h3>7. Jump to the first step and verify PHP Server API. It should now look like as highlighted in following screenshot.</h3>
<a href="http://wiki.rtcamp.com/enabling-fastcgi-on-mediatemple/phpinfo-says-fastcgi-now/" rel="attachment wp-att-57"><img class="alignnone size-large wp-image-57" title="phpinfo() says FASTCGI now" alt="" src="http://wiki.rtcamp.com/files/2010/04/phpinfo-says-FASTCGI-now-600x548.png" width="600" height="548" /></a>
<h3>8.DO NOT forget to change owner of files that were created using PHP running as Apache module</h3>
<pre><strong>cd httpdocs</strong>             #DO NOT FORGET THIS COMMAND ELSE YOU WILL CRY FOR SURE
chown -R username:psacln *<em></em></pre>
<strong>(replace username with your FTP login name for this domain)</strong>