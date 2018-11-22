---
ID: 142747
post_title: Mailhog
author: Rahul Bansal
post_excerpt: 'Mailhog is web-based interface to test & debug outgoing email from your application.'
layout: handbook
permalink: https://easyengine.io/handbook/mailhog/
published: true
post_date: 2018-11-20 17:59:49
---
<!-- wp:paragraph -->
<p><a href="https://github.com/mailhog/MailHog">Mailhog</a> is a utility that captures and displays emails sent by your application in the web browser. It is good to test &amp; debug outgoing email content in development environment.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>To use Mailhog, first of all, you'll have to enable it using:</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>ee mailhog enable example.com</code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p>Then <g class="gr_ gr_9 gr-alert gr_gramm gr_inline_cards gr_run_anim Style multiReplace" id="9" data-gr-id="9">open </g><code>example.com/ee-admin/mailhog</code><g class="gr_ gr_9 gr-alert gr_gramm gr_inline_cards gr_disable_anim_appear Style multiReplace" id="9" data-gr-id="9"> in</g> the browser.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>If you get a prompted for authentication, please run following command to find credential.</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>ee auth list global</code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p><em>⚠️ Please remember to disable mailhog after you finish testing. Your sites email won't be delivered to it's intended recipient as long as mailhog is running.</em></p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>ee mailhog disable example.com</code></pre>
<!-- /wp:code -->