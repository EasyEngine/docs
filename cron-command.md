# EasyEngine/cron-command

Manages cron jobs in EasyEngine

`cron` command contains following subcommand
 * [add](#add)
 * [update](#update)
 * [list](#list)
 * [delete](#delete)
 * [run-now](#run-now)
 
 ## add
 
 Adds a cron job to run a command at specific interval etc.

 ```
 # Adds a cron job on example.com every 10 minutes
 $ ee cron add example.com --command='wp cron event run --due-now' --schedule='@every 10m'
 
 # Adds a cron job on example.com every 1 minutes
 $ ee cron add example.com --command='wp cron event run --due-now' --schedule='* * * * *'
 
 # Adds a cron job to host running EasyEngine
 $ ee cron add host --command='wp cron event run --due-now' --schedule='@every 10m'
 
 # Adds a cron job to host running EasyEngine
 $ ee cron add host --command='wp media regenerate --yes' --schedule='@weekly'
 ```
 
 Also, refer to [possible schedule values](#possible-schedule-values) to know more about it.
 
 ## update
 
 Updates a cron job.
 
 ```
 # Updates site to run cron on
 $ ee cron update 1 --site='example1.com'
 
 # Updates command of cron
 $ ee cron update 1 --command='wp cron event run --due-now'
 
 # Updates schedule of cron
 $ ee cron update 1 --schedule='@every 1m'
 ```
 Also, refer to [possible schedule values](#possible-schedule-values) to know more about it.

 ## list
 
 Lists scheduled cron jobs.
 
 ```
 Lists all scheduled cron jobs
 $ ee cron list --all

 Lists all scheduled cron jobs of example.com
 $ ee cron list example.com
 ```
 
 ## delete
 
 Deletes a cron job
 
 ```
 # Deletes a cron jobs
 $ ee cron delete 1
 ```
 
 ## run-now
 
 Runs a cron job
 
 ```
 # Runs a particular cron job
 $ ee cron run-now 1
 ```

## possible schedule values

 We have helper to easily specify scheduling format:

| Entry                  | Description                                | Equivalent To |
| ---------------------- | ------------------------------------------ | ------------- |
| @yearly (or @annually) | Run once a year, midnight, Jan. 1st        | 0 0 1 1 *     |
| @monthly               | Run once a month, midnight, first of month | 0 0 1 * *     |
| @weekly                | Run once a week, midnight between Sat/Sun  | 0 0 * * 0     |
| @daily (or @midnight)  | Run once a day, midnight                   | 0 0 * * *     |
| @hourly                | Run once an hour, beginning of hour        | 0 * * * *     |

You may also schedule a job to execute at fixed intervals, starting at the time it's added or cron is run.
This is supported by following format:

`@every <duration>`

Where duration can be combination of:
   <number>h  - hour
   <number>m  - minute
   <number>s  - second

   So `1h10m2s` is also a valid duration