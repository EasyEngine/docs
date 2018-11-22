---
ID: 62583
post_title: Site Migration
author: Mitesh Shah
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/docs/site-migration/
published: true
post_date: 2014-03-24 12:12:46
---
<span style="font-family: inherit; font-size: inherit; font-weight: inherit; line-height: 1.75;">Migration process is divided into following parts</span>
<ol>
 	<li>Setup Server</li>
 	<li>Create Website</li>
 	<li>Copy Web-root</li>
 	<li>Import Database</li>
 	<li>DNS</li>
</ol>
<em>NOTE: We used the 1.1.1.1 as old server ip-address and 2.2.2.2 as new server ip-address in this article you need to change this values.</em>
<h2>Setup Server</h2>
First log in to new server and install EasyEngine
<pre class="bash">wget -qO ee rt.cx/ee &amp;&amp; sudo bash ee
ee stack install</pre>
Above two commands install all the dependency and EasyEngine.
<h2>Create Website</h2>
By default, EasyEngine automatically created database, MySQL user/password for the domain name like example_com

We can simply force EasyEngine to ask us for the database, MySQL user/pass so we can used same credential we used in old server to avoid manual modification in  wp-config.php file.

<span style="font-family: inherit; font-size: inherit; font-weight: inherit; line-height: 1.75;">Lets modify the /etc/easyengine/ee.conf file to avoid later manual work :)</span>
<pre class="bash">vim /etc/ee/ee.conf</pre>
and set following values
<pre class="bash"># Custom Database Name
db-name = True
# Custom Database User
db-user = True</pre>
Lets create a example.com on new server
<pre class="bash">ee site create example.com --wp</pre>
It will output as follows
<pre class="bash">Creating example.com, Please Wait...
Creating Symbolic Link For example.com
Creating htdocs &amp; logs Directory
Creating Symbolic Link For Logs
Downloading WordPress, Please Wait...
Enter The MySQL Database Name [example_com]: example.com
Enter The MySQL Database Username [example_com]: exampleuser
Enter The MySQL Database Password [73kWK4MpRiXjuvo]: mypass

Setting Up WordPress, Please Wait...
Updating WordPress Permalink, Please Wait...
Installing Nginx Helper Plugin, Please Wait...
Changing Ownership
Reloading Nginx Configuration, Please Wait...
Take /etc/nginx 
Configuration In Git Version Control...

WordPress Admin Username: admin
WordPress Admin Password: HelloExample
Successfully Created New Website: http://example.com</pre>
<h2>Copy Webroot</h2>
Now example.com is ready on new server but we still need old server data

Lets copy the web-root from old server to the new server
<pre class="bash">cd /var/www/example.com/htdocs
rm -rf *
rsync -avz --progress root@1.1.1.1:/var/www/example.com/htdocs/* .
</pre>
<em><b>Note:</b> do not forget the "." dot at the end. </em>

Now we copy the web-root from old server to the new server.
<h2>Import Database</h2>
Take mysqldump on old server
<pre class="bash">mysqldump -u root -p example.com &gt; /tmp/example.com.sql
</pre>
Lets copy and import the MySQL dump on new server
<pre class="bash">rsync -avz --progress root@1.2.3.4:/tmp/example.com.sql /tmp
pv /tmp/example.com.sql | mysql example.com</pre>
As of now we have same web-root and database as old server.
<h2>Point DNS</h2>
Lets test the site before pointing DNS

You need to modify your local system <code>/etc/hosts</code> file
<pre class="bash">vim /etc/hosts</pre>
and add following line into it
<pre class="bash">2.2.2.2 example.com www.example.com</pre>
Lets open example.com in your web-browser to test and if all looks good point DNS to the new server ip-address.

As per our roadmap the <a href="https://github.com/rtCamp/easyengine/issues?milestone=8&amp;state=open" target="_blank">EasyEngine Migration Release</a> do all the above stuff with single command like
<pre class="bash">ee site copy old-server-ip new-server-ip</pre>
<em> NOTE:  This feature is not yet completed</em>