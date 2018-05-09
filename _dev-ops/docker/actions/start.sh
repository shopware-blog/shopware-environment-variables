#!/usr/bin/env bash

echo "COMPOSE_PROJECT_NAME: ${COMPOSE_PROJECT_NAME}"

_dev-ops/docker/containers/scriptcreator.sh
docker-compose build && docker-compose up -d
wait

echo "All containers started successfully"
echo "Web server IP: http://__SW_HOST__"
