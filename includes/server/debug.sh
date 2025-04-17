#!/usr/bin/env bash

php -S 0.0.0.0:8075 -t ../..&
./node_modules/pronote-api/bin/server.js $@