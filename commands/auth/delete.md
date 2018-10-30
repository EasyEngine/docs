# ee auth delete

Deletes http authentication for a site. Default: removes http authentication from site. If `--user` is passed it removes that specific user.

### OPTIONS

[&lt;site-name&gt;]
: Name of website / `global` for global scope.

[\--user=&lt;user&gt;]
: Username that needs to be deleted.

[\--ip=&lt;ip&gt;]
: IP to whitelist.

### EXAMPLES

    # Remove auth on site and its admin tools with default username(easyengine)
    $ ee auth delete example.com

    # Remove auth on site and its admin tools with custom username
    $ ee auth delete example.com --user=example

    # Remove global auth on all sites (but not admin tools) with default username(easyengine)
    $ ee auth delete example.com --site

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
