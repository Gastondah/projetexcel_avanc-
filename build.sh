#!/usr/bin/env bash
# exit on error
set -o errexit

composer install --no-dev --optimize-autoloader

# Installation des assets (Tailwind/Vite)
npm install
npm run build

# Cache de configuration et de routes
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Migration de la base de données (SQLite ici)
# Si vous utilisez MySQL sur Render, assurez-vous que la DB est créée avant
php artisan migrate --force