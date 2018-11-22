---
ID: 56387
post_title: EasyEngine Config File
author: Mitesh Shah
post_excerpt: >
  EasyEngine config file documentation.
  You can tweak site creation behavior and
  few more things using this config file.
layout: page
permalink: https://easyengine.io/docs/config/
published: true
post_date: 2014-01-27 19:21:42
---
EasyEngine Config file is stored at
```bash
/etc/easyengine/ee.conf
```
Above is global config file. There is no support for per-linux-user config values as of now.

***

## **EasyEngine Config file options:**
### 1. **stack section**
#### apt-get-assume-yes
Automatically assume “yes” for packages install, remove or purge through apt-get used internally via EasyEngine.

It doesn’t behavior of apt-get command run manually or directly by you.

**Valid Values:**
* true => assume yes as user confirmation (default)
* false => ask for the user confirmation
 
#### gpg-key-fix
When you face gpg-key verification error, if this option is true, EasyEngine can try another mirror and fetch the key.

**Valid Values:**
* false => don’t fix automatically (default)
* true => fix automatically

#### ip-address
Comma separeated IP address are used for debugging site and whitelisting for EasyEngine admin port (22222)

[ee secure --port](https://rtcamp.com/easyengine/docs/commands/ee-secure/#changing-admin-port) command can be used to change IP adderess

**Valid Values:** Comma separated IP addresses

### 2. **mysql section**

#### host
Default value for mysql host to be used. Useful if mysql server is on different machine.

**Valid Values:** Any IP/Hostname. Default is “localhost”.

#### db-name
EasyEngine create database automatically for wordpress as well as MySQL sites where database-name is based on domain name provided to ```ee site create``` command.

If you like to specify database name manually, set this value to true.

**Valid Values:**
* false => set databasename based on site-name being created (default)
* true => supply database name, if required, manually during site creation process.

#### db-user
EasyEngine create a new MySQL user automatically for wordpress as well as MySQL sites where MySQL username is based on domain name provided to ```ee site create``` command.

If you like to specify MySQL username manually, set this value to true.
**Valid Values:**
* false => create MySQL user based on site-name being created (default)
* true => supply MySQL username name, if required, manually during site creation process.

### 3. **wordpress section**
#### prefix
By default EasyEngine uses wp_ as default WordPress table prefix.
If you like to specify WordPress prefix manually, set this value to true

**Valid Values:**
* false => Use WordPress table prefix as wp_ (default)
* true => supply WordPress table prefix, if required, manually during site creation process.

#### user
By default EasyEngine uses admin as WordPress first user (admin user).

You can change it to any name.

For example, if you want to make rtcamp as default WordPress admin username, then set ```user = rtcamp```

**Valid Values:** Any string. Default is “admin”.

#### password
By default EasyEngine generate random password for WordPress admin user.

You can change it to any string.

For example, if you want to make rtcamp as default WordPress admin password, then set ```password = rtcamp```

**Valid Values:** Any string.

#### email
By default EasyEngine uses ```git config user.email``` as email address for default WordPress username 

EasyEngine prompts for email address at the time of installation. If you haven’t specified it correctly, you can change it to any valid email address.

For example, if you want to make admin@rtcamp.com as default WordPress admin email, then set ```email = admin@rtcamp.com```

**Valid Values:** Any email