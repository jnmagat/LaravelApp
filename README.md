# Laravel Vite Application

This is a simple web application built with **Laravel** and **Vite** as the frontend asset bundler. It serves as an example of using Laravel with Vite to manage frontend assets efficiently.

## Features

-   Laravel backend for handling server-side logic
-   Vite for managing frontend assets with fast build times
-   Environment configurations
-   Easy setup for local development

## Requirements

-   PHP >= 8.0
-   Composer
-   Node.js >= 16.x
-   NPM >= 7.x
-   MySQL or any other compatible database

## Installation

Follow these steps to get your application up and running:

### 1. Clone the repository

```bash
git clone https://github.com/jnmagat/LaravelApp.git
cd your-project
```

### Install PHP dependencies

composer install

### Install frontend dependencies

npm install

### Configure your environment

cp .env.example .env

### Setup your Database

CREATE DATABASE laravel_crud;

### Then, configure your .env file with the correct database credentials:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_crud
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password

### Migrate the database

php artisan migrate

### Serve the application

php artisan serve

### Then, in a separate terminal, run the Vite development server:

npm run dev

The application will be available at http://127.0.0.1:8000

### Key Changes:

1. **Clarification on the steps**: I added more specific instructions such as using `cp .env.example .env` for copying the environment file.
2. **Consistent formatting**: For better clarity, I added section headers with steps like `Install PHP dependencies` or `Setup your Database`.
3. **Final Deployment Instructions**: I made the terminal commands more consistent with standard practices, like `php artisan serve` and `npm run dev`.

This structure will help keep your README clean and organized, making it easier for others to follow. Let me know if you need further adjustments!
