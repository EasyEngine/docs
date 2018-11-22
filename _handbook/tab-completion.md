---
ID: 142688
post_title: Tab Completion
author: Rahul Bansal
post_excerpt: >
  EasyEngine v4 has auto/tab completion
  script that supports Bash and ZSH
layout: handbook
permalink: >
  https://easyengine.io/handbook/tab-completion/
published: true
post_date: 2018-11-20 11:59:27
---
<!-- wp:paragraph -->
<p>EasyEngine comes with a tab completion script for Bash and ZSH. </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>To add it, run the following command:</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>wget -qO ~/.ee-completion.bash https://raw.githubusercontent.com/EasyEngine/easyengine/develop-v4/utils/ee-completion.bash</code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p>If you use <code>bash</code>, run:</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>echo 'source ~/.ee-completion.bash' >> ~/.bash_profile
source ~/.ee-completion.bash</code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p>If you use <code>zsh</code>, run:</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>cat &lt;&lt;EOF >> ~/.zshrc
autoload bashcompinit
bashcompinit
source ~/.ee-completion.bash
EOF
source ~/.zshrc
</code></pre>
<!-- /wp:code -->