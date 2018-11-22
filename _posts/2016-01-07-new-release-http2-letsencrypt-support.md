---
ID: 133283
post_title: 'EasyEngine 3.4 &#8211; HTTP2 &#038; LetsEncrypt support for HTTPS'
author: Rahul Bansal
post_excerpt: ""
layout: post
permalink: >
  https://easyengine.io/blog/new-release-http2-letsencrypt-support/
published: true
post_date: 2016-01-07 19:46:55
---
In EasyEngine 3.4, we have added support for HTTP/2 and Let's Encrypt.

To update your EasyEngine to latest version, please run <code>ee update</code> command.

As both of these are relatively newer feature, it's better you read the following details to familiarize yourself.
<h2>HTTP/2 Support</h2>
HTTP2 is newer version of HTTP protocol. HTTP2 has many improvements,  but simply put, it means faster sites for your visitors. It is based on SPDY, for which we had support in EasyEngine since day 1!

It's better to go through <a href="http://http2.github.io/">http://http2.github.io/</a> for more details about protocol.

NGINX recently added support in it's mainline release channel. Though I am personally switching NGINX version from stable to mainline for all EasyEngine users, we managed to add a workaround for now.

Also, as browsers will start dropping support for SPDY<em> (<a href="http://blog.chromium.org/2015/02/hello-http2-goodbye-spdy-http-is_9.html">example</a>) </em>soon, we need to rush!
<h3>Usage</h3>
For existing users:

<code>ee stack remove --nginx &amp;&amp; ee stack install --nginxmainline</code>

For new users:

<code>ee stack install --nginxmainline</code>

Please note if you run our famous 2 lines site creation process, you may need to follow step's for existing users as it will install nginx stable version.

<strong>Read More:</strong> <a href="https://easyengine.io/docs/http2-support/">HTTP2 feature documentation</a>
<h2>Let's Encrypt for HTTPS</h2>
HTTPS or encrypted HTTP is something a must have requirement for sites that accepts credit card. But recently many sites, where no e-commerce activity takes place, also started switching to HTTPS.

In order to add HTTPS support, we needed to have SSL certificate. There was some free and paid ways to get SSL certificate for your domain but the process was tedious and time consuming, unless your site is running behind something like CloudFlare.

This all changed with inception of <a href="https://letsencrypt.org/">Let's Encrypt</a>. With Let's Encrypt we can automate entire process of setting up and renewing SSL certificates.
<h3>Usage</h3>
We have listed a <a href="https://easyengine.io/tutorials/nginx/lets-encrypt-with-easyengine/">manual process</a> in our tutorials section last month. But as you can expect with EasyEngine, we have automated everything using just one command.

For existing user and sites running EasyEngine:

<code>ee site update example.com --letsencrypt</code>

For new sites:

<code>ee site create example.com --wp --letsencrypt</code>
<h3>Auto-Renewal for Let's Encrypt SSL certificates</h3>
As <a href="https://letsencrypt.org/2015/11/09/why-90-days.html">Let's Encrypt issues certificates for 90 days only</a>, manual renewal would go against EasyEngine's "Easy first" principle. So that is why EasyEngine automatically renew all SSL certificates for Let's Encrypt sites automatically using a cron job.

<strong>Read More: </strong><a href="https://easyengine.io/docs/lets-encrypt/">Lets' Encrypt feature documentation</a>
<h2>HTTP2 and Let's Encrypt</h2>
While HTTP2 doesn't require encryption, currently no browser supports HTTP/2 unencrypted. <em>(<a href="https://http2.github.io/faq/#does-http2-require-encryption">source</a>)</em>

So in order to benefit from HTTP2, you will likely need encryption and SSL certificate which you can now get using Let's Encrypt.

As we have added support for both, you don't need to bother about internal details.
<h2>Need Support?</h2>
If you run into any issues or have any questions, please use our <a href="http://community.rtcamp.com/">community support forum</a>.

If you are using <a href="https://easyengine.io/products/easyengine-premium-support/">EasyEngine Premium Support</a>, you can <a href="https://easyengine.io/premium-support/">create a support request</a> and let our team update EasyEngine.

Please share your feedback via comments or join <a href="https://easyengine.io/slack/">EasyEngine slack team</a>.

<strong>Links:</strong> <a href="https://easyengine.io/docs/http2-support/">HTTP2</a>  |<b> </b><a href="https://easyengine.io/docs/lets-encrypt/">Lets' Encrypt</a> | <a href="https://github.com/EasyEngine/easyengine/releases/tag/v3.4.0">Release Notes</a>