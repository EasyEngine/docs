---
ID: 49052
post_title: Siege
author: Rahul Bansal
post_excerpt: Using siege for web-server benchmarking
layout: page
permalink: >
  https://easyengine.io/tutorials/benchmark/siege/
published: true
post_date: 2013-10-19 19:01:51
---
<span style="font-size: 1.25em; line-height: 1.2em;">Install</span>
<pre>apt-get install siege</pre>
<h3>Run</h3>
<pre class="no-highlight">siege -b -c 1000 -t 30s example.com</pre>
In above command:
<ul>
	<li>-c stands for concurrency. We are using 1000 concurrent connections.</li>
	<li>-t specifies time duration. We are using 30 seconds</li>
	<li>-b is to run siege in benchmark mode. Without it, siege inserts delay between 2 requests.</li>
</ul>
<h3>Sample Output</h3>
<pre class="no-highlight">Lifting the server siege...      done.
Transactions:		        8036 hits
Availability:		       98.66 %
Elapsed time:		       30.62 secs
Data transferred:	      148.16 MB
Response time:		        2.34 secs
Transaction rate:	      262.44 trans/sec
Throughput:		        4.84 MB/sec
Concurrency:		      612.92
Successful transactions:        8036
Failed transactions:	         109
Longest transaction:	       23.83
Shortest transaction:	        0.01

FILE: /var/siege.log
You can disable this annoying message by editing
the .siegerc file in your home directory; change
the directive 'show-logfile' to false.</pre>
<h4>Siege Log</h4>
Can be found in  <code>/var/siege.log</code>