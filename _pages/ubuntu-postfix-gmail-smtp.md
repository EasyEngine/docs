---
ID: 25951
post_title: >
  Configure Postfix to Use Gmail SMTP on
  Ubuntu
author: Rahul Bansal
post_excerpt: "Using Gmail's SMTP server as Postfix relay for reliable email delivery and also for logging all outgoing mails."
layout: page
permalink: >
  https://easyengine.io/tutorials/linux/ubuntu-postfix-gmail-smtp/
published: true
post_date: 2013-02-18 21:20:38
---
<p class="rtp-success"><strong>Update: </strong>This article is part <a href="https://rtcamp.com/wordpress-nginx/tutorials/" target="_blank">of WordPress-Nginx tutorials</a> series.</p>
If you want to use a Gmail account as a free SMTP server on your Ubuntu-Linux server, you will find this article useful. This guide is tested with Ubuntu 12.04. If you face any issue, feel free to use comments-section below.
<h2>Relaying Postfix mails via smtp.gmail.com:</h2>
First, install all necessary packages:
<pre class="bash">sudo apt-get install postfix mailutils libsasl2-2 ca-certificates libsasl2-modules</pre>
If you do not have postfix installed before, postfix configuration wizard will ask you some questions. Just select your server as <strong><em>Internet Site</em></strong> and for FQDN use something like <strong><em>mail.example.com</em></strong>

Then open your postfix config file:
<pre class="bash">vim /etc/postfix/main.cf</pre>
and following lines to it:
<pre class="bash">relayhost = [smtp.gmail.com]:587
smtp_sasl_auth_enable = yes
smtp_sasl_password_maps = hash:/etc/postfix/sasl_passwd
smtp_sasl_security_options = noanonymous
smtp_tls_CAfile = /etc/postfix/cacert.pem
smtp_use_tls = yes</pre>
You might have noticed that we haven't specified our Gmail username and password in above lines. They will go into a different file. Open/Create
<pre class="bash">vim /etc/postfix/sasl_passwd</pre>
And add following line:
<pre class="no-highlight">[smtp.gmail.com]:587    USERNAME@gmail.com:PASSWORD</pre>
If you want to use your Google App's domain, please replace <code>@gmail.com</code> with your <code>@domain.com</code>

Fix permission and update postfix config to use sasl_passwd file:
<pre class="no-highlight">sudo chmod 400 /etc/postfix/sasl_passwd
sudo postmap /etc/postfix/sasl_passwd</pre>
Next, validate certificates to avoid running into error. Just run following command:
<pre class="bash">cat /etc/ssl/certs/Thawte_Premium_Server_CA.pem | sudo tee -a /etc/postfix/cacert.pem</pre>
<em><strong>Note:</strong> If you run into issues with above command, try changing certificate name to <code>thawte_Primary_Root_CA.pem</code> in above command. Thanks Alexander Bakker for the note.</em>

Finally, reload postfix config for changes to take effect:
<pre class="bash">sudo /etc/init.d/postfix reload</pre>
<h2>Testing</h2>
<h3>Check if mails are sent via Gmail SMTP server</h3>
If you have configured everything correctly, following command should generate a test mail from your server to your mailbox.
<pre class="bash">echo "Test mail from postfix" | mail -s "Test Postfix" you@example.com</pre>
To further verify, if mail sent from above command is actually sent via Gmail's SMTP server, you can log into Gmail account USERNAME@gmail.com with PASSWORD and check <em>"Sent Mail"</em> folder in that Gmail account. By default, Gmail always keeps a copy of mail being sent through its web-interface as well as SMTP server. This logging is one strong reason that we often use Gmail when mail delivery is critical.

Once configured, all emails from your server will be sent via Gmail. This method will be useful if you have many sites on your server and want them all to send emails via Gmail's SMTP server.

Alternatively, you can use a plugin like <a href="http://wordpress.org/extend/plugins/wp-mail-smtp/">WP Mail SMTP</a> so that mails from your particular WordPress site will be sent using Gmail's SMTP server.

Please note that Gmail's SMTP server has a limit of 500 emails per day. So use wisely! :-)
<h2>Troubleshooting</h2>
<strong>Error: "SASL authentication failed; server smtp.gmail.com"</strong>

You need to unlock the captcha by visiting this page <a href="https://www.google.com/accounts/DisplayUnlockCaptcha">https://www.google.com/accounts/DisplayUnlockCaptcha</a>

You can run test again after unlocking captcha.

P.S. Do not miss out on our other helpful <a href="https://rtcamp.com/tutorials/">tutorials</a>. Join us on <a href="https://twitter.com/rtCamp">twitter</a> and <a href="https://www.facebook.com/rtCamp.solutions">facebook</a> for more updates.

&nbsp;