---
ID: 14552
post_title: 'Debugging Postfix Config, Mail Logs &#038; more'
author: Rahul Bansal
post_excerpt: >
  Test if postfix can send emails. Find
  out why emails are getting delayed, load
  on postfix mail queues, reading emails
  from mail queue and more.
layout: page
permalink: >
  https://easyengine.io/tutorials/mail/postfix-debugging/
published: true
post_date: 2012-09-30 08:20:24
---
<p class="rtp-alert"><strong>Note:</strong> Please check <a href="https://easyengine.io/tutorials/mail/fqdn-reverse-dns-ptr-mx-record-checks/">common mistakes with mail</a> server first.</p>
You will need to debug postfix, when you are facing email related issues like emails are not sent, emails are delivered but with a long delay, mail bounces, etc.

In this article, we will first see how we can check if postfix itself can send emails. Then we will see postfix configuration/re-configuration and some related parameter. It will be followed by checking postfix mail logs for errors and finally inspecting mail queues to diagnose different postfix related problems.
<h3>Check if postfix can send emails</h3>
If your WordPress or PHP or any other application is not able to send emails, first thing you should check if postfix can send emails itself.
<pre>echo "Test mail from postfix" | mail -s "Test Postfix" admin@something.com</pre>
Please replace admin@something.com. Its better to run a test with your free email id with gmail, yahoo, etc first. If you can receive test mail sent above then that means postfix is able to send emails.

If postfix fails to send emails, its better to <a href="https://easyengine.io/wordpress-nginx/tutorials/php/test-email-sending/">check if PHP/WordPress can send email as well</a>.
<h3>Postfix configuration</h3>
You can run command <code>postconf -n</code> and it will show postfix config in action! This is very convenient as reading config files with lots of comments can get tiring sometimes. Though you can skip commented part using <a title="Using grep to removing comments, newlines/whitespace from config files" href="http://devilsworkshop.org/removing-whitespace-comments-newlines-file-grep/">this</a> also, <code>postconf -n</code> is quite handy and useful.

It's sample output consist lines like below:
<pre>mydestination = $myorigin, localhost.rtcamp.com, localhost
myhostname = $myorigin
mynetworks = 127.0.0.0/8 [::ffff:127.0.0.0]/104 [::1]/128
myorigin = /etc/mailname</pre>
I have skipped other lines because most issues are related to above lines (in my experience).

If you see anything wrong, you can fix it up by editing <code>/etc/postfix/main.cf</code> file. If you make any changes to postfix config, don't forget to reload it by running command: <code>/etc/init.d/postfix  reload</code>
<h4>Reconfigure postfix</h4>
On Ubuntu/Debian, you can run command <code>dpkg-reconfigure postfix</code> .

It will start an interactive wizard which will guide you through different configurations.
<h4>Hostname</h4>
One important config value is hostname of your system. To check it, run <code>hostname</code> command. It should show a domain you like to use to send mails from. If you want to change it, you better change /etc/hostname file. It just contains one line.

Its also recommended to add a line like below in your <code>/etc/host</code> file

<code>127.0.0.1     host1.example.com      host1</code>

For better email delivery, you must create "A record" on DNS for example.com pointing to public IP of your machine hosting <code>host1.example.com</code>.
<h4><span style="font-size: 1.5rem; line-height: 1.16667;">Check postfix mail logs</span></h4>
When you run into postfix or email issues, first thing, you should check is postfix mail logs which are present in <code>/var/log/mail.log</code> file.

It contains postfix's general logs. Keeping <code>tail -f /var/log/mail.log</code> running in a separate terminal window will be helpful.

If you can see a file <code>/var/log/mail.err</code> then its better to check it first. <code>mail.err</code> is only for "error" logging.

There are many kind of error messages possible. Not all are added by postfix! Some other applications like dovecot, cyrus, etc also make use of these log files. Its better to Google first as solutions for most of common errors are already present out there.

Read <a title="Postfix Debugging" href="http://www.postfix.org/DEBUG_README.html">this</a> if you want to get more detailed postfix logs.
<h3>Checking postfix queue</h3>
This is covered in details here - <a href="https://easyengine.io/tutorials/mail/postfix-queue/">http://rtcamp.com/tutorials/mail/postfix-queue/</a>