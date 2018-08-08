#!/usr/bin/env bash
#DESCRIPTION: create a release package

I: rm -rf ./build/ShopwareEnvironmentVariables
I: rm -rf ./build/ShopwareEnvironmentVariables.zip
mkdir ./build/ShopwareEnvironmentVariables

cp -rv ShopwareEnvironmentVariables.php plugin.xml Source Resources ./build/ShopwareEnvironmentVariables/

cd ./build && zip -r ShopwareEnvironmentVariables.zip ShopwareEnvironmentVariables
