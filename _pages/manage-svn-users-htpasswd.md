---
ID: 25100
post_title: Manage SVN Users with htpasswd
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/manage-svn-users-htpasswd/
published: true
post_date: 2010-04-16 09:00:54
---
We use SVN to manage our source codes for different projects. SVN uses http-based authentication.

Below are commands to manage SVN users:
<h3>Adding a user</h3>
<pre>htpasswd -b /path/to/svn-auth-file username password</pre>
<h3>Deleting  a user</h3>
<pre>htpasswd -D /path/to/svn-auth-file user.name</pre>