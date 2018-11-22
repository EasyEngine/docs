---
ID: 32048
post_title: >
  Install Xdebug and configure it with
  Netbeans
author: Faishal Saiyed
post_excerpt: >
  Installing Xdebug on php5-fpm, nginx and
  using Xdebug in development on NetBeans
layout: page
permalink: >
  https://easyengine.io/tutorials/php/xdebug-netbeans/
published: true
post_date: 2013-03-09 19:14:19
---
<h3>Installing Xdebug</h3>
1. Install Xdebug for php
<pre class="bash">sudo apt-get install php5-xdebug</pre>
2. Setup xdebug.ini for ubuntu
<pre class="bash">vim /etc/php5/fpm/conf.d/20-xdebug.ini</pre>
Add following lines:
<div id="file-gistfile1-txt-LC3">
<pre class="ini">xdebug.profiler_output_dir=/tmp
xdebug.profiler_output_name=cachegrind.out.%p
xdebug.profiler_enable_trigger=1
xdebug.profiler_enable=0
xdebug.remote_enable=true
xdebug.remote_host=127.0.0.1
xdebug.remote_port=9001
xdebug.remote_handler=dbgp
xdebug.remote_autostart=0</pre>
3. Restart php5-fpm
<pre>sudo service php5-fpm restart</pre>
<h3>Configuring Netbeans:</h3>
<a href="https://easyengine.io/wp-content/uploads/2013/03/xdebug-netbeans.png"><img class="size-medium wp-image-32093" alt="xdebug-netbeans" src="https://easyengine.io/wp-content/uploads/2013/03/xdebug-netbeans-460x345.png" width="460" height="345" /></a>
<ol>
	<li>Go to Tools &gt; Options &gt; PHP &gt; Debugging</li>
	<li>Set <code>Debugging Port : <strong>9001</strong></code></li>
	<li>Start Debugging your project by <strong>Ctrl+F5</strong> or file by <strong>Ctrl+Shift+F5</strong></li>
</ol>
<h3>For WordPress Plugin/Theme:</h3>
<a href="https://easyengine.io/wp-content/uploads/2013/03/WordPress-Xdebug-Netbeans-1.png"><img class="alignnone size-medium wp-image-47938" alt="WordPress-Xdebug-Netbeans-1" src="https://easyengine.io/wp-content/uploads/2013/03/WordPress-Xdebug-Netbeans-1-460x244.png" width="460" height="244" /></a>
<ol>
	<li>Go to Project Properties &gt; Run Configuration. Set Project URL.</li>
	<li>Go to Advanced Options.</li>
</ol>
<a href="https://easyengine.io/wp-content/uploads/2013/03/SourceCode-xdebug-Netbeans-Mapping.png"><img class="alignnone size-medium wp-image-47939" alt="SourceCode-xdebug-Netbeans-Mapping" src="https://easyengine.io/wp-content/uploads/2013/03/SourceCode-xdebug-Netbeans-Mapping-388x345.png" width="388" height="345" /></a>
<ol start="4">
	<li>Map your local project path (source code directory) with the server path (plugin/theme directory on your server).</li>
	<li>Start Debugging your theme/plugin.</li>
</ol>
For more details, check out the <a title="Xdebug Documentation" href="http://xdebug.org/docs/remote">Xdebug Documentation</a>.

</div>