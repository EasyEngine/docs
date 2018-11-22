---
ID: 71875
post_title: Prevent MySQL crashing
author: Dinesh Jain
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/docs/prevent-mysql-crashing/
published: true
post_date: 2014-09-24 17:22:58
---
## Prevent MySQL crashing issue

On our support forum and GitHub issue tracker, we are seeing some are facing MySQL crashing issue. This issue is commonly observed on Digital Ocean 512 plan.
We are still working on preventing MySQL crash, below are some common points and measures observed.

## 1. Low Swap Memory
For all VPS we recommend at least 1GB swap.

How to create SWAP: <a href="https://www.digitalocean.com/community/tutorials/how-to-add-swap-on-ubuntu-14-04" target="_blank">https://www.digitalocean.com/community/tutorials/how-to-add-swap-on-ubuntu-14-04</a>

## 2. Adjusting PHP5-FPM pm.max_children:
By default EasyEngine sets this values to 100, thanks to Kym for pointing, on low RAM VPS, for high traffic PHP5-FPM takes nearly all RAM, leaving no RAM to MySQL

Change PHP5-FPM pm.max_children:
Open www\.conf file:
```bash
vim /etc/php5/fpm/www.conf
```

For 512MB - 1GB RAM:
```bash
pm.max_children = 10
```

For 2GB RAM:
```bash
pm.max_children = 20
```

For 4GB RAM:
```bash
pm.max_children = 50
```

After that you need to restart PHP5-FPM
```bash
php5-fpm -t &amp;&amp; service php5-fpm restart
```

## 3. Tuning MySQL
Tuning MySQL is always good practice. You can use following command to get MySQL tuning suggestions.
* MySQL Tunner
```bash
mysqltuner
```
* Tuning Primer
```bash
tuning-primer.sh
```
Adjust the MySQL values as per suggestions in my.cnf file
```bash
vim /etc/mysql/my.cnf
```
and restart MySQL
```bash
service mysql restart
```

***

If you still facing MySQL crashing issue, we are always ready to help you, for this you can use this thread: <a href="https://github.com/rtCamp/easyengine/issues/244" target="_blank">#244</a>