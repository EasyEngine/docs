---
ID: 142676
post_title: Installation Guide
author: Rahul Bansal
post_excerpt: 'This is EasyEngine v4 install guide. EasyEngine supports Mac, Linux and any platform which has PHP & Docker support.'
layout: handbook
permalink: https://easyengine.io/handbook/install/
published: true
post_date: 2018-11-20 11:41:47
---
<!-- wp:paragraph -->
<p>This is EasyEngine v4 install guide.&nbsp;EasyEngine supports Mac, Linux and any platform which has PHP &amp; Docker support.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Automated Installation</h2>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<h3>Linux</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>For Linux, we have created an installer script which will install all the dependencies for you. We have tested this on Ubuntu 14.04, 16.04, 18.04 and Debian 8.</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>wget -qO ee https://rt.cx/ee4 &amp;&amp; sudo bash ee</code></pre>
<!-- /wp:code -->

<!-- wp:heading {"level":3} -->
<h3>Mac</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Starting with v4, EasyEngine supports Mac install using the famous <a href="https://brew.sh/">brew</a> package manager.</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>brew install easyengine</code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p>⚠️<em><strong>Note:</strong> While we wait for <a href="https://github.com/Homebrew/homebrew-core/pull/34378">this PR to merge in brew</a>, please use following&nbsp;alternative:</em></p>
<!-- /wp:paragraph -->

<!-- wp:preformatted -->
<pre class="wp-block-preformatted">brew install https://rt.cx/easyengine</pre>
<!-- /wp:preformatted -->

<!-- wp:paragraph -->
<p><strong>Not using brew?</strong></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>You can install EasyEngine v4 on Mac by:</p>
<!-- /wp:paragraph -->

<!-- wp:list {"ordered":true} -->
<ol><li>Upgrading PHP that ships with Mac OS to v7.2. There are many methods. Any method will work as long as it gets PHP 7.2 in $PATH. Ensure PHP has required modules as <g class="gr_ gr_453 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling ins-del" id="453" data-gr-id="453">outlines</g> in the next section.</li><li>Install <a href="https://docs.docker.com/docker-for-mac/install/">Docker for Mac</a> by using dmg installer.</li><li>Follow "Phar Install" part in next section.</li></ol>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>Manual Install</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>EasyEngine has a very few dependencies hence it can be manually installed on any *nix platform where they are met.&nbsp;</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Requirements/Dependencies</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Please note that EasyEngine itself needs PHP v7.2. The sites it create can use PHP 5 also. You don't need to worry about PHP 5 as EasyEngine will take care of it.</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul><li>Docker</li><li>Docker-Compose</li><li>PHP CLI (&gt;=7.1)</li><li>PHP Modules - <code>curl</code>, <code>sqlite3</code>, <code>pcntl</code>, <code>zip</code></li></ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>Phar Install</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Once you have above dependencies in order, please run following commands to download and put EasyEngine in a <code>/usr/local/bin/ee</code> location.</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>wget -O /usr/local/bin/ee https://raw.githubusercontent.com/EasyEngine/easyengine-builds/master/phar/easyengine.phar
chmod +x /usr/local/bin/ee</code></pre>
<!-- /wp:code -->

<!-- wp:heading -->
<h2>Next</h2>
<!-- /wp:heading -->

<!-- wp:list {"ordered":true} -->
<ol><li><a href="https://easyengine.io/commands">Explore Command References</a></li><li><a href="https://easyengine.io/handbook/tab-completion/">Add tab completion support</a></li></ol>
<!-- /wp:list -->