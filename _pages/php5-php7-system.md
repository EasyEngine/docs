---
ID: 140907
post_title: Having php5 and php7 on same system.
author: Sushant Salil
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/php/php5-php7-system/
published: true
post_date: 2016-06-24 15:03:53
---
Many a time you will find more than one version of php installed on your system. Lately two of the most common versions are php5 and php7.

You may try <code>dpkg -l | grep php</code> to find detail on php packages installed.
You may find something like:

<code>rc php5-cli 5.6.18+dfsg-1+deb.sury.org~trusty</code>
<code>rc php5-common 5.6.18+dfsg-1+deb.sury.org~trusty</code>
<code>rc php5-curl 5.6.18+dfsg-1+deb.sury.org~trusty</code>
<code>rc php5-fpm 5.6.18+dfsg-1+deb.sury.org~trusty binary)</code>

Here on above <code>rc</code> means packages has been removed but not purged. Configuration files would be still there. You can remove configuration files also by purging php5 packages:

<code>apt-get purge {php5-package_name}</code>

Directory for php5 config is <code>/etc/php5</code>

Now apart from above packages, you may also find php5.6 and php7.0 packages like:
<code>ii php5.6-cli 5.6.22-4+deb.sury.org~trusty language</code>
<code>ii php5.6-common 5.6.22-4+deb.sury.org~trusty</code>
<code>ii php5.6-curl 5.6.22-4+deb.sury.org~trusty</code>
<code>ii php5.6-fpm</code>
<code>...</code>
<code>ii php7.0-cli 7.0.7-4+deb.sury.org~trusty language</code>
<code>ii php7.0-common 7.0.7-4+deb.sury.org~trusty</code>
<code>ii php7.0-curl 7.0.7-4+deb.sury.org~trusty</code>
<code>ii php7.0-fpm 7.0.7-4+deb.sury.org~trusty</code>

Here above <code>ii</code> means packages are installed on your system. Easyengine install php5.6 by default and that is used to run all the admin webtools. Installed php 5.6 and php 7.0 comes from same repository - <a href="https://launchpad.net/~ondrej/+archive/ubuntu/php" target="_blank">https://launchpad.net/~ondrej/+archive/ubuntu/php</a>

Recently php5.5 was also added on the same repo so you may find directory like <code>/etc/php/5.5</code>. But as it is not installed it is not needed and will not cause any harm.

If you want to remove php5.6, you can try <code>ee stack remove php</code> but that will break 22222 and any site using that version of php.

Therefore, we would suggest not to remove php5.6. If needed you can stop it's services using the command: <code>sudo service php5.6-fpm stop</code>