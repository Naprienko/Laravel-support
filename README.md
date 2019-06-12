## Requirements
 * php >= 7.0
 * Laravel >= 5.5
 

## Installation
1. Install package

    ```bash
    composer require ingvar/laravel-support
    ```

1. (optional) Edit `config/app.php` :

    

    Add service providers

    ```php
    Ingvar\Support\IngvarSupportServiceProvider::class,
    ```


1. Publish the package's config and assets :

    ```bash
    php artisan vendor:publish --tag=igs_config
    php artisan vendor:publish --tag=igs_public
    php artisan vendor:publish --tag=igs_lang
    php artisan vendor:publish --tag=igs_views
    ```

1. Run commands to clear cache :

    ```bash
    php artisan route:clear
    php artisan config:clear
    ```

1. Ensure that the files & images directories (in `config/lfm.php`) are writable by your web server (run commands like `chown` or `chmod`).

1. Create symbolic link :

    ```bash
    php artisan storage:link
    ```

1. Edit `APP_URL` in `.env`.

## What's next