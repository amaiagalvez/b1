# izt/Basics

Basics Management

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

You must publish the configuration file in config/basics.php

```
php artisan vendor:publish --force   
choose the tag izt-basics-config
```

You must publish the seeds
```
php artisan vendor:publish --force    
choose the tag izt-basics-seeds
```
To load data, write this in de DatabaseSeeder.php file
```
DB::statement('SET FOREIGN_KEY_CHECKS=0;');

$this->call(BasicsDatabaseSeeder::class);

DB::statement('SET FOREIGN_KEY_CHECKS=1');

```     
You can publish the assets in public/basics
```
php artisan vendor:publish   
choose the tag izt-basics-assets
```

In Kernel.php file add this lines to protected $middleware and remove from $middlewareGroups

```
\Illuminate\Session\Middleware\StartSession::class, (Session)
\Illuminate\View\Middleware\ShareErrorsFromSession::class, (@error('email'))
```

## Require

- php 7.2
- laravel 6
- yajra/laravel-datatables
- laravel/socialite
- izt/helpers

## Emails (informatikaamaia@gmail.com // A...55*)

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=ab64a4b34431cc
MAIL_PASSWORD=a3157b1296cf3b
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=info@aretha.eus
MAIL_FROM_NAME="${APP_NAME}"

## Problems
 
- artisan instalatu DUSK erabili ahal izateko    
