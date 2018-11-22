---
ID: 49120
post_title: Spam Tests
author: Rahul Bansal
post_excerpt: "Spam mail test with spamassassin. Also includes check for sieve global's filtering."
layout: page
permalink: >
  https://easyengine.io/tutorials/mail/server/testing/spam/
published: true
post_date: 2013-10-19 16:12:24
---
<h3>Official Spamassasin test mail</h3>
Download &amp; send a test spam-mail specifically created for spamsapmassin.
<pre>wget http://spamassassin.apache.org/gtube/gtube.txt
sendmail admin@example.com &lt; gtube.txt</pre>
<h3>Swaks Utility</h3>
You can also send mails using <code>swaks</code> tool.
<pre>swaks --server example.com --to admin@example.com</pre>
<h3>Log Monitor</h3>
When your server receives a spam mail, you can see in postfix's <code>mail.log</code>a lines like:
<pre>Oct 12 10:23:57 test3 amavis[1527219]: (1527219-07) Passed SPAM, [122.169.28.186] [122.169.28.186] &lt;rahul286@localhost&gt; -&gt; &lt;admin@example.com&gt;, mail_id: YOcg6RH8YipM, Hits: 11.696, size: 416, queued_as: 58C9143EE9, 5424 ms</pre>
If you have sieve filter enabled, spam mails will directly go into "Junk" folder.

spam-filtering adds extra headers to emails like below:
<pre>X-Spam-Flag: YES
X-Spam-Score: 11.696
X-Spam-Level: ***********
X-Spam-Status: Yes, score=11.696 required=6.31 tests=[FH_FROMEML_NOTLD=0.18,
	FSL_HELO_NON_FQDN_1=0.001, HELO_LOCALHOST=3.603, MISSING_MID=0.14,
	RCVD_IN_BRBL_LASTEXT=1.644, RCVD_IN_PBL=3.558, RCVD_IN_RP_RNBL=1.284,
	RCVD_IN_SORBS_DUL=0.001, RDNS_NONE=1.274, TO_NO_BRKTS_NORDNS=0.001,
	T_RCVD_IN_SEMBLACK=0.01] autolearn=no</pre>
For clean mails, spam headers looks like:
<pre>X-Spam-Flag: NO
X-Spam-Score: -0.799
X-Spam-Level: 
X-Spam-Status: No, score=-0.799 required=6.31 tests=[DKIM_SIGNED=0.1,
	DKIM_VALID=-0.1, DKIM_VALID_AU=-0.1, HTML_MESSAGE=0.001,
	RCVD_IN_DNSWL_LOW=-0.7] autolearn=ham</pre>
<h3>Debugging amavis</h3>
If results are not as per expectation, you can start amavis in debug mode using following commands:a
<pre>service amavis stop
amavisd-new debug</pre>