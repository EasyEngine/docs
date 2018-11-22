---
ID: 142278
post_title: EasyEngine v4 Beta-3 Release
author: mbtamuli
post_excerpt: ""
layout: post
permalink: >
  https://easyengine.io/blog/ee-v4-beta-3-release/
published: true
post_date: 2018-07-13 19:14:05
---
We have just released EasyEngine v4 Beta-3. We’re thankful to the people helping us in whatever capacity they can by suggesting ideas, testing our beta releases and reporting bugs. This beta release fixes issues found in <a href="https://easyengine.io/blog/ee-v4-beta-1-release/">beta-1</a> and <a href="https://easyengine.io/blog/ee-v4-beta-2-release/">beta-2</a> releases and also introduces a few features. Please leave us helpful comment or report issues on our <a href="https://github.com/EasyEngine/easyengine">GitHub repo</a>.

You can get started on our currently supported OSs (Ubuntu 14.04, 16.04, 18.04 and Debian 8) using -
<pre>wget -qO ee rt.cx/ee4beta <span class="pl-k">&amp;&amp;</span> sudo bash ee</pre>
We repeat, v4 is <strong>not ready for production</strong>. For instruction on how to install on currently unsupported distributions, please see <a href="https://github.com/easyengine/easyengine#installing">installation instructions</a>.
<h2>Notable New Additions</h2>
<h3>Port from <a href="https://traefik.io/">Traefik</a> to <a href="https://github.com/jwilder/nginx-proxy">jwilder/nginx-proxy</a></h3>
<ul>
 	<li>This is one of the major changes that took us some time to figure out as we tried a few existing solutions like <a href="https://github.com/jwilder/nginx-proxy">jwilder/nginx-proxy</a>, <a href="https://traefik.io/">Traefik</a> and <a href="https://fabiolb.net/">Fabio</a>. After taking a look at all their pros and cons, we decided to stick with jwilder/nginx-proxy due to few of reasons. First, Nginx is something we <a href="https://easyengine.io/wordpress-nginx/tutorials/">love</a> and <a href="https://easyengine.io/tutorials/nginx/">understand</a>. Secondly, we found a number of issues with all three of the tested tools.</li>
 	<li>The problem with jwilder/nginx-proxy was that it didn’t have support for letsencrypt. More on this later.</li>
 	<li>Traefik has both static and dynamic config and a few of the most important settings for running EasyEngine was to be added to the static configuration and for Traefik to reload the static configuration meant restarting Traefik. For exampe, if we had to enable HTTPS for one WordPress MU subdomain site, for which we’ll require wildcard SSL, we’d have to restart the Traefik reverse proxy and all other sites on the server would go down.</li>
 	<li>Fabio is a powerful service which lends itself to the containerized services wonderfully. But Fabio in turn has a dependency on Consul and that would require us to modify the application WordPress itself. Moreover, Fabio along with Consul might be useful for high availability but for our requirements, it did not fit well.</li>
 	<li>So we thought, if we had to make modifications, we should make those modifications to a tool that has support for most of the capabilities we require as well as is easy for us to work with. So we added support for LetsEncrypt in jwilder/nginx-proxy but we are maintaining our own fork of it - <a href="https://github.com/EasyEngine/dockerfiles/tree/develop/nginx-proxy">easyengine/nginx-proxy</a></li>
</ul>
<h3>Add Letsencrypt support</h3>
We have added letsencrypt ssl support for single as well as multi-site types.
<ul>
 	<li>We’ve used <a href="https://github.com/acmephp/acmephp">acmephp</a> to implement letsencrypt integration. We chose it over <a href="https://certbot.eff.org/">certbot</a> as acmephp is a php library which allows us more control and hence it integrates better with EasyEngine. In the process of integrating it, we also contributed to upstream by fixing some <a href="https://github.com/acmephp/acmephp/issues/122">critical</a> <a href="https://github.com/acmephp/acmephp/pull/112">issues</a>.</li>
 	<li>For the single wordpress site as well as Subdirectory wordpress sites, EasyEngine issues certificates using the http challenge method. Hence, only input need from user in this method is an email to register on letsencrypt which can be passed using `--le-mail=&lt;mail-id&gt;`, or by saving the value of `le-mail` in `/opt/easyengine/config.yml`. If neither is done then EasyEngine will prompt for email only first time during site creation. After that it will read from config at `/opt/easyengine/config.yml`</li>
 	<li>For Subdomain multisite creation, EasyEngine uses dns method to generate wildcard certificates. For now, users will have to manually add TXT records as displayed during site creation and then run `ee site &lt;site-name&gt; le` to complete the certificate checks and generation. This will be automated in later versions as we add support for multiple DNS providers, through the use of API. This is something where the community can help. We might add Cloudflare support before the stable release as it is a popular provider.</li>
 	<li>You can use `--letsencrypt` to create SSL sites.
<pre># Install wordpress with letsencrypt
ee site create example.com [--letsencrypt|--le]

# Install wordpress subdomain with letsencrypt (wildcard certs)
ee site create example1.com --wpsubdom --le
# After adding the TXT record you need to run
ee site le example1.com</pre>
</li>
 	<li>Find more examples in the README  <a href="https://github.com/EasyEngine/site-command/">https://github.com/EasyEngine/site-command/</a></li>
</ul>
<h3>Tag all EasyEngine Docker images</h3>
<ul>
 	<li>Add image tagging to ensure that proper images of EasyEngine are pulled and used according to the version of EasyEngine being used by the user.</li>
</ul>
<h2>Bug fixes</h2>
Other issues that have been fixed are
<ul>
 	<li>Add confirmation to the delete commands.
<ul>
 	<li>Issue: <a href="https://github.com/EasyEngine/site-command/issues/50">https://github.com/EasyEngine/site-command/issues/50</a></li>
 	<li>PR: <a href="https://github.com/EasyEngine/site-command/pull/56">https://github.com/EasyEngine/site-command/pull/56</a></li>
</ul>
</li>
 	<li>Improve v4 installation script
<ul>
 	<li>Issue: <a href="https://github.com/EasyEngine/easyengine/issues/1100">https://github.com/EasyEngine/easyengine/issues/1100</a></li>
 	<li>PR: <a href="https://github.com/EasyEngine/installer/pull/5">https://github.com/EasyEngine/installer/pull/5</a></li>
</ul>
</li>
 	<li>Pick an ORM library for EE's SQLite DB and Migrations
<ul>
 	<li>Issue: <a href="https://github.com/EasyEngine/easyengine/issues/852">https://github.com/EasyEngine/easyengine/issues/852</a></li>
 	<li>PR: <a href="https://github.com/EasyEngine/easyengine/pull/1097">https://github.com/EasyEngine/easyengine/pull/1097</a></li>
</ul>
</li>
 	<li>--letsencrypt to work without adding www domain to DNS
<ul>
 	<li>Issue: <a href="https://github.com/EasyEngine/easyengine/issues/1022">https://github.com/EasyEngine/easyengine/issues/1022</a></li>
 	<li>PR: <a href="https://github.com/EasyEngine/site-command/pull/52">https://github.com/EasyEngine/site-command/pull/52</a></li>
</ul>
</li>
</ul>
<strong>Release Link: </strong><a href="https://github.com/EasyEngine/easyengine/releases/tag/v4.0.0-beta.3">v4.0.0-beta.3 release</a>