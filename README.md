# Laravel 12 Project Setup Guide

## Requirements

-   PHP \>= 8.2
-   Composer
-   MySQL or other supported database
-   Node.js & NPM (optional, for frontend assets)

## Installation Steps

1.  **Clone the repository**

    ``` bash
    git clone <repository-url>
    cd <project-folder>
    ```

2.  **Install PHP dependencies**

    ``` bash
    composer install
    ```

3.  **Copy environment file**

    ``` bash
    cp .env.example .env
    ```

    Then update database settings in `.env`.

4.  **Generate application key**

    ``` bash
    php artisan key:generate
    ```

5.  **Run migrations (and seed if needed)**

    ``` bash
    php artisan migrate --seed
    ```

6.  **Install frontend dependencies (optional)**

    ``` bash
    npm install
    npm run build
    ```

7.  **Run the local development server**

    ``` bash
    php artisan serve
    ```

## Additional Commands

-   Clear caches:

    ``` bash
    php artisan optimize:clear
    ```

-   Storage link:

    ``` bash
    php artisan storage:link
    ```

## Notes

Ensure your `.env` file is configured properly before running migration
or starting the server.
