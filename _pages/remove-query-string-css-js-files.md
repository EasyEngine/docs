---
ID: 48865
post_title: Remove Query string of css/js files
author: Nitun Lanjewar
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/wordpress/remove-query-string-css-js-files/
published: true
post_date: 2013-10-17 15:39:43
---
Most of the time we found that WordPress use the query string like <strong>?ver= 2.3.7</strong><em><strong> </strong></em> for all the js and css files of wp-content and wp-includes files. So, when we check the performance of our site with <a href="http://gtmetrix.com/">gtmetrix.com</a> or any other online tool, it shows some instruction to reduce that overload.
<blockquote><em>Resources with a "?" in the URL are not cached by some proxy caching servers. Remove the query string and encode the parameters into the URL for the following resources:</em></blockquote>
You can simply put the below mentioned code in your current theme's <strong>function.php</strong> file.
<pre class="php">function rtp_rssv_scripts() {
    global $wp_scripts;
    if (!is_a($wp_scripts, 'WP_Scripts'))
        return;
    foreach ($wp_scripts-&gt;registered as $handle =&gt; $script)
        $wp_scripts-&gt;registered[$handle]-&gt;ver = null;
}

function rtp_rssv_styles() {
    global $wp_styles;
    if (!is_a($wp_styles, 'WP_Styles'))
        return;
    foreach ($wp_styles-&gt;registered as $handle =&gt; $style)
        $wp_styles-&gt;registered[$handle]-&gt;ver = null;
}

add_action('wp_print_scripts', 'rtp_rssv_scripts', 999);
add_action('wp_print_footer_scripts', 'rtp_rssv_scripts', 999);

add_action('admin_print_styles', 'rtp_rssv_styles', 999);
add_action('wp_print_styles', 'rtp_rssv_styles', 999);</pre>
And you are done.
Clear the cache of your site/server and cross check site performance on gtmetrix.com.