# Task Management System (Laravel)

## Technologies

* Laravel
* PHP
* Blade (frontend)
* MySQL / SQLite

## Features

* Authentication (Login/Register)
* Task CRUD (Create, Edit, Delete)
* Assign users to tasks
* Task filtering (status & priority)
* Task search
* Dashboard with statistics
* Clock in / Clock out
* Pagination
* Enums for status and priority

## Setup

```bash
git clone <repo-link>
cd erp-app
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

## Notes

The project was built within the given 4-hour timeframe.
