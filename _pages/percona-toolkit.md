---
ID: 40138
post_title: Installing Percona Toolkit
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/mysql/percona-toolkit/
published: true
post_date: 2013-06-17 16:39:56
---
Percona maintains Ubuntu repos for their products. Below is process to install it quickly.

<strong>Add GPG Key</strong>
<pre>gpg --keyserver  hkp://keys.gnupg.net --recv-keys 1C4CBDCDCD2EFD2A
gpg -a --export CD2EFD2A | sudo apt-key add -</pre>
<strong>Add Repos</strong>
<pre>echo "deb http://repo.percona.com/apt `lsb_release -cs` main" &gt;&gt; /etc/apt/sources.list.d/percona.list
echo "deb-src http://repo.percona.com/apt `lsb_release -cs` main" &gt;&gt; /etc/apt/sources.list.d/percona.list</pre>
<strong>Update</strong>
<pre>apt-get update</pre>
<strong>Install</strong>
<pre>apt-get install percona-toolkit</pre>
You can install percona server also at this point as it is part of package. We haven't tried it yet, so it will be wise to not write anything about it.