# ee auth whitelist

create, append, remove, list ip whitelisting for a site or globally.

### OPTIONS

[&lt;create&gt;]
: Create ip whitelisting for a site or globally.

[&lt;append&gt;]
: Append ips in whitelisting of a site or globally.

[&lt;list&gt;]
: List whitelisted ip's of a site or of global scope.

[&lt;remove&gt;]
: Remove whitelisted ip's of a site or of global scope.

[&lt;site-name&gt;]
: Name of website to be secured / `global` for global scope.

[\--ip=&lt;ip&gt;]
: Comma seperated ips.

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
