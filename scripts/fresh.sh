#!/bin/bash

php artisan tenancy:delete-tenant all
php artisan migrate:fresh
php artisan tenancy:create-tenant tenant1
