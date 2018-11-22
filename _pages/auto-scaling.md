---
ID: 56930
post_title: Auto Scaling
author: Faishal Saiyed
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/amazon-aws/auto-scaling/
published: true
post_date: 2014-02-06 17:36:30
---
AutoScaling allow you to automatically add or remove your EC2 instances according to your defined condition. To setup autoscaling we create autoscaling group and defined launch configuration for that group so, whenever any instance added in to group it will use that launch configuration .

<span style="font-family: inherit; font-size: inherit; font-weight: inherit; line-height: 1.75;">Following are the step to setup auto scaling on AWS</span>
<h2>1. Create AMI of EC2 instance</h2>
AMI (Amazon Machine Image) is used while new instance is created automatically. We define unique AMI id (e.g ami-xxxxxxxx) in launch configuration.

Following is the first step to create AMI (there is alternative option also).

[caption id="attachment_56954" align="aligncenter" width="460"]<a href="https://easyengine.io/wp-content/uploads/2014/02/create-aim-1.png"><img class="size-medium wp-image-56954" title="Create AMI Step 1" alt="create-aim-1" src="https://easyengine.io/wp-content/uploads/2014/02/create-aim-1-460x301.png" width="460" height="301" /></a> First step to create AMI[/caption]

In next step it will ask for Image Name, description and other options. Please use help for more info.

[caption id="attachment_56953" align="aligncenter" width="460"]<img class="size-medium wp-image-56953" style="line-height: 1.75rem;" title="Create AMI Step 2" alt="create-aim-2" src="https://easyengine.io/wp-content/uploads/2014/02/create-aim-21-460x236.png" width="460" height="236" /> Final step to create AMI[/caption]
<p style="text-align: left;">After clicking Create Image button, It will start create image process and give you unique AMI id something like ami-xxxxxxxx that will required in create launch configuration. It will take time to create image depend on the size of your EBS.</p>

<h2>2. Create launch configuration</h2>
This is the required step to setup autoscaling. As name state, Launch configuration is used when any instance is added to autoscaling group. There are some required field like launch-configuration-name, image-id, instance-type, key, security-groups.

Lets create launch configuration.
<h3>Step 1 : Go to Launch Config Page and Start Create Launch configuration</h3>
[caption id="attachment_56959" align="aligncenter" width="460"]<a href="https://easyengine.io/wp-content/uploads/2014/02/create-new-launch-configuration-1.png"><img class=" wp-image-56959 " title="Step 1 : Go to Launch Config Page" alt="create-new-launch-configuration-1" src="https://easyengine.io/wp-content/uploads/2014/02/create-new-launch-configuration-1-460x296.png" width="460" height="296" /></a> Step 1 : Go to Launch Config Page and Start Create Launch configuration[/caption]
<h3>Step 2 : Select AMI</h3>
[caption id="attachment_56960" align="aligncenter" width="460"]<a href="https://easyengine.io/wp-content/uploads/2014/02/create-new-launch-configuration-2.png"><img class="size-medium wp-image-56960 " title="Step 2 : Select  AMI " alt="create-new-launch-configuration-2" src="https://easyengine.io/wp-content/uploads/2014/02/create-new-launch-configuration-2-460x222.png" width="460" height="222" /></a> Step 2 : Select AMI[/caption]

OR you select existing EMI if you are already created

[caption id="attachment_56961" align="aligncenter" width="460"]<a href="https://easyengine.io/wp-content/uploads/2014/02/create-new-launch-configuration-3.png"><img class="size-medium wp-image-56961 " title="Step 2 : Choose Existing AMI" alt="create-new-launch-configuration-3" src="https://easyengine.io/wp-content/uploads/2014/02/create-new-launch-configuration-3-460x224.png" width="460" height="224" /></a> Step 2 : Choose Existing AMI[/caption]
<h3>Step 3 : Choose Instance Type</h3>
[caption id="attachment_56962" align="aligncenter" width="460"]<a href="https://easyengine.io/wp-content/uploads/2014/02/create-new-launch-configuration-4.png"><img class="size-medium wp-image-56962 " title="Step 3:  Choose Instance Type" alt="create-new-launch-configuration-4" src="https://easyengine.io/wp-content/uploads/2014/02/create-new-launch-configuration-4-460x223.png" width="460" height="223" /></a> Step 3: Choose Instance Type[/caption]
<h3>Step 4 : Name launch configuration &amp; other info</h3>
[caption id="attachment_56963" align="aligncenter" width="460"]<a href="https://easyengine.io/wp-content/uploads/2014/02/create-new-launch-configuration-5.png"><img class="size-medium wp-image-56963 " title="Step 4: Name launch configuration &amp; other info" alt="create-new-launch-configuration-5" src="https://easyengine.io/wp-content/uploads/2014/02/create-new-launch-configuration-5-460x223.png" width="460" height="223" /></a> Step 4: Name launch configuration &amp; other info[/caption]
<h3>Step 5 : Choose Storage</h3>
[caption id="attachment_56964" align="aligncenter" width="460"]<a href="https://easyengine.io/wp-content/uploads/2014/02/create-new-launch-configuration-6.png"><img class="size-medium wp-image-56964 " title="Step 5: Choose Storage" alt="create-new-launch-configuration-6" src="https://easyengine.io/wp-content/uploads/2014/02/create-new-launch-configuration-6-460x223.png" width="460" height="223" /></a> Step 5: Choose Storage[/caption]
<h3>Step 6 : Choose Security Group</h3>
[caption id="attachment_56965" align="aligncenter" width="460"]<a href="https://easyengine.io/wp-content/uploads/2014/02/create-new-launch-configuration-7.png"><img class="size-medium wp-image-56965 " title="Step 6: Choose Security Group" alt="create-new-launch-configuration-7" src="https://easyengine.io/wp-content/uploads/2014/02/create-new-launch-configuration-7-460x224.png" width="460" height="224" /></a> Step 6: Choose Security Group[/caption]
<h3>Step 7 : Review</h3>
[caption id="attachment_56966" align="aligncenter" width="460"]<a href="https://easyengine.io/wp-content/uploads/2014/02/create-new-launch-configuration-8.png"><img class="size-medium wp-image-56966 " title="Step 7: Review" alt="create-new-launch-configuration-8" src="https://easyengine.io/wp-content/uploads/2014/02/create-new-launch-configuration-8-460x224.png" width="460" height="224" /></a> Step 7: Review[/caption]
<h3>Step 8 : Choose Key pair</h3>
[caption id="attachment_56967" align="aligncenter" width="460"]<a href="https://easyengine.io/wp-content/uploads/2014/02/create-new-launch-configuration-9.png"><img class="size-medium wp-image-56967 " title="Step 8: Choose Key pair" alt="create-new-launch-configuration-9" src="https://easyengine.io/wp-content/uploads/2014/02/create-new-launch-configuration-9-460x267.png" width="460" height="267" /></a> Step 8: Choose Key pair[/caption]

If you are use cli then type following command to create launch config

<code>aws autoscaling create-launch-configuration --launch-configuration-name aws-as-conf --image-id ami-xxxxxxxx --instance-type m1.large --key myPrivate --security-groups mySecurityGroup</code>

To List all launch configuration

<code>aws autoscaling describe-launch-configurations</code>
<h2>3. Create Autoscaling Group</h2>
Autoscaling group use launch configuration to create instance and add it into group. There are some require parameters like availability-zones, min/max-size, load-balancer-names, health-check-type etc

@TODO : UI Steps

<span style="font-family: inherit; font-size: inherit; font-weight: inherit; line-height: 1.75;">If you are use cli then type following command to</span><span style="font-family: inherit; font-size: inherit; font-weight: inherit; line-height: 1.75;"> </span>

<code>aws autoscaling create-auto-scaling-group --auto-scaling-group-name test-autoscal-group --launch-configuration aws-as-conf --availability-zones us-east-1a us-east-1b --min-size 1 --max-size 5 --load-balancer-names test-lb --health-check-type ELB --health-check-grace-period 300 --tag "k=Name, v=Test AS, p=true"</code>

Add instance policy :

<code>aws autoscaling put-scaling-policy --auto-scaling-group-name test-autoscal-group --policy-name test-as-add-one --scaling-adjustment 1 --adjustment-type ChangeInCapacity</code>

<span style="font-family: inherit; font-size: inherit; font-weight: inherit; line-height: 1.75;">Remove instance policy :</span>

<code>aws autoscaling put-scaling-policy --auto-scaling-group-name test-autoscal-group --policy-name test-as-remove-one --scaling-adjustment -1 --adjustment-type ChangeInCapacity</code>

<span style="font-family: inherit;"><span style="font-weight: inherit; line-height: 1.75;">Creating Cloud watch </span></span>alarms<span style="font-family: inherit;"><span style="font-weight: inherit; line-height: 1.75;"> from UI</span></span>

@TODO: UI steps

&nbsp;