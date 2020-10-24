# izt/Basics

- Helpers, functions, ...
- Basic translations
- Datatables translations
- Abstract classes (Repository, Present ...)
- Basic classes (Language)
- Basic assets (datatables, jquery, ckeditor, ...)
- Theme (core ui)
- Basic views (layouts, errors)
- Routes (admin, developer)
- Middlewares (activityLogger, admin, developer, userLanguage)
- Auth (notifications, password reset, register (web))
- BladeService (@asterisk...)

Management of Basics Tables
===========================
    - Menu
    - Application    
    - Role
    - Session
    - User
    - Variable
    - Version
    
## Installation

```
composer require amaiagalvez/b1
```

## Usage

Configuration file in config/basics.php

```
php artisan vendor:publish --force   
choose the tag izt-basics-config
```

Assets in public/basics folder
```
php artisan vendor:publish   
choose the tag izt-basics-assets

gehitu webpack.mix.js fitxategian
mix.copyDirectory('resources/assets/basics', 'public/basics');
```

Translations in resources/lang folder (validation eta password hartzeko)
```
php artisan vendor:publish --force   
choose the tag izt-basics-lang
```
Views in resources/views/layouts folder
```
php artisan vendor:publish --force   
choose the tag izt-basics-views

aldatu basics::layout. => layout. 
```

New project 
===========

Delete:
- Controllers/Auth
- welcome.blade.php

Publish (izt-basics-help):
(Hauek dira konfiguraziorako behar diren fitxategiak. Nonbaiten edukitzeko kopia on bat eta proiektu guztietan berdinak izateko.)
- Exception/Handler
- Config
- Routes
- Http/Kernel
- Tests
- composer.json

Layouts 
=======

Change @extends('basics::layouts. => @extends('layouts.

app.blade.php => add application's asserts

Seeds 
=====
Migrations && Seeds take from de package (composer dump autoload)

To load data, add this in de DatabaseSeeder.php file
```
DB::statement('SET FOREIGN_KEY_CHECKS=0;');

$this->call(BasicsDatabaseSeeder::class);

DB::statement('SET FOREIGN_KEY_CHECKS=1');

```     
     
## Require

- php 7.2
- laravel 6
- league/fractal
- yajra/laravel-datatables
- laravel/socialite

## Emails 

https://mailtrap.io (informatikaamaia@gmail.com // A...)

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
- lang => validation eta password nola hartu paketetik zuzenean, publikatu gabe?
- lang/validation/attributes => aplikazio guztienak hemen gehitu behar dira

## Hobekuntzak
- testeatu gehiago DataTables (ordena, bilatu)
