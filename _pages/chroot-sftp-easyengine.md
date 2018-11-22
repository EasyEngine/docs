---
ID: 75114
post_title: Chroot SFtp with EasyEngine
author: Harshad Yeola
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/docs/chroot-sftp-easyengine/
published: true
post_date: 2014-10-24 13:03:23
---
In this tutorial, we are creating sftp user <strong>ee-user</strong> having access to only <strong>example.com</strong>
<h2>Create Users</h2>
The following command creates a user <strong>ee-user</strong> who should only allowed to perform SFTP in chroot environment, and not able to ssh.
<pre class="bash">root@example.com:~# useradd -G www-data -ms /bin/false ee-user
root@example.com:~# passwd ee-user</pre>
<h2>Create SFtp Home Directory</h2>
Lets create the home directory for user ee-user.
<pre class="bash">root@example.com:~# mkdir -p /home/ee-user/example.com/htdocs</pre>
<h2>Setup Permissions</h2>
Letus setup permissions for the user ee-user
<pre class="bash">root@example.com:~# chown ee-user:www-data /home/ee-user/example.com 
root@example.com:~# chown root:root /home/ee-user/
root@example.com:~# chown root:root /home/</pre>
The permissions should look like this for example.com directory, after executing above command.
<pre class="bash">root@example.com:~# ls -ld /home/
drwxr-xr-x 5 root root 4096 Oct 24 06:42 /home/
root@example.com:~# ls -ld /home/ee-user/
drwxr-xr-x 3 root root 4096 Oct 24 06:42 /home/ee-user
root@example.com:~# ls -ld /home/ee-user/example.com
drwxr-xr-x 2 ee-user www-data 4096 Oct 31 08:49 /home/ee-user/example.com</pre>
<h2>Setup sftp-server</h2>
Comment and add following lines in /etc/ssh/sshd_config file
<pre class="bash">root@example.com:~# vim /etc/ssh/sshd_config
# Find below line
Subsystem sftp /usr/lib/openssh/sftp-server
# Replace above line with following line
Subsystem sftp internal-sftp

# Add following lines at EOF
Match group www-data 
X11Forwarding no 
ChrootDirectory %h 
AllowTcpForwarding no 
ForceCommand internal-sftp</pre>
Restart ssh service
<pre class="bash">root@example.com:~# service ssh restart</pre>
<h2>Setup webroot permissions</h2>
<pre class="bash">chmod g+s /var/www/example.com/htdocs/
chmod 775 /var/www/example.com/htdocs</pre>
<h2>Mount webroot in SFtp home directory</h2>
<pre class="bash">root@example.com:~# mount --bind /var/www/example.com/htdocs /home/ee-user/example.com/htdocs</pre>
add above command in /etc/rc.local
<pre class="bash">root@example.com:~# vim /etc/rc.local</pre>
<pre class="bash">#!/bin/sh -e
#
# rc.local
#
# This script is executed at the end of each multiuser runlevel.
# Make sure that the script will "exit 0" on success or any other
# value on error.
#
# In order to enable or disable this script just change the execution
# bits.
#
# By default this script does nothing.
mount --bind /var/www/example.com/htdocs /home/ee-user/example.com/htdocs
exit 0</pre>
save above file and quit <code>:wq</code>