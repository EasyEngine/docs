---
ID: 71865
post_title: Remote MySQL
author: Dinesh Jain
post_excerpt: ""
layout: page
permalink: https://easyengine.io/docs/remote-mysql/
published: true
post_date: 2014-09-24 17:12:59
---
### **Allow Remote Access:**
If you would like to access remote MySQL server from EasyEngine, You have to adjust some settings on remote MySQL server. 

```bash
vim /etc/mysql/my.cnf

# skip-networking 
bind-address = &lt;PUBLIC_IP_OF_EASYENGINE_SERVER&gt;
```

**Now restart MySQL server:**
```bash
service mysql restart
```

### **Grant Remote Access:**

```bash
mysql -u root -p

mysql &gt; grant all privileges on *.* to &#039;root&#039;@&#039;&lt;PUBLIC_IP_OF_EASYENGINE_SERVER&gt;&#039;  IDENTIFIED BY &#039;REMOTE_MySQL_PASSWORD&#039; with grant option;
mysql&gt; flush privileges;
```

### **Provide Remote MySQL Credential:**
For MySQL credential EasyEngine used `~/.my.cnf` file.
We need to add remote MySQL server details in `~/.my.cnf` file

```bash
vim ~/.my.cnf

[client]
host=<REMOTE_MYSQL_HOST>
user=<REMOTE_MYSQL_USER>
password=<REMOTE_MYSQL_PASSWORD>
```

### **Provide MySQL Grant Host Information:**

```bash
vim /etc/easyengine/ee.conf

[mysql]
    grant-host=<PUBLIC_IP_OF_EASYENGINE_SERVER>
```

### **Install MySQL Client:**
```bash
apt-get update
apt-get install mysql-client
```

### Notes:
We used following variables:

1. REMOTE_MYSQL_HOST = Remote MySQL server IP address/FQDN
1. REMOTE_MYSQL_USER = Remote MySQL server username
1. REMOTE_MYSQL_PASSWORD = Remote MySQL server password
1. PUBLIC_IP_OF_EASYENGINE_SERVER = EasyEngine server public IP address/FQDN
1. REMOTE_MySQL_PASSWORD = Remote MySQL password for root user

If your EasyEngine server don't have static public IP address then 
`PUBLIC_IP_OF_EASYENGINE_SERVER = %`

Now you can create any website with EasyEngine and now EasyEngine used your remote MySQL server for database creation.