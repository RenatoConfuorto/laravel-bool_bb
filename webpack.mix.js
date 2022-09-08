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
    .sass('resources/sass/app.scss', 'public/css');

//script validazione dei form create-update e delle password di registrazione
mix.copy([
    'resources/js/apartmentFormValidation.js',
    'resources/js/registerFormValidation.js',
    'resources/js/userApiSearch.js',
], 'public/js');

mix.js('resources/js/front.js', 'public/js');

// foglio di stile dei form create e edit
mix.sass('resources/sass/form.scss', 'public/css');

//foglio di stile della nav bar dei messaggi
mix.sass('resources/sass/apartment-messages-navbar.scss', 'public/css');

//fontawesome
mix.copy('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts');