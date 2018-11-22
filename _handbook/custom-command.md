---
ID: 142670
post_title: Custom Command Development
author: Rahul Bansal
post_excerpt: ""
layout: handbook
permalink: >
  https://easyengine.io/handbook/developer/custom-command/
published: true
post_date: 2018-11-22 12:56:54
---
<!-- wp:paragraph -->
<p>With EasyEngine v4, You'll be able to create your own commands for EasyEngine!</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>For now, to <strong>develop or run</strong> custom commands you need to clone EasyEngine. This won't be required in <g class="gr_ gr_4 gr-alert gr_gramm gr_inline_cards gr_run_anim Grammar only-ins replaceWithoutSep" id="4" data-gr-id="4">future</g>.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Creating your own commands</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Clone EasyEngine<span style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, Oxygen-Sans, Oxygen, &quot;Fira Sans&quot;, Ubuntu, Cantarell, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, sans-serif;">&nbsp;repository and install its composer <g class="gr_ gr_110 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling ins-del multiReplace" id="110" data-gr-id="110">dependencis</g>.&nbsp;</span></p>
<!-- /wp:paragraph -->

<!-- wp:preformatted -->
<pre class="wp-block-preformatted">git clone git@github.com:easyengine/easyengine.git <br>cd easyengine<br>composer install</pre>
<!-- /wp:preformatted -->

<!-- wp:paragraph -->
<p><p>Clone the <a href="https://github.com/EasyEngine/command-template">command skeleton repository</a> and rename it to the command you want to create.</p></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><p>Update <g class="gr_ gr_17 gr-alert gr_gramm gr_inline_cards gr_run_anim Style multiReplace" id="17" data-gr-id="17">the </g><code>name</code><g class="gr_ gr_17 gr-alert gr_gramm gr_inline_cards gr_disable_anim_appear Style multiReplace" id="17" data-gr-id="17"> in</g> <g class="gr_ gr_18 gr-alert gr_gramm gr_inline_cards gr_run_anim Style multiReplace" id="18" data-gr-id="18">the </g><code>composer.json</code><g class="gr_ gr_18 gr-alert gr_gramm gr_inline_cards gr_disable_anim_appear Style multiReplace" id="18" data-gr-id="18"> of</g> the cloned repository. If the name is not updated properly then composer update/install with it will fail.</p></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><p>Add below line <g class="gr_ gr_4 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling only-del replaceWithoutSep" id="4" data-gr-id="4">in </g><code>composer.json</code><g class="gr_ gr_4 gr-alert gr_spell gr_inline_cards gr_disable_anim_appear ContextualSpelling only-del replaceWithoutSep" id="4" data-gr-id="4"> in</g> the EasyEngine directory in <code>require</code> section:</p></p>
<!-- /wp:paragraph -->

<!-- wp:preformatted -->
<pre class="wp-block-preformatted"><code>"author/command-name": "dev-master"﻿</code></pre>
<!-- /wp:preformatted -->

<!-- wp:paragraph -->
<p><p>Where author can be your <g class="gr_ gr_3 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling ins-del multiReplace" id="3" data-gr-id="3">github</g> username.</p></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Also, append the following section in the <code>composer.json</code> below <code>require</code> block:</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>"repositories": {
    "author/command-name": {
        "type": "path",
        "url": "path/to/your/forked/repository"
    }
}</code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p>Or, you can add your repository to <g class="gr_ gr_4 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling ins-del multiReplace" id="4" data-gr-id="4">packagist</g> and run <code>composer require author/command-name</code>.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Run <code>composer update</code> in the core repository after this.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>After that, try running the default command <code>hello-world</code> given in the template, it should give a success message as below by running it from the easyengine repository root:</p>
<!-- /wp:paragraph -->

<!-- wp:preformatted -->
<pre class="wp-block-preformatted">$ ./bin/ee hello-world<br></pre>
<!-- /wp:preformatted -->

<!-- wp:paragraph -->
<p>Should show</p>
<!-- /wp:paragraph -->

<!-- wp:preformatted -->
<pre class="wp-block-preformatted">Success: Hello world.</pre>
<!-- /wp:preformatted -->

<!-- wp:paragraph -->
<p>Note: These manual steps for setting up a new EasyEngine command will be replaced by a scaffold command.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Running third party commands</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>As EasyEngine does not have support for running external commands with PHAR, you'll have to first clone the repository and perform series of manual steps detailed below. Once we have support for running external commands with PHAR, it will be as simple as <code>ee package install author/packagename</code>.</p>
<!-- /wp:paragraph -->

<!-- wp:list {"ordered":true} -->
<ol><li>Clone the EasyEngine repository
<pre><code class="language-bash">git clone git@github.com:easyengine/easyengine.git 
</code></pre>
</li><li>
<p>Clone the command's repo.</p>
</li><li>
<p>Update the <code>composer.json</code> in the EasyEngine directory, add the following in <code>require</code>:</p>
<pre><code class="language-json">"author/command-name": "dev-master"
</code></pre>
</li></ol>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p>Also, append the following section in the <code>composer.json</code> below <code>require</code> block:</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>"repositories": {
    "author/command-name": {
        "type": "path",
        "url": "path/to/cloned/command"
    }
}</code></pre>
<!-- /wp:code -->

<!-- wp:list {"ordered":true} -->
<ol><li>Run <code>composer update</code> in the core repository after this.</li><li>Run the command with
<pre><code class="language-bash">$ ./bin/ee command
</code></pre>
</li></ol>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>Distributing your commands</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>To distribute your commands, you just need to put them on github or any other publically accesible git repository.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>If someone has to install your commnad, they will have to follow the instructions from <a href="#running-third-party-commands">running third party commands</a>.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Creating your own site types</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>In EasyEngine v4, you can create your own site types! If you want to create your own site type, The steps are same as <a href="#creating-your-own-commands">creating your own commands</a>. Just instead of cloning command skeleton repository in step 3, you can clone <a href="https://github.com/EasyEngine/site-type-php/">site-type-php</a> as a starting point and start customerizing it from there on.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Custom containers in command/site-type</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>If you're making your own command or site-type, chances are you might need to run containers of a custom docker image. If that is the case, You need to push the docker image to <a href="https://hub.docker.com">docker hub</a>. After that you need to handle creation, updation and deletion of container through docker commands.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Another way to do it and that's how EasyEngine does is that we generate a <code>docker-compose.yml</code> file dynamically and use docker-compose commands since it makes managing multiple containers easy. You can look at code of <a href="https://github.com/EasyEngine/site-type-php/blob/develop/src/Site_PHP_Docker.php">Site_PHP_Docker</a> and <a href="https://github.com/EasyEngine/site-type-php/blob/develop/src/PHP.php">site-type-php</a> for reference.</p>
<!-- /wp:paragraph -->