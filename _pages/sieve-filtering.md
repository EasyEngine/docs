---
ID: 49106
post_title: Sieve Mail Filtering Setup
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/mail/server/sieve-filtering/
published: true
post_date: 2013-10-19 17:12:39
---
This article covers:
<ol>
	<li>Email filtering <em>e.g. showing trash can to newsletters who do not honor unsubscribe links automatically.</em> This is like Gmail filters.</li>
	<li>Global spam filtering <em>e.g. moving spam from inbox to junk folder (automatically)</em></li>
</ol>
<h3>Installing packages for sieve and managesieve</h3>
We are using <a href="http://wiki2.dovecot.org/Pigeonhole">dovecot pigeonhole</a> project for sieve support.
<pre>apt-get install dovecot-sieve dovecot-managesieved</pre>
Please note that, installing sieve without spamassassin won't filter spam messages automatically.
<h3>Sieve-Dovecot Configuration</h3>
<h4>Enable sieve plugin support for dovecot-lmtp</h4>
<pre>vim /etc/dovecot/conf.d/20-lmtp.conf</pre>
<pre>Add following:

protocol lmtp {
  postmaster_address = admin@example.com
  mail_plugins = $mail_plugins sieve
}</pre>
<h4>Edit sieve dovecot-pluign configuration</h4>
<pre>vim /etc/dovecot/conf.d/90-sieve.conf</pre>
Add following:
<pre>plugin {
   sieve = ~/.dovecot.sieve
   sieve_global_path = /var/lib/dovecot/sieve/default.sieve
   sieve_dir = ~/sieve
   sieve_global_dir = /var/lib/dovecot/sieve/
}</pre>
<h4>Restart Dovecot</h4>
Restart dovecot for changes to take effect:
<pre class="no-highlight">service dovecot restart</pre>
You can see managesieve service running on port number 4190 by using telnet command:
<pre class="no-highlight">telnet example.com 4190</pre>
Will output something like:
<pre class="no-highlight">Trying 162.243.12.140...
Connected to test3.rtcamp.com.
Escape character is '^]'.
<strong>"IMPLEMENTATION" "Dovecot Pigeonhole"
"SIEVE" "fileinto reject envelope encoded-character vacation subaddress comparator-i;ascii-numeric relational regex imap4flags copy include variables body enotify environment mailbox date ihave"
</strong>"NOTIFY" "mailto"
"SASL" "PLAIN LOGIN"
"STARTTLS"
"VERSION" "1.0"
OK "Dovecot ready."</pre>
You can find <a href="http://wiki.dovecot.org/ManageSieve/Troubleshooting">sieve commands</a> here which you can run inside telnet shell to manage sieve filters. Or you can use following method to manipulate global sieve rules directly.
<h3>Global Sieve Rules</h3>
You can use sieve to implement/enforce server-wise rules/organization policies.
<h4>Create global sieve rules file</h4>
<pre>mkdir /var/lib/dovecot/sieve/</pre>
Then create/open global sieve rules files:
<pre>vim /var/lib/dovecot/sieve/default.sieve</pre>
Following example rules moves spam emails from Inbox to Junk folder automatically. <code>X-Spam-Flag</code> is added by spamassassin and amavis.
<pre>require "fileinto";
if header :contains "X-Spam-Flag" "YES" {
  fileinto "Junk";
}</pre>
Change Ownership:
<pre>chown -R vmail:vmail /var/lib/dovecot</pre>
Compile sieve rules:
<pre>sievec /var/lib/dovecot/sieve/default.sieve</pre>
At this point you have sieve interpreter and managesieve service running.
<h3>Enabling sieve plugin in roundcube</h3>
Roundcube has 2 plugins for sieve:<code>managesieve</code> and<code>sieverules</code>.

Both provides similar functionality but I like support for extended mail-headers in UI provided by sieverules. So we will be using sieverules plugin.
<h4>Enable sieverules plugin in roundcube config</h4>
Open
<pre>vim /etc/roundcube/main.inc.php</pre>
Add <code>sieverules</code> to list of roundcube plugins
<pre>$rcmail_config['plugins'] = array('sieverules');</pre>
<h4>Configure sieverules plugin to use correct managesieve service port</h4>
Open
<pre class="no-highlight">vim /etc/roundcube/plugins/sieverules/config.inc.php</pre>
Add/Update following line:
<pre class="no-highlight">$rcmail_config['sieverules_port'] = 4190;</pre>
<h3>Testing</h3>
If you are using spamassasin, you can test global filters using this <a href="https://easyengine.io/tutorials/mail/server/testing/spam/">spam testing</a> guide.