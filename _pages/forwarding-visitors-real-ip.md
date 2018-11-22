---
ID: 38231
post_title: 'Forwarding Visitor&#8217;s Real-IP + Nginx Proxy/Fastcgi backend correctly'
author: Rahul Bansal
post_excerpt: >
  Fix real-ip for backend fastcgi
  applications using fastcgi headers
  method. Also it covers HTTPRealIP module
  based solution where nginx is built with
  it.
layout: page
permalink: >
  https://easyengine.io/tutorials/nginx/forwarding-visitors-real-ip/
published: true
post_date: 2013-05-16 15:35:06
---
Here, we are dealing with 2 nginx servers. A front-end nginx, proxying request to another nginx-server running behind firewall. This backend-nginx is a WordPress setup, using PHP-FPM (fastcgi) on our case. Article is valid for any code/application running behind fastcgi upstream.

To manage security properly, we need to pass-on visitors real-IP to backend-nginx. In backend-nginx, WordPress do some stuff based on user-ip.
<h3>On Front-End Nginx</h3>
First, a portion of Nginx config from front-end proxy
<pre class="nginx">proxy_set_header        X-Real-IP       $remote_addr;
proxy_set_header        X-Forwarded-For $proxy_add_x_forwarded_for;</pre>
With this config, backend-nginx receives extra HTTP  Headers which are passed to fastcgi upstream (PHP/WordPress in our case).

If you see output of <code>phpinfo()</code> you will see extra headers as highlighted below:

<img class="alignnone size-full wp-image-38232" alt="phpinfo()" src="https://easyengine.io/wp-content/uploads/2013/05/phpinfo.png" width="595" height="250" />

The problem with above setup is that fastcgi app running behind backend-nginx, uses <code>REMOTE_ADDR</code> value whenever it needs to deal with visitor IP address.

A solution would be check existence of<code>HTTP_X_REAL_IP</code> and use that value instead. I think WordPress does this for itself but one of our custom plugin was not already doing that. We could either fix it in PHP code, but rather than modifying every piece of PHP code which rely on <code>REMOTE_ADDR</code>, we added following lines inside backend-nginx conf:
<pre class="no-highlight">location ~ \.php$ {
        fastcgi_param REMOTE_ADDR $http_x_real_ip;
        #...other rules
}</pre>
With this change <code>phpinfo()</code> shows correct user IP for<code>REMOTE_ADDR</code> value.

<img class="alignnone size-full wp-image-38233" alt="remote-ip-in-php" src="https://easyengine.io/wp-content/uploads/2013/05/remote-ip-in-php.png" width="594" height="252" />

Now any piece of code, which depend on<code>REMOTE_ADDR</code> value will work as it is!
<h3>Nginx's HTTP Real IP Module</h3>
If you want to do some real-user IP-based stuff in backend, it will NOT work.

Nginx itself will not see real-user IP. Only application/codes behind fastcgi will benefit from above change.

For Nginx, you can simply use variable <code>$http_x_real_ip</code> instead of IP-address.

Below is an example of <code>$http_x_real_ip</code> usage to emulate allow/deny functionality:
<pre class="nginx">        if ($http_x_real_ip != 115.115.82.210) {
                return 403;
        }</pre>
There are cases when a workaround using <code>$http_x_real_ip</code> may not be possible. In those caes, we can use <a href="http://wiki.nginx.org/HttpRealipModule">Nginx's Http Real IP Module</a>.

You can fix real-ip and<code>REMOTE_ADDR</code> by adding a line like below to your backend nginx-config:
<pre class="nginx">        set_real_ip_from   192.168.122.1;</pre>
Make sure you replace 192.168.122.1 with REMOTE_ADDR value that was being received originally. It is IP of proxy-nginx as seen by backend-nginx.

Advantage of Http Real IP Module is that it sets correct IP for nginx config as well as fastcgi backend app in one go. Apart form this, it is secure also.

You can use earlier way if your Nginx is not built with <code>--with-http_realip_module</code> option.

If you have any questions, feel free to check our <a href="https://easyengine.io/support/forum/wordpress-nginx/">Nginx support forum</a>.

<strong>Link:</strong> <a href="https://easyengine.io/wordpress-nginx/tutorials">WordPress-Nginx Tutorials Series</a>