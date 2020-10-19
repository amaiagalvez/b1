# izt/Basics

Helpers, functions, ...

Basic translations

Datatables translations

Abstract classes (Repository, Present ...)

Basic classes (Language)

Basic assets (datatables, jquery, ckeditor, ...)

Theme (core ui)

Basic views (layouts, errors)

Basics Tables

    - Menu
    - Application    
    - Role
    - Session
    - User
    - Variable
    - Version
    
## Installation

```
composer require izt/Basics
```

## Usage

Configuration file in config/basics.php

```
php artisan vendor:publish --force   
choose the tag izt-basics-config
```

Seeds 
=====

To load data, add this in de DatabaseSeeder.php file
```
DB::statement('SET FOREIGN_KEY_CHECKS=0;');

$this->call(BasicsDatabaseSeeder::class);

DB::statement('SET FOREIGN_KEY_CHECKS=1');

```     
Assets in public/basics
```
php artisan vendor:publish   
choose the tag izt-basics-assets
```

Translations in resources/lang folder (bestela validation, password ez du hartzen)
```
php artisan vendor:publish --force   
choose the tag izt-basics-lang
```

In Kernel.php file add this lines to protected $middleware and remove from $middlewareGroups

```
\Illuminate\Session\Middleware\StartSession::class, (Session)
\Illuminate\View\Middleware\ShareErrorsFromSession::class, (@error('email'))
```

Views in resources/views/errors folder (bestela errors views ez du hartzen)
```
php artisan vendor:publish --force   
choose the tag izt-basics-views
```

To change errors view's path in your application

```
if ($this->isHttpException($exception)) {
    $statusCode = $exception->getStatusCode();
    return view("basics::errors.{$statusCode}");
}
```
     
## Require

- php 7.2
- laravel 6
- league/fractal
- yajra/laravel-datatables
- laravel/socialite

## Emails 

https://mailtrap.io (informatikaamaia@gmail.com // A...55*)

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=ab64a4b34431cc
MAIL_PASSWORD=a3157b1296cf3b
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=info@aretha.eus
MAIL_FROM_NAME="${APP_NAME}"

## Problems
 
- artisan nola instalatu DUSK erabili ahal izateko    
- lang/validation/attributes => aplikazio guztienak hemen gehitu behar dira
