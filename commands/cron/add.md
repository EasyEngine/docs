# ee cron add

Adds a cron job to run a command at specific interval etc.

### OPTIONS

[&lt;site-name&gt;]
: Name of site to run cron on.

\--command=&lt;command&gt;
: Command to schedule.

\--schedule=&lt;schedule&gt;
: Time to schedule. Format is same as Linux cron.

We also have helper to easily specify scheduling format:

 Entry                  | Description                                | Equivalent To
 -----                  | -----------                                | -------------

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
