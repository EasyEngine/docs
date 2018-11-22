---
ID: 142745
post_title: Debugging
author: Kirtan Gajjar
post_excerpt: ""
layout: handbook
permalink: >
  https://easyengine.io/handbook/debugging/
published: true
post_date: 2018-11-20 17:25:20
---
<!-- wp:paragraph -->
<p>Run following command to check the resource usage of containers:</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>docker stats --no-stream</code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p>In order to sort output, you can run following commands:</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Sort by Memory: </p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>docker stats --no-stream | sort -k 5</code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p>Sort by CPU:</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>docker stats --no-stream | sort -k 3</code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p><br></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>&nbsp;</p>
<!-- /wp:paragraph -->