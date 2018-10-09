# EE3 to EE4 manual migration steps (To another server)

## Prerequisites

1. Must have root ssh access to both new and old server.
2. SSH Keys of new server must be installed in old server.

## Steps

NOTE: Throughout this doument, we refer to `sitename.ext` as name of site on old server and `newsite.ext` is name of site on new server. They can be identical

1. Create site on new server and pass appropriate [flags as required](https://github.com/easyengine/site-type-wp#ee-site-create---typewp)

```bash
ee site create newsite.ext --type=wp #If we want site to be normal WP site (no mu or SSL)
ee site create newsite.ext --type=wp --ssl=le #If we want site to be WP site with SSL
ee site create newsite.ext --type=wp --mu=subdom #If we want non-ssl subdir MU WP site
ee site create newsite.ext --type=wp --cache #If we want non-ssl WP cached site

Note: site will be created in `/opt/easyengine/sites/` directory.
```

2. Take bakup of database on old server (through `wp db export`).
3. Take backup of `wp-config.php` on new server.
4. Rsync files from old server to new server.

```bash

cd /opt/easyengine/sites/newsite.ext/app/src
rsync -avP root@new-server-ip:/var/www/sitename.ext/htdocs/ .
```

5. Import database from new site.

```bash
ee shell
wp db import <filename>
```

6. Run `search-replace` in `ee shell`

```
wp search-replace sitename.ext newsite.ext --all-tables

#If the site has SSL, run the below comannd(after removing the hash ofcourse)
#wp search-replace http://newsite.ext https://newsite.ext --all-tables
```

7. Run `sed -i '0,/WP_ALLOW_MULTISITE/{/WP_ALLOW_MULTISITE/d;}' wp-config.php`
8. Fill Appropriate values in new `wp-config.php` from backup.
9. Change owner of files

```bash
cd /opt/easyengine/sites/example.com/app/src
chown -R www-data:www-data .```
