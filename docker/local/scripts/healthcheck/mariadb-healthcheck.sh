#!/bin/bash
set -eo pipefail

if [ "$MYSQL_ROOT_PASSWORD" ] && [ -z "$MYSQL_USER" ] && [ -z "$MYSQL_PASSWORD" ]; then
	# there's no way we can guess what the random MySQL password was
	echo >&2 'healthcheck error: cannot determine random root password (and MYSQL_USER and MYSQL_PASSWORD were not set)'
	exit 0
fi

host="$(hostname --ip-address || echo '127.0.0.1')"
user="${MYSQL_USER:-root}"
export MYSQL_PWD="${MYSQL_PASSWORD:-$MYSQL_ROOT_PASSWORD}"

args=(
	# force mysql to not use the local "mysqld.sock" (test "external" connectibility)
	-h"$host"
	-u"$user"
	--silent
)

if command -v mysqladmin &> /dev/null; then
	if mysqladmin "${args[@]}" ping > /dev/null; then
	    echo "{\"service_type\": \"mariadb\", \"check_type\": 1, \"status\": true, \"date\":"\"`date '+%Y-%m-%d %H:%M:%S'`\""}" >> /application/healthcheck/mariadb-healthcheck.txt
		exit 0
	fi
else
	if select="$(echo 'SELECT 1' | mysql "${args[@]}")" && [ "$select" = '1' ]; then
	    echo "{\"service_type\": \"mariadb\", \"check_type\": 2, \"status\": true, \"date\":"\"`date '+%Y-%m-%d %H:%M:%S'`\""}" >> /application/healthcheck/mariadb-healthcheck.txt
		exit 0
	fi
fi

    echo "{\"service_type\": \"mariadb\", \"status\": false, \"date\":"\"`date '+%Y-%m-%d %H:%M:%S'`\""}" >> /application/healthcheck/mariadb-healthcheck.txt
exit 1