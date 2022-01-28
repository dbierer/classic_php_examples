#!/bin/bash
DIR=`pwd`
export USAGE="Usage: init.sh up|down|build|ls|init|shell"
export CONTAINER="classic_php_examples"
if [[ -z "$1" ]]; then
    echo $USAGE
    exit 1
elif [[ "$1" = "up" ||  "$1" = "start" ]]; then
    docker-compose up -d $2
elif [[ "$1" = "down" ||  "$1" = "stop" ]]; then
    docker-compose down
    echo "Resetting permissions ..."
    sudo chown -R $USER:$USER *
    sudo chmod -R 775 *
    rm 1
elif [[ "$1" = "build" ]]; then
    docker-compose build $2
elif [[ "$1" = "ls" ]]; then
    docker container ls
elif [[ "$1" = "init" ]]; then
    docker exec $CONTAINER /bin/bash -c "/etc/init.d/mysql restart"
    docker exec $CONTAINER /bin/bash -c "/etc/init.d/php-fpm restart"
    docker exec $CONTAINER /bin/bash -c "/etc/init.d/httpd restart"
elif [[ "$1" = "shell" ]]; then
    docker exec -it $CONTAINER /bin/bash
else
    echo $USAGE
    exit 1
fi
exit 0
