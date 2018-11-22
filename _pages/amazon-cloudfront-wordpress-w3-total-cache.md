---
ID: 17171
post_title: >
  Amazon Cloudfront CDN with W3 Total
  Cache WordPress
author: Rahul Bansal
post_excerpt: >
  Use Amazon CloudFront as a generic
  original pull CDN with W3 Total Cache.
  This works nicely with BuddyPress Media.
layout: page
permalink: >
  https://easyengine.io/tutorials/cdn/amazon-cloudfront-wordpress-w3-total-cache/
published: true
post_date: 2012-10-24 13:49:55
---
W3 Total Cache is my favorite plugin when it comes to configuring CDN with WordPress. I already posted <a href="http://devilsworkshop.org/tutorial/maxcdn-setup-on-wordpress-using-w3-total-cache-plugin-wpmu-tutorial/43595/">how to configure MaxCDN with W3 Total Cache</a> almost 2-years back.

Today I will show you how to configure Amazon Cloudfront CDN using W3 Total Cache as a "generic" origin-pull mirror.
<h4>This is 2-step process:</h4>
<ol>
	<li>Creating Amazon Cloudfront Distribution to be used as CDN for WordPress</li>
	<li>Configuring W3 Total Cache to use Amazon Cloudfront Distribution</li>
</ol>
In between above 2-steps, you can add an extra step to create "white-labelled" CNAME records in case you like to use something like <code>cdn.example.com</code> instead a random subdomain from cloudfront like <code>d3otazh35pn6.cloudfront.net</code>
<h2>Creating Amazon Cloudfront Distribution to be used as CDN for WordPress</h2>
Login to your amazon aws console: <a href="https://console.aws.amazon.com/cloudfront/home">https://console.aws.amazon.com/cloudfront/home</a> and click on <strong>"Create Distribution"</strong> button.

<img class="size-full wp-image-17173" title="Amazon AWS &gt;&gt; ClodFront &gt;&gt; Create Distribution" alt="" src="https://easyengine.io/wp-content/uploads/2012/10/Amazon-AWS-Create-Distribution-2.png" width="500" height="239" />

It will start a 2-step process. In Step-1, use delivery method <strong>"Download" </strong>which is set by default and click <strong>"Continue"</strong>.

<a href="https://easyengine.io/tutorials/amazon-cloudfront-cdn-w3-total-cache-plugin/attachment/cloudfront-select-delivery-method/" rel="attachment wp-att-17176"><img class="alignnone size-large wp-image-17176" title="CloudFront - Select Delivery Method" alt="" src="https://easyengine.io/wp-content/uploads/2012/10/CloudFront-Select-Delivery-Method-620x322.png" width="620" height="322" /></a>

In Step-2, You will be asked different settings for this new Cloudfront distribution.

<strong>Under "Origin Settings", set...</strong>
<ol>
	<li>Origin Domain Name: <strong>example.com</strong></li>
	<li>Origin ID: <strong>example.com</strong></li>
</ol>
<div>where <strong>example.com</strong> is your domain name on which you are running WordPress.</div>
<strong>Under "Distribution Settings"...</strong>

You can add your one or more CNAMEs to <em><strong>Alternate Domain Names(CNAMEs)</strong></em> setting.

This is optional but if you choose to use custom CNAME record(s), do not forget to configure them on your domain registrar's end. Instructions for CNAME records are NOT covered in this article.
<h3>CloudFront Distribution List</h3>
Once you complete setup, this newly created distribution will appear in <strong>CloudFront Distribution</strong> list.

You can see Domain Name value here only which we will need to provide to <strong>W3 Total Cache</strong> going ahead. This is the value you will also need in case you want to setup your own CNAME records.

<a href="https://easyengine.io/tutorials/amazon-cloudfront-cdn-w3-total-cache-plugin/attachment/cloudfront-distribution-list/" rel="attachment wp-att-17178"><img class="alignnone size-large wp-image-17178" title="CloudFront Distribution List" alt="" src="https://easyengine.io/wp-content/uploads/2012/10/CloudFront-Distribution-List-620x164.png" width="620" height="164" /></a>

You can see more details and complete domain name value by clicking on info icon.

<a href="https://easyengine.io/tutorials/amazon-cloudfront-cdn-w3-total-cache-plugin/attachment/cloudfront-distribution-settings-2/" rel="attachment wp-att-17180"><img class="alignnone size-large wp-image-17180" title="CloudFront Distribution Settings" alt="" src="https://easyengine.io/wp-content/uploads/2012/10/CloudFront-Distribution-Settings1-620x263.png" width="620" height="263" /></a>
<h2>Configuring W3 Total Cache to use Amazon Cloudfront Distribution</h2>
W3 Total Cache provides many options to configure a CDN for your website. For Amazon Cloudfront also, they provide 2 different ways. But we will use "Generic Mirror" option as we have configured CloudFront manually in above steps. You are free to configure Amazon using other ways as well.

Go to W3 Total Cache's <strong>General Settings</strong>. Scroll down to <strong>CDN</strong> section <em>(not submenu)</em>

<a href="https://easyengine.io/tutorials/amazon-cloudfront-cdn-w3-total-cache-plugin/attachment/w3-total-cache-cdn-generic-mirror-2/" rel="attachment wp-att-17185"><img class="alignnone size-full wp-image-17185" title="W3 Total Cache - CDN - Generic Mirror" alt="" src="https://easyengine.io/wp-content/uploads/2012/10/W3-Total-Cache-CDN-Generic-Mirror1.png" width="578" height="340" /></a>

Select <strong>"Generic Mirror"</strong> option and click <strong>"Save all settings"</strong> button.

Then go to W3 Total Cache's <strong>CDN</strong> Submenu. Scroll down to <strong>Configuration</strong> section.

In <strong>"Replace site's hostname with:"</strong> field, paste value of your CloudFront Distribution Domain Name. You can also paste value of CNAME if you have configured one already.

<a href="https://easyengine.io/tutorials/amazon-cloudfront-cdn-w3-total-cache-plugin/attachment/w3-total-cache-cdn-configuration/" rel="attachment wp-att-17188"><img class="alignnone size-full wp-image-17188" title="W3 Total Cache CDN Configuration" alt="" src="https://easyengine.io/wp-content/uploads/2012/10/W3-Total-Cache-CDN-Configuration.png" width="579" height="373" /></a>

Next, click <strong>"Test Mirror"</strong> button. If you get positive response, click <strong>"Save all settings"</strong> button to save changes.

Finally, clear your page cache. W3 Total Cache will remind you about this. But this time you shouldn't ignore it!

If you stuck/need help, feel free to use comment form below! ;-)
<h3>Update:</h3>
Many users asked why we are using <strong>Generic Mirror</strong> when <strong>Amazon CloudFront</strong> option is already in dropdown menu.

On many occasions, <strong>Amazon CloudFront</strong> option did not work for us. Though, it that option works for you. Please use it. Most likely, using Amazon CloudFront way will purge your CDN cache automatically from WordPress dashboard. BUT, Amazon CloudFront charges for cache-purge also. So accidental and unnecessary purges will increase you bill.

This billing aspect is another reason, we did not think bother to try harder to get <strong>Amazon CloudFront</strong> option working for us.

<strong>Related:</strong> <a href="http://devilsworkshop.org/tutorial/maxcdn-setup-on-wordpress-using-w3-total-cache-plugin-wpmu-tutorial/43595/">Using MaxCDN with W3 Total Cache</a>