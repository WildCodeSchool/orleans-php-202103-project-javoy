#!/bin/sh

chmod -R 777 /var/www/public

## server config
php-fpm &
nginx -g "daemon off;"
