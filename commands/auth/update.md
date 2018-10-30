# ee auth update

Updates http authentication password for a site.

### OPTIONS

[&lt;site-name&gt;]
: Name of website / `global` for global auth.

[\--user=&lt;user&gt;]
: Username for http auth.

[\--pass=&lt;pass&gt;]
: Password for http auth.

[\--ip=&lt;ip&gt;]
: IP to whitelist.

### EXAMPLES

    # Update auth password on global auth with default username and random password
    $ ee auth update global --user=easyengine

    # Update auth password on site with predefined username and password
    $ ee auth update example.com --user=test --pass=password

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
