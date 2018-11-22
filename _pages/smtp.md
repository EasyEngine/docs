---
ID: 48922
post_title: SMTP Tests
author: Rahul Bansal
post_excerpt: >
  SMTP authentication, mail-sending and
  open-relay testing using telnet/openssl.
  Includes swaks utility and web-based
  alternatives.
layout: page
permalink: >
  https://easyengine.io/tutorials/mail/server/testing/smtp/
published: true
post_date: 2013-10-17 11:17:59
---
<h3>Connect to server</h3>
For non-secure SMTP, you can use
<pre>telnet example.com 25</pre>
For secure SMTP, you can use one of following:
<pre>openssl s_client -starttls smtp -connect example.com:25
openssl s_client -starttls smtp -connect example.com:465
openssl s_client -starttls smtp -connect example.com:587</pre>
As soon as you connect to the server, run:
<pre>ehlo example.com</pre>
You will get output like below as reply:
<pre>250-test.rtcamp.com
250-PIPELINING
250-SIZE 10240000
250-VRFY
250-ETRN
250-STARTTLS
<strong>250-AUTH PLAIN LOGIN</strong>
250-ENHANCEDSTATUSCODES
250-8BITMIME
250 DSN</pre>
If you do not see line like <code>250-AUTH ...</code> line, then your server may not support authentication. Most likely you will see this when trying with telnet or openssl without startls.
<h3>Authentication</h3>
For <code>admin@example.com</code> and <code>password</code>, generate base64 encoded string like below:
<pre>echo -ne '\0admin@example.com\0password' | base64</pre>
Please note use of <code>\0</code> before username and password. It must be used as it is. Also, use single-quotes to avoid escaping special characters in your password.

It will output a string like below:
<pre>AGFkbWluQGV4YW1wbGUuY29tAHBhc3N3b3Jk</pre>
Use above string with AUTH command:
<pre>AUTH PLAIN AGFkbWluQGV4YW1wbGUuY29tAHBhc3N3b3Jk</pre>
<h3>SMTP Commands to send test email</h3>
Type/paste following commands 1-by-1. They are interactive and needs input.
<pre>ehlo example.com
mail from: admin@example.com
rcpt to: admin@other.com
data
quit</pre>
For more SMTP Tests, <a href="http://www.stat.ufl.edu/system/mailtesting.shtml">check this</a>.
<h3>Open-Relay Test</h3>
Worst thing that could happen to your SMTP server is - it becomes open-relay (accidentally). An open-relay allows anybody to connect and send email using your server. It can lead to your server being blacklisted. I am not sure if it can result in legal hassles!

There are <a href="https://www.google.com/search?q=open+relay+test">many tools available online</a> which can check if your smtp server is acting as open relay.
<h3>swaks utility</h3>
This is a small package which can make it easy to test your smtp server.
<pre>apt-get install swaks</pre>
Example usage:
<pre>swaks --server example.com --to admin@example.com</pre>
Please note that spamassassin marks, swaks generated email as spam.