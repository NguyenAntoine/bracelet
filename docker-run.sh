#!/usr/bin/env bash
docker-compose down
docker rmi bracelet
docker-compose build
docker-compose up -d
