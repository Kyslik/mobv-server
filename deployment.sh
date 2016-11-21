#!/bin/bash

# set up alias for git up
# git config --local alias.up '!git remote update -p; git merge --ff-only @{u}'

# /home/visi.sk/sub/mobv-server/artisan in case artisan command needed

git up
composer install --dev --no-suggest -o

