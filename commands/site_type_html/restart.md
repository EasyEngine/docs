# ee site_type_html restart

Restarts containers associated with site.

When no service(--nginx etc.) is specified, all site containers will be restarted.

[&lt;site-name&gt;]
: Name of the site.

[\--all]
: Restart all containers of site.

[\--nginx]
: Restart nginx container of site.

### EXAMPLES

    # Restart all containers of site
    $ ee site restart example.com

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
