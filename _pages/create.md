---
ID: 131070
post_title: create
author: Dinesh Jain
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/docs/commands/site/create/
published: true
post_date: 2015-11-23 12:12:00
---
<h2 id="html-website">HTML Website</h2>
To create simple html website use this command.
<pre><code>ee site create example.com --html
</code></pre>
<div data-unique="PHPWebsite"></div>
<h2 id="php-website">PHP Website</h2>
To create simple php website with no database use this command.
<pre><code>ee site create example.com --php</code></pre>
<h2 id="phpmysql-website">PHP+MySQL Website</h2>
To create simple php website with database use this command.
<pre><code>ee site create example.com --mysql
</code></pre>
NOTE: You can find MySQL database details in <code>ee-config.php</code> file.
<div data-unique="WordPressSite"></div>
<h2>Enable SSL using Let's Encrypt</h2>
EasyEngine supports Let's Encrypt out of the box.
<pre><code>ee site create example.com --letsencrypt
</code></pre>
You can add <code>--letsencrypt</code> to any other flag.

<a href="https://easyengine.io/docs/lets-encrypt/">Read more about EasyEngine + Let's Encrypt</a>.
<h2 id="wordpress-site">WordPress Site</h2>
Following are the WordPress website types you can create website based on
<ul>
 	<li>Cache Mechanism</li>
 	<li>WordPress type (Single/Multisite)</li>
</ul>
<div data-unique="StandardWordPressSites"></div>
<h3 id="standard-wordpress-sites">Standard WordPress Sites</h3>
To create Standard/Single WordPress site use following command.
<pre><code>ee site create example.com --wp # install wordpress without any page caching
ee site create example.com --w3tc # install wordpress with w3-total-cache plugin
ee site create example.com --wpsc # install wordpress with whisp-super-cache plugin
ee site create example.com --wpfc # install wordpress + nginx fastcgi_cache
ee site create example.com --wpredis # install wordpress + nginx redis_cache
</code></pre>
<div data-unique="WordPressMultisitewithsubdirectory"></div>
<h3 id="wordpress-multisite-with-subdirectory">WordPress Multisite with subdirectory</h3>
To create WordPress Multisite with subdirectory setup use from following command.
<pre><code>ee site create example.com --wpsubdir # install wpmu-subdirectory without any page caching
ee site create example.com --wpsubdir --w3tc # install wpmu-subdirectory with w3-total-cache plugin
ee site create example.com --wpsubdir --wpsc # install wpmu-subdirectory with wp-super-cache plugin
ee site create example.com --wpsubdir --wpfc # install wpmu-subdirectory + nginx fastcgi_cache
ee site create example.com --wpsubdir --wpredis # install wpmu-subdirectory + nginx redis_cache
</code></pre>
<div data-unique="WordPressMultisitewithsubdomain"></div>
<h3 id="wordpress-multisite-with-subdomain">WordPress Multisite with subdomain</h3>
To create WordPress Multisite with subdomain setup use from following command.
<pre><code>ee site create example.com --wpsubdom # install wpmu-subdomain without any page caching
ee site create example.com --wpsubdom --w3tc # install wpmu-subdomain with w3-total-cache plugin
ee site create example.com --wpsubdom --wpsc # install wpmu-subdomain with wp-super-cache plugin
ee site create example.com --wpsubdom --wpfc # install wpmu-subdomain + nginx fastcgi_cache
ee site create example.com --wpsubdom --wpredis # install wpmu-subdomain + nginx redis_cache
</code></pre>
<div data-unique="DefineWordPressadministratoruser"></div>
<h3 id="define-wordpress-administrator-user">Define WordPress administrator user</h3>
To define wordpress administrator user during site creation use
<pre><code>ee site create example.com --user=admin
</code></pre>
This will create admin as administrator user in wordpress during installation. If not defined it will take git user name.
<div data-unique="DefineWordPressadministratorpassword"></div>
<h3 id="define-wordpress-administrator-password">Define WordPress administrator password</h3>
To define wordpress administrator password during site creation use
<pre><code>ee site create example.com --pass=password
</code></pre>
This will set defined password as administrator password. If not defined it will generate random pasword for administrator. If you have special characters, you can quote them using single quotes like this -
<pre><code>--pass='my$secret&amp;'
</code></pre>
<div data-unique="DefineWordPressadministratoremail"></div>
<h3 id="define-wordpress-administrator-email">Define WordPress administrator email</h3>
To define wordpress administrator email during site creation use
<pre><code>ee site create example.com --email=ee@example.com
</code></pre>
This will set defined email as administrator email. If not defined it will set git email as administrator email.
<div data-unique="HHVMSite"></div>
<h2 id="hhvm-site">HHVM Site</h2>
(Note: This feature is available with EasyEngine 3.1.0 and onwards)

To create site with HHVM you can use <code>--hhvm</code> during site creation

For example, you can create WordPress site running on HHVM using following command:
<pre><code>ee site create example.com --wp --hhvm
</code></pre>
<div data-unique="PagespeedSite"></div>
<h2 id="pagespeed-site">Pagespeed Site</h2>
<p class="error">Note: This feature is depreciated with <a href="https://easyengine.io/blog/easyengine-3-6-nginx-1-10-ubuntu-16-04-support/">EasyEngine v3.6.0.</a></p>
To create site with Pagespeed you can use <code>--pagespeed</code> during site creation

For example, you can create WordPress site running with Pagespeed using following command:
<pre><code>ee site create example.com --wp --pagespeed
</code></pre>
By default EasyEngine does not enables any filters for Pagespeed, you can add various filters from https://developers.google.com/speed/pagespeed/module/config_filters using command
<pre><code>ee site edit example.com --pagespeed
</code></pre>
<div data-unique="Proxysite">
<h2 id="hhvm-site">PHP 7.0 Site</h2>
(Note: This feature is available with EasyEngine 3.5.0 and onwards)

To create site with PHP 7.0 you can use <code>--php7</code> during site creation

For example, you can create WordPress site running on PHP 7.0 using following command:
<pre><code>ee site create example.com --wp --php7
</code></pre>
To create simple php(with v7.0) website with no database use this command.

</div>
<div data-unique="Proxysite">
<div data-unique="PHP+MySQLWebsite">
<pre><code>ee site create example.com --php7
</code></pre>
</div>
</div>
<div data-unique="Proxysite"></div>
<h2 id="proxy-site">Proxy site</h2>
(Note: This feature is available with EasyEngine 3.1.2 and onwards)

To create site with Proxy configuration you can use <code>--proxy</code> during site creation
<pre><code>ee site create example.com --proxy=host[:port]
</code></pre>
Here port is optional and default value is 80.

For example,
<pre><code>ee site create example.com --proxy=1.2.3.4
</code></pre>
This will create proxy site example.com with proxy destination as 1.2.3.4