---
ID: 63497
post_title: 'swaks &#8211; SMTP test tool'
author: Rahul Bansal
post_excerpt: >
  Using swaks to test email delivery, SMTP
  server, GTUBE spam test, EICAR virus
  test, attachment test, gmail smtp test,
  finding non-verifiable emails
layout: page
permalink: >
  https://easyengine.io/tutorials/mail/swaks-smtp-test-tool/
published: true
post_date: 2014-04-09 00:33:06
---
If you deal with mail-server setup and administration, you will fall in love with <code>swaks</code>

I like swaks because it make testing many things easy e.g. email delivery, SMTP server, GTUBE spam test, EICAR virus test, attachment test, gmail smtp test. Also it makes finding non-verifiable emails easy from list of email addresses.

One more thing I like about <code>swaks</code> is automatically create subject and body content. Subject line is set to date &amp; time which is again useful while debugging.
<h2>Installation</h2>
<h3>On Ubuntu</h3>
<pre class="no-highlight">apt-get install swaks</pre>
<h3>On Mac</h3>
<pre class="no-highlight">brew install swaks</pre>
<h2>Usage</h2>
<h3>Sending a test mail via localhost</h3>
<pre class="no-highlight">swaks --to user@example.com</pre>
You can simply run <code>swaks</code> without any parameter as well.

When run without any parameter, it will use localhost/sendmail program as SMTP server and prompt for to email address.

<em><strong>Note:</strong> When you use your local machine, please make sure to check spam/junk folder on destination mail server.</em>
<h3>Sending a test mail using any SMTP server</h3>
If your localhost cannot send mail, you can specify a reliable SMTP server using:
<pre class="no-highlight">swaks --to user@example.com --server smtp.example.com</pre>
If <code>smtp.example.com</code> accepts your mail, a case of open-relay, your mail will be through. Or you will see error/reason for not sending mail in output.
<h3>Sending a test mail using Gmail's SMTP server</h3>
<pre class="no-highlight">swaks -t user@example.com -s smtp.gmail.com:587 -tls -a LOGIN</pre>
Above will prompt your gmail username and password. Mail will be delivered from authenticated Gmail account. You can verify this by checking your Gmail's sent folder! ;-)
<h3>Send EICAR Virus Test Email</h3>
Test a virus scanner using EICAR in an attachment.  Don't show the message DATA part.
<pre class="no-highlight">swaks -t user@example.com --attach --suppress-data &lt; /path/to/eicar.txt</pre>
<code>--attach</code> switch can be used to specify attachment.
<h3>Send GTUBE Spam Test Email</h3>
Test a spam scanner using GTUBE in the body of an email.
<pre class="no-highlight">swaks --to user@example.com --body /path/to/gtube/file</pre>
<h3>Test List of Fake Email Addressees</h3>
Report all the recipients in a text file that are non-verifiable:
<pre class="no-highlight">for E in `cat /path/to/email/file`
do
     swaks --to $E --server test-server.example.com --quit-after RCPT --hide-all
     [ $? -ne 0 ] &amp;&amp; echo $E
done</pre>
<em><strong>Credits:</strong> <code>man swaks</code> for most examples!</em>