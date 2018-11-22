---
ID: 50990
post_title: Postfix Queue Management
author: Rahul Bansal
post_excerpt: >
  Postfix queue management. Check shape of
  active or deferred queue. Resend/Delete
  all/selected deferred mails.
  Resend/Delete/Read a particular mail.
layout: page
permalink: >
  https://easyengine.io/tutorials/mail/postfix-queue/
published: true
post_date: 2013-11-20 17:53:10
---
<strong>Goal: </strong>To find which mails are stuck in mail queue and why?

If emails are getting delayed, its better to inspect postfix mail queues, coupled with postfix mail log.
<h2>Status/Shape of Mail Queue</h2>
Postfix maintains different queues for different purpose.<code>active</code>  and  <code>deferred</code> queues are of our interest.

Ideally, we should never have a mail in deferred queue.

<code>qshape</code> command will show shape of active mail queue by default. Ideally it should be as close as to empty since postfix sends email instantly!
<pre>qshape</pre>
<strong>Sample Outputs:</strong>
<pre>       T  5 10 20 40 80 160 320 640 1280 1280+
TOTAL  0  0  0  0  0  0   0   0   0    0     0</pre>
If a mail is deferred, it will be moved to deferred queue.

Running following command will show you the number of deferred emails for each domains...
<pre>qshape deferred</pre>
<strong>Sample Output:</strong>
<pre>               T  5 10 20 40 80 160 320 640 1280 1280+
        TOTAL  5  0  0  0  0  0   0   0   0    0     5
    gmail.com  4  0  0  0  0  0   0   0   0    0     4
    yahoo.com  1  0  0  0  0  0   0   0   0    0     1</pre>
If you see mails to one or more domain only being deferred, check if you can connect to those servers from your network.

<span style="font-size: 1.5em; line-height: 1em;">Analyze mails in queue</span>
<h3>Dump entire mail queue</h3>
You can use either <code>mailq</code> or <code>postqueue -p</code>command. They will show an output like below:
<pre>-Queue ID- --Size-- ----Arrival Time---- -Sender/Recipient-------
<strong>2FC8824D24</strong>    10588 Thu Sep 27 14:52:41  from.me@example.com
(connect to alt2.gmail-smtp-in.l.google.com[74.125.79.26]:25: Connection timed out)
                                         some.user@gmail.com
-- 16 Kbytes in 2 Requests.</pre>
You get dump for all emails from all mail queues including active &amp; deferred queue.
<h3>Read an email from mail queue</h3>
Every message in queue has a unique id. You can read message in queue using a command like:
<pre>postcat -q  DA80E24A0A</pre>
Or
<pre>postcat -qv  DA80E24A0A</pre>
It will display your emails with headers and some more info. Using 'v' will display extra information.
<h3>Attempt to send an email from mail queue</h3>
Its better to first open postfix log using something like below:
<pre class="no-highlight">tail -f /var/log/mail.{err,log}</pre>
Then you can identify a stuck mail and attempt to send it by using:
<pre>postqueue -i DA80E24A0A</pre>
If that mail gets stuck again, check log tab to find reason.

Once you fix issue, you can attempt to send that mail again. Mail ID inside queue remains same even if mail gets deferred again and again.
<h3>Attempt to send all email from mail queue</h3>
Once you rectify issue and confident about delivery, you may try flushing entire queue immediately using:
<pre class="no-highlight">postqueue -f</pre>
<h3>Deleting Pending mails from queue</h3>
Sometimes you realize that all stuck emails are being sent to non-existent emails. Most likely emails generated because of some spam activity.
<h4>Delete All Deferred Mails</h4>
In that case, you can simply delete all queued mails using:
<pre>postsuper -d ALL deferred</pre>
<h4>Delete a single mail from queue</h4>
If you want to just delete one mail, you can try:
<pre>postsuper -d DA80E24A0A</pre>
<h4>Delete mails to a specific mail address</h4>
You need to some work here as postfix has no direct command for this.

Following sample is taken from postsuper man page:
<pre class="no-highlight">mailq | tail -n +2 | grep -v '^ *(' | awk  'BEGIN { RS = "" } { if ($8 == "USER@EXAMPLE.COM" &amp;&amp; $9 == "") print $1 } ' | tr -d '*!' | postsuper -d -</pre>
Just replace USER@EXAMPLE.COM with receiver email address.

<code>$8</code> will contain recipient1 email-address, <code>$9</code> will contain recipient2 email-address.

If you want to filter from-email address, use <code>$7</code> variable.