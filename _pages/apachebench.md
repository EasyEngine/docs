---
ID: 49046
post_title: apachebench
author: Rahul Bansal
post_excerpt: >
  Using apachebench for web-server
  benchmarking
layout: page
permalink: >
  https://easyengine.io/tutorials/benchmark/apachebench/
published: true
post_date: 2013-10-19 19:02:22
---
<h3>Conventions:</h3>
<ol>
	<li>Target machine - a machine which is being benchmarked</li>
	<li>Host machine - a machine from where benchmark is initiated</li>
</ol>
<strong>Note:</strong>
<ul>
	<li>We can use same machine as target and host machine.</li>
	<li>We can run benchmark from multiple "host machines". In facts more is better.</li>
</ul>
<h3>Install apachebench (apache2-utils)</h3>
Following command will install apachebench (ab command). Run it on host machine from where test is conducted.
<pre>apt-get install apache2-utils</pre>
<h3>Run "htop" on target machine</h3>
Install htop if its not installed already.
<pre>apt-get install htop</pre>
Then simply run <code>htop</code> in a dedicated window/terminal.
<h3>Running Apachebench</h3>
Following example will run apachebench on example.com:
<pre class="no-highlight">ab -n 10000 -c 10000 http://example.com/</pre>
<ul>
	<li>n = number of total requests</li>
	<li>c = number of concurrency (yep, this is same concurrency <a href="http://en.wikipedia.org/wiki/C10k_problem">c10k problem</a> refers to)</li>
</ul>
<h4>Sample output</h4>
Following is sample apachebench output:
<pre class="no-highlight">This is ApacheBench, Version 2.3 &lt;$Revision: 1430300 $&gt;
Copyright 1996 Adam Twiss, Zeus Technology Ltd, http://www.zeustech.net/
Licensed to The Apache Software Foundation, http://www.apache.org/

Benchmarking example.com (be patient)
Completed 1000 requests
Completed 2000 requests
Completed 3000 requests
Completed 4000 requests
Completed 5000 requests
Completed 6000 requests
Completed 7000 requests
Completed 8000 requests
Completed 9000 requests
Completed 10000 requests
Finished 10000 requests

Server Software:        nginx
Server Hostname:        example.com
Server Port:            80

Document Path:          /
Document Length:        109988 bytes

Concurrency Level:      10000
Time taken for tests:   37.977 seconds
Complete requests:      10000
Failed requests:        0
Write errors:           0
Total transferred:      1104220000 bytes
HTML transferred:       1099880000 bytes
Requests per second:    263.31 [#/sec] (mean)
Time per request:       37977.351 [ms] (mean)
Time per request:       3.798 [ms] (mean, across all concurrent requests)
Transfer rate:          28394.29 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:      159  336  92.2    349     481
Processing:  1645 29446 12975.7  36427   37459
Waiting:      155 1029 1972.4    554    8900
Total:       2125 29782 12938.1  36704   37890

Percentage of the requests served within a certain time (ms)
  50%  36704
  66%  37003
  75%  37104
  80%  37159
  90%  37401
  95%  37527
  98%  37618
  99%  37709
 100%  37890 (longest request)</pre>
<h3>Interpreting Results</h3>
Out of all tools I have used apachebench is most unfriendly.

<strong>Failed Request Count</strong>

First, you can ignore length-related "Failed requests" count. HTTP headers can change response length for replies.

<strong>Percentage of the requests served within a certain time (ms)</strong>

If you are subjecting your server to unrealistic load, you should bother for 90% requests.