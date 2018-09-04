# ee cli check-update

Check to see if there is a newer version of EE available.

Queries the Github releases API. Returns available versions if there are updates available, or success message if using the latest release.

### OPTIONS

[\--patch]
: Only list patch updates.

[\--minor]
: Only list minor updates.

[\--major]
: Only list major updates.

[\--field=&lt;field&gt;]
: Prints the value of a single field for each update.

[\--fields=&lt;fields&gt;]
: Limit the output to specific object fields. Defaults to version,update_type,package_url.

[\--format=&lt;format&gt;]
: Render output in a particular format.
\---
default: table
options:
  - table
  - csv
  - json
  - count
  - yaml
\---

### EXAMPLES

    # Check for update.
    $ ee cli check-update
    Success: EE is at the latest version.

    # Check for update and new version is available.
    $ ee cli check-update
    +---------+-------------+------------------------------------------------------------------------------------------+
    | version | update_type | package_url                                                                              |
    +---------+-------------+------------------------------------------------------------------------------------------+
    | 0.24.1  | patch       | https://github.com/EasyEngine/easyengine/releases/download/v4.0.0-beta.1/easyengine.phar |
    +---------+-------------+------------------------------------------------------------------------------------------+

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
