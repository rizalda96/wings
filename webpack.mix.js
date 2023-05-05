const mix = require('laravel-mix');
const path = require("path")
require('laravel-mix-clean');

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

// mix.js('resources/js/app.js', 'public/js')
//     .vue()
//     .sass('resources/sass/app.scss', 'public/css');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    // .sourceMaps()
    .vue();

// fix css files 404 issue
mix.webpackConfig({
    // add any webpack dev server config here
    resolve: {
        extensions: [".js", ".vue", ".json"],
        alias: {
            '@js': path.resolve(__dirname, "resources/js"),
            '@components': path.resolve(__dirname, "resources/js/components")
        },
    },
})
    .clean({
        cleanOnceBeforeBuildPatterns: ['./js/*'],
    })
