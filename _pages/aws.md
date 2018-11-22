---
ID: 131040
post_title: Install EasyEngine on AWS Instance
author: Dinesh Jain
post_excerpt: ""
layout: page
permalink: https://easyengine.io/docs/install/aws/
published: true
post_date: 2015-11-23 11:59:40
---
<a href="https://aws.amazon.com/">Sign up</a> For Amazon and Follow these steps
<ul>
	<li>Launch New Instance</li>
</ul>
Click on <em>Launch Instance</em> to start your amazon EC2 Instance Launch.

<img src="https://easyengine.io/wp-content/uploads/2014/10/Screenshot-from-2014-08-12-144256.png" alt="Launch Instance" />
<ul>
	<li>Select AMI (Linux Distribution Image your server will be Running on).Select <em>Ubuntu</em> or <em>Debian</em> Images as EasyEngine supports these only. <img src="https://easyengine.io/wp-content/uploads/2014/10/Screenshot-from-2014-08-12-190655.png" alt="Select AMI" /></li>
	<li>Select Instance TypeHere select instance type as per your website needs server configuration. Like RAM, Storage..etc <img src="https://easyengine.io/wp-content/uploads/2014/10/Screenshot-from-2014-08-12-190712.png" alt="Select Instance Type Droplet" /></li>
	<li>Configure Instance DetailsHere you should select <strong>Shutdown Behaviour</strong> as <strong>Stop</strong> Otherwise your instance will get terminated on shutdown/reboot. <img src="https://easyengine.io/wp-content/uploads/2014/10/Screenshot-from-2014-08-12-190908.png" alt="Configure Instance Details" /></li>
	<li>Add StorageHere Add Storage to your instance <img src="https://easyengine.io/wp-content/uploads/2014/10/Screenshot-from-2014-08-12-191842.png" alt="Add Storage" /></li>
	<li>Tag Your InstanceGive name to your instance<img src="https://easyengine.io/wp-content/uploads/2014/10/Screenshot-from-2014-08-12-191141.png" alt="Tag Instance" /></li>
	<li>Configure Security GroupHere you need to specify the ports you want to keep open<img src="https://easyengine.io/wp-content/uploads/2014/10/Selection_021.png" alt="Configure Security Group" /></li>
	<li>Review your New Instance Configuration<img src="https://easyengine.io/wp-content/uploads/2014/10/Screenshot-from-2014-08-12-1913031.png" alt="Review" /></li>
	<li>Click on launch instance and download the <em>PEM</em> Key given by AWS.</li>
	<li>Login To your serverUsing SSH you can login to your server in following way
<pre><code>  #Change permission of key file

  chmod 600 key.pem

  #Connect to instance

  ssh -i key.pem ubuntu@&lt;public-ip-of-ec2&gt;
</code></pre>
</li>
	<li>Next Step is to <a href="https://easyengine.io/docs/install/#quick-setup">Install EasyEngine</a> On your Fresh Droplet</li>
</ul>