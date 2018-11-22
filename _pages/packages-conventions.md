---
ID: 49101
post_title: 'Packages &#038; Conventions'
author: Rahul Bansal
post_excerpt: >
  List of packages used for mail-server
  setup and convention we follow for URLs
  required for web-interface part
layout: page
permalink: >
  https://easyengine.io/tutorials/mail/server/packages-conventions/
published: true
post_date: 2013-10-19 15:38:47
---
A consumer-grade mail server is a big project. It involves a lot many packages, working together to deliver desired features.

For every needs we have multiple choice. So to make mailserver setup &amp; management easy, we try to use same packages for all client servers.
<h3>Packages:</h3>
Below is list of package used and features they provide.
<ol>
	<li><a href="http://www.postfix.org/"><strong>Postfix</strong></a> - mail transfer agent (MTA). It sends mail from your server and also processes incoming email. When I reply to your comments on this blog, you get email notifications because of postfix.</li>
	<li><a href="http://www.dovecot.org/"><strong>Dovecot</strong></a> - it provides imap/pop3 using which your mail client reads emails from the server. It also handles authentication (using mysql) and provides basic security and other mail-management related services.</li>
	<li><strong><a href="http://www.mysql.com/">MySql</a> - </strong>is used to store list of domains, virtual users/password, mail aliases, etc. Dovecot will use mysql-database to authenticate users.</li>
	<li><a href="https://github.com/opensolutions/vimbadmin/"><strong>ViMbAdmin</strong></a> - mailbox administration web-interface to add/remove domains and mail users. This is an alternative to <a href="http://sourceforge.net/projects/postfixadmin/">postfixadmin</a> <em>(in case you are aware of postfixadmin).</em></li>
	<li><strong><a href="http://www.amavis.org/">Amavis</a></strong> - is a content-filter which checks email for spam &amp; viruses using other packages.</li>
	<li><strong><a href="http://www.clamav.net/">ClamAV</a></strong> - a free antivirus for linux. Its virus database is updated frequently. Please note that antivirus increases CPU load significantly.</li>
	<li><strong><a href="http://spamassassin.apache.org/">Spamassassin</a></strong> - is a spam filter. Spamassassin can learn automatically about spam on your server but as far as I know it currently doesn't have any provision for user-specific spam preference.</li>
	<li><a href="http://sieve.info/"><strong>Sieve</strong></a> - is a mail filtering language. It is used to provide Gmail-style filters. A practical use case is - spamassassin can "mark" a mail spam but it gets delivered to Inbox only (or rejected). Its sieve filters (mostly global), which checks spamassassin's "marking" and "move" mails from Inbox to Spam (or Junk) folder.</li>
	<li><strong><a href="http://roundcube.net/">RoundCube</a></strong> - webmail interface for mail-users. They can login using email-id and password. We will also add sieve plugin for RoundCube so users can create Gmail-like filters for their own use.</li>
	<li><strong><a href="http://nginx.org/">Nginx</a></strong> - webserver for ViMbAdmin and RoundCube. As of now no special features of Nginx are used. We use nginx because we already have it on most of our server.</li>
</ol>
Above are main packages we are dealing with. These packages in turn needs many other packages.

Also, for amavis uses/handles spamassassin and sieve behind the scene so for basic functionality, you don't have to worry about them.
<h3>Conventions:</h3>
Web-interface for ViMbaAdmin and RoundCube is delivered can be access using URLs like below:
<h4>Subdomain setup</h4>
<ul>
	<li>vma.example.com - ViMbaAdmin (virtual mail admin)</li>
	<li>mail.example.com - webmail interface for users (tribute to mail.google.com i.e. gmail.com)</li>
</ul>
<h4>Subdir setup</h4>
<ul>
	<li>example.com/vma - ViMbaAdmin (virtual mail admin)</li>
	<li>example.com/mail - webmail interface for users (tribute to mail.google.com i.e. gmail.com)</li>
</ul>
In both kind of setup's nginx config will make use of <a href="http://wiki.nginx.org/HttpCoreModule#alias">alias</a> directive.