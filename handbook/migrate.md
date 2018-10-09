# EE3 to EE4 manual migration steps (To another server)

## Prerequisites

1. Must have root ssh access to both new and old server.
2. SSH Keys of new server must be installed in old server.

## Steps

1. Create site on new server and pass appropriate [flags as required](https://github.com/easyengine/site-type-wp#ee-site-create---typewp)

```bash
ee site create easyengine-io.blr.rtdemo.in --ssl=inherit --type=wp
# ee site create newsite.ext --type=wp             # If we want site to be normal WP site (no mu or SSL)
# ee site create newsite.ext --type=wp --ssl=le    # If we want site to be WP site with SSL
# ee site create newsite.ext --type=wp --mu=subdom # If we want non-ssl subdir MU WP site
# ee site create newsite.ext --type=wp --cache     # If we want non-ssl WP cached site

Note: site will be created in `/opt/easyengine/sites/` directory.
```

2. Take bakup of database on old server.

```bash
wp db export
```

3. Take backup of `wp-config.php` on new server.
4. Rsync files from old server to new server.

```bash
cd /opt/easyengine/sites/easyengine-io.blr.rtdemo.in/app/src
rsync -avP --exclude=wp-config.php --exclude=wp-content/uploads root@aws.rtcamp.com:/var/www/easyengine.io/htdocs/ .
rsync -avP root@aws.rtcamp.com:/var/www/easyengine.io/htdocs/wp-content/uploads/2018/ wp-content/uploads/2018/
rsync -avP root@aws.rtcamp.com:/var/www/easyengine.io/wp-config.php .  # Check if this needs to be done
```

5. Fill Appropriate values in new `wp-config.php` from backup.

6. Import database from new site.

```bash
ee shell
wp db import <filename>
```

7. Run `search-replace` in `ee shell`

```
wp search-replace easyengine.io easyengine-io.blr.rtdemo.in --all-tables --precise

# If the site has SSL, add below line
wp search-replace http://easyengine-io.blr.rtdemo.in https://easyengine-io.blr.rtdemo.in --all-tables --precise
```

8. Run the following which ensures `WP_ALLOW_MULTISITE` is not repeted in `wp-config.php`(This happens due to a bug in ee3)

```bash
sed -i '0,/WP_ALLOW_MULTISITE/{/WP_ALLOW_MULTISITE/d;}' wp-config.php
```

9. Change owner of files

```bash
cd /opt/easyengine/sites/easyengine-io.blr.rtdemo.in/app/src
chown -R www-data:www-data .
```
