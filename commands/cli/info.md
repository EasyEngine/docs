# ee cli info

Print various details about the EE environment.

Helpful for diagnostic purposes, this command shares:

* OS information.
* Shell information.
* PHP binary used.
* PHP binary version.
* php.ini configuration file used (which is typically different than web).
* EE root dir: where EE is installed (if non-Phar install).
* EE global config: where the global config YAML file is located.
* EE project config: where the project config YAML file is located.
* EE version: currently installed version.

See [config docs](https://ee.org/config/) for more details on global and project config YAML files.

### OPTIONS

[\--format=&lt;format&gt;]
: Render output in a particular format.
\---
default: list
options:
  - list
  - json
\---

### EXAMPLES

    # Display various data about the CLI environment.
    $ ee cli info
    OS:  Linux 4.10.0-42-generic #46~16.04.1-Ubuntu SMP Mon Dec 4 15:57:59 UTC 2017 x86_64
    Shell:   /usr/bin/zsh
    PHP binary:  /usr/bin/php
    PHP version: 7.1.12-1+ubuntu16.04.1+deb.sury.org+1
    php.ini used:    /etc/php/7.1/cli/php.ini
    EE root dir:    phar://ee.phar
    EE packages dir:    /home/person/.ee/packages/
    EE global config:
    EE project config:
    EE version: 1.5.0

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
