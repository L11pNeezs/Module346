#!/bin/sh
set -e

# To wait PostGis to be ready
echo '---- Waiting on Postgis to be up'
sleep 5s

echo '---- Launch migration & seed'
php craft migrate -d
php craft seed

apache2-foreground