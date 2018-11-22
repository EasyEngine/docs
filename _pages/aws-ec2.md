---
ID: 74965
post_title: AWS EC2
author: Gaurav
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/docs/hosting/aws-ec2/
published: true
post_date: 2014-10-17 17:26:58
---
At first you need to create an account for <a href="https://aws.amazon.com/">Amazon WS. </a>After creation of account, choose your desired region from the right corner of AWS page for the creation of EC2 instance. After that navigate to Service and then EC2 to create a new instance as shown below.
<h2>Create a new Instance</h2>
As we have to create a new instance, click on "Launch Instance" button and then follow the steps mentioned below: <a href="https://easyengine.io/wp-content/uploads/2014/10/Screenshot-from-2014-08-12-144256.png"><img class="aligncenter wp-image-74982 size-full" src="https://easyengine.io/wp-content/uploads/2014/10/Screenshot-from-2014-08-12-144256.png" alt="a from 2014-08-12 14:42:56" width="791" height="469" /></a>
<h2></h2>
<h2>Step 1: Choose AMI</h2>
We are choosing Ubuntu 14.04 paravirtual (PV) SSD volume type AMI. You are also free to choose HVM AMI of Ubuntu 14.04. We are choosing PV because they are more stable and performance optimized. More difference between PV and HVM can be found on this <a href="http://palakonda.org/2012/10/30/aws-virtualization-hvm-vs-paravirtualization/">blog</a>. <a href="https://easyengine.io/wp-content/uploads/2014/10/Screenshot-from-2014-08-12-190655.png"><img class="aligncenter wp-image-74981 size-full" src="https://easyengine.io/wp-content/uploads/2014/10/Screenshot-from-2014-08-12-190655.png" alt="Screenshot from 2014-08-12 19:06:55" width="1265" height="513" /></a>
<h2></h2>
<h2>Step 2: Choose Instance Type</h2>
Here you can choose the instance type as per your need. <a href="https://easyengine.io/wp-content/uploads/2014/10/Screenshot-from-2014-08-12-190712.png"><img class="aligncenter wp-image-74980 size-full" src="https://easyengine.io/wp-content/uploads/2014/10/Screenshot-from-2014-08-12-190712.png" alt="Screenshot from 2014-08-12 19:07:12" width="1284" height="571" /></a>
<h2>Step 3: Configure Instance details</h2>
Don't forget to change shutdown behaviour of your instance to <strong>Stop</strong>. If you choose terminate then your instance is terminated after shutdown. Other options you can keep as it is.
<h2><a href="https://easyengine.io/wp-content/uploads/2014/10/Screenshot-from-2014-08-12-190908.png"><img class="aligncenter wp-image-74979 size-full" src="https://easyengine.io/wp-content/uploads/2014/10/Screenshot-from-2014-08-12-190908.png" alt="Screenshot from 2014-08-12 19:09:08" width="1279" height="576" /></a></h2>
<h2>Step 4: Add Storage</h2>
Add storage as per your needs.
<h2><a href="https://easyengine.io/wp-content/uploads/2014/10/Screenshot-from-2014-08-12-191842.png"><img class="aligncenter wp-image-74978 size-full" src="https://easyengine.io/wp-content/uploads/2014/10/Screenshot-from-2014-08-12-191842.png" alt="Screenshot from 2014-08-12 19:18:42" width="1290" height="565" /></a></h2>
<h2></h2>
<h2>Step 5: Tag instance</h2>
Give instance unique name, so that we can identify that easily.
<h2><a href="https://easyengine.io/wp-content/uploads/2014/10/Screenshot-from-2014-08-12-191141.png"><img class="aligncenter wp-image-74977 size-full" src="https://easyengine.io/wp-content/uploads/2014/10/Screenshot-from-2014-08-12-191141.png" alt="Screenshot from 2014-08-12 19:11:41" width="1277" height="584" /></a></h2>
<h2></h2>
<h2>Step 6: Configure Security Group</h2>
EasyEngine requires access for following ports.

<em>22: SSH </em>

<em>80/443:Default web </em>

<em>22222: EasyEngine admin tools port </em>

<em>Optional you can also enable ping request for server by enabling ICMP Echo request</em>
<h2><a href="https://easyengine.io/wp-content/uploads/2014/10/Selection_021.png"><img class="aligncenter wp-image-75115 size-full" src="https://easyengine.io/wp-content/uploads/2014/10/Selection_021.png" alt="Selection_021" width="1296" height="569" /></a></h2>
<h2>Step 7: Review</h2>
Review the final configuration and click on Launch. <a href="https://easyengine.io/wp-content/uploads/2014/10/Screenshot-from-2014-08-12-1913031.png"><img class="aligncenter wp-image-74991 size-full" src="https://easyengine.io/wp-content/uploads/2014/10/Screenshot-from-2014-08-12-1913031.png" alt="Screenshot from 2014-08-12 19:13:03" width="1286" height="567" /></a> After completing the above steps you need to download PEM key given by AWS. In near about 5mins your instance will be created and then note down the public IP of the server. Now, use following commands to connect instance:
<pre class="bash">#Change permission of key file
chmod 600 key.pem

#Connect to instance
ssh -i key.pem ubuntu@&lt;public-ip-of-ec2&gt;</pre>