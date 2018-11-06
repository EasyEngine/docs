## Request Cycle

Let's say there are two sites on our server - example-html.com, which is a HTML site and example-wp.com, which is a WordPress site.

## HTML

![ee4 site diagram-html](https://user-images.githubusercontent.com/8456197/48048315-1ca03800-e1c1-11e8-8a38-2ca1c622bae8.png)

1. User requests for https://example-html.com. The request is received by nginx-proxy on port 443. SSL is terminated here.
2. nginx-proxy forwards the request to site's nginx container on port 80.
3. The site's nginx gives response to nginx-proxy.
4. nginx-proxy forwards the response to user.

## PHP/WordPress Without Cache

![ee4 site diagram-wp non cached](https://user-images.githubusercontent.com/8456197/48048312-1ca03800-e1c1-11e8-808e-0fc7d058713a.png)

1. User requests for https://example-wp.com. The request is received by nginx-proxy on port 443. SSL is terminated here.
2. nginx-proxy forwards the request to site's nginx container on port 80.
3. The site's nginx then forwards the request to the site's PHP container.
4. PHP container process the request, and interacts with database if needed
5. PHP container returns the response to site's nginx container
6. The site's nginx forwards the response to nginx-proxy.
7. nginx-proxy forwards the response to user.

## WordPress with Cache

![ee4 site diagram-wp with cache](https://user-images.githubusercontent.com/8456197/48048311-1c07a180-e1c1-11e8-875c-cce8d20c9e26.png)

1. User requests for https://example-wp.com. The request is received by nginx-proxy on port 443. SSL is terminated here.
2. nginx-proxy forwards the request to site's nginx container on port 80.
3. The site's nginx then forwards the request to redis. 
4. If the request is cached, then redis forwards cached response to site's nginx (Skip step 5-8). 
5. If the request is not cached, the site's nginx forwards the request to PHP.
6. PHP process request, and interacts with database if needed.
7. PHP container returns the response to site's nginx.
8. Site's nginx stores the response in cache. 
9. The site's nginx forwards the response to nginx-proxy.
10. nginx-proxy forwards the response to user.
