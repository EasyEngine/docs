# Migrating From v3

## Migrating Sites

In order to migrate EasyEngine v3 sites to v4, we will provide a migration script which will automate migration of a site.

## Breaking Changes

### Features

In terms of features, following changes have happened:

#### Incoming Emails
Support for incoming emails has been dropped. This was done as maintaining a mailserver is a challenging task, both for site administrators and EasyEngine developers.

#### Cache Types
Support for all cache types other than wpredis - wpfc, w3tc, wpsc has been dropped. This was done as we found out redis covers all the use cases that we need for caching and hence support for other cache types was removed to ease developmental burden.

#### Admin Tools
Earlier admin-tools were accesible from port 22222. Now they will be accessible from `example.com/ee-admin/`. You can have a look at [this issue](https://github.com/EasyEngine/easyengine/issues/1013) to know more about why this change was made.

Also, You now need to enable/disable admin tools for each site using - 
```
ee admin-tools enable <sitename>
```

### Commands

#### Removed commands

Following commands of v3 are removed and hence be no longer supported:

Since only wpredis is support is provided, following commands will be removed:
```
site create <sitename> --wpfc
site create <sitename> --wp3tc
site create <sitename> --wpsc
```

In v4, We do not install anything on host. Hence, many of the v3 commands become irrelavant:
```
stack install
stack migrate
stack purge
stack remove
stack upgrade
```

Also, since admin-tools are not running on a special port, the following command has been removed:
```
ee secure <port>
```

Since individual sites have their own server stack, we've also removed `info` command.
```
info
info --mysql
info --php
info --php7
info --nginx
```

#### Modified commands

| v3 command | v4 command |
| ---------- | ---------- |
| site create <sitename> --wp | site create --type=wp |
| site create <sitename> --php | site create --type=php |
| site create <sitename> --mysql | site create --type=mysql |
| site create <sitename> --html | site create --type=html |
| site update <sitename> --wp | site update --type=wp |
| stack install --admin | admin-tools inst`all |
| stack stop | service disable <servicename> | 
| stack reload | service reload <servicename> |
| stack start | service enable <servicename> |
| stack restart | service restart <servicename> |
| update | cli update |
| secure --auth | auth create |
| secure --ip | auth create --ip |
| update | cli update |
| stack status | Will come after 4.0 |
| site delete <sitename> --db | Will come after 4.0 |
| site delete <sitename> --files | Will come after 4.0 |
| site log <sitename> | Will come after 4.0 |
| site show <sitename> | Will come after 4.0 |
| site edit <sitename> | Will come after 4.0 |
| debug | Will come after 4.0 |
| clean | Will come after 4.0 |
| log | Will come after 4.0 |

#### Unmodified commands

| Command |
| ------- |
| site list |
| site list --enabled |
| site list --disabled |
| site delete <sitename> |
| site enable <sitename> |
| site disable <sitename> |
| site info <sitename> |


#### New commands

| Command |
| ------- |
| mailhog enable <sitename> |
| mailhog disable <sitename> |
| mailhog status <sitename> |
| service enable <service> |
| service disable <service> |
| service reload <service> |
| service restart <service> |
| admin-tools enable <sitename> |
| admin-tools disable <sitename> |
| auth update |
| auth delete |
| auth list |
| cron create <sitename> |
| cron update <sitename> |
| cron list <sitename> |
| cron delete <sitename> |
| cron run-now <sitename> |
| cli check-update |
| cli has-command <command_name> |
| cli info |
| cli self-uninstall |
| cli update |
| cli version |

To know more about mailhog checkout our [documentation on it](mail.md#mailhog).

In v4, there are some services which common for all sites. We've created `service` command to manage these services.

You now need to add crons through EasyEngine. We've created `cron` command to manage these crons. To know more about it, checkout [our documentation on it](cron.md).

