---
ID: 71862
post_title: >
  Meet WordPress-Nginx with EasyEngine @
  nginx.conf 2014 in San Francisco, USA
author: Rahul Bansal
post_excerpt: "Overview of Rahul Bansal's nginx journey and details of upcoming speaker session at nginx.conf in San Francisco, USA on Oct 21-22. Promo code for attendees."
layout: post
permalink: >
  https://easyengine.io/blog/meet-easyengine-nginx-conf-2014-san-francisco-usa/
published: true
post_date: 2014-09-26 13:10:54
---
<a href="https://rtcamp.com/wp-content/uploads/2014/09/nginx-conf-easyengine.jpg"><img class="alignnone wp-image-72006 size-large" src="https://rtcamp.com/wp-content/uploads/2014/09/nginx-conf-easyengine-720x312.jpg" alt="nginx-conf-easyengine" width="720" height="312" /></a>

Next month I will be sharing my WordPress-Nginx knowledge along with my favourite EasyEngine project, at the official Nginx conference in San Francisco, USA.

As I look forward to this conference with pride and honour, I also feel a bit nostalgic.

This post was supposed to be a simple notification about this upcoming event, but ended up becoming more of a short log of my Nginx journey so far.
<h2>Year 2009 - The year I met Nginx!</h2>
Back in 2009, our tech blog <a href="http://devilsworkshop.org/">Devils' Workshop's</a> traffic was growing at a pace that used to crash Apache server many times a day.

We tried to upgrade from shared-hosting to VPS, VPS to bigger VPS. Nothing seemed to work while hosting costs kept increasing. I coded a script to simply restart apache and other processes, made it accessible at a "secret" public URL. <a href="http://www.mobilegyaan.com/">Deepak Jain</a>, me and other contributor would hit that URL whenever anyone of us saw apache crashed.

That terrible experience led me to explore alternatives and that is when I came across Nginx. I wish I could remember the exact date!

After spending days on <a href="http://forum.nginx.org/search.php?0,author=992,match_type=USER_ID,match_dates=0,match_threads=1">Nginx forum</a>, I managed to figure out the configuration I needed to run our WordPress Multisite. <a href="http://forum.nginx.org/read.php?2,25901,25901#msg-25901">Multisite part was toughest</a>. But after painful migration, we managed to save more than $100 every month in hosting bill, with 100% uptime!
<h2>Year 2010 - Earning with Nginx</h2>
By early 2010, I reached a level where I needed more Nginx related work to try out what I had learned over the year. So we started offering <a href="https://rtcamp.com/wordpress-nginx/">WordPress-Nginx setup service</a> (<a href="https://rtcamp.com/blog/introducing-wpnginx-our-new-service-for-high-traffic-wordpress-sites/">release post</a>).

For next two years, I kept building our internal knowledge-base. I mostly kept it private as I wasn't sure about how correct it all was.
<h2>Year 2012 - WordPress-Nginx Series</h2>
This was the year, when I realised that a lot of our internal knowledge-base had matured and wasn't changing much.

Next obvious thing was to release our <a href="https://rtcamp.com/wordpress-nginx/tutorials/">WordPress-Nginx tutorial series</a> (<a href="https://rtcamp.com/blog/starting-wordpress-nginx-tutorial-series/">release post</a>) so others can benefit from it.

Response to this series turned out to be so good, that rtcamp.com started getting more traffic than our tech blog!
<h2>Year 2013 - EasyEngine</h2>
After answering thousands of support requests (via comments, forums, and emails), we felt need to simplify WordPress-Nginx setup further!

We already had few scripts handy to do repetitive tasks. We packaged them all together and after a lot of polishing released it in open-source as <a href="https://rtcamp.com/easyengine">EasyEngine</a> (<a href="https://rtcamp.com/blog/easyengine-easy-wordpress-nginx/">release post</a>) .
<h2>Year 2014 - Speaking at nginx.conf</h2>
EasyEngine and our WordPress-Nginx article series helped us make many new friends in Nginx's online community. One of them is <a href="https://twitter.com/pnommensen">Patrick Nommensen</a> from Nginx, Inc itself.

It was Patrick who suggested I should speak at nginx.conf on Wordpress-Nginx.

Initially, I was a reluctant to go to the US, mainly because of the costs involved. But my partner Vivek Jain convinced me to travel to US. So I applied as a speaker to nginx.conf.

I must say I was very lucky as I was selected without much hassle. So <a href="http://nginx.busyconf.com/schedule#day_5392085d1ba4772c03000011">I will be speaking at nginx.conf on Oct 21</a>! :-)
<h3>Agenda for my session</h3>
Before I present the demo of EasyEngine, I will cover WordPress-Nginx best practices (theory part with some code snippets and examples).

The idea is to explain few things that EasyEngine does behind the scenes.

<a href="https://nginx.busyconf.com/proposals/53ff8857ea96fb95ce00007e?token=54e9k8ktl54t6wfg5vyk#">Complete agenda can be found here</a>.
<h3>Experts I am excited to meet</h3>
I am really excited to meet Igor. Or the way I say it here, <em>"Eager to meet Igor"</em> (no pun intended). ;-)

Igor is the guy who created Nginx for all of us.

I would also like to meet <a href="http://agentzh.org/">Yichun Zhang (agentzh)</a>. Though I couldn't explore Lua module developed by him, I used many of his nginx-modules.

As far as sessions at nginx-conf goes, it's really hard to decide on favourites. Still my TO-ATTEND list includes following <em>(in chronological order)</em>
<ol>
	<li><strong>The Latest and Greatest from ngx_lua: New Features &amp; Tools </strong>by <em>Yichun Zhang (agentzh) (Day 1, 11:45am - 12:30pm, Developing track) - </em>Finally, I will get a chance to explore nginx_lua. A pending to-do item on my list from a very long time.</li>
	<li><strong>Scaleable NGINX Configuration</strong> by <em>Igor Sysoev (Day 1,  <em>2:15pm - 3pm under Operating track) - </em></em>As EasyEngine is growing, config files have already started to become complex. For <a href="https://rtcamp.com/easyengine">EasyEngine</a> users, it's still running one command for most stuff but we are having tough time writing upgrade scripts from one version to another.</li>
	<li><strong>Behavior Based Security with Repsheet</strong> by <em>Aaron Bedra (Day 2, 11am-11:45am under Developing track) - </em>As maintainer of EasyEngine, I should jump at every opportunity to explore more about security. Plus I hate spam!</li>
	<li><strong>When Dynamic Becomes Static: The Next Step in Web Caching Techniques</strong> by <em>Wim Godden</em> <em>(Day 2, 1:30pm - 2:15pm, Case Studies track) - </em>Majority of our managed-hosting clients are running membership sites where users are logged in. We rely on hhvm for better performance. But if something can be done at the Nginx side of things for logged in users, it will take things to the whole new level.</li>
	<li><strong>Writing and Rewriting Web Apps in nginx.conf — URL shortening, OpenGrok </strong>by <em>Constantine A. Murenin</em> <em>(Day 2, 2:15pm - 3pm under Case Studies track) - </em>This is a favourite because I myself wanted to use build nginx only URL shortening service. We maintain a URL shortening service for our domain <a href="http://rt.cx">rt.cx</a>.</li>
</ol>
Apart from sessions, I would love to meet Patrick, Sarah, Shirley and Erin from Nginx team. These people are really awesome and helped me not only in my session-related preparation but also in travel and other arrangements.
<h2>More things at (WordCamp) San Francisco</h2>
I am all excited to speak at the Nginx conference. But as this my first trip to US, I have added few more things to my TO-DO list.

Most important is attending <a href="http://2014.sf.wordcamp.org/">WordCamp San Francisco</a>.

Had I planned to attend nginx-conf earlier, I would have tried my hand at applying for a speaker session to WordCamp SF as well but unfortunately, when I got to know about nginx-conf, speaker registrations for WordCamp SF were already closed. :-|

I am excited to attend WordCamp SF and look forward to hearing some amazing <a href="http://2014.sf.wordcamp.org/speakers/">speakers</a> there. I also plan to meet Nirav Mehta from <a href="http://www.appsmagnet.com/">Apps Magnet</a> who will also be attending WordCamp SF.

I have posted <a href="http://rahul286.com/post/usa-itinerary/">my complete travel itinerary</a> on <a href="http://rahul286.com/">my personal blog</a>.

<strong>Links: </strong><a href="http://nginx.com/nginxconf/">Nginx.Conf 2014</a> | <a href="https://rtcamp.com/easyengine">EasyEngine</a> | <a href="https://rtcamp.com/wordpress-nginx/">WordPress-Nginx</a>

<em>(promo code: if you like to attend to nginx.conf, you can use promo code <strong>SPEAKER25</strong> during registration to get 25% discount)</em>