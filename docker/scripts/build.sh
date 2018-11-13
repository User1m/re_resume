#!/bin/bash

if [ -z "$1" ] || [ "$1" != "dev" ] && [ "$1" != "prod" ]; then
    echo "ERROR: missing env mode [dev, prod]";
    exit 1;
fi

if [ "$1" == 'prod' ]; then
    FILE="$PROJECT_DIR"/docker/Dockerfile
    yarn install
    yarn clean
    # yarn pack:prod
else
    FILE="$PROJECT_DIR"/docker/Dockerfile.dev
fi

docker build -f "$FILE" \
-t $IMAGE_TAG \
"$PROJECT_DIR"/.