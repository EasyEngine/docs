# List of Github Repos on EasyEngine Organization

The main repository for EasyEngine is at [easyengine/easyengine](https://github.com/EasyEngine/easyengine). It contains CLI framework for EasyEngine and other helpful functions and utilities that other packages or commands can use|

## Commands

Individual commands of EasyEngine v4 have their own repository. Here is a list of them:

| Repository | Descripton |
| ---------- | ---------- |
| [easyengine/site-command](https://github.com/EasyEngine/site-command) | Used to manage sites |
| [easyengine/cron-command](https://github.com/EasyEngine/cron-command) | Used to create cron on a site or on host |
| [easyengine/shell-command](https://github.com/EasyEngine/shell-command) | Used to access site's shell |
| [easyengine/service-command](https://github.com/EasyEngine/service-command) | Used to manage global services like `nginx-proxy`, global database etc.. |
| [easyengine/mailhog-command](https://github.com/EasyEngine/mailhog-command) | Used to add/remove mailhog on site |
| [easyengine/config-command](https://github.com/EasyEngine/config-command)   | Used to add/remove config from EasyEngine's global configuration file |
| [easyengine/admin-tools-command](https://github.com/EasyEngine/admin-tools-command) | Used to enable/disable admin-tools on a site |
| [easyengine/auth-command](https://github.com/EasyEngine/site-command) | Used to manage http auth on site and admin-tools |

## Site Types

There are also seperate repos for "site types". They extend site-command and have logic to create a particular type of site:

| Repository | Descripton |
| ---------- | ---------- |
| [easyengine/site-command](https://github.com/EasyEngine/site-command) | Site-command repo has logic to manage HTML site |
| [easyengine/site-type-php](https://github.com/EasyEngine/site-type-php) | Contains logic to manage PHP site |
| [easyengine/site-type-wp](https://github.com/EasyEngine/site-type-wp) | Contains logic to manage WP site |

Note: Site-command has the logic to manage default site type as it's the default site type. When you don't pass any type to `ee site create`, it creates a HTML site. 

## Other Repos

Here are other repos used by EasyEngine team:

| Repository | Descripton |
| ---------- | ---------- |
| [easyengine/dockerfiles](https://github.com/EasyEngine/dockerfiles) | Contains all the Dockerfiles used in EasyEngine|
| [easyengine/easyengine-builds](https://github.com/EasyEngine/easyengine-builds) | Contains build artifacts of EasyEngine. Stable and nightly phars are kept here |
| [easyengine/installer](https://github.com/EasyEngine/installer) | Contains the installer scripts for EasyEngine |
| [easyengine/docs](https://github.com/EasyEngine/handbook) | Contains code to generate automated documentation from docblocks and has other static documentation |