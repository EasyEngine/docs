# ee site create

Runs the standard WordPress Site installation.

### OPTIONS

&lt;site-name&gt;
: Name of website.

[\--letsencrypt]
: Enables ssl via letsencrypt certificate.

[\--type=&lt;type&gt;]
: Type of the site to be created. Values: html,php,wp.

[\--skip-status-check]
: Skips site status check.

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
