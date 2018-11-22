---
ID: 141299
post_title: EasyEngine v4 insights, progress and FAQ
author: Rahul Bansal
post_excerpt: >
  Some important details about EasyEngine
  v4 and answers to some common questions.
layout: post
permalink: >
  https://easyengine.io/blog/easyengine-v4-insights-faq/
published: true
post_date: 2016-10-12 20:38:54
---
My previous <a href="https://easyengine.io/blog/easyengine-v4-development-begins/">EasyEngine v4 post</a> generated a lot more reactions and questions than I anticipated. This post is an attempt to answer some of these questions and provide more details about the project.
<h2>v4 Long Term Goals/Insights</h2>
Allow me to elaborate on the v4's long term goals quickly. <a href="https://easyengine.io/blog/easyengine-3-roadmap/#easyengine-roadmap">In the past</a>, we have made it clear that we want to build a web interface for EasyEngine. However, we have never specified <em>how </em>we plan to do this.

Here is a raw diagram from an internal document that will shed some light on the plan:

<img class="size-large wp-image-141300 alignnone" src="https://easyengine.io/wp-content/uploads/2016/10/EasyEngine-CLI-REST-API-Web-720x528.png" alt="easyengine-cli-rest-api-web" width="720" height="528" />

As you can see, there are three different components:
<ol>
 	<li><strong>ee-cli</strong> - this is the command-line EasyEngine that we currently use. When we say v4, it means v4 of EE command.</li>
 	<li><b>REST API</b>- this is what will make it possible for any remote client to communicate with a server running EasyEngine over HTTPS. This is most likely delivered as an EE Package (similar to WP-CLI packages). Don't worry; this will not be auto-installed or auto-enabled.</li>
 	<li><strong>Web Interface</strong> - this would be built on Laravel <em>(we are hiring <a href="https://careers.rtcamp.com/laravel-engineer/">Laravel </a>engineers)</em>. The tentative plan is to build the web interface as a SaaS platform and freemium business model.</li>
</ol>
You might also have noticed some dotted lines in a diagram (labeled "inter-server communication"). This is some of the magic we have in store ;). For now, all I will say is that these will be used to migrate sites from one server running EasyEngine to another server running EasyEngine. I imagine it will be something like <code>ee move example.com --to=user@remote.host.com
</code>

One might argue as to why we don't bundle the web interface as an EE Package. To this, I would say that the SaaS model is the best fit for our changed business goals moving ahead. I believe that the web interface will deliver enormous value when integrated with the different services that EE users find useful.
<h2>More about REST API</h2>
Now, if you observe, EE-Web is just an example client for EasyEngine's REST API. The goal is to make REST API powerful enough that:
<ul>
 	<li>Hosting companies will use it to provision WordPress sites. Some hosting companies are already using EasyEngine in a painfully "<em>hackish</em>" way to do just that. I hope REST API will make their life easier.</li>
 	<li>Somebody will build a WordPress plugin so that a "master" WordPress site can be used to manage multiple servers running EasyEngine on them. This will be great for small hosting businesses, considering the fact that WordPress already has plugins to set up membership &amp; e-commerce sites, communities, support forums and helpdesks.</li>
 	<li>Somebody will develop mobile apps that can directly manage servers running EasyEngine.
We might also make some mobile apps, but our apps will connect to EasyEngine cloud.</li>
</ul>
Finally, REST API might help somebody develop a barebones web interface as an EE Package. We would be happy to help and promote it. :-)
<h2>Progress so far</h2>
EasyEngine v4 (ee-cli) is being developed quite rapidly. We hope to have a beta release before the month's end.

REST API might be done in December, once v4 release becomes stable.

Web interface won't happen this year as it depends on REST API.

You can <a href="https://github.com/easyengine/easyengine/tree/feature/v4.0.0">follow v4 code commits on Github here</a>.
<h2>Answers to Some Questions</h2>
Our choice about PHP/WP-CLI raised many questions. In particular, I felt that <a href="https://easyengine.io/blog/easyengine-v4-development-begins/#comment-223904">this one</a> by <a href="https://ahmadawais.com/">Ahmad Awais</a> (who is a major contributor) would be better answered here.
<h3>Why PHP?</h3>
Having developed in many languages, I think <em>"X language is better"</em> is subjective.

Of course, C/Go will be faster than PHP, Python/Ruby has easier syntax compared to PHP, but the reality is that languages don't build programs by themselves- programmers do!

EasyEngine's first goal is to make life easier for people in the WordPress ecosystem- people who already know PHP deeply. In other words, the choice of language was driven by "<a href="https://en.wikipedia.org/wiki/Domain_knowledge">domain knowledge</a>."

A project made for the WordPress community is simply not attractive for Python developers. Hence, hiring for further development was painful.

The way I see it, programmers, who know WordPress are in a better position to deliver with EasyEngine.

Finally, going by numbers, we did not get a single decent pull request in more than the year we spent on Python.
<h3>Relationship with WP-CLI</h3>
EasyEngine already installs WP-CLI and uses it internally for many WordPress-related tasks. WP-CLI makes it easy to develop EasyEngine by taking care of most WordPress related things.

This part will remain as it is!

What we mean when we say EasyEngine will be based on WP-CLI is that EasyEngine code will look very similar to WP-CLI. The immediate advantage of this is that anyone familiar with WP-CLI can quickly start developing on EasyEngine. Also, in future EasyEngine dev team can contribute back to the WP-CLI.

EasyEngine will not depend on WP-CLI. However, their code structure will look similar as intended.
<h3>But OSs do not have PHP by default</h3>
This was the first point we discussed. Unlike WP-CLI, which is usually installed at a later stage, EasyEngine is generally first command you run on a fresh server. So how EE will work when PHP itself is missing!

Let's take a closer look to famous 2-commands getting started guide for EasyEngine.
<pre class="no-highlight">wget -qO ee rt.cx/ee &amp;&amp; sudo bash ee # install easyengine
sudo ee site create example.com --wp # install wordpress on example.com</pre>
If you notice, the first command is not an <code>ee</code>command. It is in fact <code>wget</code> and <code>bash</code> which are present on all Linux distro's EE supports.

The first command is EasyEngine installer, and it has always been in shell scripting language. It will continue to be in shell scripting language.

Even with Python, we can't trust all hosting companies to provide standard OS images. So installer in shell scripting language is a safer choice.

The same installer, for v4, will ensure PHP and any other dependencies are in place before you run any EE command!

TL;DR; It will always work! The same way as it works now! :-)
<h3>Features/Roadmap</h3>
Currently, the focus is delivering a stable v4 as soon as possible.

Above is critical for the success of the EE Package ecosystem. Only when we have this base ready will we think about which features to work on for the CLI part.

Still, to give a rough idea, our next rough goal is to simplify development workflow. This could lead to:
<ul>
 	<li>Native Mac version of EasyEngine</li>
 	<li>"ee site copy" command to duplicate sites. The idea is to make setting up staging sites 1-command deal.</li>
 	<li>Something around deployment/rollback. Local to remote server and vice-versa.</li>
 	<li>Something to debug and profile code. We have <code>ee debug</code> but it can have more power. For now, you can try <a href="https://runcommand.io/wp/profile/">wp profile</a> from runcommand.</li>
 	<li>Error log parsing</li>
 	<li>CI/CD integration. I don't have any idea how we will support this in EasyEngine.</li>
</ul>
So as you can see next year's releases will be more "developer" focused.

We believe current caching options are enough. In fact, of all the sites we manage, the one which didn't scale turned out to have coding issues. So the idea is to make it easy for a developer to spot bad code and testing/benchmarking.

Finally, about #1 feature request - <a href="https://github.com/EasyEngine/easyengine/issues/150">shared hosting</a>. Sorry, we don't currently have it on the cards. If this is important to you, please get involved. We will be happy to work with you so you can build shared hosting support quickly! The bottom line for this feature is that we need more hands for it to become a reality.
<h2>Have more questions?</h2>
Please use the comment form below or even better <a href="http://community.rtcamp.com/c/easyengine">start a discussion on the community forum</a>.

You can <a href="http://slack.easyengine.io/">join our slack team</a> also!