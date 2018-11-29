---
ID: 143306
post_title: MySQL Root Access
author: Kirtan Gajjar
post_excerpt: ""
layout: handbook
permalink: >
  https://easyengine.io/handbook/mysql-root-access/
published: true
post_date: 2018-11-29 14:56:12
---
<!-- wp:paragraph -->
<p>If you want root access to MySQL's root account, you can run the following command for now. We'll add a command for it in later EasyEngine releases:</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>docker exec -it ee-global-db bash -c 'mysql -uroot -p${MYSQL_ROOT_PASSWORD}'</code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p></p>
<!-- /wp:paragraph -->