#!/usr/bin/env bash
set -e
chown -R www-data:www-data /usr/src/app/var
/usr/src/app/bin/console doctrine:migrations:migrate -n
/usr/src/app/bin/console doctrine:fixtures:load -n
