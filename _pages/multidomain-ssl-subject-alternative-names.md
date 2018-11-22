---
ID: 62473
post_title: 'Multi-Domain SSL Setup with &#8220;Subject Alternative Names&#8221;'
author: Rahul Bansal
post_excerpt: >
  Multi-Domain SSL Setup using "Subject
  Alternative Names" method. Useful for
  SSL with www and non-www domain
  versions, Unified Communications
  Certificate (UCC),
layout: page
permalink: >
  https://easyengine.io/wordpress-nginx/tutorials/ssl/multidomain-ssl-subject-alternative-names/
published: true
post_date: 2014-03-22 17:07:01
---
SSL Setup for multiple domains/subdomains is different than single-domain or wildcard domain setup. There are 2-ways to setup this (as far as I know) - using <a href="http://en.wikipedia.org/wiki/SubjectAltName">Subject Alternative Names</a> and <a href="http://en.wikipedia.org/wiki/Server_Name_Indication">Server Name Indication (SNI)</a>

In this article, we will use "Subject Alternative Names" method.
<h2>Use Cases</h2>
This tutorial is intended for following types of use case. If you are trying to setup something else, please ignore this.
<h3>non-www and www version of your site</h3>
<ol>
	<li>example.com</li>
	<li>www.example.com</li>
</ol>
<h3>wildcard (all subdomains) and apex/root/naked domain</h3>
<ol>
	<li>example.com</li>
	<li>*.example.com</li>
</ol>
Please note that most wildcard SSL do not protect your root domain i.e. example.com
<h3>altogether different domains</h3>
<ol>
	<li>example.com</li>
	<li>example.net</li>
	<li>google.com</li>
	<li>rtcamp.com</li>
	<li>www.example.com</li>
</ol>
<h2>Process</h2>
Different companies offers different type of SSL certificates. They have different type of interfaces for CSR signing and certificate generation. So we will outline process on your server-side only (which should remain common across all Ubuntu server)
<h3>OpenSSL Config File</h3>
<h4>Copy OpenSSL conf</h4>
By default, when you are are running OpenSSL commands, it is picking config from <code>/etc/ssl/openssl.cnf</code> file.

Unless you are configuring only one certificate on your server, it's better to copy OpenSSL config file to website's cert folder:
<pre class="bash">cp /etc/ssl/openssl.cnf /var/www/example.com/cert/example.com.cnf</pre>
<h4>Editing Config File</h4>
Open <code>/var/www/example.com/cert/example.com.cnf</code>

Look for  <code>[ req ]</code> section. Find add uncomment following line:
<pre class="no-highlight">req_extensions = v3_req</pre>
If you don't find a line like above, you can add one.

This will make sure our next section <code>[ v3_req ]</code> is read/used.

In <code>[ v3_req ]</code> section, add following line:
<pre class="no-highlight">subjectAltName = @alt_names</pre>
It will look like:
<pre class="no-highlight">[ v3_req ]

# Extensions to add to a certificate request

basicConstraints = CA:FALSE
keyUsage = nonRepudiation, digitalSignature, keyEncipherment
subjectAltName = @alt_names</pre>
Finally add a new section called <code>[ alt_names ]</code> towards end of file listing all domain variation you are planning to use.
<pre class="no-highlight">[ alt_names ]
DNS.1 = www.example.com
DNS.2 = example.com</pre>
<strong>Note:</strong> I couldn't  find out whether we need to add domain used in common-name field again here. So I added it again here. Now in common-field, we use <em>www.example.com</em> version - if SSL is for www and non-www versions of domains.

Now you have your OpenSSL config file ready.
<h3>OpenSSL Private Key &amp; CSR</h3>
Make sure you are currently working in cert folder for your site:
<pre>cd /var/www/example.com/cert/</pre>
<h4>Private Key</h4>
Run following command to generate private key. Do not use passphrase as nginx will use this private key.
<pre class="no-highlight">openssl genrsa -out example.com.key 2048</pre>
<h4>Certificate Signing Request - CSR generation</h4>
Next, we will generate CSR using private key above <strong>AND </strong>site-specific copy of OpenSSL config file.
<pre class="no-highlight">openssl req -new -key example.com.key -out example.com.csr -config example.com.cnf</pre>
Please note <code>-config</code> switch. If you forget it, your CSR won't include (Subject) Alternative (domain) Names.
<h4>Verify CSR</h4>
Since sending CSR and getting certificate is time consuming process, it's better to verify if CSR is generated correctly.

Run following command:
<pre class="no-highlight">openssl req -in example.com.csr -noout -text</pre>
You will see something like below in output. Please make sure you read highlighted area.
<pre class="no-highlight">Certificate Request:
    Data:
        Version: 0 (0x0)
        Subject: C=IN, ST=MH, L=PUNE, O=RTCAMP SOLUTIONS PRIVATE LIMITED., <strong>CN=www.example.com</strong>/emailAddress=admin@example.com
	[...]
            X509v3 Basic Constraints: 
                CA:FALSE
            X509v3 Key Usage: 
                Digital Signature, Non Repudiation, Key Encipherment
            X509v3 Subject Alternative Name: 
                <strong>DNS:www.example.com, DNS:example.com</strong>
	[...]</pre>
<h3>Submitting CSR and Requesting certificate</h3>
Once you have CSR, the process of submitting it is online and often coupled with extra steps depending of certificate provider.

You can refer to <a href="https://easyengine.io/wordpress-nginx/tutorials/ssl/godaddy/">GoDaddy workflow</a> and <a href="https://easyengine.io/wordpress-nginx/tutorials/ssl/thawte/">Thawte Workflow</a> here.

Also, when you get certificate from provider, you can verify if its correct by <a href="https://easyengine.io/tutorials/linux/openssl-match-private-key-cert-csr/">using this article</a>.