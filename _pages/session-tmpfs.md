---
ID: 41635
post_title: 'Moving PHP&#8217;s session storage to tmpfs'
author: Rahul Bansal
post_excerpt: "Moving PHP's session storage to tmpfs for speedier access. Also changing ubuntu/debian cron job for automated session cleanup."
layout: page
permalink: >
  https://easyengine.io/tutorials/php/session-tmpfs/
published: true
post_date: 2013-06-28 23:01:15
---
Open php.ini
<pre class="no-highlight">vim /etc/php5/fpm/php.ini</pre>
Add following line.
<pre class="no-highlight">session.save_path = "/var/run/php5/sessions"</pre>
Save and exit.

Run following commands.
<pre class="no-highlight">mkdir -p /var/run/php5/sessions/
chown -R www-data:www-data /var/run/php5/
cp -rp /var/lib/php5/* /var/run/php5/sessions/
service php5-fpm restart</pre>
<h4>Edit cron on Debian/Ubuntu</h4>
<pre class="no-highlight">vim /etc/cron.d/php5</pre>
Find 2 occurrences of /var/lib/php5/ and replace them with /var/run/php5/sessions/

This cronjob keeps deleting old sessions from time to time. If you forget to do this, you will get disk full error.

That's it!