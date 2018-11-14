## Requirements

* Docker
* Docker-Compose
* PHP CLI (>=7.1)
* PHP Modules - `curl`, `sqlite3`, `pcntl`

## Installing

### Linux

For Linux, we have created an installer script which will install all the dependencies for you. We have tested this on Ubuntu 14.04, 16.04, 18.04 and Debian 8.

```bash
wget -qO ee https://rt.cx/ee4beta && sudo bash ee
```

Even if the script doesn't work for your distribution, you can manually install the dependencies and then run the following commands to install EasyEngine

```bash
wget -O /usr/local/bin/ee https://raw.githubusercontent.com/EasyEngine/easyengine-builds/master/phar/easyengine.phar
chmod +x /usr/local/bin/ee
```

### Tab completions

EasyEngine also comes with a tab completion script for Bash and ZSH. To add it, run the following command - 
```bash
wget -qO ~/.ee-completion.bash https://raw.githubusercontent.com/EasyEngine/easyengine/develop-v4/utils/ee-completion.bash
```

If you use bash, run - 
```bash
echo 'source ~/.ee-completion.bash' >> ~/.bash_profile
source ~/.ee-completion.bash
```

If you use zsh, run - 
```bash
cat <<EOF >> ~/.zshrc
autoload bashcompinit
bashcompinit
source ~/.ee-completion.bash
EOF
source ~/.zshrc
```
