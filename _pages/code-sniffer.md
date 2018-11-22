---
ID: 57023
post_title: Code Sniffer
author: Faishal Saiyed
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/standards/php/code-sniffer/
published: true
post_date: 2014-02-07 12:54:19
---
PHP Code Sniffer breaks apart in tokens PHP, JavaScript and CSS files and detect violation of coding standards.
<h2>Installing Code Sniffer</h2>
Let's start with Installation step and then Netbeans configuration
<h3>On Linux</h3>
<em>(tested only on Ubuntu)</em>
<pre class="no-highlight">sudo pear install --alldeps php_codesniffer</pre>
<h3>On Mac (with brew)</h3>
<pre class="no-highlight">brew install php-code-sniffer</pre>
You can install brew by going to <a href="http://brew.sh/">http://brew.sh/</a>
<h3>On  Windows</h3>
TODO
<h2>Installing WordPress Coding Standard</h2>
<h3>Check available coding standards</h3>
Run following command to check available coding standards by default.
<pre class="no-highlight">phpcs -i</pre>
You will get something like:
<p class="rtp-clean"><em>The installed coding standards are MySource, PEAR, PHPCS, PSR1, PSR2, Squiz and Zend</em></p>
You can also find them in filesystem:
<pre class="no-highlight">cd $(pear config-get php_dir)/PHP/CodeSniffer/Standards/</pre>
<h3>Install WordPress Coding Standard</h3>
We are following these WordPress coding standard - <a href="https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards">https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards</a>

You can install it using:
<pre class="no-highlight">git clone git://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards.git $(pear config-get php_dir)/PHP/CodeSniffer/Standards/WordPress</pre>
<h2>CodeSniffer and NetBeans</h2>
<h3>Configuring CodeSniffer in NetBeans</h3>
<p class="warning"><strong>Note:</strong> Instructions given below are for NetBeans 7.4+. If you are using older version, please upgrade NetBeans.</p>
Go to Netbeans <code>Tools &gt; Options &gt; PHP</code>

<a href="https://easyengine.io/wp-content/uploads/2013/12/Options.png"><img class="alignnone  wp-image-45679" alt="Options" src="https://easyengine.io/wp-content/uploads/2013/12/Options.png" width="687" height="539" /></a>

If all goes well you will see something like below in your netbeans output window:

<a href="https://easyengine.io/wp-content/uploads/2013/12/NetBeans-phpCS-window.png"><img class="alignnone size-full wp-image-45680" alt="NetBeans-phpCS window" src="https://easyengine.io/wp-content/uploads/2013/12/NetBeans-phpCS-window.png" width="928" height="150" /></a>
<h4>Missing "Code Analysis" option tab</h4>
We are using Netbeans 7.4 beta which has "Code Analysis" built in.

For old Net Beans version you can install it from <code>Tools &gt; Plugins</code> .

Just go to "Available Plugins" tab and search for "phpcs". You will get 2 options. Try both! Or better upgrade to Netbeans 7.4.
<h4>Troubleshooting Mac with Brew</h4>
This should have been cakewalk. But if you are on mac and using brew it might get tough.

In any case if NetBeans refuse to show you CodeSniffer standards in drop-down menu, please run following:
<pre class="no-highlight">pear config-show | grep bin_dir</pre>
It outputs
<pre class="no-highlight">PEAR executables directory     bin_dir          /usr/local/Cellar/php54/5.4.19/bin</pre>
Just append <code>phpcs</code> to it so it becomes <code>/usr/local/Cellar/php54/5.4.19/bin/phpcs</code>

Also, you need to use php binary path by brew:

<a href="https://easyengine.io/wp-content/uploads/2013/12/Options-1.png"><img class="alignnone size-full wp-image-45682" alt="Options-1" src="https://easyengine.io/wp-content/uploads/2013/12/Options-1.png" width="587" height="257" /></a>
<h3>Running CodeSniffer in NetBeans</h3>
Select a file or a folder. Then click <code>Source &gt;&gt; Inspect</code> Menu.

<a href="https://easyengine.io/wp-content/uploads/2013/12/netbeans-run-codensiffer-1.png"><img class="alignnone size-full wp-image-45686" alt="netbeans-run-codensiffer-1" src="https://easyengine.io/wp-content/uploads/2013/12/netbeans-run-codensiffer-1.png" width="644" height="516" /></a>

Then select <strong>Code Sniffer</strong> configuration from drop-down and hit "Inspect" button.

<a href="https://easyengine.io/wp-content/uploads/2013/12/Condesniffer-run-in-netbeans.png"><img class="alignnone size-full wp-image-45684" alt="Condesniffer run in netbeans" src="https://easyengine.io/wp-content/uploads/2013/12/Condesniffer-run-in-netbeans.png" width="902" height="278" /></a>
<h2>CodeSniffer and GitLab-CI</h2>
rtCamp uses GitLab and GitLab-CI to manage its product line.
<h3>Installation CodeSniffer on Runner</h3>
Installation process will be similar to installing on Linux (assuming you are using Linux to run GItLab-CI Runner).

If you are rtCamper using ci.rtcamp.com, then you can ignore this part as all runners have CodeSniffer already installed.
<h3>Configuring GitLab-CI Project</h3>
Go to GitLab-CI Project Settings and paste following line in "Scripts" section.
<pre class="no-highlight">phpcs "--standard=WordPress" "--report=full" "--extensions=inc,php,phpt,php4,php5,php3,phtml" "--encoding=UTF-8"</pre>
<strong>Screenshot:</strong>

<img class="alignnone size-full wp-image-57049" alt="GitLab CI" src="https://easyengine.io/wp-content/uploads/2014/02/GitLab-CI.png" width="807" height="451" />