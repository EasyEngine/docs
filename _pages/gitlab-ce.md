---
ID: 141395
post_title: Gitlab-CE
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/gitlab/gitlab-ce/
published: true
post_date: 2016-12-29 00:39:55
---
We use and recommend <a href="https://about.gitlab.com/downloads/#ubuntu1604">omnibus method</a> with latest Ubuntu LTS.
<h2>Install</h2>
<h3>Gitlab-CE Package</h3>
<pre class="no-highlight">#Install and configure the necessary dependencies
sudo apt-get install curl openssh-server ca-certificates postfix

#Add the GitLab package server 
curl -sS https://packages.gitlab.com/install/repositories/gitlab/gitlab-ce/script.deb.sh | sudo bash

#install the package
sudo apt-get install gitlab-ce

#Configure and start GitLab
sudo gitlab-ctl reconfigure
</pre>
<h3>Configure</h3>
All Gitalb related configurations are stored in <code>/etc/gitlab/gitlab.rb</code>
<pre class="no-highlight">vim /etc/gitlab/gitlab.rb</pre>
Useful links:
<ul>
 	<li><a href="https://gitlab.com/gitlab-org/omnibus-gitlab/blob/master/files/gitlab-config-template/gitlab.rb.template">Sample configuration file</a></li>
 	<li><a href="https://docs.gitlab.com/omnibus/settings/README.html">Official Documentation about different settings</a></li>
</ul>
Gitlab offers too many options. We are using:
<ol>
 	<li>Email sending via SMTP with AWS SES</li>
 	<li>Inbound emails with Gmail IMAP</li>
 	<li>Backup with Amazon S3</li>
</ol>
<h2>S3 Backup</h2>
<em>Based on <a href="https://gitlab.com/gitlab-org/gitlab-ce/blob/master/doc/raketasks/backup_restore.md">this official doc</a>. For <a href="https://gitlab.com/gitlab-org/gitlab-ce/blob/master/doc/raketasks/backup_restore.md#upload-backups-to-remote-cloud-storage">S3 instructions, jump here</a>.</em>
<h3>Backup</h3>
<pre class="no-highlight">sudo gitlab-rake gitlab:backup:create
</pre>
<h3>Setup Cron for Automated Backup</h3>
Run
<pre class="no-highlight">crontab -e</pre>
Add
<pre class="no-highlight">0 2 * * * /opt/gitlab/bin/gitlab-rake gitlab:backup:create CRON=1</pre>
<h3>Restore</h3>
<a href="https://gitlab.com/gitlab-org/gitlab-ce/blob/master/doc/raketasks/backup_restore.md#omnibus-installations"><em>Ref: Official Doc</em></a>

Download latest backup from S3 or copy from old server to location <code>/var/opt/gitlab/backups</code>

Run
<pre class="no-highlight"># Stop the processes that are connected to the database.
sudo gitlab-ctl stop unicorn
sudo gitlab-ctl stop sidekiq

# Verify
sudo gitlab-ctl status

# Restore
sudo gitlab-rake gitlab:backup:restore

# Restart gitlab and verify
sudo gitlab-ctl start
sudo gitlab-rake gitlab:check SANITIZE=true</pre>
<h2>Upgrade</h2>
<pre class="no-highlight">sudo apt-get update 
sudo apt-get install gitlab-ce</pre>
<h2>Maintenance mode</h2>
Start
<pre class="no-highlight">gitlab-ctl deploy-page up</pre>
Stop
<pre class="no-highlight">gitlab-ctl deploy-page down</pre>
Useful
<ul>
 	<li><a href="http://docs.gitlab.com/ce/administration/raketasks/maintenance.html">Maintenance rake tasks</a></li>
</ul>
<h3>Todo</h3>
<ol>
 	<li>Share configs</li>
 	<li>main backup</li>
 	<li>/etc/gitlab backup</li>
</ol>