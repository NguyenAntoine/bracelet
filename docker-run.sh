#!/usr/bin/env bash
docker-compose down -f docker-compose-production.yml
docker rmi bracelet_php
docker-compose build -f docker-compose-production.yml
docker-compose up -f docker-compose-production.yml -d
