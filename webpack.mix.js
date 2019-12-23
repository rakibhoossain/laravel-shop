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

mix.js('resources/js/app.js', 'public/js')
   .js('resources/js/theme.js', 'public/js')
   .js('resources/js/dashboard.js', 'public/js')
   
   .sass('resources/sass/app.scss', 'public/css')
   .sass('resources/sass/shop/style.scss', 'public/css')
   .sass('resources/sass/admin/admin.scss', 'public/css');
