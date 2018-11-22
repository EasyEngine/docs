---
ID: 37839
post_title: 'WooCommerce and Nginx&#8217;s fastcgi_cache'
author: Rahul Bansal
post_excerpt: "Nginx rules to tweak WooCommerce's fastcgi-cache so that you won't end up caching store incorrectly."
layout: page
permalink: >
  https://easyengine.io/wordpress-nginx/tutorials/plugins/woocommerce/
published: true
post_date: 2013-07-02 16:46:38
---
If you are using Nginx's fastcgi_cache and WooCommerce, then you may run into issues if you end up caching your cart/checkout pages!

Following are some ways to tweak Nginx config so cache won't cost you business!

Please be careful while using them. Using them all together with other rules might lead to side-effects!
<h3>Skip cache on WooCommerce pages</h3>
Depending on your WooCommerce settings, you may need to change some values below:
<pre class="no-highlight">if ($request_uri ~* "/store.*|/cart.*|/my-account.*|/checkout.*|/addons.*") {
         set $skip_cache 1;
}</pre>
<h3>Skip cache for WooCommerce query string</h3>
We generally shouldn't cache output of query strings but in case you are already caching, you can use this fragment
<pre class="no-highlight">if ( $arg_add-to-cart != "" ) { 
      set $skip_cache 1;
}</pre>
<h3>Skip cache when WooCommerce cart is not empty</h3>
If you have a heavy site, you may to cache store pages for fresh visitors. Its always good to have fast-loading store as it might impact conversion.

WooCommerce uses a cookie to track number of items a user has added to cart.
<pre class="no-highlight">if ( $cookie_woocommerce_items_in_cart != "0" ) {	
	set $skip_cache 1;
}</pre>
Please note, if you use above rule only Nginx will skip cache for entire site as soon as a visitor adds a product in cart. You may want to limit cache to store section only.
<h3>Fastcgi Cache Issue</h3>
Replace following:
<pre class="no-highlight">	location ~ \.php$ {

		try_files $uri =404;</pre>
By:
<pre class="no-highlight">	location ~ \.php$ {
	 	set $rt_session "";

		if ($http_cookie ~* "wc_session_cookie_[^=]*=([^%]+)%7C") {
               		set $rt_session wc_session_cookie_$1;
       		}	

		if ($skip_cache = 0 ) {
			more_clear_headers "Set-Cookie*";
			set $rt_session "";
		}

	        fastcgi_cache_key "$scheme$request_method$host$request_uri$rt_session";

		try_files $uri =404;</pre>
&nbsp;
<h3>Config Links</h3>
Below are links to complete WordPress-Nginx fastcgi config:
<ul>
	<li><a href="https://easyengine.io/wordpress-nginx/tutorials/single-site/fastcgi-cache-with-purging/"><span>Single-WordPress</span></a></li>
	<li><a href="https://easyengine.io/wordpress-nginx/tutorials/multisite/subdirectories/fastcgi-cache-with-purging/">Multisite with Subdirectories</a></li>
	<li><a href="https://easyengine.io/wordpress-nginx/tutorials/multisite/subdomains/fastcgi-cache-with-purging/">Multisite with Subdomains</a></li>
</ul>