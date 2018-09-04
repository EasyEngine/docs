# ee cron list

Lists scheduled cron jobs.

### OPTIONS

[&lt;site-name&gt;]
: Name of site whose cron will be displayed.

[\--all]
: View all cron jobs.

### EXAMPLES

    # Lists all scheduled cron jobs
    $ ee cron list

    # Lists all scheduled cron jobs of a site
    $ ee cron list example.com

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
