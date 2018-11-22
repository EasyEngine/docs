---
ID: 58189
post_title: >
  Install Xdebug and configure it with
  webgrind
author: Rahul Bansal
post_excerpt: >
  Profiling with xdebug and webgrind
  directly on server
layout: page
permalink: >
  https://easyengine.io/tutorials/php/xdebug-webgrind/
published: true
post_date: 2014-02-28 15:48:32
---
<h2>For EasyEngine Users...</h2>
You can use <a href="https://easyengine.io/docs/commands/debug/">ee debug command</a> which automates some part.
<h2>Installing Xdebug</h2>
1. Install Xdebug for php
<pre>sudo apt-get install php5-xdebug</pre>
2. Setup xdebug.ini for ubuntu
<pre>vim /etc/php5/fpm/conf.d/20-xdebug.ini</pre>
Add following lines:
<div id="file-gistfile1-txt-LC3">
<pre>xdebug.profiler_output_dir=/tmp
xdebug.profiler_output_name=cachegrind.out.%p-%H-%R
xdebug.profiler_enable_trigger=1
xdebug.profiler_enable=0</pre>
3. Restart php5-fpm
<pre>sudo service php5-fpm restart</pre>
<h2>Install Webgrind</h2>
Under webroot for example.com, run following commands:
<pre class="no-highlight">wget https://github.com/jokkedk/webgrind/archive/master.zip
unzip master.zip
mv webgrind-master webgrind</pre>
<h3>Install graphviz and Gprof2Dot</h3>
This is needed for graphical presentation of calls.
<pre class="no-highlight">apt-get install python graphviz</pre>
<h3>Webgrind config</h3>
Open config.php under webgrind folder. You may need to specify location of <code>dot</code> binary.
<pre>static $dotExecutable = '/usr/bin/dot';</pre>
<h2>Using Webgrind</h2>
Goto <strong>http://example.com/webgrind</strong> in your browser and you will see webgrind UI there.

But wait, you may not see any output there as cachegrind files may not have created yet.
<h3>Trigger Profiling</h3>
You may not see anything as we have set xdebug to profile only on trigger. This is good for profiling sites used in production environment as well as on server with multiple sites using same PHP pool.

You can use this browser extension to trigger profiling:
<ul>
 	<li>For Firefox:  <a style="line-height: normal; background-color: #ffffff;" href="https://addons.mozilla.org/en-US/firefox/addon/the-easiest-xdebug/">https://addons.mozilla.org/en-US/firefox/addon/the-easiest-xdebug/</a></li>
 	<li>For Chrome: <a style="line-height: normal; background-color: #ffffff;" href="https://chrome.google.com/extensions/detail/eadndfjplgieldjbigjakmdgkmoaaaoc">https://chrome.google.com/extensions/detail/eadndfjplgieldjbigjakmdgkmoaaaoc</a></li>
 	<li>For Safari: <a style="line-height: normal; background-color: #ffffff;" href="https://github.com/benmatselby/xdebug-toggler">https://github.com/benmatselby/xdebug-toggler</a></li>
 	<li>For Opera: <a style="line-height: normal; background-color: #ffffff;" href="http://addons.opera.com/extensions/details/xdebug-launcher/">http://addons.opera.com/extensions/details/xdebug-launcher/</a></li>
</ul>
<h3>Always Profile</h3>
Be warned, that this can eat up GB's of space on a live server with decent traffic in an hour!

You can change a line like below and it will profile php code always.
<pre>xdebug.profiler_enable=1</pre>
Of course, you will need to reload PHP for change to take effect using <code>service php5-fpm reload</code>
<h3>Remote Profiling</h3>
We have covered remote debugging with Netbeans here: <a href="https://easyengine.io/tutorials/php/xdebug-netbeans/">https://easyengine.io/tutorials/php/xdebug-netbeans/</a>. Please note that changes to debug config in NetBeans article, if you decide to use it.

<a href="http://www.xdebug.org/docs/remote">Xdebug site has more remote options</a>.

For more details, check out the <a title="Xdebug Documentation" href="http://xdebug.org/docs/remote">Xdebug Documentation</a>.

</div>