---
ID: 94
post_title: 'Apache &#8211; Turn On/Off Directory Listing'
author: Radhe
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/turn-on-off-directory-listing/
published: true
post_date: 2010-05-13 13:54:36
---
If a client requests a URL that designates a directory and the directory does not contain a filename that matches the <a href="http://httpd.apache.org/docs/1.3/mod/mod_dir.html#directoryindex">DirectoryIndex</a> directive, then <a href="http://httpd.apache.org/docs/1.3/mod/mod_autoindex.html">mod_autoindex</a> can be configured to present a listing of the directory contents.
<h3>Turn on directory listing</h3>
To turn on automatic directory indexing, find the <a href="http://httpd.apache.org/docs/1.3/mod/core.html#options">Options</a> directive that applies to the directory and add the <code>Indexes</code> keyword.

For example:
<pre>&lt;Directory /path/to/directory&gt;
    Options +Indexes
&lt;/Directory&gt;</pre>
To turn off automatic directory indexing, remove the <code>Indexes</code> keyword from the appropriate <code>Options</code> line. To turn off directory listing for a particular subdirectory, you can use <code>Options -Indexes</code>.
<h3>Turn off directory listing</h3>
For example:
<pre>&lt;Directory /path/to/directory&gt;
    Options -Indexes
&lt;/Directory&gt;</pre>