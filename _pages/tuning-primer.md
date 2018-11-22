---
ID: 44946
post_title: 'tuning-primer.sh &#8211; an alternative for mysqltuner'
author: Rahul Bansal
post_excerpt: >
  mysqltuner can go wrong sometimes. So
  its better to have one more tool handy.
  We found tuning-primer more accurate and
  friendly.
layout: page
permalink: >
  https://easyengine.io/tutorials/mysql/tuning-primer/
published: true
post_date: 2013-08-24 17:15:00
---
We are recently using <code>tuning-primer.sh</code> and finding it is better than mysqltuner.
<h2>Insatllation</h2>
<pre class="no-highlight">cd /usr/local/bin
wget https://launchpadlibrarian.net/78745738/tuning-primer.sh
chmod u+x tuning-primer.sh</pre>
mysqltuner looks like giving wrong suggestions sometimes. Also its not mysql 5.6 ready something which we are using everywhere.
<h2>Running</h2>
<pre class="no-highlight">tuning-primer.sh</pre>
For example, mysqltuner on mysql 5.6 ask us to change value of table_cache variable. It is renamed to table_open_cache. So following mysqltuner suggestion blindly can be risky sometimes.

Though, both are good tools. Use both!