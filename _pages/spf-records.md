---
ID: 45950
post_title: SPF Records
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/mail/spf-records/
published: true
post_date: 2013-10-19 22:15:06
---
<h3>SPF Record for your server</h3>
You can create any simple record like:
<pre>v=spf1 a mx ptr ~all</pre>
<strong>Significance of every letter:</strong>
<ul>
	<li><code>a</code> means A-record. This means IP of this domain.</li>
	<li><code>mx</code> records indicate server which accepts mail for this domain. If same mail-server generate outgoing email, accept them.</li>
	<li><code>ptr</code> records can help you verify all subdomain for your server. Generally ptr record is linked to FQDN which is different than root domain. This part makes sure mails sent from <em>host.example.com </em>are also accepted.</li>
	<li><code>~all</code> has 2 more variants <code>-all</code> and <code>?all</code>.  ~ (tidal) results in soft-fail. - (minus) result in hard-fail. If you are new to SPF record, don't use this. ? (question-mark) means neutral which is as bad as not using SPF at all IMHO!</li>
</ul>
If you need any help to get SPF record right, you can use <a href="http://spfwizard.com/">spfwizard.com</a>
<h3>SPF Record and Google Apps</h3>
If you are using Google Apps, then you may be using following for SPF record:
<pre class="no-highlight">v=spf1 include:_spf.google.com ~all</pre>
Now, in addition to Google's server, your own web-server (where you are hosting your site) most likely sending emails on behalf of your domain.

You can add your server's IP using a shortcut below:
<pre class="no-highlight">v=spf1 a include:_spf.google.com ~all</pre>
If you compare with previous record, it has only an extra "a", which means IP address(es) to which A-Record for your domain points.

We are using:
<pre class="no-highlight">v=spf1 a ptr include:_spf.google.com ~all</pre>
<h3>Testing SPF Record</h3>
You can use excellent web-based tool <a href="http://www.mail-tester.com/">mail-tester.com</a>.