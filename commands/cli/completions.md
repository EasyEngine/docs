# ee cli completions

Generate tab completion strings.

### OPTIONS

\--line=&lt;line&gt;
: The current command line to be executed.

\--point=&lt;point&gt;
: The index to the current cursor position relative to the beginning of the command.

### EXAMPLES

    # Generate tab completion strings.
    $ ee cli completions --line='ee eva' --point=100
    eval
    eval-file

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
