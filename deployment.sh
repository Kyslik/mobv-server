#!/bin/bash

# set up alias for git up
# git config --local alias.up '!git remote update -p; git merge --ff-only @{u}'

git up
composer install
composer dump-autoload -o
php /var/www/html/application/artisan down
php /var/www/html/application/artisan clear-compiled
php /var/www/html/application/artisan cache:clear
php /var/www/html/application/artisan up
