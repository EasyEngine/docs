---
ID: 49121
post_title: Antivirus Tests
author: Rahul Bansal
post_excerpt: >
  EICAR (European Institute for Computer
  Antivirus Research) antivirus mail test
  to check if ClamAV working properly.
layout: page
permalink: >
  https://easyengine.io/tutorials/mail/server/testing/antivirus/
published: true
post_date: 2013-10-19 16:27:30
---
<h3>Send a test mail with virus attached</h3>
We use <a href="http://en.wikipedia.org/wiki/EICAR_test_file">EICAR test file</a>.

Download EICAR file locally.
<pre>wget https://secure.eicar.org/eicar.com.txt</pre>
For command-line sending, you will need mutt package (mail doesn't support sending attachment)
<pre>apt-get install mutt -y</pre>
Send a test test mail with EICAR file (virus) attached
<pre>echo "Test virus body" | mutt -a eicar.com.txt -s "This is virus" -- admin@example.com</pre>
<h3>Log Monitor</h3>
When your server receives a spam mail, you can see in postfix's <code>mail.log</code>a lines like:
<pre>Oct 12 11:00:25 test amavis[1576510]: (1576510-03) Blocked INFECTED (Eicar-Test-Signature), [192.241.254.103] [192.241.254.103] &lt;root@test.rtcamp.com&gt; -&gt; &lt;admin@example.com&gt;, quarantine: S/virus-SA93AIGegqCY, Message-ID: &lt;20131012145923.GA29765@example.com&gt;, mail_id: SA93AIGegqCY, Hits: -, size: 976, 57 ms</pre>
There are <a href="http://www.aleph-tec.com/eicar/">online</a> <a href="http://www.info-techs.com/eicar.shtml">sites</a> which can also email you EICAR files.
<h3>Debugging amavis</h3>
If results are not as per expectation, you can start amavis in debug mode using following commands:
<pre>service amavis stop
amavisd-new debug</pre>