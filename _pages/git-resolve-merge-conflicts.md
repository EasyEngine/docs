---
ID: 41723
post_title: 'Git &#8211; Resolve Merge Conflicts'
author: Rahul Bansal
post_excerpt: >
  Most of the time, when you end up with
  conflicts, solution is to either use
  local copy or remote copy of conflicting
  file.
layout: page
permalink: >
  https://easyengine.io/tutorials/git/git-resolve-merge-conflicts/
published: true
post_date: 2013-07-02 15:44:40
---
Many time, when we do git push/pull or git merge, we end up with conflicts.

In most cases, solution to merge-conflict is as simple as discarding local changes or remote/other branch changes.

Following is useful in those cases...
<h2>Resolving merge conflicts</h2>
<h3>Find files with merge conflict</h3>
Change working directory to project folder.
<pre class="no-highlight">cd project-folder</pre>
Search for all conflicting files.
<pre class="no-highlight">grep -lr '&lt;&lt;&lt;&lt;&lt;&lt;&lt;' .</pre>
Above will list all files which has marker special marker <code>&lt;&lt;&lt;&lt;&lt;&lt;&lt;</code> in them.
<h3>Resolve easy/obvious conflicts</h3>
At this point you may review each files. If solution is to accept local/our version, run:
<pre class="no-highlight">git checkout --ours PATH/FILE</pre>
If solution is to accept remote/other-branch version, run:
<pre>git checkout --theirs PATH/FILE</pre>
If you have multiple files and you want to accept local/our version, run:
<pre class="no-highlight">grep -lr '&lt;&lt;&lt;&lt;&lt;&lt;&lt;' . | xargs git checkout --ours</pre>
If you have multiple files and you want to accept remote/other-branch version, run:
<pre>grep -lr '&lt;&lt;&lt;&lt;&lt;&lt;&lt;' . | xargs git checkout --theirs</pre>
<h3>For complex conflicts</h3>
For files that needs manual review/edit, use vim or any text editor to resolve differences.

Make sure you run <code>git add FILENAME</code> for files edited using vim.

Finally, review if all files are ready for commit using  <code>git status</code>

And run <code>git commit -am "MSG"</code> followed by optional <code>git push</code>