---
ID: 49093
post_title: >
  Checking FQDN, Reverse-DNS/PTR, MX
  record
author: Rahul Bansal
post_excerpt: >
  Verifying FQDN (fully qualified domain
  name) and Reverse-DNS/PTR (pointer
  record) for your mail-server to improve
  delivery. Also covers basic of MX.
layout: page
permalink: >
  https://easyengine.io/tutorials/mail/fqdn-reverse-dns-ptr-mx-record-checks/
published: true
post_date: 2013-10-19 15:19:13
---
Before you start a mail server, you must verify your server's FQDN, reverse PTR, MX records.
<h3>FQDN</h3>
<a href="http://en.wikipedia.org/wiki/Fully_qualified_domain_name">FQDN</a> (fully qualified domain name) is a name assigned to an individual machine. Its purpose is to uniquely identify a single machine across internet. It is name of your server.
<h4>Checking Hostname (FQDN)</h4>
Following commands show outcome for test.rtcamp.com <em>(a subdomain we used for test mail server setup)</em>

Check FQDN by running following command on server:
<pre>hostname -f</pre>
Outputs:
<pre>test.rtcamp.com</pre>
<h4>Changing Hostname (FQDN)</h4>
If its incorrect, or need a change you can do so by running:
<pre class="no-highlight">hostname myhost.mydomain.mytld</pre>
As you can see, we can give any name to your server, you may be wondering how uniqueness works! That's where reverse PTR come into picture.
<h4>Important - Set "A" Record for Host in FQDN</h4>
If you set your machine's FQDN, for example <code>mail.example.com</code>, then at <code>example.com</code> DNS create an "A" record for subdomain "mail" poiting to your server's IP address.

You can use <code>example.com</code> as your hostname also which most likely pointing to your server's IP address already. It's not FQDN technically, but I see it working mostly. Still, I will never use or recommend non-FQDN hostname.
<h3>Reverse DNS/PTR Record</h3>
Like "A" record help global internet find IP-address for a domain, pointer record (PTR) helps you find domain (FQDN) for an IP. As this is reverse to what commonly DNS is used for, this process is often referred as <a href="http://en.wikipedia.org/wiki/Reverse_DNS_lookup">Reverse-DNS lookup</a>  also.

Having your FQDN (domain-name) resolve to IP and reverse-lookup for IP back to domain name can improve mail-delivery. This is also called <a href="http://en.wikipedia.org/wiki/Forward_Confirmed_reverse_DNS">Forward-confirmed reverse DNS</a>.

Check IP address of your server using following command:
<pre>host test.rtcamp.com</pre>
You will see lines like below:
<pre>test.rtcamp.com has address <strong>192.241.254.103</strong>
test.rtcamp.com mail is handled by 10 test.rtcamp.com.</pre>
If your server has multiple A records, you will see multiple lines for IP-addresses listed one-per-line. For real example run <code>host google.com</code>

Please note IP address for now. Check reverse PTR for IP address is correct:
<pre>host 192.241.254.103</pre>
Outputs:
<pre>103.254.241.192.in-addr.arpa domain name pointer test.rtcamp.com.</pre>
As you can see, reverse DNS lookup for IP shows same hostname (FQDN) in above example.

If you see incorrect hostname, you may contact your hosting company/ISP to get it fixed. Wrong Reverse PTR can lead to emails being rejected from your server. Please do not contact your domain registrar, if your domain-registrar and web/mail-hosting companies are differnt.
<h4>dig command for reverse-DNS/PTR lookup</h4>
You can also use dig tool also. Just write IP address in octet-reverse and append <code>in-addr.arpa</code> in the end:
<pre class="no-highlight">dig +short ptr 103.254.241.192.in-addr.arpa</pre>
You will output like:
<pre class="no-highlight">test.rtcamp.com.</pre>
<h3>MX Records</h3>
MX record tells Internet which machine will receive mails for a particular domain/subdomain.

Easiest way to check if who is handling mails for your domain is to run again:
<pre>host test.rtcamp.com</pre>
You will see lines like below:
<pre>test.rtcamp.com has address 192.241.254.103
test.rtcamp.com mail is handled by 10 <strong>test.rtcamp.com.</strong></pre>
As you can see mails for <code>test.rtcamp.</code>com is handled by <code>test.rtcamp.com</code> only (same server).

If you are using Google Apps, you will see outcome like:
<pre class="no-highlight">rtcamp.com mail is handled by 30 alt2.aspmx.l.google.com.
rtcamp.com mail is handled by 10 aspmx.l.google.com.
rtcamp.com mail is handled by 20 alt1.aspmx.l.google.com.
rtcamp.com mail is handled by 50 aspmx3.googlemail.com.
rtcamp.com mail is handled by 40 aspmx2.googlemail.com.</pre>
If you do not see <em>"mail is handled"</em> line, that means your domain do not have a MX record.

This is also fine as long as your do not want to handle incoming emails for a particular domain. You do NOT need MX records to send domain from a particular emails.
<h4>How multiple domains works then!</h4>
First question I was asked when we were writing this series was - if reverse-PTR to IP and IP to FQDN is must, how multiple domains works. Specially under shared-hosting scenario.

A short answer is - on shared hosting, even you send mail FROM your domain, in mail headers, FQDN (machine's unique names) gets appended for which reverse-PTR is correctly mostly. As long as FQDN &amp; Reverse-PTR are perfect, mails will work most likely. This is like first-check, not the only check!