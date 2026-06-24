#!/bin/sh

#####################
# INIT
#
# This is script is run after the container and his services is started
# Create other scripts in this directory to run all scripts sorted by name
#
#####################


if [ "${APP_ENV}" != "local" ]; then
    php artisan storage:link
fi
