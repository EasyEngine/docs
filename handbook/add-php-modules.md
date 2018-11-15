# Add New PHP Module to Docker Image

Currently our PHP Image has following modules:

```
[PHP Modules]
Core
ctype
curl
date
dom
fileinfo
filter
ftp
gd
hash
iconv
imagick
json
libxml
mbstring
mcrypt
memcache
memcached
mysqli
mysqlnd
openssl
pcre
PDO
pdo_sqlite
Phar
posix
readline
redis
Reflection
session
SimpleXML
sodium
SPL
sqlite3
standard
tokenizer
xml
xmlreader
xmlwriter
Zend OPcache
zip
zlib

[Zend Modules]
Zend OPcache
```

If you wish to add a new module, refer to documentation on [docker-images repository](https://github.com/docker-library/docs/blob/master/php/README.md#how-to-install-more-php-extensions). It will guide you on how to add an extension.