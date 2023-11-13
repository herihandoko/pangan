<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Requirements

- PHP >= 8.0.0
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension

## Install

```bash
git clone https://heryhandoko@bitbucket.org/rctiplus/cms-template.git
cp .env.example .env                # create enviroment config file
vim .env                            # edit configuration (mail smtp options, db credentials you choose on db creation, debug mode). also you can edit mail config at config/mail.php file
composer install                    # install project dependencies
chmod a+rw storage -R               # folder for logs, cache, etc
chmod a+rw bootstrap/cache -R       # folder for laravel internal cache
php artisan key:generate            # generate unique application key
php artisan migrate                 # run database migrations
```

## User access default

- Username : admin@rctiplus.com
- Password : admin1234 

## Development

- controllers: `app/Http/Controllers/`
- routes: `app/Http/routes.php`
- main config `config/app.php`


To see all defined routes and corresponding controller methods use `php artisan route:list` console command
To create table use `php artisan make:migration create_table_name_table` console command
