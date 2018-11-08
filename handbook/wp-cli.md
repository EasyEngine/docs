# WP-CLI and EasyEngine

## WP-CLI as a CLI framework

Back when the development of EasyEngine v4 hadn't started, and we had already decided to move away for python and towards PHP, we were looking at how CLI apps were made in PHP and which framework to build v4. We evaluated many options like symphony console, laravel, lumen and wp-cli. Out of all these, the one that fit our needs best was wp-cli.

Here are things we liked about it - 
 * Community familiarity
 * Commands in separate repository
 * Help/Documentation generation directly from code docblocks
 * Extensible


### Community familiarity

Most of the EasyEngine community are WordPress users and hence most of them are familiar with wp-cli. This will mean there will be less learning curve for existing and new EasyEngine users. Also, chances are, if someone has already contributed to wp-cli, they will easily be able to contribute to EasyEngine and vice-versa.

### Commands in separate repository

All commands in wp-cli live in their own repositories. We really liked this way of separating concerns.

### Help/Documentation generation directly from code docblocks

When you type `wp site --help`, the help that you see is being generated from corrosponding class/function's docblock! Hence whenever you make changes in code, to make changes in help/documentation, you don't have to make changes in another directory or repository. You just have to change the docblock and the help text will change.

Further, all readme for all their repositories are generated via automation from docblocks. A setup like this would really ease the burden of maintaining documenetaiton.

### Extensible

wp-cli is also extensible through custom packages. You can develop your own commands and add them to wp-cli easily!

### Result

We decided to use WP-CLI as a base framework on top of which we'll develop EasyEngine v4. So on February 8, 2018, we started off EasyEngine v4 development from wp-cli at [this commit](https://github.com/wp-cli/wp-cli/commit/e683d394f89ce923eac2227e655a01fa0255f925). Hence wp-cli and EasyEngine have parent-child relationship :family_man_boy:. 

## Modifications

After using wp-cli as a base, there are only 3 major modifications that we did to core - 

1. Remove all WordPress specific code.
2. Add support for routing of site types in `ee site` command
3. Add DB wrapper and migrations

Apart from these numerous small modifications were made.

## Current Status

Since the point we started developing v4, we haven't been able to sync up much with wp-cli as our focus was on many things like finding the right architectute, developing commands etc... We tried to get the changes from wp-cli 2.0 into EasyEngine but we realized it would take non-trivial effort to do it and so postponed it. Once v4 gets out and things settle down, we will try to keep EasyEngine in sync by periodically pulling changes from it.