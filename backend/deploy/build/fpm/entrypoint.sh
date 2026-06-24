#!/bin/sh

# Load .env
set -a
. /var/www/.env

php-fpm -D

if [ -d "/docker-entrypoint.d/" ]; then
    for f in /docker-entrypoint.d/*; do
        if [ -f "$f" ]; then
            case "$f" in
                *.sh)
                    echo "Running $f"
                    /bin/sh "$f"
                    ;;
                *)
                    ;;
            esac
        fi
    done
fi

nginx -g "daemon off;"
