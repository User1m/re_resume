#!/bin/bash

if [ -z "$1" ]; then
    echo "missing env mode [dev, prod]"
    exit 1;
fi

if [ "$1" == 'prod' ]; then
    docker run --rm -itd \
    --env-file "$PROJECT_DIR"/.env \
    -p 8082:8082 \
    --name resume \
    $IMAGE_TAG
    # --restart always \
else
    docker run --rm -it \
    -v "$PROJECT_DIR"/.:/workdir/app \
    --env-file "$PROJECT_DIR"/.env \
    -p 8082:8082 \
    --name resume \
    $IMAGE_TAG \
    bash #-c '/start.sh & bash'
    # -v $PROJECT_DIR/re_resume:/var/www/html \
    # -v $PROJECT_DIR/v1.conf:/etc/nginx/sites-available/default.conf \
    # -v /workdir/app/node_modules \
    # --restart always \
fi
