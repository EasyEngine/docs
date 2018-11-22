---
ID: 130726
post_title: Install
author: Dinesh Jain
post_excerpt: ""
layout: page
permalink: https://easyengine.io/docs/install/
published: true
post_date: 2015-11-21 13:33:58
---

	<h2 id="supported-distributions">Supported distributions</h2>
<ul>
<li>Ubuntu 12.04, 14.04 and 16.04</li>
<li>Debian 7 and 8</li>
</ul>
<h2 id="port-requirements">Port requirements</h2>
<ul>
<li>22/TCP (Inbound/Outbound) : Standard SSH port</li>
<li>80/TCP (Inbound/Outbound) : Standard HTTP port</li>
<li>443/TCP(Inbound/Outbound) : Standard HTTPS port</li>
<li>22222/TCP (Inbound) : To access EasyEngine admin tools</li>
<li>11371/TCP (Outbound) : To connect to GPG Key Server</li>
</ul>
<h2 id="launchdeploycreate-server-instance">Launch/Deploy/Create Server Instance</h2>
<p>Launch/Deploy/Create your server instance with your hosting provider</p>
<p>Follow these guide or skip to <strong>Quick Setup</strong> If you are already done.</p>
<ul>
<li><a href="https://easyengine.io/docs/install/aws/">AWS</a></li>
<li><a href="https://easyengine.io/docs/install/linode/">Linode</a></li>
<li><a href="https://easyengine.io/docs/install/digitalocean/">DigitalOcean</a></li>
</ul>
<h2 id="quick-setup">Quick Setup</h2>
<p><em>Here are the quick commands to setup EasyEngine on your server and making your site</em> <strong>Live</strong></p>
<ul>
<li>First command installs EasyEngine on your server.</li>
<li>Second command installs necessary stack and creates <em>Single WordPress Site</em> with domain example.com</li>
</ul>
<p>Just paste following commands in your shell</p>
<pre><code>wget -qO ee rt.cx/ee &amp;&amp; sudo bash ee     # install easyengine
sudo ee site create example.com --wp     # install wordpress on example.com
</code></pre>
<p><strong>To view your site in browser just point your domain to server.</strong></p>