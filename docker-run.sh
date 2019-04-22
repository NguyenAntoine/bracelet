#!/usr/bin/env bash
docker-compose down
docker rmi bracelet_php
docker-compose build
docker-compose up -d
