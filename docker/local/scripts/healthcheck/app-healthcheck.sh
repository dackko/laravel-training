#!/bin/bash
set -eo pipefail

if service nginx status; then
    echo "{\"service_type\": \"nginx\", \"status\": true, \"date\":"\"`date '+%Y-%m-%d %H:%M:%S'`\"", \"output\": \"`service nginx status`\"}" >> /application/healthcheck/app-healthcheck.txt
else
    echo "{\"service_type\": \"nginx\", \"status\": false, \"date\":"\"`date '+%Y-%m-%d %H:%M:%S'`\"", \"output\": \"`service nginx status`\"}" >> /application/healthcheck/app-healthcheck.txt
    exit 1
fi

if supervisorctl status consumer |grep -q "STOPPED"; then
    echo "{\"service_type\": \"supervisor\", \"status\": false, \"task\": \"consumer\",\"date\":"\"`date '+%Y-%m-%d %H:%M:%S'`\"", \"output\": \"`supervisorctl status consumer`\"}" >> /application/healthcheck/app-healthcheck.txt
    exit 1
else
    echo "{\"service_type\": \"supervisor\", \"status\": true, \"task\": \"consumer\",\"date\":"\"`date '+%Y-%m-%d %H:%M:%S'`\"", \"output\": \"`supervisorctl status consumer`\"}" >> /application/healthcheck/app-healthcheck.txt

fi

if supervisorctl status nginx |grep -q "STOPPED"; then
    echo "{\"service_type\": \"supervisor\", \"status\": false, \"task\": \"nginx\",\"date\":"\"`date '+%Y-%m-%d %H:%M:%S'`\"", \"output\": \"`supervisorctl status nginx`\"}" >> /application/healthcheck/app-healthcheck.txt
    exit 1
else
    echo "{\"service_type\": \"supervisor\", \"status\": true, \"task\": \"nginx\",\"date\":"\"`date '+%Y-%m-%d %H:%M:%S'`\"", \"output\": \"`supervisorctl status nginx`\"}" >> /application/healthcheck/app-healthcheck.txt

fi

if supervisorctl status php-fpm |grep -q "STOPPED"; then
    echo "{\"service_type\": \"supervisor\", \"status\": false, \"task\": \"php_fpm\",\"date\":"\"`date '+%Y-%m-%d %H:%M:%S'`\"", \"output\": \"`supervisorctl status php-fpm`\"}" >> /application/healthcheck/app-healthcheck.txt
    exit 1
else
    echo "{\"service_type\": \"supervisor\", \"status\": true, \"task\": \"php_fpm\",\"date\":"\"`date '+%Y-%m-%d %H:%M:%S'`\"", \"output\": \"`supervisorctl status php-fpm`\"}" >> /application/healthcheck/app-healthcheck.txt

fi

exit 0