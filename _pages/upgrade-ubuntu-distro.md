---
ID: 40485
post_title: Upgrade Ubuntu 10.04 to 12.04
author: Rahul Bansal
post_excerpt: >
  Upgrade Ubuntu 10.04 to 12.04 on remote
  server using screen session
layout: page
permalink: >
  https://easyengine.io/tutorials/linux/upgrade-ubuntu-distro/
published: true
post_date: 2013-10-19 18:35:51
---
Following is guide to upgrade from Ubuntu 10.04 LTS to Ubuntu 12.04 LTS.

Make sure you are running a <a href="https://easyengine.io/tutorials/linux/screen/">screen session</a> before continuing.
<h3>Prepare</h3>
Update &amp; upgrade all packages
<pre class="no-highlight">apt-get update
apt-get upgrade</pre>
Install update-manager-core package:
<pre class="no-highlight">apt-get install update-manager-core</pre>
<h3>Upgrade distro itself</h3>
You are now ready to upgrade to Ubuntu 12.04 LTS.

Open the release-upgrades file for editing by entering the following command:
<pre class="no-highlight">vim /etc/update-manager/release-upgrades</pre>
Verify that the following line is present in the file, and that Prompt is set to lts:
<pre class="no-highlight">Prompt=lts</pre>
Start a screen session:
<pre class="no-highlight">screen -S distro</pre>
Upgrade your Linode to Ubuntu 12.04 LTS by entering the following command:
<pre class="no-highlight">do-release-upgrade -d</pre>
Follow the on-screen instructions to complete the installation process.

When the upgrade process completes, verify that it's running Ubuntu 12.04 LTS by entering the following command
<pre class="no-highlight">cat /etc/lsb-release</pre>
You should see output that resembles the following:
<pre class="no-highlight">DISTRIB_ID=Ubuntu
DISTRIB_RELEASE=12.04
DISTRIB_CODENAME=precise
DISTRIB_DESCRIPTION="Ubuntu 12.04"</pre>