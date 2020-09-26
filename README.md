# izt/Basics

Basics Management

- Migrations && Seeds
- Models
    - Menu
    - Module
    - ModuleRole
    - Role
    - Session
    - User
    - Variable
    - Version
- Errors views
    
## Installation

```
composer require izt/Basics
```

## Usage

You can publish the configuration file

```
php artisan vendor:publish    
choose the tag izt-basics-config
```

You must publish migrations and seeds
```
php artisan vendor:publish --force    
choose the tag izt-basics-migrations
choose the tag izt-basics-seeds
```
To load data, write this in de DatabaseSeeder.php file
```
DB::statement('SET FOREIGN_KEY_CHECKS=0;');

$this->call(UsersTableSeeder::class);
$this->call(RolesTableSeeder::class);
$this->call(VariablesTableSeeder::class);

DB::statement('SET FOREIGN_KEY_CHECKS=1');
```     
You can publish the assets
```
php artisan vendor:publish    
choose the tag izt-basics-assets
```
You can publish the translations
```
php artisan vendor:publish    
choose the tag izt-basics-eu
choose the tag izt-basics-es
```

## Require

- yajra/laravel-datatables
- laravel/socialite
- izt/helpers


    
