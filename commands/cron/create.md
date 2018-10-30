# ee cron create

Adds a cron job to run a command at specific interval etc.

### OPTIONS

[&lt;site-name&gt;]
: Name of site to run cron on.

\--command=&lt;command&gt;
: Command to schedule.

\--schedule=&lt;schedule&gt;
: Time to schedule. Format is same as Linux cron.

[\--user=&lt;user&gt;]
: User to execute command as.

We also have helper to easily specify scheduling format:

| Entry                  | Description                                | Equivalent To
| -----                  | -----------                                | -------------
| @yearly (or @annually) | Run once a year, midnight, Jan. 1st        | 0 0 1 1 *
| @monthly               | Run once a month, midnight, first of month | 0 0 1 * *
| @weekly                | Run once a week, midnight between Sat/Sun  | 0 0 * * 0
| @daily (or @midnight)  | Run once a day, midnight                   | 0 0 * * *
| @hourly                | Run once an hour, beginning of hour        | 0 * * * *

You may also schedule a job to execute at fixed intervals, starting at the time it's added or cron is run. This is supported by following format:

- @every &lt;duration&gt;

Where duration can be combination of:
   &lt;number&gt;h  - hour
   &lt;number&gt;m  - minute
   &lt;number&gt;s  - second

   So 1h10m2s is also a valid duration

### EXAMPLES

    # Adds a cron job on example.com every 10 minutes
    $ ee cron create example.com --command='wp cron event run --due-now' --schedule='@every 10m'

    # Adds a cron job on example.com every 1 minutes
    $ ee cron create example.com --command='wp cron event run --due-now' --schedule='* * * * *'

    # Adds a cron job on example.com every 1 minutes run as user www-data
    $ ee cron create example.com --command='wp cron event run --due-now' --schedule='* * * * *' --user=www-data

    # Adds a cron job to host running EasyEngine
    $ ee cron create host --command='wp cron event run --due-now' --schedule='@every 10m'

    # Adds a cron job to host running EasyEngine
    $ ee cron create host --command='wp media regenerate --yes' --schedule='@weekly'

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
