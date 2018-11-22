---
ID: 142084
post_title: >
  How we plan to use Docker in EasyEngine
  v4
author: Rahul Bansal
post_excerpt: >
  This explains why we need docker and how
  we plan to use it!
layout: post
permalink: >
  https://easyengine.io/blog/how-we-plan-to-use-docker-in-easyengine-v4/
published: true
post_date: 2017-12-06 18:51:18
---
This article is more of a proposal so feel free to comment and share your concerns and expertise.

Arguments like I hate docker; I will switch to something else; I like X don't count. So please be constructive.

<h2>Package Management</h2>

The single biggest problem we are trying to solve with Docker is software package management.

<h3>Current implementation and problems</h3>

Currently, EasyEngine supports two distros - Ubuntu and Debian in limited ways. By limited, we mean that for Ubuntu we support LTS releases and for Debian - we support few latest versions.

At a bare minimum, we need Nginx, PHP, MariaDB, Redis, Postfix packages. Some users prefer Memcache over Redis.

We maintain our own Nginx build at <a href="https://build.opensuse.org/project/show/home:rtCamp:EasyEngine">https://build.opensuse.org/project/show/home:rtCamp:EasyEngine</a>. It is outdated, and we are finding it hard to keep it updated. Testing different distros with every version is a very time-consuming task.

Then for some packages like PHP, we rely on different third parties for Ubuntu and Debian. We need to test for differences carefully. Otherwise, the same command might behave differently on Ubuntu and Debian.

The problems don't end here. Many times hosting companies have their base images for Ubuntu/Debian which are different than DigitalOcean and Amazon AWS base setup. Many EasyEngine issues related to installation failure are related to differences in base images.

Also, there are some futuristic problems to deal. We want to use EasyEngine on Mac (most of our dev team uses Mac for WordPress development). Now we need to add more codes to deal with <code>brew</code> based packages! <img class="emoji" src="https://s.w.org/images/core/emoji/2.3/svg/1f613.svg" alt="?" />

<h3>Expectation from Docker</h3>

Our goal is to replace apt/brew/yum based packages with docker images and containers. This is what we want to achieve at a bare minimum.

We might keep everything in <code>/var/www/</code> as it is. We want to replace running processes with Docker containers. If we manage to do this seamlessly, not only above problems will be solved, but EasyEngine will be usable on every platform where Docker containers can be run! This includes Mac, Windows and every distro of Linux of course.

The added advantages will be increased <a href="https://12factor.net/dev-prod-parity">local development and production parity</a>. It is a minimum requirement of a decent development workflow.

A pleasant side effect might be the viability of most demanded shared-hosting feature. The processes running in composer are run in isolation!

<h2>How are we planning to use Docker?</h2>

This is not going to be easy. There are many decisions to be made that will affect all of us.

The current idea is to use docker-compose to define a site’s stack. So EasyEngine site creation commands will generate a <code>docker-compose.yml</code> file based on parameters.

There are many docker-compose files on the Internet to run entire WordPress site. <a href="https://github.com/easyengine/docker-compose-wordpress">Here is one we are working on</a>.

We have tested WordPress site creation using orchestration tools like Docker Swarm or Kubernetes, but there is no plan to put them in EasyEngine core.

We want to make EasyEngine core as small as possible and move all functionality to the EasyEngine command packages.

For now, if you are a docker expert, please have a look at <a href="https://github.com/EasyEngine/easyengine/issues/945">this Github issue</a> which is more like a checklist for what we think of as an acceptable Docker-based solution.

We understand that not everyone is Docker expert. We ourself are new to it! But if nothing else, <a href="https://github.com/EasyEngine/easyengine/issues/945">please contribute test-cases to checklist as comments on the Github issue</a>. <img class="emoji" draggable="false" src="https://s.w.org/images/core/emoji/2.4/svg/1f64f.svg" alt="?" />

<strong>Link -</strong> <a href="https://github.com/EasyEngine/easyengine/issues/945">Docker Checklist for EasyEngine v4</a> | <a href="https://github.com/easyengine/docker-compose-wordpress">Docker-Composer for WordPress</a>