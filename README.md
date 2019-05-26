# Bracelet

> Projet innovation pour l'EPSI

## Build Setup

``` bash
# install dependencies
yarn install

# serve with hot reload at localhost:8080
yarn serve

# build for production with minification
yarn build

# build for production and view the bundle analyzer report
yarn build --report

# check syntax for javascript optimization
yarn run lint
```
## Deployment

Running on nginx with a [docker let's encrypt nginx proxy](https://github.com/JrCs/docker-letsencrypt-nginx-proxy-companion/wiki/Basic-usage)

``` bash
# build for production with minification
yarn build

# run script docker for linux environment
./docker-run.sh

# run script docker for windows environment
.\docker-run.bat
```

Don't forget to run the commands in this script [run_symfony_commands.sh](/docker/php/run_symfony_commands.sh)
