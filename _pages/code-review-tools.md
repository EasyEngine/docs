---
ID: 55678
post_title: Installation of PHP Code Review Tools
author: Chirag Swadia
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/php/code-review-tools/
published: true
post_date: 2014-01-15 03:29:16
---
PHP Code Review tools help you in following a proper coding standard while you are coding. These tools review certain things in your code such as -
<ul>
	<li>Unneccessary spacing</li>
	<li>Proper line breaks wherever needed</li>
	<li>Escaping PHP variables whenever they are displayed in html tags</li>
	<li>Code indentations</li>
	<li>Unused variables in functions</li>
	<li>Proper commenting of code</li>
</ul>
<h2>Installation &amp; Usage</h2>
<h3>1) PHP CodeSniffer</h3>
To install CodeSniffer run the below given command ( with root privileges )
<pre>sudo pear install PHP_CodeSniffer</pre>
Once you have successfully installed it, Run the below given command to check for coding standard related issues and warning in your php file
<pre>phpcs /path/to/source_file.php</pre>
<h3>2) PHP Copy Paste Detector</h3>
This tool detects for repeated codes in your php file or project. Run the below commands to install Copy Paste Detector
<pre><code class="bash">sudo pear config-set auto_discover 1
sudo pear install pear.phpunit.de/phpcpd</code></pre>
To check for repeated codes in your whole project, Use the below command
<pre><code class="bash">phpcpd /path/to/&lt;project_folder&gt;</code></pre>
To check for code repetion in a single file, you can use
<pre><code class="bash">phpcpd /path/to/source_file.php</code></pre>
<h3>3) PHP Mess Detector</h3>
This is a quite powerful tool as it helps in detecting -
<ul>
	<li>Cyclomatic complexity of functions</li>
	<li>Unused code blocks or variables</li>
	<li>Naming conventions of class,functions and variables</li>
</ul>
To install PHP Mess Detector, run the below commands -
<pre><code class="bash">sudo pear channel-discover pear.phpmd.org
sudo pear channel-discover pear.pdepend.org
sudo pear install --alldeps phpmd/PHP_PMD</code></pre>
Once you have installed PHP MD, You can check for the above three points all together using the following command
<pre><code class="bash">phpmd /path/to/source_file.php text codesize,unusedcode,naming</code></pre>
PHP MD accepts three parameters -
<ul>
	<li><strong>First</strong> is the path to the source file,</li>
	<li><strong>Second</strong> is the output format you want ( text, xml or html ) and</li>
	<li><strong>Third</strong> is the ruleset on which you want to test your code. You can even create your own <a title="Creating a ruleset file" href="http://phpmd.org/documentation/creating-a-ruleset.html" target="_blank">ruleset file</a> and pass it instead of the third parameter to have your own custom ruleset</li>
</ul>
<pre><code class="bash">phpmd /path/to/source_file.php text /path/to/ruleset_file.xml</code></pre>
<h2>Integrating with Netbeans</h2>
All the above tools can be easily integrated into Netbeans with the help of a plugin named <a title="PHPCSMD Netbeans Plugin" href="http://plugins.netbeans.org/plugin/42434/phpcsmd" target="_blank">phpcsmd</a>. To install it, Go to Tools -&gt; Plugins and search for phpcsmd and install it. Restart your IDE and you are good to go!

<a href="https://easyengine.io/wp-content/uploads/2014/12/phpcsmd-installation.png"><img class="alignnone size-full wp-image-55693" alt="phpcsmd installation" src="https://easyengine.io/wp-content/uploads/2014/12/phpcsmd-installation.png" width="855" height="390" /></a>

After the plugin is successfully installed, You need to configure it from <code>Tools ->  Options -> PHP -> PHPCSMD</code> tab

There are two basic configurations required -
<ol>
	<li><strong>Script location</strong> - This will be <code>/usr/bin/phpcs</code> for PHP CodeSniffer, <code>/usr/bin/phpmd</code> for PHP Mess Detector and <code>/usr/bin/phpcpd</code> for PHP Copy Paste Detector.</li>
	<li><strong>Standard / Rules</strong> - Select <code>PEAR</code> or <code>PHPCS</code> in case of CodeSniffer &amp; Select rule set as we have discussed above in the case of PHP Mess Detector</li>
</ol>
<h3>Install WordPress Coding Standard</h3>
If you want to follow <a title="Wordpress Coding Standards" href="http://codex.wordpress.org/WordPress_Coding_Standards" target="_blank">Wordpress Coding Standards</a> you can install it by running the below command
<pre class="no-highlight">git clone git://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards.git $(pear config-get php_dir)/PHP/CodeSniffer/Standards/WordPress</pre>
Once the installation is completed, You will be able to see that WordPress is also added to the list apart from PEAR and PHPCS.

<a href="https://easyengine.io/wp-content/uploads/2014/12/Configuration-PHPCSMD.png"><img class="alignnone size-full wp-image-55694" alt="Configuration PHPCSMD" src="https://easyengine.io/wp-content/uploads/2014/12/Configuration-PHPCSMD.png" width="1082" height="745" /></a>

Once you are done with the above settings, Then open any file or project you want to scan. Go to Tools and select <em>show phpcsmd annotations</em>. After  this click on any project folder from the tree view and click on <em>scan for violations</em> from the Tools menu. Once the scanning is completed, You will see that all the lines having issues with coding standard will be marked in different color ( depeding on the type of issue ) pointing out the issue as shown in the image below.

<a href="https://easyengine.io/wp-content/uploads/2014/12/Error-PHPCSMD.png"><img class="alignnone size-full wp-image-55695" alt="Error PHPCSMD" src="https://easyengine.io/wp-content/uploads/2014/12/Error-PHPCSMD.png" width="615" height="101" /></a>

Similarly, we can see the metrics for a particular code using a tool named PHP Depend. Go to Tools -&gt; scan with Pdepend. A new tab will open and show all the metrics of the selected file in terms of Lines of codes, Cyclomatic complexity, Commented lines of code etc.

Happy Coding!

<strong>[ Update - 7th Feb 2014 ]</strong>

This update is regarding Netbeans 7.4 as we have already discussed setting up of code review tools in Netbeans 7.3
Unlike to the older version, Netbeans 7.4 comes with the inbuilt Code Analysis part and there is no need to install any additional plugin(s) to run code analysis ( though you still need phpcs, phpmd and other required tools installed on your system ).
<h3>Configuration</h3>
Go to Tools -&gt; Options -> PHP, and you will see the Code Analysis tab as shown below.

<a href="https://easyengine.io/wp-content/uploads/2014/01/Code-Analysis-Netbeans-7dot4.png"><img class="alignnone size-full wp-image-57068" alt="Code Analysis Netbeans 7dot4" src="https://easyengine.io/wp-content/uploads/2014/01/Code-Analysis-Netbeans-7dot4.png" width="1102" height="578" /></a>

The rest of the configuration is same as Netbeans 7.3
<h3>Usage</h3>

Once you have configured it correctly, Now its time to run the inspection on a complete PHP project or a file.

Select any project ( Source ) and then click on Source -> Inspect as shown below

<a href="https://easyengine.io/wp-content/uploads/2014/01/Inspect-Netbeans-7dot4.png"><img src="https://easyengine.io/wp-content/uploads/2014/01/Inspect-Netbeans-7dot4.png" alt="Inspect Netbeans 7dot4" width="609" height="559" class="alignnone size-full wp-image-57070" /></a>

Once you click on Inspect, a dialog will ask on whether which tools you want to run on your project. You  can either run all the tools at once or even go for running one at a time. The below image shows that we are running only the CodeSniffer tool for the project.

<a href="https://easyengine.io/wp-content/uploads/2014/01/Inspect-Click.png"><img src="https://easyengine.io/wp-content/uploads/2014/01/Inspect-Click.png" alt="Inspect Click" width="1104" height="458" class="alignnone size-full wp-image-57069" /></a>

Once you are done, the inspection process will inspect all your PHP files in the project and then the output window will show all the errors and warnings in a tabular format as shown below.

<a href="https://easyengine.io/wp-content/uploads/2014/01/Output-Window-CodeSniffer-Netbeans-7dot4.png"><img src="https://easyengine.io/wp-content/uploads/2014/01/Output-Window-CodeSniffer-Netbeans-7dot4.png" alt="Output Window CodeSniffer Netbeans 7dot4" width="1110" height="741" class="alignnone size-full wp-image-57071" /></a>

Netbeans 7.4 provides a much better and clean code review as compared to the previous version, and it is highly recommended.

<h3>Updated</h3>
Use the following command to get proper error report format in NetBeans.
<pre><code class="bash">sudo phpcs --config-set report_format full</code></pre>