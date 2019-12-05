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

mix.js(['resources/js/app.js',
 'node_modules/@fortawesome/fontawesome-free/js/all.min.js',
 'node_modules/sweetalert2/dist/sweetalert2.all.min.js',
 'node_modules/tail.select/js/tail.select.min.js',
 'node_modules/popper.js/dist/popper.min.js'],
  'public/js')
.sass('resources/sass/app.scss', 'public/css');

mix.js('node_modules/jquery/dist/jquery.min.js', 'public/');

mix.styles(['node_modules/tail.select/css/bootstrap4/tail.select-default.min.css',
            'node_modules/@fortawesome/fontawesome-free/css/all.min.css',
            'node_modules/sweetalert2/dist/sweetalert2.min.css'], 
            'public/css/all.css');
