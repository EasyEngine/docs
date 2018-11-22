---
ID: 64853
post_title: Duplicity + Amazon S3
author: Rahul Bansal
post_excerpt: >
  Automated backup script using Duplicity
  and Amazon S3. Restore script for easy
  restoration.
layout: page
permalink: >
  https://easyengine.io/tutorials/backups/duplicity-amazon-s3/
published: true
post_date: 2014-05-01 19:11:39
---
In this article we will setup automated backup using Duplicity and Amazon S3.
<h2>Installation</h2>
Run following commands to install latest duplicity and python-boto library (duplicity needs it for Amazon S3).
<pre class="no-highlight">apt-add-repository ppa:duplicity-team/ppa
apt-get update
apt-get install duplicity
apt-get install python-pip
#apt-get install python-paramiko
#apt-get install python-gobject-2
pip install boto</pre>
<h2>Amazon S3</h2>
<h3>S3 Bucket</h3>
<a href="http://docs.aws.amazon.com/AmazonS3/latest/gsg/CreatingABucket.html">Create an Amazon S3 bucket</a> to store backup data. If you have multiple server then you may set bucket-name to server's FQDN.

For tutorial, we have created Amazon S3 buckets in US Standard zone only as we have most servers located on US East Coast. You may need to change Amazon S3 endpoint URL if you pick some other zone. <a href="http://docs.aws.amazon.com/general/latest/gr/rande.html#s3_region">This might help</a>.
<h3>API Access</h3>
Next create <a href="http://docs.aws.amazon.com/IAM/latest/UserGuide/Using_SettingUpUser.html#Using_CreateUser_console">IAM user with API credentials</a>. You will need <strong>Access Key Id</strong> and <strong>Secret Access Key</strong> later. Setting up password is not recommended as we will be using these credentials in backup script later on (in plaintext).

As we backup for many client servers, we create one IAM user per server with access to only one S3 bucket. You can generate access policies for IAM user using <a href="http://docs.aws.amazon.com/IAM/latest/UserGuide/ManagingPolicies.html#AddingPermissions_Console">this amazon article</a>.

In our case, we use following policy <em>(credit to <a href="http://mikeferrier.com/2011/10/27/granting-access-to-a-single-s3-bucket-using-amazon-iam/">Mike</a>)</em>:
<pre class="no-highlight">{
    "Statement": [
        {
            "Effect": "Allow",
            "Action": "s3:ListAllMyBuckets",
            "Resource": "arn:aws:s3:::*"
        },
        {
            "Effect": "Allow",
            "Action": "s3:*",
            "Resource": [
                "arn:aws:s3:::BUCKET_NAME",
                "arn:aws:s3:::BUCKET_NAME/*"
            ]
        }
    ]
}
</pre>
Make sure you replace BUCKET_NAME by actual S3 bucket name.
<h2>GPG Key (optional)</h2>
By default, duplicity uses symmetric encryption on backup. This means using a simple password which is fine in most cases.

Still, if you are paranoid about security, you can add asymmetric i.e. public-private key encryption.

We have a complete tutorial which you can follow to <a href="http://rtcamp.com/tutorials/linux/gpg-keys/">generate GPG keys</a>. Make sure you remember passphrase.
<h2>Backup Script</h2>
<h3>Create Backup Script</h3>
Duplicity works with environment variables so we need to create a script to setup correct parameter. Also this script can be used with cron for automated backup.

Create backup script file:
<pre class="no-highlight">vim /usr/local/sbin/backup.sh</pre>
Add following codes to it
<pre class="no-highlight">#!/bin/bash

# Set up some variables for logging
LOGFILE="/var/log/backup.log"
DAILYLOGFILE="/var/log/backup.daily.log"
HOST=`hostname`
DATE=`date +%Y-%m-%d`
MAILADDR="admin@example.com"

# Clear the old daily log file
cat /dev/null &gt; ${DAILYLOGFILE}

# Trace function for logging, don't change this
trace () {
        stamp=`date +%Y-%m-%d_%H:%M:%S`
        echo "$stamp: $*" &gt;&gt; ${DAILYLOGFILE}
}

# Export some ENV variables so you don't have to type anything
export AWS_ACCESS_KEY_ID="IAM_USER_ACCESS_KEY_ID"
export AWS_SECRET_ACCESS_KEY="IAM_USER_SECRET_ACCESS_KEY"
export PASSPHRASE="GPG_OR_SOME_OTHER_PASSPHRASE"

# Your GPG key
#GPG_KEY=KEY_HERE

# How long to keep backups for
OLDER_THAN="1M"

# The source of your backup
SOURCE=/

# The S3 destination followed by bucket name
DEST="s3://s3.amazonaws.com/example.com/"

FULL=
if [ $(date +%d) -eq 1 ]; then
        FULL=full
fi;

trace "Backup for local filesystem started"

trace "... removing old backups"

duplicity remove-older-than ${OLDER_THAN} ${DEST} &gt;&gt; ${DAILYLOGFILE} 2&gt;&amp;1

trace "... backing up filesystem"

duplicity \
    ${FULL} \
#    --encrypt-key=${GPG_KEY} \
#    --sign-key=${GPG_KEY} \
    --include=/var/www \
    --include=/etc \
    --include=/home \
    --include=/root \
    --exclude=/** \
    --exclude=/root/.cache \
    ${SOURCE} ${DEST} &gt;&gt; ${DAILYLOGFILE} 2&gt;&amp;1

trace "Backup for local filesystem complete"
trace "------------------------------------"

# Send the daily log file by email
cat "$DAILYLOGFILE" | mail -s "Duplicity Backup Log for $HOST - $DATE" $MAILADDR

# Append the daily log file to the main log file
cat "$DAILYLOGFILE" &gt;&gt; $LOGFILE

# Reset the ENV variables. Don't need them sitting around
unset AWS_ACCESS_KEY_ID
unset AWS_SECRET_ACCESS_KEY
unset PASSPHRASE</pre>
Make sure you substitute correct values for:
<ul>
	<li><code>AWS_ACCESS_KEY_ID</code>  IAM user's access key ID</li>
	<li><code>AWS_SECRET_ACCESS_KEY</code>  IAM user's secret access key</li>
	<li><code>PASSPHRASE</code> - this will be a symmetric encryption password or GPG key passphrase if asymmetric encryption is used</li>
	<li><code>DEST="s3://s3.amazonaws.com/example.com/"</code> - AWS S3 region and bucket. example.com is bucket name here.</li>
</ul>
If you are using GPG then make sure:
<ul>
	<li><code>PASSPHRASE</code> will be GPG Key passphrase</li>
	<li>Uncomment line <code>#GPG_KEY=KEY_HERE</code> and replace <code>KEY_HERE</code> with actual GPG key</li>
	<li>Uncomment line  <code># --encrypt-key=${GPG_KEY} \</code></li>
	<li>Uncomment line <code># --sign-key=${GPG_KEY} \</code></li>
</ul>
Setup backup script permission and user:
<pre class="no-highlight">chown root:root /usr/local/sbin/backup.sh
chmod 0700 /usr/local/sbin/backup.sh</pre>
<h3>Run Backup</h3>
Run backup script to verify if its actually backing up:
<pre class="no-highlight">bash /usr/local/sbin/backup.sh</pre>
<h3>Setup Cron</h3>
After first backup, only changes are sent.

You can add following line to cron (<code>crontab -e</code>)
<pre class="no-highlight">0 * * * *	/usr/local/sbin/backup.sh</pre>
Above cron will run our backup script hourly.
<h2>Restore Script</h2>
A backup is useless without easy restore support.

Create restore script:
<pre class="no-highlight">vim /usr/local/sbin/restore.sh</pre>
Add following codes to it:
<pre class="no-highlight">#!/bin/bash
# Export some ENV variables so you don't have to type anything
export AWS_ACCESS_KEY_ID="IAM_USER_ACCESS_KEY_ID"
export AWS_SECRET_ACCESS_KEY="IAM_USER_SECRET_ACCESS_KEY"
export PASSPHRASE="GPG_OR_SOME_OTHER_PASSPHRASE"

# The S3 destination followed by bucket name
DEST="s3://s3.amazonaws.com/example.com/"

# Your GPG key
#GPG_KEY=YOUR_GPG_KEY

if [ $# -lt 3 ]; then echo "Usage $0 &lt;date&gt; &lt;file&gt; &lt;restore-to&gt;"; exit; fi

duplicity \
#    --encrypt-key=${GPG_KEY} \
#    --sign-key=${GPG_KEY} \
    --file-to-restore $2 \
    --restore-time $1 \
    ${DEST} $3

# Reset the ENV variables. Don't need them sitting around
unset AWS_ACCESS_KEY_ID
unset AWS_SECRET_ACCESS_KEY
unset PASSPHRASE</pre>
Setup restore script permission and user:
<pre class="no-highlight">chown root:root /usr/local/sbin/restore.sh
chmod 0700 /usr/local/sbin/restore.sh</pre>
Usage:
<pre class="no-highlight">restore.sh &lt;date&gt; &lt;file&gt; &lt;restore-to&gt;
</pre>
It is strongly recommended that you create a new folder for restore location and it must be different than actual file/folder you are trying to restore.
<h2>Verify Script</h2>
Ideally, there must be a mechanism to check integrity of check periodically. I think duplicity command's verify option does that. (<a href="https://answers.launchpad.net/duplicity/+question/116587">not sure</a>)

Create verify script:
<pre class="no-highlight">vim /usr/local/sbin/verify.sh</pre>
Add following codes to it:
<pre class="no-highlight">#!/bin/bash
# Export some ENV variables so you don't have to type anything
export AWS_ACCESS_KEY_ID="IAM_USER_ACCESS_KEY_ID"
export AWS_SECRET_ACCESS_KEY="IAM_USER_SECRET_ACCESS_KEY"
export PASSPHRASE="GPG_OR_SOME_OTHER_PASSPHRASE"

# The S3 destination followed by bucket name
DEST="s3://s3.amazonaws.com/example.com/"

# The source of your backup
SOURCE=/
# Your GPG key
#GPG_KEY=YOUR_GPG_KEY

duplicity verify -v4 ${DEST} ${SOURCE}\
    --include=/var/www \
    --include=/etc \
    --include=/home \
    --include=/root \
    --exclude=/** \
    --exclude=/root/.cache 

# Reset the ENV variables. Don't need them sitting around
unset AWS_ACCESS_KEY_ID
unset AWS_SECRET_ACCESS_KEY
unset PASSPHRASE</pre>
Setup restore script permission and user:
<pre class="no-highlight">chown root:root /usr/local/sbin/verify.sh
chmod 0700 /usr/local/sbin/verify.sh</pre>
Usage:
<pre class="no-highlight">verify.sh</pre>
<h2>TODO</h2>
<ol>
	<li>Publish mysqldump script and may be call it from backup script (msyqldump followed by backup)</li>
	<li>Add support for running <code>restore.sh</code> without date. That should restore most recent version of file.</li>
	<li>Add a verify script with cronjob. Not sure if it can be used for testing backup's integrity. It will be good if it emails sysadmin about possible backup corruption.</li>
	<li>Tweak file selection to exclude backups and hidden files/folder. <a href="http://duplicity.nongnu.org/duplicity.1.html#sect10">Useful reading</a>.</li>
	<li>Move setting and unsetting credential to common file OR create a single script file with different functions are backup, restore, verify, etc. I guess this will be done in <a href="https://github.com/rtCamp/easyengine/issues/145">EasyEngine</a>.</li>
</ol>
<h2>Credits</h2>
<ol>
	<li><a href="http://www.cenolan.com/2008/12/how-to-incremental-daily-backups-amazon-s3-duplicity/">Backup and restore scripts source</a></li>
	<li><a href="http://icelab.com.au/articles/easy-server-backups-to-amazon-s3-with-duplicity/">Another useful tutorial</a></li>
	<li><a href="https://help.ubuntu.com/community/DuplicityBackupHowto#Verify">Ubuntu man page helped for verift script</a></li>
</ol>