---
ID: 141140
post_title: Website access restriction using nginx
author: Sushant Salil
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/nginx/website-access-restriction-using-nginx/
published: true
post_date: 2016-07-05 16:17:12
---
You can restrict access to certain part of your website using nginx's inbuilt authentication and authorization mechanism based either on your client's I.P, by prompting for a login prompt or both.

A sample I.P. based authorization configuration would be like:
<pre>location /private/ {
allow 192.168.1.1/24;
allow 172.16.0.1/16;
allow 127.0.0.1;
deny all;
}</pre>

<strong>Note:</strong> In above example <code>/private/</code> is the website address you want to restrict access to and 192.*, 172.*, 127.* represents I.P addresses you want to allow access to.

<code>allow</code> and <code>deny</code> are the two keyword that can be used to grant or restrict access to the desired part of your website.

To enable authentication, you will need to use the <code>auth_basic</code> directive. The <code>auth_basic_user_file</code> directive is used to define a list of allowed users with their respective passwords. For the purpose of access restriction, nginx uses <code>HTTP basic authentication</code>.

<pre>server {
    ...
    auth_basic "Restricted access";
    auth_basic_user_file common/authenticator;
}</pre>

You can still allow certain parts of the website to be publicly accessible. In such a case you will need to pass <code>off</code> parameters to <code>auth_basic</code> under a location block with the publicly accessible url.

<pre>server {
    ...
    auth_basic "Restricted access";
    auth_basic_user_file common/authenticator;

    location /private/public/ {
        auth_basic off;
    }
}</pre>

If you have both I.P. based authorization and HTTP based authentication mechanism enabled, by default a user will have to qualify both restriction to be able to have access to the desired page. You can change this behavior by using the directive <code>satisfy</code>. It takes two values either <code>all</code> or <code>any</code>, by default, it is implicitly set to <code>all</code>, that can be overridden by using <code>any</code> to allow a user based on either their I.P or their username and password.

<pre>location /private/ {
    satisfy any;

    allow 192.168.1.1/24;
    allow 172.16.0.1/16;
    allow 127.0.0.1;
    deny all;

    auth_basic "Restricted access";
    auth_basic_user_file common/authenticator;

    location /private/public/ {
        auth_basic off;
}</pre>