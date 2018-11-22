---
ID: 3925
post_title: Mandatory stages in Git
author: Abhimanyu
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/git/mandatory-stages-git/
published: true
post_date: 2012-03-20 13:25:39
---
We have already seen how to setup Git in the previous post. So next, we <em>move on to our current project directory</em> in terminal and initiate the Git, which in simple word means that we are starting to track the current project files. After moving on the working project directory, the following needs to be done:
<h2>Initiating Git</h2>
<pre>git init</pre>
This adds up the hidden <strong>.git</strong> directory in the project folder, that would be used to track all the changes in the current project directory. This is done only once for a particular project. Until this, the project files were, what we call, <strong>untracked</strong>. The list of untracked files can be checked out by typing the following:
<pre>git status</pre>
<h3>Tracking new and modified files</h3>
To start tracking a single modified file, type the following in the terminal window as:
<pre>git add filename</pre>
To track all the files in the project directory at a single instance, particularly when starting with a new project, type the following:
<pre>git add .</pre>
So now we can say that all the <em>new as well as the modified files</em> are being <strong>tracked</strong> and are <strong>staged</strong>. The files are now queued to be further committed. Note that, for every further modification that is done to the individual file, the change has to be staged again using <strong>git add </strong>before committing.
<h2>Viewing Your Staged and Unstaged Changes</h2>
After the git add, the staged files are ready to be committed. We can check for the changes as:
<pre>//to list out the untracked and modified files
git status

//to check the difference between the modified files and staged files
git diff

//to check what staged changes are going to be committed
git diff --cached</pre>
<h2>Committing the changes</h2>
Committing the change simply records the snapshot of what has been staged previously. To commit the code, all you need to do is:
<pre>git commit -am "your custom text"</pre>
This records all the changes in the form of the snapshot and even the further modifications are detected using these snapshots.
<h2>Adding shortname for the remote repository</h2>
This step is also needed only once for a particular project. What we do here is add an alias or simply assign a shortname to the current project Git repository URL. For example:
<pre>git remote add sn git@code.rtcamp.com:example-project.git</pre>
That means that from now on, we can <em>push</em>,<em> pull</em>,<em> fetch</em> or do anything using just '<strong>sn</strong>' in place of the complete Git repository URL. To get further details on git remote, just type the following:
<pre>git remote -v</pre>
This lists out all the shortnames assigned to the project Git Repo URL .
<h2>Pushing the committed code to Git Repository</h2>
Pushing the committed code to the remote Git repository is the final step in the process. By default, master branch is already present whenever a new project Git repository is created. So all we got to do is:
<pre>git push [shortname] master</pre>
For instance:
<pre>git push <strong>sn</strong> master</pre>
So, for all the subsequent changes, make sure to <strong>add, commit and push</strong>. Note that the <em>shortname has to be added only once for a particular project</em>. In the upcoming post, we will be discussing about <strong><em>Forking</em></strong> involving <em>git checkout</em>, <em>git clone</em>, <em>git fetch</em>, <em>git merge</em> and many more, considering that there are several people involved in a single project, who make their contribution and push back the changes to the respective branches.