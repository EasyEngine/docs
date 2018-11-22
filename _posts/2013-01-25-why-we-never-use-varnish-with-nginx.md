---
ID: 25646
post_title: Why we never use Varnish with Nginx!
author: Rahul Bansal
post_excerpt: >
  Our reasons for NOT using Varnish with
  Nginx
layout: post
permalink: >
  https://easyengine.io/blog/why-we-never-use-varnish-with-nginx/
published: true
post_date: 2013-01-25 16:24:27
---
<p class="rtp-alert alert"><strong>Disclaimer:</strong> I never used Varnish. So please do not treat this as Varnish v/s Nginx post. It will be wrong on my part to compare Nginx to something that I have never used.</p>
Since we published <a href="https://easyengine.io/wordpress-nginx/tutorials/">WordPress-Nginx tutorials</a>, we have been asked many times that why we haven't posted anything about Varnish!

Here is my attempt to answer...

<strong>Short Answer: </strong>Using Varnish + Nginx is not worth *my* effort!
<h3>Long Answer...</h3>
<h4>Time-saving:</h4>
I never used Varnish. So I will have to spend some time learning Varnish. Apart from this, Varnish will increase one more package on Nginx + PHP + MySQL + APC/Memcache stack we commonly use. That means if something goes wrong, we will need to debug Varnish also apart from other packages!

So not only in learning but I will have to spend time in maintenance on ongoing basis.
<h4>Static-content:</h4>
Nginx can handle static files itself pretty fast. On larges sites, people generally use CDN to host static files (images, videos, js, css, etc).

Varnish is surely useful when used with Apache. If Apache has mod_php enabled, Apache performance significantly drops for static-file requests.
<h4>Load-Balancer, Reverse-Proxy:</h4>
Again, Nginx does this for me! In a client-setup, we have a micro Amazon EC2 instance running nginx as load-balancer in front of range of PHP, mysql.

Beauty of Nginx is that it can directly talk to other Nginx and PHP directly. It can read from memcache directly! So it works really well for us in multi-machine environment.

In second part of our <a href="https://easyengine.io/series/wordpress-nginx-tutorials/">WordPress-Nginx Tutorial Series</a>, I will write in depth about load-balancing, reverse-proxy etc. <em>(You can <a href="https://easyengine.io/subscribe">subscribe here</a> for updates.)</em>
<h4>Benchmarks...</h4>
I am not fond of benchmarks. Still, if Varnish + Nginx gives 5-10% performance improvement but cost in days to learn and hours every month in ongoing maintenance, I will prefer to leave that 5-10% of performance gain.

That being said I find this <a href="http://todsul.com/nginx-varnish">Varnish/Nginx</a> benchmark quite good!
<h3>Finally...</h3>
My point is... rather than learning multiple tools partially, I will dig deeper into Nginx. I will master it to the point that it can cater to all our needs! :-)

That's it from my side! You can prove me wrong using comment-form below! ;-)