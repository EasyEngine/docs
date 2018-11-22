---
ID: 56511
post_title: >
  EasyEngine is GPL (and why we choose
  GPL)
author: Rahul Bansal
post_excerpt: >
  We choose GPL for our EasyEngine
  project. This article describes how we
  choose GPL, instead of MIT (our
  favorite).
layout: post
permalink: >
  https://easyengine.io/blog/easyengine-is-gpl/
published: true
post_date: 2014-02-05 20:09:30
---
After running business for almost 5 years, for the first time, we faced problem with choosing a license for a project.

TIll last year, most of our open-source work involved WordPress themes and plugins only, which are GPL by-default.

When we released <a href="http://rtcamp.com/easyengine">EasyEngine</a>, almost 4-months back, we realize that we had to make a choice about license, ourself!

I always thought that, if I had to choose a license for rtCamp's open-source project, it would be MIT. But as I digged deeper into the licensing world and <a href="https://twitter.com/rahul286/status/428080944633745408">annoyed few people</a>, I ended up choosing GPL for EasyEngine.

<strong>So EasyEngine is GPL now!</strong>

If you like to know why we choose GPL, please keep reading. If not, there is nothing more in this post.
<h2>Why GPL?</h2>
<p class="info"><strong>Disclaimer:</strong> Following section should not be confused with legal advice. It has very high probability of  containing wrong information/assumptions!</p>

<h3>What I like about MIT...</h3>
I <em>personally</em> think MIT is more permissive. I always felt, more businesses would have been involved with WordPress had it licensed under MIT, rather than GPL. MIT would have allowed third-party developer to choose their own license for their themes and plugins.

But at the same time, I think since WordPress is fork of b2, it wasn't in hands of <a href="http://ma.tt/">Matt</a> and <a href="http://mikelittle.org/">Mike</a> to choose a license. GPL was "forced" upon them. I do not know, if they (Matt &amp; MIke) had a choice, would they have chosen GPL or something else.

I always felt idea of "forcing" freedom is against spirit of freedom itself. I always believed freedom should come without limits. This is the reason I like MIT more. But then...
<h3>Why we choose GPL?</h3>
I read complete text in many license (MIT, GPL, Apache, BSD to be specific), many articles on MIT v/s GPL, wasted many hours in different discussion/forums; but as it happens with all licensing debate, I ended up more confused!

I only knew, we had to choose a license. Putting codes on Github is not enough. In absence of explicitly stated license, it will be considered as copyrighted work.

But in confused state, I somehow landed on page - <a href="http://www.gnu.org/copyleft/">http://www.gnu.org/copyleft/</a>. This page has a really nice middleman example.

After reading that, we had a simple choice to make - we want the freedom we are giving to EasyEngine users to reach users of fork.

As an example, we do not have Centos support in roadmap. If somebody forks EasyEngine for Centos, then we atleast wish that Centos community to get as much freedom as EasyEngine Ubuntu users are enjoying. :-)

I won't be surprised if I made a mistake here. But in India, I had really hard time finding a legal consultant to discuss this.
<h2>Useful Links on licensing</h2>
You may or may not agree with choice/views. But during our hunt for best license, we came across some nice links which we can share:
<ul>
	<li><a href="http://choosealicense.com/">http://choosealicense.com/</a> - Best resource by Github itself</li>
	<li><a href="http://www.codinghorror.com/blog/2007/04/pick-a-license-any-license.html">Comparison of licenses on Coding Horror</a></li>
	<li><a href="http://www.wtfpl.net/">Do What The Fuck You Want To Do Public License</a> - yep there is a license like this and it is extremely permissive ;-)</li>
	<li><a href="http://en.wikipedia.org/wiki/Copyleft">Copyleft on WikiPedia</a></li>
</ul>
Apart from above, you will find thousand of article comparing X &amp; Y licenses. Problem is that, they contradict with each other to the extent that you will get headache after reading few of them!

<strong>Project Links: </strong><a href="http://rtcamp.com/easyengine">EasyEngine Homepage</a> | <a href="https://github.com/rtCamp/easyengine">GitHub Repo</a>