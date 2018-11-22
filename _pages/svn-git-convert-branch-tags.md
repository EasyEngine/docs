---
ID: 40489
post_title: 'Using svn2git to preserve tags &#038; branches'
author: Rahul Bansal
post_excerpt: >
  Converting from SVN to Git using svn2git
  tool. svn2git will convert all SVN
  branches to git branches, SVN tags to
  git tags and SVN trunk to git master.
layout: page
permalink: >
  https://easyengine.io/wordpress-nginx/tutorials/svn-git-convert-branch-tags/
published: true
post_date: 2012-07-02 15:31:52
---
Sometime back we moved from SVN to Git. We had 600 repos in SVN so it was a tedious work!

Below is the process we used to speed up things.
<h3>Convert SVN username to Git Equivalent</h3>
In our case, our SVN usernames were in format <code>firstname.lastname</code> and email addresses are in format <code>firstname.lastname@rtcamp.com</code>.

So we used a script from <a href="http://technicalpickles.com/posts/creating-a-svn-authorsfile-when-migrating-from-subversion-to-git/">here</a>.
<pre><code>#!/usr/bin/env bash 
authors=$(svn log -q http://path/to/root/of/project | grep -e '^r' | awk 'BEGIN { FS = "|" } ; { print $2 }' | sort | uniq) 
for author in ${authors}; do 
    echo "${author} = ${author} &lt;${author}@rtcamp.com&gt;"; 
done</code></pre>
We pasted output in a file at<code> ~/.svn2git/authors </code>

This authors file has line for every SVN user. Just open it once to make sure if it needs any correction.

<code>firstname.lastname = firstname.lastname &lt;firstname.lastname@rtcamp.com&gt; </code>
<h3>Install svn2git</h3>
If you do not have ruby/git then run first...

<code>sudo apt-get install git-core git-svn ruby rubygems</code>

Then...

<code>sudo gem install svn2git --source http://gemcutter.org</code>
<h2>Moving a SVN repo to Git (and GitHub)</h2>
<h4>Create a dir for svn-git conversion locally:</h4>
<code>mkdir /tmp/migration/ &amp;&amp; cd /tmp/migration/</code>
<h4>Run svn2git</h4>
Use a syntax like below. <code>&lt;URL&gt;</code> is your SVN repo URL.<code>svn2git</code> is optimised for conventional SVN layout which includes tags, trunk and branches. If you run it correctly, it will convert all SVN branches to git branches, SVN tags to git tags and SVN trunk to git master.

You can check <a href="https://github.com/nirvdrum/svn2git">svn2git github project</a> for more info.

<strong>When <em>tags</em>, <em>branches</em>, <em>trunk</em> - all 3 are present</strong>
<pre><code>svn2git &lt;URL&gt; --no-minimize-url --verbose</code></pre>
<strong>When <em>branches</em> is missing</strong>
<pre><code>svn2git &lt;URL&gt; --no-minimize-url --verbose --nobranches</code></pre>
<strong>When <em>tags</em> is missing</strong>
<pre><code>svn2git &lt;URL&gt; --no-minimize-url --verbose --notags</code></pre>
<strong>When <em>tags</em> &amp; <em>branches</em> both is missing</strong>
<pre><code>svn2git &lt;URL&gt; --no-minimize-url --verbose --notags --nobranches</code></pre>
<strong>When <em>tags</em>, <em>branches</em>, <em>trunk</em> - all 3 are missing</strong>
<pre><code>svn2git &lt;URL&gt; --no-minimize-url --verbose --rootistrunk</code></pre>
<div></div>