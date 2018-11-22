---
ID: 142667
post_title: Build and Release Process
author: Rahul Bansal
post_excerpt: ""
layout: handbook
permalink: >
  https://easyengine.io/handbook/internal/build-and-release/
published: true
post_date: 2018-11-20 12:38:03
---
<!-- wp:paragraph -->
<p>Currently, EasyEngine v4 is in the development stage. Hence the main branch for v4 is <a href="https://github.com/easyengine/easyengine/tree/master-v4">master-v4</a> and the ongoing development branch is <a href="https://github.com/easyengine/easyengine/tree/develop-v4">develop-v4</a>.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>The current build and release process uses <a href="https://travis-ci.org/">Travis-CI</a>.</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul><li><p>Whenever any commit is pushed or merged into the <code>develop-v4</code> branch, it triggers the Travis-CI to generate a <code>nightly phar</code> and commits it to the <a href="https://raw.githubusercontent.com/EasyEngine/easyengine-builds/master/phar/easyengine-nightly.phar">easyengine-builds</a> repository.</p></li><li><p>Similarly, whenever any commit is pushed or merged into the <code>master-v4</code> branch, it triggers the Travis-CI to generate a <code>stable phar</code> and commits it to the <a href="https://raw.githubusercontent.com/EasyEngine/easyengine-builds/master/phar/easyengine.phar">easyengine-builds</a> repository.</p></li></ul>
<!-- /wp:list -->