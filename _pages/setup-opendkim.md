---
ID: 71869
post_title: Setup OpenDKIM
author: Dinesh Jain
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/mail/setup-opendkim/
published: true
post_date: 2014-09-24 17:14:26
---
```bash
apt-get install opendkim opendkim-tools
```

### Configure OpenDKIM:
Let's start with the main configuration file:

```bash
^_^[root@example.com:~]# vim /etc/opendkim.conf
ExternalIgnoreList refile:/etc/opendkim/TrustedHosts
InternalHosts refile:/etc/opendkim/TrustedHosts
KeyTable refile:/etc/opendkim/KeyTable
SigningTable refile:/etc/opendkim/SigningTable
SOCKET inet:8891@localhost
```

**Next OpenDKIM defaults file:**

```bash
^_^[root@example.com:~]# vim /etc/default/opendkim
SOCKET="inet:8891@localhost"
```

### Configure Postfix:

```bash
^_^[root@example.com:~]# vim /etc/postfix/main.cf

# OpenDKIM
milter_default_action = accept
milter_protocol = 2
smtpd_milters = inet:localhost:8891
non_smtpd_milters = inet:localhost:8891
```

### Specify trusted hosts:
We will use this file to define both ExternalIgnoreList and InternalHosts, messages originating from these hosts, domains and IP addresses will be trusted and signed.

Because our main configuration file declares TrustedHosts as a regular expression file (refile), we can use wildcard patters, *.example.com means that messages coming from example.com&#039;s subdomains will be trusted too, not just the ones sent from the root domain.

Customize and add the following lines to the newly created file. Multiple domains can be specified, do not edit the first two lines:
```bash
^_^[root@example.com:~]# vim /etc/opendkim/TrustedHosts
127.0.0.1
localhost

*.example.com
```

### Create a key table:
A key table contains each selector/domain pair and the path to their private key. Any alphanumeric string can be used as a selector, in this example mail is used and it&#039;s not necessary to change it.

```bash
^_^[root@example.com:~]# vim /etc/opendkim/KeyTable
mail._domainkey.example.com example.com:mail:/etc/opendkim/keys/example.com/mail.private

# mail._domainkey.example.net example.net:mail:/etc/opendkim/keys/example.net/mail.private
# mail._domainkey.example.org example.org:mail:/etc/opendkim/keys/example.org/mail.private
```

### Create a signing table:
This file is used for declaring the domains/email addresses and their selectors.
```bash
^_^[root@example.com:~]# vim /etc/opendkim/SigningTable
*@example.com mail._domainkey.example.com

# *@example.net mail._domainkey.example.net
# *@example.org mail._domainkey.example.org
```

### Generate the public and private keys:
Create a directory structure that will hold the trusted hosts, key tables, signing tables and crypto keys:
```bash
^_^[root@example.com:~]# mkdir -p /etc/opendkim/keys/example.com
^_^[root@example.com:~]# cd /etc/opendkim/keys/example.com
^_^[root@example.com:~]# opendkim-genkey -s mail -d example.com
```
-s specifies the selector and -d the domain, this command will create two files, mail.private is our private key and mail.txt contains the public key.

### Change the owner of the private key to opendkim:
```bash
^_^[root@example.com:~]# chown opendkim:opendkim mail.private
```

### Add the public key to the domain&#039;s DNS records
```bash
^_^[root@example.com:~]# cat mail.txt
```
Copy that key and add a TXT record to your domain&#039;s DNS entries:

```bash
Name: mail._domainkey.example.com.
Text: "v=DKIM1; k=rsa; p=MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC5N3lnvvrYgPCRSoqn+awTpE+iGYcKBPpo8HHbcFfCIIV10Hwo4PhCoGZSaKVHOjDm4yefKXhQjM7iKzEPuBatE7O47hAx1CJpNuIdLxhILSbEmbMxJrJAG0HZVn8z6EAoOHZNaPHmK2h4UUrjOG8zA5BHfzJf7tGwI+K619fFUwIDAQAB"
```

Please note that the DNS changes may take a couple of hours to propagate.

### Restart Postfix and OpenDKIM:

```bash
^_^[root@example.com:~]# service postfix restart
^_^[root@example.com:~]# service opendkim restart
```

### Testing DKIM setup for correctness:
Anything we do, especially for the first time, must end with successful testing!
There are many tools for testing. Some of them are mentioned below.

### Verify DNS Records for OpenDKIM Setup

```bash
dig mail._domainkey.example.com TXT
;; ANSWER SECTION:
mail._domainkey.exmaple.com. 86400 IN TXT "v=DKIM1\;" "k=rsa\;" "t=y\;" "p=MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC5N3lnvvrYgPCRSoqn+awTpE+iGYcKBPpo8HHbcFfCIIV10Hwo4PhCoGZSaKVHOjDm4yefKXhQjM7iKzEPuBatE7O47hAx1CJpNuIdLxhILSbEmbMxJrJAG0HZVn8z6EAoOHZNaPHmK2h4UUrjOG8zA5BHfzJf7tGwI+K619fFUwIDAQAB"
```

Webbase tool: <a href="http://www.protodave.com/tools/dkim-key-checker/" target="_blank">http://www.protodave.com/tools/dkim-key-checker/</a>
Use selector `mail` and domain `example.com` there.

### Verify OpenDKIM Signing:
The configuration can be tested by sending an empty email to autorespond+dkim@dk.elandsys.com or check-auth2@verifier.port25.com and a reply will be received. If everything works correctly you should see DKIM check: pass under Summary of Results.

```bash
=========================================================
Summary of Results
==========================================================
SPF check: pass
DomainKeys check: neutral
DKIM check: pass
Sender-ID check: pass
SpamAssassin check: ham
```

Alternatively, you can send a message to a Gmail address that you control, view the received email's headers in your Gmail inbox, dkim=pass should be present in the Authentication-Results header field.

```bash
Authentication-Results: mx.google.com;
spf=pass (google.com: domain of contact@example.com designates --- as permitted sender) smtp.mail=contact@example.com;
dkim=pass header.i=@example.com;
```

### Test using swaks
```bash
apt-get install swaks
swaks -t check-auth2@verifier.port25.com -f contact@example.com
```

### Test using mail-tester.com
Better choice will be to use a service like <a href="http://www.mail-tester.com/" target="_blank">http://www.mail-tester.com/</a> which gives you a temporary email ID and web-interface to see what happens to the email on receiving end!

For WordPress, its better to test using <a title="Check Email" href="http://wordpress.org/plugins/check-email/" target="_blank">Check Email</a> plugin as you will get a better picture of what happens to mail sent from WordPress!