#!/usr/bin/env bash
docker-compose -f docker-compose-production.yml down
docker rmi bracelet_php
docker-compose -f docker-compose-production.yml build
docker-compose -f docker-compose-production.yml up -d
