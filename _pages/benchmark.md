---
ID: 49044
post_title: Benchmark
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/benchmark/
published: true
post_date: 2013-10-18 18:55:12
---
This sections covers 3-tools to benchmark webserver (nginx in our case).

In our case, Nginx already has a cached copy of content. You can use static <code>index.html</code> instead. Goal of this test was not to compare to <a href="https://easyengine.io/wordpress-nginx/tutorials/">different wordpress setups</a> or caching techniques A v/s caching technique B.

I just wanted to check how many concurrent requests nginx can handle on given Ubuntu server.

Also for clarity concurrency is not equal to page-views or real-users. I will write more on it someday.

[child-pages]