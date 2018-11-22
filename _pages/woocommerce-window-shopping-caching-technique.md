---
ID: 134114
post_title: >
  WooCommerce Window Shopping Caching
  Technique
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/wordpress/woocommerce-window-shopping-caching-technique/
published: true
post_date: 2016-06-07 16:09:23
---
This article describes a very aggressive full-page caching techniques for Woo-Commerce stores.

We are using this technique from long time and even talked about it at WordCamp Mumbai 2016. Slides below:

http://www.slideshare.net/rtcamp/scaling-woocommerce-wordcamp-mumbai-2016
<h2>Nginx Configuration</h2>
Below is almost complete Nginx configuration. As there are many different ways to write Nginx configuration, following may seem odd to you.

This is based on our <a href="https://easyengine.io/wordpress-nginx/tutorials/">WordPress-Nginx tutorial series</a>.

Later in this article, we describe working principle behind this.
<pre class="no-highlight"># WPSINGLE BASIC NGINX CONFIGURATION
server {

	server_name example.com www.example.com;

	access_log   /var/log/nginx/example.com.access.log rt_cache;
	error_log    /var/log/nginx/example.com.error.log ;

	root /var/www/example.com/htdocs;
	index index.php index.htm index.html;

	fastcgi_cache_use_stale error timeout invalid_header http_500;

	set $skip_cache 0;

	# POST requests and urls with a query string should always go to PHP
	if ($request_method = POST) {
		set $skip_cache 1;
	}   
	if ($query_string != "") {
		set $skip_cache 1;
	}   

	if ( $cookie_woocommerce_items_in_cart = "1" ){
		 set $skip_cache 1;
	}

	# Don't cache uris containing the following segments
	if ($request_uri ~* "(/shop.*|/cart.*|/my-account.*|/checkout.*|/addons.*|/wp-admin/|/xmlrpc.php|wp-.*.php|index.php") {
		set $skip_cache 1;
	}   

	# Don't use the cache for logged in users or recent commenters
	if ($http_cookie ~* "comment_author|wordpress_[a-f0-9]+|wp-postpass|wordpress_no_cache|wordpress_logged_in") {
		set $skip_cache 1;
	}
	location / {
		try_files $uri $uri/ /index.php?$args;
	}   

	
 
	location ~ \.php$ {
	 	set $rt_session "";
	 	
		if ($http_cookie ~* "wp_woocommerce_session_[^=]*=([^%]+)%7C") {
               		set $rt_session wp_woocommerce_session_$1;
       		}	
	
		if ($skip_cache = 0 ) {
			more_clear_headers "Set-Cookie*";
			set $rt_session "";
		}
		
	        fastcgi_cache_key "$scheme$request_method$host$request_uri$rt_session";

		try_files $uri =404;
		include fastcgi_params;
		fastcgi_pass php;

		fastcgi_cache_bypass $skip_cache;
	        fastcgi_no_cache $skip_cache;

		fastcgi_cache WORDPRESS;
		fastcgi_cache_valid  60m;
	}

	include /etc/nginx/common/wpcommon.conf;
	include /etc/nginx/common/locations.conf;

}</pre>
<h2>How it works?</h2>
<h3><a id="user-content-1-cache-product-pages" class="anchor" href="https://gist.github.com/rahul286/dc64ae84c97868b862c4#1-cache-product-pages"></a>1. Cache product pages</h3>
Following line does't have <code>/products.*</code> page. This tells Nginx to cache all product pages by default. Please make sure your store URL is not BYPASS'ed from Nginx Cache.

Fast loading product pages will improve scalability of a store and also conversion.
<pre><code>    # Don't cache uris containing the following segments
    if ($request_uri ~* "(/shop.*|/cart.*|/my-account.*|/checkout.*|/addons.*|/wp-admin/|/xmlrpc.php|wp-.*.php|index.php") {
        set $skip_cache 1;
    }
</code></pre>
<h3><a id="user-content-2-stop-caching-as-soon-as-a-visitor-adds-something-to-cart" class="anchor" href="https://gist.github.com/rahul286/dc64ae84c97868b862c4#2-stop-caching-as-soon-as-a-visitor-adds-something-to-cart"></a>2. Stop caching as soon as a visitor adds something to cart</h3>
WooCommerce uses a cookie <code>woocommerce_items_in_cart</code> to track if something is added to cart. It is 0 (zero) by default. The value changes to "1" (one) as soon as a visitor add first product to cart. The value stays "1" even if a user adds more items to cart. The cookie is used as binary flag.
<pre><code>    if ( $cookie_woocommerce_items_in_cart = "1" ){
         set $skip_cache 1;
    }
</code></pre>
Above code snippet starts skipping cache as soon as first item is added to the cart.
<h3><a id="user-content-3-prevent-unique-woocommerce-session-for-window-shoppers" class="anchor" href="https://gist.github.com/rahul286/dc64ae84c97868b862c4#3-prevent-unique-woocommerce-session-for-window-shoppers"></a>3. Prevent unique WooCommerce session for "window shoppers"</h3>
WooCommerce sets a session cookie for every new visitor by default.

If a cookie header get's cached in Nginx's fastcgi-cache, that cookie will be delivered to all visitors creating "session-conflict" or "cart-conflict".

In simple words, it he do not take care of cookies, items added by one visitor might appear in another visitors cart.

So we need to prevent cookies for "window shoppers".

<code>more_clear_headers</code> is a NGINX module which clears <code>Set-Cookie</code> header from upstream PHP/WordPress' HTTP response.
<pre><code>        if ($skip_cache = 0 ) {
            more_clear_headers "Set-Cookie*";
            set $rt_session "";
        }
</code></pre>
<h3><a id="user-content-4-keep-track-of-woocommerce-sessions-for-real-shoppers" class="anchor" href="https://gist.github.com/rahul286/dc64ae84c97868b862c4#4-keep-track-of-woocommerce-sessions-for-real-shoppers"></a>4. Keep track of WooCommerce sessions for "real shoppers"</h3>
The third line in above code block has a variable <code>$rt_session</code>. This is a custom NGINX variable which will have null (same) value when cached pages are supposed to be served.

The same value is acceptable because all cached pages will look same. The custom variable is used inside NGINX fastcgi-cache key on line:

<code>fastcgi_cache_key "$scheme$request_method$host$request_uri$rt_session";</code>

The custom variable <code>$rt_session</code> is used further to set to a unique value for each shopping session. This is needed because different users might have different cart content. So they must not see each other's cache.

This is done by following lines:
<pre><code>if ($http_cookie ~* "wp_woocommerce_session_[^=]*=([^%]+)%7C") {
            set $rt_session wp_woocommerce_session_$1;
    }
</code></pre>
Above basically set <code>$rt_session</code> to <code>wp_woocommerce_session_</code> id.

This variable is set on each request, but line <code>set $rt_session "";</code> in previous step ensures we do not have unique cache key for "window shoppers". This avoids cache fragmentation.
<h2><a id="user-content-notes" class="anchor" href="https://gist.github.com/rahul286/dc64ae84c97868b862c4#notes"></a>Notes</h2>
<ol>
 	<li>This technique might break some WooCommerce addons which depends on <code>wp_woocommerce_session</code> from beginning. In reality I haven't seen a single addon breaking. But we hardly tested a dozen WooCommerce addons.</li>
</ol>
<strong>Links:</strong> <a href="http://www.slideshare.net/rtcamp/scaling-woocommerce-wordcamp-mumbai-2016">Scaling WooCommerce </a>
<h2></h2>