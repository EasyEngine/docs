## Request Cycle

Let's say there are two sites on our server - example-html.com, which is a WordPress site and example-wp.com, which is a HTML site.

## HTML

1. User requests for https://example-html.com. The request is received by nginx-proxy on port 443. SSL is terminated here.
2. nginx-proxy forwards the request to site's nginx container on port 80.
3. The site's nginx gives response to nginx-proxy.
4. nginx-proxy forwards the response to user.

## PHP/WordPress Without Cache

1. User requests for https://example-wp.com. The request is received by nginx-proxy on port 443. SSL is terminated here.
2. nginx-proxy forwards the request to site's nginx container on port 80.
3. The site's nginx then forwards the request to the site's PHP container.
4. PHP container process the request, and interacts with database if needed
5. PHP container returns the request to site's nginx container
6. The site's nginx forwards the response to nginx-proxy.
7. nginx-proxy forwards the response to user.

## WordPress with Cache

1. User requests for https://example-wp.com. The request is received by nginx-proxy on port 443. SSL is terminated here.
2. nginx-proxy forwards the request to site's nginx container on port 80.
3. The site's nginx then forwards the request to redis. 
4. If the request is cached, then redis forwards cached response to site's nginx. 
5. The site's nginx forwards the response to nginx-proxy.
6. nginx-proxy forwards the response to user.
