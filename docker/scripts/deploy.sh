#!/bin/bash

# UUID=$(echo $RANDOM | tr '[0-9]' '[a-zA-Z]')  #cfbde
az account set -s "79127f51-3017-480c-a70e-0f3f20694d2e"

DOCKER_IMAGE=user1m/resumeweb:prod
RG=business
APP_SERVICE_PLAN=BizAppServices

az webapp create --resource-group $RG \
--plan $APP_SERVICE_PLAN --name claudiusmbemba --deployment-container-image-name $DOCKER_IMAGE

### https://docs.microsoft.com/en-us/cli/azure/webapp/config/appsettings?view=azure-cli-latest#az_webapp_config_appsettings_set
az webapp config appsettings set --resource-group $RG \
--name claudiusmbemba \
--settings WEBSITES_PORT=80 \
PORT=80 \
WEBSITE_NODE_DEFAULT_VERSION=9.4 \
MAIL_USER=cmmtechskills@outlook.com \
MAIL_PASSWORD=L^8o!995Bo*p9!Lw \

## CI/CD
### https://docs.microsoft.com/en-us/azure/app-service/containers/app-service-linux-ci-cd
# echo "Take the CI_CD_URL below and create a Docker Hub Webhook..."
# az webapp deployment container config --name claudiusmbemba --resource-group $RG --enable-cd true

az webapp restart --resource-group $RG --name claudiusmbemba

### SSH LOCALLY
# https://docs.microsoft.com/en-us/azure/app-service/containers/app-service-linux-ssh-support
# az webapp remote-connection create --resource-group $RG -n cmmtechskills -p 21382 &
# ssh root@127.0.0.1 -p 21382
