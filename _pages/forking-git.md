---
ID: 2162
post_title: Forking the Git
author: Abhimanyu
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/git/forking-git/
published: true
post_date: 2012-04-11 15:07:01
---
We have gone through all the mandatory steps needed, if a complete project is handled by a single user. What if there are 20 different people making their contributions and want to merge them into an existing remote branch. All that's needed to be done is cloning the repository, which makes all of the repository content available at the contributor's end. It might be done as:
<pre>git clone repo_url</pre>
For example:
<pre>git clone git@github.com:rtCamp/rtpanel.git</pre>
We can now say that the contributor has now successfully forked the repo. <em><strong>Forking</strong> the repo is nothing but cloning the repo</em>. Also the shortname <em>'<strong>origin</strong>'</em> is automatically assigned to the forked repo. After the contributor finishes with making the changes for the day, all he needs to do is push back the changes to the remote as:
<pre>git push origin master</pre>
Fine, now weeks later, the same contributor plans to add some further validations to the code. He now needs to pull the updated code on the remote master.<em><strong> Git pull</strong></em> command fetches the updated code on the remote branch you previously cloned from, to the local branch and merge the changes. To do so, open the terminal, move to the respective project directory and type the following:
<pre>git pull</pre>
<em>Git pull is used as a magic command that combines <strong>git fetch</strong> and <strong>git merge</strong></em>, though it's preferred to use them separately instead of using the single <em>git pull</em> command as you can check what you have fetched before merging the changes.

When we clone or fork a repository, the command automatically adds that remote repository under the name '<em>origin</em>'. So, alternatively we can use:
<pre>git fetch origin</pre>
Git fetch doesn't alter the local working tree until merged. The first command <em>fetches any new work that has been pushed to that server since last cloned or last fetched</em>. Making sure that we are working on master, we can take a look at the differences between the local branch and the remote one by:
<pre>git checkout master
git diff master origin</pre>
So looking at the changes, we can now merge it as:
<pre>git merge origin</pre>
I hope this was quite a helpful and simpler approach to getting familiar with Git.