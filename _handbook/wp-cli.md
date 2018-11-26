---
ID: 142683
post_title: WP-CLI and EasyEngine
author: Rahul Bansal
post_excerpt: >
  EasyEngine v4 is built using WP-CLI as a
  framework. This doc outlines reasons
  behind the decision and current status.
layout: handbook
permalink: >
  https://easyengine.io/handbook/internal/wp-cli/
published: true
post_date: 2018-11-20 12:11:21
---
<!-- wp:paragraph -->
<p>EasyEngine v4 is built using&nbsp;WP-CLI codebase. This is a bit different than WP-CLI commands packages you see all over. We used WP-CLI as a framework as explained below.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>WP-CLI as a CLI framework</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Back when the development of EasyEngine v4 hadn't started, we had already decided to move away from Python and towards PHP. </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>At that time, we were looking at how CLI apps were made in PHP and which framework to build v4 on. We evaluated many options like Symphony Console, Laravel, Lumen and wp-cli. Out of all these, the one that fit our needs best was wp-cli.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Here are things we liked about it:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul><li>Community familiarity&nbsp;</li><li>Commands in separate repository</li><li>Managing documentation is easy</li><li>Extensible</li></ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>Community familiarity</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Most of the EasyEngine community are WordPress users and hence most of them are familiar with wp-cli. This will mean there will be less learning curve for existing and new EasyEngine users. Also, chances are, if someone has already contributed to wp-cli, they will easily be able to contribute to EasyEngine and vice-versa.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Commands in separate repository</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>All commands in wp-cli live in their own repositories. We really liked this way of separating concerns.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Managing documentation is easy</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>When you type&nbsp;<code>ee help site</code>, the help that you see is being generated from corrosponding class/function's docblock! Hence whenever you make changes in code, to make changes in help/documentation, you don't have to make changes in another directory or repository. You just have to change the docblock and the help text will change.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Further, all readme for all their repositories are generated via automation from docblocks. A setup like this would really ease the burden of maintaining documenetaiton.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Extensible</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>wp-cli is also extensible through custom packages. You can develop your own commands and add them to wp-cli easily!</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Result</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>We decided to use WP-CLI as a base framework on top of which we'll develop EasyEngine v4. </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>So on February 8, 2018, we started off EasyEngine v4 development from wp-cli v2.0.0-alpha at&nbsp;<a href="https://github.com/wp-cli/wp-cli/commit/e683d394f89ce923eac2227e655a01fa0255f925">this commit</a>. </p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Modifications</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>After using wp-cli as a base, there are only 3 major modifications that we did to the wp-cli core:</p>
<!-- /wp:paragraph -->

<!-- wp:list {"ordered":true} -->
<ol><li>Remove all WordPress specific code. Those codes were unrelated to EasyEngine's capabilities around WordPress site management.</li><li>Add support for routing of site types in a <code>ee site</code> command. This was required so that in future more site types support can be added easily.</li><li>Add database wrapper and data migrations support so that EasyEngine can manage it's own database &amp; upgrades.</li></ol>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p>Apart from these numerous small modifications were made.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Current Status</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Since the point we started developing v4, we haven't been able to sync up much with wp-cli as our focus was on many things like finding the right <g class="gr_ gr_22 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling ins-del multiReplace" id="22" data-gr-id="22">architectute</g>, developing commands.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>We tried to get the changes from wp-cli 2.0 into EasyEngine but we realized it would take non-trivial effort to do it and so postponed it. Once v4 gets out and things settle down, we will try to keep EasyEngine in sync by periodically pulling changes from it.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>We will also try our best to contribute back any improvements we make to wp-cli, if they make sense to the that project.&nbsp;</p>
<!-- /wp:paragraph -->