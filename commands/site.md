# ee site

Performs site operations. Check `ee help site` for more info.

Invoked function of site-type routing. Called when `ee site` is invoked. Performs the routing to respective site-type passed using either `--type=`, Or discovers the type from the site-name and fetches the type from it, Or falls down to the default site-type defined by the user, Or finally the most basic site-type and the default included in this package, type=html.

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
