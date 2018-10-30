# ee site_type_wp enable

Enables a website. It will start the docker containers of the website if they are stopped.

### OPTIONS

[&lt;site-name&gt;]
: Name of website to be enabled.

[\--force]
: Force execution of site enable.

[\--verify]
: Verify if required global services are working.

### EXAMPLES

    # Enable site
    $ ee site enable example.com

    # Enable site with verification of dependent global services. (Note: This takes longer time to enable the
    site.)
    $ ee site enable example.com --verify

    # Force enable a site.
    $ ee site enable example.com --force

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
