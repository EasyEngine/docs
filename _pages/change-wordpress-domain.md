---
ID: 40389
post_title: Change WordPress Domain Name
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/mysql/change-wordpress-domain/
published: true
post_date: 2013-06-21 18:16:57
---
If you ever decided to change your WordPress site's domain, firing up following MySQL queries can reduce internal redirections.
<h3>Assumptions:</h3>
<ol>
	<li><span ><code>old.com</code> is old-domain</span></li>
	<li><code>new.com</code> is new-domain</li>
</ol>
<h3>Queries:</h3>
<pre class="no-highlight">UPDATE `wp_options` SET option_value = replace(option_value, 'http://www.old.com', 'http://www.new.com') WHERE option_name = 'home' OR option_name = 'siteurl';
UPDATE `wp_posts` SET post_content = replace(post_content,'http://old.com','http://new.com');
UPDATE `wp_postmeta` SET meta_value = replace(meta_value,'http://old.com','http://new.com');
UPDATE `wp_comments` SET comment_author_url = replace(comment_author_url,'http://old.com','http://new.com');
UPDATE `wp_comments` SET comment_content = replace(comment_content,'http://old.com','http://new.com');
UPDATE `wp_commentmeta` SET meta_value = replace(meta_value,'http://old.com','http://new.com');</pre>
Above will take care of, options table, posts &amp; comments. If you have any other database table/column which need change you can run queries like below any number of times:
<pre>UPDATE `TABLE_NAME` SET meta_value = replace(COLUMN_NAME,'http://old.com','http://new.com');</pre>