let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
   .scripts(['resources/assets/js/angular-app.js'], 'public/js/angular-app.js')
   .scripts(['resources/assets/js/controller/*'], 'public/js/angular-controllers.js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .sass('resources/assets/sass/default.scss', 'public/css')
   .sass('resources/assets/sass/auth.scss', 'public/css');
