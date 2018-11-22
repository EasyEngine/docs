---
ID: 142680
post_title: HTTP Request Cycle
author: Rahul Bansal
post_excerpt: How a request is processed in EasyEngine
layout: handbook
permalink: >
  https://easyengine.io/handbook/internal/request-cycle/
published: true
post_date: 2018-11-20 13:39:01
---
<!-- wp:paragraph -->
<p>This document shows how a request is processed in EasyEngine in different scenarios.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Let's assume there are two sites on our server:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul><li><code>example-html.com</code> - a  HTML site</li><li> <code>example-wp.com</code> - a WordPress site. This might be a site with or without cache.</li></ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p>Then here's how the request will be routed internally in EasyEngine depending on site type:</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>HTML Site</h2>
<!-- /wp:heading -->

<!-- wp:image -->
<figure class="wp-block-image"><img src="https://user-images.githubusercontent.com/8456197/48048315-1ca03800-e1c1-11e8-8a38-2ca1c622bae8.png" alt="ee4 site diagram-html"/></figure>
<!-- /wp:image -->

<!-- wp:list {"ordered":true} -->
<ol><li>User requests for <a href="https://example-html.com">https://example-html.com</a>. The request is received by nginx-proxy on port 443. SSL is terminated here.</li><li>nginx-proxy forwards the request to site's nginx container on port 80.</li><li>The site's nginx gives the response to nginx-proxy.</li><li>nginx-proxy forwards the&nbsp;response to the user.</li></ol>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>WordPress site without Cache</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>EasyEngine offers a few customization options when creating site. Following image shows use of global containers.</p>
<!-- /wp:paragraph -->

<!-- wp:image -->
<figure class="wp-block-image"><img src="https://user-images.githubusercontent.com/8456197/48048312-1ca03800-e1c1-11e8-808e-0fc7d058713a.png" alt="ee4 site diagram-wp non cached"/></figure>
<!-- /wp:image -->

<!-- wp:list {"ordered":true} -->
<ol><li>User requests for <a href="https://example-wp.com">https://example-wp.com</a>. The request is received by nginx-proxy on port 443. SSL is terminated here.</li><li>nginx-proxy forwards the request to site's nginx container on port 80.</li><li>The site's nginx then forwards the request to the site's PHP container.</li><li>PHP container process the request, and interacts with database if needed</li><li>PHP container returns the response to site's nginx container</li><li>The site's nginx forwards the response to nginx-proxy.</li><li>nginx-proxy forwards the response to user.</li></ol>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>WordPress site with Cache</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>EasyEngine offers a few customization options when creating site. Following image shows use of global containers.</p>
<!-- /wp:paragraph -->

<!-- wp:image -->
<figure class="wp-block-image"><img src="https://user-images.githubusercontent.com/8456197/48048311-1c07a180-e1c1-11e8-875c-cce8d20c9e26.png" alt="ee4 site diagram-wp with cache"/></figure>
<!-- /wp:image -->

<!-- wp:list {"ordered":true} -->
<ol><li>User requests for <a href="https://example-wp.com">https://example-wp.com</a>. The request is received by nginx-proxy on port 443. SSL is terminated here.</li><li>nginx-proxy forwards the request to site's nginx container on port 80.</li><li>The site's nginx then forwards the request to the Redis.</li><li>If the request is cached, then Redis forwards the cached response to site's nginx (Skip step 5-8).</li><li>If the request is not cached, the site's nginx forwards the request to PHP.</li><li>PHP process request, and interacts with the database if needed.</li><li>PHP container returns the response to site's nginx.</li><li>Site's nginx stores the response in the cache.</li><li>The site's nginx forwards the response to nginx-proxy.</li><li>nginx-proxy forwards the response to <g class="gr_ gr_31 gr-alert gr_gramm gr_inline_cards gr_run_anim Grammar only-ins doubleReplace replaceWithoutSep" id="31" data-gr-id="31">user</g>.</li></ol>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p></p>
<!-- /wp:paragraph -->