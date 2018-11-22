---
ID: 38186
post_title: YARPP and InnoDB
author: Rahul Bansal
post_excerpt: >
  YARPP works with InnoDB engine. Useful
  for large WordPress sites with tons of
  users, as MyISAM can seriously degrade
  performance.
layout: page
permalink: >
  https://easyengine.io/tutorials/mysql/yarpp-innodb/
published: true
post_date: 2013-07-02 18:45:29
---
Only thing I thought we will loose when <a href="https://easyengine.io/wordpress-nginx/tutorials/mysql/myisam-to-innodb/">switching from MyISAM to InnoDB</a> was awesome Yet Another Related Posts Plugins.

But while surfing YARPP plugin's support forum, I got to know it works nicely with InnoDB also. It shows a warning, which can be ignored.

<img class="alignnone size-full wp-image-38188" alt="yarpp-innodb-myisam-warning" src="https://easyengine.io/wp-content/uploads/2013/05/yarpp-innodb-myisam-warning.png" width="623" height="211" />

Once you ignore the warning, you need to tweak your relatedness settings with categories and tags.
<h2>Relatedness options</h2>
<img class="alignnone size-full wp-image-38192" alt="yarpp-innodb-relatedness-options" src="https://easyengine.io/wp-content/uploads/2013/05/yarpp-innodb-relatedness-options.png" width="615" height="460" />

Please note that you can not use title and bodies. They require FULLTEXT search. MySQL 5.6 supports FULLTEXT index for InnoDB engine but YARPP plugin is not updated for this new MySQL 5.6 addition.

I tried reaching Mitcho but did not get any response. So for now, we are using YARPP with less relevant match but its still better than nothing!
<h3>InnoDB is more important that relatedness accuracy</h3>
This WordPress setup has a blog post, products' documentation (500+ pages), bbPress forum, woocommerce, our own WordPress-based CRM and some more functionality. All of these uses WordPress posts and postmeta table. So MyISAM tables were slowing down a lot because MyISAM do not support row-level locking.

We are getting faster page-loading for logged in users since we moved to InnoDB! Its fast enough to sacrifice relatedness accuracy.