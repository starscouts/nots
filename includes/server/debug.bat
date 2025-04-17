@echo off
call php -S 0.0.0.0:8075 -t ../..
call node ./node_modules/pronote-api/bin/server.js