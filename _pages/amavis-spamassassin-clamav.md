---
ID: 49132
post_title: 'Amavis, Spamassassin &#038; ClamAV Setup'
author: Rahul Bansal
post_excerpt: 'amavis, spamassassin & clamav setup for postfix on ubuntu. Works with postfix virtual domain setup. '
layout: page
permalink: >
  https://easyengine.io/tutorials/mail/server/amavis-spamassassin-clamav/
published: true
post_date: 2013-10-19 17:11:20
---
This article covers:
<ol>
	<li>Spam filtering setup using spamassassin</li>
	<li>Antivirus scanning using clamav</li>
</ol>
<h3>Installing packages amavis, clamav, spamassassin</h3>
<pre>apt-get install amavisd-new spamassassin clamav clamav-daemon arj zoo nomarch cpio lzop cabextract apt-listchanges libauthen-sasl-perl  libdbi-perl libmail-dkim-perl p7zip rpm unrar-free libsnmp-perl</pre>
Please note that amavis itself doesn't do any kind of spam-checking or virus-checking. It uses spamassassin for spam-testing and clamav for virus-testing. So we need to configure amavis only to spam &amp; virus filtering implemented.
<h2>Amavis Configuration</h2>
By default, amavis comes with all kind of checks disabled! Might sound strange but we need to enable everything.
<h4>Enable virus &amp; spam checking:</h4>
<pre>vim /etc/amavis/conf.d/15-content_filter_mode</pre>
Uncomment following lines:
<pre>@bypass_virus_checks_maps = (
   \%bypass_virus_checks, \@bypass_virus_checks_acl, \$bypass_virus_checks_re);

@bypass_spam_checks_maps = (
   \%bypass_spam_checks, \@bypass_spam_checks_acl, \$bypass_spam_checks_re);</pre>
If your server has less spare CPU power, you may leave virus-checking disabled. ClamAV consumes considerable CPU resources. Also note that these checks delays mail delivery (generally by few seconds).
<h4>Set filtering preference:</h4>
Open
<pre>vim /etc/amavis/conf.d/50-user</pre>
Add following:
<pre>$sa_spam_subject_tag = undef;
$spam_quarantine_to  = undef;
$sa_tag_level_deflt  = undef;

# Prevent spams from automatically rejected by mail-server
$final_spam_destiny  = D_PASS;

# We need to provide list of domains for which filtering need to be done
@lookup_sql_dsn = (
    ['DBI:mysql:database=vimbadmin;host=127.0.0.1;port=3306',
     'vimbadmin',
     'password']);

$sql_select_policy = 'SELECT domain FROM domain WHERE CONCAT("@",domain) IN (%k)';</pre>
If you are getting too many false positives, you may change <code>$sa_tag_level_deflt</code> to a positive value.

For <code>lookup_sql_dsn</code>, please make sure your mysql database details matches one that is used by postfix &amp; dovecot.

To finalize changes:
<pre>service amavis restart</pre>
<h3>Postfix config</h3>
Configuring amavis alone won't work. We need to tell postfix to use amavis content-filters during mail processing.

Open <code>vim /etc/postfix/master.cf</code>

Find line containing:
<pre>pickup    fifo  n       -       -       60      1       pickup</pre>
Add 2-lines below it so it looks like:
<pre>pickup    fifo  n       -       -       60      1       pickup
        -o content_filter=
        -o receive_override_options=no_header_body_checks</pre>
Add following towards end:
<pre>smtp-amavis unix -      -       n     -       2  smtp
    -o smtp_data_done_timeout=1200
    -o smtp_send_xforward_command=yes
    -o disable_dns_lookups=yes
    -o max_use=20

127.0.0.1:10025 inet n    -       n       -       -     smtpd
    -o content_filter=
    -o smtpd_delay_reject=no
    -o smtpd_client_restrictions=permit_mynetworks,reject
    -o smtpd_helo_restrictions=
    -o smtpd_sender_restrictions=
    -o smtpd_recipient_restrictions=permit_mynetworks,reject
    -o smtpd_data_restrictions=reject_unauth_pipelining
    -o smtpd_end_of_data_restrictions=
    -o smtpd_restriction_classes=
    -o mynetworks=127.0.0.0/8
    -o smtpd_error_sleep_time=0
    -o smtpd_soft_error_limit=1001
    -o smtpd_hard_error_limit=1000
    -o smtpd_client_connection_count_limit=0
    -o smtpd_client_connection_rate_limit=0
    -o receive_override_options=no_header_body_checks,no_unknown_recipient_checks
    -o local_header_rewrite_clients=</pre>
<h4>Restart postfix</h4>
<pre>service postfix restart</pre>
<h3>Testing</h3>
Its better to test if above setup is actually filtering spam &amp; virus. Use following test:
<ul>
	<li><a href="https://easyengine.io/tutorials/mail/server/testing/spam/">Spam Testing</a></li>
	<li><a href="https://easyengine.io/tutorials/mail/server/testing/antivirus/">Virus Testing</a></li>
</ul>