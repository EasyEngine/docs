---
ID: 49152
post_title: Screen
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/linux/screen/
published: true
post_date: 2013-10-19 18:29:03
---
Screen is a small linux utility which can help you run long-running jobs in remote shell without worrying about loosing network connection.

Once a process is started inside screen session, if your network connection breaks or you choose to close terminal (without exit), you can resume into that screen session anytime from anywhere.
<h3>Install screen</h3>
<pre class="no-highlight">apt-get install screen</pre>
<h2>Screen Commands</h2>
<h3>Create a screen</h3>
You can specify a <code>name</code>
<pre class="no-highlight">screen -S name</pre>
Or even create screen without name
<pre class="no-highlight">screen</pre>
<h3>Detach a screen</h3>
Never use "exit" inside screen. It will end "screen" session.

You keyboard shortcut <span class="code-key">CTRL</span>+<span class="code-key">A</span>+<span class="code-key">D</span>
<h3>List Screens</h3>
Run
<pre class="no-highlight">screen -ls</pre>
You will see
<pre class="no-highlight">There are screens on:
	7142.name	(10/19/13 12:43:39)	(Detached)
	7127.pts-0.test3	(10/19/13 12:42:25)	(Detached)
2 Sockets in /var/run/screen/S-root.</pre>
<code>pts-0.test3</code> is name of screen which was created without specifying screen name explicitly.
<h3>Reattatch a screen</h3>
Run following to reattach a detached screen
<pre class="no-highlight">screen -r name</pre>
Of specify <code>-d</code> flag to force detach on a screen attached elsewhere
<pre class="no-highlight">screen -d -r name</pre>
As you can create screens with same name, in case you have screen with same, you need to specify pid like below:
<pre class="no-highlight">screen -r 7142</pre>
<h3>Create a new screen within a screen</h3>
I never needed this myself, but its possible to create <span class="code-key">CTRL</span>+<span class="code-key">A</span>+<span class="code-key">C</span>

You can also create a new screen using normal <code>screen -S name</code> command.