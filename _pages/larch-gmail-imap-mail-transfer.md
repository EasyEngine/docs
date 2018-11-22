---
ID: 48811
post_title: >
  Using larch for mail transfer between
  imap/gmail servers
author: Rahul Bansal
post_excerpt: 'Using larch you can transfer mail between imap/gmail servers.  Larch can be used for automated backups via cron. Larch can handle duplicates.'
layout: page
permalink: >
  https://easyengine.io/tutorials/mail/larch-gmail-imap-mail-transfer/
published: true
post_date: 2013-10-19 18:04:50
---
When it comes to copying/moving emails between 2 imap/gmail servers, we prefer <a href="https://github.com/rgrove/larch/">larch</a> - a ruby gem.

Since gmail provides imap, it shouldn't be any surprise to see it working with larch. What makes larch special is that its special-handling for Gmail's labels.
<h3>Install Ruby &amp; Gems</h3>
If you don't have ruby, you can run following.
<pre class="no-highlight">apt-get install ruby1.9.1 ruby1.9.1-dev rubygems1.9.1 irb1.9.1 ri1.9.1 rdoc1.9.1 build-essential libopenssl-ruby1.9.1 libssl-dev zlib1g-dev libsqlite3-dev</pre>
There is <a href="http://rvm.io/">rvm installation method</a> also which is more popular among rubyist. Since you did not have ruby previously, I assume above command will be your preferred choice.
<h3>Install Larch</h3>
Larch can be installed using any rubygem.
<pre class="no-highlight">gem install larch</pre>
<h3>Usage</h3>
Below is an example command to move emails from OLD-HOST to NEW-HOST where OLD-USER and OLD-PASS are username and password on old server, while NEW-USER and NEW-PASS are username and password on new server.
<pre class="no-highlight">larch --from imap://OLD-HOST --from-user OLD-USER --from-pass OLD-PASS --to imap://NEW-HOST --to-user NEW-USER --to-pass NEW-PASS --all</pre>
As you can see larch needs many parameters but they all are obvious and self-explanatory.

Don't worry if you forget any larch parameter. Larch will prompt you for missing parameter except, "from" and "to".

<code>--all</code> flag moves mails inside all folder. If a folder doesn't exist on destination server, larch will create it automatically.
<h4>Copying All Gmail Mails</h4>
For Gmail, because of its label-system, you can use a syntax like:
<pre class="no-highlight">larch --from imaps://imap.gmail.com --to imaps://imap.gmail.com --from-folder '[Gmail]/All Mail' --to-folder '[Gmail]All Mail'</pre>
It will copy mails from "All Mail" to "All Mail". Larch will prompt you for username &amp; password since we did not specify it in above command.
<h4>Delete copied email</h4>
In all larch commands, you can add <code>--delete</code> flag so once a mail is copied to new server, it gets deleted from old server.
<h3>Duplicate Handling</h3>
You no need to use delete flag in case you are worried about duplicated. Running same larch commands again and again doesn't create duplicate emails on destination server. Larch automatically checks for duplicates.

This also means you can setup a cron job to run larch command, in case you want to backup your mails.
<h4>More...</h4>
Check <a href="https://github.com/rgrove/larch/">Larch Readme on Github</a> for more examples.