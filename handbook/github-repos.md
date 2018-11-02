# List of Github Repos on EasyEngine Organization

The main repository for EasyEngine is at [easyengine/easyengine](https://github.com/EasyEngine/easyengine). It contains CLI framework for EasyEngine and other helpful functions and utilities that other packages or commands can use.

Individual commands of EasyEngine v4 have their own repository. Here is a list of them:

 * [easyengine/site-command](https://github.com/EasyEngine/site-command) - Used to manage sites.
 * [easyengine/cron-command](https://github.com/EasyEngine/cron-command) - Used to create cron on a site or on host.
 * [easyengine/shell-command](https://github.com/EasyEngine/shell-command) - Used to access site's shell.
 * [easyengine/service-command](https://github.com/EasyEngine/service-command) - Used to manage global services like `nginx-proxy`, global database etc...
 * [easyengine/mailhog-command](https://github.com/EasyEngine/mailhog-command) - Used to add/remove mailhog on site.
 * [easyengine/config-command](https://github.com/EasyEngine/config-command)   - Used to add/remove config from EasyEngine's global configuration file.
 * [easyengine/admin-tools-command](https://github.com/EasyEngine/admin-tools-command) - Used to enable/disable admin-tools on a site.

There are also seperate repos for "site types". They extend site-command and have logic to create a particular type of site:

 * [easyengine/site-type-php](https://github.com/EasyEngine/site-type-php)
 * [easyengine/site-type-wp](https://github.com/EasyEngine/site-type-wp) 

Here are other repos used by EasyEngine team:
 * [easyengine/dockerfiles](https://github.com/EasyEngine/dockerfiles) - Contains all the Dockerfiles used in EasyEngine.
 * [easyengine/easyengine-builds](https://github.com/EasyEngine/easyengine-builds) - Contains build artifacts of EasyEngine. Stable and nightly phars are kept here.
 * [easyengine/installer](https://github.com/EasyEngine/installer) - Contains the installer scripts for EasyEngine.
 * [easyengine/handbook](https://github.com/EasyEngine/handbook) - Contains code to generate automated documentation from docblocks and has other static documentation.