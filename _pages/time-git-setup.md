---
ID: 3924
post_title: First time Git setup
author: Abhimanyu
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/git/time-git-setup/
published: true
post_date: 2012-03-22 15:59:48
---
We have been getting multiple requests from users across the globe to take rtPanel development to the next stage. However it takes a lot of time for a new version to be released on WordPress.org as the WordPress trac is always overloaded with multiple themes in queue.

To make the development more easier and contribution more accessible we have switched rtPanel on Git. Now users can easily access rtPanel codes, suggest improvements and contribute to the codes.

You can find a lot of explanation on Git and its commands on the web. One of the nice references we found was <a href="http://progit.org/book/" target="_blank">http://progit.org/book/</a>. Basically, in this article we will try covering up some most important Git commands that we would be using quite often. We would also be releasing this in parts as there is lots to mention and clarify about.
<h2>Installing the Git</h2>
Firstly, we need to install Git. As we are familiar with using Ubuntu, all we got to do is, open the terminal and type the following:
<pre>$ sudo apt-get install git-core git-gui git-doc</pre>
It's your call, if you want to get the Git docs as well. Else the git-core files would be just enough.
<h2>Setting up the SSH key on our system</h2>
Now, we need to generate a SSH key for your system. It's as easy as opening a terminal and typing '<strong>ssh-keygen</strong>' and then pressing enter. Follow the further instructions and you get the SSH key generated under the <strong>.ssh/id_rsa.pub</strong> file. No worries, the full path of the file shows up as soon as the SSH key gets generated.
<h2>Add your SSH key to GitHub</h2>
The next step is to paste the generated SSH key to the corresponding textarea on the Git profile page. So, proceeding step-wise,
<ol>
	<li>Open the generated <strong>id_rsa.pub</strong> file on your system and copy all of its content.</li>
	<li>Login to Git.</li>
	<li>Go to your <strong>profile update</strong> page. You can see the textarea for <strong>'Add a public key'</strong>.</li>
	<li>Paste the content you copied in <strong>Step 1</strong> to the textarea you focussed in <strong>Step 3</strong></li>
	<li>Click on '<strong>Update your account</strong>' button and done!</li>
</ol>
<h2>Setting up the user info</h2>
Next, we need to enter the user details. Most importantly the username and the email. It has a significance though, as to why they are the most important.  If there are 20 people involved on a single project, all the changes done by each of them are intimidated to all the people involved on that project. So we get a clear notification if a certain user has made certain changes to some file. Now, to update the username and the email, type the following in the terminal window:
<pre>git config --global user.name "your name here"
git config --global user.email abc@test.com</pre>
We can check the status anytime by typing:
<pre>git config --list</pre>
So, we are done with all the minimal configuration needed to start committing and pushing your codes. Also do remember, this is a one time setup and doesn't need to done everytime we start with a new project.