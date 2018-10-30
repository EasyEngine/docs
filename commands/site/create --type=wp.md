# ee site create --type=wp

Runs the standard WordPress Site installation.

### OPTIONS

&lt;site-name&gt;
: Name of website.

[\--cache]
: Use redis cache for WordPress.

[\--mu=&lt;subdir&gt;]
: WordPress sub-dir Multi-site.

[\--mu=&lt;subdom&gt;]
: WordPress sub-domain Multi-site.

[\--title=&lt;title&gt;]
: Title of your site.

[\--admin-user=&lt;admin-user&gt;]
: Username of the administrator.

[\--admin-pass=&lt;admin-pass&gt;]
: Password for the the administrator.

[\--admin-email=&lt;admin-email&gt;]
: E-Mail of the administrator.

[\--local-db]
: Create separate db container instead of using global db.

[\--with-local-redis]
: Enable cache with local redis container.

[\--dbname=&lt;dbname&gt;]
: Set the database name.

[\--dbuser=&lt;dbuser&gt;]
: Set the database user.

[\--dbpass=&lt;dbpass&gt;]
: Set the database password.

[\--dbhost=&lt;dbhost&gt;]
: Set the database host. Pass value only when remote dbhost is required.

[\--dbprefix=&lt;dbprefix&gt;]
: Set the database table prefix.

[\--dbcharset=&lt;dbcharset&gt;]
: Set the database charset.
\---
default: utf8mb4
\---

[\--dbcollate=&lt;dbcollate&gt;]
: Set the database collation.

[\--skip-check]
: If set, the database connection is not checked.

[\--version=&lt;version&gt;]
: Select which WordPress version you want to download. Accepts a version number, ‘latest’ or ‘nightly’.

[\--skip-content]
: Download WP without the default themes and plugins.

[\--skip-install]
: Skips wp-core install.

[\--skip-status-check]
: Skips site status check.

[\--ssl=&lt;value&gt;]
: Enables ssl on site.

[\--wildcard]
: Gets wildcard SSL .

[\--force]
: Resets the remote database if it is not empty.

### EXAMPLES

    # Create WordPress site
    $ ee site create example.com --type=wp

    # Create WordPress multisite subdir site
    $ ee site create example.com --type=wp --mu=subdir

    # Create WordPress multisite subdom site
    $ ee site create example.com --type=wp --mu=subdom

    # Create WordPress site with ssl from letsencrypt
    $ ee site create example.com --type=wp --ssl=le

    # Create WordPress site with wildcard ssl
    $ ee site create example.com --type=wp --ssl=le --wildcard

    # Create WordPress site with remote database
    $ ee site create example.com --type=wp --dbhost=localhost --dbuser=username --dbpass=password

    # Create WordPress site with custom site title, locale, admin user, admin email and admin password
    $ ee site create example.com --type=wp --title=easyengine  --locale=nl_NL --admin-email=easyengine@example.com --admin-user=easyengine --admin-pass=easyengine

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
