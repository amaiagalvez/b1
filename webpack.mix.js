const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.sass('resources/sass/app.scss', 'resources/assets/css/styles_two.css');

mix.copyDirectory('resources/images', 'resources/assets/images');

//translations
mix.copyDirectory('resources/js/translations', 'resources/assets/js');

//datables
mix.scripts('resources/js/datatables', 'resources/assets/js/dt.js');

