---
ID: 48924
post_title: POP Tests
author: Rahul Bansal
post_excerpt: 'POP auth & mail-retrieving tests using raw POP commands over telnet and openssl.'
layout: page
permalink: >
  https://easyengine.io/tutorials/mail/server/testing/pop/
published: true
post_date: 2013-10-17 11:16:44
---
<h4><span style="font-size: 1.125em; line-height: 1.3333em; font-weight: 400;">Connect to server</span></h4>
<pre>telnet example.com 110
openssl s_client -crlf -connect example:995</pre>
<h3>POP Test Commands</h3>
<pre>USER admin@example.com
PASS password
STAT 
LIST
QUIT</pre>
&nbsp;