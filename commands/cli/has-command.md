# ee cli has-command

Detects if a command exists

This commands checks if a command is registered with EE. If the command is found then it returns with exit status 0. If the command doesn't exist, then it will exit with status 1.

### OPTIONS
&lt;command_name&gt;...
: The command

### EXAMPLES

    # The "site delete" command is registered.
    $ ee cli has-command "site delete"
    $ echo $?
    0

    # The "foo bar" command is not registered.
    $ ee cli has-command "foo bar"
    $ echo $?
    1

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
