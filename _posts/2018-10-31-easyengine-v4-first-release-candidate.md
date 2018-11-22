---
ID: 142401
post_title: 'EasyEngine v4 &#8211; First Release Candidate'
author: Rahul Bansal
post_excerpt: >
  EasyEngine v4 first release candidate is
  here. We are using RC1 on easyengine.io
  and most of our WordPress sites at the
  moment.
layout: post
permalink: >
  https://easyengine.io/blog/easyengine-v4-first-release-candidate/
published: true
post_date: 2018-10-31 15:06:07
---
<h1>EasyEngine v4 RC1</h1>
We finally have a first release candidate for EasyEngine v4 tagged RC1.

This release adds support for migrations between EasyEngine versions seamlessly.

You can start testing on a fresh VPS. Currently, we support a limited operating system that includes Ubuntu 14.04, 16.04, 18.04 and Debian 8. Please run the following command:

```

wget -qO ee rt.cx/ee4 &amp;&amp; sudo bash ee

```

<a href="https://github.com/easyengine/easyengine#installing">You can find the detailed instructions, here.</a>

We repeat - hopefully, for the last time, that v4 is not production ready! 😉
<h2>What has changed?</h2>
<ul>
 	<li>Seamless self-update for the next EasyEngine version</li>
 	<li>Support added for global mysql and redis</li>
 	<li>Logs and Confs now made available under site root</li>
 	<li>EE shell is now supercharged</li>
 	<li>Auth command now has the whitelisting option</li>
 	<li>Some commands have been renamed to ensure their consistency</li>
 	<li>Minor bugs have been fixed</li>
</ul>
<h3>Seamless self-update for the next EasyEngine version</h3>
You will be able to update to next EasyEngine versions just by running `ee cli update`. This includes the stable as well as intermediate updates, such as, RC1 to RC2 upgrade. 👋

The `ee cli update` command automatically updates sites for changes, related to that command. For e.g. PHP container has an update, say a security patch, `ee cli update` will ensure that all sites using PHP get updated to the latest container image.

Changing the container image on a running site may lead to a downtime of a few seconds, in some cases. Therefore, please plan your update carefully. Ideally, do it when the server CPU load is low.

If you have a large MySQL database, then restarting MySQL will have its own latency. The MySQL restart time is in no way related to EasyEngine or Docker it uses.

Ofcourse, MySQL will not restart all the time, but, only when there is an update available.
<h3>Support added for global mysql and redis</h3>
Before this release, all sites created with EEv4 had their own mysql and redis container. Redis is used for WordPress sites when full-page caching is enabled.

This was becoming a resource hog. Hence from this release, by default, all sites will use a single global database container and single global redis container.

However, if you wish to have separate mysql or redis containers for a site, you can do that by passing a flag during site create

```

ee site create example.com --type=wp --local-db --with-local-redis

```
<h3>Logs and Confs now made available under site root</h3>
Now, each site’s PHP and Nginx configuration as well as log files are available under each sites’ root folder.

Earlier, many of them were only present in containers, hence, you cannot see them directly on your filesystem. However, now you can easily view and even edit them per site.

For a site such example.com, logs &amp; confs will be accessible from following paths:
<ul>
 	<li>PHP conf =&gt; /opt/easyengine/sites/example.com/config/php-fpm</li>
 	<li>PHP logs =&gt; /opt/easyengine/sites/example.com/logs/php-fpm</li>
 	<li>Nginx conf =&gt; /opt/easyengine/sites/example.com/config/nginx</li>
 	<li>Nginx logs =&gt; /opt/easyengine/sites/example.com/logs/nginx</li>
</ul>
Also, configuration and logs of global services like nginx-proxy, mysql and redis are now mounted at /opt/easyengine/services.
<h3>EE shell is now supercharged</h3>
We have updated `ee shell` command to add three things.

<b>Non-interactive command execution</b>

You can use `--command` parameter to specify a command to be executed inside the container. Following is an example where we check the integrity of the core WordPress files without starting an interactive shell, using normal `ee shell` command.

<b>```</b>

ee shell example.com --command=’wp core verify-checksums’

```

<b>Specify containers</b>

Each EE site, except HTML site, has at least PHP, Nginx and Postfix containers. Depending on the way you create a site, the site might have MySQL, Redis and/or Mailhog containers associated with them.

Until now, every time you ran `ee shell`, you used to exec shell inside PHP container, except for HTML site type.

Now, you can specify a container using `--service` parameter such as:

```

ee shell example.com --service=nginx

```

<b>Specify user</b>

Each docker container has a default Linux user. For PHP &amp; Nginx containers, it’s www-data.

For MySQL, Redis, Mailhog, and Postfix, the default user is root.

You can specify user via `--user` parameter such as:

```

ee shell example.com --user=root

```

<b>Combing these new parameters</b>

You can combine these newly introduced parameters in any way you like. Such as:

```

ee shell example.com --service=nginx --command=”nginx -t” --user=”root”

```
<h3>Auth command now has the whitelisting option</h3>
Auth command in EEv4 now has the option to whitelist an IP, as it was in EEv3.

You can use the following command, which will whitelist the given 2 IPs from auth. You can pass any number of IP addresses, separated by a comma.

```

ee auth create --ip=”172.0.1.1,172.0.1.2”

```
<h3>Some commands have been renamed to ensure consistency</h3>
We ran into one of the <a href="https://twitter.com/codinghorror/status/506010907021828096">two toughest problems of computer science</a>, during this project, many times! We have fixed the naming issue upto some extent, hopefully. 🤞

The following commands were renamed:
<ul>
 	<li>ee admin-tools up =&gt; ee admin-tools enable</li>
 	<li>ee admin-tools down =&gt; ee admin-tools disable</li>
 	<li>ee mailhog up =&gt; ee mailhog enable</li>
 	<li>ee mailhog down =&gt; ee mailhog disable</li>
 	<li>ee cron add =&gt; ee cron create</li>
</ul>
<h3>Minor bugs have been fixed</h3>
<ul>
 	<li>Site delete now deletes site auth, cron jobs, redirection configs and purges object as well as page cache, if any.</li>
 	<li>Site command --cache flag during site creation now enables object cache and also adds the <a href="http://wordpress.org/plugins/nginx-helper/">nginx-helper plugin</a>, which helps purge page cache.</li>
 	<li>Update default database charset to utf8mb4</li>
 	<li>The real IP of users is now correctly forwarded to site’s nginx</li>
 	<li>Rename cache keys (full-page cache and object cache now have a separate key prefix)</li>
 	<li>You can now run cron as a specific user</li>
 	<li>Change wp cron event run to 1hr instead of 5 mins</li>
 	<li>All global services have been added into docker-compose.yml</li>
 	<li>The installation of admin-tools have been made faster by switching to a zip based installation, instead of the installation method with the previous composer.</li>
</ul>
<h2>Status</h2>
We understand that the beta to the first RC took more than a month. But since v3 to v4 is a big change, we want to test v4 on our own sites first. We believe in dogfooding! 🐶

We tagged RC1 and have already moved many of our sites, including this one on EasyEngine v4.. 🎉

https://twitter.com/easyengine/status/1055825069459623936

We might need one last RC before we can have 4.0. While we will not announce the release dates, we are optimistic about a Mid-November 4.0 release.

<b>Link: </b><a href="https://github.com/EasyEngine/easyengine/releases/tag/v4.0.0-rc.1">EasyEngine 4.0.0-rc.1 release</a>