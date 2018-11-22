---
ID: 71878
post_title: Change WordPress Cache
author: Dinesh Jain
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/docs/change-wordpress-cache/
published: true
post_date: 2014-09-24 17:29:33
---
&nbsp;

### **Basic (--basic) to FastCGI (--wpfc)**
```bash
ee site edit example.com
```
**Change following settings:**

**Old value:**
```bash
# WPSINGLE BASIC NGINX CONFIGURATION
include common/php.conf;
```

**New value:**
```bash
# WPSINGLE FAST CGI NGINX CONFIGURATION
include common/wpfc.conf;
```

Your new configuration look like <a href="https://github.com/rtCamp/easyengine/blob/stable/templates/nginx/wp/wpfc.conf">this</a>

**Install Plugins:**

1. Nginx Helper
1. W3 Total Cache

How to configure above plugin: <a title="Click Here" href="https://rtcamp.com/easyengine/docs/commands/site/ee-site-create/standard-wordpress-sites/#configure-plugins">Click Here</a>

### **Super Cache (--wpsc) to FastCGI (--wpfc)**
```bash
ee site edit example.com
```
**Change following settings:**

**Old value:**
```bash
# WPSINGLE WP SUPER CACHE NGINX CONFIGURATION
include common/wpsc.conf;
```

**New value:**
```bash
# WPSINGLE FAST CGI NGINX CONFIGURATION
include common/wpfc.conf;
```

Your new configuration look like <a href="https://github.com/rtCamp/easyengine/blob/stable/templates/nginx/wp/wpfc.conf">this</a>

**Install Plugins:**

1. Nginx Helper
1. W3 Total Cache

How to configure above plugin: <a title="Click Here" href="https://rtcamp.com/easyengine/docs/commands/site/ee-site-create/standard-wordpress-sites/#configure-plugins">Click Here</a>

### **W3 Total Cache (--w3tc) to FastCGI (--wpfc)**
```bash
ee site edit example.com
```
**Change following settings:**

**Old value:**
```bash
# WPSINGLE W3 TOTAL CACHE NGINX CONFIGURATION
include common/w3tc.conf;
```

**New value:**
```bash
# WPSINGLE FAST CGI NGINX CONFIGURATION
include common/wpfc.conf;
```

Your new configuration look like <a href="https://github.com/rtCamp/easyengine/blob/stable/templates/nginx/wp/wpfc.conf">this</a>

**Install Plugins:**

1. Nginx Helper
1. W3 Total Cache

How to configure above plugin : <a title="Click Here" href="https://rtcamp.com/easyengine/docs/commands/site/ee-site-create/standard-wordpress-sites/#configure-plugins">Click Here</a>