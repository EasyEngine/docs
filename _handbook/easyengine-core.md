---
ID: 142672
post_title: EasyEngine Core Development
author: Rahul Bansal
post_excerpt: ""
layout: handbook
permalink: >
  https://easyengine.io/handbook/developer/easyengine-core/
published: true
post_date: 2018-11-20 20:29:23
---
<!-- wp:paragraph -->
<p>EasyEngine v4 is built using PHP. If you have developed on WordPress and/or WP-CLI, you will find EasyEngine codebase a lot familiar.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Requirements</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Your development environment must have following.&nbsp;</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul><li>Git</li><li>PHP</li><li>Composer<a href="https://github.com/github/hub"></a></li></ul>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>Steps for working on core repository</h2>
<!-- /wp:heading -->

<!-- wp:list {"ordered":true} -->
<ol><li>Clone EasyEngine locally and <g class="gr_ gr_11 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling ins-del" id="11" data-gr-id="11">checkout</g> the development branch - <code>git clone git@github.com:EasyEngine/easyengine.git &amp;&amp; git checkout develop </code></li><li>Fork the EasyEngine core repository on GitHub</li><li>Add your repository to your git remote - <code>git remote add &lt;remote-name> git@github.com:username/command-name.git</code></li><li><p><g class="gr_ gr_12 gr-alert gr_gramm gr_inline_cards gr_run_anim Style multiReplace" id="12" data-gr-id="12">Run </g><code>composer install</code><g class="gr_ gr_12 gr-alert gr_gramm gr_inline_cards gr_disable_anim_appear Style multiReplace" id="12" data-gr-id="12"> in</g> the core repository.</p></li><li><p>You can now make the changes in code that you need to do and check them by running the following command from the root directory of EasyEngine repository - <span style="font-family: &quot;Noto Serif&quot;;"><code>./bin/ee command</code><code class="language-bash"></code></span></p></li><li>Push changes to your repository using <code>git push &lt;remote-name></code></li><li>Send a PR to EasyEngine core repository on GitHub.</li></ol>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>Steps for working on existing command</h2>
<!-- /wp:heading -->

<!-- wp:list {"ordered":true} -->
<ol><li><p>Clone the EasyEngine core repository locally and check out the development branch. - <span style="font-family: &quot;Noto Serif&quot;;"><code>git clone git@github.com:EasyEngine/easyengine.git &amp;&amp; git checkout develop</code></span><br></p></li><li>Run <code>composer install --prefer-source</code></li><li>Fork the command's repository on GitHub. </li><li>Go to the command's directory <code>cd vendor/easyengine/command-name</code></li><li>Add your repository to your git remote - <code>git remote add &lt;remote-name> git@github.com:username/command-name.git</code> <br></li><li><p><span style="font-family: &quot;Noto Serif&quot;;">You can now make the changes in code that you need to do and check them by running the following command from the root directory of EasyEngine repository - </span></p><code>./bin/ee command</code></li><li>Push changes to your repository using <code>git push &lt;remote-name></code>.</li><li>Send a PR to EasyEngine core repository on GitHub.</li></ol>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>Steps for creating a new command</h2>
<!-- /wp:heading -->

<!-- wp:list {"ordered":true} -->
<ol><li><p>Fork the <a href="https://github.com/EasyEngine/command-template">command template repository</a> and rename it to the command you want to create. This will now look like <code>author/command-name</code> in your github.</p></li><li><p>Update the <code>name</code> and <code>homepage</code> in the <code>composer.json</code> of the cloned repository. If the name is not updated properly then composer update/install with it will fail.</p></li><li><p>Clone the EasyEngine core repository locally and checkout the development branch - <span style="font-family: &quot;Noto Serif&quot;;"><code>git clone git@github.com:EasyEngine/easyengine.git &amp;&amp; git checkout develop</code></span></p></li><li>Update the <code>composer.json</code> in the EasyEngine core repository, add the following in <code>require</code> - <code>"author/command-name": "dev-master"</code><p>Also, append the following section in the <code>composer.json</code> for development:</p></li></ol>
<!-- /wp:list -->

<!-- wp:code -->
<pre class="wp-block-code"><code>"repositories": { 
    "author/command-name": {
    "type": "path",
    "url": "path/to/your/forked/repository"
    }
}</code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p>Or, you can add your repository to packagist and run <code>composer reqiure author/command-name</code>.</p>
<!-- /wp:paragraph -->

<ol start="5">
<li>Run <code>composer update</code> in the core repository after this.</li>
<li>After that, try running the default command <code>hello-world</code> given in the template, it should give a success message as below by running it from the easyengine repository root:
<pre><code class="language-bash">$ ./bin/ee hello-world
Success: Hello world.
</code></pre>
</li>
</ol>

<!-- wp:paragraph -->
<p>Note: These manual steps for setting up a new EasyEngine command will be replaced by a scaffold command.</p>
<!-- /wp:paragraph -->