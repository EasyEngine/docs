# ee cli update

Update EE to the latest release.

Default behavior is to check the releases API for the newest stable version, and prompt if one is available.

Use `--stable` to install or reinstall the latest stable version.

Use `--nightly` to install the latest built version of the develop branch. While not recommended for production, nightly contains the latest and greatest, and should be stable enough for development and staging environments.

### OPTIONS

[\--stable]
: Update to the latest stable release.

[\--nightly]
: Update to the latest built version of the develop branch. Potentially unstable.

[\--yes]
: Do not prompt for confirmation.

### EXAMPLES

    # Update CLI.
    You have version 0.24.0. Would you like to update to 0.24.1? [y/n] y
    Downloading from https://github.com/ee/ee/releases/download/v4.0.0/ee-4.0.0.phar...
    $ ee cli update/download/v0.24.1/ee-0.24.1.phar...
    New version works. Proceeding to replace.
    Success: Updated EE to 0.24.1.

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
