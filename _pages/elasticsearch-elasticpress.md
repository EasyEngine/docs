---
ID: 134135
post_title: Setup ElasticSearch with ElasticPress
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/wordpress/elasticsearch-elasticpress/
published: true
post_date: 2016-06-27 14:15:55
---
Elastic Search already has docker image available. So lets use that Docker image to setup elastic search with WordPress.

<strong>Step 1: Install docker</strong>

<a href="https://docs.docker.com/engine/installation/linux/ubuntulinux/">https://docs.docker.com/engine/installation/linux/ubuntulinux/</a>

<strong>Step 2: Create an Elastic Search container</strong>
<pre>docker run -d -v "/var/esdata":/usr/share/elasticsearch/data elasticsearch</pre>
<em>Repo url</em>: <a href="https://hub.docker.com/_/elasticsearch/">https://hub.docker.com/_/elasticsearch/</a>

<strong>Step 3: Note docker container ID</strong>
<pre>^_^[root@localhost:~]# docker ps
CONTAINER ID        IMAGE               COMMAND                  CREATED              STATUS              PORTS                NAMES
763fd2ca5532        elasticsearch       "/docker-entrypoint.s"   About a minute ago   Up About a minute   9200/tcp, 9300/tcp   silly_bohr</pre>
<strong>Step 4: Note container's Private IP</strong>
<pre>^_^[root@localhost:~]# docker inspect {container id}</pre>
You will get output something like below:
<pre>...
"Gateway": "172.17.0.1",
<strong>"IPAddress": "172.17.0.2",</strong>
"IPPrefixLen": 16,
"IPv6Gateway": "",
"GlobalIPv6Address": "",
...</pre>
<strong>Step 5: Start Elastic Search Service</strong>

First lets get a shell access to our docker container
<pre>docker exec -t -i 763fd2ca5532 /bin/bash</pre>
<strong>on second step check elastic search services status and start if not running.</strong>
<pre>root@763fd2ca5532:~# service elasticsearch status
elasticsearch is not running ... failed!

root@763fd2ca5532:~# service elasticsearch start
Starting Elasticsearch Server:sysctl: setting key "vm.max_map_count": Read-only file system.

root@763fd2ca5532:~# service elasticsearch status
elasticsearch is running.</pre>
Now lets get out of docker shell:

Check elastic search status from outside.
<pre>^_^[root@localhost:~]# curl http://{Container_IP}:9200
{
"name" : "Bandit",
"cluster_name" : "elasticsearch",
"version" : {
"number" : "2.3.3",
"build_hash" : "218bdf10790eef486ff2c41a3df5cfa32dadcfde",
"build_timestamp" : "2016-05-17T15:40:04Z",
"build_snapshot" : false,
"lucene_version" : "5.5.0"
},
"tagline" : "You Know, for Search"
}</pre>
<strong>Step 6 : Install ElasticPress plugin on wordpress</strong>

Install this plugin on your wordpress site - <a href="https://github.com/10up/ElasticPress">https://github.com/10up/ElasticPress</a>

Add something like this on your <em>wp-config.php. </em>Replace <em>{container_ip}</em> with your docker ip.
<div class="highlight highlight-text-html-php">
<pre><span class="pl-s1"><span class="pl-c1">define</span>( <span class="pl-s"><span class="pl-pds">'</span>EP_HOST<span class="pl-pds">'</span></span>, <span class="pl-s"><span class="pl-pds">'</span>http://{container_ip}:9200<span class="pl-pds">'</span></span> );</span></pre>
</div>
Make sure your elasticpress backened setting is same as below :

<img class="aligncenter wp-image-243 size-full" src="https://prabuddha.me/wp-content/uploads/2016/06/Selection_053.png" alt="Selection_053" width="1114" height="498" />

Run indexing for first time from web setting or use below wp-cli command :
<pre>wp elasticpress index</pre>
<strong>Check Elastic Search STATUS:</strong>

<code>curl http://{container_ip}:9200/_stats</code>