#!/usr/bin/env bash

chown -R www-data:www-data /usr/src/app/var
/usr/src/app/bin/console doctrine:migrations:migrate -n
