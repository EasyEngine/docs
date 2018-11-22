---
ID: 133202
post_title: Let’s Encrypt
author: Prabuddha
post_excerpt: ""
layout: page
permalink: https://easyengine.io/docs/lets-encrypt/
published: true
post_date: 2016-01-04 13:44:28
---
<em>With prior  release of v3.4.0, EasyEngine now comes with built in support for Let's Encrypt .</em>

<em>Let assume  </em><span class="st"><em>the domain is already pointed to  server IP address. If not please point the domain to server before proceeding below</em>.<em><strong> Also  confirm both <code>www</code> and <code>non-www</code> is pointed to the server.</strong></em>
</span>

Lets create a wordpress site  with SSL enabled.
<pre>ee site create example.com --wp --letsencrypt</pre>
That's it .

This will create a default wordpress site with SSL configuration provided by let's Encrypt.

What if you already have a site  ?

If the site was created with easyengine, let's secure it with HTTPS  now.

Just run
<pre>ee site update example.com --letsencrypt</pre>
Type 'y' when prompt to continue ..
<pre>Letsencrypt is currently in beta phase.
Do you wish to enable SSl now for in?
Type "y" to continue [n]:y
Downloading LetsEncrypt          [Done]
Let's Encrypt successfully setup for your site
Your certificate and chain have been saved at /etc/letsencrypt/live/example.com/fullchain.pem
Configuring Nginx SSL configuration
Adding /var/www/example.com/conf/nginx/ssl.conf
Adding /etc/nginx/conf.d/force-ssl-example.com.conf
Added HTTPS Force Redirection for Site  http://example.com
Creating Cron Job for cert auto-renewal
Reload : nginx     [OK]
Congratulations! Successfully Configured SSl for Site  https://example.com
Your cert will expire within 89 days.

</pre>
Do not like extra security . OK you can disable  HTTPS  with
<pre>ee site update example.com --letsencrypt=off</pre>
Please note disabling  HTTPS does not revoke your SSL Cert from Let's Encrypt.

Currently SSL cert provided by lets encrypt comes with maximum certificate lifetime of 90 days. After 90 days it is required to renew the license .

But manually renewing every 90 days is burdensome. So in easyengine we provide automated way to renew Let's Encrypt certificates 30 days before certificate expiry with Linux cron .
<pre>~# crontab -l</pre>
For every sites with HTTPS enabled, similar cron is set on root user.
<pre>0 12 * * * ee site update --le=renew --all 2&gt; /dev/null # Renew letsencrypt SSL cert. Set by EasyEngine</pre>
&nbsp;

Do not like to set cron. Okay you can comment out above cron and run manual update command on every 90 days
<pre>ee site update example.com --letsencrypt=renew</pre>
Linux commands are sometimes subjected to failure. So we provide Mail Notification for every renewal successful/unsuccessful status . Email is sent to the address provided in .gitconfig file.

Sample mail for unsuccessful attempt of certificate renewal:
<pre>Hey Hi,

SSL Certificate renewal for https://example.com was unsuccessful.
Please check easyengine log for reason. Your SSL Expiry date : Sun Mar 30 16:53:00 IST 2016

For support visit https://easyengine.io/support/ .


Your's faithfully,
EasyEngine</pre>
Sample mail for successful attempt of certificate renewal:
<pre>Hey Hi,

Your SSL Certificate has been renewed for https://example.com .
Your SSL will Expire on : Sun Mar 20 16:53:00 IST 2016


Your's faithfully,
EasyEngine</pre>
Also Check site's SSL status and expiry date with
<pre>~# ee site info example.com
Information about example.com:

Nginx configuration     wp wpredis (enabled)

. . .

SSL                      enabled
SSL PROVIDER             Lets Encrypt
SSL EXPIRY DATE          Wed Mar 30 11:25:00 IST 2016

. . .
</pre>
<h3>Alias command:</h3>
<pre>--le=on/off/renew</pre>
If you are facing some locale issue with LetsEncrypt, you can run these commands as root user.
<code>locale-gen en_US en_US.UTF-8
dpkg-reconfigure locales
</code>
Then add the following to your <code>/etc/profile</code>
<code>export LC_ALL="en_US.UTF-8"
export LC_CTYPE="en_US.UTF-8"
</code>
To load the above setting into the current shell environment, run source <code>/etc/profile</code>
<h3>Important Notes:</h3>
1. Let's Encrypt will not work with cloudflare enabled.

2. Please point both www.example.com  and example.com to server before requesting SSL cert.

&nbsp;