---
ID: 63504
post_title: >
  search replace in multiple files useing
  grep xargs sed
author: Rahul Bansal
post_excerpt: >
  Search and replace text in multiple
  files using grep, xargs and sed commands
layout: page
permalink: >
  https://easyengine.io/tutorials/linux/search-replace-text-multiple-files/
published: true
post_date: 2014-04-09 01:08:51
---
On many occasions we need to search and replace some text across multiple files on server. We use combination of grep, sed and xargs to achieve it mostly.

We will explain commands with examples:
<h2>Search and replace URLs in PHP files</h2>
We came across a poorly coded PHP site which was using many 4 different versions for domain names:
<ol>
	<li>http://example.com - without www and http</li>
	<li>http://www.example.com - with www and http</li>
	<li>https://example.com - without www and https</li>
	<li>https://www.example.com - with www and https</li>
</ol>
Final destination was: https://www.example.com (with https and www). We setup necessary redirects on nginx side to be safe but we also decided to replace variant 1 to 3 with final variant no. 4.
<h3>Commands</h3>
<h4>Search files with matching URLs</h4>
<pre class="no-highlight">grep -lr --include=*.php "http://example.com" /var/www/example.com/htdocs
grep -lr --include=*.php "http://www.example.com" /var/www/example.com/htdocs
grep -lr --include=*.php "https://example.com" /var/www/example.com/htdocs
grep -lr --include=*.php "https://www.example.com" /var/www/example.com/htdocs</pre>
<h4>Replace files with new URL</h4>
For variant 1 to 3... Following will replace file content without backup!
<pre class="no-highlight">grep -lr --include=*.php "http://example.com" /var/www/example.com/htdocs | xargs sed -i -e 's/http:\/\/example.com/https:\/\/www.example.com/g'
grep -lr --include=*.php "http://www.example.com" /var/www/example.com/htdocs | xargs sed -i -e 's/http:\/\/www.example.com/https:\/\/www.example.com/g'
grep -lr --include=*.php "https://example.com" /var/www/example.com/htdocs | xargs sed -i -e 's/https:\/\/www.example.com/https:\/\/www.example.com/g'</pre>
Pass an extension next to -i to create backup. For example:
<pre>grep -lr --include=*.php "http://example.com" /var/www/example.com/htdocs | xargs sed -i .bak -e 's/http:\/\/example.com/https:\/\/www.example.com/g'</pre>
<h2>Changing git-remote in multiple repos</h2>
We recently shifted our git repos to another server. Below commands came in handy!

Find all config files with old remote:
<pre class="no-highlight">grep -lr --include=config "@rtcamp.com" .</pre>
Replace with new remote:
<pre class="no-highlight">grep -lr --include=config "@rtcamp.com" . | xargs sed -i -e 's/@rtcamp.com/@ac.rtcamp.com/g'</pre>
You may want to search again to make sure if all files with old remotes are replaced.
<h2>Problems with xargs? Try parallel</h2>
On Ubuntu:
<pre class="no-highlight">apt-get install moreutils</pre>
On Mac:
<pre class="no-highlight">brew install parallel</pre>
Just replace word <code>xargs</code> with <code>parallel</code> in commands.