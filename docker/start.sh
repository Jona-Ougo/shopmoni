#!/usr/bin/env bash

chown -R www-data:www-data /var/www
service apache2 start

tail -f /var/log/apache2/weika.access.log