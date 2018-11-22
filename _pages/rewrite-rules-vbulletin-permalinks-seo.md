---
ID: 23906
post_title: >
  Rewrite Rules for vBulletin SEO-friendly
  permalinks
author: Rahul Bansal
post_excerpt: >
  Nginx Rewrite Rules for using
  SEO-friendly permalinks on vBulletin
  forums. Code snippets for running
  vBulletin on root domain and
  vBulletin-in-subdirectory are provided.
layout: page
permalink: >
  https://easyengine.io/tutorials/nginx/rewrite-rules-vbulletin-permalinks-seo/
published: true
post_date: 2013-02-19 06:36:28
---
We use and recommend <a href="http://bbpress.org/">bbPress</a> for forums strongly.

But we recently migrated a clients' sites from Apache-server to Nginx and among his sites there were few using vBulletin forum with permalinks configured on Apache.

Below is code snippet that handled vBulletin permalinks on Nginx nicely. If you find any particular vBulletin links broken, please let us know so we can try to debug it. This was first incident where we dealt with vBulletin so our codes might be inaccurate.
<h4>If vBulletin forum is in root-dir then, use:</h4>
<pre class="nginx">     location / {
              rewrite /threads/.*$             /showthread.php?$args   last;
              rewrite /forums/.*$              /forumdisplay.php?$args last;
              rewrite /members/.*$             /member.php?$args       last;
              rewrite /blogs/.*$               /blog.php?$args         last;
              rewrite /entries/.*$             /entry.php?$args        last;
        }</pre>
<h4>If vBulletin forum is in a sub-directory e.g. <code>/forum</code> then, use:</h4>
<pre class="nginx">     location /forum/ {
              rewrite /threads/.*$             /forum/showthread.php?$args   last;
              rewrite /forums/.*$              /forum/forumdisplay.php?$args last;
              rewrite /members/.*$             /forum/member.php?$args       last;
              rewrite /blogs/.*$               /forum/blog.php?$args         last;
              rewrite /entries/.*$             /forum/entry.php?$args        last;
        }</pre>
Please surround above code-snippets with other necessary config.

You can find some samples in our <a href="https://easyengine.io/series/wordpress-nginx-tutorials/">WordPress-Nginx tutorials series</a>.