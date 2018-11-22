---
ID: 49067
post_title: httperf
author: Rahul Bansal
post_excerpt: >
  Using httperf for web-server
  benchmarking
layout: page
permalink: >
  https://easyengine.io/tutorials/benchmark/httperf/
published: true
post_date: 2013-10-19 19:38:12
---
<h3>Installation</h3>
<pre class="no-highlight"><del>apt-get install httperf</del></pre>
Ubuntu builtin package results in following warning:
<p class="alert warning">httperf: warning: open file limit &gt; FD_SETSIZE; limiting max. # of open files to FD_SETSIZE</p>
We patched httpref source code on our end to fix that warning. Run following commands to install httperf:
<pre class="no-highlight">wget https://github.com/rtCamp/httperf/archive/master.zip
unzip master.zip
cd httperf-master
autoreconf -i
mkdir build
cd build
../configure
make 
make install</pre>
<h4>Verify Build</h4>
Run following command:
<pre class="no-highlight">httperf -v | grep open</pre>
It will show something like:
<pre>httperf: maximum number of open descriptors = 500000</pre>
Where 500000 is open file limit. It should be high enough. You can <a title="Increase open file type" href="https://easyengine.io/tutorials/linux/increase-open-files-limit/">increase if by following this guide</a>.
<h3>Run</h3>
<pre class="no-highlight">httperf --server example.com --port 80 --num-conns 1000 --rate 1000</pre>
You can add <code>--hog</code> parameter as well. This will try to use as many TCP connection as possible from host machine.
<h3>Output</h3>
Below is sample output
<pre class="no-highlight">httperf --client=0/1 --server=rtcamp.com --port=80 --uri=/ --rate=1000 --send-buffer=4096 --recv-buffer=16384 --num-conns=1000 --num-calls=1
Maximum connect burst length: 3

Total: connections 1000 requests 1000 replies 1000 test-duration 1.337 s

Connection rate: 747.9 conn/s (1.3 ms/conn, &lt;=203 concurrent connections)
Connection time [ms]: min 5.9 avg 115.8 max 438.5 median 97.5 stddev 81.3
Connection time [ms]: connect 0.8
Connection length [replies/conn]: 1.000

Request rate: 747.9 req/s (1.3 ms/req)
Request size [B]: 68.0

Reply rate [replies/s]: min 0.0 avg 0.0 max 0.0 stddev 0.0 (0 samples)
Reply time [ms]: response 105.0 transfer 10.1
Reply size [B]: header 498.0 content 107982.0 footer 2.0 (total 108482.0)
Reply status: 1xx=0 2xx=1000 3xx=0 4xx=0 5xx=0

CPU time [s]: user 0.05 system 1.26 (user 3.9% system 94.2% total 98.1%)
Net I/O: 79282.9 KB/s (649.5*10^6 bps)

Errors: total 0 client-timo 0 socket-timo 0 connrefused 0 connreset 0
Errors: fd-unavail 0 addrunavail 0 ftab-full 0 other 0</pre>
<h3>Interpretation</h3>
Most important is "Reply status" line:
<pre>Reply status: 1xx=0 2xx=1000 3xx=0 4xx=0 5xx=0</pre>
As you can see we received 2xx i.e. OK status for all requests.
<h3>Resources:</h3>
<ol>
	<li><a href="http://mervine.net/performance-testing-with-httperf">http://mervine.net/performance-testing-with-httperf</a></li>
	<li><a href="http://www.akamaras.com/linux/stress-test-your-web-server-with-httperf/">http://www.akamaras.com/linux/stress-test-your-web-server-with-httperf/</a></li>
</ol>