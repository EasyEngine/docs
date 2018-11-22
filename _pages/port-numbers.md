---
ID: 49111
post_title: Mailserver Port Numbers
author: Rahul Bansal
post_excerpt: 'List of ports for different mail protocol/services like SMTP, IMAP, POP, Sieve, Amavis. Includes command to find port used by postfix & dovecot.'
layout: page
permalink: >
  https://easyengine.io/tutorials/mail/server/port-numbers/
published: true
post_date: 2013-10-19 16:01:48
---
Following are port numbers for different services:
<ul>
	<li>SMTP - 25 (465 with SSL, 587 with TLS)</li>
	<li>POP3 - 110 (995 for SSL)</li>
	<li>IMAP - 143 (993 for SSL)</li>
	<li>ManageSieve - 4190 (Gmail-like mail filtering)</li>
	<li>Amavis - 10025 (spam/antivirus checks)</li>
</ul>
You can find/verify ports used by postfix and dovecot using following commands:
<pre>netstat -tulpn | egrep 'master|dovecot'</pre>
Above command assumes you are using postfix (master) and dovecot. You can replace them with your packages or even port number like:
<pre>netstat -tulpn | egrep '25|465|587|110|143'</pre>
Please note that if you are using non standard ports, you may miss open-ports when running a command-like above.