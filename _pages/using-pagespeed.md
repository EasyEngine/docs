---
ID: 74877
post_title: Using Pagespeed
author: Gaurav
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/nginx/using-pagespeed/
published: true
post_date: 2014-10-16 18:23:28
---
<p class="error">Note: This feature is depreciated with <a href=https://easyengine.io/blog/easyengine-3-6-nginx-1-10-ubuntu-16-04-support/>EasyEngine v3.6.0.</a></p>
<p class="alert">Note: Test your site properly before using this in production.</p>

<h2>Adding Nginx repo</h2>
If you are EasyEngine user then you can skip this step

<em>For Ubuntu 12.04/14.04:</em>
<pre class="no-highlight">add-apt-repository -y ppa:rtcamp/nginx
apt-get update</pre>
<em>For Debian 6/7:</em>
<pre>echo "deb http://packages.dotdeb.org $(lsb_release -sc) all" &gt; /etc/apt/sources.list.d/dotdeb-$(lsb_release -sc).list
apt-get update</pre>
<h2>Installation of Nginx Pagespeed</h2>
<em>For Ubuntu 12.04/14.04:</em>
<pre class="bash">apt-get install nginx-custom</pre>
<em>Note: If you are using EasyEngine then this step is not required</em>

<em>For Debian 6/7:</em>
<pre class="bash">apt-get install nginx-extras</pre>
This will install nginx-extras on your server, by removing nginx-full.
<h2>Creating Pagespeed global configuration</h2>
Create new pagespeed global configuration file
<pre class="bash">vim /etc/nginx/conf.d/pagespeed.conf</pre>
and paste following code into it
<pre class="prettyprint"># Turning the module on and off
pagespeed on;

# Configuring PageSpeed Filters
pagespeed RewriteLevel PassThrough;

# Needs to exist and be writable by nginx.  Use tmpfs for best performance.
pagespeed MemcachedServers "127.0.0.1:11211";
pagespeed FileCachePath /var/ngx_pagespeed_cache;

# PageSpeed Admin
pagespeed StatisticsPath /ngx_pagespeed_statistics;
pagespeed GlobalStatisticsPath /ngx_pagespeed_global_statistics;
pagespeed MessagesPath /ngx_pagespeed_message;
pagespeed ConsolePath /pagespeed_console;
pagespeed AdminPath /pagespeed_admin;
pagespeed GlobalAdminPath /pagespeed_global_admin;

# PageSpeed Cache Purge
<span class="pln">pagespeed </span><span class="typ">EnableCachePurge</span><span class="pln"> on</span><span class="pun">;</span><span class="pln">
pagespeed </span><span class="typ">PurgeMethod</span><span class="pln"> PURGE</span><span class="pun">;</span></pre>
<h2>Creating site specific Pagespeed configuration</h2>
Create new site specific configuration file
<pre class="bash">vim /etc/nginx/common/pagespeed.conf</pre>
Paste following code into it
<pre class="bash"># PageSpeed Admin
location /ngx_pagespeed_statistics { include common/acl.conf; }
location /ngx_pagespeed_global_statistics { include common/acl.conf; }
location /ngx_pagespeed_message { include common/acl.conf; }
location /pagespeed_console { include common/acl.conf; }
location ~ ^/pagespeed_admin { include common/acl.conf; }
location ~ ^/pagespeed_global_admin { include common/acl.conf; }

# Ensure requests for pagespeed optimized resources go to the pagespeed handler
# and no extraneous headers get set.
location ~ "\.pagespeed\.([a-z]\.)?[a-z]{2}\.[^.]{10}\.[^.]+" {
  add_header "" "";
}
location ~ "^/pagespeed_static/" { }
location ~ "^/ngx_pagespeed_beacon$" { }
</pre>
&nbsp;
<h3>Enable Pagespeed for site</h3>
Open site Nginx configuration:
<pre class="bash">vim /etc/nginx/sites-available/example.com</pre>
add following line at in the configurations:
<pre class="bash">include common/pagespeed.conf;</pre>
and restart Nginx
<pre class="bash">nginx -t &amp;&amp; service nginx restart</pre>
<h3>Enable/Disable PageSpeed Filters</h3>
&nbsp;

Please paste following filter inside <code>/etc/nginx/sites-available/example.com</code>

&nbsp;
<pre class="bash"># HTTPS Support
# pagespeed FetchHttps enable;

# PageSpeed Filters
# CSS Minification
# pagespeed EnableFilters combine_css,rewrite_css;

# JS Minification
# pagespeed EnableFilters combine_javascript,rewrite_javascript;

# Images Optimization
#pagespeed EnableFilters lazyload_images;
#pagespeed EnableFilters rewrite_images;
#pagespeed EnableFilters convert_jpeg_to_progressive,convert_png_to_jpeg,convert_jpeg_to_webp,convert_to_webp_lossless;

# Remove comments from HTML 
#pagespeed EnableFilters remove_comments; 
# Remove WHITESPACE from HTML 
#pagespeed EnableFilters collapse_whitespace;

# CDN Support
#pagespeed MapRewriteDomain cdn.example.com www.example.com;</pre>
&nbsp;

By default we commented all filters. You can uncomment filters that you need for your site.

Also you can add various filters from here to this file: <a title="https://developers.google.com/speed/pagespeed/module/filters" href="https://developers.google.com/speed/pagespeed/module/filters">https://developers.google.com/speed/pagespeed/module/filters</a>
<h2>Test your site</h2>
You can test site by pointing browser to example.com, and seeing its html code.
<h2>View Pagespeed statistics</h2>
You can view Pagespeed statics by poinitng your browser to <a title="http://example.com/ngx_pagespeed_statistics" href="http://example.com/ngx_pagespeed_statistics">http://example.com/ngx_pagespeed_statistics</a>
<h2>Disable Pagespeed temporary</h2>
You can disable pagespeed temporary by using this url: <a title="http://example.com/?PageSpeed=off" href="example.com/?PageSpeed=off">http://example.com/?PageSpeed=off</a>
<h2>Purge Pagespeed Cache</h2>
You can purge specific file cache by hitting following url http://exmple.com/pagespeed_admin/cache?purge=/path/file.ext<code></code>

&nbsp;