---
ID: 63752
post_title: 'fdupes &#8211; find &#038; replace duplicate files with hardlinks'
author: Rahul Bansal
post_excerpt: >
  Find and replace duplicate files with
  hardlinks using fdupes tool. Instruction
  for installing latest fdupes.
layout: page
permalink: >
  https://easyengine.io/tutorials/linux/fdupes-duplicate-hardlinks/
published: true
post_date: 2014-04-11 23:40:54
---
<h2>Warning!</h2>
If you do not know how hardlink works, do not follow this tutorial.

We use this method when duplicate files are kind of "read-only". Because if you replace 2 duplicate files with hardlink pointing to common storage, editing one will change others content. If this is fine, then you can go ahead.

Don't worry about deletion. Deleting one file won't delete other file.
<h2>Install fdupes 1.51</h2>
Ubutnu 12.04 has repo has older version. So follow this:
<pre class="no-highlight">git clone https://github.com/tobiasschulz/fdupes
cd fdupes
make fdupes
su root
make install</pre>
<h2>Usage</h2>
Find duplicate files...
<pre class="no-highlight">fdupes -r /path/to/dir</pre>
Find duplicate files and replace with hardlinks
<pre class="no-highlight">fdupes -rL /path/to/dir</pre>
Note <code>-L</code> option which is responsible for replacing duplicate with hardlinks.