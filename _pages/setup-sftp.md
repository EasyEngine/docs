---
ID: 65524
post_title: Setup sftp
author: Mitesh Shah
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/linux/setup-sftp/
published: true
post_date: 2014-05-20 11:11:31
---
On cross platforms, Secure FTP allows transfer to and from server. This Tutorial Explain SFTP configuration.

### User setup:

To access the server first step is to setup authenticate user. 
Lets set password for `www-data` user 
```bash
sudo passwd www-data
```
Sample Output: 
```bash
^_^[root@example.com:~]# sudo passwd www-data
Enter new UNIX password: 
Retype new UNIX password: 
passwd: password updated successfully
```
### Setup Login Shell  : 

Check Login shell for the user  using    ``` grep www-data /etc/passwd```

```bash
^_^[root@example.com:~]# grep www-data /etc/passwd
www-data:x:33:33:www-data:/var/www:/usr/sbin/nologin
```
When its `nologin` in the output we need to change the login shell

To setup login shell change `/usr/sbin/nologin` to `/bin/bash`

```bash
^_^[root@example.com:~]# vim /etc/passwd
www-data:x:33:33:www-data:/var/www:/bin/bash
```
This completes sftp setup.

### Test SFTP Setup:
SSH Testing:
```bash
ssh www-data@server-ip-address
```

Filezilla Testing:
```bash
Host: server-ip-address
user: www-data
pass: your-password
port: 22
```