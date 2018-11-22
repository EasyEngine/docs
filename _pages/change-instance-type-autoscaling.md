---
ID: 56970
post_title: Change Instance Type in AutoScaling
author: Faishal Saiyed
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/amazon-aws/change-instance-type-autoscaling/
published: true
post_date: 2014-02-06 20:17:13
---
AWS does not allow to edit launch configuration. If you notice, we define instance type at time of launch configuration. So if you want to change instance type in Auto Scaling group than you need to <a href="https://easyengine.io/tutorials/amazon-aws/auto-scaling/#2-create-launch-configuration" target="_blank">create new launch configuration</a> for that.

Following are the step to edit AutoScaling group.

[caption id="attachment_56971" align="aligncenter" width="460"]<a href="https://easyengine.io/wp-content/uploads/2014/02/change-autoscaling-group-instance-type-18.png"><img class="size-medium wp-image-56971" title="Change AutoScaling Group Instance Type" alt="change-autoscaling-group-instance-type-18" src="https://easyengine.io/wp-content/uploads/2014/02/change-autoscaling-group-instance-type-18-460x240.png" width="460" height="240" /></a> Change AutoScaling Group Instance Type[/caption]

Note: This does not apply to running instances in this group, To apply it on running instance please terminate old instance. New instance will be create as per defined in launch configuration.

&nbsp;