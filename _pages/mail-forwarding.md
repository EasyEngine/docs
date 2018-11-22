---
ID: 63047
post_title: Forwarding all mails to other email id
author: Rahul Bansal
post_excerpt: >
  Gmail style mail filtering and/or
  forwarding in RoundCube
layout: page
permalink: >
  https://easyengine.io/tutorials/mail/roundcube/mail-forwarding/
published: true
post_date: 2014-04-01 14:19:54
---
You can setup mail forwarding (conditionally as well as unconditionally) using RoundCube filters. This is added by roundcube plugin <a href="http://plugins.roundcube.net/packages/johndoh/sieverules">sieverules</a>.
<h2>Setup Forwarding</h2>
Listed below are steps to forward all emails to other mailbox.
<ol start="0">
	<li>Log into RoundCube (webmail) interface.</li>
	<li>Click on "Personal Settings" in top-right corner.</li>
	<li>Click on "+" sign in bottom-left corner to bring new filter screen.</li>
	<li>Give a name to your filter. In screenshot, I named it "Forward".</li>
	<li>Then under "Filter Rules", select "All messages". You can try other options here as well.</li>
	<li>Then under "Filter Actions", select "Send a copy to" from dropdown menu. It will show a text-input field on right. Just enter destination email address where you want incoming emails to be forwarded.</li>
	<li>Finally, click "Save" button.</li>
</ol>
<h3>Screenshot:</h3>
Steps 1-6, listed above are highlighted in a single screenshot below.

You can click on following image to view bigger version of image.

<a href="https://easyengine.io/wp-content/uploads/2014/04/roundcube-mail-forwarding.jpg"><img class="alignnone size-large wp-image-63049" alt="roundcube-mail-forwarding" src="https://easyengine.io/wp-content/uploads/2014/04/roundcube-mail-forwarding-720x346.jpg" width="620" height="297" /></a>