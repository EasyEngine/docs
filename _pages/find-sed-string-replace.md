---
ID: 25101
post_title: >
  Using find and sed to replace strings in
  multiple files
author: Rahul Bansal
post_excerpt: 'Using "find" and "sed" linux commands to search & replace a string in multiple files at once'
layout: page
permalink: >
  https://easyengine.io/tutorials/linux/find-sed-string-replace/
published: true
post_date: 2010-04-23 11:15:20
---
This is self-explanatory!
<pre>find . -type f -exec sed -i 's/oldstr/newstr/g' {} ;</pre>
We used to replace '/wp-content/uploads' with '/files' while merging single wordpress-sites into a big multisite setup.
<pre>find . -type f -exec sed -i 's/\/wp-content\/uploads/\/files/g' {} ;</pre>
<a href="http://www.brunolinux.com/02-The_Terminal/Find_and%20Replace_with_Sed.html">For more details</a>