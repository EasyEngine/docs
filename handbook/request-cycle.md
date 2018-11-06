## Request Cycle

Let's say there are two sites on our server - example-html.com, which is a HTML site and example-wp.com, which is a WordPress site.

## HTML

![ee4 site diagram-html](https://user-images.githubusercontent.com/8456197/48045978-86681400-e1b8-11e8-9517-347ae095c26f.png)

1. User requests for https://example-html.com. The request is received by nginx-proxy on port 443. SSL is terminated here.
2. nginx-proxy forwards the request to site's nginx container on port 80.
3. The site's nginx gives response to nginx-proxy.
4. nginx-proxy forwards the response to user.

## PHP/WordPress Without Cache
![ee4 site diagram-wp non cached](https://user-images.githubusercontent.com/8456197/48045977-85cf7d80-e1b8-11e8-889b-df8d744b690e.png)

1. User requests for https://example-wp.com. The request is received by nginx-proxy on port 443. SSL is terminated here.
2. nginx-proxy forwards the request to site's nginx container on port 80.
3. The site's nginx then forwards the request to the site's PHP container.
4. PHP container process the request, and interacts with database if needed
5. PHP container returns the request to site's nginx container
6. The site's nginx forwards the response to nginx-proxy.
7. nginx-proxy forwards the response to user.

## WordPress with Cache

![ee4 site diagram-wp with cache](https://user-images.githubusercontent.com/8456197/48045974-85cf7d80-e1b8-11e8-9ff6-2b0116d2172d.png)

1. User requests for https://example-wp.com. The request is received by nginx-proxy on port 443. SSL is terminated here.
2. nginx-proxy forwards the request to site's nginx container on port 80.
3. The site's nginx then forwards the request to redis. 
4. If the request is cached, then redis forwards cached response to site's nginx. 
5. If the request is not cached, the site's nginx forwards the request to PHP.
6. PHP process request and forwards the response to site's nginx which stores the response in cache. 
7. The site's nginx forwards the response to nginx-proxy.
8. nginx-proxy forwards the response to user.
