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

// sass
mix.sass('resources/assets/sass/app.scss', 'public/css');

// js
mix.js('resources/assets/js/app.js', 'public/js')
    .extract(['vue']);

mix.js('resources/assets/js/mail.js', 'public/js');
mix.js('resources/assets/js/visitor.js', 'public/js');



// Versioning
if ( mix.inProduction() ) {
    mix.version();
} else {
	mix.sourceMaps();
}
