# ee cli param-dump

Dump the list of global parameters, as JSON or in var_export format.

### OPTIONS

[\--with-values]
: Display current values also.

[\--format=&lt;format&gt;]
: Render output in a particular format.
\---
default: json
options:
  - var_export
  - json
\---

### EXAMPLES

    # Dump the list of global parameters.
    $ ee cli param-dump --format=var_export
    array (
      'path' =>
      array (
        'runtime' => '=&lt;path&gt;',
        'file' => '&lt;path&gt;',
        'synopsis' => '',
        'default' => NULL,
        'multiple' => false,
        'desc' => 'Path to the WordPress files.',
      ),
      'url' =>
      array (

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
