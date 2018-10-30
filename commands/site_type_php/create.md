# ee site_type_php create

Runs the standard PHP Site installation.

### OPTIONS

&lt;site-name&gt;
: Name of website.

[\--cache]
: Use redis cache for PHP.

[\--admin-email=&lt;admin-email&gt;]
: E-Mail of the administrator.

 [--with-db]
: Create database for php site.

[\--local-db]
: Create separate db container instead of using global db.

[\--dbname=&lt;dbname&gt;]
: Set the database name.

[\--dbuser=&lt;dbuser&gt;]
: Set the database user.

[\--dbpass=&lt;dbpass&gt;]
: Set the database password.

[\--dbhost=&lt;dbhost&gt;]
: Set the database host. Pass value only when remote dbhost is required.

[\--with-local-redis]
: Enable cache with local redis container.

[\--skip-check]
: If set, the database connection is not checked.

[\--skip-status-check]
: Skips site status check.

[\--ssl=&lt;value&gt;]
: Enables ssl on site.

[\--wildcard]
: Gets wildcard SSL .

[\--force]
: Resets the remote database if it is not empty.

### EXAMPLES

    # Create php site (without db)
    $ ee site create example.com --type=php

    # Create php site with db
    $ ee site create example.com --type=php --with-db

    # Create php site with ssl from letsencrypt
    $ ee site create example.com --type=php --ssl=le

    # Create php site with wildcard ssl
    $ ee site create example.com --type=php --ssl=le --wildcard

    # Create php site with remote database
    $ ee site create example.com --type=php --with-db --dbhost=localhost --dbuser=username --dbpass=password

### GLOBAL PARAMETERS

| **Argument**    | **Description**              |
|:----------------|:-----------------------------|
| `--sites_path=<path>` | Absolute path to where all sites will be stored. |
| `--locale=<locale>` | Locale for WordPress. |
| `--le-mail=<le-mail>` | Mail-id to be used for letsencrypt. |
| `--[no-]color` | Whether to colorize the output. |
| `--debug[=<group>]` | Show all PHP errors; add verbosity to EE bootstrap. |
| `--prompt[=<assoc>]` | Prompt the user to enter values for all command arguments, or a subset specified as comma-separated values. |
| `--quiet` | Suppress informational messages. |
