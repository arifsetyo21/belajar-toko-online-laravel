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

mix.js(['resources/js/app.js', 'node_modules/jquery/dist/jquery.min.js'], 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

mix.js('node_modules/sweetalert/dist/sweetalert.min.js', 'public/js');

mix.styles('node_modules/tail.select/css/bootstrap4/tail.select-default.min.css', 'public/css/all.css');
mix.js('node_modules/tail.select/js/tail.select.min.js', 'public/js');
// mix.copyDirectory('node_modules/bootstrap-select/dist/js/i18n', 'public/bootstrap-select/i18n');
