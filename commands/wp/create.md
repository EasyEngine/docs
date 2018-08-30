# ee wp create

Runs the standard WordPress Site installation.

### OPTIONS

&lt;site-name&gt;
: Name of website.

[\--wp]
: WordPress website.

[\--cache]
: Use redis cache for WordPress.


[\--mu=&lt;subdir&gt;]
: WordPress sub-dir Multi-site.

[\--mu=&lt;subdom&gt;]
: WordPress sub-domain Multi-site.

[\--title=&lt;title&gt;]
: Title of your site.

[\--admin_user=&lt;admin_user&gt;]
: Username of the administrator.

[\--admin_pass=&lt;admin_pass&gt;]
: Password for the the administrator.

[\--admin_email=&lt;admin_email&gt;]
: E-Mail of the administrator.

[\--dbname=&lt;dbname&gt;]
: Set the database name.
\---
default: wordpress
\---

[\--dbuser=&lt;dbuser&gt;]
: Set the database user.

[\--dbpass=&lt;dbpass&gt;]
: Set the database password.

[\--dbhost=&lt;dbhost&gt;]
: Set the database host. Pass value only when remote dbhost is required.
\---
default: db
\---

[\--dbprefix=&lt;dbprefix&gt;]
: Set the database table prefix.

[\--dbcharset=&lt;dbcharset&gt;]
: Set the database charset.
\---
default: utf8
\---

[\--dbcollate=&lt;dbcollate&gt;]
: Set the database collation.

[\--skip-check]
: If set, the database connection is not checked.

[\--version=&lt;version&gt;]
: Select which wordpress version you want to download. Accepts a version number, ‘latest’ or ‘nightly’.

[\--skip-content]
: Download WP without the default themes and plugins.

[\--skip-install]
: Skips wp-core install.

[\--skip-status-check]
: Skips site status check.

[\--letsencrypt]
: Enables ssl via letsencrypt certificate.

[\--force]
: Resets the remote database if it is not empty.

### GLOBAL PARAMETERS

| **Argument**    | **Description**              |
|:----------------|:-----------------------------|
| `--path=<path>` | Path to the WordPress files. |
| `--url=<url>` | Pretend request came from given URL. In multisite, this argument is how the target site is specified. |
| `--ssh=[<scheme>:][<user>@]<host\|container>[:<port>][<path>]` | Perform operation against a remote server over SSH (or a container using scheme of "docker", "docker-compose", "vagrant"). |
| `--http=<http>` | Perform operation against a remote WordPress install over HTTP. |
| `--user=<id\|login\|email>` | Set the WordPress user. |
| `--skip-plugins[=<plugins>]` | Skip loading all plugins, or a comma-separated list of plugins. Note: mu-plugins are still loaded. |
| `--skip-themes[=<themes>]` | Skip loading all themes, or a comma-separated list of themes. |
| `--skip-packages` | Skip loading all installed packages. |
| `--require=<path>` | Load PHP file before running the command (may be used more than once). |
| `--[no-]color` | Whether to colorize the output. |
| `--debug[=<group>]` | Show all PHP errors and add verbosity to WP-CLI output. Built-in groups include: bootstrap, commandfactory, and help. |
| `--prompt[=<assoc>]` | Prompt the user to enter values for all command arguments, or a subset specified as comma-separated values. |
| `--quiet` | Suppress informational messages. |
