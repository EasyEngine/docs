---
ID: 4383
post_title: >
  Nginx Rewrite Rules for iTranslator
  WordPress Plugin
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/wordpress-nginx/tutorials/plugins/itranslator/
published: true
post_date: 2012-05-02 17:34:42
---
For a client, who uses this now outdated, <a href="http://wordpress.org/plugins/best-seo-itranslator-for-wordpress/">best-seo-itranslator-for-wordpress</a> plugin, we created following rewrite rules:
<h3>For Nginx</h3>
Add following codes in your example.com <code>server {..}</code> block
<pre class="nginx">location ^~ /trans/{
    rewrite /trans/(.+?)/(.*)$ /wp-content/plugins/best-seo-itranslator-for-wordpress/translonator.php?act=doTranslatePage&amp;lang=$1&amp;dir=$2;
}</pre>
Above rules are created for following apache codes:
<pre>RewriteRule ^trans/(.+?)/(.*?)$ wp-content/plugins/best-seo-itranslator-for-wordpress/translonator.php?act=doTranslatePage&amp;lang=$1&amp;dir=$2 [NC,L]</pre>