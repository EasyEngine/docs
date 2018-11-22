---
ID: 49054
post_title: 'Increase &#8220;Open Files Limit&#8221;'
author: Rahul Bansal
post_excerpt: >
  Increase per-user and system-wide open
  file limits under linux. Check open-file
  limits system-wide, for logged-in user,
  other user and for running process.
layout: page
permalink: >
  https://easyengine.io/tutorials/linux/increase-open-files-limit/
published: true
post_date: 2013-10-19 19:58:07
---
If you are getting error "Too many open files (24)" then your application/command/script is hitting max open file limit allowed by linux. You need to increase open file limit as below:
<h2>Increase limit</h2>
<h3>Per-User Limit</h3>
Open file: <code>/etc/security/limits.conf</code>

Paste following towards end:
<pre class="no-highlight">*         hard    nofile      500000
*         soft    nofile      500000
root      hard    nofile      500000
root      soft    nofile      500000</pre>
500000 is fair number. I am not sure what is max limit but 999999 (Six-9) worked for me once as far as I remember.

Once you save file, you may need to logout and login again.
<h4>pam-limits</h4>
I read at many places that an extra step is neede for limit to change for daemon processes. I did not need following yet, but if above changes are not working for you, you may give this a try.

Open <code>/etc/pam.d/common-session</code>

Add following line:
<pre class="no-highlight">session required pam_limits.so</pre>
<h3>System-Wide Limit</h3>
Set this higher than user-limit set above.

Open <code>/etc/sysctl.conf </code>

Add following:
<pre class="no-highlight">fs.file-max = 2097152</pre>
Run:
<pre class="no-highlight">sysctl -p</pre>
Above will increase "total" number of files that can remain open system-wide.
<h2>Verify New Limits</h2>
Use following command to see max limit of file descriptors:
<pre class="no-highlight">cat /proc/sys/fs/file-max</pre>
Hard Limit
<pre class="no-highlight">ulimit -Hn</pre>
Soft Limit
<pre class="no-highlight">ulimit -Sn</pre>
if you are logged in as root:
<h3>Check limit for other user</h3>
Just replace <code>www-data</code> by linux username you wish to check limits for:
<pre class="no-highlight">su - www-data -c 'ulimit -aHS' -s '/bin/bash'</pre>
<h3>Check limits of a running process:</h3>
Find process-id (PID):
<pre class="no-highlight">ps aux | grep process-name</pre>
Suppose, XXX is PID, then run following commands to check limits:
<pre class="no-highlight">cat /proc/XXX/limits</pre>