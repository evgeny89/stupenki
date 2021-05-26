#!/bin/sh

# Turn on maintenance mode
php artisan down

# Reset local changes
git reset --hard HEAD

# Pull the latest changes from the git repository
git pull origin

# Install/update composer dependencies
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# Migration
php artisan migrate

# Clear caches
php artisan cache:clear

# Clear and cache routes
php artisan route:clear
php artisan route:cache

# Clear and cache config
php artisan config:clear
php artisan config:cache

# Clear and cache views
php artisan view:clear
php artisan view:cache

# Turn off maintenance mode
php artisan up
