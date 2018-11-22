---
ID: 70921
post_title: GeoIP
author: Mitesh Shah
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/php/geoip/
published: true
post_date: 2014-09-10 10:30:07
---
<strong>Install/Setup GeoIP:</strong>
<pre>wget http://geolite.maxmind.com/download/geoip/database/GeoLiteCity.dat.gz	 	 
gunzip GeoLiteCity.dat.gz	 	 
sudo mkdir -v /usr/share/GeoIP	 	 
sudo mv -v GeoLiteCity.dat /usr/share/GeoIP/GeoIPCity.dat	 	 
</pre>
For PHP5:
<pre>sudo apt-get install php5-geoip</pre>
For PHP7:
<pre>sudo apt-get install php-geoip</pre>
Let's test GeoIP:
Add following lines in php
<pre>print_r (geoip_db_get_all_info());	 	 
var_dump(geoip_record_by_name($_SERVER['REMOTE_ADDR']));	 	 
var_dump(geoip_record_by_name('www.example.com'));	 	 
</pre>