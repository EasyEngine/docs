---
ID: 48453
post_title: Postfix, Dovecot, ViMbAdmin, RoundCube
author: Rahul Bansal
post_excerpt: >
  Creating virtual-mail server using
  postfix, dovecot powered with SSL/TLS
  security on Ubuntu. Vimbadmin for
  web-based administration. Roundcube for
  webmails.
layout: page
permalink: >
  https://easyengine.io/tutorials/mail/server/postfix-dovecot-ubuntu/
published: true
post_date: 2013-10-19 17:16:43
---
This article covers:
<ol>
	<li>Multiple domains support <em>e.g. example.com, rtcamp.com, apple.com, google.com, etc.</em></li>
	<li>Virtual users support <em>e.g. rahul@apple.com, steve@rtcamp.com, etc.</em> Virtual users cannot login to server using shell/ftp like real-users.</li>
	<li>Alias management <em>e.g. mails for you@example.com should be forwarded to rahul@rtcamp.com)</em></li>
	<li>Web-based administration interface to add/remove domains, email users and aliases.</li>
	<li>Webmail Interface for mail users can simply login with email-id &amp; password to send/check emails.</li>
</ol>
<h2>Installing packages for postfix, dovecot, mysql</h2>
<pre>apt-get install postfix postfix-mysql dovecot-core dovecot-imapd dovecot-pop3d dovecot-lmtpd dovecot-mysql mysql-server dovecot-sieve dovecot-managesieved</pre>
If you are adding a mail server on existing system some packages might be present already. Depending on previously installed package list, you may or may not see prompts to configure mysql, postfix, etc. Choose defaults wherever possible.
<h2>Postfix Configuration</h2>
This guide is created using postfix 2.9.6. You can check postfix version installed using command: <code>postconf mail_version</code>

Postfix configuration has 2 important files: <code>main.cf</code> and <code>master.cf</code>. We will also add some more files for virtual domain/mail system.
<h3>Postfix master.cf</h3>
If you want to run smtp on port 465 (with SSL) and on port 587 (with TLS), you need to uncomment following lines in <code>master.cf</code>:

It is highly recommend to do this as most ISP block port 25 to prevent spam.
<pre class="no-highlight">vim /etc/postfix/master.cf</pre>
<pre class="no-highlight">submission inet n       -       -       -       -       smtpd
smtps     inet  n       -       -       -       -       smtpd</pre>
<h3>Postfix main.cf</h3>
Open <code>main.cf</code> file: <code>vim /etc/postfix/main.cf</code>

Add following lines towards end of file:
<pre class="no-highlight"># Change postfix TLS parameter to use dovecot 
#smtpd_tls_session_cache_database = btree:${data_directory}/smtpd_scache
#smtp_tls_session_cache_database = btree:${data_directory}/smtp_scache
smtpd_tls_cert_file=/etc/ssl/certs/dovecot.pem
smtpd_tls_key_file=/etc/ssl/private/dovecot.pem
smtpd_use_tls=yes
#smtpd_tls_auth_only = yes

#Handle SMTP authentication using Dovecot
smtpd_sasl_type = dovecot
smtpd_sasl_path = private/auth
smtpd_sasl_auth_enable = yes

smtpd_recipient_restrictions =
        permit_sasl_authenticated,
        permit_mynetworks,
        reject_unauth_destination

# other destination domains should be handled using virtual domains 
mydestination = localhost

# using Dovecot's LMTP for mail delivery and giving it path to store mail
virtual_transport = lmtp:unix:private/dovecot-lmtp

# virtual mailbox setups
virtual_uid_maps = static:5000
virtual_gid_maps = static:5000
virtual_alias_maps = mysql:/etc/postfix/mysql/virtual_alias_maps.cf
virtual_mailbox_domains = mysql:/etc/postfix/mysql/virtual_domains_maps.cf
virtual_mailbox_maps = mysql:/etc/postfix/mysql/virtual_mailbox_maps.cf</pre>
<h3>Postfix Virtual Mailbox Config</h3>
We will be using a mysql database for virtual domains, users and aliases.

Create a separate directory to store all postfix-mysql config:
<pre class="no-highlight">mkdir /etc/postfix/mysql</pre>
<h4>Virtual Alias Mapping</h4>
Create a file: <code>vim /etc/postfix/mysql/virtual_alias_maps.cf</code>
Paste following in it:
<pre>user = vimbadmin
password = password
hosts = 127.0.0.1
dbname = vimbadmin
query = SELECT goto FROM alias WHERE address = '%s' AND active = '1'</pre>
<h4>Virtual Domain Mapping</h4>
Create a file: <code>vim /etc/postfix/mysql/virtual_domains_maps.cf</code>
Paste following in it:
<pre>user = vimbadmin
password = password
hosts = 127.0.0.1
dbname = vimbadmin
query = SELECT domain FROM domain WHERE domain = '%s' AND backupmx = '0' AND active = '1'</pre>
<h4>Virtual Mailbox (user) Mapping</h4>
Create a file:  <code>vim /etc/postfix/mysql/virtual_mailbox_maps.cf</code>
Paste following in it:
<pre>user = vimbadmin
password = password
hosts = 127.0.0.1
dbname = vimbadmin
query = SELECT maildir FROM mailbox WHERE username = '%s' AND active = '1'</pre>
<h2>Dovecot Configuration</h2>
Dovecot is an IMAP and POP server. It also implements security/authentication for IMAP/POP as well as SMTP (via Postfix).

We are using dovecot version 2.0.19. You can check it using command: <code>dovecot --version</code>
<h3>A real linux user - vmail</h3>
Following commands create a user and a group named vmail. vmail is a linux user who will own everybody's email! <em>(There's nothing to get panic about this fact...)</em>
<pre>groupadd -g 5000 vmail
useradd -g vmail -u 5000 vmail -d /var/vmail -m</pre>
<h4>Restart postfix</h4>
<pre>service postfix restart</pre>
<h3>Dovecot Configs</h3>
This is most annoying part I found with dovecot. Configuration is literally scattered among too many files:
<h4>Enable required protocols</h4>
<pre class="no-highlight">vim /etc/dovecot/dovecot.conf</pre>
<pre class="no-highlight"># Enable installed protocols
!include_try /usr/share/dovecot/protocols.d/*.protocol
protocols = imap pop3 lmtp sieve</pre>
<h4>Configure mail storage location</h4>
<pre class="no-highlight">vim /etc/dovecot/conf.d/10-mail.conf</pre>
<pre class="no-highlight">mail_location = maildir:/var/vmail/%d/%n</pre>
<h4>Configure authentication</h4>
<pre class="no-highlight">vim /etc/dovecot/conf.d/10-auth.conf</pre>
<pre class="no-highlight">disable_plaintext_auth = no
auth_mechanisms = plain login</pre>
Also comment out line: <code>#!include auth-system.conf.ext</code> to disable system user authentication.

Finally add support for mysql based authentication at the bottom:
<pre>passdb {
    driver = sql
    args = /etc/dovecot/dovecot-sql.conf.ext
}
userdb {
    driver = static
    args = uid=5000 gid=5000 home=/var/vmail/%d/%n allow_all_users=yes
}</pre>
<h4>Configure mysql parameters in dovecot</h4>
<code>vim /etc/dovecot/dovecot-sql.conf.ext</code>

Paste following to the bottom:
<pre>driver = mysql
connect = host=127.0.0.1 dbname=vimbadmin user=vimbadmin password=password
password_query = \
  SELECT username AS user, password, \
    homedir AS userdb_home, uid AS userdb_uid, gid AS userdb_gid \
  FROM mailbox WHERE username = '%u'
iterate_query = SELECT username AS user FROM mailbox</pre>
<h4>Change master config file</h4>
<code>vim /etc/dovecot/conf.d/10-master.conf</code>

Make sure it looks like following:
<pre>service lmtp {
 unix_listener /var/spool/postfix/private/dovecot-lmtp {
   mode = 0600
   user = postfix
   group = postfix
  }
}

service auth {
 unix_listener /var/spool/postfix/private/auth {
    mode = 0666
    user = postfix
    group = postfix
  }

  unix_listener auth-userdb {
    mode = 0600
    user = vmail
  }

  user = dovecot
}

service auth-worker {
  user = vmail
}</pre>
<h4>Configure Logging</h4>
<pre>vim /etc/dovecot/conf.d/10-logging.conf</pre>
<pre>log_path = /var/log/dovecot.log</pre>
<strong>Debug logging</strong>

If you want to enable debug logs, use following:
<pre class="no-highlight">#debuggign authentication requests
auth_debug = yes

#debugging other mail related stuff
mail_debug = yes</pre>
For more details about debug logging, check <a href="http://wiki2.dovecot.org/Logging#Logging_verbosity">available parameters in dovecot docs</a>.
<h4>Doveconf</h4>
As we are changing many files, we may lose track. You can run <code>doveconf -n</code> at those times.

<code>doveconf -n</code> displays list of changes made across entire dovecot.

Similarly, <code>doveconf -a</code> displays entire dovecot config (including defaults).
<h4>Restart dovecot</h4>
<pre>service dovecot restart</pre>
<h2>ViMbAdmin - Virtual Mail Server Administration</h2>
There are many postfix web interfaces available but we choose to go with ViMbAdmin. It "looks" nice and it uses PHP.

If you prefer ruby/rails, there is a promising alternative - <a href="http://www.posty-soft.org">posty</a>.
<h3>ViMbAdmin v3 Installation</h3>
Vimbadmin requires <a href="https://getcomposer.org/download/">composer</a> so install it first.
<pre class="no-highlight">curl -sS https://getcomposer.org/installer | php</pre>
Then...
<pre>cd /usr/local
apt-get install subversion git-core 
git clone git://github.com/opensolutions/ViMbAdmin.git vimbadmin 
cd /usr/local/vimbadmin 
php composer.phar install
chown -R www-data: /usr/local/vimbadmin</pre>
When composer will prompt you:
<pre class="no-highlight">Do you want to remove the existing VCS (.git, .svn..) history? [Y,n]?</pre>
Answer no <code>n</code>.

<strong>Create a mysql database and user for vimbadmin</strong>

Run following from mysql shell
<pre>CREATE DATABASE `vimbadmin`;
GRANT ALL ON `vimbadmin`.* TO `vimbadmin`@`127.0.0.1` IDENTIFIED BY 'password';
FLUSH PRIVILEGES;</pre>
<strong>vimbadmin config file</strong>
<pre>cp application/configs/application.ini.dist application/configs/application.ini
vim application/configs/application.ini</pre>
<pre>securitysalt = "superadmin-password"
defaults.mailbox.uid = 5000
defaults.mailbox.gid = 5000
defaults.mailbox.homedir = "/var/vmail/"
resources.doctrine2.connection.options.driver   = 'pdo_mysql'
resources.doctrine2.connection.options.dbname   = 'vimbadmin'
resources.doctrine2.connection.options.user     = 'vimbadmin'
resources.doctrine2.connection.options.password = 'password'
resources.doctrine2.connection.options.host     = 'localhost'</pre>
Make sure mysql setting are correct in above config.

<strong>Memcache glitch</strong>

If you are using memcache, comment out
<pre>;resources.session.save_path = APPLICATION_PATH "/../var/session"</pre>
<strong>Create mysql tables</strong>

Following will create mysql tables for which we already tweaked postfix and dovecot.
<pre class="no-highlight">./bin/doctrine2-cli.php orm:schema-tool:create</pre>
<strong>Chnage Ownership</strong>
<pre>chown -R www-data:www-data /usr/local/vimbadmin</pre>
<strong>set timezone in php</strong>

Open <code>/etc/php5/fpm/php.ini</code>

Add/update
<pre class="no-highlight">date.timezone = "UTC"</pre>
Restart PHP-FPM using <code>service php5-fpm restart</code>

Open VimbAdmin interface and follow instructions from there.
<h3>ViMbAdmin v2 Installation</h3>
Following commands are for Vimbadmin V2. I am sorry to say I did not get time to try V3. But I hope to add v3 instructions soon.
<pre>cd /usr/local
git clone -b v2 git://github.com/opensolutions/ViMbAdmin.git vimbadmin
apt-get install subversion
cd /usr/local/vimbadmin
./bin/library-init.sh</pre>
<strong>Run following from mysql shell</strong>
<pre>CREATE DATABASE `vimbadmin`;
GRANT ALL ON `vimbadmin`.* TO `vimbadmin`@`127.0.0.1` IDENTIFIED BY 'password';
FLUSH PRIVILEGES;</pre>
<strong>vimbadmin config file</strong>
<pre>cp application/configs/application.ini.dist application/configs/application.ini
vim application/configs/application.ini</pre>
<pre class="no-highlight">securitysalt = "superadmin-password"
defaults.mailbox.uid = 5000
defaults.mailbox.gid = 5000
defaults.mailbox.homedir = "/var/vmail/"
resources.doctrine.connection_string = "mysql://vimbadmin:password@127.0.0.1/vimbadmin"</pre>
<strong>Memcache glitch</strong>

If you are using memcache, comment out
<pre class="no-highlight">;resources.session.save_path = APPLICATION_PATH "/../var/session"</pre>
<strong>Create mysql tables</strong>

Following will create mysql tables for which we already tweaked postfix and dovecot.
<pre class="no-highlight">bin/doctrine-cli.php create-tables</pre>
<strong>Chnage Ownership</strong>
<pre class="no-highlight">chown -R www-data:www-data /usr/local/vimbadmin</pre>
<h4>Nginx config</h4>
<pre>server {
	server_name vma.example.com;

	access_log   /var/log/nginx/vma.example.com.access.log;
	error_log    /var/log/nginx/vma.example.com.error.log;

	root /usr/local/vimbadmin/public;
	index index.php;

	location / {
		try_files $uri $uri/ /index.php?$args;
	}

	location ~ \.php$ {
		try_files $uri =404;
		include fastcgi_params;
		fastcgi_pass 127.0.0.1:9000;
	}

}</pre>
At this point you can open vma.example.com and create an ViMbAdmin admin account. Please note that ViMbAdmin account is not virtual email account.

You can add domain, virtual mail-users after logging into vma.example.com using ViMbAdmin account.
<h3>Roundcube for Webmail Interface</h3>
You can literally use email client which supports smtp and pop/imap. So webmail part is completely optional.
<pre>apt-get install roundcube roundcube-plugins roundcube-plugins-extra</pre>
Above install roundcube inside <code>/usr/share/roundcube</code>

Roundcube config files are present in: <code>/etc/roundcube</code>

Open <code>vim /etc/roundcube/main.inc.php</code>

Add/change following:
<pre class="no-highlight">$rcmail_config['default_host'] = 'localhost';
$rcmail_config['imap_cache'] = memcache;
$rcmail_config['messages_cache'] = db</pre>
<h4>Nginx config</h4>
<pre class="no-highlight">server {
	server_name mail.example.com;

	access_log   /var/log/nginx/mail.example.com.access.log;
	error_log    /var/log/nginx/mail.example.com.error.log;

	root /usr/share/roundcube;
	index index.php;

	location / {
		try_files $uri $uri/ /index.php?$args;
	}

	location ~ \.php$ {
		try_files $uri =404;
		include fastcgi_params;
		fastcgi_pass 127.0.0.1:9000;
	}

}</pre>
You can open mail.example.com in browser and login using a virtual user-email and password.
<h2>Testing</h2>
At this point, we have SMTP (via Postfix), POP/IMAP (via dovecot) and a web-interface (via Vimbadmin) to manage virtual domains and users.

Before we proceed with remaining goals lets test if we have a working setup (so far).

<a href="https://easyengine.io/tutorials/mail/testing/">Testing SMTP, IMAP and POP is covered here in detail</a>.

<code style="font-size: 16px; border: 1px solid #cccccc; border-top-left-radius: 3px; border-top-right-radius: 3px; border-bottom-right-radius: 3px; border-bottom-left-radius: 3px; padding: 0px 4px; display: inline-block; line-height: 20px; margin: 0px 2px; color: #222222;"> </code>