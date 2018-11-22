---
ID: 64856
post_title: GPG Keys Cheatsheet
author: Rahul Bansal
post_excerpt: 'GPG Keys - create, list, import/export, delete, encrypt/decrypt commands. Includes backing up GPG keys via email.'
layout: page
permalink: >
  https://easyengine.io/tutorials/linux/gpg-keys/
published: true
post_date: 2014-05-01 17:45:15
---
<h2>Generate GPG Keys</h2>
Run:
<pre class="no-highlight">gpg --gen-key</pre>
You will be asked:
<pre>Please select what kind of key you want:
   (1) RSA and RSA (default)
   (2) DSA and Elgamal
   (3) DSA (sign only)
   (4) RSA (sign only)
Your selection? 
</pre>
Hit ENTER to select default.

Next, you will be asked:
<pre>RSA keys may be between 1024 and 4096 bits long.
What keysize do you want? (2048) 
</pre>
Hit ENTER to select default 2048 length.

Next, you will be asked:
<pre>Please specify how long the key should be valid.
         0 = key does not expire
        = key expires in n days
      w = key expires in n weeks
      m = key expires in n months
      y = key expires in n years
Key is valid for? (0)
</pre>
Hit ENTER to select default 0 i.e. key does not expire.

It will again ask you to confirm your choice.
<pre>Key does not expire at all
Is this correct? (y/N)</pre>
Press 'y' this time.

Then it will ask you for your:
<pre class="no-highlight">Real name:
Email address:
Comment:</pre>
Enter your details. You can use comment to enter something like purpose of the key.

Next you will be  asked to enter passphrase twice. <strong>Remember this passphrase</strong>.

Next, you may see a message like:
<pre class="no-highlight">generator a better chance to gain enough entropy.

Not enough random bytes available.  Please do some other work to give
the OS a chance to collect more entropy! (Need 281 more bytes)</pre>
Just open another terminal window and run some commands which generates plenty of activity.

My favorite is running a disk write performance benchmark using:
<pre class="no-highlight">dd bs=1M count=1024 if=/dev/zero of=test conv=fdatasync</pre>
You will something like:
<pre class="no-highlight">gpg: key 0B2B9B37 marked as ultimately trusted
public and secret key created and signed.

gpg: checking the trustdb
gpg: 3 marginal(s) needed, 1 complete(s) needed, PGP trust model
gpg: depth: 0  valid:   1  signed:   0  trust: 0-, 0q, 0n, 0m, 0f, 1u
pub   2048R/0B2B9B37 2014-05-01
      Key fingerprint = 4AEC D912 EA8F D319 F3A7  EF49 E8F8 5A12 0B2B 9B37
uid                  rtCamp (S3 Backup) &lt;admin@example.com&gt;
sub   2048R/3AA184AD 2014-05-01</pre>
Output all this, line containing: <code>pub   2048R/<strong>0B2B9B37</strong> 2014-05 -01</code> is most important.

<code>0B2B9B37</code> is your GPG Key in this case.
<h2>List Keys</h2>
In case you forget to copy your key, you can find it list keys commands.

<strong>List Public Keys</strong>
<pre class="no-highlight">gpg --list-keys</pre>
You will see something like:
<pre class="no-highlight">/root/.gnupg/pubring.gpg
------------------------
pub   1024D/CD2EFD2A 2009-12-15
uid                  Percona MySQL Development Team &lt;mysql-dev@percona.com&gt;
sub   2048g/2D607DAF 2009-12-15

pub   2048R/<strong>0B2B9B37</strong> 2014-05-01
uid                  rtCamp (S3 Backup) &lt;admin@example.com&gt;
sub   2048R/3AA184AD 2014-05-01</pre>
<strong>List Private Keys</strong>
<pre class="no-highlight">gpg --list-secret-keys</pre>
You may notice lesser number of keys. It's perfectly fine as you might have others public key in your keyring which earlier command displayed. (e.g. Percona public key).
<h2>Export Keys</h2>
If you lose your private keys, you will eventually lose access to your data!

<strong>Export Public Key</strong>
<pre class="no-highlight">gpg --export -a "rtCamp" &gt; public.key</pre>
<strong>Export Private Key</strong>
<pre class="no-highlight">gpg --export-secret-key -a "rtCamp" &gt; private.key</pre>
Now don't forget to backup public and private keys.

You can email these keys to yourself using <a href="https://rtcamp.com/tutorials/mail/swaks-smtp-test-tool/">swaks</a> command:
<pre class="no-highlight">swaks --attach public.key --attach private.key --body "GPG Keys for `hostname`" --h-Subject  "GPG Keys for `hostname`"  -t admin@example.com</pre>
<h2>Importing Keys</h2>
If you ever have to import keys then use following commands.

<strong>Import Public Key</strong>
<pre class="no-highlight">gpg --import public.key
</pre>
<strong>Import Private Key</strong>
<pre class="no-highlight">gpg --allow-secret-key-import --import private.key
</pre>
<h2>Deleting Keys</h2>
At time you may want to delete keys.

<strong>Delete Public key</strong>
<pre class="no-highlight">gpg --delete-key "Real Name"</pre>
<strong>Delete Private key</strong>
<pre class="no-highlight">gpg --delete-secret-key "Real Name"</pre>
<h2>Generate Fingerprint</h2>
Sometime you need to generate fingerprint.
<pre class="no-highlight">gpg --fingerprint</pre>
Will show something like:
<pre class="no-highlight">pub   2048R/0B2B9B37 2014-05-01
      <strong>Key fingerprint = 4AEC D912 EA8F D319 F3A7  EF49 E8F8 5A12 0B2B 9B37</strong>
uid                  rtCamp (S3 Backup) &lt;sys@rtcamp.com&gt;
sub   2048R/3AA184AD 2014-05-01</pre>
<h2>Encrypt Data</h2>
<pre class="no-highlight">gpg -e -u "Sender (Your) Real Name" -r "Receiver User Name" file.txt</pre>
This will encrypt <code>file.txt</code> using receiver's public key.

Encrypted file will have <code>.gpg</code> extension. In this case it will be <code>file.txt.gpg</code> which you can send across.

I think <code>-u</code> is not necessary for encryption. It basically adds senders fingerprint <em>(which we saw above)</em>. This way receiver can verify who sent message.
<h2>Decrypt Data</h2>
<pre class="no-highlight">gpg -d file.txt.gpg</pre>
Decrypt command will pick correct secret key (if you have one).