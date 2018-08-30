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
 @yearly (or @annually) | Run once a year, midnight, Jan. 1st        | 0 0 1 1 *
 @monthly               | Run once a month, midnight, first of month | 0 0 1 * *
 @weekly                | Run once a week, midnight between Sat/Sun  | 0 0 * * 0
 @daily (or @midnight)  | Run once a day, midnight                   | 0 0 * * *
 @hourly                | Run once an hour, beginning of hour        | 0 * * * *

You may also schedule a job to execute at fixed intervals, starting at the time it's added or cron is run. This is supported by following format:

### GLOBAL PARAMETERS

| **Argument**    | **Description**              |
|:----------------|:-----------------------------|
| `--path=<path>` | Path to the WordPress files. |
| `--url=<url>` | Pretend request came from given URL. In multisite, this argument is how the target site is specified. |
| `--ssh=[<scheme>:][<user>@]<host\|container>[:<port>][<path>]` | Perform operation against a remote server over SSH (or a container using scheme of "docker", "docker-compose", "vagrant"). |
| `--http=<http>` | Perform operation against a remote WordPress install over HTTP. |
| `--user=<id\|login\|email>` | Set the WordPress user. |
| `--skip-plugins[=<plugins>]` | Skip loading all plugins, or a comma-separated list of plugins. Note: mu-plugins are still loaded. |
| `--skip-themes[=<themes>]` | Skip loading all themes, or a comma-separated list of themes. |
| `--skip-packages` | Skip loading all installed packages. |
| `--require=<path>` | Load PHP file before running the command (may be used more than once). |
| `--[no-]color` | Whether to colorize the output. |
| `--debug[=<group>]` | Show all PHP errors and add verbosity to WP-CLI output. Built-in groups include: bootstrap, commandfactory, and help. |
| `--prompt[=<assoc>]` | Prompt the user to enter values for all command arguments, or a subset specified as comma-separated values. |
| `--quiet` | Suppress informational messages. |
