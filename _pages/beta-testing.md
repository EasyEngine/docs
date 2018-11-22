---
ID: 72122
post_title: Beta Testing
author: Dinesh Jain
post_excerpt: ""
layout: page
permalink: https://easyengine.io/docs/beta-testing/
published: true
post_date: 2014-09-30 16:04:29
---
<img class="alignnone size-full wp-image-72124" src="https://rtcamp.com/wp-content/uploads/2014/09/11d628c2-4002-11e4-9d22-5205ebb49e57.png" alt="11d628c2-4002-11e4-9d22-5205ebb49e57" width="602" height="39" />

### **How to install EasyEngine (ee) beta on fresh server?**
#### **Prerequisite:**
Before install EasyEngine (ee), your system should satisfy our [[Prerequisite]]

#### **Install EasyEngine (ee):**
```bash
wget -qO ee rt.cx/eebeta &amp;&amp; sudo bash ee next
```

#### **Install web server packages:**
```bash
ee stack install
# Another Way
ee stack install web
```
This will install and configure web server packages

#### **Install mail server packages:**
```bash
ee stack install mail
```
This will install and configure mail server packages

#### **Install all packages:**
```bash
ee stack install all
```
This will install and configure web server and mail server packages

Let us know us your beta testing reviews on [![EasyEngine chat](https://badges.gitter.im/rtCamp/easyengine.png)](https://gitter.im/rtCamp/easyengine)