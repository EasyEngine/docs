---
ID: 45924
post_title: DKIM with Postfix
author: Rahul Bansal
post_excerpt: >
  Quickly setup Postfix with DKIM on
  Ubuntu so that all mails going out from
  your server will be signed. Also
  includes web-based and WordPress tests.
layout: page
permalink: >
  https://easyengine.io/tutorials/mail/dkim-postfix-ubuntu/
published: true
post_date: 2013-09-10 21:53:00
---
If mails from your web-server/webapp is having delivery issues, <a href="http://en.wikipedia.org/wiki/DomainKeys_Identified_Mail">DKIM (DomainKeys Identified Mail)</a> can help you big time.

Its highly recommended to use DKIM for outgoing emails even if your server is not running any kind of <a title="Create your own virtual mail-server hosting" href="https://easyengine.io/tutorials/mail/server/">mail-hosting</a>.
<h2>Install DKIM</h2>
<pre class="no-highlight">apt-get install opendkim opendkim-tools</pre>
<h2>Edit Config files</h2>
<h3>DKIM config</h3>
Open dkim config file <code>vim /etc/opendkim.conf</code>

Add following lines towards end. Make sure you replace example.com with your domain/subdomain.
<pre class="no-highlight">Domain                  example.com
KeyFile                 /etc/postfix/dkim.key
Selector                mail
SOCKET                  inet:8891@localhost</pre>
Next open dkim defaults file <code>vim /etc/default/opendkim</code>

Change default socket path by adding a line like below:
<pre class="no-highlight">SOCKET="inet:8891@localhost"</pre>
<h3>Postfix file</h3>
Open postfix main config file <code>vim /etc/postfix/main.cf</code>

Add following lines towards end.
<pre class="no-highlight"># DKIM
milter_default_action = accept
milter_protocol = 2
smtpd_milters = inet:localhost:8891
non_smtpd_milters = inet:localhost:8891</pre>
<h2>DKIM Key Generation</h2>
Run following commands with <code>mail</code> and <code>example.com</code> matching values used in <code>/etc/opendkim.conf</code> file in earlier step.
<pre class="no-highlight">opendkim-genkey -t -s mail -d example.com</pre>
This command will generate mail.private and mail.txt file. mail.private is private key that will be used to sign outgoing emails. Move it to the location we specified earlier in <code>/etc/opendkim.conf</code>
<pre class="no-highlight">cp mail.private /etc/postfix/dkim.key</pre>
<h2>DNS Record Setup</h2>
Next, you need to create a TXT record on DNS end. Just check content of mail.txt file created by opendkim-genkey command we ran above.
<pre class="no-highlight">cat mail.txt</pre>
You will see something like below:
<pre class="no-highlight">mail._domainkey IN TXT "v=DKIM1; k=rsa; t=y; p=MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDYv84GSl0Xp2CrPdFqMZ9ShBDi9Pal9XpfIf7asEENxLRdIka3TONpqtrcCKksROJBNh2G3OVGuoGJ1watQGT46B+zQtjcCI67+WiTlb2D98s1UV3KO7oi/0QH/lH8DzUmrGJUIy3ZBQ9mIu1t6YDyi8y3hlhTILHW7G4HV/VtwQIDAQAB" ; ----- DKIM key mail for example.com</pre>
TXT record will require NAMS &amp; VALUE.

Use <code>mail._domainkey</code> for NAME and long string in quotes starting from v=DKIM1 as VALUE.

Below is a sample screenshot for a TXT record. User-interface on your end might differ.

<img class="alignnone size-full wp-image-45930" src="https://easyengine.io/wp-content/uploads/2013/09/TXT-DKIM-record-1.png" alt="TXT-DKIM record-1" width="580" height="308" />

If you are editing a previous DNS record, it might take sometime for changes to propogate.
<h2>Start Signing</h2>
Once al config &amp; setup done, you need to start DKIM service and restart postfix.
<pre class="no-highlight">service opendkim start
service postfix restart</pre>
<h2>Testing DKIM setup for correctness</h2>
Anything we do, specially for first time, must end with successful testing!

There are many tools for testing. I will mention few of them below.
<h3>Verify DNS Records for DKIM Setup</h3>
This will ONLY verify if your TXT record is created successfully.
<h4>dig command</h4>
Classic and easy. You must be having this already. Running...
<pre class="no-highlight">dig <strong>mail</strong>._domainkey.<strong>example.com</strong> TXT</pre>
should return a response like...
<pre class="no-highlight">;; ANSWER SECTION:
mail._domainkey.exmaple.com. 86400 IN	TXT	"v=DKIM1\;" "k=rsa\;" "t=y\;" "p=MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDYv84GSl0Xp2CrPdFqMZ9ShBDi9Pal9XpfIf7asEENxLRdIka3TONpqtrcCKksROJBNh2G3OVGuoGJ1watQGT46B+zQtjcCI67+WiTlb2D98s1UV3KO7oi/0QH/lH8DzUmrGJUIy3ZBQ9mIu1t6YDyi8y3hlhTILHW7G4HV/VtwQIDAQAB"</pre>
<h4>Web-based Record Check</h4>
You can use <a href="http://www.protodave.com/tools/dkim-key-checker/">http://www.protodave.com/tools/dkim-key-checker/</a>

Use selector  <code>mail</code> and domain <code>example.com</code> there.
<h3>Verify DKIM Signing</h3>
<h4>Test #1 - Email-based</h4>
If you have setup keys correctly then you should pass this test.

You can test by simply sending an email to <a href="mailto:autorespond+dkim@dk.elandsys.com">autorespond+dkim@dk.elandsys.com</a> or <a href="mailto:check-auth2@verifier.port25.com">check-auth2@verifier.port25.com</a>

It's better to use swaks tools for mail-testing (<code>apt-get install swaks</code>).
<pre class="no-highlight">swaks -t check-auth2@verifier.port25.com -f me@example.com</pre>
Replace me@example.com with your mail id where you would like to receive test results.
<h4>Test #2 - Web-based</h4>
Better choice will be to use a service like <a href="http://www.mail-tester.com/">http://www.mail-tester.com/</a>  which gives you a temporary email ID and web-interface to see what happens to the email on receiving end!

For WordPress, its better to test using <a href="http://wordpress.org/plugins/check-email/">Check Email</a> plugin as you will get better picture of what happens to mail sent from WordPress!