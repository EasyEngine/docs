---
ID: 62445
post_title: >
  Using openssl to match private key,
  cerificate and CSR
author: Rahul Bansal
post_excerpt: >
  Using openssl commands and md5 hash to
  verify private key used to generate csr
  and matching certificate.
layout: page
permalink: >
  https://easyengine.io/tutorials/linux/openssl-match-private-key-cert-csr/
published: true
post_date: 2014-03-22 00:34:18
---
In a recent migration we came across a complete messed up server where SSL related keys, certificates and CSR are scattered all over.

We ran following openssl commands to match these three:
<pre class="no-highlight">openssl <strong>req</strong> -noout -modulus -in  <strong>server.csr</strong> | openssl md5
(stdin)= 395cb6f3a0def959d81f8f6a26d12749

openssl <strong>rsa</strong> -noout -modulus -in <strong>myserver.key</strong> | openssl md5
(stdin)= 395cb6f3a0def959d81f8f6a26d12749

openssl <strong>x509</strong> -noout -modulus -in <strong>ssl-bundle.crt</strong> | openssl md5
(stdin)= 395cb6f3a0def959d81f8f6a26d12749</pre>
As you can see matching md5 indicated above triplet is a valid combo!

Make sure you use correct csr, key and crt file with respective openssl arguments.

<strong>Related:</strong> You may like <a href="http://www.madboa.com/geek/openssl/">this page about openssl commands</a>.