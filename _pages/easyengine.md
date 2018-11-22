---
ID: 39791
post_title: EasyEngine
author: Rahul Bansal
post_excerpt: >
  easyengine (ee) is a linux shell-script
  collection to manage your
  wordpress-nginx sites. It supports
  wordpress-multisites and different
  page-caches.
layout: page
permalink: https://easyengine.io/easyengine/
published: true
post_date: 2013-08-08 12:07:56
---
&nbsp;
<h2 style="text-align: center;">The Easy Part!</h2>
<p style="text-align: left;"><code>wget -qO ee rt.cx/ee &amp;&amp; sudo bash ee</code> # install easyengine
<code>sudo ee site create example.com --wp</code> # install wordpress on example.com</p>

<h2 style="text-align: center;">The Not-so-easy Part</h2>
<p style="text-align: center;">Creating a high traffic site, big enough to crash Nginx! ;-)</p>

<h2 style="text-align: center;">Features</h2>
<h3 style="text-align: center;">Complete Setup</h3>
<p style="text-align: center;">Install NGINX, MySQL, Postfix, PHP 7 and dependencies with a single command</p>

<h3 style="text-align: center;">Easy SSL with Let's Encrypt</h3>
<p style="text-align: center;">Enable HTTPS (SSL/TLS) during or after site creation with a simple flag <code>--letsencrypt</code></p>

<h3 style="text-align: center;">Caching Options</h3>
<p style="text-align: center;">Use W3Total Cache, WP Super Cache &amp; Nginx’s FastCGI Cache.</p>

<h3 style="text-align: center;">Config Optimization</h3>
<p style="text-align: center;">Automatically tweaks server configuration as per available hardware resources</p>

<h3 style="text-align: center;">Automatic Updates</h3>
<p style="text-align: center;">Update EasyEngine for new feature with one simple command: <code>ee update</code></p>

<h3 style="text-align: center;">Git-Backed Changes</h3>
<p style="text-align: center;">All config changes are saved using Git so feel free to play with config!</p>

<h2 style="text-align: center;">Create "15" Types of WordPress Sites!</h2>
<table>
<tbody>
<tr>
<th scope="col"></th>
<th>Single Site</th>
<th>Multisite w/ Subdir</th>
<th>Multisite w/ Subdomain</th>
</tr>
<tr>
<th scope="row">NO Cache</th>
<td><code>--wp</code></td>
<td><code>--wpsubdir</code></td>
<td><code>--wpsubdomain</code></td>
</tr>
<tr>
<th scope="row">WP Super Cache</th>
<td><code>--wpsc</code></td>
<td><code>--wpsubdir --wpsc</code></td>
<td><code>--wpsubdomain --wpsc</code></td>
</tr>
<tr>
<th scope="row">W3 Total Cache</th>
<td><code>--w3tc</code></td>
<td><code>--wpsubdir --w3tc</code></td>
<td><code>--wpsubdomain --w3tc</code></td>
</tr>
<tr>
<th scope="row">Nginx cache</th>
<td><code>--wpfc</code></td>
<td><code>--wpsubdir --wpfc</code></td>
<td><code>--wpsubdomain --wpfc</code></td>
</tr>
<tr>
<th scope="row">Redis cache</th>
<td><code>--wpredis</code></td>
<td><code>--wpsubdir --wpredis</code></td>
<td><code>--wpsubdomain --wpredis</code></td>
</tr>
</tbody>
</table>
<h2 style="text-align: center;">Our Clients</h2>
<img src="https://easyengine.io/wp-content/uploads/2013/08/Geometric-HCL-Logo-215px.png" alt="Geometric-HCL-Logo-215px" />
<img src="https://easyengine.io/wp-content/uploads/2013/08/rotimatic-logo.png" alt="rotimatic-logo" />
<img src="https://easyengine.io/wp-content/uploads/2013/08/vanguard-logo.png" alt="vanguard-logo" />
<img src="https://easyengine.io/wp-content/uploads/2010/05/inc42-logo.png" alt="inc42-logo" />
<img src="https://easyengine.io/wp-content/uploads/2010/05/monkey-developers-logo.png" alt="monkey developers" />
<a role="button" href="https://easyengine.io/clients/" target="_self">
View Clients
</a>
<h2 style="text-align: center;">EasyEngine at Conferences</h2>
<iframe src="https://www.youtube.com/embed/nR56Lw6ZGes?feature=oembed" width="330" height="172" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
<p style="text-align: center;">CLI tool to Easily Manage WordPress Sites on Nginx at <a href="http://mumbai.wordcamp.org/2014/" target="_blank" rel="noopener">WordCamp Mumbai 2014</a></p>
<iframe src="https://www.youtube.com/embed/cVhbifzS1QM?feature=oembed" width="330" height="172" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
<p style="text-align: center;">WordPress - NGINX Best Practices with EasyEngine at nginx.conf 2014</p>
<iframe src="https://videopress.com/embed/tPHO2pM8?hd=0" width="365" height="172" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
<p style="text-align: center;">Debugging WordPress Performance Using EasyEngine at <a href="http://mumbai.wordcamp.org/2015/" target="_blank" rel="noopener">WordCamp Mumbai 2015</a></p>

<h2 style="text-align: center;">What people are saying about EasyEngine</h2>
<blockquote lang="en">Loving the combination of a <a href="https://twitter.com/linode">@linode</a> server and <a href="https://twitter.com/rtCamp">@rtCamp</a> EasyEngine - makes <a href="https://twitter.com/WordPress">@WordPress</a> installation a breeze :) — Simon Pollard (@smp303) <a href="https://twitter.com/smp303/status/575334573619429377">March 10, 2015</a></blockquote>
<blockquote lang="en">
<p dir="ltr" lang="en"><a href="https://twitter.com/easyengine">@easyengine</a> makes provisioning VPS with <a href="https://twitter.com/hashtag/WordPress?src=hash">#WordPress</a> in <a href="https://twitter.com/hashtag/nginx?src=hash">#nginx</a> a breeze!</p>
— Marlon Amancio (@marlonlamancio) <a href="https://twitter.com/marlonlamancio/status/617837952073383937">July 5, 2015</a></blockquote>
<blockquote lang="en"><a href="https://twitter.com/easyengine">@easyengine</a> changed everything! Setting up <a href="https://twitter.com/hashtag/nginx?src=hash">#nginx</a> is no longer daunting. Love it! — danfascia (@danfascia) <a href="https://twitter.com/danfascia/status/517784754054512641">October 2, 2014</a></blockquote>
<blockquote data-conversation="none" data-lang="en">
<p dir="ltr" lang="en"><a href="https://twitter.com/tommcfarlin">@tommcfarlin</a> <a href="https://twitter.com/digitalocean">@digitalocean</a> I have some DO’s powered by <a href="https://twitter.com/rtCamp">@rtCamp</a> EasyEngine. Check it out, happy to help.</p>
— Matt Medeiros (@mattmedeiros) <a href="https://twitter.com/mattmedeiros/status/681947843905646593">December 29, 2015</a></blockquote>