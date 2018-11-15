# Crons in EasyEngine

Most of EasyEngine v4's server stack is on Docker containers. Running cron in containers is not as straightforward as it's on a linux server. There are many caveats that you have to take care of in order to ensure cron executes as it's intended and has no side effects.

Hence, EasyEngine v4 uses [ofelia](https://github.com/mcuadros/ofelia) to schedule and run cron. Ofelia runs in a separate container and it schedules all cron jobs according to a config and when it has to excecute the cron, it runs the command into the target container similar to how we execute commands in container with `docker exec`.

## Adding your cron job to easyengine

### Adding cron on a site

If you want to add cron to a site, use:
```
ee cron create example.com --command='wp core verify-checksums' --schedule='@daily'
```

The above command runs the given command in the site's PHP container daily at midnight. The schedule parameter also accepts linux cron syntax. To checkout the syntax supported by schedule parameter, run `ee cron create --help`.

By default the command executes with the user used to start the container. So in case of PHP container it is `www-data`. If you want to run the cron with another user i.e. root, then you can pass `--user=example` parameter to it.

### Adding cron on host

You can even use EasyEngine to run crons on host! In fact, it is recommended to do so. Primary reason being that you don't want some crons to run from EE and some through crontab as tracking and managing them might become a bit cumbersome when you have lots of cron to manage.

To run cron on host, use:
```
ee cron create host --command='~/backup.sh' --schedule='@daily'
```
