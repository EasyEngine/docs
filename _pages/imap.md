---
ID: 48923
post_title: IMAP Tests
author: Rahul Bansal
post_excerpt: 'IMAP auth & mail-retrieving tests using raw IMAP commands over telnet and openssl.'
layout: page
permalink: >
  https://easyengine.io/tutorials/mail/server/testing/imap/
published: true
post_date: 2013-10-17 11:16:34
---
<h3>Connect to server</h3>
<pre>telnet example.com 143
openssl s_client -crlf -connect example.com:993</pre>
<h3>IMAP Test Commands</h3>
<pre>01 LOGIN admin@example.com password
02 LIST "" *
03 SELECT INBOX
04 STATUS INBOX (MESSAGES)
05 FETCH 1 ALL
06 LOGOUT</pre>
&nbsp;