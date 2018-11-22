---
ID: 17220
post_title: Increasing Attachment Size in Posfix
author: Rahul Bansal
post_excerpt: >
  Postfix configuration to increase
  attachment size on your mail-server
layout: page
permalink: >
  https://easyengine.io/tutorials/mail/postfix-attachment-size/
published: true
post_date: 2013-02-20 21:55:04
---
Postfix by default restrict attachment size to approx 10MB i.e. 10240000 bytes.

You can check it using following command:
<pre class="bash">postconf | grep message_size_limit</pre>
To change attachment-size to say 50 MB, run a command like:
<pre class="bash">postconf -e message_size_limit=52428800</pre>
<h4>Note:</h4>
If you are running a mail-server with SMTP/IMAP access, you need to change postfix attachment size only. I spent half-hour debugging dovecot to increase attachment size, just to realize that above change in postfix config was all I needed!