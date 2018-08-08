#!/usr/bin/env bash
#DESCRIPTION: execute on app_webserver to provision your environment

rm -rf ./shopware
./tools/sw install:release -r __SW-VERSION__ -i ./shopware --db-host __DB_HOST__ --db-user __DB_USER__ --db-password __DB_PASSWORD__ --db-name __DB_NAME__ --shop-host __SW_HOST__


ln -srf . shopware/custom/plugins/ShopwareEnvironmentVariables

shopware/bin/console sw:firstrunwizard:disable

shopware/bin/console sw:plugin:refresh

shopware/bin/console sw:plugin:install ShopwareEnvironmentVariables
shopware/bin/console sw:plugin:activate ShopwareEnvironmentVariables

shopware/bin/console sw:plugin:install AdvancedMenu
shopware/bin/console sw:plugin:activate AdvancedMenu

shopware/bin/console sw:store:download SwagDemoDataDE
shopware/bin/console sw:plugin:install SwagDemoDataDE

curl -k -L -o ./shopware/custom/plugins/FroshProfiler.zip https://github.com/FriendsOfShopware/FroshProfiler/releases/download/1.3.0/FroshProfiler-1.3.0.zip

cd ./shopware/custom/plugins && unzip FroshProfiler.zip

mysql -u __DB_USER__ -p__DB_PASSWORD__ -h __DB_HOST__ __DB_NAME__ < demo.sql

mysql -u __DB_USER__ -p__DB_PASSWORD__ -h __DB_HOST__ -e "DROP DATABASE IF EXISTS \`__DB_NAME__-test\`"
mysql -u __DB_USER__ -p__DB_PASSWORD__ -h __DB_HOST__ -e "CREATE DATABASE \`__DB_NAME__-test\` DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_unicode_ci"
mysqldump __DB_NAME__ -u __DB_USER__ -p__DB_PASSWORD__ -h __DB_HOST__ | mysql __DB_NAME__-test -u __DB_USER__ -p__DB_PASSWORD__ -h __DB_HOST__

cp _dev-ops/common/shopware-patch/config_debug.php shopware/config_test.php
cp _dev-ops/common/shopware-patch/config_debug.php shopware/config_dev.php