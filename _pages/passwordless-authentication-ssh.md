---
ID: 76909
post_title: Passwordless Authentication for SSH
author: Nitun Lanjewar
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/linux/passwordless-authentication-ssh/
published: true
post_date: 2014-12-02 19:17:40
---
<strong>Note</strong>: This post is for Linux and Macintosh OS.

Purpose of this article is to exchange "keys" between your machine and a remote server so that you can login without a password. After this procedure, you will not need to enter password for commands like ssh, scp, sftp, rsync, etc.

Perform the following steps:
<h3>1. Open terminal/command prompt on your machine</h3>
In Linux/Mac, open an application named "Terminal.

For SSH to work, SSH access must be opened on the server beforehand.
<h3>2. Generating key-pairs (one-time operation)</h3>
This is needed if you are doing this the first time!

Run the following command  to generate a pair of public &amp; private keys using the <a href="http://en.wikipedia.org/wiki/RSA">RSA algorithm</a>. If you want to use <a href="http://en.wikipedia.org/wiki/Digital_Signature_Algorithm">DSA</a> just replace the last argument "-t rsa" with "-t dsa"
<pre>ssh-keygen -t rsa</pre>
The command may prompt you for input. Just keep hitting the "enter" key till you get the command-prompt back.

You can check the generated key pair by viewing the ".ssh" directory under your home directory.
<pre>ls -l ~/.ssh</pre>
An example output is shown:
<pre>-rw-r--r--  1 rahul  staff   412 Jan 30  2009 authorized_keys
-rw-------  1 rahul  staff  1675 Jan 27  2009 <strong>id_rsa</strong>
-rw-r--r--  1 rahul  staff   412 Jan 27  2009 <strong>id_rsa.pub</strong>
-rw-r--r--  1 rahul  staff  8031 Apr 23 15:03 known_hosts</pre>
Number of files may vary. All we need are the <strong>id_rsa</strong> and <strong>id_rsa.pub</strong> files.
<h3>3. Adding you public key to the server's "authorized_keys" list</h3>
Like your system, on server also, under each users home directory, there exists a hidden directory called ".ssh"<strong>.</strong>

Inside server's .ssh folder,  there may be similar files as we have seen above. The only file we are interested in is the <strong>authorized_keys</strong> file.

We have to add our public key (content of <strong>id_rsa.pub</strong> file) to the <strong>authorized_keys</strong> file on the server.

Run the following command to do this:
<pre>cat ~/.ssh/id_rsa.pub | ssh username@example.com "cat - &gt;&gt; ~/.ssh/authorized_keys"</pre>
Make sure you replace <em>username@example.com</em> with your actual username and domain name.

On running the above command, you will be prompted for the password (one last time).

Just enter your your SSH/SFTP/FTP password for the "username" on example.com
<h3>4. Testing Passwordlesss Authentication</h3>
If you have followed every step till now, it is time to test everything.

Just run the following command with username@example.com replaced by actual username and domain name.
<pre>ssh username@example.com</pre>
On running above command, you should get a shell on server without being asked for a password!
<h2>Automating whole thing!</h2>
If you want to access/manage many servers frequently, it will be tiresome to run all above commands again and again.

We can automate everything by creating a small script for our own usage. (<a href="http://www.cmmichael.com/blog/2007/01/18/ssh-passwordless-authentication">Thanks to this article</a>)

I am assuming that you have already generated a key pair as mentioned in step #1 above.

**Now perform the following steps only once! **

Create a file called <strong>ssh-install-key</strong> under the <strong>".ssh"</strong> folder under your home directory using the following command.
<pre>echo "cat ~/.ssh/id_rsa.pub | ssh ${1} "cat - &gt;&gt; ~/.ssh/authorized_keys""  &gt;  ~/.ssh/ssh-install-key</pre>
Make this file executable by running the following command:
<pre>chmod u+x ~/.ssh/ssh-install-key</pre>
<strong>Enabling Passwordless authentication using "ssh-install-key"</strong>

Now each time you need to add a server, just run the following command:
<pre>~/.ssh/ssh-install-key username@example.com</pre>
It may ask for a password once. Just enter your password.

After this you can simply login using the following command, of course without any password.
<pre>ssh username@example.com</pre>
<strong>ssh-install-key</strong> is basically an "easy-to-use and remember" shortcut for command mentioned in step #3 above.