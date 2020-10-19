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

mix.copyDirectory('resources/images', 'public/images');

mix.sass('resources/sass/app.scss', 'public/css/styles_basics.css');

//translations
mix.copyDirectory('resources/js/translations', 'public/js');

//scripts
mix.scripts('resources/js/theme', 'public/js/theme.js');

//datables
mix.scripts('resources/js/datatables', 'public/js/dt.js');

mix.copy('node_modules/@fortawesome/fontawesome-free/css/all.min.css', 'public/css/fontawesome-free/all.min.css');
mix.copy('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/css/webfonts');

mix.copy('node_modules/popper.js/dist/umd/popper.js', 'public/js/popper.min.js');
mix.copy('node_modules/jquery/dist/jquery.min.js', 'public/js/jquery.min.js');

mix.copyDirectory('node_modules/@ckeditor/ckeditor5-build-classic/build', 'public/js/ckeditor');

mix.scripts([
    'node_modules/datatables.net/js/jquery.dataTables.min.js',
    'node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
    'node_modules/datatables.net-buttons/js/dataTables.buttons.js', //ordena!!!
    'node_modules/datatables.net-buttons-bs4/js/buttons.bootstrap4.js',
    'node_modules/datatables.net-buttons/js/buttons.colVis.js',
    'node_modules/datatables.net-buttons/js/buttons.flash.js',
    'node_modules/datatables.net-buttons/js/buttons.html5.js',
    'node_modules/datatables.net-buttons/js/buttons.print.js',
    'node_modules/datatables.net-select/js/dataTables.select.js',
    'node_modules/datatables.net-select-bs4/js/select.bootstrap4.js',
    'node_modules/datatables.net-colreorder/js/dataTables.colReorder.js',
    'node_modules/datatables.net-colreorder-bs4/js/colReorder.bootstrap4.js',
    'node_modules/datatables.net-fixedcolumns/js/dataTables.fixedColumns.js',
    'node_modules/datatables.net-fixedcolumns-bs4/js/fixedColumns.bootstrap4.js',
    'node_modules/datatables.net-fixedheader/js/dataTables.fixedHeader.js',
    'node_modules/datatables.net-fixedheader-bs4/js/fixedHeader.bootstrap4.js',
    'node_modules/datatables.net-rowgroup/js/dataTables.rowGroup.js',
    'node_modules/datatables.net-rowgroup-bs4/js/rowGroup.bootstrap4.js',
    'node_modules/datatables.net-rowreorder/js/dataTables.rowReorder.js',
    'node_modules/datatables.net-rowreorder-bs4/js/rowReorder.bootstrap4.js',
    'node_modules/datatables.net-scroller/js/dataTables.scroller.js',
    'node_modules/datatables.net-scroller-bs4/js/scroller.bootstrap4.js',
    'node_modules/datatables.net-autofill/js/dataTables.autoFill.js',
    'node_modules/datatables.net-autofill-bs4/js/autoFill.bootstrap4.js',
    'node_modules/datatables.net-keytable/js/dataTables.keyTable.js',
    'node_modules/datatables.net-keytable-bs4/js/keyTable.bootstrap4.js',
    'node_modules/jszip/dist/jszip.js',
    'node_modules/pdfmake/build/pdfmake.js',
    'node_modules/pdfmake/build/vfs_fonts.js',
], 'public/js/datatables.min.js');

mix.styles([
    'node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
    'node_modules/datatables.net-buttons-bs4/css/buttons.bootstrap4.css',
    'node_modules/datatables.net-autofill-bs4/css/autoFill.bootstrap4.css',
    'node_modules/datatables.net-colreorder-bs4/css/colReorder.bootstrap4.css',
    'node_modules/datatables.net-fixedcolumns-bs4/css/fixedColumns.bootstrap4.css',
    'node_modules/datatables.net-fixedheader-bs4/css/fixedHeader.bootstrap4.css',
    'node_modules/datatables.net-keytable-bs4/css/keyTable.bootstrap4.css',
    'node_modules/datatables.net-responsive-bs4/css/responsive.bootstrap4.css',
    'node_modules/datatables.net-rowgroup-bs4/css/rowGroup.bootstrap4.css',
    'node_modules/datatables.net-rowreorder-bs4/css/rowReorder.bootstrap4.css',
    'node_modules/datatables.net-scroller-bs4/css/scroller.bootstrap4.css',
    'node_modules/datatables.net-select-bs4/css/select.bootstrap4.css'
], 'public/css/datatables.min.css');


