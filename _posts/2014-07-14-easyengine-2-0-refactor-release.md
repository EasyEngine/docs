---
ID: 67736
post_title: 'EasyEngine 2.0 &#8220;Refactor&#8221; Release'
author: Avadhoot Kulkarni
post_excerpt: >
  The most awaited and major update of
  EasyEngine with complete refactoring of
  the code.
layout: post
permalink: >
  https://easyengine.io/blog/easyengine-2-0-refactor-release/
published: true
post_date: 2014-07-14 20:46:46
---
Here comes very much awaited and major update of EasyEngine after <a title="EasyEngine Doctor Release" href="https://easyengine.io/blog/easyengine-1-3-doctor-debug-release/">"Doctor" release (v1.3)</a>

This release comes with complete refactoring of the code keeping developers in mind.
<h2>Refactoring Benefits</h2>
In the previous stable release, <a href="https://github.com/rtCamp/easyengine/blob/v1.3.8/usr/local/sbin/easyengine">main EasyEngine source codes were present in a single file with more than 3000 lines</a>!

<a title="Why refactor" href="https://easyengine.io/blog/easyengine-refueling/#whyrefactor">One major goal of the new release</a> is to divide code into modules and commands scattered over different files.

So now the complete code is divided into multiple functions and files. It is easy to reuse and understand.
<h2>New <code>ee secure</code> command</h2>
By using ee secure command we can easily change the HTTP authentication. EasyEngine admin port can be changed and the list of corresponding IP addresses can be whitlisted.

You can change them one by one or at a time. It adds more security to the setup. Find more info <a title="Wiki" href="https://github.com/rtCamp/easyengine/wiki/Secure">here</a>.
<h2>Renaming <code>ee system</code></h2>
Earlier it used to be
<pre>ee system restart</pre>
which was a bit confusing, if it would restart the whole system or only packages.

So now, it is deprecated with
<pre>ee stack restart</pre>
<h2>Upgrading to EasyEngine 2.0</h2>
To update the EasyEngine, please add following alias in your <code>~/.bashrc</code>
<pre><span class="nb" style="color: #0086b3;">alias </span><span class="nv" style="color: teal;">eeupdate</span><span class="o" style="font-weight: bold;">=</span><span class="s2" style="color: #dd1144;">"wget -qO eeup http://rt.cx/eeup &amp;&amp; sudo bash eeup"</span></pre>
Now Update EasyEngine using command:
<pre>eeupdate</pre>
<h2>Other stuff</h2>
EasyEngine now has <a title="EasyEngine" href="https://github.com/rtCamp/easyengine">more than 1000 commits </a>with total of <a title="Contributors" href="https://github.com/rtCamp/easyengine/graphs/contributors">13 contributors</a> which include 3 full time developers <a title="Mitesh" href="https://github.com/MiteshShah">Mitesh</a>, <a title="Gaurav" href="https://github.com/gau1991">Gaurav</a> and <a title="Harshad" href="https://github.com/harshadyeola">Harshad</a>. Also, <a title="RenzoF" href="https://github.com/RenzoF">RenzoF</a> has contributed to the latest release. Our next milestone is the <a title="Roadmap" href="https://easyengine.io/easyengine/roadmap/">mail server release</a>, which includes email migration tools installation.

If you run into any issue, please catch us on <a href="http://rtcamp.com/support/forum/easyengine">our easyengine support forum</a>.

<strong>Links: </strong><a href="https://easyengine.io/easyengine/">EasyEngine Homepage</a> | <a href="https://github.com/rtCamp/easyengine/">EasyEngine Github Repo</a>