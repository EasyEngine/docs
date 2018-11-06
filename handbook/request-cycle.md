## Request Cycle

Let's say there are two sites on our server - example-html.com, which is a HTML site and example-wp.com, which is a WordPress site.

## HTML

![ee4 html site diagram](https://user-images.githubusercontent.com/8456197/48013532-86312f80-e14a-11e8-80e9-57b980b09b55.png)

1. User requests for https://example-html.com. The request is received by nginx-proxy on port 443. SSL is terminated here.
2. nginx-proxy forwards the request to site's nginx container on port 80.
3. The site's nginx gives response to nginx-proxy.
4. nginx-proxy forwards the response to user.

## PHP/WordPress Without Cache

![ee4 wp site diagram](https://user-images.githubusercontent.com/8456197/48013529-85000280-e14a-11e8-86fa-551c2d40b020.png)

1. User requests for https://example-wp.com. The request is received by nginx-proxy on port 443. SSL is terminated here.
2. nginx-proxy forwards the request to site's nginx container on port 80.
3. The site's nginx then forwards the request to the site's PHP container.
4. PHP container process the request, and interacts with database if needed
5. PHP container returns the request to site's nginx container
6. The site's nginx forwards the response to nginx-proxy.
7. nginx-proxy forwards the response to user.

## WordPress with Cache

![ee4 wp cached site diagram](https://user-images.githubusercontent.com/8456197/48013530-85989900-e14a-11e8-9c26-dc9eea84f253.png)

1. User requests for https://example-wp.com. The request is received by nginx-proxy on port 443. SSL is terminated here.
2. nginx-proxy forwards the request to site's nginx container on port 80.
3. The site's nginx then forwards the request to redis. 
4. If the request is cached, then redis forwards cached response to site's nginx. 
5. If the request is not cached, the site's nginx forwards the request to PHP.
6. PHP process request and forwards the response to site's nginx which stores the response in cache. 
7. The site's nginx forwards the response to nginx-proxy.
8. nginx-proxy forwards the response to user.
