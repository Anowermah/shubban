const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS scripts.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .styles([
        'resources/css/app.css',
        'resources/css/custom.css',
        'resources/css/components/*.css'
    ], 'public/css/all.css');

// Production specific settings
if (mix.inProduction()) {
    mix.version(); // Enable versioning in production
    mix.minify(); // Minify all assets in production
} else {
    // Development specific settings
    mix.browserSync('http://localhost:8000');
    mix.sourceMaps(); // Enable source maps in development
}

// Copy all images
mix.copy('resources/images', 'public/images');
