---
ID: 66549
post_title: >
  Amazon ELB and multi-domain SAN/SSL
  Setup
author: Rahul Bansal
post_excerpt: >
  Setting up multi-domain SSL using
  Subject Alt Name (SAN) on Amazon Elastic
  Load Balancer from browser-based AWS
  console.
layout: page
permalink: >
  https://easyengine.io/tutorials/amazon-aws/elb-multi-domain-ssl-san/
published: true
post_date: 2014-06-13 17:44:03
---
We will use a machine where OpenSSL is already installed. This can be your one of EC2 instance or local machine.

Following is carried out on Ubuntu.
<h2>Install OpenSSL</h2>
Just run following command:
<pre class="no-highlight">apt-get install openssl</pre>
<h2>OpenSSL Config File</h2>
<h3>Copy OpenSSL config file</h3>
Create a temporary folder:
<pre class="no-highlight">cd ~ &amp;&amp; mkdir elbssl &amp;&amp; cd elbssl</pre>
Create a copy of OpenSSL config file in above dir
<pre class="bash">cp /etc/ssl/openssl.cnf elbssl.cnf</pre>
<h4>Editing Config File</h4>
Open <code>elbssl.cnf</code> and look for  <code>[ req ]</code> section.

Find add uncomment following line:
<pre class="no-highlight">req_extensions = v3_req</pre>
If you don't find a line like above, you can add one.

This will make sure our next section <code>[ v3_req ]</code> is read/used.

In <code>[ v3_req ]</code> section, add following line:
<pre class="no-highlight">subjectAltName = @alt_names</pre>
It will look like:
<pre class="no-highlight">[ v3_req ]

# Extensions to add to a certificate request

basicConstraints = CA:FALSE
keyUsage = nonRepudiation, digitalSignature, keyEncipherment
subjectAltName = @alt_names</pre>
Finally add a new section called <code>[ alt_names ]</code> towards end of file listing all domain variation you are planning to use.
<pre class="no-highlight">[ alt_names ]
DNS.1 = www.example.com
DNS.2 = example.com</pre>
<strong>Note:</strong> I couldn't  find out whether we need to add domain used in common-name field again here. So I added it again here. Now in common-field, we use <em>www.example.com</em> version - if SSL is for www and non-www versions of domains.

Now you have your OpenSSL config file ready.
<h2>OpenSSL Private Key &amp; CSR</h2>
<h3>Private Key</h3>
Run following command to generate private key. Do not use passphrase as nginx will use this private key.
<pre class="no-highlight">openssl genrsa -out example.com.key 2048</pre>
<h4>Certificate Signing Request - CSR generation</h4>
Next, we will generate CSR using private key above <strong>AND </strong>site-specific copy of OpenSSL config file.
<pre class="no-highlight">openssl req -new -key example.com.key -out example.com.csr -config elbssl.cnf</pre>
Please note <code>-config</code> switch. If you forget it, your CSR won't include (Subject) Alternative (domain) Names.
<h2>Verify CSR</h2>
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
<h2>Submitting CSR and Requesting certificate</h2>
Once you have CSR, the process of submitting it is online and often coupled with extra steps depending of certificate provider.

You can refer to <a href="https://easyengine.io/wordpress-nginx/tutorials/ssl/godaddy/">GoDaddy workflow</a> and <a href="https://easyengine.io/wordpress-nginx/tutorials/ssl/thawte/">Thawte Workflow</a> here.

Also, when you get certificate from provider, you can verify if its correct by <a href="https://easyengine.io/tutorials/linux/openssl-match-private-key-cert-csr/">using this article</a>.
<h2>Uploading Certificate to Amazon ELB</h2>
You may need to convert Private Key, Certificate and bundle/intermediate-certificate in PEM format before uploading them to Amazon ELB.

Please refer to "Upload the Signed Certificate" section in - <a href="http://docs.aws.amazon.com/ElasticLoadBalancing/latest/DeveloperGuide/ssl-server-cert.html">http://docs.aws.amazon.com/ElasticLoadBalancing/latest/DeveloperGuide/ssl-server-cert.html</a>
<h3>Uploading Interface</h3>
<a href="https://easyengine.io/wp-content/uploads/2014/06/AWS-load-balancer-HTTPS.png"><img class="alignnone size-large wp-image-66552" src="https://easyengine.io/wp-content/uploads/2014/06/AWS-load-balancer-HTTPS-720x369.png" alt="AWS-load-balancer-HTTPS" width="620" height="317" /></a>

&nbsp;

Check Listener Tab on load-balancer page. Click upload/change and you will see a box like below:

<a href="https://easyengine.io/wp-content/uploads/2014/06/AWS-Certificate-Upload.png"><img class="alignnone size-large wp-image-66553" src="https://easyengine.io/wp-content/uploads/2014/06/AWS-Certificate-Upload-720x476.png" alt="AWS-Certificate-Upload" width="620" height="409" /></a>

&nbsp;

As you can see, there are 3 fields to paste Private Key, Public Certificate and intermediate bundle.

Make sure you verify SSL certificate for all domains after saving. May be using - <a href="https://www.ssllabs.com/ssltest/index.html">https://www.ssllabs.com/ssltest/</a>

&nbsp;

&nbsp;