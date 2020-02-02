# Postes Laravel/Vue App

> Laravel 5.5 API that uses the API resources with a Vue.js frontend

## Quick Start

# Install Dependencies
composer install

# Run Migrations
php artisan migrate

# Import Postes
php artisan db:seed

# Add virtual host if using Apache

# If you get an error about an encryption key
php artisan key:generate

# Install JS Dependencies
npm install

# Watch Files
npm run watch

## Endpoints

### List all postes with links and meta
GET api/postes

### Get single poste
GET api/poste/{id}


### Delete poste
DELETE api/poste/{id}


### Add poste
POST api/poste
title/body


### Update poste
PUT api/poste
poste_id/title/body


## App Info

### Author

Zakaria hamidi

### Version

1.0.0

### License

This project is licensed under the MIT License
