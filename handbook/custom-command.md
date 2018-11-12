# Custom Command Development

With EasyEngine v4, You'll be able to create your own commands for EasyEngine!

:warning: For now, to **develop or run** custom commands you need to clone EasyEngine. This won't be required in future.

## Creating your own commands

1. Clone the EasyEngine repository
```bash
git clone git@github.com:easyengine/easyengine.git 
```

2. Run `composer install` in easyengine directory after this.

3. Clone the [command skeleton repository](https://github.com/EasyEngine/command-template) and rename it to the command you want to create.

4. Update the `name` in the `composer.json` of the  cloned repository. If the name is not updated properly then composer update/install with it will fail.

5. Add below line in `composer.json` in the EasyEngine directory in `require` section:
```json
"author/command-name": "dev-master"
```
Where author can be your github username.

Also, append the following section in the `composer.json` below `require` block:
```json
"repositories": {
    "author/command-name": {
        "type": "path",
        "url": "path/to/your/forked/repository"
    }
}
```

Or, you can add your repository to packagist and run `composer require author/command-name`.

6. Run `composer update` in the core repository after this.
7. After that, try running the default command `hello-world` given in the template, it should give a success message as below by running it from the easyengine repository root:
```bash
$ ./bin/ee hello-world
Success: Hello world.
```

Note: These manual steps for setting up a new EasyEngine command will be replaced by a scaffold command.

## Running third party commands

As EasyEngine does not have support for running external commands with PHAR, you'll have to first clone the repository and perform series of manual steps detailed below. Once we have support for running external commands with PHAR, it will be as simple as `ee package install author/packagename`.

1. Clone the EasyEngine repository
```bash
git clone git@github.com:easyengine/easyengine.git 
```
2. Clone the command's repo.

3. Update the `composer.json` in the EasyEngine directory, add the following in `require`:
```json
"author/command-name": "dev-master"
```

Also, append the following section in the `composer.json` below `require` block:
```json
"repositories": {
    "author/command-name": {
        "type": "path",
        "url": "path/to/cloned/command"
    }
}
```
6. Run `composer update` in the core repository after this.
5. Run the command with
```bash
$ ./bin/ee command
```

## Distributing your commands

To distribute your commands, you just need to put them on github or any other publically accesible git repository.

If someone has to install your commnad, they will have to follow the instructions from [running third party commands](#running-third-party-commands).

## Creating your own site types

In EasyEngine v4, you can create your own site types! If you want to create your own site type, The steps are same as [creating your own commands](#creating-your-own-commands). Just instead of cloning command skeleton repository in step 3, you can clone [site-type-php](https://github.com/EasyEngine/site-type-php/) as a starting point and start customerizing it from there on.

## Custom containers in command/site-type

If you're making your own command or site-type, chances are you might need to run containers of a custom docker image. If that is the case, You need to push the docker image to [docker hub](https://hub.docker.com). After that you need to handle creation, updation and deletion of container through docker commands.

Another way to do it and that's how EasyEngine does is that we generate a `docker-compose.yml` file dynamically and use docker-compose commands since it makes managing multiple containers easy. You can look at code of [Site_PHP_Docker](https://github.com/EasyEngine/site-type-php/blob/develop/src/Site_PHP_Docker.php) and [site-type-php](https://github.com/EasyEngine/site-type-php/blob/develop/src/PHP.php) for reference.