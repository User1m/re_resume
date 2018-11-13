#!/bin/bash

if [ -z "$1" ] || [ "$1" != "dev" ] && [ "$1" != "prod" ]; then
    echo "ERROR: missing env mode [dev, prod]"
    exit 1
fi

docker rmi -f $(docker images -f dangling=true) || true
# https://stackoverflow.com/questions/32490229/how-can-i-delete-docker-images-by-tag-preferably-with-wildcarding
docker rmi -f $(docker images | grep 'resume-' | tr -s ' ' | cut -d ' ' -f 3) || true
IDS=$(docker ps | grep 'resume-' | tr -s ' ' | cut -d ' ' -f 1)
docker stop $IDS || true
docker rm $IDS || true
# sleep 10

export SCRIPT_DIR=$(cd $( dirname "${BASH_SOURCE[0]}" ) && pwd)/../../
export PROJECT_DIR=$(printf "$(cd "${SCRIPT_DIR}"  && pwd)")
# export UUID=$(echo $RANDOM | tr '[0-9]' '[a-zA-Z]')
export IMAGE_TAG="resumeweb" #:$1-$UUID"

# solution to trying to source environment variables in npm script
source "$PROJECT_DIR"/docker/scripts/build.sh $1
if [ -z "$2" ] || [ "$2" != "build" ]; then
    source "$PROJECT_DIR"/docker/scripts/run.sh $1
fi