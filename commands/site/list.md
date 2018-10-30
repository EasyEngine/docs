# ee site list

Lists the created websites.

abstract list

[\--enabled]
: List only enabled sites.

[\--disabled]
: List only disabled sites.

[\--format=&lt;format&gt;]
: Render output in a particular format.
\---
default: table
options:
  - table
  - csv
  - yaml
  - json
  - count
  - text
\---

### EXAMPLES

    # List all sites
    $ ee site list

    # List enabled sites
    $ ee site list --enabled

    # List disabled sites
    $ ee site list --disabled

    # List all sites in JSON
    $ ee site list --format=json

    # Count all sites
    $ ee site list --format=count

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
