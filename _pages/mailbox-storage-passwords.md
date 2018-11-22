---
ID: 62337
post_title: List Mailboxes Storage and Passwords
author: Rahul Bansal
post_excerpt: >
  Simple command to list mailbox created
  by plesk, storage and password used by
  each mailbox
layout: page
permalink: >
  https://easyengine.io/tutorials/plesk/mailbox-storage-passwords/
published: true
post_date: 2014-03-19 19:05:24
---
<h2>List Mailboxes and Size</h2>
You can find list of mailboxes and space taken by each of them using following command/script (<a href="http://bestinlinux.com/script-to-list-all-mailboxes-and-disk-usage-in-plesk/">source</a>):
<pre class="bash"> if [ -d /var/qmail/mailnames ]; then echo -ne "\n\n=== MAILBOXES ===\n"; cd /var/qmail/mailnames &amp;&amp; TMB=$(du -ks */* 2&gt;/dev/null | sort -nr | cut -f2); if [ -n "$TMB" ]; then echo "$TMB" | xargs du -sh; fi; echo "[`find . -mindepth 2 -maxdepth 2 -type d | wc -l` Mailboxes - Total `du -hs | cut -f1`]"; fi;</pre>
It will generate output like:
<pre>=== MAILBOXES ===
3.6M	example.com/bob
3.3M	rtcamp.com/joe
[2 Mailboxes - Total 3.9M]</pre>
<h2>List Mailboxes and Passwords</h2>
Plesk has builtin command for this. Simply run:
<pre class="bash">/usr/local/psa/admin/bin/mail_auth_view</pre>
And you will see something like:
<pre>+------------------ ---+-----+---------------+
|       address        |flags|   password    |
+----------------------+-----+---------------+
|    bob@example.com   |     |     hello     |
|    joe@rtcamp.com    |     |     world     |
+----------------------+-----+---------------+
Flags
	A - account disabled
	D - domain disabled
	E - password encrypted</pre>
<h2>Mail Queue</h2>
Pleak has another built-in command to inspect mailqueue.

Running <code>/usr/local/psa/admin/bin/mailqueuemng</code><code></code> will show useful help about different parameters.
<h2>References</h2>
<a href="http://wiki.dragnux.org/index.php?title=Plesk_for_Linux">Check this for awesome collection of Plesk commands and cheats</a>.

&nbsp;